<!DOCTYPE HTML>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1" >

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
		<div id="refresh">
			<script>
			var limamenit = new Audio('/audio/5menit.mp3');
			var satumenit = new Audio('/audio/1menit.mp3');
			var sepuluhmenit = new Audio('/audio/10menit.mp3');
			var limabelasmenit = new Audio('/audio/15menit.mp3');
			var nolmenit = new Audio('/audio/0menit.mp3');

			var limabelas = true;
			var sepuluh = true;
			var lima = true;
			var satu = true;
			var nol = true;
			// audio.play();
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

				if(minutes == 14 && seconds > 50){
					if(limabelas){
						limabelasmenit.play();
						limabelas = false;            
					}
				}
				if(minutes == 4 && seconds > 50){
					if(lima){
						limamenit.play();
						lima = false;
					}
				}
				if(minutes == 9 && seconds > 50){
					if(sepuluh){
						sepuluhmenit.play();
						sepuluh = false;
					}
				}    
				if(minutes == 0 && seconds > 50){
					if(satu){
						satumenit.play();
						satu = false;
					}            
				}
				if(minutes == 0 && seconds < 10){
					if(nol){
						nolmenit.play();
						nol = false;
					}        
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
		</div>
	</body>
</html>
