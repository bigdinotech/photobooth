var timeoutTime = 8000;

$(document).ready(function() {
  var url = './takephotos.html?PHOTO=1';
  window.setTimeout(function() {
    $('.info').fadeOut(2000, function() {
      $(location).attr('href', url);
    });
  }, timeoutTime);

  $('html').click(function() {
    $('.info').fadeOut(2000, function() {
      $(location).attr('href', url);
    });
  });
});

function gotophotos() {
  var url = './takephotos.html?PHOTO=99';
  $(location).attr('href', url);
}
