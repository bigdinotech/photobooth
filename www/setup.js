$(document).ready(function() {
  $('#picam').click(function() {
    //$(location).attr('href', './start.html');
    $('.infobox').append("Raspberry Pi config loaded.<br/>");
  });
  $('#dslrcam').click(function() {
    //$(location).attr('href', './start.html');
    $('.infobox').append("DSLR Cam config loaded.<br/>");
  });
  $('#manualdslr').click(function() {
    //$(location).attr('href', './start.html');
    $('.infobox').append("Manual DSLR config loaded.<br/>");
  });

  $('#start').click(function() {
    $(location).attr('href', './info.html');
  });
});
