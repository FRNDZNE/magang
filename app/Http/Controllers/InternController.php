<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Intern;
use App\Models\Division;
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
        $req = $request->validated();
        return $req;
        Intern::create($req);
        return redirect()->route('interns.index')
        ->with('success', 'Pengajuan magang berhasil dikirim.');
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
    public function update(Request $request, Intern $intern)
    {
        $intern->update($request->validated());
        return redirect()->route('interns.index')
        ->with('success', 'Intern updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Intern $intern)
    {
        $intern->delete();
        return back()->with('success','Intern deleted successfully.');
    }
}
