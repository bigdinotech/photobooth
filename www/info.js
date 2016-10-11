
$(document).ready(function() {
	
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
