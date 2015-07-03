var timeoutTime = 8000;

$(document).ready(function() {
  var url = './takeandshowphotos.html';
  window.setTimeout(function() {
    $('body').fadeOut(2000, function() {
      $(location).attr('href', url);
    });
  }, timeoutTime);

  $('html').click(function() {
    $('body').fadeOut(2000, function() {
      $(location).attr('href', url);
    });
  });
});
