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
        $division = Division::orderby('created_at', 'desc')->paginate(5);
        return view('division.index', compact('division'));
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
        try {
            $data = $request->validated();
            Division::create($data);
            return redirect()->route('divisions.index')
            ->with('success','Berhasil Menambah Divisi !');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
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
    public function update(DivisionRequest $request, $id)
    {
        try {
            $data = $request->validated();
            $division = Division::find($id);
            $division->update($data);
            return redirect()->route('divisions.index')->with('success','Berhasil Mengubah Divisi !');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            Division::find($id)->delete();
            return redirect()->back()->with('success','Berhasil Menghapus Divisi !');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}
