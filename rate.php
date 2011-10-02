<html><head>
<!script type="text/javascript" src="/js/jquery-1.6.4.min.js"></script>
<!script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js"></script> 
  <!link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>
<!link rel="stylesheet" href="http://twitter.github.com/bootstrap/1.3.0/bootstrap.min.css">
  <style type="text/css">
    #slider { margin: 10px;width:250px;display:inline-block; }
    #rating { height: 30px;width:30px; }
  </style>
  <script>
  $(document).ready(function() {
    $("#slider").slider({ animate: true, max: 10, min: 1, step: 1, value: 10, stop: function(event, ui) { 
var value = $( "#slider" ).slider( "option", "value" );
$("#rating").prop( "value", value )

} });
  });
  </script>
</head>
<body>
<div style="height:500px;width:900px">
<?php
 include('db/config.php');
 $dbh = pg_connect("dbname=$pgdb user=$pguser password=$pgpass");
 if (!$dbh) {
     die("Error in connection: " . pg_last_error());
 }  
 if ($_GET['domain']) {
 $domain = $_GET['domain'];
 $sql = "SELECT * FROM rating_comments WHERE domain = '$domain'";
 } 
 $result = pg_query($dbh, $sql);
 if (!$result) {
     die("Error in SQL query: " . pg_last_error());
 }   
 $numrows = pg_num_rows($result); 
echo "<h2>".$_GET["domain"]."</h2>"; 
if (!$numrows) {echo "<b>This pod has no rating yet!</b>";}
 while ($row = pg_fetch_array($result)) {
 if ($row["admin"] == 1) {
echo "Poduptime Comment - User: <b>".$row["username"]."</b> Url: <a href='".$row["userurl"]."'>".$row["userurl"]."</a> Rating: <b>".$row["rating"]."</b> <br>";
echo "<i>".$row["comment"]."</i><br><br>";
 } elseif ($row["admin"] == 0) {
echo "Poduptime Comment - User: <b>".$row["username"]."</b> Url: <a href='".$row["userurl"]."'>".$row["userurl"]."</a> Rating: <b>".$row["rating"]."</b> <br>";
echo "<i>".$row["comment"]."</i><br><br>";
 }
}
echo <<<EOF
<div id="commentform">
Would you like to add a comment? (diaspora login comming)<br>
Your Name (or Diaspora handle)?<br><input name="username"><br>
Comment<br><textarea name="comments"></textarea><br>
Rating (1-10 scale, 10 high)<br><div id="slider"></div><input class="disabled" disabled="" id="rating" name="rating" value="10">
<input class="btn primary" type="submit" value="Submit your Rating">
</div>
EOF;

 
 pg_free_result($result);       
 pg_close($dbh);
?>
</div>