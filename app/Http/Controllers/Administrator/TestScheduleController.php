<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\TestSchedule;
use App\Models\AcadYear;
use App\Models\StudentSchedule;


class TestScheduleController extends Controller
{
    //

    public function __construct(){
        $this->middleware('auth');
        //$this->middleware('admin');
    }

    public function index(){
        return view('panel.test_schedule.test-schedule');
    }

    public function getData(Request $req){
        $sort = explode('.', $req->sort_by);

        $ay = AcadYear::where('active', 1)->first();

        return TestSchedule::with(['students'])->orderBy($sort[0], $sort[1])
            ->where('description', 'like', '%' .$req->description . '%')
            ->where('acad_year_id', $ay->acad_year_id)
            ->paginate($req->perpage);
    }

    public function create(){
        $acads = AcadYear::orderBy('code', 'desc')->get();
        return view('panel.test_schedule.test-schedule-create')
            ->with('acads', $acads);
    }

    public function store(Request $req){


        $validate = $req->validate([
            'acad_year_id' => ['numeric', 'required'],
            'description' => ['string', 'max:255', 'required'],
            'from' => ['date_format:Y-m-d H:i:s', 'required'],
            'to' => ['date_format:Y-m-d H:i:s', 'required'],
            'max_user' => ['numeric', 'max:200', 'min:1'],
        ]);

        TestSchedule::create([
            'acad_year_id' => $req->acad_year_id,
            'description' => $req->description,
            'from' => $req->from,
            'to' => $req->to,
            'max_user' => $req->max_user
        ]);

        return ['status' => 'saved'];
    }

    public function edit($id){
        $acads = AcadYear::orderBy('code', 'desc')->get();
        $data = TestSchedule::find($id);
        return view('panel.test_schedule.test-schedule-edit')
            ->with('acads', $acads)
            ->with('data', $data);
    }

    public function update(Request $req, $id){
        $validate = $req->validate([
            'acad_year_id' => ['numeric', 'required'],
            'description' => ['string', 'max:255', 'required'],
            'from' => ['date_format:Y-m-d H:i:s', 'required'],
            'to' => ['date_format:Y-m-d H:i:s', 'required'],
            'max_user' => ['numeric', 'max:200', 'min:1'],
        ]);

        TestSchedule::where('test_schedule_id', $id)
            ->update([
                'acad_year_id' => $req->acad_year_id,
                'description' => $req->description,
                'from' => $req->from,
                'to' => $req->to,
                'max_user' => $req->max_user
            ]);

        return ['status' => 'updated'];
    }

    public function destroy($id){
        TestSchedule::destroy($id);
    }









    public function printPreviewTestSchedule($id){
        $schedule = TestSchedule::with('students')
            ->where('test_schedule_id', $id)
            ->first();
        //return date('Y-m-d', strtotime($schedule->from));

        return view('panel.test_schedule.print-preview-student-schedule')
            ->with('schedule', $schedule);
    }

}
