<?php
//Copyright (c) 2011, David Morley. This file is licensed under the Affero General Public License version 3 or later. See the COPYRIGHT file.
if ($_GET['key'] != "4r45tg") {exit;}
 include('config.php');
 $dbh = pg_connect("dbname=$pgdb user=$pguser password=$pgpass");
 if (!$dbh) {
     die("Error in connection: " . pg_last_error());
 }  
 $sql = "SELECT * FROM pods WHERE hidden <> 'yes'";
 $result = pg_query($dbh, $sql);
 if (!$result) {
     die("Error in SQL query: " . pg_last_error());
 }   
$i=0;
 while ($row = pg_fetch_array($result)) {
 $numrows = pg_num_rows($result);
if ($row["status"] == "up"){$status="Online";}else{$status="Offline";}
if ($row["secure"] == "true") {$method = "https://";$class="green";} else {$method = "http://";$class="red";}
if ($_GET['format'] == "json") {
//json output

} else {
//text output, formated for android app
  echo $method.$row["domain"] ." - ".$status." Now - Up ".$row["uptimelast7"]." This Month";
  if ($i < ($numrows -1)) {
    echo ",";
  }
$i++;
 }
 }
 pg_free_result($result);       
 pg_close($dbh);
?>
