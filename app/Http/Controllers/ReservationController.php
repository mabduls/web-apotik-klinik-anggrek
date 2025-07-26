<?php

namespace App\Http\Controllers;

use App\Models\Rekap;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ReservationController extends Controller
{
    public function index(Request $request)
    {
        $query = Reservation::query();

        $user = auth()->user();

        if ($user->hasRole('owner')) {
            $query->latest();
        } elseif ($user->hasRole('customers')) {
            $query->where('user_id', auth()->id())->latest();
        } else {
            abort(403, 'Unauthorized role.');
        }

        // Filter berdasarkan status
        if ($request->has('status') && in_array($request->status, ['menunggu', 'disetujui'])) {
            $query->where('status', $request->status);
        }

        // Sorting
        if ($request->has('sort')) {
            if ($request->sort === 'oldest') {
                $query->oldest();
            } elseif ($request->sort === 'newest') {
                $query->latest();
            }
        }

        // Search
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nomor_reservasi', 'like', "%{$search}%")
                    ->orWhere('nama_pasien', 'like', "%{$search}%");
            });
        }

        $reservations = $query->paginate(5);

        // Untuk menyimpan filter/sort saat pindah halaman
        if ($request->has('status')) {
            $reservations->appends(['status' => $request->status]);
        }
        if ($request->has('sort')) {
            $reservations->appends(['sort' => $request->sort]);
        }
        if ($request->has('search')) {
            $reservations->appends(['search' => $request->search]);
        }

        $currentSort = $request->get('sort', 'newest');
        $currentStatus = $request->get('status', '');
        $currentSearch = $request->get('search', '');

        if ($user->hasRole('owner')) {
            return view('admin.reservation_page.index', compact('reservations', 'currentSort', 'currentStatus', 'currentSearch'));
        }

        if ($user->hasRole('customers')) {
            return view('customers.reservation_page.index', compact('reservations', 'currentSort', 'currentStatus', 'currentSearch'));
        }

        abort(403, 'Unauthorized role.');
    }

    public function create()
    {
        return view('customers.reservation_page.create');
    }

    public function generateNomorReservasi()
    {
        $length = rand(5, 15);
        $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
        $charactersLength = strlen($characters);
        $randomString = '';

        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        return $randomString;
    }

    public function store(Request $request)
    {
        $now = now();
        $currentDate = $now->format('Y-m-d');
        $currentTime = $now->format('H:i');

        $validator = Validator::make($request->all(), [
            'nama_pasien' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'nik' => [
                'required',
                'string',
                'size:16',
                function ($attribute, $value, $fail) {
                    // Cek apakah NIK sudah ada di database
                    $existingReservation = Reservation::where('nik', $value)->first();

                    if ($existingReservation) {
                        // Jika NIK sudah ada, cek apakah user yang sama
                        if ($existingReservation->user_id !== auth()->id()) {
                            $fail('NIK ini sudah digunakan oleh pasien lain.');
                        }
                    }
                }
            ],
            'alamat' => 'required|string',
            'umur' => 'required|integer|min:1|max:120',
            'tinggi_badan' => 'required|numeric|min:30|max:250',
            'berat_badan' => 'required|numeric|min:2|max:300',
            'keluhan' => 'required|string|max:1000',
            'no_telepon' => 'required|string|max:15',
            'tanggal_reservasi' => [
                'required',
                'date',
                'after_or_equal:today',
                function ($attribute, $value, $fail) use ($currentDate, $currentTime, $request) {
                    if ($value == $currentDate && $request->jam_reservasi < $currentTime) {
                        $fail('Tidak bisa booking untuk waktu yang sudah lewat.');
                    }
                }
            ],
            'jam_reservasi' => [
                'required',
                'date_format:H:i',
                function ($attribute, $value, $fail) use ($request) {
                    // Validasi format waktu (kelipatan 15 menit)
                    $minutes = date('i', strtotime($value));
                    if ($minutes % 15 != 0) {
                        $fail('Jam reservasi harus kelipatan 15 menit (contoh: 08:00, 08:15, dst).');
                    }

                    // Validasi jam praktik
                    if ($value < '08:00' || $value > '20:00') {
                        $fail('Jam praktik hanya antara 08:00 - 20:00.');
                    }

                    $date = date('m-d', strtotime($request->tanggal_reservasi));
                    $year   = date('Y', strtotime($request->tanggal_reservasi));

                    // Cek apakah ada reservasi di tanggal & jam yang sama dalam tahun yang sama
                    $existingReservation = Reservation::whereRaw("DATE_FORMAT(tanggal_reservasi, '%m-%d') = ?", [$date])
                        ->whereRaw("YEAR(tanggal_reservasi) = ?", [$year])
                        ->where('jam_reservasi', $value)
                        ->exists();

                    if ($existingReservation) {
                        $fail('Jam reservasi ini sudah dipesan oleh pasien lain.');
                    }
                }
            ]
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $validator->validated();
        $data['user_id'] = auth()->id();

        do {
            $nomorReservasi = $this->generateNomorReservasi();
        } while (Reservation::where('nomor_reservasi', $nomorReservasi)->exists());

        $data['nomor_reservasi'] = $nomorReservasi;

        Reservation::create($data);

        return redirect()->route('customers.reservation.page')->with('success', 'Reservasi berhasil dibuat!');
    }

    public function showDetails(Reservation $reservation)
    {
        if (auth()->user()->hasRole('owner')) {
            return view('admin.reservation_page.details', compact('reservation'));
        }

        if ($reservation->user_id !== auth()->id()) {
            abort(403);
        }

        return view('customers.reservation_page.details', compact('reservation'));
    }

    public function showRekap(Request $request)
    {
        $query = Rekap::query();

        // Search functionality
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_pasien', 'like', "%{$search}%")
                    ->orWhere('nik', 'like', "%{$search}%")
                    ->orWhere('no_telepon', 'like', "%{$search}%")
                    ->orWhere('diagnosa_penyakit', 'like', "%{$search}%")
                    ->orWhereHas('reservation', function ($subQuery) use ($search) {
                        $subQuery->where('nomor_reservasi', 'like', "%{$search}%");
                    });
            });
        }

        // Sorting
        if ($request->has('sort')) {
            if ($request->sort === 'oldest') {
                $query->oldest();
            } elseif ($request->sort === 'newest') {
                $query->latest();
            }
        } else {
            $query->latest();
        }

        $rekaps = $query->paginate(10);

        // Pass parameters for pagination links
        if ($request->has('search')) {
            $rekaps->appends(['search' => $request->search]);
        }
        if ($request->has('sort')) {
            $rekaps->appends(['sort' => $request->sort]);
        }

        $currentSort = $request->get('sort', 'newest');
        $currentSearch = $request->get('search', '');

        return view('admin.reservation_page.rekap', compact('rekaps', 'currentSort', 'currentSearch'));
    }

    public function showRekapDetails(Rekap $rekap)
    {
        return view('admin.reservation_page.rekap_details', compact('rekap'));
    }

    //fungsi ini digunakan untuk mengupdate dan memperbarui data riwayat rekam medis milik pasien
    public function updateRekap(Request $request, Rekap $rekap)
    {
        $validated = $request->validate([
            'nama_pasien' => 'required|string|max:255',
            'nik' => 'required|string|max:20',
            'alamat' => 'required|string',
            'umur' => 'required|integer',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tinggi_badan' => 'required|numeric',
            'berat_badan' => 'required|numeric',
            'no_telepon' => 'required|string|max:20',
            'diagnosa_penyakit' => 'required|string',
            'saran_pengobatan' => 'required|string',
            'no_bpjs' => 'nullable|string|max:20',
        ]);

        $rekap->update($validated);

        // Update data reservasi terkait
        if ($rekap->reservation) {
            $rekap->reservation->update([
                'nama_pasien' => $validated['nama_pasien'],
                'nik' => $validated['nik'],
                'jenis_kelamin' => $validated['jenis_kelamin'], 
                'alamat' => $validated['alamat'],
                'umur' => $validated['umur'],
                'tinggi_badan' => $validated['tinggi_badan'],
                'berat_badan' => $validated['berat_badan'],
                'no_telepon' => $validated['no_telepon'],
            ]);
        }

        return redirect()->route('admin.reservations.rekap.details', $rekap)
            ->with('success', 'Data Riwayat Rekam Medis Pasien Berhasil diperbarui!');
    }

    public function edit(Reservation $reservation)
    {
        //
    }

    //Seharusnya nama fungsinya updateStatusReservasi karena fungsi ini akan
    //UPDATE STATUS SETIAP RESERVASI(MENGUBAH STATUS MENJADI DISSETUJUI) 
    //LALU SETELAH ITU DILAKUKAN PENGECEKAN APAKAH STATUS DISETUJUI, JIKA IYA MAKA DISIMPAN KE TABEL REKAP
    public function storeRekap(Request $request, Reservation $reservation)
    {
        $request->validate([
            'status' => 'required|in:menunggu,disetujui'
        ]);

        $reservation->update(['status' => $request->status]);

        if ($request->status === 'disetujui') {
            Rekap::create([
                'reservation_id' => $reservation->id,
                'nama_pasien' => $reservation->nama_pasien,
                'nik' => $reservation->nik,
                'jenis_kelamin' => $reservation->jenis_kelamin,
                'alamat' => $reservation->alamat,
                'umur' => $reservation->umur,
                'tinggi_badan' => $reservation->tinggi_badan,
                'tanggal_reservasi' => $reservation->tanggal_reservasi,
                'no_telepon' => $reservation->no_telepon ?? '-',
                'berat_badan' => $reservation->berat_badan,
                'diagnosa_penyakit' => 'Belum diisi',
                'saran_pengobatan' => 'Belum diisi',
                'no_bpjs' => null
            ]);
        }

        return back()->with('success', 'Status reservasi berhasil diperbarui dan disimpan!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reservation $reservation)
    {
        //
    }
}
