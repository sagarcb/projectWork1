<?php

namespace App\Http\Controllers;

use App\Courseinfo;
use App\Teacherinfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $tid = session('tid');
        $tinfo = DB::table('teacherinfos')
                    ->where('tid',$tid)->get();
        $regCourses = DB::table('courseinfos')->distinct('teacherinfo_id')
                    ->where('teacherinfo_id',$tid)->latest('semester')->get();
        $activeys = DB::table('active_semesters')
                        ->where('dept',session('deptcode'))->get();
        return view('teacher.index')->with('tinfo',$tinfo[0])
                                        ->with('regcourses',$regCourses)->with('activeys',$activeys[0]);

    }

    public function authenticate(Request $request)
    {
        $tid = $request->get('tid');
        $pass = $request->get('password');
        $teacherInfo = Teacherinfo::where('tid',"$tid")->first();
        if(!empty($teacherInfo)){
            if($teacherInfo->tid === $tid && ($teacherInfo->password === $pass || Hash::check("$pass","$teacherInfo->password"))){
                session()->put('tid',$teacherInfo->tid);
                session()->put('teacherloginstatus',1);
                session()->put('deptcode',$teacherInfo->deptcode);
                return redirect('/teacher');
            }else{
                return back()->with('error',"*Teacher id or password was incorrect");
            }
        }else{
            return back()->with('error',"*Teacher id or password was incorrect");
        }

    }

    //For Showing the Teacher's Login Form
    public function showLoginForm()
    {
        return view('teacher.login');
    }

    //For Logout Option
    public function logout()
    {
        session()->forget('teacherloginstatus');
        session()->forget('tid');
        session()->forget('deptcode');
        return redirect('teacher/login');
    }

    //Show the evaluation report page for the specific subject
    public function showReport($id)
    {

        $tid = session('tid');
        $tinfo = DB::table('teacherinfos')
            ->where('tid',$tid)->get();
        $activeys = DB::table('active_semesters')
            ->where('dept',session('deptcode'))->get();
        $mcq = DB::table('evaluationresults')->where('courseid',"=","$id")->first();
        $evaluationStatus = DB::table('courseinfos')->select('openforevaluation')
            ->where('courseid','=',$id)->first();

        $openended = DB::table('studentcourseregistrations')
            ->join('evaluateopenendeds','studentcourseregistrations.id','=','evaluateopenendeds.cregid')
            ->join('questionopenendeds','evaluateopenendeds.qidopenended','=','questionopenendeds.id')
            ->where('studentcourseregistrations.courseid',$id)->get();

        return view('teacher.report')->with('tinfo', $tinfo[0])->with('activeys', $activeys[0])
            ->with('mcq', $mcq)
            ->with('courseid', $id)
            ->with('evstatus',$evaluationStatus)
            ->with('openended',$openended);


    }

    //Show change password page
    public function showChangePass()
    {
        $id = session('tid');
        $tinfo = DB::table('teacherinfos')
            ->where('tid',$id)->first();
        return view('teacher.change-pass')
            ->with('tinfo',$tinfo);
    }
    //update New password
    public function updatePass(Request $request, $id)
    {
        $old = $request->oldPassword;
        $password = $request->newPassword;
        $confirm = $request->confirmPassword;
        $tinfo = Teacherinfo::where('tid',$id)->first();
        $this->validate($request,[
            'oldPassword' => 'required',
            'newPassword' => 'required',
            'confirmPassword' => 'required'
        ]);

        if ($old === $tinfo->password || Hash::check("$old","$tinfo->password")){
            if ($password === $confirm){
                DB::table('teacherinfos')->where('tid',$id)
                    ->update(['password'=>Hash::make($password)]);

                $regCourses = DB::table('courseinfos')->distinct('teacherinfo_id')
                    ->where('teacherinfo_id',$id)->latest('semester')->get();

                $activeys = DB::table('active_semesters')
                    ->where('dept',session('deptcode'))->get();

                return redirect('/teacher')
                    ->with('tinfo',$tinfo[0])
                    ->with('regcourses',$regCourses)
                    ->with('activeys',$activeys[0])
                    ->with('message','Password Changed Successfully');
            }else{
                session()->flash('msg', "Confirm password didn't match with new password!!!");
                return redirect()->back();
            }
        }else{
            session()->flash('msg', "Previous password was wrong!!");
            return back();
        }

    }


}
