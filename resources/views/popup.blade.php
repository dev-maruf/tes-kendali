<!DOCTYPE HTML>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
p {
  text-align: center;
  font-size: 60px;
  margin-top:0px;
}
</style>
</head>
<body>

<p id="demo"></p>
<h1 style="text-align: center;" id="notif">
</h1>

<script>
// Set the date we're counting down to
var countDownDate = new Date(<?php echo "\"".date("M j, Y ").env('TEST_END')."\"" ?>).getTime();
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

    if(minutes == 5 && seconds > 50){
        alert("Waktu anda tinggal 5 menit lagi");
    }
    if(minutes == 10 && seconds > 50){
        alert("Waktu anda tinggal 10 menit lagi");
    }

    if(minutes < 5 ){
        document.body.style.backgroundColor = "yellow";
    }

    if(minutes < 1 ){
        document.body.style.backgroundColor = "red";
    }

    if(minutes < 5){
        document.getElementById("notif").innerHTML = "Segera upload file jawaban anda";
    }
    
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
        document.getElementById("demo").innerHTML = "EXPIRED";
    }
}, 1000);
</script>

</body>
</html>
