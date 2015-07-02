$(document).ready(function() {
  var timeoutTime = 300000;
  window.setTimeout(function() {
    $(location).attr('href', './print.html');
  }, timeoutTime);

  $('.printbutton').click(function() {
    $(location).attr('href', './print.html');
  });
  
  $('#iframeContainer0').click(function() {
    var filename = 'image0.jpg'
	takePhoto(filename);
	window.clearTimeout();
	window.setTimeout(300000);
	document.getElementById('imageframe0').contentWindow.location.reload();
  });
  
  $('#iframeContainer1').click(function() {
    var filename = 'image1.jpg'
	takePhoto(filename);
	window.clearTimeout();
	window.setTimeout(300000);
	document.getElementById('imageframe1').contentWindow.location.reload();
  });
  
  $('#iframeContainer2').click(function() {
    var filename = 'image2.jpg'
	takePhoto(filename);
	window.clearTimeout();
	window.setTimeout(300000);
	document.getElementById('imageframe2').contentWindow.location.reload();
  });
  
  $('#iframeContainer3').click(function() {
    var filename = 'image3.jpg'
	takePhoto(filename);
	window.clearTimeout();
	window.setTimeout(300000);
	document.getElementById('imageframe3').contentWindow.location.reload();
  });
  
});

function takePhoto(filename){
	var url="takedslrphoto.php?photofilename=";
	$.get(url.concat(filename)); //take photo
}
