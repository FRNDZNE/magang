<?php

namespace App\Http\Controllers;

use App\Http\Requests\DivisionRequest;
use App\Models\Division;

class DivisionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Division::orderby('created_at', 'desc')->paginate(5);
        return view('division.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('division.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DivisionRequest $request)
    {
        Division::create($request->validated());
        return redirect()->route('divisions.index')->with('success', 'Division created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Division $division)
    {
        return view('division.show', compact('division'));   }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Division $division)
    {
        return view('division.edit', compact('division'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DivisionRequest $request, Division $division)
    {
        $division->update($request->validated());
        return redirect()->route('divisions.index')->with('success', 'Division updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Division $division)
    {
        //
    }
}
