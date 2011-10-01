<?php
 include('config.php');
 $dbh = pg_connect("dbname=$pgdb user=$pguser password=$pgpass");
     if (!$dbh) {
         die("Error in connection: " . pg_last_error());
     }
    
     $pingdomurl = pg_escape_string($_POST['url']);
     $domain = pg_escape_string($_POST['domain']);
     $email = pg_escape_string($_POST['email']);
    
     $sql = "INSERT INTO pods (domain, pingdomurl, email) VALUES('$domain', '$pingdomurl', '$email')";
     $result = pg_query($dbh, $sql);
     if (!$result) {
         die("Error in SQL query: " . pg_last_error());
     }
    
     echo "Data successfully inserted!";
    
     pg_free_result($result);
    
     pg_close($dbh);

?>