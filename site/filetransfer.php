<?php
$geticons=1;
if($geticons==1)
	{
	$count=0;
	$ft=$ts3->ftGetFileList(0, '', '/icons');
	
	if(!empty($ft))
		{
		$handler=opendir('icons/');
		while($datei=readdir($handler))
			{
			$icon_arr[]=$datei;
			}
		foreach($ft AS $key=>$value)
			{
			if(substr($value['name'], 0, 5)=='icon_')
				{
				if(!in_array($value['name'], $icon_arr))
					{
					$count++;
					$ft2=$ts3->ftInitDownload(0, "/".$value['name']);
					$con_ft=fsockopen($_SESSION['server_ip'], $ft2[0]['port'], $errnum, $errstr, 10);
					fputs($con_ft, $ft2[0]['ftkey']);
					$data='';
					while (!feof($con_ft)) {
					$data.= fgets($con_ft, 4096);
				}
					$handler=fopen("icons/".$value['name'], "w+");
					fwrite($handler, $data);
					fclose($handler);
					}
				}
			}
		if($count!=0)
			{
			echo sprintf($lang['countnewicon'], $count);
			}
		}
	}
?>