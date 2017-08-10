<?php
if(!isset($port))
	{
	$hostinfo=$ts3->hostInfo();
	if(!isset($_GET['refresh']) OR $_GET['refresh']=='on')
		{
	?>
	<meta http-equiv="refresh" content="3; URL=index.php?site=servertraffic">
<?php	} ?>
	<table align="center" style="width:50%" class="border" cellpadding="1" cellspacing="0">
		<tr>
			<td style="width:100%" class="thead" colspan="3"><?php echo $lang['instancetraffic']; ?></td>
		</tr>
		<tr>
			<td style="width:33%" class="thead"><?php echo $lang['description']; ?></td>
			<td style="width:33%" class="thead"><?php echo $lang['incoming']; ?></td>
			<td style="width:33%" class="thead"><?php echo $lang['outgoing']; ?></td>
		</tr>
		<tr>
			<td class="green1"><?php echo $lang['packetstransfered']; ?></td>
			<td class="green1 center"><?php echo $hostinfo['connection_packets_received_total']; ?></td>
			<td class="green1 center"><?php echo $hostinfo['connection_packets_sent_total']; ?></td>
		</tr>
		<tr>
			<td class="green2"><?php echo $lang['bytestransfered']; ?></td>
			<td class="green2 center"><?php echo conv_traffic($hostinfo['connection_bytes_received_total']); ?></td>
			<td class="green2 center"><?php echo conv_traffic($hostinfo['connection_bytes_sent_total']); ?></td>
		</tr>
		<tr>
			<td class="green1"><?php echo $lang['bandwidthlastsecond']; ?></td>
			<td class="green1 center"><?php echo conv_traffic($hostinfo['connection_bandwidth_received_last_second_total'])."/s"; ?></td>
			<td class="green1 center"><?php echo conv_traffic($hostinfo['connection_bandwidth_sent_last_second_total'])."/s"; ?></td>
		</tr>
		<tr>
			<td class="green2"><?php echo $lang['bandwidthlastminute']; ?></td>
			<td class="green2 center"><?php echo conv_traffic($hostinfo['connection_bandwidth_received_last_minute_total'])."/s"; ?></td>
			<td class="green2 center"><?php echo conv_traffic($hostinfo['connection_bandwidth_sent_last_minute_total'])."/s"; ?></td>
		</tr>
		<tr>
			<td class="green1"><?php echo $lang['filetransferbandwidth']; ?></td>
			<td class="green1 center"><?php echo conv_traffic($hostinfo['connection_filetransfer_bandwidth_received'])."/s"; ?></td>
			<td class="green1 center"><?php echo conv_traffic($hostinfo['connection_filetransfer_bandwidth_sent'])."/s"; ?></td>
		</tr>
		<tr>
			<td colspan="3">
			<?php 
			if(!isset($_GET['refresh']) OR $_GET['refresh']=='on')
				{
				echo "<a href=\"index.php?site=servertraffic&amp;refresh=off\">".$lang['stoprefresh']."</a>";
				}
				else
				{
				echo "<a href=\"index.php?site=servertraffic&amp;refresh=on\">".$lang['autorefresh']."</a>";
				}
			?>
			</td>
		</tr>
	</table>
<?php	
	} 
	else
	{
	$serverinfo=$ts3->serverInfo();
	if(!isset($_GET['refresh']) OR $_GET['refresh']=='on')
		{
	?>
	<meta http-equiv="refresh" content="3; URL=index.php?site=servertraffic&amp;port=<?php echo $port; ?>">
<?php	} ?>
	<table align="center" style="width:50%" class="border" cellpadding="1" cellspacing="0">
		<tr>
			<td style="width:100%" class="thead" colspan="3"><?php echo $lang['virtualtraffic']; ?></td>
		</tr>
		<tr>
			<td style="width:33%" class="thead"><?php echo $lang['description']; ?></td>
			<td style="width:33%" class="thead"><?php echo $lang['incoming']; ?></td>
			<td style="width:33%" class="thead"><?php echo $lang['outgoing']; ?></td>
		</tr>
		<tr>
			<td class="green1"><?php echo $lang['packetstransfered']; ?></td>
			<td class="green1 center"><?php echo $serverinfo['connection_packets_received_total']; ?></td>
			<td class="green1 center"><?php echo $serverinfo['connection_packets_sent_total']; ?></td>
		</tr>
		<tr>
			<td class="green2"><?php echo $lang['bytestransfered']; ?></td>
			<td class="green2 center"><?php echo conv_traffic($serverinfo['connection_bytes_received_total']); ?></td>
			<td class="green2 center"><?php echo conv_traffic($serverinfo['connection_bytes_sent_total']); ?></td>
		</tr>
		<tr>
			<td class="green1"><?php echo $lang['bandwidthlastsecond']; ?></td>
			<td class="green1 center"><?php echo conv_traffic($serverinfo['connection_bandwidth_received_last_second_total'])."/s"; ?></td>
			<td class="green1 center"><?php echo conv_traffic($serverinfo['connection_bandwidth_sent_last_second_total'])."/s"; ?></td>
		</tr>
		<tr>
			<td class="green2"><?php echo $lang['bandwidthlastminute']; ?></td>
			<td class="green2 center"><?php echo conv_traffic($serverinfo['connection_bandwidth_received_last_minute_total'])."/s"; ?></td>
			<td class="green2 center"><?php echo conv_traffic($serverinfo['connection_bandwidth_sent_last_minute_total'])."/s"; ?></td>
		</tr>
		<tr>
			<td class="green1"><?php echo $lang['filetransferbandwidth']; ?></td>
			<td class="green1 center"><?php echo conv_traffic($serverinfo['connection_filetransfer_bandwidth_received'])."/s"; ?></td>
			<td class="green1 center"><?php echo conv_traffic($serverinfo['connection_filetransfer_bandwidth_sent'])."/s"; ?></td>
		</tr>
		<tr>
			<td colspan="3">
			<?php 
			if(!isset($_GET['refresh']) OR $_GET['refresh']=='on')
				{
				echo "<a href=\"index.php?site=servertraffic&amp;port=".$port."&amp;refresh=off\">".$lang['stoprefresh']."</a>";
				}
				else
				{
				echo "<a href=\"index.php?site=servertraffic&amp;port=".$port."&amp;refresh=on\">".$lang['autorefresh']."</a>";
				}
			?>
			</td>
		</tr>
	</table>
<?php	
	} ?>