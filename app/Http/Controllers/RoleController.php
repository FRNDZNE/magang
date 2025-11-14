<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use App\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $role = Role::all();
        return view('role.index',compact('role'));
    }

    public function store(RoleRequest $request)
    {
        try {
            $data = $request->validated();
            Role::create($data);
            return redirect()->back()->with('success','Berhasil Menambah Role !');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function update(RoleRequest $request, $id)
    {
        try {
            $data = $request->validated();
            $role = Role::find($id);
            $role->update($data);
            return redirect()->back()->with('success','Berhasil Mengubah Role !');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            Role::find($id)->delete();
            return redirect()->back()->with('success','Berhasil Menghapus Role !');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}
