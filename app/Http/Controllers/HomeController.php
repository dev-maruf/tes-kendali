<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function postUnggah(Request $request)
    {
        // $data = new \App\File();
        // $data->name = $request->input('name');
        if(\Carbon\Carbon::createFromFormat('H:i:s', env('TEST_END'))->gte(\Carbon\Carbon::now())){
            $file = $request->file('file');
            $ext = $file->getClientOriginalExtension();
            if($ext == 'rar' || $ext == 'zip'){
                $newName = env('TEST_ID')."_".\Auth::user()->username."_".str_replace(" ","_",\Auth::user()->name).".".$ext;
                // $file->move('uploads/file',$newName);
                \Storage::putFileAs(
                    env('TEST_ID'), $request->file('file'), $newName
                );
            }
            return redirect()->route('unggah');
        }
        else{
            return redirect()->route('unggah');
        }
    }

    public function showUnggah()
    {
        return view('unggah');
    }

    public function showSoal()
    {
        if((\App\Config::where('param', 'test_state')->first()['value'] == '1')&&(\Carbon\Carbon::createFromFormat('H:i:s', \App\Config::where('param', 'test_end')->first()['value'])->gte(\Carbon\Carbon::now())))
        {
            return view('soal');            
        }
        else {
            return redirect()->route('home');
        }
    }
    
    public function popup()
    {
        return view('popup');
    }

    public function downloadSoal($path)
    {
        $path = storage_path('app/Soal/'.$path);
        return response()->file($path);
    }

    public function getChangePass()
    {
        return view('changepass');
    }

    public function changePass(Request $request)
    {
        // return $request;
        // return $request->confirm_password;
        if($request->password == $request->confirm_password){
            \Auth::user()->update(['password'=>Hash::make($request->password)]);
            return redirect()->back()->with('success', 'Berhasil');
        }
        else {
            return redirect()->back()->with('not-same', 'Gagal');
        }
    }
}
