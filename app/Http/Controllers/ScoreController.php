<?php

namespace App\Http\Controllers;

use App\Models\Score;
use App\Http\Requests\ScoreRequest;

class ScoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $score = Score::orderby('created_at', 'desc')->paginate(5);
        return view('score.index', compact('score'));
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
    public function store(ScoreRequest $request)
    {
        try{
        $data = $request->validated();
        Score::create($data);
        return redirect()->route('scores.index')
        ->with('success', 'Berhasil Menambah Nilai !');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Score $score)
    {
        return view('score.show', compact('score'));
    }

    /*
     * Show the form for editing the specified resource.
     */
    public function edit(Score $score)
    {
        return view('score.edit', compact('score'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ScoreRequest $request, $id)
    {
        try{
        $data = $request->validated();
        $score= Score::find($id);
        $score->update($data);
        return redirect()->route('scores.index')->with('success','Berhasil Mengubah Nilai !');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try{
            Score::find($id)->delete();
            return redirect()->route('scores.index')->with('success','Berhasil Menghapus Nilai !');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}
