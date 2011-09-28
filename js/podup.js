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
  $('#add').fadeIn(6800);
  $('#others').fadeIn(2000);
  $( ".utc-timestamp" ).each(function() {
    $( this ).text( get_date( $( this ).text() ) );
  });
});

