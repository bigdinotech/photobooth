var timeoutHandler;

$(document).ready(function() {
  var timeoutTime = 300000;
  timeoutHandler = window.setTimeout(function() {
    $(location).attr('href', './assemblelogo.html');
  }, timeoutTime);

  $('.printbutton').click(function() {
    $(location).attr('href', './assemblelogo.html');
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
  
});

function takePhoto(filename){
	var url="takedslrphoto.php?photofilename=";
	$.get(url.concat(filename)); //take photo
}

function takePhotos(){
	var photoCount = 3;
	var imageID = 0;
	(function photoLoop (photoCount, imageID) {
		var filename = "image";
		var iframe = "imageframe";
		var imageLoader = "image";
		setTimeout(function () {   
			filename = "image" + imageID + ".jpg";
			iframe = 'imageframe' + imageID;
			document.getElementById(iframe).contentWindow.document.location.href="countdown.html";
			setTimeout(function() {
				takePhoto(filename);
				imageLoader = "image" + (imageID-1) + ".php";
				document.getElementById(iframe).contentWindow.document.location.href=imageLoader;
			}, 5000);
			imageID++;
		  if (--photoCount) photoLoop(photoCount, imageID);
		  if(photoCount == 0)
		  {
			setTimeout(function() {
			  document.getElementById('instructiontd').innerHTML= "<p><strong>RETAKING</strong>: Click on the desired picture to be retaken.</p><p><strong>PRINT</strong>: Click on the Print button.</p>";
		      document.getElementById('buttontd').style.visibility = "visible";
	        }, 12000);
			enableRetake();
		  }
	   }, 10000)
	})(photoCount, imageID);
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

function initializePhotoGrid() {
	document.getElementById('imageframe0').contentWindow.document.location.href="imageplaceholder.php";
	document.getElementById('imageframe1').contentWindow.document.location.href="imageplaceholder.php";
	document.getElementById('imageframe2').contentWindow.document.location.href="imageplaceholder.php";
	document.getElementById('imageframe3').contentWindow.document.location.href="imagelogo.php";
	document.getElementById('buttontd').style.visibility = "hidden";
	document.getElementById('instructiontd').innerHTML= "<p>Please look at the DSLR camera not the one on the tablet</p><p>4 Photos will automatically be taken</p>";
	disableRetake();
}

function disableRetake()
{
	document.getElementById('iframeContainer0').style.pointerEvents = 'none';
	document.getElementById('iframeContainer1').style.pointerEvents = 'none';
	document.getElementById('iframeContainer2').style.pointerEvents = 'none';
	document.getElementById('iframeContainer3').style.pointerEvents = 'none';
}

function enableRetake()
{
	document.getElementById('iframeContainer0').style.pointerEvents = 'all';
	document.getElementById('iframeContainer1').style.pointerEvents = 'all';
	document.getElementById('iframeContainer2').style.pointerEvents = 'all';
}

$(document).ready(function(){
	initializePhotoGrid();
	setTimeout(function() {
		takePhotos();
	}, 1000); 
});
