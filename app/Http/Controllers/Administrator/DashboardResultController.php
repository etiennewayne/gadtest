<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


use App\Models\User;
use App\Models\AnswerSheet;
use App\Models\AcadYear;


class DashboardResultController extends Controller
{
    //

    public function dashboardReport(){
        $ay = AcadYear::where('active', 1)->first();

        $countAccepted = User::where('remark', 'ACCEPT')
            ->where('academic_year_code', $ay->code)->count();
        $countRejected = User::where('remark', 'REJECT')
            ->where('academic_year_code', $ay->code)->count();
        $countReturnee = User::where('status', 'RETURNEE')
            ->where('academic_year_code', $ay->code)->count();
        $countTransferee = User::where('status', 'TRANSFEREE')
            ->where('academic_year_code', $ay->code)->count();
        $countNewStudent = User::where('status', 'NEW')
            ->where('academic_year_code', $ay->code)->count();

        


        $countTakers = DB::table('answer_sheets')
            ->from( function ($query) use ($ay){
                $query->select('*')->from('answer_sheets')
                ->where('code', $ay->code)
                ->groupBy('user_id')->get();
            })
            ->count();
        
            
        return [
            'accepted' => $countAccepted, 
            'new_students' => $countNewStudent, 
            'rejected' => $countRejected,
            'no_takers' => $countTakers,
            'no_returnees' => $countReturnee,
            'no_transferees' => $countTransferee
        ];
    }
}
