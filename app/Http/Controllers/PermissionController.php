<?php

namespace App\Http\Controllers;

use App\Http\Requests\PermissionRequest;
use App\Models\Permission;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::all();
        return view('permission.index',compact('permissions'));
    }

    public function store(PermissionRequest $request)
    {
        try {
            $data = $request->validated();
            Permission::create($data);
            return redirect()->back()->with('success','Berhasil Menambah Permission !');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function update(PermissionRequest $request, $id)
    {
        try {
            $data = $request->validated();
            $permission = Permission::find($id);
            $permission->update($data);
            return redirect()->back()->with('success','Berhasil Mengubah Permission !');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            Permission::find($id)->delete();
            return redirect()->back()->with('success','Berhasil Menghapus Permission !');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}
