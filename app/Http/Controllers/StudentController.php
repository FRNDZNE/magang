<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\User;
use App\Models\Intern;
use Illuminate\Support\Str;
use App\Http\Requests\StudentRequest;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::with('user')->paginate(10);
        return view('student.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $students = Student::all();
        return view('student.create', compact('students'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StudentRequest $request)
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
                Student::create([
                    'user_id' => $user->id,
                    'student_number' => $form['student_number'],
                    'institution' => $form['institution'],
                    'major' => $form['major'],
                    'phone' => $form['phone'],
                    'address' => $form['address'],
                ]);

                $user->assignRole('student');
            });
            return redirect()->route('students.index')->with('success','Berhasil Menambahkan Student');

        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error',$th->getMessage);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(User $student)
    {
        return view('student.show', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $student)
    {
        return view('student.edit', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StudentRequest $request, User $student)
    {
        try {
            $form = $request->validated();

            DB::transaction(function() use ($form, $student){

                $student->update([
                    'name' => $form['name'],
                    'email' => $form['email'],
                    'password' => !empty($form['password'])
                        ? bcrypt($form['password'])
                        : $student->password,
                ]);

                $student->student->update([
                    'student_number' => $form['student_number'],
                    'institution' => $form['institution'],
                    'major' => $form['major'],
                    'phone' => $form['phone'],
                    'address' => $form['address'],
                ]);

                $student->syncRoles(['student']);
            });

            return redirect()->route('students.index')->with('success','Berhasil Mengupdate Student');

        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error',$th->getMessage);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $student)
    {
        try {
            $student->delete();
            return redirect()->back()->with('success','Berhasil Menghapus Student');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error',$th->getMessage);
        }
    }
}
