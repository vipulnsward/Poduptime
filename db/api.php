<?php
//Copyright (c) 2011, David Morley. This file is licensed under the Affero General Public License version 3 or later. See the COPYRIGHT file.
if ($_GET['key'] != "4r45tg") {exit;}
 include('config.php');
 $dbh = pg_connect("dbname=$pgdb user=$pguser password=$pgpass");
 if (!$dbh) {
     die("Error in connection: " . pg_last_error());
 }  
if ($_GET['format'] == "json") {
 $i=0;
 $sql = "SELECT * FROM pods";
 $result = pg_query($dbh, $sql);
 if (!$result) {
     die("Error in SQL query: " . pg_last_error());
 }
 $numrows = pg_num_rows($result);
//json output WIP
header('Content-type: application/json');
echo '{';
echo '"podcount": '.json_encode($numrows);
//
echo '"pods": [';
 while ($row = pg_fetch_array($result)) {

  echo '{';
  echo '"url":"'.$method.$row["domain"].'",';
  echo '"email":"private",';
  echo '"whois":"'.$method.$row["whois"].'",';
  echo '"city":"'.$method.$row["city"].'",';
  echo '"state":"'.$method.$row["state"].'",';
  echo '"country":"'.$method.$row["country"].'",';
  echo '"latutude":"'.$method.$row["lat"].'",';
  echo '"longitude":"'.$method.$row["long"].'",';
  echo '"postalcode":"'.$method.$row["postalcode"].'",';
  echo '"connection":"'.$method.$row["connection"].'",';
  echo '"SSL Valid":"'.$method.$row["sslvalid"].'",';
  echo '"secure":"'.$method.$row["secure"].'",';
  echo '"status":"'.$method.$row["status"].'",';
  echo '"ip":"'.$method.$row["ip"].'",';
  echo '"ipv6":"'.$method.$row["ipv6"].'",';
  echo '"Git Last":"'.$method.$row["hgitdate"].'",';
  echo '"Git Rev":"'.$method.$row["hgitref"].'",';
  echo '"Pingdom Url":"'.$method.$row["pingdomurl"].'",';
  echo '"Pingdom Last":"'.$method.$row["pingdomlast"].'",';
  echo '"Months Monitored":'.$method.$row["monthsmonitored"].',';
  echo '"Uptime":"'.$method.$row["uptimelast7"].'",';
  echo '"Responsetime":"'.$method.$row["responsetimelast7"].'",';
  echo '"Server Runtime":"'.$method.$row["hruntime"].'",';
  echo '"Server Encoding":"'.$method.$row["hencoding"].'",';
  echo '"Date Added":"'.$method.$row["dateCreated"].'",';
  echo '"Date Updated":"'.$method.$row["dateUpdated"].'",';
  echo '"Date Stats Updated":"'.$method.$row["dateLaststats"].'",';
  echo '"hidden":"'.$method.$row["hidden"].'"';

//
//
  echo '}';
if ($i < ($numrows -1)) {
  echo ',';
}
$i++;
}
echo ']';

echo '}';
} else {
 $i=0;
 $sql = "SELECT * FROM pods WHERE hidden <> 'yes' ORDER BY Hgitdate DESC, uptimelast7 DESC";
 $result = pg_query($dbh, $sql);
 if (!$result) {
     die("Error in SQL query: " . pg_last_error());
 }
 $numrows = pg_num_rows($result);
 while ($row = pg_fetch_array($result)) {
  if ($row["status"] == "up"){$status="Online";}else{$status="Offline";} 
  if ($row["secure"] == "true") {$method = "https://";$class="green";} else {$method = "http://";$class="red";}
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
