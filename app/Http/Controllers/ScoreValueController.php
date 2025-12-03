<?php

namespace App\Http\Controllers;

use App\Http\Requests\ScoreValueRequest;
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
     * Store a newly created resource in storage.
     */
    public function store(ScoreValueRequest $request, Intern $intern)
    {
        $data = $request->validated();
        // return $data;
        try {
            ScoreValue::updateOrCreate(
                [
                    'id' => $data['id'] ?? 0,
                ],
                [
                    'score_id' => $data['score_id'],
                    'intern_id' => $intern->id,
                    'value' => $data['value'],
                ]
            );
            return redirect()->back()->with('success','Berhasil Melakukan Input Nilai');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', $th->getMessage());
        }
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
        $scoreValue->delete();
    }
}
