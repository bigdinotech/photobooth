
$(document).ready(function() {
	
  var mode = readCookie("mode");
  if(mode == "simple")
  {
	$(location).attr('href', './takephotos.html');
  }
  else if(mode == "logo")
  {
	$(location).attr('href', './takephotos.html');
  }
  else if (mode == "special")
  {
	document.cookie = 'mode = twoframe';
	$(location).attr('href', './takephotos.html');
  }
  var gif = readCookie("enablegif");
  if(gif == "n")
  {
	document.getElementById('giflayout').style.visibility = "hidden";
  }
	
  $('.banner4').click(function() 
  {
	document.cookie = 'mode = banner';
    $(location).attr('href', './takephotos.html');
  });
  
  $('.largelogo').click(function() 
  {
	document.cookie = 'mode = logo';
    $(location).attr('href', './takephotos.html');
  });
  
  $('.gifmode').click(function() 
  {
	document.cookie = 'mode = gif';
    $(location).attr('href', './gifInfo.html');
  });

  $('#setupbuttonid').click(function() {
	$(location).attr('href', './index.html');
  });
  
});
