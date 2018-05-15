@extends('layouts.apps')

@section('css')
<link href="/plugins/dropzone/dropzone.css" rel="stylesheet">
@endsection

@section('content')
<section class="content">
        <div class="container-fluid">
        <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                UNGGAH FILE HASIL
                                <small>Batas unggah jawaban : {{\App\Config::where('param', 'test_end')->first()['value']}} | Waktu Server : {{\Carbon\Carbon::now()->toTimeString()}}</small>
                            </h2>                            
                        </div>
                        <div class="body">
                            @if(\Auth::user()->active == 1)                        
                                @if(\Carbon\Carbon::createFromFormat('H:i:s', \App\Config::where('param', 'test_end')->first()['value'])->gte(\Carbon\Carbon::now()))
                                    @if((\Storage::disk('local')->exists(env('TEST_ID')."\\".env('TEST_ID')."_".\Auth::user()->username."_".str_replace(" ","_",\Auth::user()->name).".zip"))||(\Storage::disk('local')->exists(env('TEST_ID')."\\".env('TEST_ID')."_".\Auth::user()->username."_".str_replace(" ","_",\Auth::user()->name).".rar")))
                                    <h2>File sudah tersimpan. Terima kasih :)</h2>                            
                                    @else
                                        <form action="{{ route('post-unggah') }}" method="POST" enctype="multipart/form-data">
                                            {{ csrf_field() }}
                                            <label for="file">File Hasil</label>
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="file" id="file" class="form-control" name="file">
                                                </div>
                                            </div>                               
                                            <button type="submit" class="btn btn-primary m-t-15 waves-effect">UNGGAH</button>
                                        </form>
                                    @endif
                                @else
                                <h2>Mohon maaf, batas waktu pengunggahan jawaban sudah terlampaui :(</h2>
                                @endif
                            @else
                            <h2>Mohon maaf, akun anda telah diblokir</h2>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
                                            
        </div>
    </section>
@endsection

@section('js')
<script src="/plugins/dropzone/dropzone.js"></script>
@endsection