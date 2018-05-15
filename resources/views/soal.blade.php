@extends('layouts.apps')

@section('content')
<section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>Daftar Soal</h2>
            </div>                        

            <!-- Widgets -->
            <div class="row clearfix">                
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-red hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">assignment</i>
                        </div>
                        <div class="content">
                            <div class="text">Soal</div>
                            <div class="number count-to" data-from="0" data-to="1" data-speed="1" data-fresh-interval="2"></div>
                        </div>
                    </div>
                </div>                
            </div>
            <!-- #END# Widgets -->

            <div class="row clearfix" id="switch-container">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Daftar Soal
                            </h2>                            
                        </div>
                        <div class="body">
                            @foreach(Storage::allFiles("Soal") as $file)
                            <a target="_blank" href="{{route('unduh-soal', ['path'=>explode("/",$file)[1]])}}"><i class="material-icons md-18">attach_file</i>{{explode("/",$file)[1]}}</a><br/>
                            @endforeach
                            <!-- <div class="button-on" style="display: flex;align-items: center;">
                                <button type="button" onclick="myFunction()" class="btn btn-success waves-effect">
                                    <i class="material-icons">alarm_on</i>
                                    <span>Show PopUp</span>
                                </button>                                                 
                            </div>                             -->
                        </div>
                    </div>
                </div>
            </div>
                                            
        </div>
    </section>
@endsection
