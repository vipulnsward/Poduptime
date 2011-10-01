<?php
 include('config.php');
 $dbh = pg_connect("dbname=$pgdb user=$pguser password=$pgpass");
     if (!$dbh) {
         die("Error in connection: " . pg_last_error());
     }
//foreach pod check it and update db    
 $sql = "SELECT domain,pingdomurl FROM pods";
 $result = pg_query($dbh, $sql);
 if (!$result) {
     die("Error in SQL query: " . pg_last_error());
 }
 while ($row = pg_fetch_array($result)) {
     echo "pod" . $row[0] . "<br />";
     echo "pingdom: " . $row[1] . "<p />";
 
//use existing code here but loose multi curl so a pod can be updated by itself 
$gitdate = date('Y-m-d H:i:s');
echo $gitdate;
     $sql = "UPDATE pods SET Hgitdate='$gitdate' WHERE domain='$row[0]'";
     $result = pg_query($dbh, $sql);
     if (!$result) {
         die("Error in SQL query: " . pg_last_error());
     }
    
     echo "Data successfully inserted!";
//end foreach
 }   
     pg_free_result($result);
    
     pg_close($dbh);

?>