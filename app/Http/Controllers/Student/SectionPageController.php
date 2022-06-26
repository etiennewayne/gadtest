<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Section;
use Illuminate\Http\Request;

use Auth;


class SectionPageController extends Controller
{
    //
    public function __construct(){

        $this->middleware('auth');
        $this->middleware('take_online');

    }

    public function index(Request $req){
        //student_scehdule_id

        $sched_id = $req->student_schedule_id;

        $user = Auth::user();


        $sections = Section::select('sections.section_id', 'section', 'img_filename', 'set_time', 'taking_test.user_id')
            ->leftJoin('taking_test', function($q) use ($user){
                $q->on('sections.section_id', 'taking_test.section_id');
                $q->where('user_id', $user->user_id);
            })
            ->get();


        return view('student.section-page')
            ->with('sections', $sections)
            ->with('sched_id', $sched_id);
    }



}
