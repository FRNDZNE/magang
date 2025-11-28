<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Intern;
use App\Models\Division;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\InternRequestForStudent;

class InternController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $role = $user->getRoleNames()->first();
        if ($role == 'student') {
            $student_id = $user->student->id;
            $data = Intern::where('student_id', $student_id)->first();
        } else {
            $data = Intern::paginate(10);
        }
        return view('intern.index', compact('data'));
    }

    public function history()
    {
        $data = Intern::withTrashed()->orderBy('created_at','desc')->paginate(10);
        return view('intern.history', compact('data'));
    }

    public function history_student($student_id)
    {
        $data = Intern::withTrashed()->where('student_id',$student_id)->orderBy('created_at','desc')->get();
        return view('intern.history-student', compact('data'));
    }

    /**
     * Show the form for creating a new resource for student.
     */
    public function create()
    {
        $divisions = Division::all();
        return view('intern.create',compact('divisions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(InternRequestForStudent $request)
    {
        $data = $request->validated();
        Intern::create([
            'uuid' => Str::uuid(),
            'student_id' => Auth::user()->student->id,
            'division_id' => $data['division_id'],
            'start_date' => $data['start_date'],
            'end_date' => $data['end_date'],
        ]);
        return redirect()->route('interns.index')->with('success', 'Pengajuan magang berhasil dikirim.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Intern $intern)
    {
        return view('intern.show', compact('intern'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Intern $intern)
    {
        $divisions = Division::all();
        return view('intern.edit', compact('intern','divisions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(InternRequestForStudent $request, Intern $intern)
    {
        $intern->update($request->validated());
        return redirect()->route('interns.index')
        ->with('success', 'Pengajuan magang berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */

    public function denied(Intern $intern)
    {
        $intern->update(['status' => 'd']);
        $intern->delete();
        return back()->with('success','Penolakan Berhasil dan Pengajuan dihapus!');
    }
    public function destroy(Intern $intern)
    {
        $intern->delete();
        return redirect()->back()->with('success','Berhasil Membatalkan Pengajuan Magang!');
    }

    public function process(Intern $intern)
    {
        $intern->update(['status' => 'p']);
        return back()->with('success','Intern is now in process.');
    }

    public function accept(Intern $intern)
    {
        $intern->update(['status' => 'a']);
        return back()->with('success','Intern has been approved.');
    }
}
