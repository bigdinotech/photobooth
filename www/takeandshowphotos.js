var timeoutHandler;

$(document).ready(function() {
  var timeoutTime = 300000;
  timeoutHandler = window.setTimeout(function() {
    $(location).attr('href', './print.html');
  }, timeoutTime);

  $('.printbutton').click(function() {
    $(location).attr('href', './print.html');
  });
  
  $('#iframeContainer0').click(function() {
    var filename = 'image0.jpg'
	window.clearTimeout(timeoutHandler);
	timeoutHandler = window.setTimeout(30000);

	document.getElementById('imageframe0').contentWindow.document.location.href="countdown.html";
	setTimeout(function() { 
	  //your_func();
	  takePhoto(filename);
	  document.getElementById('imageframe0').contentWindow.document.location.href="image0.php";
	}, 5000);
  });
  
  $('#iframeContainer1').click(function() {
    var filename = 'image1.jpg'
	window.clearTimeout(timeoutHandler);
	timeoutHandler = window.setTimeout(30000);
	document.getElementById('imageframe1').contentWindow.document.location.href="countdown.html";
	setTimeout(function() { 
	  //your_func();
	  takePhoto(filename);
	  document.getElementById('imageframe1').contentWindow.document.location.href="image1.php";
	}, 5000);
  });
  
  $('#iframeContainer2').click(function() {
    var filename = 'image2.jpg'
	window.clearTimeout(timeoutHandler);
	timeoutHandler = window.setTimeout(30000);
	document.getElementById('imageframe2').contentWindow.document.location.href="countdown.html";
	setTimeout(function() { 
	  //your_func();
	  takePhoto(filename);
	  document.getElementById('imageframe2').contentWindow.document.location.href="image2.php";
	}, 5000);
  });
  
  $('#iframeContainer3').click(function() {
    var filename = 'image3.jpg'
	window.clearTimeout(timeoutHandler);
	timeoutHandler = window.setTimeout(30000);
	document.getElementById('imageframe3').contentWindow.document.location.href="countdown.html";
	setTimeout(function() { 
	  takePhoto(filename);
	  document.getElementById('imageframe3').contentWindow.document.location.href="image3.php";
	}, 5000);
  });
  
});

function takePhoto(filename){
	var url="takedslrphoto.php?photofilename=";
	$.get(url.concat(filename)); //take photo
}

function takeFourPhotos(){
	setTimeout(function() {
		console.log("image0");
		document.getElementById('imageframe0').contentWindow.document.location.href="countdown.html";
		setTimeout(function() {
			var filename = 'image0.jpg';
			takePhoto(filename);
			document.getElementById('imageframe0').contentWindow.document.location.href="image0.php";
		}, 5000);
		setTimeout(function() {
			console.log("image1");
			document.getElementById('imageframe1').contentWindow.document.location.href="countdown.html";
			setTimeout(function() { 
				var filename = 'image1.jpg';
				takePhoto(filename);
				document.getElementById('imageframe1').contentWindow.document.location.href="image1.php";
			}, 5000);
			setTimeout(function() {
				console.log("image2");
				document.getElementById('imageframe2').contentWindow.document.location.href="countdown.html";
				setTimeout(function() {
					var filename = 'image2.jpg';
					takePhoto(filename);
					document.getElementById('imageframe2').contentWindow.document.location.href="image2.php";
				}, 5000);
				setTimeout(function() {
					console.log("image3");
					document.getElementById('imageframe3').contentWindow.document.location.href="countdown.html";
					setTimeout(function() {
						var filename = 'image3.jpg';
						takePhoto(filename);
						document.getElementById('imageframe3').contentWindow.document.location.href="image3.php";
						document.getElementById('instructiontr').style.visibility = "visible";
					}, 5000);
				}, 15000);
			}, 15000);
		}, 15000);
	}, 15000);
}

function takeanddisplayphoto(index) {
	var fileID = 'image' + index;
	var imageLoader = fileID + '.php'
	var fname = fileID + '.jpg'
	var imageFrame = 'imageframe' + index;
	console.log(fname);
	takePhoto(fname);
	document.getElementById(imageFrame).contentWindow.document.location.href=imageLoader
}
function displayPlaceholders() {
	document.getElementById('imageframe0').contentWindow.document.location.href="imageplaceholder.php";
	document.getElementById('imageframe1').contentWindow.document.location.href="imageplaceholder.php";
	document.getElementById('imageframe2').contentWindow.document.location.href="imageplaceholder.php";
	document.getElementById('imageframe3').contentWindow.document.location.href="imageplaceholder.php";
}
$(document).ready(function(){
	document.getElementById('instructiontr').style.visibility = "hidden";
	displayPlaceholders();
	setTimeout(function() {
		takeFourPhotos();
	}, 1000);
	console.log("done 4 photos?");
    
});
