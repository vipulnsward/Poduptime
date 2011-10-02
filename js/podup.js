function get_date(timestamp) {
  var date = new Date(timestamp * 1000);
  return [date.getMonth()+1,date.getDate(), date.getFullYear()].join('/');
}
$(document).ready(function(){
$.facebox.settings.closeImage = '/vendor/facebox/src/closelabel.png'
$.facebox.settings.loadingImage = '/vendor/facebox/src/loading.gif'
  $('a[rel*=facebox]').facebox()
  $('.tipsy').tipsy();
  $('#add').click(function() {
    $('#howto').show('slow'); $('#add').hide('slow');$('#results').hide('slow');
  });
  $("#myTable").tablesorter( {sortList: [[2,1], [3,1]]} );
  $('#add').delay(8000).fadeIn(2000);
  $('#others').delay(8000).fadeIn(2000);
  $('#buttonsy').delay(5550).slideDown(3330);
  $('#title').delay(5000).slideUp(2333);
  $( ".utc-timestamp" ).each(function() {
    $( this ).text( get_date( $( this ).text() ) );
  });
});

