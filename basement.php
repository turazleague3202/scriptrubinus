<?php

foreach(array('common', 'functions', 'user','h') as $catArray) {
	     $title = 'Подвал';
		     include './system/'.$catArray.'.php';
}
$gen = ($_SESSION['clik']);
if(!isset($_SESSION['clik'])){
$_SESSION['clik'] = md5(rand(1111111,9999999));
header("Location:?");
}

if(!$user OR !$clan OR $user['access'] < 0) {
	exit(header('Location: /'));
}

if (isset($_SESSION['erro'])){
echo '<div class="block"><center>'.$_SESSION['erro'].' </center></div>';
unset($_SESSION['erro']);
}

if (isset($_SESSION['ok'])){
echo '<div class="block"><center>'.$_SESSION['ok'].' </center></div>';
unset($_SESSION['ok']);
}

$podval_key = mysql_fetch_array(mysql_query('SELECT * FROM `podval_key` WHERE `clan` = "'.$clan['id'].'" '));
   if(!$podval_key) {
	mysql_query('INSERT INTO `podval_key` SET `clan` = "'.$clan['id'].'"');
	         exit(header('Location: /basement/'));
}
?>
<link rel='stylesheet' href='/style.css'/>  
<script type="text/javascript" src="/t.js"></script> 
<?

$podval_memb = mysql_fetch_array(mysql_query('SELECT * FROM `podval_memb` WHERE `clan`= "'.$clan['id'].'" AND `user`= "'.$user['id'].'"'));

$podval_b = mysql_fetch_array(mysql_query('SELECT * FROM `podval_clan` WHERE `clan`= "'.$clan['id'].'"'));

