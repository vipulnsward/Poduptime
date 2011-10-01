function get_date(timestamp) {
  var date = new Date(timestamp * 1000);
  return [date.getDate(),date.getMonth() + 1, date.getFullYear()].join('/');
}
$(document).ready(function(){
  $('.tipsy').tipsy();
  $('#add').click(function() {
    $('#howto').show('slow'); $('#add').hide('slow');$('#content').hide('slow');
  });
  $("#myTable").tablesorter( {sortList: [[3,1], [4,1]]} );
  $('#add').delay(8000).fadeIn(2000);
  $('#others').delay(8000).fadeIn(2000);
  $('#buttonsy').delay(5550).slideDown(3330);
  $('#title').delay(5000).slideUp(2333);
  $( ".utc-timestamp" ).each(function() {
    $( this ).text( get_date( $( this ).text() ) );
  });
});

