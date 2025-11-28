<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Mentor;
use App\Models\Division;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\MentorRequest;

class MentorController extends Controller
{
    public function index()
    {
        $mentors = Mentor::with('user')->paginate(10);
        return view('mentor.index', compact('mentors'));
    }

    public function create()
    {
        $divisions = Division::all();
        return view('mentor.create', compact('divisions'));
    }

    public function store(MentorRequest $request)
    {
        try {
            $form = $request->validated();

            DB::transaction(function () use ($form) {

                // Create user + UUID
                $user = User::create([
                    'uuid' => Str::uuid(),
                    'name' => $form['name'],
                    'email' => $form['email'],
                    'email_verified_at' => now(),
                    'password' => bcrypt($form['password'])
                ]);

                Mentor::create([
                    'user_id' => $user->id,
                    'division_id' => $form['division_id'],
                    'employee_number' => $form['employee_number'],
                    'phone' => $form['phone'],
                ]);

                $user->assignRole('mentor');
            });

            return redirect()->route('mentors.index')->with('success', 'Berhasil Menambahkan Mentor');

        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    /** 
     * SHOW → menggunakan User binding (UUID)
     */
    public function show(User $mentor)
    {
        // Ambil data mentor via relasi
        $data = $mentor->mentor;

        return view('mentor.show', [
            'user' => $mentor,
            'mentor' => $data
        ]);
    }

    /**
     * EDIT → menggunakan User binding (UUID)
     */
    public function edit(User $mentor)
    {
        $divisions = Division::all();

        return view('mentor.edit', [
            'user' => $mentor,
            'mentor' => $mentor->mentor,
            'divisions' => $divisions
        ]);
    }

    /**
     * UPDATE → menggunakan User binding (UUID)
     */
    public function update(MentorRequest $request, User $mentor)
    {
        try {
            $form = $request->validated();

            DB::transaction(function () use ($form, $mentor) {

                // Update user
                $mentor->update([
                    'name' => $form['name'],
                    'email' => $form['email'],
                    'password' => !empty($form['password'])
                        ? bcrypt($form['password'])
                        : $mentor->password,
                ]);

                // Update mentor table via relasi
                $mentor->mentor->update([
                    'division_id'     => $form['division_id'],
                    'employee_number' => $form['employee_number'],
                    'phone'           => $form['phone'],
                ]);

                $mentor->syncRoles(['mentor']);
            });

            return redirect()->route('mentors.index')->with('success', 'Berhasil Mengubah Mentor');

        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    /**
     * DESTROY → menggunakan User binding (UUID)
     */
    public function destroy(User $mentor)
    {
        try {
            $mentor->delete(); // Soft delete user
            return redirect()->back()->with('success', 'Berhasil Menghapus Data');

        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}
