<?php



// root path
define ("ROOT", $_SERVER['DOCUMENT_ROOT']);

// load all system components
foreach (array (
				ROOT . "/system/common.php",
				ROOT . "/system/functions.php",
				ROOT . "/system/user.php"
) as $file) {
				require $file;
}


// require login
if (!isset ($user)) {
				header ("location: /");
exit;
}


// check
$query = mysql_query ("SELECT `clans`.`g` as `gold`, `clan_memb`.* FROM `clan_memb` LEFT JOIN `clans` ON `clans`.`id`=`clan_memb`.`clan` WHERE (`clan_memb`.`user`='$user[id]')");
if (mysql_num_rows ($query)!=0)
				$c = mysql_fetch_array ($query);

// header
				$title = "Тюремный бунт";
				

				
require ROOT . "/system/h.php";

?>



<?php

// configurations
define ("TIME",   30); // откат мероприятия (3  часа)
define ("DURATION", 30); // продолжительность мероприятия (30 минут)
define ("PRICE", 		  250); // стоимость подачи заявки (250 caxar)
define ("ATTACK_DELAY", 5);
define ("_1st", 50000); // награда за первое место
$gold='2000';
define ("_2st", 25000); // за 2е
$silver='20000';
define ("_3st", 15000); // за 3е
$silverr='10000';

if (isset ($_SESSION['messages'])) {
?>
<?php
		foreach ($_SESSION['messages'] as $messages) {
				
?>

		<?=$messages?><br/>

<?php			
		}
		?>
</div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
		<?php
unset ($_SESSION['messages']);
}

?>

<div class="dotted"></div>
  
<?php

