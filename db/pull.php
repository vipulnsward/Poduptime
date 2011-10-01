<!-- /* Copyright (c) 2011, David Morley. This file is licensed under the Affero General Public License version 3 or later. See the COPYRIGHT file. */ -->
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

//curl the pingdom page 
        $ping = curl_init();
        $thismonth = "/".date("Y")."/".date("m");
        curl_setopt($ping, CURLOPT_URL, $row[1].$thismonth);
        curl_setopt($ping, CURLOPT_POST, 0);
        curl_setopt($ping, CURLOPT_HEADER, 1);
        curl_setopt($ping, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ping, CURLOPT_NOBODY, 0);
        curl_setopt($ping, CURLOPT_MAXCONNECTS, 5);
        curl_setopt($ping, CURLOPT_FOLLOWLOCATION, true);
        $pingdom = curl_exec($ping);
        curl_close($ping);
        //echo $pingdom;

//response time
preg_match_all('/<h3>Avg. resp. time this month<\/h3>
<p class="large">(.*?)</',$pingdom,$matcheach);
$responsetime = $matcheach[1][0];

//months monitored
preg_match_all('/<option value=(.*?)</i',$pingdom,$matchdates);
$months = count($matchdates[0]);

//uptime %
preg_match_all('/<h3>Uptime this month<\/h3>
<p class="large">(.*?)</',$pingdom,$matchper);
$uptime = preg_replace("/,/", ".", $matchper[1][0]);
echo $uptime;
//last check
preg_match_all('/<h3>Last checked<\/h3>
<p>(.*?)</',$pingdom,$matchdate);
$pingdom_timestamp = $matchdate[1][0];
if ($pingdom_timestamp) {
echo $pingdom_timestamp;$pingdomdate = $pingdom_timestamp;
}
else {
$splitdate = explode(" ",$matchdate[1][0]);
$newtimestamp = $splitdate[0];
#$dateTime = DateTime::createFromFormat('d/m/Y H:i:s', $matchdate[1][0]);
#$newunpin = strtotime($dateTime->format('Y-m-d h:i:s a'));
echo $splitdate[0];$pingdomdate = $splitdate[0];
}
//status
if (strpos($pingdom,"class=\"up\"")) { $live="up"; }
elseif (strpos($pingdom,"class=\"down\"")) { $live="down"; }
elseif (strpos($pingdom,"class=\"paused\"")) { $live="paused";}
else {$live="error";}


//sql it
     $timenow = date('Y-m-d H:i:s');
     $sql = "UPDATE pods SET Hgitdate='$gitdate', Hencoding='$encoding', secure='$secure', hidden='$hidden', Hruntime='$runtime', Hgitref='$gitrev', ip='$ipnum', ipv6='$ipv6', monthsmonitored='$months', uptimelast7='$uptime', status='$live', dateLaststats='$pingdomdate', dateUpdated='$timenow', responsetimelast7='$responsetime' WHERE domain='$row[0]'";
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