<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Auth;

class UserTestInfoController extends Controller
{
    //

    public function __construct(){
        $this->middleware('auth');
    }


    public function userInfo($id){
        $user = Auth::user();


        return view('panel.user-test-info')
            ->with('id', $id);
    }
}
