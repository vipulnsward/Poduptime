<!-- /* Copyright (c) 2011, David Morley. This file is licensed under the Affero General Public License version 3 or later. See the COPYRIGHT file. */ -->
<table id="myTable" class="tablesorter" width="75%">
<thead>
<tr>
<th width="220px">Diaspora Pod<a class="tipsy" title="A pod is a site for you to set up your account.">?</a></th>
<th>Live Status<a class="tipsy" title="Up or Down according to Pingdom">?</a></th>
<th>Last Code Pull<a class="tipsy" title="Because the alpha is updated everyday pods with old software will not work correcly with pods with new software. This is the date the p
od last updated from the main Diaspora code.">?</a></th>
<th>Uptime<a class="tipsy" title="Percent of the time the pod is online for <?php echo date("F") ?>.">?</a></th>
<th>Months<a class="tipsy" title="How many months has this pod been online? Click number for more history.">?</a></th>
<th>Response Time<a class="tipsy" title="Average response time for <?php echo date("F") ?>.">?</a></th>
<th>Ipv6<a class="tipsy" title="Does this pod look to have ipv6">?</a></th>
</tr>
</thead>
<tbody>
<?php
 include('config.php');
 $dbh = pg_connect("dbname=$pgdb user=$pguser password=$pgpass");
 if (!$dbh) {
     die("Error in connection: " . pg_last_error());
 }  
 if ($_GET['hidden'] == "true") {
 $sql = "SELECT * FROM pods WHERE hidden <> 'no'";
 } else {
 $sql = "SELECT * FROM pods WHERE hidden <> 'yes'";
 }
 $result = pg_query($dbh, $sql);
 if (!$result) {
     die("Error in SQL query: " . pg_last_error());
 }   
 while ($row = pg_fetch_array($result)) {
if ($row["secure"] == "true") {$method = "https://";$class="green";} else {$method = "http://";$class="red";} 
     echo "<tr><td><a class='$class' target='new' href='". $method . $row["domain"] ."'>" . $method . $row["domain"] . "</a></td>";
     echo "<td>" . $row["status"] . "</td>";
     echo "<td class='tipsy' title='Git Revision ".$row["hgitref"]."'><div id='".$row["hgitdate"]."' class='utc-timestamp'>" . strtotime($row["hgitdate"]) . "</div></td>";
     echo "<td>" . $row["uptimelast7"] . "</td>";
     echo "<td class='tipsy' title='Last Check ".$row["dateupdated"]." '><a target='new' href='".$row["pingdomurl"]."'>" . $row["monthsmonitored"] . "</a></td>";
     echo "<td>" . $row["responsetimelast7"] . "</td>";
     echo "<td class='tipsy' title='IP Address ".$row["ip"]." '>" . $row["ipv6"] . "</td></tr>\n";
 }
 pg_free_result($result);       
 pg_close($dbh);
?>
</tbody>
</table>