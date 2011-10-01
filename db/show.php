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
 $sql = "SELECT * FROM pods";
 $result = pg_query($dbh, $sql);
 if (!$result) {
     die("Error in SQL query: " . pg_last_error());
 }   
 while ($row = pg_fetch_array($result)) {

     echo "<tr><td>" . $row["domain"] . "</td>";
     echo "<td>" . $row["status"] . "</td>";
     echo "<td>" . $row["hgitdate"] . "</td>";
     echo "<td>" . $row["uptime"] . "</td>";
     echo "<td>" . $row["monthsmonitored"] . "</td>";
     echo "<td>" . $row["responsetimelast7"] . "</td>";
     echo "<td>" . $row["ipv6"] . "</td></tr>";
 }
 pg_free_result($result);       
 pg_close($dbh);
?>
</tbody>
</table>