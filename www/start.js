$(document).ready(function() {
  $(document).click(function() {
    $('.everything').fadeOut(2000, function() {
      var url = "./info.html"
      $(location).attr('href', url);
    });
  });
});
