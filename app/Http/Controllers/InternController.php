<?php

namespace App\Http\Controllers;

use App\Models\Intern;
use Illuminate\Http\Request;

class InternController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Intern::orderby('created_at', 'desc')->paginate(5);
        return view('intern.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('intern.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Intern::create($request->validated());
        return redirect()->route('interns.index')
        ->with('success', 'Intern created successfully.');
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
        return view('intern.edit', compact('intern'));
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
