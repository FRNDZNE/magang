<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Intern;
use App\Models\Attendance;
use Illuminate\Http\Request;
use App\Http\Requests\AttendanceRequest;

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
    public function store(AttendanceRequest $request, Intern $intern)
    {
        try {
            $data = $request->validated();
            Attendance::updateOrCreate(
                [
                    'id' => $data['id'],
                    'date' => $data['date'],
                ],
                [
                    'intern_id' => $intern->id,
                    'date' => $data['date'],
                    'status' => $data['status'],
                    'notes' => $data['notes'],
                ]
        );
            return redirect()->back()->with('success', 'Berhasil Menambahkan Absensi');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
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

    public function validationMentor(Request $request, Intern $intern)
    {
        try {
            $data = Attendance::where('id', $request->id);
            $data->update([
                'validated' => $request->validated,
            ]);
            return redirect()->back()->with('success', 'Berhasil Mengubah Validasi');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}
