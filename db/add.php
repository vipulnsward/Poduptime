<!-- /* Copyright (c) 2011, David Morley. This file is licensed under the Affero General Public License version 3 or later. See the COPYRIGHT file. */ -->
<?php
 include('config.php');
if (!$_POST['url']){
  echo "no url given";
 die;
}
if (!$_POST['email']){
  echo "no email given";
 die;
}
if (!$_POST['domain']){
  echo "no pod domain given";
 die;
}

 $dbh = pg_connect("dbname=$pgdb user=$pguser password=$pgpass");
     if (!$dbh) {
         die("Error in connection: " . pg_last_error());
     }
 $sql = "SELECT domain,pingdomurl FROM pods";
 $result = pg_query($dbh, $sql);
 if (!$result) {
     die("Error in SQL query: " . pg_last_error());
 }
 while ($row = pg_fetch_array($result)) {
if ($row["domain"] == $_POST['domain']) {
echo "domain already exists";die;
}
if ($row["pingdomurl"] == $_POST['url']) {
echo "pingdom report already exists";die;
}
 }

    
     $pingdomurl = pg_escape_string($_POST['url']);
     $domain = pg_escape_string($_POST['domain']);
     $email = pg_escape_string($_POST['email']);
    
     $sql = "INSERT INTO pods (domain, pingdomurl, email) VALUES('$domain', '$pingdomurl', '$email')";
     $result = pg_query($dbh, $sql);
     if (!$result) {
         die("Error in SQL query: " . pg_last_error());
     }
     $to = $adminemail;
     $subject = "New pod added to poduptime ";
     $message = "http://podupti.me\n\n Pingdom Url:" . $_POST["url"] . "\n\n Pod:" . $_POST["domain"] . "\n\n";
     $headers = "From: ".$_POST["email"]."\r\nReply-To: ".$_POST["email"]."\r\n";
     @mail( $to, $subject, $message, $headers );    

     echo "Data successfully inserted! Your pod will be reviewed and live on the list soon!";
    
     pg_free_result($result);
    
     pg_close($dbh);

?>