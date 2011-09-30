<?php
 include('config.php');
 $dbh = pg_connect("dbname=$pgdb user=$pguser password=$pgpass");
 if (!$dbh) {
     die("Error in connection: " . pg_last_error());
 }  
 $sql = "SELECT * FROM pods";
 $result = pg_query($dbh, $sql);
 if (!$result) {
     die("Error in SQL query: " . pg_last_error());
 }   
 while ($row = pg_fetch_array($result)) {
     echo "pod" . $row[1] . "<br />";
     echo "pingdom: " . $row[2] . "<p />";
 }   





 pg_free_result($result);       
 pg_close($dbh);






?>