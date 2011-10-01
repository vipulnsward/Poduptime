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
//curl the header of pod with and without https

        $chss = curl_init();
        curl_setopt($chss, CURLOPT_URL, "https://".$row[0]); 
        curl_setopt($chss, CURLOPT_POST, 1);
        curl_setopt($chss, CURLOPT_HEADER, 1);
        curl_setopt($chss, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($chss, CURLOPT_NOBODY, 1);
        $outputssl = curl_exec($chss);      
        curl_close($chss);
        //echo $outputssl;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://".$row[0]);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_HEADER, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_NOBODY, 1);
        $output = curl_exec($ch);
        curl_close($ch);
        //echo $output;

if (stristr($outputssl, 'Set-Cookie: _diaspora_session=')) {
//this is a ssl pod
echo "ssl";$secure="true";$hidden="no";
preg_match('/X-Git-Update: (.*?)\n/',$outputssl,$xgitdate);
$gitdate = trim($xgitdate[1]);
preg_match('/X-Git-Revision: (.*?)\n/',$outputssl,$xgitrev);
$gitrev = trim($xgitrev[1]);
preg_match('/X-Runtime: (.*?)\n/',$outputssl,$xruntime);
$runtime = trim($xruntime[1]);
preg_match('/Server: (.*?)\n/',$outputssl,$xserver);
$server = trim($xserver[1]);
preg_match('/Content-Encoding: (.*?)\n/',$outputssl,$xencoding);
$encoding = trim($xencoding[1]);

} elseif (stristr($output, 'Set-Cookie: _diaspora_session=')) {
echo "not";$secure="false";$hidden="no";
} else {
echo "fail";$secure="false";$hidden="yes";
//no diaspora cookie on either, lets set this one as hidden and notify someone its not really a pod

}
$ip = escapeshellcmd('dig +nocmd '.$row[0].' aaaa +noall +short');
$ipnum = exec($ip);
$test = strpos($ipnum, ":");
if ($test === false) {
$ipv6="no";
} else {
$ipv6="yes";
}
echo $ipv6;


//curl the pingdom page 
        $ping = curl_init();
        curl_setopt($ping, CURLOPT_URL, $row[1]);
        curl_setopt($ping, CURLOPT_POST, 0);
        curl_setopt($ping, CURLOPT_HEADER, 1);
        curl_setopt($ping, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ping, CURLOPT_NOBODY, 0);
        curl_setopt($ping, CURLOPT_MAXCONNECTS, 5);
        curl_setopt($ping, CURLOPT_FOLLOWLOCATION, true);
        $pingdom = curl_exec($ping);
        curl_close($ping);
        //echo $pingdom;

//use existing code here but loose multi curl so a pod can be updated by itself 
//$gitdate = date('Y-m-d H:i:s');
//echo $gitdate;
     $sql = "UPDATE pods SET Hgitdate='$gitdate', Hencoding='$encoding', secure='$secure', hidden='$hidden', Hruntime='$runtime', Hgitref='$gitrev', ip='$ipnum', ipv6='$ipv6' WHERE domain='$row[0]'";
     $result = pg_query($dbh, $sql);
     if (!$result) {
         die("Error in SQL query: " . pg_last_error());
     }
    
     echo "Data successfully inserted!";

//if went ok set hidden=no else =yes

//end foreach


 }   
     pg_free_result($result);
    
     pg_close($dbh);

?>