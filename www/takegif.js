var seconds;
var temp;

function takegifPhotos()
{
  var url="takegifphotos.php";
  $.get(url); //take photos
}
function countdown() 
{
	seconds = document.getElementById('countdown').innerHTML;
	seconds = parseInt(seconds, 10);
	
	if (seconds == 1) {
	  temp = document.getElementById('countdown');
	  temp.innerHTML = "Taking Photos";
	  return;
	}
	
	seconds--;
	//var beep = new Audio('beep.mp3');
	beep.load();
	beep.play();
	temp = document.getElementById('countdown');
	temp.innerHTML = seconds;
	timeoutMyOswego = setTimeout(countdown, 1000);
}
	
function assemblegif()
{
	var url="assemblegif.php";
	$.get(url); //assemble gif
}
	
$(document).ready(function(){
	countdown();
	setTimeout(function() {
		takegifPhotos();
		assemblegif();
		$(location).attr('href', './email.html?montagefile=montage.gif');
	}, 10000);
});