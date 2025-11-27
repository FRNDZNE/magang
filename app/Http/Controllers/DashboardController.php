<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Division;
use App\Models\Mentor;
use App\Models\Student;
use App\Models\Intern;
use Auth;
class DashboardController extends Controller
{
    public function admin()
    {
        $data['division'] = Division::count();
        $data['mentor'] = Mentor::count();
        $data['student'] = Student::count();
        $data['total_pengajuan'] = Intern::withTrashed()->count();
        $data['terkonfirmasi'] = Intern::where('status','c')->count();
        $data['process'] = Intern::where('status','p')->count();
        $data['accepted'] = Intern::where('status','a')->count();
        $data['denied'] = Intern::withTrashed()->where('status','d')->count();
        return view('dashboard.admin',compact('data'));
    }

    public function mentor()
    {
        $mentor_id = Auth::user()->mentor->id;
        $data['mentee'] = Intern::where('mentor_id',$mentor_id)->count();    
        return view('dashboard.mentor',compact('data'));
    }

    public function student()
    {
        return view('dashboard.student');
    }
}
