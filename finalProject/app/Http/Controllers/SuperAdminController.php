<?php

namespace App\Http\Controllers;

use App\ActiveSemester;
use App\Admininfo;
use App\Http\Middleware\Admin;
use App\Http\Middleware\SuperAdmin;
use App\Superadmininfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SuperAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('superAdmin.adminDashboard')->with('admin',Admininfo::all());

    }

    public function showLoginForm()
    {
        return view('superAdmin.adminLogin');
    }

    public function authenticate(Request $request)
    {
        //$v = Superadmininfo::all();
        $userid = $request->userid;
        $pass = $request->password;
        $v =  Superadmininfo::where('suadmin', '=', "$userid")->first();
        if($v != null){
            if ($v->suadmin == $userid && Hash::check($pass, $v->supw)){
                session()->put('data',1);
                return redirect('superadmin');
            }else{
                return redirect('superadminlogin');
            }
        }else{
            return back();
        }
    }

    public function logout(){
        session()->forget('data');
        return redirect('superadminlogin');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('superAdmin.addAdmin');
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
            'empid' => 'required|unique:admininfos,empid',
            'emppw' => 'required',
            'empname' => 'required',
            'deptcode' => 'required'
        ]);

        //Admininfo::create($request->all());
        $pass = $request->get('emppw');
        $data = new Admininfo();
        $data->empid = $request->get('empid');
        $data->emppw =  Hash::make("$pass");
        $data->empname = $request->get('empname');
        $data->deptcode = $request->get('deptcode');
        $data->save();
        return redirect('/superadmin');
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

        $admin = DB::select( DB::raw("SELECT * FROM admininfos WHERE empid = '$id'"));
        return view('superAdmin.editAdmin')->with('admin',$admin[0]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$empid)
    {

        $this->validate($request,[
            'empid' => 'required',
            'empname' => 'required',
            'deptcode' => 'required'
        ]);
        $data['empid'] =  $request->empid;
        $data['empname'] = $request->empname;
        $data['deptcode'] = $request->deptcode;

        DB::table('admininfos')
            ->where('empid', "$empid")
            ->update($data);

        return redirect('superadmin');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('admininfos')->where('empid', "$id")->delete();
        return redirect('superadmin');
    }

    public function statusUpdate(Request $request)
    {
        $id = $request->get("user_id");
        $status = $request->get("status");
        $data['empactivitystatus'] = $status;

        DB::table('admininfos')
            ->where('empid', "$id")
            ->update($data);
        return response()->json(['success'=>'Status change successfully.']);
    }

    public function showActiveSemester(){
        return view('superAdmin.selectActiveSemester')->with('active',ActiveSemester::all());
    }

    public function activeSemesterStore(Request $request, ActiveSemester $sem){

        $semester = $request->semester;
        $dept = $request->deptcode;
        $year = $request->year;
        if ($semester == 'choose' || $dept == "choose"){
            return back();
        }else {
           DB::table('active_semesters')
                ->where('dept', $dept)
                ->update(['semester' => $semester, 'year' => $year, 'dept' => $dept]);
            return back();
        }
    }

    public function activeSemesterStatusUpdate(Request $request)
    {
        $id = $request->get('id');
        $status = $request->get('status');
        DB::table('active_semesters')
            ->where('id', $id)
            ->update(['active_status' => $status]);
        return response()->json(['success'=>'Status change successfully.']);
    }


}
