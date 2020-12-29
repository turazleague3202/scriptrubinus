<?php
$sql_host="localhost";
$sql_id="xwap_1145";
$sql_pass="xwap_1145";
$sql_db="xwap_1145";

	$link = @mysql_connect ("$sql_host", "$sql_id", "$sql_pass") or die ("Нема конекта");
	$link2 = @mysql_select_db("$sql_db") or die ("aaa");
	
mysql_query("SET NAMES 'utf8'");
mysql_query('UPDATE `users` SET `boss4` = "0", `bos7` ="0", `bos10` = "0",`bunt` = "0", `go` = "0", `are` = "0",`zdk`="0"');
mysql_query('UPDATE `clans` SET `bos3` = "0", `bos5` ="0", `bos7` = "0"');
mysql_query('UPDATE `clan_quest` SET `bos3` = "0", `bos5` ="0", `bos7` = "0"');
mysql_query('DELETE FROM `quest`');

?>
