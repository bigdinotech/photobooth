$(document).ready(function() {
	var username = 	readCookie("credentialusername");
	var pass = readCookie("credentialpass");
	console.log(document.cookie);
	if(username != null)
	{
		document.getElementById("emailcredentialid").value = username;
	}
	if(pass !=null)
	{
		document.getElementById("passcredentialid").value = pass;
	}
	
	if(!(readCookie("onscreenkeyboard")=='n'))
	{
	  $('#emailcredentialid').keyboard({
			layout: 'qwerty',
			autoAccept : true
		})
		.addTyping();
		
	  $('#passcredentialid').keyboard({
			layout : 'qwerty',
			autoAccept : true
		})
		.addTyping();
		console.log("enabling onscreenkeyboard");
	}
  $('#start').click(function() {
	if(document.getElementById("emailcheckboxid").checked)
	{
		createCookie("email",'y');
	}
	else
	{
		createCookie("email",'n');
	}
	if(document.getElementById("mmscheckboxid").checked)
	{
		createCookie("mms",'y');
	}
	else
	{
		createCookie("mms",'n');
	}
	if(document.getElementById("printcheckboxid").checked)
	{
		createCookie("print",'y');
	}
	else
	{
		createCookie("print",'n');
	}
	if(readCookie("email") == "y")
	{
		createCookie("credentialusername", document.getElementById("emailcredentialid").value);
		createCookie("credentialpass", document.getElementById("passcredentialid").value);
	}
	if(document.getElementById("autotakeid").checked)
	{
		createCookie("autotake",'auto');
	}
	else
	{
		createCookie("autotake",'manual');
	}
	if(document.getElementById("onscreenkeyboardid").checked)
	{
		createCookie("onscreenkeyboard",'y');
	}
	else
	{
		createCookie("onscreenkeyboard",'n');
	}
	/**
	if(document.getElementById("enablegifid").checked)
	{
		createCookie("enablegif",'y');
	}
	else
	{
		createCookie("enablegif",'n');
	}
	if(document.getElementById("defaultmodeid").checked)
	{
		createCookie("mode",'default');
	}
	if(document.getElementById("simplemodeid").checked)
	{
		createCookie("mode",'simple');
	}
	if(document.getElementById("simplelogoid").checked)
	{
		createCookie("mode",'logo');
	}
	if(document.getElementById("multiplelogosid").checked)
	{
		createCookie("multilogo",'y');
	}
	else
	{
		createCookie("multilogo",'n');
	}
	**/
	if(document.getElementById("dslrcameraselectid").checked)
	{
		createCookie("camera",'dslr');
	}
	if(document.getElementById("picameraselectid").checked)
	{
		createCookie("camera",'picam');
	}
	createCookie("mode",'logo');
	console.log(document.cookie);
    //$(location).attr('href', './info.html');
	$(location).attr('href', './takephotos.html');
  });
});

function createCookie(name,value,days) {
	if (days) {
	var date = new Date();
	date.setTime(date.getTime()+(days*24*60*60*1000));
	var expires = "; expires="+date.toGMTString();
	}
	else var expires = "";
	document.cookie = name+"="+value+expires+"; path=/";
}

function readCookie(name) {
	var nameEQ = name + "=";
	var ca = document.cookie.split(';');
	for(var i=0;i < ca.length;i++) {
		var c = ca[i];
		while (c.charAt(0)==' ') c = c.substring(1,c.length);
		if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
	}
	return null;
}

function eraseCookie(name) {
	createCookie(name,"",-1);
}
