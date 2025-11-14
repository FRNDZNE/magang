<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Student;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;
use App\Http\Requests\StudentRegisterRequest;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(StudentRegisterRequest $request): RedirectResponse
    {
        $form = $request->validated();

        try {
            DB::transaction(function () use ($form) {
                $user = User::create([
                    'uuid' => Str::uuid(),
                    'name' => $form['name'],
                    'email' => $form['email'],
                    'password' => Hash::make($form['password']),
                ]);

                Student::create([
                    'user_id' => $user->id,
                    'student_number' => $form['student_number'],
                    'institution' => $form['institution'],
                    'major' => $form['major'],
                    'phone' => $form['phone'],
                    'address' => $form['address'],
                ]);

                $user->assignRole('student');
                event(new Registered($user));
                Auth::login($user);
            });

            // redirect HARUS dikembalikan di sini, BUKAN di dalam transaction
            return redirect()->route('dashboard');
            
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

}
