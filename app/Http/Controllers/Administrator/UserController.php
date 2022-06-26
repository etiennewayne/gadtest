<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Models\LearningModality;
use App\Models\Program;
use Illuminate\Http\Request;
use DB;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //

    public function __construct(){
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function index(){
        return view('panel.user.user');
    }

    public function show($id){
        return User::find($id);
    }

    public function getUsers(Request $req){
        
        $sort = explode('.', $req->sort_by);
        return User::where('lname', 'like', $req->lname . '%')
            ->where('fname', 'like', $req->fname . '%')
            ->where('user_id', $req->user_id == '' ? 'like' : '=', $req->user_id == '' ? '%' : $req->user_id)
            ->orderBy($sort[0], $sort[1])
            ->paginate($req->perpage);
    }

    public function allStudents(Request $req){
        $sort = explode('.', $req->sort_by);
        return User::where('lname', 'like', $req->lname . '%')
            ->where('role', 'STUDENT')
            ->orderBy($sort[0], $sort[1])
            ->paginate($req->perpage);
    }

    public function verifyEmailStudents($id){
       User::where('user_id', $id)
        ->update([
            'email_verified_at' => DB::raw('now()')
        ]);

        return ['status' => 'verified'];
    }

    public function create(){
        return view('panel.user.user-create')
            ->with('userid', 0);
    }

    public function store(Request $req){

        $ndate = date("Y-m-d", strtotime($req->bdate)); //convert to date format UNIX
        //birthdate

        $validate = $req->validate([
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'lname' => ['required', 'string', 'max:255'],
            'fname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:4', 'confirmed'],
        ]);

      

        User::create([
            'username' => $req->username,
            'password' => Hash::make($req->password),
            'lname' => strtoupper($req->lname),
            'fname' => strtoupper($req->fname),
            'mname' => strtoupper($req->mname),
            'suffix' => strtoupper($req->suffix),
            'sex' => strtoupper($req->sex),
            'bdate' => $ndate,
            'birthplace' => strtoupper($req->birthplace),
            'contact_no' => $req->contact_no,
            'email' => $req->email,
            'last_school_attended' => strtoupper($req->last_school_attended),
            'province' => $req->province,
            'city' => $req->city,
            'barangay' => $req->barangay['barangay'],
            'barangay_id' => $req->barangay['barangay_id'],
            'street' => strtoupper($req->street),
            'role' => strtoupper($req->role),
        ]);

        return response()->json([
            'status' => 'saved'
        ], 200);
    }

    public function edit($id){
        $programs = Program::where('programStat', 1)->get();
        $learningmodes = LearningModality::all();

        $data = User::find($id);
        return view('panel.user.user-create')
            ->with('userid', $id)
            ->with('programs', $programs ? $programs : '')
            ->with('learningmodes', $learningmodes);
    }

    public function update(Request $req, $id){

        $ndate = date("Y-m-d", strtotime($req->bdate)); //convert to date format UNIX

        if($req->password != ''){
            $validate = $req->validate([
                'username' => ['required', 'string', 'max:50', 'unique:users,username,' .$id.',user_id'],
                'lname' => ['required', 'string', 'max:255'],
                'fname' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'. $id. ',user_id'],
                'password' => ['required', 'string', 'min:4', 'confirmed'],
            ]);
        }else{
            $validate = $req->validate([
                'username' => ['required', 'string', 'max:50', 'unique:users,username,' . $id . ',user_id'],
                'lname' => ['required', 'string', 'max:255'],
                'fname' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'. $id. ',user_id'],
            ]);
        }

        $data = User::find($id);
        $data->username = $req->username;
        $data->lname = strtoupper($req->lname);
        $data->fname = strtoupper($req->fname);
        $data->mname = strtoupper($req->mname);
        $data->suffix = strtoupper($req->suffix);
        $data->sex = strtoupper($req->sex);
        $data->status = strtoupper($req->status);
        $data->bdate = $ndate;
        $data->birthplace = strtoupper($req->birthplace);
        $data->contact_no = strtoupper($req->contact_no);
        $data->email = $req->email;
        $data->first_program_choice = $req->first_program_choice;
        $data->second_program_choice = $req->second_program_choice;
        $data->learning_mode = $req->learning_mode;
        $data->last_school_attended = strtoupper($req->last_school_attended);
        $data->province = $req->province;
        $data->city = $req->city;
        $data->barangay = $req->barangay['barangay'];
        $data->barangay_id = $req->barangay['barangay_id'];
        $data->street = strtoupper($req->street);
        $data->role = strtoupper($req->role);
     
        $data->save();

        return response()->json([
            'status' => 'updated'
        ], 200);
    }

    public function destroy($id){
        User::destroy($id);
    }

    public function resetPassword(Request $req, $id){
        $req->validate([
            'password' => ['required',  'confirmed', 'min:4']
        ]);

        $data = User::find($id);
        $data->password = Hash::make($req->password);
        $data->save();

        return response()->json([
            'status' => 'reset'
        ]);
    }
}
