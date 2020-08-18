<?php

namespace App\Http\Controllers;

use App\Admininfo;
use App\Http\Middleware\Admin;
use App\Imports\StudentImport;
use App\Imports\UsersImport;
use App\Studentinfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Files\Disk;
use phpDocumentor\Reflection\Types\True_;
use Illuminate\Support\Facades\DB;
use function GuzzleHttp\Promise\all;


class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return view('admin.adminDashboard');
    }

    public function showLoginForm()
    {
       return view('admin.login');
    }

    public function showStudentAddForm()
    {
        return view('admin.addstudents');
    }

    public function postImport(Request $r)
    {
        if ($r->hasFile('file')){
            $file = $r->file('file')->store('import');
            (new StudentImport)->import($file);
            return back();

        }
    }


    public function authenticate(Request $request)
    {

        $id = $request->userid;
        $pass = $request->password;
       // $admin = DB::select( DB::raw("SELECT * FROM admininfos WHERE empid = '$id'"));
        $admin =  Admininfo::where('empid', '=', "$id")->first();
        if ($admin != "") {
            if ($admin->empid == $id && Hash::check($pass, $admin->emppw)) {
                if ($admin->empactivitystatus == 1) {
                    session()->put('empdata', 1);
                    return redirect('/admin');
                } else {
                    return redirect('/adminlogin');
                }
            }else{
                return redirect('/adminlogin');
            }
        }else{
            return redirect('/adminlogin');
        }


    }

    public function logout(){
        session()->forget('empdata');
        return redirect('adminlogin');
    }

    public function showStudentList()
    {
        return view('admin.studentslist')->with('students',Studentinfo::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'sname' => 'required',
            'semail'=> 'required|unique:studentinfos,semail',
            'sid' => 'required|unique:studentinfos,sid',
            'deptcode' => 'required'
        ]);

        $data = new Studentinfo();
        $data->sname = $request->sname;
        $data->sid = $request->sid;
        $data->semail = $request->semail;
        $data->deptcode = $request->deptcode;
        $data->save();
        return redirect("admin/students");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('studentinfos')->where('sid', "$id")->delete();
        return redirect('admin/students');
    }
}
