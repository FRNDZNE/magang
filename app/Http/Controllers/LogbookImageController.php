<?php

namespace App\Http\Controllers;

use App\Models\LogbookImage;
use Illuminate\Http\Request;

class LogbookImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = LogbookImage::orderby('created_at', 'desc')->paginate(5);
        return view('logbook_image.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('logbook_image.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        LogbookImage::create($request->validated());
        return redirect()->route('logbook_images.index')
        ->with('success', 'Logbook Image created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(LogbookImage $logbookImage)
    {
        return view('logbook_image.show', compact('logbookImage'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LogbookImage $logbookImage)
    {
        return view('logbook_image.edit', compact('logbookImage'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LogbookImage $logbookImage)
    {
        $logbookImage->update($request->validated());
        return redirect()->route('logbook_images.index')
        ->with('success', 'Logbook Image updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LogbookImage $logbookImage)
    {
        $logbookImage->delete();
        return back()->with('success','Logbook Image deleted successfully.');
    }
}
