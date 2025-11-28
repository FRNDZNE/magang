<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Notifications\WelcomeNotification;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Notification;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function __invoke(EmailVerificationRequest $request): RedirectResponse
    {
        $user = $request->user();

        // Jika sudah terverifikasi sebelumnya
        if ($user->hasVerifiedEmail()) {
            return redirect()->intended(route('dashboard', absolute: false) . '?verified=1');
        }

        // Jika email baru saja diverifikasi
        if ($user->markEmailAsVerified()) {
            event(new Verified($user));

            // Kirim notifikasi selamat datang
            $user->notify(new WelcomeNotification($user->name));
        }

        return redirect()->intended(route('dashboard', absolute: false) . '?verified=1');
    }
}
