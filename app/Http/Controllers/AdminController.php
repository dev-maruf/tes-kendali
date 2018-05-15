<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Session;
use Excel;
use File;
 
class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function addStudent()
    {
        return view('admin.addstudent');
    }
 
    public function import(Request $request){
        //validate the xls file
        $this->validate($request, array(
            'file'      => 'required'
        ));
 
        if($request->hasFile('file')){
            $extension = File::extension($request->file->getClientOriginalName());
            if ($extension == "xlsx" || $extension == "xls" || $extension == "csv") {
 
                $path = $request->file->getRealPath();
                $data = Excel::load($path, function($reader) {
                })->get();
                // dd($data);
                // foreach($data as $raw){
                //     echo $raw;
                // }
                if(!empty($data) && $data->count()){
 
                    foreach ($data as $key => $value) {
                        $insert[] = [
                            'name' => $value->name,
                            'email' => $value->email,
                            'username' => $value->niu,
                            'password' => Hash::make($value->password)
                        ];
                    }
 
                    if(!empty($insert)){
 
                        $insertData = DB::table('users')->insert($insert);
                        if ($insertData) {
                            Session::flash('success', 'Your Data has successfully imported');
                        }else {                        
                            Session::flash('error', 'Error inserting the data..');
                            return back();
                        }
                    }
                }
 
                return back();
 
            }else {
                Session::flash('error', 'File is a '.$extension.' file.!! Please upload a valid xls/csv file..!!');
                return back();
            }
        }
    }

    public function dash()
    {
        return view('admin.dash');
    }

    public function config()
    {
        return view('admin.config');
    }

    public function voice()
    {
        return view('admin.voice');
    }
    
    public function setStudent(Request $request)
    {
        \App\User::where('id', $request->userid)->update(['active'=>$request->state]);
        return redirect()->back();
    }

    public function resetTest(Request $request)
    {
        if($request->state == 1){
            \App\Config::where('param', 'test_state')->update(['value'=>'1']);
            $time_end = \Carbon\Carbon::now()->addMinute($request->duration)->toTimeString();
            \App\Config::where('param', 'test_end')->update(['value'=>$time_end]);
        }
        else {
            \App\Config::where('param', 'test_state')->update(['value'=>'0']);
        }
        return redirect()->back();
    }
}