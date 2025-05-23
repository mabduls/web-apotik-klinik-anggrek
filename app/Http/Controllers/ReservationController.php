<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ReservationController extends Controller
{
    public function index(Request $request)
    {
        $query = Reservation::query();

        if (auth()->user()->hasRole('owner')) {
            $query->latest();
        } else {
            $query->where('user_id', auth()->id())->latest();
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

        if (auth()->user()->hasRole('owner')) {
            return view('admin.reservation_page.index', compact('reservations', 'currentSort', 'currentStatus', 'currentSearch'));
        }

        return view('customers.reservation_page.index', compact('reservations', 'currentSort', 'currentStatus', 'currentSearch'));
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

    public function edit(Reservation $reservation)
    {
        //
    }

    public function update(Request $request, Reservation $reservation)
    {
        $request->validate([
            'status' => 'required|in:menunggu,disetujui'
        ]);

        $reservation->update(['status' => $request->status]);

        return back()->with('success', 'Status reservasi berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reservation $reservation)
    {
        //
    }
}
