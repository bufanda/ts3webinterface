<?php
if(isset($_POST['upload']))
	{
	$icon=@getimagesize($_FILES['thefile']['tmp_name']);
	if($icon!=false)
		{
		if($icon[0]<=16 or $icon[1]<=16)
			{
			$filename="icon_".mt_rand(1000000000, 2147483647);
			if(move_uploaded_file($_FILES['thefile']['tmp_name'],"temp/".$filename))
				{
				echo $lang['iconadd']."<br />";
				}
			$ft2=$ts3->ftInitUpload(0, $_FILES['thefile']['size'], "/".$filename);
			$file=file_get_contents("temp/".$filename);
			$con_ft=fsockopen($_SESSION['server_ip'], $ft2[0]['port'], $errnum, $errstr, 10);
			fputs($con_ft, $ft2[0]['ftkey']);
			fputs($con_ft, $file);
			unlink("temp/".$filename);
			fclose($con_ft);
			}
			else
			{
			echo $lang['iconmaxsize']."<br />";
			}
		}
		else
		{
		echo $lang['notapic']."<br />";
		}
	}
	
?>
<table class="border" cellpadding="1" cellspacing="0">
	<tr>
		<td class="thead" colspan="2"><?php echo $lang['iconupload']; ?></td>
	</tr>
	<tr>
		<td class="green1" colspan="2"><?php echo $lang['iconupinfo']; ?></td>
	<tr>
		<td class="green2" colspan="2">
		<form enctype="multipart/form-data" action="index.php?site=fileupload&amp;port=<?php echo $port; ?>" method="post">
		<input type="hidden" name="max_file_size" value="81920">
		<?php echo $lang['iconupload']; ?>: <input name="thefile" type="file">
		
		</td>
	</tr>
	<tr>
		<td class="green1"  style="width:75px"><?php echo $lang['option']; ?></td>
		<td class="green1"  align="left"><input type="submit" name="upload" value="upload"></td>
	</tr>
</table>
</form>