if($podval_b) {
	
		if($podval_b['time'] < time()) {
			
		if($podval_b['images'] > 1) {
			
			if($podval_key['key_'.$podval_b['images'].''] > 0) {
		            
					mysql_query('UPDATE `podval_key` SET `key_'.$podval_b['images'].'` = `key_'.$podval_b['images'].'` - 1 WHERE `clan` = '.$clan['id'].'');
		
		}else{
			
			mysql_query('UPDATE `podval_key` SET `key_'.$podval_b['images'].'` =  0 WHERE `clan` = '.$clan['id'].'');

		}
		}
		mysql_query('DELETE FROM `podval_clan` WHERE `clan` = "'.$clan['id'].'"');
		mysql_query('DELETE FROM `podval_memb` WHERE `clan` = "'.$clan['id'].'"');
		mysql_query('DELETE FROM `podval_log` WHERE `clan` = "'.$clan['id'].'"');
		mysql_query('DELETE FROM `podval_chat` WHERE `clan` = "'.$clan['id'].'"');
		?>
		<div class="content"><div class="block center s125 red">
    Ты потерпел поражение
</div>
<div class="dotted"></div>
<div class="block center">
            <span class="btn_start"><span class="btn_end"><a class="btn" href="/basement/">Завeршить сpажениe</a></span> </span>    </div>
		<?
		include './system/f.php';
		exit;
	}
	
		if($podval_b['vit'] <= 0) {
		?>

 <div class="content"><div class="block center s125 green">
    Враг повержен
</div>
<div class="dotted"></div>
    <div class="block center s125">
        <img src="/images/icons/reward.png" width="16" height="16" alt="">        Награда:     <img src="/images/icons/experience.png" width="16" height="16" alt=""> <?=($podval_b['exp']);?><img src="/images/icons/silver.png" width="16" height="16" alt="">  <?=($podval_b['s']);?>  </div>
<div class="dotted"></div>
<div class="block center">
            <span class="btn_start"><span class="btn_end"><a class="btn" href="/basement/">Завepшить cpажениe</a></span> </span>    </div>
		<?		
			if($podval_b['images'] <= 17) {
		    
			mysql_query('UPDATE `podval_key` SET `key_'.($podval_b['images'] + 1).'` = `key_'.($podval_b['images'] + 1).'` + 1 WHERE `clan` = '.$clan['id'].'');
			
			}
			
			mysql_query('UPDATE `podval_key` SET `boss_'.$podval_b['images'].'` = `boss_'.$podval_b['images'].'` + 1 WHERE `clan` = '.$clan['id'].'');

if($clan['level']>=30){
if($podval_b['images']==3){
mysql_query('UPDATE `clans` SET `bos3` = `bos3` + 1 WHERE `id` = \''.$clan['id'].'\'');
}
if($podval_b['images']==5){
mysql_query('UPDATE `clans` SET `bos5` = `bos5` + 1 WHERE `id` = \''.$clan['id'].'\'');
}
if($podval_b['images']==7){
mysql_query('UPDATE `clans` SET `bos7` = `bos7` + 1 WHERE `id` = \''.$clan['id'].'\'');
}
}

$clanbonys=round($podval_b['exp']*$clan['built_5']/50);
$gyl=240*$podval_b['images'];
$gok=360*$podval_b['images'];
mysql_query('UPDATE `clans` SET `s` = `s` + "'.($podval_b['s']).'", `exp` = `exp` + "'.($podval_b['exp']+$clanbonys).'", `g` = `g` + 2 WHERE `id` = "'.$clan['id'].'"');
$_SESSION['not']=' <div class="alert"><div>                                     <div class="blue"><img src="/images/icons/reward.png" width="16" height="16" alt=""> Прибыль:</div>
 <img src="/images/icons/experience.png" width="16" height="16" alt=""> Авторитет:+'.($gok).'  <img src="/images/icons/silver.png" width="16" height="16" alt=""> Рубли +'.($gyl).' </div></div><div class="alert_bottom"></div>';

header('Location: /basement/');
			     $q = mysql_query('SELECT * FROM `podval_memb` WHERE `clan` = "'.$clan['id'].'" AND `exit`= 0 ORDER BY `dmg`');
			     while ($winer = mysql_fetch_array ($q)){
$podval_u = mysql_fetch_array(mysql_query('SELECT * FROM `users` WHERE `id`= "'.$winer['user'].'"'));

$gyl=240*$podval_b['images'];
$gok=360*$podval_b['images'];
				  if($winer['dmg'] > 0) {
                        mysql_query('UPDATE `clan_memb` SET `exp` = `exp` + 1 WHERE `user`= '.$winer['user'].'');


mysql_query('UPDATE `users` SET `s` = `s` + '.$gyl.', `exp` = `exp` + '.$gok.',`exepy` = `exepy` + '.$gok.', `pod` = `pod` + 1 WHERE `id`= '.$winer['user'].'');
if($petsu){
mysql_query('UPDATE `pets_user` SET `exp` = `exp` + '.$gok.' WHERE `user` = "'.$winer['user'].'"');
}
if($podval_u['level']>=60){
if($podval_b['images']==7){
mysql_query('UPDATE `users` SET `bos7` = `bos7` + 1 WHERE `id` = \''.$winer['user'].'\'');
}
if($podval_b['images']==10){
mysql_query('UPDATE `users` SET `bos10` = `bos10` + 1 WHERE `id` = \''.$winer['user'].'\'');
}
if($podval_b['images']==3){
mysql_query('UPDATE `users` SET `bossy3` = `bossy3` + 1 WHERE `id` = \''.$winer['user'].'\'');
}
if($podval_b['images']==5){
mysql_query('UPDATE `users` SET `bossy5` = `bossy5` + 1 WHERE `id` = \''.$winer['user'].'\'');
}
}
				 }
				 }
				 
		mysql_query('DELETE FROM `podval_clan` WHERE `clan` = "'.$clan['id'].'"');
		mysql_query('DELETE FROM `podval_memb` WHERE `clan` = "'.$clan['id'].'"');
		mysql_query('DELETE FROM `podval_log` WHERE `clan` = "'.$clan['id'].'"');
		mysql_query('DELETE FROM `podval_chat` WHERE `clan` = "'.$clan['id'].'"');
		echo '</div>';
		include './system/f.php';
		exit;
	}
	
	if(!$podval_memb) {
		mysql_query('INSERT INTO `podval_memb` SET `clan`= '.$clan['id'].', `user` = "'.$user['id'].'", `exit` = 1');
		exit(header('Location: /basement/'));
	}
	
	if($podval_memb['exit'] == 1) {
		
	if($_GET['exit'] == 2) {
		mysql_query('UPDATE `podval_memb` SET `exit`= 0 WHERE `clan`= '.$clan['id'].' AND `user`= '.$user['id'].'');
		exit(header('Location: /basement/'));
	}
		
$hp_b = round(100 / ($podval_b['max_hp']/ $podval_b['vit']));
if($hp_b){
$hp_m=100;
}
		?>
  <div class="content"><div class="block center color3 s125">Идёт сражение</div>
            <div class="line"></div><div class="block center s125">
    Твоя банда сражается с беспредельщиком
</div>
<div class="dotted"></div>
<div class="block">        
    <span>    <img class="left mr8" src="/images/basement/<?=$podval_b['images']?>.jpg" width="50" height="50" alt="">    </span>
                                <img src="/images/icons/boss.png" width="16" alt="" hegiht="16"> <span><?=$podval_b['name']?> </span>        <span class="white">
    
    <img src="/images/icons/level.png" width="16" height="16" alt=""> <?=$podval_b['level']?> ур.    </span>
    <div class="m3" style="padding-left: 58px">    <div style="width: 100%; height: 4px"
            class="progress-grey">
            <div style="width: 100%; height: 4px" class="progress-green"></div></div>    </div>    <div>
            
    <img src="/images/icons/currentHealth.png" width="16" height="16" alt=""> <?=$podval_b['vit']?>            
    <img src="/images/icons/damage.png" width="16" height="16" alt=""> <?=$podval_b['str']?>          
    <img src="/images/icons/armor.png" width="16" height="16" alt=""> <?=$podval_b['def']?>         </div>
<div class="clear"></div>
</div>    <div class="dotted"></div>
    <div class="block center">
        <span class="btn_start"><span class="btn_end"><a class="btn" href="?exit=2">Присоединиться</a></span> </span>    </div>
</div>
		<?
		
		include './system/f.php';
		exit;
	}
	
	// Выходим из комнаты
	if($_GET['exit'] == 1) {
		mysql_query('UPDATE `podval_memb` SET `exit` = 1 WHERE `clan`= '.$clan['id'].' AND `user`= '.$user['id'].'');
		exit(header('Location: /basement/'));
	}
	
	$_podval_battle = mysql_num_rows( mysql_query('SELECT * FROM `podval_memb` WHERE `clan` = '.$clan['id'].'') );
if(isset($_GET['potion'])) {
    mysql_query('UPDATE `users` SET `s` = `s` - 80, `hp` = "'.($user['vit']).'",`mp` = "'.($user['mana']).'" WHERE `id` = "'.$user['id'].'"');
header('location: /basement/?');
exit;
}
	
	if($_GET['attack'] == $gen) {
	$_SESSION['clik'] = md5(rand(1111111,9999999));
	if($user['hp'] < ( ( ($user['vit'] * 2) / 100 ) * 12 ) OR $user['mp'] < 25) {
		$_SESSION['err'] = '<div class="alert"><div>    <div class="red s125">Не хватает здоровья</div>
    <div class="a_separator"></div>
    <div class="inline-block"><div class="block">
            <a href="#"><img class="left mr8" src="/images/items/794.jpg" alt=""></a>
            <img src="/images/icons/mixture.png" width="16" height="16" alt=""> <a class="" href="#"><span class="">Здоровяк</span></a>
        <span class="white">
    <img src="/images/icons/level.png" width="16" height="16" alt=""> 1 ур.    </span>
<div>
<span class="green">
<img src="/images/icons/currentHealth.png" width="16" height="16" alt="">&nbsp;+100%,</span>
<img src="/images/icons/date.png" width="16" height="16" alt="">    моментально
</div><div class="clear"></div>
</div>
<div class="clear"></div>
</div>
    <div class="a_separator"></div>
    <span class="btn_start"><span class="btn_end"><a class="btn" href="/basement/?potion">Восстановить за     <img src="/images/icons/silver.png" width="16" height="16" alt=""> 84</a></span> </span></div></div><div class="alert_bottom"></div>';
		exit(header('Location: /basement/'));
	}
	
	$dmg = 0;
    
    $opponent_dmg = 0;

$ability_1 = false; $ability_2 = false; $ability_3 = false; $ability_4 = false;
				

  $_ability = array(
  
  'a_1_bonus' => array(25, 25, 25, 30, 35, 40, 45, 45, 50, 55, 65, 65, 70, 75, 80, 85, 85, 90, 95, 100, 105, 105, 145, 165, 165),
  'a_1_chanse' => array(5, 5, 5, 5, 5, 5, 8, 8, 8, 8, 11, 11, 11, 11, 11, 14, 14, 14, 14, 14, 17, 17, 20, 23, 23),
  
  'a_2_bonus' => array(25, 25, 25, 30, 35, 40, 45, 45, 50, 55, 65, 65, 70, 75, 80, 85, 85, 90, 95, 100, 105, 105, 145, 165, 165),
  'a_2_chanse' => array(5, 5, 5, 5, 5, 5, 8, 8, 8, 8, 11, 11, 11, 11, 11, 14, 14, 14, 14, 14, 17, 17, 20, 23, 23),
  
  'a_3_bonus' => array(5,5,8,11,14,17,17,20,23,26,29,29,32,35,38,41,41,44,47,50,53,53,77,89,89),
  'a_3_crit_chanse' => array(5,5,5,5,5,5,7,7,7,7,7,9,9,9,9,9,11,11,11,11,11,13,15,17,17),
  'a_3_chanse' => array(20,20,20,20,20,20,25,25,25,25,25,30,30,30,30,30,35,35,35,35,35,40,45,50,50),
  
  'a_4_bonus' => array(20,20,22,24,26,28,28,30,32,34,36,36,36,38,40,42,44,44,46,48,50,52,52,68,76,76),
  'a_4_chanse' => array(5,5,5,5,5,5,10,10,10,10,10,15,15,15,15,15,20,20,20,20,20,25,30,35,35),
  
  'a_5_bonus' => array(2,2.5,3,3.5,4,4.5,5,6,6.6,7,7.7,8,8.8,9,9.9,10,10.5,11,11.5,12,13,14,15,18,20),
  'a_5_chanse' => array(5,5,5,5,5,6,6,6,6,6,7,7,7,7,8,8,8,8,9,9,9,10,11,13,15)
  
  );


  if($user['ability_1'] > 0) {
    if(mt_rand(0, 100) <= $_ability['a_1_chanse'][$user['ability_1']]) $ability_1 = true;
  }
  
  if($user['ability_2'] > 0) {
    if(mt_rand(0, 100) <= $_ability['a_2_chanse'][$user['ability_2']]) $ability_2 = true;
  }
  
  if($user['ability_3'] > 0) {
    if(mt_rand(0, 100) <= $_ability['a_3_chanse'][$user['ability_3']]) $ability_3 = true;
  }
  
  if($user['ability_4'] > 0) {
    if(mt_rand(0, 100) <= $_ability['a_4_chanse'][$user['ability_4']]) $ability_4 = true;
  }
  
  if($user['ability_5'] > 0) {
    if(mt_rand(0, 100) <= $_ability['a_5_chanse'][$user['ability_5']]) $ability_5 = true;
  }
  
  $dmg += ceil (rand(($user['str']/6), ($user['str']/4)));
  
  if ($ability_1 == true) $dmg += ceil (($dmg / 100) * $_ability['a_1_bonus'][$user['ability_1']]);
 	
	$dmg -= ceil (rand(($podval_b['def']/12), ($podval_b['def']/7)));        
	
	if ($dmg < 0) $dmg = 0;

	$crit = $ability_3 == true ? ((rand (1,2)*($user['agi']/100) + $_ability['a_3_crit_chanse'][$user['ability_3']])-(rand (1,2) * ($podval_b['def']/200))):((rand (1,2)*($user['agi']/100))-(rand (1,2)*($podval_b['def']/200)));

	if (mt_rand(0, 100) <= $crit) {   
		
		$dmg *= 2;
		
		if($ability_3 == true) $dmg += ceil (($dmg/100) * $_ability['a_3_bonus'][$user['ability_3']]);								
		
	}
	
    /*
    *
    attack
    *
    */	
	
	$opponent_dmg += round(rand(($podval_b['str']/6),($podval_b['str']/4)));
	
    if($ability_2 == true) $dmg -= round(($opponent_dmg / 100) * $_ability['a_2_bonus'][$user['ability_2']]);
	
	$opponent_dmg -= round(rand(($user['def']/12),($user['def']/7)));
    
    if($opponent_dmg < 0) $opponent_dmg = 0;
    
	$opponent_crit = ( (rand(1,2) * ($podval_b['def'] / 200) ) - (rand(1,2) * ($podval_b['def'] / 200)));

    if(mt_rand(0, 100) <= $opponent_crit) {
   
      $opponent_dmg *= 2;
    
    if($ability_4 == true) $opponent_dmg -= round(($opponent_dmg / 100) * $_ability['a_4_bonus'][$user['ability_4']]);
    
    }    

    	
	if($ability_5 == true) {
		
		if($user['hp'] <= ($user['vit'] * 2)) {
		mysql_query('UPDATE `users` SET `hp` = `hp` + '.round(($user['vit']/ 100) * $_ability['a_5_bonus'][$user['ability_5']]).' WHERE `id` = '.$user['id'].'');
		}
		
	}
	
	if ($dmg < 0) $dmg = 0;
	
	mysql_query('INSERT INTO `podval_logg` SET `clan` = "'.$clan['id'].'", `text` = "<img src=/images/icon/race/'.$user['r'].($user['online'] > (time() - 1000) ? '':'-off').'.png> '.$user['login'].' ударил '.$podval_b['name'].' на '.$dmg.' <font color=#c06060>'.($log_crit == true ? '(крит)':'урона').'</font><br /><img src=/images/podval/boss.png> '.$podval_b['name'].' ударил <img src=/images/icon/race/'.$user['r'].($user['online'] > (time() - 1000) ? '':'-off').'.png> '.$user['login'].' на '.$opponent_dmg.' урона", `time` = '.time().'');
	if($ability_1 == true) {
			mysql_query('INSERT INTO `podval_logg` SET `clan` = "'.$clan['id'].'", `text` = "<img src=/images/icon/race/'.$user['r'].'.png> <b>'.$user['login'].'</b> применил <img src=/images/icon/quality/'.$user['ability_1_quality'].'.png> Ярость титана</font>", `time` = '.time().'');
	}
	if($ability_3 == true) {
			mysql_query('INSERT INTO `podval_logg` SET `clan` = "'.$clan['id'].'", `text` = "<img src=/images/icon/race/'.$user['r'].'.png> <b>'.$user['login'].'</b> применил <img src=/images/icon/quality/'.$user['ability_3_quality'].'.png> Вихрь критов</font>", `time` = '.time().'');
	}



$my_atk += rand(round($user['str']/1), round($user['str']/1));
$bos_atk += rand(round($podval_b['str'] /4), round($podval_b['str'] /8));
$bos_atk -= rand(round($user['def']/17), round($user['def']/8));
$my_atk -= rand(round($podval_b['def'] /1), round($podval_b['def'] /5));


$pet_atk += rand(round($petsu['str']/1), round($petsu['str']/1));
$bosu_atk += rand(round($podval_b['str'] /4), round($podval_b['str'] /8));
$bosu_atk -= rand(round($petsu['def']/17), round($petsu['def']/8));
$pet_atk -= rand(round($podval_b['def'] /1), round($podval_b['def'] /5));

$msy_atk += rand(round($user['str']/1), round($user['str']/2));
$bosy_atk += rand(round($podval_b['str'] /1), round($podval_b['str'] /2));
$bosy_atk -= rand(round($user['def']/1), round($user['def']/2));
$msy_atk -= rand(round($podval_b['def'] /1), round($podval_b['def'] /5));


if($bosy_atk < 0)$bosy_atk = 0;
if($msy_atk < 0)$msy_atk = 0;

if($bos_atk < 0)$bos_atk = 0;
if($my_atk < 0)$my_atk = 0;

if($bosu_atk < 0)$bosu_atk = 0;
if($pet_atk < 0)$pet_atk = 0;

$pet_atka = $pet_atk*$user['lvl_sp'];

$bos_atka = $bosy_atk;
$bos_ataka = $bosy_atk;
$my_atka = $my_atk*$user['lvl_sp'];
$my_ataka = $my_atk;
if($bos_atka > 0){ $bos_atka="нанёс $bos_atka";}else{$bos_atka=" <span class=color2> промах </span>";}
	
	mysql_query('UPDATE `podval_clan` SET `vit` = `vit` - "'.$my_atka.'" WHERE `clan` = "'.$clan['id'].'"');
mysql_query('UPDATE `podval_clan` SET `vit` = `vit` - "'.$pet_atka.'" WHERE `clan` = "'.$clan['id'].'"');
	mysql_query('UPDATE `podval_memb` SET `dmg` = `dmg` + "'.$my_atka.'" WHERE `clan` = "'.$clan['id'].'" AND `user` = "'.$user['id'].'"');
	mysql_query('UPDATE `users` SET `hp` = `hp` - "'.$bos_ataka.'", `mp` = `mp` - 15 WHERE `id` = "'.$user['id'].'"');

$atas= "  <div class=green><img src=/images/icons/$user[r].png width=16 height=16 alt=> <span class=color3>$user[login]</span> нанёс $my_atka <img src=/images/icons/uron.png width=16 height=16 alt=> урона <span class=red>$podval_b[name]</span>  </div>";

if($petsu){
$petsa="<div class=green><img src=/images/icons/pet.png width=16 height=16 alt=> Питомец нанес $pet_atka урона</div>";}

mysql_query('INSERT INTO `podval_log` SET  `clan` = "'.$clan['id'].'",`time` = "'.time().'",`text` = "'.$atas.' '.$petsa.'",`user` = "'.$user['id'].'"');
$ats= "<img src=/images/icons/boss.png width=16 height=16 alt=> <span class=color3>$podval_b[name]</span> $bos_atka ";
mysql_query('INSERT INTO `podval_log` SET  `clan` = "'.$clan['id'].'",`time` = "'.time().'",`text` = "'.$ats.'",`user` = "'.$user['id'].'"');

			  exit(header('Location: /basement/'));
	
}

	?>
  <div class="content"><div class="block center color3 s125"><img src="/images/icons/circle.png" alt=""> <a href="/basement/?'.$udet.'"><?=$podval_b['name']?></a><span class="white">,<span id="time_<?=($podval_b['time'] - time());?>000"><?=_time($podval_b['time'] - time());?></span>
</span></div>

	<?	
	  if($_GET['memb'] == true) {
	?>
<div class="line"></div>
	<div class="h-navig"><table width="100%" border="0" cellpadding="0" cellspacing="0">
	<tbody><tr><td class="h-navig-item"><a href="/basement/">Бой</a></td>
	<td class="h-navig-item"><span class="active">В бою <b class="white">(<?=$_podval_battle;?>)</b></span></td>
	<td class="h-navig-item"><a href="?chat=true">Чат </a></td></tr></tbody></table></div>
<div class="line"></div>
	<div class="dotted"></div>
<ul class="block">
    <li>Участники сражения: <b><?=$_podval_battle;?> чел.</b></li>
</ul>
<div class="dotted"></div>
		 <?
	$max = 10;
	$count = mysql_result(mysql_query('SELECT COUNT(*) FROM `podval_memb` WHERE `clan` = '.$clan['id'].''),0);
    $pages = ceil($count/$max);
	$page = _string(_num($_GET['page']));
	if($page > $pages) $page = $pages;
	if($page < 1) $page = 1;
	$start = $page * $max - $max;
	if($page == 1) $i = $page - 1; elseif($page == 2) $i = ($page + 9); else $i = ($page * 10) - 9;
	
	$q = mysql_query('SELECT * FROM `podval_memb` WHERE `clan` = '.$clan['id'].' ORDER BY `dmg` DESC LIMIT '.$start.', '.$max.'');
	
	  while($memb = mysql_fetch_array($q)) {
	
	$us = mysql_fetch_array(mysql_query('SELECT * FROM `users` WHERE `id` = '.$memb['user'].''));
			
	?>
<?

   $w_1 = mysql_query('SELECT * FROM `inv` WHERE `user` = "'.$us['id'].'" AND `id` = "'.$us['w_1'].'"');
    $w_1 = mysql_fetch_array($w_1);
if(!$w_1) {
$w_1['item'] = 0;
}
    $w_2 = mysql_query('SELECT * FROM `inv` WHERE `user` = "'.$us['id'].'" AND `id` = "'.$us['w_2'].'"');
    $w_2 = mysql_fetch_array($w_2);
if(!$w_2) {
$w_2['item'] = 0;
}
    $w_3 = mysql_query('SELECT * FROM `inv` WHERE `user` = "'.$us['id'].'" AND `id` = "'.$us['w_3'].'"');
    $w_3 = mysql_fetch_array($w_3);
if(!$w_3) {
$w_3['item'] = 0;
}
    $w_4 = mysql_query('SELECT * FROM `inv` WHERE `user` = "'.$us['id'].'" AND `id` = "'.$us['w_4'].'"');
    $w_4 = mysql_fetch_array($w_4);
if(!$w_4) {
$w_4['item'] = 0;
}
    $w_5 = mysql_query('SELECT * FROM `inv` WHERE `user` = "'.$us['id'].'" AND `id` = "'.$us['w_5'].'"');
    $w_5 = mysql_fetch_array($w_5);
if(!$w_5) {
$w_5['item'] = 0;
}
    $w_6 = mysql_query('SELECT * FROM `inv` WHERE `user` = "'.$us['id'].'" AND `id` = "'.$us['w_6'].'"');
    $w_6 = mysql_fetch_array($w_6);
if(!$w_6) {
$w_6['item'] = 0;
}
    $w_7 = mysql_query('SELECT * FROM `inv` WHERE `user` = "'.$us['id'].'" AND `id` = "'.$us['w_7'].'"');
    $w_7 = mysql_fetch_array($w_7);
if(!$w_7) {
$w_7['item'] = 0;
}
    $w_8 = mysql_query('SELECT * FROM `inv` WHERE `user` = "'.$us['id'].'" AND `id` = "'.$us['w_8'].'"');
    $w_8 = mysql_fetch_array($w_8);
if(!$w_8) {
$w_8['item'] = 0;
}

if($us['r'] == 0) {
?>
       <img class="left mr8" src="http://bespredel.mobi/maneken?sex=man&amp;width=120&amp;height=160&amp;fragment=1&amp;frame=&amp;equip%5B1%5D=<?=$w_1['item']?>&amp;equip%5B2%5D=<?=$w_2['item']?>&amp;equip%5B3%5D=<?=$w_3['item']?>&amp;equip%5B4%5D=<?=$w_4['item']?>&amp;equip%5B5%5D=<?=$w_5['item']?>&amp;equip%5B6%5D=<?=$w_6['item']?>&amp;equip%5B7%5D=<?=$w_7['item']?>&amp;equip%5B8%5D=<?=$w_8['item']?>" width="50" height="50" alt="">


<?
}
if($us['r'] == 1) {
?>
      <img class="left mr8" src="http://bespredel.mobi/maneken?sex=woman&amp;width=120&amp;height=160&amp;fragment=1&amp;frame=&amp;equip%5B1%5D=<?=$w_1['item']?>&amp;equip%5B2%5D=<?=$w_2['item']?>&amp;equip%5B3%5D=<?=$w_3['item']?>&amp;equip%5B4%5D=<?=$w_4['item']?>&amp;equip%5B5%5D=<?=$w_5['item']?>&amp;equip%5B6%5D=<?=$w_6['item']?>&amp;equip%5B7%5D=<?=$w_7['item']?>&amp;equip%5B8%5D=<?=$w_8['item']?>" width="50" height="50" alt="">


<?
}
?>
                    <img src="/images/icons/<?=$us['r']?>.png" width="16" height="16" alt=""> <span><?=$us['login']?></span> <span class="small green"> * </span>        <span class="white">
    
    <img src="/images/icons/level.png" width="16" height="16" alt=""> <?=$us['level']?> ур.    </span>
    <div class="m3" style="padding-left: 58px">    <div style="width: 100%; height: 4px"
            class="progress-grey">
            <div style="width: <?=$hp_u?>%; height: 4px" class="progress-green"></div></div>    </div>    <div>
            
    <img src="/images/icons/currentHealth.png" width="16" height="16" alt=""> <?=$us['hp']?>            
    <img src="/images/icons/damage.png" width="16" height="16" alt=""> <?=$us['str']?>            
    <img src="/images/icons/armor.png" width="16" height="16" alt=""> <?=$us['def']?>        </div>
<div class="clear"></div>
<div class="mlrb5">
            <img src="/images/icons/uron.png" width="16" height="16" alt=""> Урон:<span class="bold">
                <?=$memb['dmg']?></span> </div>

  <div class="dotted"></div>

	<?
		
	}
echo '        <div class="dotted"></div>
        <ul class="block">
    <li class="color2 small">Участником сражения считается игрок, нанёсший хотя-бы один удар</li>
</ul>
';
	?>
<div class="dotted"></div>
<ul class="pagination"><li class="next"><?=pages('/podval/?memb=true&');?></li></ul>
	<?
	include './system/f.php';
	exit;
	
	
	}elseif($_GET['chat'] == true) {
		?>
<div class="line"></div>
			  <div class="h-navig"><table width="100%" border="0" cellpadding="0" cellspacing="0">
	  <tbody>
	  <tr>
	  <td class="h-navig-item"><a href="/basement/">Бой </a></td>
	  <td class="h-navig-item"><a href="?memb=true">Участники <b class="white">(<?=$_podval_battle;?>)</b></a></td>
	  <td class="h-navig-item"><span class="active">Чат</span></td>
	  </tr></tbody></table></div>
<div class="line"></div>
		<?
	    if(_string($_POST['submit'])) {
		$text = _string($_POST['text']);
		if (mb_strlen($text) < 2  OR mb_strlen($text) > 999)
		{
		$_SESSION['erro'] = 'Максимальная длина текста 6-25 символов';
		}
		
	    if(!$_SESSION['erro']) {
			
		$text = eregi_replace( "[[:alpha:]]+://[^<>[:space:]]+[[:alnum:]/]", "Реклама", $text);
        $text = str_replace(array('ru','net', 'com', 'рф', 'tk', 'su', 'us', 'mobi', 'ua', 'www', 'http'), '*', $text);
			
		mysql_query('INSERT INTO `podval_chat` SET `text` = "'.$text.'", `clan` = "'.$clan['id'].'", `user` = "'.$user['id'].'", `time` = "'.time().'"');
		}
		
        exit(header('Location: /basement/?chat=true'));		
		}
		?> <div class="block">
<img src="/images/icons/emoji/smile.png" width="16" height="16" alt="">&nbsp;<a id="toggler" class="tdnone dashed" href="/chat/?nocache=618470201#?nocache=1782656872">Показать смайлы</a><div id="smiles" style="display: none;">
            <img src="/images/icons/emoji/1.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:)&#039;)">            <img src="/images/icons/emoji/2.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:-D&#039;)">            <img src="/images/icons/emoji/3.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;;-)&#039;)">            <img src="/images/icons/emoji/4.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;xD&#039;)">            <img src="/images/icons/emoji/5.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;;-P&#039;)">            <img src="/images/icons/emoji/6.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;8-)&#039;)">            <img src="/images/icons/emoji/7.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:]&#039;)">            <img src="/images/icons/emoji/8.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;3(&#039;)">            <img src="/images/icons/emoji/9.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:_-(&#039;)">            <img src="/images/icons/emoji/10.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:_(&#039;)">            <img src="/images/icons/emoji/11.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:|&#039;)">            <img src="/images/icons/emoji/12.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;8|&#039;)">            <img src="/images/icons/emoji/13.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;^3&#039;)">            <img src="/images/icons/emoji/14.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;(XX)&#039;)">            <img src="/images/icons/emoji/15.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;|O^&#039;)">            <img src="/images/icons/emoji/16.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;^FU^&#039;)">            <img src="/images/icons/emoji/17.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;^((&#039;)">            <img src="/images/icons/emoji/18.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;^zz&#039;)">            <img src="/images/icons/emoji/19.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:*&#039;)">            <img src="/images/icons/emoji/20.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:^|&#039;)">            <img src="/images/icons/emoji/21.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:(x)&#039;)">            <img src="/images/icons/emoji/22.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:pf&#039;)">            <img src="/images/icons/emoji/23.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;O^^O&#039;)">            <img src="/images/icons/emoji/24.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;}:}&#039;)">            <img src="/images/icons/emoji/25.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;}:{&#039;)">            <img src="/images/icons/emoji/26.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:like:&#039;)">            <img src="/images/icons/emoji/27.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:dislike:&#039;)">            <img src="/images/icons/emoji/28.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:up:&#039;)">            <img src="/images/icons/emoji/29.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:v:&#039;)">            <img src="/images/icons/emoji/30.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:ok:&#039;)">            <img src="/images/icons/emoji/31.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:beer:&#039;)">            <img src="/images/icons/emoji/32.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:banan:&#039;)">            <img src="/images/icons/emoji/33.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;rose&#039;)">            <img src="/images/icons/emoji/34.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:pitushok:&#039;)">            <img src="/images/icons/emoji/35.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:sos:&#039;)">            <img src="/images/icons/emoji/36.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:cel:&#039;)">            <img src="/images/icons/emoji/37.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:crown:&#039;)">            <img src="/images/icons/emoji/38.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:baby:&#039;)">            <img src="/images/icons/emoji/39.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:boom:&#039;)">            <img src="/images/icons/emoji/40.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:gun:&#039;)">            <img src="/images/icons/emoji/41.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:love:&#039;)">            <img src="/images/icons/emoji/42.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:hurt:&#039;)">            <img src="/images/icons/emoji/43.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:police:&#039;)">            <img src="/images/icons/emoji/44.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:bolls:&#039;)">            <img src="/images/icons/emoji/45.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:ear:&#039;)">            <img src="/images/icons/emoji/46.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:fuck:&#039;)">            <img src="/images/icons/emoji/47.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:smoke:&#039;)">            <img src="/images/icons/emoji/48.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:donate:&#039;)">            <img src="/images/icons/emoji/49.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:gold:&#039;)">            <img src="/images/icons/emoji/50.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:silver:&#039;)">            <img src="/images/icons/emoji/51.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:health:&#039;)">            <img src="/images/icons/emoji/52.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:damage:&#039;)">            <img src="/images/icons/emoji/53.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:armor:&#039;)">            <img src="/images/icons/emoji/54.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:energy:&#039;)">            <img src="/images/icons/emoji/vp1.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:vp1:&#039;)">            <img src="/images/icons/emoji/vp2.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:vp2:&#039;)">            <img src="/images/icons/emoji/vp3.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:vp3:&#039;)">            <img src="/images/icons/emoji/vp4.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:vp4:&#039;)">            <img src="/images/icons/emoji/vp5.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:vp5:&#039;)">            <img src="/images/icons/emoji/vp6.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:vp6:&#039;)">            <img src="/images/icons/emoji/vp7.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:vp7:&#039;)">            <img src="/images/icons/emoji/vp8.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:vp8:&#039;)">            <img src="/images/icons/emoji/vp9.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:vp9:&#039;)">            <img src="/images/icons/emoji/vp10.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:vp10:&#039;)">            <img src="/images/icons/emoji/vp11.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:vp11:&#039;)">            <img src="/images/icons/emoji/vp12.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:vp12:&#039;)">            <img src="/images/icons/emoji/vp13.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:vp13:&#039;)">            <img src="/images/icons/emoji/vp14.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:vp14:&#039;)">            <img src="/images/icons/emoji/vp15.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:vp15:&#039;)">            <img src="/images/icons/emoji/vp16.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:vp16:&#039;)">            <img src="/images/icons/emoji/vp17.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:vp17:&#039;)">            <img src="/images/icons/emoji/vp18.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:vp18:&#039;)">    <img src="/images/icons/sm/sm1.gif" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:sm1:&#039;)">    <img src="/images/icons/sm/sm2.gif" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:sm2:&#039;)">    <img src="/images/icons/sm/sm3.gif" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:sm3:&#039;)">    <img src="/images/icons/sm/sm4.gif" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:sm4:&#039;)">    <img src="/images/icons/sm/sm5.gif" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:sm5:&#039;)">    <img src="/images/icons/sm/sm6.gif" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:sm6:&#039;)">    <img src="/images/icons/sm/sm7.gif" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:sm7:&#039;)">    <img src="/images/icons/sm/sm8.gif" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:sm8:&#039;)">    <img src="/images/icons/sm/sm9.gif" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:sm9:&#039;)">    <img src="/images/icons/sm/sm10.gif" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:sm10:&#039;)">    <img src="/images/icons/sm/sm11.gif" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:sm11:&#039;)">    <img src="/images/icons/sm/sm12.gif" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:sm12:&#039;)">    <img src="/images/icons/sm/sm13.gif" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:sm13:&#039;)"> <img src="/images/icons/sm/sm14.gif" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:sm14:&#039;)">  <img src="/images/icons/sm/sm15.gif" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:sm15:&#039;)">    <img src="/images/icons/sm/sm16.gif" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:sm16:&#039;)">    <img src="/images/icons/sm/sm17.gif" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:sm17:&#039;)">    <img src="/images/icons/sm/sm18.gif" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:sm18:&#039;)">    <img src="/images/icons/sm/sm19.gif" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:sm19:&#039;)">    <img src="/images/icons/sm/sm20.gif" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:sm20:&#039;)">    <img src="/images/icons/sm/sm21.gif" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:sm21:&#039;)">    <img src="/images/icons/sm/sm22.gif" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:sm22:&#039;)">    <img src="/images/icons/sm/sm23.gif" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:sm23:&#039;)">    <img src="/images/icons/sm/sm24.gif" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:sm24:&#039;)">
<img src="/images/icons/sm/sm25.gif" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:sm25:&#039;)">
<img src="/images/icons/sm/sm26.gif" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:sm26:&#039;)">    <img src="/images/icons/sm/sm27.gif" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:sm27:&#039;)">    <img src="/images/icons/sm/sm28.gif" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:sm28:&#039;)">    
</div>      

</div>    
<form id="comment" name="form" action="" method="post">
		<input name='text' class='form-control'  rows='1' value=""/>
<span class="m3 btn_start middle"><span class="btn_end">
<input type='submit' name='submit' class='btn' value='Отправить'/> 
</span>
        </span>
		</form>
	<?
		$max = 15;
		$count = mysql_result(mysql_query('SELECT COUNT(*) FROM `podval_chat` WHERE `clan` = "'.$clan['id'].'"'),0);
		$pages = ceil($count/$max);
		$page = _string(_num($_GET['page']));
		if($page > $pages) $page = $pages;
		if($page < 1) $page = 1;
		$start = $page * $max - $max;
		echo '<div class="content">';
		$q = mysql_query('SELECT * FROM `podval_chat` WHERE `clan` = "'.$clan['id'].'" ORDER BY `time` DESC LIMIT '.$start.', '.$max.'');
		while($row = mysql_fetch_array($q)) {
			
				$us = mysql_fetch_array(mysql_query('SELECT * FROM `users` WHERE `id` = '.$row['user'].''));
			
?>

<?
if($us['vip'] == 0 && $us['access'] == 0){
?>
<img src="/images/icons/<?=$us['r']?>.png" width="16" height="16" alt="">
<?
}

if($us['access'] == 1) {
?>
<img src="/images/icons/mod.png" width="16" height="16" alt="">
<?
}

if($us['access'] == 2) {
?>
<img src="/images/icons/mod.png" width="16" height="16" alt="">
<?}
if($us['access'] == 3) {
?>
<img src="/images/icons/adminy.png" width="16" height="16" alt="">
<?
}
if($us['vip'] == 1 && $us['access'] == 0){
?>
<img src="/images/icons/vip_<?=($us['r'] == man ? 'woman':'man')?>_<?=$us['r']?>.png" width="16" height="16" alt="">
<?
}
$color=$us['color'];
			?>
  <a class="color3" href="/user/<?=$us['id']?>/"><font style="text-shadow: 0px 5px 6px;" color=#<?=$color?>><?=$us['login']?> </font></a>

<?
    if($us['access'] == 1) {
?>
<font color='#f09060'>
<?
    }
    if($us['access'] == 2) {
?>
<font color='#008080'>
<?
    }
    if($us['access'] == 3) {
?>
<font color='#90c0c0'>
<?
    }
?>
                  <div class=""> <?=smiles($row['text'])?>
</div>
</font>


			<?
		}
		if($count == 0) echo '<div class="block">
Чат пуст!</div>
';
		
		?>
<div class="dotted"></div>
<ul class="pagination"><li class="next"><?=pages('/podval/?chat=true&');?></li></ul>
		<?
		
		
		include './system/f.php';
		exit;	
		
	
	}else{
	?>
	
<div class="line"></div>
	  <div class="h-navig"><table width="100%" border="0" cellpadding="0" cellspacing="0">
	  <tbody>
	  <tr>
	  <td class="h-navig-item"><span class="active">Бой</span></td>
	  <td class="h-navig-item"><a href="?memb=true">Участники <b class="white">(<?=$_podval_battle;?>)</b></a></td>
	  <td class="h-navig-item">
	  <a href="?chat=true">Чат </a></td></tr></tbody></table></div>
<div class="line"></div>
	
	<?
	}

$bos_hp = round(100 / ($podval_b['max_hp']/ $podval_b['vit']));
if($bos_hp>100){
$bos_hp=100;
}

	?>
    <div class="block center">
        <span class="s125">
            <img src="/images/icons/reward.png" width="16" height="16" alt=""> Ништяки:
                <img src="/images/icons/experience.png" width="16" height="16" alt=""> <?=$podval_b['exp']?>    <img src="/images/icons/silver.png" width="16" height="16" alt=""> <?=$podval_b['s']?>        </span>
            </div>
    <div class="dotted"></div>
<div class="block">        
    <div class="center">    <a href="?attack=<?=$gen?>"><img class="center " src="/images/basement/<?=$podval_b['images']?>.jpg" width="50" height="50" alt=""></a>    </div>
                                <img src="/images/icons/boss.png" width="16" alt="" hegiht="16"> <span class="center"><?=$podval_b['name']?></span>        <span class="white">
    

    <img src="/images/icons/level.png" width="16" height="16" alt=""> <?=$podval_b['level']?> ур.    </span>
    <div class="m3" style="">    <div style="width: 100%; height: 4px"
            class="progress-grey">
            <div style="width: <?=$bos_hp?>%; height: 4px" class="progress-green"></div></div>    </div>    <div>
            
    <img src="/images/icons/currentHealth.png" width="16" height="16" alt=""> <?=$podval_b['vit']?>            
    <img src="/images/icons/damage.png" width="16" height="16" alt=""> <?=$podval_b['str']?>            
    <img src="/images/icons/armor.png" width="16" height="16" alt=""> <?=$podval_b['def']?>        </div>
<div class="clear"></div>
</div>    <div class="dotted"></div>
    <div class="block center">
        <span class="btn_start"><span class="btn_end"><a class="btn" href="?attack=<?=$gen?>">Ηaнеcти yдар</a></span> </span>    </div>
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
                    <img src="/images/icons/<?=$user['r']?>.png" width="16" height="16" alt=""> <span><?=$user['login']?></span> <span class="small green"> * </span>        <span class="white">
    
    <img src="/images/icons/level.png" width="16" height="16" alt=""> <?=$user['level']?> ур.    </span>
    <div class="m3" style="padding-left: 58px">    <div style="width: 100%; height: 4px"
            class="progress-grey">
            <div style="width: 100%; height: 4px" class="progress-green"></div></div>    </div>    <div>
            
    <img src="/images/icons/currentHealth.png" width="16" height="16" alt=""> <?=$user['hp']?>            
    <img src="/images/icons/damage.png" width="16" height="16" alt=""> <?=$user['str']?>            
    <img src="/images/icons/armor.png" width="16" height="16" alt=""> <?=$user['def']?>        </div>
<div class="clear"></div>
</div>    
<? if($petsu){?>

<div class="block">        
    <span>    <img class="left mr8" src="/images/pets/<?=$petsu['pet']?>.jpg" width="50" height="50" alt="">    </span>
                                <img src="/images/icons/pet_<?=$petsu['pet']?>.png" width="16" height="16" alt=""> <span><?=$petsu['name']?></span>        <span class="white">
    
    <img src="/images/icons/level.png" width="16" height="16" alt=""> <?=$petsu['lvl']?> ур.    </span>
<div>
            
    <img src="/images/icons/currentHealth.png" width="16" height="16" alt=""> <?=$petsu['vit']?>            
    <img src="/images/icons/damage.png" width="16" height="16" alt=""> <?=$petsu['str']?>            
    <img src="/images/icons/armor.png" width="16" height="16" alt=""> <?=$petsu['def']?>        </div>
<div class="clear"></div>
</div>    <div class="dotted"></div>
<?}?>
  <div class="dotted"></div>

<?

echo '<div class="bold">Серия из '.$user['lvl_sp'].' удара(ов)</div>
';

$q = mysql_query('SELECT * FROM `podval_log` WHERE `user` = "'.$user['id'].'" ORDER BY `time` DESC LIMIT 5');    
  while($row = mysql_fetch_array($q)) {


echo '<div class="small">

'.$row['text'].' </div>';
}
?>
<div class="dotted"></div><div class="block">
        <img src="/images/icons/members.png" width="16" height="16" alt="">        <span class="blue">Участники сражения:</span> (<?=$_podval_battle;?>)
    </div>
	
	  <?
	$max = 10;
	$count = mysql_result(mysql_query('SELECT COUNT(*) FROM `podval_memb` WHERE `clan` = '.$clan['id'].''),0);
    $pages = ceil($count/$max);
	$page = _string(_num($_GET['page']));
	if($page > $pages) $page = $pages;
	if($page < 1) $page = 1;
	$start = $page * $max - $max;
	if($page == 1) $i = $page - 1; elseif($page == 2) $i = ($page + 9); else $i = ($page * 10) - 9;
	
	$q = mysql_query('SELECT * FROM `podval_memb` WHERE `clan` = '.$clan['id'].' ORDER BY `dmg` DESC LIMIT '.$start.', '.$max.'');
	
	  while($memb = mysql_fetch_array($q)) {
	
	$us = mysql_fetch_array(mysql_query('SELECT * FROM `users` WHERE `id` = '.$memb['user'].''));

echo ' <div class="dotted"></div>
<div class="block">';
?>
<?
if($us['vip'] == 0){
?>
<img src="/images/icons/<?=$us['r']?>.png" width="16" height="16" alt="">
<?
}
if($us['vip'] == 1){
?>
<img src="/images/icons/vip_<?=($us['r'] == man ? 'woman':'man')?>_<?=$us['r']?>.png" width="16" height="16" alt="">
<?
}
?>
<?
echo '<a class="color3" href="/user/'.$us['id'].'">'.$us['login'].' </a>, урон: <img src="/images/icons/uron.png" width="16" height="16" alt="">'.($memb['dmg']).'</div>';
        
}
?>

<div class="dotted"></div>
<ul class="pagination"><li class="next"><?=pages('/podval/?');?></li></ul>
	<div class="dotted"></div>
<div class="menu"> <li><a href="?exit=1"><img src="/images/icons/cross.png" width="16" height="16" alt=""> Покинуть комнату </a></li></div><div class="dotted"></div>
</div>

	<? 
	}else{
echo'  <div class="content"><div class="block center color3 s125">Подвал</div>
            <div class="line"></div>';
	    if($_GET['complist'] == 2) {
		?>
	    <div class="h-navig"><table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tbody><tr>
		<td class="h-navig-item"><a href="?complist=1">лёгкие</a></td>
		<td class="h-navig-item"><span class="active">средние</span></td>
		<td class="h-navig-item"><a href="?complist=3">сложные</a></td>
		<td class="h-navig-item"><a href="?complist=4">сверх-сложные</a></td>
		</tr></tbody></table></div>
			<?
		$type = 2; 
		}elseif($_GET['complist'] == 3) {
					?>
	    <div class="h-navig"><table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tbody><tr>
		<td class="h-navig-item"><a href="?complist=1">лёгкие</a></td>
		<td class="h-navig-item"><a href="?complist=2">средние</a></td>
		<td class="h-navig-item"><span class="active">сложные</span></td>
		<td class="h-navig-item"><a href="?complist=4">сверх-сложные</a></td>
		</tr></tbody></table></div>
			<?
		$type = 3; 
		}elseif($_GET['complist'] == 4) {
								?>
	    <div class="h-navig"><table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tbody><tr>
		<td class="h-navig-item"><a href="?complist=1">лёгкие</a></td>
		<td class="h-navig-item"><a href="?complist=2">средние</a></td>
		<td class="h-navig-item"><a href="?complist=3">сложные</a></td>
		<td class="h-navig-item"><span class="active">сверх-сложные</span></td>
		</tr></tbody></table>
			<?
		$type = 4; 
		}elseif($_GET['complist'] == 5){
			?>
	    <div class="h-navig"><table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tbody><tr>
		<td class="h-navig-item"><a href="?complist=1">лёгкие</a></td>
		<td class="h-navig-item"><a href="?complist=2">средние</a></td>
		<td class="h-navig-item"><a href="?complist=3">сложные</a></td>
		<td class="h-navig-item"><a href="?complist=4">сверх-сложные</a></td>
		<td class="h-navig-item"><span class="active">Адское</span></td>
		</tr></tbody></table></div>
<?
		$type = 5; 
		}else{
			?>
	    <div class="h-navig"><table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tbody><tr>
		<td class="h-navig-item"><span class="active">лёгкие</span></td>
		<td class="h-navig-item"><a href="?complist=2">средние</a></td>
		<td class="h-navig-item"><a href="?complist=3">сложные</a></td>
		<td class="h-navig-item"><a href="?complist=4">сверх-сложные</a></td>
		</tr></tbody></table></div>
			<?
			$type = 1;
		}		
		echo '<div class="dotted"></div>';


if($_GET['confirm'] == true && $clan_memb['rank'] > 2) {
	
	  $id = _string(_num($_GET['id']));
	  $podval = mysql_fetch_array(mysql_query('SELECT * FROM `podval_list` WHERE `id`= "'.$id.'"'));
	  
	  if(!$podval OR ($podval['level'] - 1) > $clan['level']) {
$_SESSION['err'] = '<div class="alert"><div>  '.$podval['name'].' доступен с '.$podval['level'].' уровня банды</div></div>';
		exit(header('Location: /basement/'));
	}
	
	if($podval['id'] > 1 && $podval_key['key_'.$podval['id'].''] <= 0) {
$_SESSION['err'] = '<div class="alert"><div>  У вашей банды нет ключей!</div></div>';
		exit(header('Location: /basement/'));
	}
	
	mysql_query('INSERT INTO `podval_clan` SET `clan`= "'.$clan['id'].'", `name`= "'.$podval['name'].'", `str`= "'.$podval['str'].'", `vit`= "'.$podval['vit'].'", `def`= "'.$podval['def'].'", `type`= "'.$podval['type'].'", `time`= "'.(time() + $podval['time']).'", `images`= "'.$podval['id'].'", `level`= "'.$podval['level'].'", `max_hp`= "'.$podval['max_hp'].'", `g`= "'.$podval['g'].'", `s`= "'.$podval['s'].'", `exp`= "'.$podval['exp'].'"');



$texy="<img src=/images/icons/boss.png width=16 height=16 alt=>            <span class=color3>$podval[name]</span>";
$timey=time();
mysql_query('INSERT INTO `clan_journal` SET `cl_id` = "'.$clan['id'].'",`time` = "'.$timey.'",`cl` = "3",`text` = "'.$texy.'",`user` = "'.$user['id'].'"');
	
	if($podval['id'] > 1) {
		mysql_query('UPDATE `podval_key` SET `key_'.$podval['id'].'` = `key_'.$podval['id'].'` - 1 WHERE `clan` = '.$clan['id'].'');
	}
	
	if(!$podval_memb) {
	mysql_query('INSERT INTO `podval_memb` SET `clan` = "'.$clan['id'].'", `user` = "'.$user['id'].'", `exit` = 0');
	}
	
	exit(header('Location: /basement/')); // Ок бой создан, теперь идем в бой!
}

$q = mysql_query('SELECT * FROM `podval_list` WHERE `type`= "'.$type.'"');
      
	  while($wiew = mysql_fetch_array($q)) {
		  

?>

    <div class="block">        
    <span>    <a href="?confirm=true&id=<?=$wiew['id']?>/"><img class="left mr8" src="/images/basement/<?=$wiew['id']?>.jpg" width="50" height="50" alt=""> </a>
  </span>
                                <img src="/images/icons/boss.png" width="16" alt="" hegiht="16"> <span>
<?=$wiew['name']?></span>        <span class="white">
    
    <img src="/images/icons/level.png" width="16" height="16" alt=""> 
<?=$wiew['level']?> ур.    </span>
    <div>
            
    <img src="/images/icons/health.png" width="16" height="16" alt=""> 
<?=$wiew['vit']?>            
    <img src="/images/icons/damage.png" width="16" height="16" alt=""> 
<?=$wiew['str']?>            
    <img src="/images/icons/armor.png" width="16" height="16" alt=""> 
<?=$wiew['def']?>        </div>
<div class="clear"></div>
</div>
<?

	if($wiew['id'] > 1) {
	?>
	<?=($podval_key['key_'.$wiew['id'].''] > 0 ? '<div class="dotted"></div>
 <div class="block center color3">
<img src="/images/icons/key.png" alt=""> Ключи: <b class="green">'.$podval_key['key_'.$wiew['id'].''].' шт.</b>
     </div>' : '<div class="dotted"></div>
 <div class="block center color3">
<img src="/images/icons/key.png" alt=""> Ключи: <b class="red">0 шт.</b>
</div>
');?>
<?
	}
	if($clan_memb['rank'] > 2 && $podval_key['key_'.$wiew['id'].''] > 0) {
		?>
			<?=($clan_memb['rank'] > 2 && $podval_key['key_'.$wiew['id'].''] > 0 ? ' <div class="dotted"></div>
        <div class="block center">
            <span class="btn_start"><span class="btn_end"><a class="btn" href="?confirm=true&id='.$wiew['id'].'/">Ηачать cражение</a></span> </span>        </div>
' : '');?>
		<?
	}elseif($clan_memb['rank'] > 2 && $wiew['id'] == 1) {
				?>
<div class="dotted"></div>
        <div class="block center">
            <span class="btn_start"><span class="btn_end"><a class="btn" href="?confirm=true&id=<?=$wiew['id'];?>/?<?=$udet?>">Ηачать cражение</a></span> </span>        </div>
		<?
	}


echo '<div class="dotted"></div>';
}
	
	
}
echo '</div>';

include './system/f.php'; 
?>