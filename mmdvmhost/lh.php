<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/config/config.php';          //MMDVMDash Config
include_once $_SERVER['DOCUMENT_ROOT'].'/mmdvmhost/tools.php';        //MMDVMDash Tools
include_once $_SERVER['DOCUMENT_ROOT'].'/mmdvmhost/functions.php';    //MMDVMDash Functions
?>
<b>Last 20 calls heard via this Gateway</b>
  <table>
    <tr>
      <th><a class="tooltip" href="#">Time (<?php echo date('T')?>)<span><b>Time in <?php echo date('T')?> time zone</b></span></a></th>
      <th><a class="tooltip" href="#">Mode<span><b>Transmitted Mode</b></span></a></th>
      <th><a class="tooltip" href="#">Callsign<span><b>Callsign</b></span></a></th>
      <th><a class="tooltip" href="#">Target<span><b>Target, D-Star Reflector, DMR Talk Group etc</b></span></a></th>
      <th><a class="tooltip" href="#">Src<span><b>Recieved from source</b></span></a></th>
      <th><a class="tooltip" href="#">Dur(s)<span><b>Duration in Seconds</b></span></a></th>
      <th><a class="tooltip" href="#">Loss<span><b>Packet Loss</b></span></a></th>
      <th><a class="tooltip" href="#">BER<span><b>Bit Error Rate</b></span></a></th>
    </tr>
<?php
$i = 0;
for ($i = 0;  ($i <= 19); $i++) { //Last 20 calls
	if (isset($lastHeard[$i])) {
		$listElem = $lastHeard[$i];
		if ( $listElem[2] ) {
			$utc_time = $listElem[0];
                        $utc_tz =  new DateTimeZone('UTC');
                        $local_tz = new DateTimeZone(date_default_timezone_get ());
                        $dt = new DateTime($utc_time, $utc_tz);
                        $dt->setTimeZone($local_tz);
                        $local_time = $dt->format('Y-m-d H:i:s');
		echo"<tr>";
		echo"<td align=\"left\">$local_time</td>";
		echo"<td align=\"left\">$listElem[1]</td>";
		if ( $listElem[3] && $listElem[3] != '    ' ) {
			echo "<td align=\"left\"><a href=\"http://www.qrz.com/db/$listElem[2]\" target=\"_blank\">$listElem[2]</a>/$listElem[3]</td>";
		} else {
			echo "<td align=\"left\"><a href=\"http://www.qrz.com/db/$listElem[2]\" target=\"_blank\">$listElem[2]</a></td>";
		}

		if ( substr($listElem[4], 0, 6) === 'CQCQCQ' ) {
			echo "<td align=\"left\">$listElem[4]</td>";
		} else {
			echo "<td align=\"left\">".str_replace(" ","&nbsp;", $listElem[4])."</td>";
		}


		if ($listElem[5] == "RF"){
			echo "<td style=\"background:#1d1;\">RF</td>";
		}else{
			echo "<td>$listElem[5]</td>";
		}
		if ($listElem[6] == null) {
				echo "<td style=\"background:#f33;\">TX</td><td></td><td></td>";
			} else if ($listElem[6] == "SMS") {
				echo "<td style=\"background:#1d1;\">SMS</td><td></td><td></td>";
			} else {
			echo "<td>$listElem[6]</td>";
			echo "<td>$listElem[7]</td>";
			echo "<td>$listElem[8]</td>";
		}
		echo"</tr>\n";
		}
	}
}

?>
  </table>
