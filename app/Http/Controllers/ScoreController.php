<?php

namespace App\Http\Controllers;

use App\Models\Score;
use Illuminate\Http\Request;

class ScoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Score::orderby('created_at', 'desc')->paginate(5);
        dd("Controller ok");
        return view('division.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('score.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Score::create($request->validated());
        return redirect()->route('scores.index')
        ->with('success', 'Score created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Score $score)
    {
        return view('score.show', compact('score'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Score $score)
    {
        return view('score.edit', compact('score'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Score $score)
    {
        $score->update($request->validated());
        return redirect()->route('scores.index')
        ->with('success', 'Score updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Score $score)
    {
        $score->delete();
        return back()->with('success','Score deleted successfully.');
    }
}
