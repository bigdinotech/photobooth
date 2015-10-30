function sendEmail(){
	var url="sendEmail.php";
	$.get(url); //take photo
	$(location).attr('href', './info.html');
}

$(document).ready(function(){
	/**
	var timeoutTime = 15000;
	timeoutHandler = window.setTimeout(function() {
    $(location).attr('href', './info.html');
	}, timeoutTime);
	sendEmail();
	**/
});

