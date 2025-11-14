<?php

namespace App\Http\Controllers;

use App\Models\ScoreValue;
use App\Models\Student;
use Illuminate\Http\Request;

class ScoreValueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = ScoreValue::orderby('created_at', 'desc')->paginate(5);
        return view('scorevalue.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('scorevalue.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Student::create($request->validated());
        return redirect()->route('scorevalues.index')
        ->with('success', 'Score Value created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ScoreValue $scoreValue)
    {
        return view('scorevalue.show', compact('scoreValue'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ScoreValue $scoreValue)
    {
        return view('scorevalue.edit', compact('scoreValue'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ScoreValue $scoreValue)
    {
        $scoreValue->update($request->validated());
        return redirect()->route('scorevalues.index')
        ->with('success', 'Score Value updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ScoreValue $scoreValue)
    {
        $scoreValue->delete();
        return back()->with('success','Score Value deleted successfully.');
    }
}
