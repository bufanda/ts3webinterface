
<table border="0" style="width:1000px; height:100px" cellpadding="0" cellspacing="0">
	<tr valign="top">
		<td class="header">
		<table style="width:100%">
			<tr>
				<td><?php include('site/fastswitch.php'); ?></td>
				<td style="text-align:right">
				<?php
				if ($loginstatus===true)
					{
					echo $_SESSION['loginuser']; ?> <a href="index.php?site=logout"><?php echo $lang['logout']; ?></a>
				<?php } ?>	
				</td>
			</tr>
		</table>
		</td>
	</tr>
</table>
