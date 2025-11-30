<?php

namespace App\Http\Controllers;

use App\Models\ScoreValue;
use App\Models\Intern;
use App\Models\Score;

use Illuminate\Http\Request;

class ScoreValueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Intern $intern)
    {
        $data['score'] = Score::all();
        $data['score_value'] = ScoreValue::where('intern_id', $intern->id)->get();
        return view('score-value.index',compact('data','intern'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     */
    public function show(ScoreValue $scoreValue)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ScoreValue $scoreValue)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ScoreValue $scoreValue)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ScoreValue $scoreValue)
    {
        
    }
}
