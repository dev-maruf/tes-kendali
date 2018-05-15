@extends('layouts.apps')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>DASHBOARD</h2>
            </div>
            <div class="row clearfix" id="switch-container">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Reset Test
                            </h2>                            
                        </div>
                        <div class="body">
                            @if(\App\Config::where('param','test_state')->first()['value'] == '1')
                            <div class="button-on" style="display: flex;align-items: center;">
                                <form method="POST" action="{{route('reset-test')}}">
                                    {{ csrf_field() }}
                                    <input type="hidden" id="state" name="state" value="0">
                                    <button type="submit" class="btn btn-danger waves-effect">
                                        <i class="material-icons">autorenew</i>
                                        <span>Reset</span>
                                    </button>
                                </form>
                            </div>
                            @else
                            <div class="button-on" style="display: flex;align-items: center;">
                                <form method="POST" action="{{route('reset-test')}}">
                                    {{ csrf_field() }}
                                    <input type="hidden" id="state" name="state" value="1">
                                    <input type="text" class="form-control" name="duration" id="duration" placeholder="Duration Test (in Minute)">
                                    <br>
                                    <button type="submit" class="btn btn-success waves-effect">
                                        <i class="material-icons">done</i>
                                        <span>Start</span>
                                    </button>
                                </form>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection