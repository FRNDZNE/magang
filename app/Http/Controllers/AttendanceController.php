<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Intern;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Intern $intern)
    {
        $data['mulai'] = $intern->start_date;
        $data['selesai'] = $intern->end_date;
        $data['attendance'] = Attendance::where('intern_id',$intern->id)->get();
        $data['today'] = Carbon::parse(today())->format('Y-m-d');
        $data['periode'] = $this->periodIntern($data['mulai'], $data['selesai']);
        return view('attendance.index',compact('intern','data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Intern $intern)
    {
        
    }

    public function periodIntern($start, $end)
    {
        $dates = [];
        $mulai = Carbon::parse($start);
        $selesai = Carbon::parse($end);

        for ($date = $mulai; $date->lte($selesai); $date->addDay()) {
            $dates[] = $date->format('Y-m-d');
        }

        return $dates;
    }
}
