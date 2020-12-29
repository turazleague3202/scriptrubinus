<?php
$sql_host="localhost";
$sql_id="xwap_1145";
$sql_pass="xwap_1145";
$sql_db="xwap_1145";

	$link = @mysql_connect ("$sql_host", "$sql_id", "$sql_pass") or die ("Нема конекта");
	$link2 = @mysql_select_db("$sql_db") or die ("aaa");
	
mysql_query("SET NAMES 'utf8'");

$q =  explode(":", date('d:m:o'));
/** 
* Формируем заголовок новости
*/

$titleNews = 'Турнир лучший Авторитет '.$q['0'].'.'.$q['1'].'.'.$q['2'].'';
$top_q  = mysql_query("SELECT  `id` FROM `users` ORDER BY `avtor` DESC LIMIT 50");
 while($top = mysql_fetch_assoc($top_q)){
	$alPos++;
$nagrada = ceil(10000/$alPos);
$name_top = mysql_fetch_assoc(mysql_query("SELECT `id`, `login`, `r`, `avtor` FROM `users` WHERE `id`='".$top['id']."' LIMIT 1"));

$topes_us.= '<strong><img src=/images/icons/cs/'.$alPos.'.png alt=> '.$alPos.' место</strong> -   <a href=/user/'.$name_top['id'].'/> '.$name_top['login'].' </a> <img src=/images/icons/experience.png width=16 height=16 alt=> '.$name_top['avtor'].'  <br /> Награда <img src=/images/icons/gold.png alt=> '.$nagrada.'<br />';

	   mysql_query('UPDATE `users` SET `g`=`g` + '.$nagrada.'  WHERE `id` = '.$name_top['id'].'');


 }

mysql_query("UPDATE `users`  SET `news_read`='1' WHERE `news_read`='0'");
mysql_query('INSERT INTO `forum_topic` (`sub`,
                                        `name`,
										`stick`,
                                        `user`,
                                        `text`,
                                        `time`) VALUES ("13",
                                                             "'.$titleNews.'",
                                                             "0",
                                                       "1",
                                                             "'.$topes_us.'",
                                                           "'.time().'")');
mysql_query('UPDATE `users` SET  `avtor` = "0"');
?>
