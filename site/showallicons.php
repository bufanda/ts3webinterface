<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
<table>
<?php
$handler=opendir("../icons/");
$count=0;
while($datei=readdir($handler))
	{
	
	if($datei!='.' AND $datei!='..')
		{
		$count++;
		$getid=str_replace("icon_", "", $datei);
	if($count==1)
		{
		echo "<tr><td>";
		}
		else
		{
		echo "<td>";
		}
	
	echo "<a href=\"#\" onclick=\"javascript:opener.document.getElementById('iconid').value = $getid;\"><img style=\"border:0\"src=\"showfile.php?name=icon_".$getid."\" /></a><br />";
	
	if($count==5)
		{
		$count=0;
		echo "</td></tr>";
		}
		else
		{
		echo "</td>";
		}
	
		}
	}
?>
</table>
</body>
</html>