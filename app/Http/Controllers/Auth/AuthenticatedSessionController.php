<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
        $request->session()->regenerate();

        // Pastikan user memiliki role yang valid
        if (!$request->user()->roles()->exists()) {
            Auth::guard('web')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            throw ValidationException::withMessages([
                'email' => 'User does not have any assigned role.',
            ]);
        }

        // Beri sedikit delay untuk memastikan role sudah terload
        $request->user()->load('roles');

        if ($request->user()->hasRole('customers')) {
            return redirect()->route('customers.dashboard.page.index');
        } elseif ($request->user()->hasRole('owner')) {
            return redirect()->route('admin.dashboard');
        }

        // Jika tidak ada role yang cocok, logout dan beri pesan error
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        throw ValidationException::withMessages([
            'email' => 'Unauthorized role access.',
        ]);
    }
    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        $request->session()->flash('success', 'Anda telah berhasil log out.');

        return redirect('/login');
    }
}