if (mysql_num_rows (mysql_query ("SELECT * FROM `cw_event`"))!=0) {
				$e = mysql_fetch_array (mysql_query ("SELECT * FROM `cw_event` ORDER BY `id` DESC LIMIT 1"));
				
				if ($e['start']==0 and $e['time']<=time ()) {
								mysql_query ("UPDATE `cw_event` SET `start`='1',`time`=`time`+" . DURATION . " WHERE (`id`='$e[id]')");
								header ('location: /cw.php');
				}
				if ($e['start']==1 and mysql_num_rows (mysql_query ("SELECT * FROM `cw_clans` WHERE (`id_event`='$e[id]')"))==1) {
								mysql_query ("UPDATE `cw_event` SET `end`='1' WHERE (`id`='$e[id]')");
								mysql_query ("INSERT INTO `cw_event` (`start`,`end`,`time`) VALUES ('0','0','" . (time ()+TIME). "')");
				}
				
				if ($e['start']==1 and $e['end']==0 and $e['time']<=time ()) {
								mysql_query ("UPDATE `cw_event` SET `end`='1' WHERE (`id`='$e[id]')");
								mysql_query ("INSERT INTO `cw_event` (`start`,`end`,`time`) VALUES ('0','0','" . (time ()+TIME). "')");
								$messages = " <div class=content>  <div class=block><div class=center><h3>Турнир завершен</h3></div><div class=dotted></div>
";
								$i = 0;
								$q = mysql_query ("SELECT `clans`.*,`cw_clans`.`kp` FROM `cw_clans` LEFT JOIN `clans` ON `clans`.`id`=`cw_clans`.`id_clan` WHERE (`cw_clans`.`id_event`='$e[id]') ORDER BY `cw_clans`.`kp` DESC LIMIT 3");


								while ($_c = mysql_fetch_array ($q)) {
									
												$i++;
												$messages.= "<img src=/images/icons/place$i.png width=16 height=16 alt=> <a href='/clan/$_c[id]'>$_c[name]</a></span><h5>";

												if ($i==1) {
mysql_query ("UPDATE `clanns` SET `exp`=`exp`+" . _1st . ", `g` =`g`+2000 WHERE (`id`='$_c[id]')");															
														$messages.= _1st .  " <img src=/images/icons/experience.png width=16 height=16 alt=> Авторитета [<img src=/images/icons/gold.png width=10 height=10 alt=>2000] </h5>";
												}
												elseif ($i==2) {
mysql_query ("UPDATE `clanns` SET `exp`=`exp`+" . _2st . ",`s` =`s`+25000 WHERE (`id`='$_c[id]')");	
$messages.= _2st .  "<img src=/images/icons/experience.png width=16 height=16 alt=> Авторитета [<img src=/images/icons/silver.png width=10 height=10 alt=>25000] </h5>";																
												}
												elseif ($i==3) {
mysql_query ("UPDATE `clanns` SET `exp`=`exp`+" . _3st . ",`s` =`s`+10000 WHERE (`id`='$_c[id]')");
																$messages.= _3st .  " <img src=/images/icons/experience.png width=16 height=16 alt=> Авторитета [<img src=/images/icons/silver.png width=10 height=10 alt=>10000] </h5>";
																
												}
													
												$messages.=" ($_c[kp]  очков авторитета)\n</br>";





								
								$topes_us.= '<h5><img src=/images/icons/place'.$i.'.png width=16 height=16 alt=> '.$_c['name'].' , ('.$_c['kp'].'  очков авторитета)</br></h5>';
											
mysql_query("INSERT INTO `chaat` SET `user`='3', `user_id`='0', `text`='Тюремный бунт завершён!</br> '.$topes_us.''', `time`='.time().'");
								}

mysql_query("INSERT INTO `chat` SET `user`='2',`to`='0',`text`='Тюремный бунт завершён!</br>".$topes_us."',`time`='".time()."'");
								$_SESSION['messages'][] = $messages;
								header ('location: /cw.php'); // будет перенаправлять на кланвары..

								
				}
				
				$q = mysql_query ("SELECT * FROM `cw_memb` WHERE (`id_event`='$e[id]') AND (`id_user`='$user[id]')");
				if ($e['start'] == 1 and mysql_num_rows ($q)!=0) {
				
				
								$m = mysql_fetch_array ($q);
								if ($m['hp']==0) {
?>
				<div class="content">

<div class="block center color3 s125"><img src="/images/icons/circle.png" alt=""> <a href="?">Тюремный бунт</a><span class="white">, </span></div>
            <div class="line"></div><div class="block center">
    <img src="/images/title/bun.jpg" width="150" height="75" alt="">    <div class="m3 blue">Тюремный бунт - это ожесточённые бои
        до последней капли крови</div>
</div>

<div class="dotted"></div>
    <div class="block center">
Вы были убиты, вовремя боя!<br/>
        <img src="/images/icons/date.png" width="16" height="16" alt="">  Конец битвы через: <?=ceil (($e['time']-time ())/60)?> минут <br>

  </div>
  
<div class="dotted"></div>
                
<div class="block center">
    <span class="btn_start"><span class="btn_end"><a class="btn" href="?">Обновить</a></span> </span></div>
				
			<div class="dotted"></div>
<ul class="block small">
  <li class="color2">
 В процессе боя, участники одной банды сражаются с участниками другой банды зарабатывая очки авторитета.<br/>
Набравший больше всех очков авторитета выигрывает.</li>
     <li class="color2">
Награда за первое Место - 50.000 авторитета в банду.</br>
Награда за второе Место - 25.000 авторитета в банду.</br>
Награда за первое Место - 15.000 авторитета в банду.</br>
 </li>
</ul>
</div>
<?php								
										
require ROOT . "/system/f.php";
exit;
								}
								else {
												
  										$_GET['change'] = isset ($_GET['change']) ? intval ($_GET['change']) : 0;
											if ($_GET['change']) {

																$query = mysql_query ("SELECT * FROM `cw_memb` WHERE (`id_event`='$e[id]') AND (`id_clan`!='$m[id_clan]') ORDER BY RAND()");
																if (mysql_num_rows ($query)!=0) {
																		
																				$opponent = mysql_fetch_array ($query);
																				mysql_query ("UPDATE `cw_memb` SET `id_opponent`='$opponent[id]' WHERE (`id_event`='$m[id_event]') AND (`id_user`='$m[id_user]')");		

																}

																header ('location:/tru/');
																exit;
												}
  										$_GET['regeneration'] = isset ($_GET['regeneration']) ? intval ($_GET['regeneration']) : 0;
											if ($_GET['regeneration']==1) {
															if ((time () - $m['last_regeneration'])>60) {
																			mysql_query ("UPDATE `cw_memb` SET `hp`='" . ceil (($user['vit']*2)) . "',`last_regeneration`='" . time () . "' WHERE (`id`='$m[id]')");		
															}
																header ('location:/tru/');
																exit;
												}


?>
	
<?php
												if ($m['id_opponent']!=0) {
																$cw_opponent = mysql_fetch_array (mysql_query ("SELECT * FROM `cw_memb` WHERE (`id`='$m[id_opponent]')"));
																if ($cw_opponent['hp']!=0) {
																				$opponent = mysql_fetch_array (mysql_query ("SELECT * FROM `users` WHERE (`id`='$cw_opponent[id_user]')"));


												$_GET['attack'] = isset ($_GET['attack']) ? intval ($_GET['attack']) : 0;
												if ($_GET['attack']) {
															
																
																// current damage
																$dmg = 0;
														
																

																// ablitities
																// 0 - don't active, 1 - active
																$ability_1 = 0;
																$ability_2 = 0;
																$ability_3 = 0;
																$ability_4 = 0;
																
																		
																		if ($user['ability_1']!=0) {
																		
																				$ability_1_b = 20 + ($user['ability_1']*5) - 5;
																				$ability_1_c = 5 	+ ($user['ability_1']*3) - 3;

																				if (mt_rand(0, 100) <= $ability_1_c)
																						$ability_1 = 1;
																		
																		}
																		
																		

																		if ($user['ability_2']!=0) {
																		
																				$ability_2_b = 20 + ($user['ability_2']*5) - 5;
																				$ability_2_c = 5 	+ ($user['ability_2']*3) - 3;

																				if (mt_rand(0, 100) <= $ability_2_c)
																						$ability_2 = 1;
																		
																		}

																		

																		if ($user['ability_3']!=0) {
																		
																				$ability_2_b   = 5 + ($user['ability_3']*3) - 3;
																				$ability_2_c   = 5 + ($user['ability_3']*2) - 2;
																				$ability_2_c_c = 20+ ($user['ability_3']*5) - 5;


																				if (mt_rand(0, 100) <= $ability_3_c)
																						$ability_3 = 1;
																		
																		}
																		


																		if ($user['ability_4']!=0) {
																		
																				$ability_2_b = 20 + ($user['ability_4']*2) - 2;
																				$ability_2_c = 5 	+ ($user['ability_4']*5) - 5;

																				if (mt_rand(0, 100) <= $ability_4_c)
																						$ability_4 = 1;
																		
																		}
																		
																		

																		$dmg += ceil (rand(($user['str']/6), ($user['str']/4)));
																		
																		if ($ability_1==1) {
																				$dmg += ceil (($dmg / 100) * $ability_1_b);
																		}

																		$dmg -= ceil (rand(($opponent['def']/12), ($opponent['def']/7)));        
																		
																		if ($dmg < 0)
																				$dmg = 0;

																		$crit = $ability_1==1?((rand (1,2)*($user['agi']/100)+$ability_3_c_c)-(rand (1,2)*($opponent['agi']/100))):((rand (1,2)*($user['agi']/100))-(rand (1,2)*($opponent['agi']/100)));
																		
																		if (mt_rand(0, 100) <= $crit) {   
																		
																				$dmg *= 2;

																				if($ability_3 == 1) {							 
																						$dmg += ceil (($dmg/100)*$ability_3_b);								
																				}    
																		
																		}

																		$dodge = ((rand (1,3)*($opponent['agi']/100))-(rand (1,3)*($user['agi']/100)));
														
																		if(mt_rand(0, 100) <= $dodge)
																				$dmg = 0;
																
																		
																		if ($dmg>$cw_opponent['hp']) {
																						$dmg = $cw_opponent['hp'];
																	


$atas= " <img src=/images/icons/$user[r].png width=16 height=16 alt=> <span class=color3>$user[login]</span> Убил <span class=red>$opponent[login]</span> ";

				$avb=rand(2,10);
														
				mysql_query ("UPDATE `cw_clans` SET `kp`=`kp`+ $avb WHERE (`id_event`='$e[id]') AND (`id_clan`='$m[id_clan]')");
mysql_query ("INSERT INTO `cw_log` (`id_event`,`text`) VALUES ('$e[id]','$atas')");
																		}
																		
if($dmg > 0){ $dm="нанёс $dmg <img src=/images/icons/uron.png width=16 height=16 alt=> урона";}else{$dm=" <span class=color2> промах </span>";}
$ats= " <img src=/images/icons/$user[r].png width=16 height=16 alt=> <span class=color3>$user[login]</span> $dm <span class=red>$opponent[login]</span> ";


																mysql_query ("UPDATE `cw_memb` SET `hp`=`hp`-$dmg WHERE (`id`='$m[id_opponent]')");
																mysql_query ("UPDATE `cw_memb` SET `last_attack`=" . time () . " WHERE (`id`='$m[id]')");
												?>
<?php

																if ($dmg==0) {
mysql_query ("INSERT INTO `cw_log` (`id_event`,`text`) VALUES ('$e[id]','$ats')");
?>
<?php				
}
else
{
mysql_query ("INSERT INTO `cw_log` (`id_event`,`text`) VALUES ('$e[id]','$ats')");
?>
												<?php

																}
															
?>

<?php
}

$i_clan2 = mysql_query('SELECT * FROM `clan_memb` WHERE `id_event` = "'.$cw_opponent['id'].'"');
    $i_clan2 = mysql_fetch_array($i_clan2);



	
$i_clan = mysql_query('SELECT * FROM `clans` WHERE `id` = "'.$cw_opponent['id_clan'].'"');
    $i_clan = mysql_fetch_array($i_clan);
	$i_clan_memb = mysql_query('SELECT * FROM `clan_memb` WHERE `user` = "'.$cw_opponent['id_user'].'"');
  $i_clan_memb = mysql_fetch_array($i_clan_memb);

	switch($i_clan_memb['rank']) {
  
    case 0:
    $rank = 'Новобранец';
     break;
    case 1:
    $rank = 'Боец';
     break;
    case 2:
    $rank = 'Офицер';
     break;
    case 3:
    $rank = 'Генерал';
     break;
    case 4:
    $rank = '<font color=\'#30c030\'>Лидер клана</font>';
     break;
    
  }
$clan_vsego = mysql_result(mysql_query('SELECT COUNT(*) FROM `clan_memb` WHERE `clan` = "'.$i_clan['id'].'"'),0);
//$clab_ubit = mysql_result(mysql_query('SELECT COUNT(*) FROM `cw_memb` WHERE `hp` = "'.($cw_opponent['id'] == 0).'"'),0);
$clan_onlaiv = mysql_result(mysql_query('SELECT COUNT(*) FROM `cw_memb` WHERE `id_clan` = "'.$i_clan['id'].'" AND  `last_attack` > "'.(time() - 160).'"'),0);
$clab_ubit = mysql_result(mysql_query("SELECT SUM(`hp`='0') FROM `cw_memb` WHERE (`id_event`='$e[id]') AND (`id_clan`='$cw_opponent[id_clan]')"),0);

$mo = mysql_query('SELECT * FROM `cw_clans` WHERE `id_clan` = "'.$clan['id'].'" AND  `id_event` = "'.$e['id'].'"');  
  $mo = mysql_fetch_array($mo);
	
?>


<div class="content"><div class="block center color3 s125"><img src="/images/icons/circle.png" alt=""> <a href="?'.$udet.'">Бой </a><span class="white">, <?=_time($e['time']-time ())?> мин.
</span></div>
            <div class="line"></div>

<div class="block">        
    <div class="">   
<img src="/images/icons/members.png" width="16" height="16" alt=""> бой против банды:  <img src="/images/icons/clan.png" width="16" height="16" alt=""> <span class="color3">  <?=$i_clan['name']?></span>
<br>
<img src="/images/icons/uron.png" width="16" height="16" alt=""> в бою: <?=$clan_onlaiv?><br>
<img src="/images/icons/experience.png" width="16" height="16" alt="">Получено: <?=$mo['kp'];?>
</div>
</div>
<div class="dotted"></div>
<div class="block">        
    <div class="center">   
<?

   $w_1 = mysql_query('SELECT * FROM `inv` WHERE `user` = "'.$opponent['id'].'" AND `id` = "'.$opponent['w_1'].'"');
    $w_1 = mysql_fetch_array($w_1);
if(!$w_1) {
$w_1['item'] = 0;
}
    $w_2 = mysql_query('SELECT * FROM `inv` WHERE `user` = "'.$opponent['id'].'" AND `id` = "'.$opponent['w_2'].'"');
    $w_2 = mysql_fetch_array($w_2);
if(!$w_2) {
$w_2['item'] = 0;
}
    $w_3 = mysql_query('SELECT * FROM `inv` WHERE `user` = "'.$opponent['id'].'" AND `id` = "'.$opponent['w_3'].'"');
    $w_3 = mysql_fetch_array($w_3);
if(!$w_3) {
$w_3['item'] = 0;
}
    $w_4 = mysql_query('SELECT * FROM `inv` WHERE `user` = "'.$opponent['id'].'" AND `id` = "'.$opponent['w_4'].'"');
    $w_4 = mysql_fetch_array($w_4);
if(!$w_4) {
$w_4['item'] = 0;
}
    $w_5 = mysql_query('SELECT * FROM `inv` WHERE `user` = "'.$opponent['id'].'" AND `id` = "'.$opponent['w_5'].'"');
    $w_5 = mysql_fetch_array($w_5);
if(!$w_5) {
$w_5['item'] = 0;
}
    $w_6 = mysql_query('SELECT * FROM `inv` WHERE `user` = "'.$opponent['id'].'" AND `id` = "'.$opponent['w_6'].'"');
    $w_6 = mysql_fetch_array($w_6);
if(!$w_6) {
$w_6['item'] = 0;
}
    $w_7 = mysql_query('SELECT * FROM `inv` WHERE `user` = "'.$opponent['id'].'" AND `id` = "'.$opponent['w_7'].'"');
    $w_7 = mysql_fetch_array($w_7);
if(!$w_7) {
$w_7['item'] = 0;
}
    $w_8 = mysql_query('SELECT * FROM `inv` WHERE `user` = "'.$opponent['id'].'" AND `id` = "'.$opponent['w_8'].'"');
    $w_8 = mysql_fetch_array($w_8);
if(!$w_8) {
$w_8['item'] = 0;
}

if($opponent['r'] == 0) {
?>
       <img class="left mr8" src="http://bespredel.mobi/maneken?sex=man&amp;width=120&amp;height=160&amp;fragment=1&amp;frame=&amp;equip%5B1%5D=<?=$w_1['item']?>&amp;equip%5B2%5D=<?=$w_2['item']?>&amp;equip%5B3%5D=<?=$w_3['item']?>&amp;equip%5B4%5D=<?=$w_4['item']?>&amp;equip%5B5%5D=<?=$w_5['item']?>&amp;equip%5B6%5D=<?=$w_6['item']?>&amp;equip%5B7%5D=<?=$w_7['item']?>&amp;equip%5B8%5D=<?=$w_8['item']?>" width="50" height="50" alt="">


<?
}
if($opponent['r'] == 1) {
?>
      <img class="left mr8" src="http://bespredel.mobi/maneken?sex=woman&amp;width=120&amp;height=160&amp;fragment=1&amp;frame=&amp;equip%5B1%5D=<?=$w_1['item']?>&amp;equip%5B2%5D=<?=$w_2['item']?>&amp;equip%5B3%5D=<?=$w_3['item']?>&amp;equip%5B4%5D=<?=$w_4['item']?>&amp;equip%5B5%5D=<?=$w_5['item']?>&amp;equip%5B6%5D=<?=$w_6['item']?>&amp;equip%5B7%5D=<?=$w_7['item']?>&amp;equip%5B8%5D=<?=$w_8['item']?>" width="50" height="50" alt="">


<?
}
?>
</div>
                                <img src="/images/icons/boss.png" width="16" alt="" hegiht="16"> <span class="center"><?=$opponent['login']?></span>        <span class="white">
    

    <img src="/images/icons/level.png" width="16" height="16" alt=""> <?=$opponent['level']?> ур.    </span>
    <div class="m3" style="padding-left: 58px">    <div style="width: 100%; height: 4px"
            class="progress-grey">
            <div style="width: <?=$hp_b?>%; height: 4px" class="progress-green"></div></div>    </div>    <div>
            
    <img src="/images/icons/currentHealth.png" width="16" height="16" alt=""> <?=$cw_opponent['hp']?>            
    <img src="/images/icons/damage.png" width="16" height="16" alt=""> <?=$opponent['str']?>            
    <img src="/images/icons/armor.png" width="16" height="16" alt=""> <?=$opponent['def']?>        </div>
<div class="clear"></div>
</div>    <div class="dotted"></div>
    <div class="block center">
        <span class="btn_start"><span class="btn_end"><a class="btn" href="/tru/?attack">Ηaнеcти yдар</a></span> </span>
<span class="btn_start"><span class="btn_end"><a class="btn" href="/tru/?change">Сменить противника</a></span> </span>
    </div>
    <div class="dotted"></div>
<div class="block">          
<?

   $w_1 = mysql_query('SELECT * FROM `inv` WHERE `user` = "'.$user['id'].'" AND `id` = "'.$user['w_1'].'"');
    $w_1 = mysql_fetch_array($w_1);
if(!$w_1) {
$w_1['item'] = 0;
}
    $w_2 = mysql_query('SELECT * FROM `inv` WHERE `user` = "'.$user['id'].'" AND `id` = "'.$user['w_2'].'"');
    $w_2 = mysql_fetch_array($w_2);
if(!$w_2) {
$w_2['item'] = 0;
}
    $w_3 = mysql_query('SELECT * FROM `inv` WHERE `user` = "'.$user['id'].'" AND `id` = "'.$user['w_3'].'"');
    $w_3 = mysql_fetch_array($w_3);
if(!$w_3) {
$w_3['item'] = 0;
}
    $w_4 = mysql_query('SELECT * FROM `inv` WHERE `user` = "'.$user['id'].'" AND `id` = "'.$user['w_4'].'"');
    $w_4 = mysql_fetch_array($w_4);
if(!$w_4) {
$w_4['item'] = 0;
}
    $w_5 = mysql_query('SELECT * FROM `inv` WHERE `user` = "'.$user['id'].'" AND `id` = "'.$user['w_5'].'"');
    $w_5 = mysql_fetch_array($w_5);
if(!$w_5) {
$w_5['item'] = 0;
}
    $w_6 = mysql_query('SELECT * FROM `inv` WHERE `user` = "'.$user['id'].'" AND `id` = "'.$user['w_6'].'"');
    $w_6 = mysql_fetch_array($w_6);
if(!$w_6) {
$w_6['item'] = 0;
}
    $w_7 = mysql_query('SELECT * FROM `inv` WHERE `user` = "'.$user['id'].'" AND `id` = "'.$user['w_7'].'"');
    $w_7 = mysql_fetch_array($w_7);
if(!$w_7) {
$w_7['item'] = 0;
}
    $w_8 = mysql_query('SELECT * FROM `inv` WHERE `user` = "'.$user['id'].'" AND `id` = "'.$user['w_8'].'"');
    $w_8 = mysql_fetch_array($w_8);
if(!$w_8) {
$w_8['item'] = 0;
}

if($user['r'] == 0) {
?>
       <img class="left mr8" src="http://bespredel.mobi/maneken?sex=man&amp;width=120&amp;height=160&amp;fragment=1&amp;frame=&amp;equip%5B1%5D=<?=$w_1['item']?>&amp;equip%5B2%5D=<?=$w_2['item']?>&amp;equip%5B3%5D=<?=$w_3['item']?>&amp;equip%5B4%5D=<?=$w_4['item']?>&amp;equip%5B5%5D=<?=$w_5['item']?>&amp;equip%5B6%5D=<?=$w_6['item']?>&amp;equip%5B7%5D=<?=$w_7['item']?>&amp;equip%5B8%5D=<?=$w_8['item']?>" width="50" height="50" alt="">



<?
}
if($user['r'] == 1) {

?>
      <img class="left mr8" src="http://bespredel.mobi/maneken?sex=woman&amp;width=120&amp;height=160&amp;fragment=1&amp;frame=&amp;equip%5B1%5D=<?=$w_1['item']?>&amp;equip%5B2%5D=<?=$w_2['item']?>&amp;equip%5B3%5D=<?=$w_3['item']?>&amp;equip%5B4%5D=<?=$w_4['item']?>&amp;equip%5B5%5D=<?=$w_5['item']?>&amp;equip%5B6%5D=<?=$w_6['item']?>&amp;equip%5B7%5D=<?=$w_7['item']?>&amp;equip%5B8%5D=<?=$w_8['item']?>" width="50" height="50" alt="">


<?
}
?>

                    <img src="/images/icons/<?=$user['r']?>.png" width="16" height="16" alt=""> <span><?=$user['login']?></span>      <span class="white">
    
    <img src="/images/icons/level.png" width="16" height="16" alt=""> <?=$user['level']?> ур.    </span>
    <div class="m3" style="padding-left: 58px">    <div style="width: 100%; height: 4px"
            class="progress-grey">
            <div style="width: <?=$hp_u?>%; height: 4px" class="progress-green"></div></div>    </div>    <div>
            
    <img src="/images/icons/currentHealth.png" width="16" height="16" alt=""> <?=$user['hp']?>            
    <img src="/images/icons/damage.png" width="16" height="16" alt=""> <?=$user['str']?>            
    <img src="/images/icons/armor.png" width="16" height="16" alt=""> <?=$user['def']?>        </div>
<div class="clear"></div>
</div>    

  <div class="dotted"></div>





 </div>

<?php																				
																				
																				
																}
																else {
$clab_o = mysql_result(mysql_query('SELECT COUNT(*) FROM `cw_memb` WHERE `hp` = "0" AND `id_clan` = "'.$i_clan['id'].'"'),0);

?>

		<div class="content"><div class="block center color3 s125"><img src="/images/icons/circle.png" alt=""> <a href="?'.$udet.'">Бой </a><span class="white">, <?=_time($e['time']-time ())?> мин.
</span></div>
            <div class="line"></div>

<?
if($clab_o['hp']==0){
echo '<div class="block">        
    <div class="center">   
Все противники убиты! ';}else{
echo '<div class="block">        
    <div class="center">   
Ваш противник погиб!';
}

?>

<div class="clear"></div>
</div></div>      <div class="dotted"></div>
    <div class="block center">
        <span class="btn_start"><span class="btn_end"><a class="btn" href="/tru/?change">Найти</a></span> </span>    </div>
    <div class="dotted"></div>
<div class="block">          
<?

   $w_1 = mysql_query('SELECT * FROM `inv` WHERE `user` = "'.$user['id'].'" AND `id` = "'.$user['w_1'].'"');
    $w_1 = mysql_fetch_array($w_1);
if(!$w_1) {
$w_1['item'] = 0;
}
    $w_2 = mysql_query('SELECT * FROM `inv` WHERE `user` = "'.$user['id'].'" AND `id` = "'.$user['w_2'].'"');
    $w_2 = mysql_fetch_array($w_2);
if(!$w_2) {
$w_2['item'] = 0;
}
    $w_3 = mysql_query('SELECT * FROM `inv` WHERE `user` = "'.$user['id'].'" AND `id` = "'.$user['w_3'].'"');
    $w_3 = mysql_fetch_array($w_3);
if(!$w_3) {
$w_3['item'] = 0;
}
    $w_4 = mysql_query('SELECT * FROM `inv` WHERE `user` = "'.$user['id'].'" AND `id` = "'.$user['w_4'].'"');
    $w_4 = mysql_fetch_array($w_4);
if(!$w_4) {
$w_4['item'] = 0;
}
    $w_5 = mysql_query('SELECT * FROM `inv` WHERE `user` = "'.$user['id'].'" AND `id` = "'.$user['w_5'].'"');
    $w_5 = mysql_fetch_array($w_5);
if(!$w_5) {
$w_5['item'] = 0;
}
    $w_6 = mysql_query('SELECT * FROM `inv` WHERE `user` = "'.$user['id'].'" AND `id` = "'.$user['w_6'].'"');
    $w_6 = mysql_fetch_array($w_6);
if(!$w_6) {
$w_6['item'] = 0;
}
    $w_7 = mysql_query('SELECT * FROM `inv` WHERE `user` = "'.$user['id'].'" AND `id` = "'.$user['w_7'].'"');
    $w_7 = mysql_fetch_array($w_7);
if(!$w_7) {
$w_7['item'] = 0;
}
    $w_8 = mysql_query('SELECT * FROM `inv` WHERE `user` = "'.$user['id'].'" AND `id` = "'.$user['w_8'].'"');
    $w_8 = mysql_fetch_array($w_8);
if(!$w_8) {
$w_8['item'] = 0;
}

if($user['r'] == 0) {
?>
       <img class="left mr8" src="http://bespredel.mobi/maneken?sex=man&amp;width=120&amp;height=160&amp;fragment=1&amp;frame=&amp;equip%5B1%5D=<?=$w_1['item']?>&amp;equip%5B2%5D=<?=$w_2['item']?>&amp;equip%5B3%5D=<?=$w_3['item']?>&amp;equip%5B4%5D=<?=$w_4['item']?>&amp;equip%5B5%5D=<?=$w_5['item']?>&amp;equip%5B6%5D=<?=$w_6['item']?>&amp;equip%5B7%5D=<?=$w_7['item']?>&amp;equip%5B8%5D=<?=$w_8['item']?>" width="50" height="50" alt="">


<?
}
if($user['r'] == 1) {

?>
      <img class="left mr8" src="http://bespredel.mobi/maneken?sex=woman&amp;width=120&amp;height=160&amp;fragment=1&amp;frame=&amp;equip%5B1%5D=<?=$w_1['item']?>&amp;equip%5B2%5D=<?=$w_2['item']?>&amp;equip%5B3%5D=<?=$w_3['item']?>&amp;equip%5B4%5D=<?=$w_4['item']?>&amp;equip%5B5%5D=<?=$w_5['item']?>&amp;equip%5B6%5D=<?=$w_6['item']?>&amp;equip%5B7%5D=<?=$w_7['item']?>&amp;equip%5B8%5D=<?=$w_8['item']?>" width="50" height="50" alt="">


<?
}
?>

                    <img src="/images/icons/<?=$user['r']?>.png" width="16" height="16" alt=""> <span><?=$user['login']?></span>      <span class="white">
    
    <img src="/images/icons/level.png" width="16" height="16" alt=""> <?=$user['level']?> ур.    </span>
    <div class="m3" style="padding-left: 58px">    <div style="width: 100%; height: 4px"
            class="progress-grey">
            <div style="width: <?=$hp_u?>%; height: 4px" class="progress-green"></div></div>    </div>    <div>
            
    <img src="/images/icons/currentHealth.png" width="16" height="16" alt=""> <?=$user['hp']?>            
    <img src="/images/icons/damage.png" width="16" height="16" alt=""> <?=$user['str']?>            
    <img src="/images/icons/armor.png" width="16" height="16" alt=""> <?=$user['def']?>        </div>
<div class="clear"></div>
</div>    

  <div class="dotted"></div>
<?php																				
																}
												}
												else {											
?>
				
<div class="content"><div class="block center color3 s125"><img src="/images/icons/circle.png" alt=""> <a href="?'.$udet.'">Бой </a><span class="white">, <?=_time($e['time']-time ())?> мин.
</span></div>
            <div class="line"></div>

<div class="block">        
    <div class="center">   
У вас нет противника!
<div class="clear"></div>
</div></div>      <div class="dotted"></div>
    <div class="block center">
        <span class="btn_start"><span class="btn_end"><a class="btn" href="/tru/?change">Найти</a></span> </span>    </div>
    <div class="dotted"></div>
<div class="block">          
<?

   $w_1 = mysql_query('SELECT * FROM `inv` WHERE `user` = "'.$user['id'].'" AND `id` = "'.$user['w_1'].'"');
    $w_1 = mysql_fetch_array($w_1);
if(!$w_1) {
$w_1['item'] = 0;
}
    $w_2 = mysql_query('SELECT * FROM `inv` WHERE `user` = "'.$user['id'].'" AND `id` = "'.$user['w_2'].'"');
    $w_2 = mysql_fetch_array($w_2);
if(!$w_2) {
$w_2['item'] = 0;
}
    $w_3 = mysql_query('SELECT * FROM `inv` WHERE `user` = "'.$user['id'].'" AND `id` = "'.$user['w_3'].'"');
    $w_3 = mysql_fetch_array($w_3);
if(!$w_3) {
$w_3['item'] = 0;
}
    $w_4 = mysql_query('SELECT * FROM `inv` WHERE `user` = "'.$user['id'].'" AND `id` = "'.$user['w_4'].'"');
    $w_4 = mysql_fetch_array($w_4);
if(!$w_4) {
$w_4['item'] = 0;
}
    $w_5 = mysql_query('SELECT * FROM `inv` WHERE `user` = "'.$user['id'].'" AND `id` = "'.$user['w_5'].'"');
    $w_5 = mysql_fetch_array($w_5);
if(!$w_5) {
$w_5['item'] = 0;
}
    $w_6 = mysql_query('SELECT * FROM `inv` WHERE `user` = "'.$user['id'].'" AND `id` = "'.$user['w_6'].'"');
    $w_6 = mysql_fetch_array($w_6);
if(!$w_6) {
$w_6['item'] = 0;
}
    $w_7 = mysql_query('SELECT * FROM `inv` WHERE `user` = "'.$user['id'].'" AND `id` = "'.$user['w_7'].'"');
    $w_7 = mysql_fetch_array($w_7);
if(!$w_7) {
$w_7['item'] = 0;
}
    $w_8 = mysql_query('SELECT * FROM `inv` WHERE `user` = "'.$user['id'].'" AND `id` = "'.$user['w_8'].'"');
    $w_8 = mysql_fetch_array($w_8);
if(!$w_8) {
$w_8['item'] = 0;
}

if($user['r'] == 0) {
?>
       <img class="left mr8" src="http://bespredel.mobi/maneken?sex=man&amp;width=120&amp;height=160&amp;fragment=1&amp;frame=&amp;equip%5B1%5D=<?=$w_1['item']?>&amp;equip%5B2%5D=<?=$w_2['item']?>&amp;equip%5B3%5D=<?=$w_3['item']?>&amp;equip%5B4%5D=<?=$w_4['item']?>&amp;equip%5B5%5D=<?=$w_5['item']?>&amp;equip%5B6%5D=<?=$w_6['item']?>&amp;equip%5B7%5D=<?=$w_7['item']?>&amp;equip%5B8%5D=<?=$w_8['item']?>" width="50" height="50" alt="">


<?
}
if($user['r'] == 1) {
?>
      <img class="left mr8" src="http://bespredel.mobi/maneken?sex=woman&amp;width=120&amp;height=160&amp;fragment=1&amp;frame=&amp;equip%5B1%5D=<?=$w_1['item']?>&amp;equip%5B2%5D=<?=$w_2['item']?>&amp;equip%5B3%5D=<?=$w_3['item']?>&amp;equip%5B4%5D=<?=$w_4['item']?>&amp;equip%5B5%5D=<?=$w_5['item']?>&amp;equip%5B6%5D=<?=$w_6['item']?>&amp;equip%5B7%5D=<?=$w_7['item']?>&amp;equip%5B8%5D=<?=$w_8['item']?>" width="50" height="50" alt="">


<?
}
?>

                    <img src="/images/icons/<?=$user['r']?>.png" width="16" height="16" alt=""> <span><?=$user['login']?></span>      <span class="white">
    
    <img src="/images/icons/level.png" width="16" height="16" alt=""> <?=$user['level']?> ур.    </span>
    <div class="m3" style="padding-left: 58px">    <div style="width: 100%; height: 4px"
            class="progress-grey">
            <div style="width: <?=$hp_u?>%; height: 4px" class="progress-green"></div></div>    </div>    <div>
            
    <img src="/images/icons/currentHealth.png" width="16" height="16" alt=""> <?=$user['hp']?>            
    <img src="/images/icons/damage.png" width="16" height="16" alt=""> <?=$user['str']?>            
    <img src="/images/icons/armor.png" width="16" height="16" alt=""> <?=$user['def']?>        </div>
<div class="clear"></div>


  <div class="dotted"></div>
<?php												
												}
								}
								
								
?>
<?

echo '<div class="content"><div class="block"><div class="color2 small"> <img src="/images/icons/swords.png" width="16" height="16" alt=""> Журнал сражения:</div>';

$q = mysql_query('SELECT * FROM `cw_log` WHERE `id_event` = "'.$e['id'].'" ORDER BY `id` DESC LIMIT 5');    
  while($row = mysql_fetch_array($q)) {


echo '<div class="small">

'.$row['text'].'

</div>';
}
?>

</div>
</div>
</div>
<?php
				
				
				}
				else {
								if ($e['start']==1) {
?>												
  <div class="content">

<div class="block center color3 s125"><img src="/images/icons/circle.png" alt=""> <a href="?">Тюремный бунт</a><span class="white">, </span></div>
            <div class="line"></div><div class="block center">
    <img src="/images/title/bun.jpg" width="150" height="75" alt="">    <div class="m3 blue">Тюремный бунт - это ожесточённые бои
        до последней капли крови</div>
</div>

<div class="dotted"></div>
    <div class="block center">
Битва в самом разгаре!<br/>
        <img src="/images/icons/date.png" width="16" height="16" alt="">  Конец битвы через: <?=ceil (($e['time']-time ())/60)?> минут <br>

  </div>
  
<div class="dotted"></div>
                
<div class="block center">
    <span class="btn_start"><span class="btn_end"><a class="btn" href="?">Обновить</a></span> </span></div>
				
			<div class="dotted"></div>
<ul class="block small">
 <li class="color2">
 В процессе боя, участники одной банды сражаются с участниками другой банды зарабатывая очки авторитета.<br/>
Набравший больше всех очков авторитета выигрывает.</li>
        <li class="color2">
Награда за первое Место - 50.000 авторитета в банду.</br>
Награда за второе Место - 25.000 авторитета в банду.</br>
Награда за первое Место - 15.000 авторитета в банду.</br>
 </li>
</ul>
</div>

		
<?php												
								}
								else {
								
												$_GET['pod'] = isset ($_GET['pod']) ? intval ($_GET['pod']) : 0;


				if (isset ($c)) {
								if (mysql_num_rows (mysql_query ("SELECT * FROM `cw_clans` WHERE (`id_event`='$e[id]') AND (`id_clan`='$c[clan]')"))==0) {
												if ($c['rank']==5 OR $c['rank']==4) {
																// register clan at event
																if(isset($_GET['pod'])) {
if($clan) {

	$topes_us.= '<span class="login"><font color="90c0c0"></span>Наша банда участвует в Тюремном бунте!!!</font>';
	mysql_query("INSERT INTO `chat` SET `clan`= '".$clan['id']."', `read` ='0', `user`='2', `user_id`='0', `text`='".$topes_us."', `time`='".time()."'");
}
																				if ($c['gold']>=PRICE) {
																								
																								mysql_query ("INSERT INTO `cw_clans` (`id_event`,`id_clan`,`kp`) VALUES ('$e[id]','$c[clan]','0')");
																								mysql_query ("UPDATE `clanns` SET `g`=`g`-" . PRICE . " WHERE (`id`='$c[clan]')");
																								$query = mysql_query ("SELECT `users`.* FROM `clan_memb` LEFT JOIN `users` ON `users`.`id`=`clan_memb`.`user` WHERE (`clan_memb`.`clan`='$c[clan]')");
																								while ($m = mysql_fetch_array ($query)) {
																												mysql_query ("INSERT INTO `cw_memb` (`id_event`,`id_clan`,`id_user`,`hp`,`id_opponent`) VALUES ('$e[id]', '$c[clan]', '$m[id]', '" . ($m['vit']) . "','0')");

																								}
																				}
																				
																				header ('location:/tru/');																
																}
												}
?>

  <div class="content">

<div class="block center color3 s125"><img src="/images/icons/circle.png" alt=""> <a href="?">Тюремный бунт</a><span class="white">, </span></div>
            <div class="line"></div><div class="block center">
    <img src="/images/title/bun.jpg" width="150" height="75" alt="">    <div class="m3 blue">Тюремный бунт - это ожесточённые бои
        до последней капли крови</div>
</div>

<div class="dotted"></div>
    <div class="block center">
        <img src="/images/icons/date.png" width="16" height="16" alt="">        Начало сражения через:  <?=_time($e['time']-time ())?> <br>
Всего подано заявок: <?=mysql_result(mysql_query('SELECT COUNT(*) FROM `cw_clans` WHERE (`id_event`='.$e['id'].')'),0)?>

  </div>
  
<div class="dotted"></div>
                <?
if ($c['rank']==5 OR $c['rank']==4) {
   ?>
<div class="block center">
    <span class="btn_start"><span class="btn_end"><a class="btn" href="/tru/?pod">Подать заявку <img src="/images/icons/gold.png " alt 'g'><?=PRICE?></a></span> </span></div>
				  
<?
									}
?>
	
<?php
}else {
?>


  <div class="content">

<div class="block center color3 s125"><img src="/images/icons/circle.png" alt=""> <a href="?">Тюремный бунт</a><span class="white">, </span></div>
            <div class="line"></div><div class="block center">
    <img src="/images/title/bun.jpg" width="150" height="75" alt="">    <div class="m3 blue">Тюремный бунт - это ожесточённые бои
        до последней капли крови</div>
</div>

<div class="dotted"></div>
    <div class="block center">
        <img src="/images/icons/date.png" width="16" height="16" alt="">        Начало сражения через:  <?=_time($e['time']-time ())?> <br>
Всего подано заявок: <?=mysql_result(mysql_query('SELECT COUNT(*) FROM `cw_clans` WHERE (`id_event`='.$e['id'].')'),0)?>

  </div>
  
<div class="dotted"></div>
                
<div class="block center">
    <span class="btn_start"><span class="btn_end"><a class="btn" href="?">Обновить</a></span> </span></div>

<?php								
								}

				}

?>
				



			<div class="dotted"></div>
<ul class="block small">
 <li class="color2">
 В процессе боя, участники одной банды сражаются с участниками другой банды зарабатывая очки авторитета.<br/>
Набравший больше всех очков авторитета выигрывает.</li>
     <li class="color2">
Награда за первое Место - 50.000 авторитета в банду.</br>
Награда за второе Место - 25.000 авторитета в банду.</br>
Награда за первое Место - 15.000 авторитета в банду.</br>
 </li>
</ul>
</div>
<?php

								}
				}

} 
else {

				mysql_query ("INSERT INTO `cw_event` (`start`,`end`,`time`) VALUES ('0','0','" . (time ()+TIME). "')");
				header ('location:/tru/');
				
}

?>

</ul>

<?php

// footer
require ROOT . "/system/f.php";