<?php

namespace App\Http\Controllers;

use App\Models\Mentor;
use Illuminate\Http\Request;

class MentorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Mentor::orderby('created_at', 'desc')->paginate(5);
        return view('mentor.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('mentor.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Mentor::create($request->validated());
        return redirect()->route('mentors.index')
        ->with('success', 'Mentor created successfully.');
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
        return view('mentor.edit', compact('mentor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Mentor $mentor)
    {
        $mentor->update($request->validated());
        return redirect()->route('mentors.index')
        ->with('success', 'Mentor updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mentor $mentor)
    {
        $mentor->delete();
        return back()->with('success','Mentor deleted successfully.');
    }
}
