$(document).ready(function() {
	
	$('#eventnameid').keyboard({
		layout: 'qwerty',
		autoAccept : true
	})
	.addTyping();
	$('#eventmessageid').keyboard({
		layout: 'qwerty',
		autoAccept : true
	})
	.addTyping();
	console.log("enabling onscreenkeyboard");


});


