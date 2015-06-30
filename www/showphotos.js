$(document).ready(function() {
  var timeoutTime = 20000;
  window.setTimeout(function() {
    $(location).attr('href', './print.html');
  }, timeoutTime);

  $('#1').click(function() {
    $(location).attr('href', './takephotos.html?PHOTO=1');
  });
  $('#2').click(function() {
    $(location).attr('href', './takephotos.html?PHOTO=2');
  });
  $('#3').click(function() {
    $(location).attr('href', './takephotos.html?PHOTO=3');
  });
  $('#4').click(function() {
    $(location).attr('href', './takephotos.html?PHOTO=4');
  });

  $('.printbutton').click(function() {
    $(location).attr('href', './print.html');
  });
});
