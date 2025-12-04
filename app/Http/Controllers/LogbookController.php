<?php

namespace App\Http\Controllers;

use App\Http\Requests\FeedbackRequest;
use App\Models\Intern;
use App\Models\Logbook;
use App\Models\LogbookImage;
use App\Http\Requests\LogbookRequest;

class LogbookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Intern $intern)
    {
        $logbooks = Logbook::where('intern_id', $intern->id)->get();
        return view('logbook.index', compact('logbooks','intern'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Intern $intern)
    {
        return view('logbook.create', compact('intern'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LogbookRequest $request, Intern $intern)
    {
        try {
            $data = $request->validated();
            Logbook::create([
                "intern_id" => $intern->id,
                "date" => $data['date'],
                "activity" => $data['activity'],
                "output" => $data['output'],
            ]);
            return redirect()->route('interns.logbooks.index', $intern->uuid)->with('success', 'Berhasil Menambahkan Logbook!.');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', $th->getMessage());
        }
        
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Intern $intern, Logbook $logbook)
    {
        $images = LogbookImage::where('logbook_id',$logbook->id)->get();
        return view('logbook.show', compact('logbook','intern','images'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Intern $intern,Logbook $logbook)
    {
        return view('logbook.edit', compact('logbook','intern'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LogbookRequest $request, Intern $intern, Logbook $logbook)
    {
        try {
            $data = $request->validated(); 
            $logbook->update([
                "date" => $data['date'],
                "activity" => $data['activity'],
                "output" => $data['output'],
            ]);
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
        
        return redirect()->route('interns.logbooks.index', $intern->uuid)->with('success', 'Berhasil Update Logbook!.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Intern $intern,Logbook $logbook)
    {
        try {
            $logbook->delete();
            return redirect()->back()->with('success','Berhasil Menghapus Logbook');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function store_feedback(FeedbackRequest $request)
    {

    }
}
