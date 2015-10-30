
$(document).ready(function() {
  var url = './takeandshowphotos.html';
  $('html').click(function() {
    $('body').fadeOut(2000, function() {
      $(location).attr('href', url);
    });
  });
});
