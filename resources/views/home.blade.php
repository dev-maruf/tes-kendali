@extends('layouts.apps')

@section('content')
<section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>DASHBOARD</h2>
            </div>                        

            <!-- Widgets -->
            <div class="row clearfix">                
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <a href="{{route('soal')}}" style="text-decoration:none;cursor: pointer;">
                    <div class="info-box bg-red hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">assignment</i>
                        </div>                        
                        <div class="content">
                            <div class="text">Soal</div>
                            <div class="number count-to" data-from="0" data-to="1" data-speed="1" data-fresh-interval="2"></div>
                        </div>                                                
                    </div>
                    </a>
                </div>                
            </div>
            <!-- #END# Widgets -->

            <div class="row clearfix" id="switch-container">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Count Down
                            </h2>                            
                        </div>
                        <div class="body"> 
                            <h1 id="demo"></h1>
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

@section('js')
@if(Auth::user()->active == '0')
<script>
document.getElementById("demo").innerHTML = "BLOCKED";
</script>
@elseif(\App\Config::where('param', 'test_state')->first()['value'] == '0')
<script>
document.getElementById("demo").innerHTML = "Belum Dimulai";
</script>
@else
<script>
// Set the date we're counting down to
var countDownDate = new Date(<?php echo "\"".date("M j, Y ").\App\Config::where('param', 'test_end')->first()['value']."\"" ?>).getTime();
// var countDownDate = new Date("Sep 5, 2018 15:37:25").getTime();

// Update the count down every 1 second
var x = setInterval(function() {

    // Get todays date and time
    var now = new Date().getTime();
    
    // Find the distance between now an the count down date
    var distance = countDownDate - now;
    
    // Time calculations for days, hours, minutes and seconds    
    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);

    // if(minutes == 4 && seconds > 50){
    //     alert("Waktu anda tinggal 5 menit lagi");
    // }
    // if(minutes == 9 && seconds > 50){
    //     alert("Waktu anda tinggal 10 menit lagi");
    // }
    // Output the result in an element with id="demo"
    var retTime = "";
    if(hours > 0){
        retTime += hours + " jam ";
    }
    if(minutes > 0){
        retTime += minutes + " menit ";
    }
    retTime += seconds + " detik ";
    document.getElementById("demo").innerHTML = retTime;    
    
    // If the count down is over, write some text 
    if (distance < 0) {
        clearInterval(x);
        document.getElementById("demo").innerHTML = "WAKTU HABIS";
    }
}, 1000);
</script>
@endif
@endsection
