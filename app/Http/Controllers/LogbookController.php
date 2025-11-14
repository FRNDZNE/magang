<?php

namespace App\Http\Controllers;

use App\Models\Logbook;
use Illuminate\Http\Request;

class LogbookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Logbook::orderby('created_at', 'desc')->paginate(5);
        return view('logbook.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('logbook.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Logbook::create($request->validated());
        return redirect()->route('logbooks.index')
        ->with('success', 'Logbook created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Logbook $logbook)
    {
        return view('logbook.show', compact('logbook'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Logbook $logbook)
    {
        return view('logbook.edit', compact('logbook'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Logbook $logbook)
    {
        $logbook->update($request->validated());
        return redirect()->route('logbooks.index')
        ->with('success', 'Logbook updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Logbook $logbook)
    {
        $logbook->delete();
        return back()->with('success','Logbook deleted successfully.');
    }
}
