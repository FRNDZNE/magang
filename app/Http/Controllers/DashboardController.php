<?php

namespace App\Http\Controllers;

use App\Models\Division;
use App\Models\Mentor;
use App\Models\Student;
use App\Models\Intern;
use App\Models\Score;
use App\Models\ScoreValue;
use Auth;
class DashboardController extends Controller
{
    public function admin()
    {
        $data['division'] = Division::count();
        $data['mentor'] = Mentor::count();
        $data['student'] = Student::count();
        $data['total_pengajuan'] = Intern::withTrashed()->whereNot(function($q){
            $q->whereNotNull('deleted_at')->where('status','c');
        })->count();
        $data['terkonfirmasi'] = Intern::where('status','c')->count();
        $data['process'] = Intern::where('status','p')->count();
        $data['accepted'] = Intern::where('status','a')->count();
        $data['denied'] = Intern::withTrashed()->where('status','d')->count();
        return view('dashboard.admin',compact('data'));
    }

    public function mentor()
    {
        $mentor_id = Auth::user()->mentor->id;
        $data['mentee'] = Intern::where('mentor_id',$mentor_id)->get();    
        return view('dashboard.mentor',compact('data'));
    }

    public function student()
    {
        $user_uuid = Auth::user()->uuid;

        // Ambil internship user berdasarkan uuid
        $data['internship'] = Intern::whereHas('student', function ($q) use ($user_uuid) {
            $q->whereHas('user', function ($q2) use ($user_uuid) {
                $q2->where('uuid', $user_uuid);
            });
        })->first();

        // Default value
        $data['pengajuan'] = 0;
        $data['dibatalkan'] = 0;
        $data['terkonfirmasi'] = 0;
        $data['process'] = 0;
        $data['accepted'] = 0;
        $data['denied'] = 0;

        $data['score'] = Score::all();
        $data['my_score'] = collect([]);   // default kosong

        // Jika memiliki internship
        if ($data['internship']) {

            $student_id = $data['internship']->student_id;

            $data['pengajuan'] = Intern::withTrashed()
                ->where('student_id', $student_id)
                ->count();

            $data['dibatalkan'] = Intern::withTrashed()
                ->where('student_id', $student_id)
                ->where('status', 'c')
                ->whereNotNull('deleted_at')
                ->count();

            $data['terkonfirmasi'] = Intern::where('student_id', $student_id)
                ->where('status', 'c')
                ->count();

            $data['process'] = Intern::where('student_id', $student_id)
                ->where('status', 'p')
                ->count();

            $data['accepted'] = Intern::where('student_id', $student_id)
                ->where('status', 'a')
                ->count();

            $data['denied'] = Intern::withTrashed()
                ->where('student_id', $student_id)
                ->where('status', 'd')
                ->count();

            // Ambil nilai score user
            $data['my_score'] = ScoreValue::whereHas('intern', function ($q) use ($user_uuid) {
                $q->whereHas('student', function ($q2) use ($user_uuid) {
                    $q2->whereHas('user', function ($q3) use ($user_uuid) {
                        $q3->where('uuid', $user_uuid);
                    });
                });
            })->get()->keyBy('score_id'); // <-- penting!
        }

        return view('dashboard.student', compact('data'));
    }

}
