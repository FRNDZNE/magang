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
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mentors = Mentor::with('user')->paginate(10);
        return view('mentor.index',compact('mentors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $divisions = Division::all();
        return view('mentor.create',compact('divisions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MentorRequest $request)
    {
        try {
            $form = $request->validated();
            DB::transaction(function() use ($form){
                $user = User::create([
                    'name' => $form['name'],
                    'uuid' => Str::uuid(),
                    'email_verified_at' => now(),
                    'email' => $form['email'],
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
            return redirect()->route('mentors.index')->with('success','Berhasil Menambahkan Mentor');
            
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Mentor $mentor)
    {
        return view('mentor.show', compact('mentor'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mentor $mentor)
    {
        $divisions = Division::all();
        return view('mentor.edit', compact('divisions','mentor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MentorRequest $request, Mentor $mentor)
    {
        try {
            $form = $request->validated();

            DB::transaction(function () use ($form, $mentor) {

                // Ambil user dari mentor
                $user = User::findOrFail($mentor->user_id);

                // Update user
                $user->update([
                    'name' => $form['name'],
                    'email' => $form['email'], // email sudah divalidasi di request
                    'password' => !empty($form['password'])
                                    ? bcrypt($form['password'])
                                    : $user->password,
                ]);

                // Update mentor
                $mentor->update([
                    'division_id'     => $form['division_id'],
                    'employee_number' => $form['employee_number'],
                    'phone'           => $form['phone'],
                ]);

                // Pastikan role tetap mentor
                $user->syncRoles(['mentor']);
            });

            return redirect()->route('mentors.index')->with('success', 'Berhasil Mengubah Mentor');

        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mentor $mentor)
    {
        try {
            User::find($mentor->user_id)->delete();
            return redirect()->back()->with('success', 'Berhasil Menghapus Data');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}
