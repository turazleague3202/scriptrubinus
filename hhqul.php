<?php
$sql_host="localhost";
$sql_id="xwap_1145";
$sql_pass="xwap_1145";
$sql_db="xwap_1145";

	$link = @mysql_connect ("$sql_host", "$sql_id", "$sql_pass") or die ("Нема конекта");
	$link2 = @mysql_select_db("$sql_db") or die ("aaa");
	
mysql_query("SET NAMES 'utf8'");
mysql_query('UPDATE `users` SET `bosy2` = "0", `bosy4` ="0", `bosy6` = "0",`are1` = "0", `bossy3` = "0", `bossy5` = "0", `chat_ob`="0"');
mysql_query('UPDATE `quest` SET `bosy2` = "0", `bosy4` ="0", `bosy6` = "0",`are1` = "0", `bossy3` = "0", `bossy5` = "0", `chat_ob`="0"');

?>
