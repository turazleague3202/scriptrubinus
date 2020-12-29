<?
    
    include './system/common.php';
    
 include './system/functions.php';
        
      include './system/user.php';
    

if(!$user) {

  header('location: /');
    
exit;

}

 if($user['access'] <4) {


}else{

$_SESSION['not']='<div class="alert"><div>                Ведутся тех.работы!</div></div>';
header('location: /menu?'.$udet.'');
    exit;
}

    $title = 'Бунт';    

include './system/h.php';  


if($user['level'] >= 10) {



if($user['level'] >= 10 && $user['level'] <= 30) { 
 $opponent_str = 20000;
 $opponent_def = 14000;
$lvlx=1;
}
if($user['level'] >= 30 && $user['level'] <= 50) { 
 $opponent_str = 40000;
 $opponent_def = 24000;
$lvlx=2;
}
if($user['level'] >= 50 && $user['level'] <= 70) { 
 $opponent_str = 100000;
 $opponent_def = 124000;
$lvlx=3;
}
if($user['level'] >= 70 && $user['level'] <= 80) {
 $opponent_str = 165000;
 $opponent_def = 174000;
$lvlx=4;
}
if($user['level'] >= 80 && $user['level'] <= 100) { 
 $opponent_str = 203000;
 $opponent_def = 244000;
$lvlx=5;
}
if($user['level'] >= 100 && $user['level'] <= 130) { 
 $opponent_str = 300000;
 $opponent_def = 470000;
$lvlx=6;
}
if($user['level'] >= 130 && $user['level'] <= 150) { 
 $opponent_str = 800000;
 $opponent_def = 1404000;
$lvlx=7;
}
  $member = mysql_query('SELECT * FROM `undying_member` WHERE `user` = "'.$user['id'].'" ORDER BY `id` DESC LIMIT 1');
  $member = mysql_fetch_array($member);
  
  $battle = mysql_query('SELECT * FROM `undying` WHERE `id` = "'.$member['battle'].'" AND `lvl`="'.$member['lvl'].'" ');
  $battle = mysql_fetch_array($battle);  
  
$hp_ur = round(100 / ($user['vit']/ $user['hp']));
if($hp_urr > 100){
$hp_urr=100;
}

  if($member['exit'] == 0 && $battle['start'] == 1 && $battle['end'] == 0) {



$titans = mysql_result(mysql_query('SELECT COUNT(*) FROM `undying_member` WHERE `battle` = "'.$battle['id'].'" AND `lvl`="'.$member['lvl'].'"'),0);
if($titans == 0 OR $battle['opponents'] <= 0) {mysql_query('UPDATE `undying` SET `end` = "1" WHERE `id` = "'.$battle['id'].'" AND `lvl`="'.$member['lvl'].'"');
header('location: /bunt/');
exit();
}

if($battle['time'] < time()) {mysql_query('UPDATE `undying` SET `end` = "1" WHERE `id` = "'.$battle['id'].'" AND `lvl`="'.$member['lvl'].'"');
header('location: /bunt/');exit;}

if(isset($_GET['potion'])) {
    mysql_query('UPDATE `users` SET `s` = `s` - 80, `hp` = "'.($user['vit']).'", `mp` = "'.($user['mana']).'"WHERE `id` = "'.$user['id'].'"');

header('location: /bunt/?'.$udet.'');
exit;
}
if(isset($_GET['hpnoy'])) {
echo '<div class="alert"><div>    <div class="red s125">Не хватает здоровья</div>
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
    <span class="btn_start"><span class="btn_end"><a class="btn" href="/bunt/?potion">Восстановить за     <img src="/images/icons/silver.png" width="16" height="16" alt=""> 84</a></span> </span></div></div><div class="alert_bottom"></div>';
}
?>
<?	
$_podval_battle = mysql_num_rows( mysql_query('SELECT * FROM `undying_member` WHERE `battle` = '.$battle['id'].'') );
	  if(isset($_GET['memb'])) {
	?>
 <div class="content">
	<div class="h-navig"><table width="100%" border="0" cellpadding="0" cellspacing="0">
	<tbody><tr><td class="h-navig-item"><a href="?">Бой</a></td>
	<td class="h-navig-item"><span class="active">В бою <b class="white">(<?=$_podval_battle;?>)</b></span></td></tr></tbody></table></div>
<div class="line"></div>
	<div class="dotted"></div>
<ul class="block">
    <li>Участники сражения: <b><?=$_podval_battle;?> чел.</b></li>
</ul>
<div class="dotted"></div>
		 <?
	$max = 10;
	$count = mysql_result(mysql_query('SELECT COUNT(*) FROM `undying_member` WHERE `battle` = '.$battle['id'].' AND `lvl` ='.$lvlx.''),0);
    $pages = ceil($count/$max);
	$page = _string(_num($_GET['page']));
	if($page > $pages) $page = $pages;
	if($page < 1) $page = 1;
	$start = $page * $max - $max;
	if($page == 1) $i = $page - 1; elseif($page == 2) $i = ($page + 9); else $i = ($page * 10) - 9;
	
	$q = mysql_query('SELECT * FROM `undying_member` WHERE `battle` = '.$battle['id'].' AND `lvl` ='.$lvlx.' ORDER BY `dmg` DESC LIMIT '.$start.', '.$max.'');
	
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
<ul class="pagination"><li class="next"><?=pages('?memb&');?></li></ul>
	<?
	include './system/f.php';
	exit;
}
?>
<div class="content">
<div class="h-navig"><table width="100%" border="0" cellpadding="0" cellspacing="0">
	<tbody><tr><td class="h-navig-item"><span class="active">Бой </td>
<td class="h-navig-item"><a href="?memb">В бою<b class="white">(<?=$_podval_battle;?>)</b></a></td></tr></tbody></table></div>

  <div class="line"></div>   
<div class="block center color3 s125"><img src="/images/icons/circle.png" alt=""> <a href="?">Бунт</a><span class="white">, <?=_time($battle['time'] - time())?></span>
          </div>  <div class="line"></div>   
<div class="content">
<?

  if(isset($_GET['attack'])) {

$_hp = ceil($user['vit']*40/100);
if($user['hp'] < $_hp OR $user['mp'] < 100){
header('location: /bunt/?hpnoy');
exit;
}else{
}

if($user['mp'] < 100){
header('location: /bunt/?hpnoy');
exit;
}else{
}



 
$my_atk = rand(round($user['str']/4), round($user['str']/1));
$bos_atk = rand(round($opponent_str/7), round($opponent_str/3));
$bos_atk -= rand(round($user['def']/7), round($user['def']/4));
$my_atk -= rand(round($opponent_def/5), round($opponent_def/3));

if($bos_atk < 0)$bos_atk = 0;
if($my_atk < 0)$my_atk = 0;

$my_ataka = $my_atk;
$bos_ataka = $bos_atk;
    

$bos_atku = $bos_atk;
$my_atku = $my_atk;

if($bos_atku > 0){ $bos_atku="нанёс $bos_atku";}else{$bos_atku=" <span class=color2> промах </span>";}
if($my_atku > 0){ $my_atku="нанёс $my_atku";}else{$my_atku=" <span class=color2> промах </span>";}

 
$kil=rand(0,1);
    mysql_query('UPDATE `undying_member` SET `kills` = "'.($member['kills'] + $kil).'" WHERE `user` = "'.$user['id'].'" AND `battle` = "'.$battle['id'].'" AND `lvl`="'.$lvlx.'"');








if($user['level'] >= 10 && $user['level'] <= 30) {

$lvlx=1;
mysql_query('UPDATE `undying` SET `opponents` = `opponents` - "'.$my_ataka.'" WHERE `id` = "'.$battle['id'].'" AND `lvl`="1"');
}
if($user['level'] >= 30 && $user['level'] <= 50) {

$lvlx=2;
mysql_query('UPDATE `undying` SET `opponents` = `opponents` - "'.$my_ataka.'" WHERE `id` = "'.$battle['id'].'" AND `lvl`="2"');
}
if($user['level'] >= 50 && $user['level'] <= 70) {

$lvlx=3;
mysql_query('UPDATE `undying` SET `opponents` = `opponents` - "'.$my_ataka.'" WHERE `id` = "'.$battle['id'].'" AND `lvl`="3"');
}
if($user['level'] >= 70 && $user['level'] <= 80) {

$lvlx=4;
mysql_query('UPDATE `undying` SET `opponents` = `opponents` - "'.$my_ataka.'" WHERE `id` = "'.$battle['id'].'" AND `lvl`="4"');
}
if($user['level'] >= 80 && $user['level'] <= 100) {
$lvlx=5;
mysql_query('UPDATE `undying` SET `opponents` = `opponents` - "'.$my_ataka.'" WHERE `id` = "'.$battle['id'].'" AND `lvl`="5"');
}
if($user['level'] >= 100 && $user['level'] <= 130) {

$lvlx=6;
mysql_query('UPDATE `undying` SET `opponents` = `opponents` - "'.$my_ataka.'" WHERE `id` = "'.$battle['id'].'" AND `lvl`="6"');
}
if($user['level'] >= 130 && $user['level'] <= 150) {

$lvlx=7;
mysql_query('UPDATE `undying` SET `opponents` = `opponents` - "'.$my_ataka.'" WHERE `id` = "'.$battle['id'].'" AND `lvl`="7"');
}

$sek=2;
$expo=rand(1,79);
$say=rand(5,100);
mysql_query('UPDATE `users` SET `hp` = `hp` - "'.$bos_ataka.'" WHERE `id` = "'.$user['id'].'"');
    mysql_query('UPDATE `undying_member` SET `time` = "'.(time() + $sek).'",
`timer` = "'.time().'", `dmg` = `dmg` + "'.$my_ataka.'",`exp` = `exp` + "'.$expo.'",`s` = `s` + "'.$say.'"WHERE `user` = "'.$user['id'].'" AND `battle` = "'.$battle['id'].'" AND `lvl`="'.$lvlx.'"');



 

  mysql_query('UPDATE `users` SET `mp` = "'.($user['mp'] - 30).'" WHERE `id` = "'.$user['id'].'"');


$_SESSION['not']='</div>
            <div class="block"><div class="color2 small"> <img src="/images/icons/swords.png" width="16" height="16" alt=""> Журнал сражения:</div><div class="small">
<img src="/images/icons/essence.png" width="16" height="16" alt="">&nbsp;<span class="color3">Беспредельщик</span>  '.$bos_atku.' <img src="/images/icons/uron.png" width="16" height="16" alt=""> урона

<div class="small">
<img src="/images/icons/'.$user['r'].'.png" width="16" height="16" alt="">&nbsp;<span class="color3">'.$user['login'].'</span> '.$my_atku.' <img src="/images/icons/uron.png" width="16" height="16" alt=""> урона
</div></div><div class="dotted"></div> 

</div>';
header('location: /bunt/?');

 }


if($member['lvl'] ==1) {
if($battle['opponents'] == 0) {header('location: /bunt/');exit();}
}
if($member['lvl'] ==2) {
if($battle['opponents'] == 0) {header('location: /bunt/');exit();}
}
if($member['lvl'] ==3) {
if($battle['opponents'] == 0) {header('location: /bunt/');exit();}
}
if($member['lvl'] ==4) {
if($battle['opponents'] == 0) {header('location: /bunt/');exit();}
}
if($member['lvl'] ==5) {
if($battle['opponents'] == 0) {header('location: /bunt/');exit();}
}
if($member['lvl'] ==6) {
if($battle['opponents'] == 0) {header('location: /bunt/');exit();}
}
if($member['lvl'] ==7) {
if($battle['opponents'] == 0) {header('location: /bunt/');exit();}
}
if($user['level'] >= 10 && $user['level'] <= 30) { 
 $opponent_str = 20000;
 $opponent_def = 14000;
$lvlx=1;

 $oponent_hp = $battle['opponents'];
$hp_b = round(100 / ($battle['hp_max']/ $battle['opponents']));
if($hp_b > 100){
$hp_b=100;
}
}
if($user['level'] >= 30 && $user['level'] <= 50) { 
 $opponent_str = 40000;
 $opponent_def = 24000;
$lvlx=2;
if($battle['hp1'] == 0) {header('location: /bunt/');}
 $oponent_hp = $battle['opponents'];
$hp_b = round(100 / ($battle['hp_max1']/ $battle['opponents']));
if($hp_b > 100){
$hp_b=100;
}
}
if($user['level'] >= 50 && $user['level'] <= 70) { 
 $opponent_str = 100000;
 $opponent_def = 124000;
$lvlx=3;

 $oponent_hp = $battle['opponents'];
$hp_b = round(100 / ($battle['hp_max2']/ $battle['opponents']));
if($hp_b > 100){
$hp_b=100;
}
}
if($user['level'] >= 70 && $user['level'] <= 80) { 
 $opponent_str = 165000;
 $opponent_def = 174000;
$lvlx=4;

 $oponent_hp = $battle['opponents'];
$hp_b = round(100 / ($battle['hp_max3']/ $battle['opponents']));
if($hp_b > 100){
$hp_b=100;
}
}
if($user['level'] >= 80 && $user['level'] <= 100) { 
 $opponent_str = 203000;
 $opponent_def = 244000;
$lvlx=5;

 $oponent_hp = $battle['opponents'];
$hp_b = round(100 / ($battle['hp_max4']/ $battle['opponents']));
if($hp_b > 100){
$hp_b=100;
}
}
if($user['level'] >= 100 && $user['level'] <= 130) { 
 $opponent_str = 300000;
 $opponent_def = 470000;
$lvlx=6;

 $oponent_hp = $battle['opponents'];
$hp_b = round(100 / ($battle['hp_max5']/ $battle['opponents']));
if($hp_b > 100){
$hp_b=100;

}
}
if($user['level'] >= 130 && $user['level'] <= 150) { 
 $opponent_str = 800000;
 $opponent_def = 1404000;
$lvlx=7;

 $oponent_hp = $battle['opponents'];
$hp_b = round(100 / ($battle['hp_max6']/ $battle['opponents']));
if($hp_b > 100){
$hp_b=100;
}
}
?>

 <div class="block center">
        <span class="s125">
            <img src="/images/icons/reward.png" width="16" height="16" alt=""> Ништяки:
                <img src="/images/icons/experience.png" width="16" height="16" alt=""> <?=$member['exp']?>    <img src="/images/icons/silver.png" width="16" height="16" alt=""> <?=$member['s']?> <img src="/images/icons/gold.png" width="16" height="16" alt=""> <?=$member['kills']*2?>
<img src="/images/icons/key.png" width="16" height="16" alt=""> <?=$member['kills']?>
        </span>
            </div>
    <div class="dotted"></div>

<div class="block">        
    <span>    <a href="?attack"><img class="left mr8" src="/images/1.jpg" width="50" height="50" alt=""></a>    </span>
                                <img src="/images/icons/essence.png" width="16" height="16" alt=""> <span>Беспредельщик</span>        <span class="white">
    
    <img src="/images/icons/level.png" width="16" height="16" alt=""> <?=$lvlx?>
 ур.    </span>
    <div class="m3" style="padding-left: 58px">    <div style="width: 100%; height: 4px"
            class="progress-grey">




            <div style="width: <?=$hp_b?>%; height: 4px" class="progress-green"></div></div>    </div>    <div>
            
    <img src="/images/icons/currentHealth.png" width="16" height="16" alt="">  <?=$oponent_hp?>
          
    <img src="/images/icons/damage.png" width="16" height="16" alt="">  <?=$opponent_str?>
            
    <img src="/images/icons/armor.png" width="16" height="16" alt="">  <?=$opponent_def?>
        </div>
<div class="clear"></div>
</div>    <div class="dotted"></div>
    <div class="block center">
        <span class="btn_start"><span class="btn_end"><a class="btn" href="?attack">Нaнеcти yдaр</a></span> </span>    </div>

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
                    <img src="/images/icons/<?=$user['r']?>.png" width="16" height="16" alt=""> <span><?=$user['login']?></span>     <span class="white">
    
    <img src="/images/icons/level.png" width="16" height="16" alt=""> <?=$user['level']?> ур.    </span>
    <div class="m3" style="padding-left: 58px">    <div style="width: 100%; height: 4px"
            class="progress-grey">
            <div style="width: <?=$hp_ur?>%; height: 4px" class="progress-green"></div></div>    </div>    <div>
            
    <img src="/images/icons/currentHealth.png" width="16" height="16" alt=""> <?=$user['hp']?>            
    <img src="/images/icons/damage.png" width="16" height="16" alt=""> <?=$user['str']?>            
    <img src="/images/icons/armor.png" width="16" height="16" alt=""> <?=$user['def']?>        </div>
<div class="clear"></div>


</div>
<?

echo '   <div class="dotted"></div>
    <div class="block">
        <img src="/images/icons/medal.png" width="16" height="16" alt="">        <span class="blue">Лидеры сражения:</span>
    </div>
';

?>
<?

$q = mysql_query('SELECT * FROM `undying_member` WHERE `battle` = "'.$battle['id'].'" AND `lvl`="'.$lvlx.'" ORDER BY `dmg` DESC, `timer` DESC LIMIT 10');    
  while($row = mysql_fetch_array($q)) {

$i++;

$ank=mysql_fetch_array(mysql_query('SELECT * FROM `users` WHERE `id` = "'.$row['user'].'" LIMIT 1'));
  

if($i<4){
echo '
    <div class="dotted"></div>
    <div class="block">
                                        <img src="/images/icons/place'.$i.'.png" width="16" height="16" alt=""> <a class="color3" href="/user/'.$ank['id'].'">'.$ank['login'].' </a>, урон:
                <img src="/images/icons/uron.png" width="16" height="16" alt=""> '.($row['dmg']).'</div>

';
}
?>

<?
}

echo'</div></div></div>';

  }
  else
  {

?>


<?


  if($member['exit'] == 0 && $battle['start'] == 1 && $battle['end'] == 1) {



  $titans = mysql_result(mysql_query('SELECT COUNT(*) FROM `undying_member` WHERE  `battle` = "'.$battle['id'].'" AND `lvl`="'.$member['lvl'].'" '),0);

if($titans == 0 && $battle['opponents'] > 0 OR $battle['opponents'] > 0) {
$av=0;
$sa=0;
$go=0;
$ke=0;
  }
  else
  {


$av=$member['exp'];
$sa=$member['s'];
$go=2+($member['kills']*2);
$ke=1+($member['kills']);
if($user['vip'] == 1){
$av= $av *2;
}
  }

$tru=rand(1,50);

if($user['level']>=60){
mysql_query('UPDATE `users` SET `bunt` = `bunt` + 1 WHERE `id` = \''.$user['id'].'\'');
}
  mysql_query('UPDATE `users` SET `s` = "'.($user['s']   + $sa).'",
`exepy` = "'.($user['exepy'] + $av).'", `exp` = "'.($user['exp'] + $av).'", `g` = "'.($user['g'] + $go).'", `vor` = "'.($user['vor'] + $ke).'",`avtor`=`avtor` +'.$tru.' WHERE `id` = "'.$user['id'].'"');

$_SESSION['not']='<div class="alert"><div>                                     <div class="blue"><img src="/images/icons/reward.png" width="16" height="16" alt=""> Прибыль:</div>
    <img src="/images/icons/experience.png" width="16" height="16" alt=""> Авторитет:+ '.$av.' <img src="/images/icons/silver.png" width="16" height="16" alt=""> Рублей:+ '.$sa.' <img src="/images/icons/gold.png" width="16" height="16" alt=""> Сахар:+ '.$go.' <img src="/images/icons/key.png" width="16" height="16" alt=""> Ключи:+ '.$ke.' <img src="/images/icons/experience.png" width="16" height="16" alt="">+'.($tru).'</div></div><div class="alert_bottom"></div>';
header('location: /bunt/');

  mysql_query('UPDATE `undying_member` SET `exit` = "1" WHERE `battle` = "'.$battle['id'].'" AND `user` = "'.$user['id'].'"');

mysql_query('DELETE FROM `undying_member` WHERE `user` = "'.$user['id'].'"');
  }
  else
  {
  
?>

<?

  }

?>
<?

  if($member['exit'] == 0 && $battle['start'] == 1 && $battle['end'] == 1) {
$_SESSION['not']='<div class="alert"><div>                                     <div class="blue"><img src="/images/icons/reward.png" width="16" height="16" alt=""> Прибыль:</div>
    <img src="/images/icons/experience.png" width="16" height="16" alt=""> Авторитет:+ '.$av.' <img src="/images/icons/silver.png" width="16" height="16" alt=""> Рублей:+ '.$sa.' <img src="/images/icons/gold.png" width="16" height="16" alt=""> Сахар:+ '.$go.' <img src="/images/icons/key.png" width="16" height="16" alt=""> Ключи:+ '.$ke.' <img src="/images/icons/experience.png" width="16" height="16" alt="">+'.($tru).'</div></div><div class="alert_bottom"></div>';
include './modules_iclude/chest_user.php';

?>



<?

  }
  else
  {

?>

<?

}
  $battle = mysql_query('SELECT * FROM `undying` WHERE `start` = "0" AND `lvl`="'.$lvlx.'"');
  $battle = mysql_fetch_array($battle);  

  if(!$battle) {
  
  $h = date('H',time());
    
  if($h > 22 && $h < 6)
  {
  
    $time = 3600;
  
  }
  else
  {

    $time = 3600;
  
  }

if($user['level'] >= 10 && $user['level'] <= 29) {
$lvlx=1;
mysql_query('INSERT INTO `undying` (`time`,`lvl`) VALUES ("'.(time() + $time).'","1")');
}
if($user['level'] >= 30 && $user['level'] <= 49) {
$lvlx=2;
mysql_query('INSERT INTO `undying` (`time`,`lvl`) VALUES ("'.(time() + $time).'","2")');
}
if($user['level'] >= 50 && $user['level'] <= 69) {
$lvlx=3;
mysql_query('INSERT INTO `undying` (`time`,`lvl`) VALUES ("'.(time() + $time).'","3")');
}
if($user['level'] >= 70 && $user['level'] <= 79) {
$lvlx=4;
mysql_query('INSERT INTO `undying` (`time`,`lvl`) VALUES ("'.(time() + $time).'","4")');
}
if($user['level'] >= 80 && $user['level'] <= 99) {
$lvlx=5;
mysql_query('INSERT INTO `undying` (`time`,`lvl`) VALUES ("'.(time() + $time).'","5")');
}
if($user['level'] >= 100 && $user['level'] <= 129) {
$lvlx=6;
mysql_query('INSERT INTO `undying` (`time`,`lvl`) VALUES ("'.(time() + $time).'","6")');
}
if($user['level'] >= 130 && $user['level'] <= 149) {
$lvlx=7;
mysql_query('INSERT INTO `undying` (`time`,`lvl`) VALUES ("'.(time() + $time).'","7")');
}
  
  }
  
  if($battle['time'] <= time()) {
    
    mysql_query('UPDATE `undying` SET `start` = "1", `time` = "'.(time() + (240)).'" WHERE `id` = "'.$battle['id'].'" AND `lvl` ="'.$lvlx.'"');
  
    header('location: /bunt/');
  
  }


?>

</div>
</div>

</h5>
</h5></h5>
<?	
$_podval_battle = mysql_num_rows( mysql_query('SELECT * FROM `undying_member` WHERE `battle` = '.$battle['id'].'') );
	  if(isset($_GET['memb'])) {
	?>
 <div class="content">
	<div class="h-navig"><table width="100%" border="0" cellpadding="0" cellspacing="0">
	<tbody><tr><td class="h-navig-item"><a href="?">Бой</a></td>
	<td class="h-navig-item"><span class="active">В бою <b class="white">(<?=$_podval_battle;?>)</b></span></td></tr></tbody></table></div>
<div class="line"></div>
	<div class="dotted"></div>
<ul class="block">
    <li>Участники сражения: <b><?=$_podval_battle;?> чел.</b></li>
</ul>
<div class="dotted"></div>
		 <?
	$max = 10;
	$count = mysql_result(mysql_query('SELECT COUNT(*) FROM `undying_member` WHERE `battle` = '.$battle['id'].' AND `lvl` ='.$lvlx.''),0);
    $pages = ceil($count/$max);
	$page = _string(_num($_GET['page']));
	if($page > $pages) $page = $pages;
	if($page < 1) $page = 1;
	$start = $page * $max - $max;
	if($page == 1) $i = $page - 1; elseif($page == 2) $i = ($page + 9); else $i = ($page * 10) - 9;
	
	$q = mysql_query('SELECT * FROM `undying_member` WHERE `battle` = '.$battle['id'].' AND `lvl` ='.$lvlx.' ORDER BY `dmg` DESC LIMIT '.$start.', '.$max.'');
	
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
<ul class="pagination"><li class="next"><?=pages('?memb&');?></li></ul>
	<?
	include './system/f.php';
	exit;
}
?>
 <div class="content">
<?
 if($member['battle'] != $battle['id']) {
?>
<div class="block center color3 s125"><img src="/images/icons/circle.png" alt=""> <a href="?">Бунт</a><span class="white">, <?=_time($battle['time'] - time())?></span></div>
<?
}else{
?>

	<div class="h-navig"><table width="100%" border="0" cellpadding="0" cellspacing="0">
	<tbody><tr><td class="h-navig-item"><span class="active">Бой </td>
<td class="h-navig-item"><a href="?memb">В бою<b class="white">(<?=$_podval_battle;?>)</b></a></td></tr></tbody></table></div>

<?}?>
            <div class="line"></div> 
<div class="block center">
    <img src="/images/title/combat.jpg" width="150" height="75" alt="">    <div class="m3 blue">Бунт - это ожесточённые бои
до последней капли крови</div>
</div>

    <div class="dotted"></div>

<?


  if($member['battle'] != $battle['id']) {
    if(isset($_GET['start'])) {
      
      mysql_query('INSERT INTO `undying_member` (`battle`,
                                                   `user`,
                                                   `time`,`lvl`) VALUES ("'.$battle['id'].'",
                                                                     "'.$user['id'].'",
                                                                          "'.time().'","'.$lvlx.'")');

if($user['level'] >= 10 && $user['level'] <= 29) { 
 $opponent_hp = 200000;
$lvlx=1;
mysql_query('UPDATE `undying` SET `opponents` = "'.($battle['opponents'] +$opponent_hp).'", `hp_max` = "'.($battle['opponents'] + $opponent_hp).'" WHERE `id` = "'.$battle['id'].'" AND `lvl`="'.$lvlx.'"');
}
if($user['level'] >= 30 && $user['level'] <= 49) { 
 $opponent_hp = 400000;
$lvlx=2;
mysql_query('UPDATE `undying` SET `opponents` = "'.($battle['opponents'] +$opponent_hp).'", `hp_max1` = "'.($battle['opponents'] + $opponent_hp).'" WHERE `id` = "'.$battle['id'].'" AND `lvl`="'.$lvlx.'"');
}
if($user['level'] >= 50 && $user['level'] <= 69) { 
 $opponent_hp = 1000000;
$lvlx=3;
mysql_query('UPDATE `undying` SET `opponents` = "'.($battle['opponents'] +$opponent_hp).'", `hp_max2` = "'.($battle['opponents'] + $opponent_hp).'" WHERE `id` = "'.$battle['id'].'" AND `lvl`="'.$lvlx.'"');
}
if($user['level'] >= 70 && $user['level'] <= 79) { 
 $opponent_hp = 1650000;
$lvlx=4;
mysql_query('UPDATE `undying` SET `opponents` = "'.($battle['opponents'] +$opponent_hp).'", `hp_max3` = "'.($battle['opponents'] + $opponent_hp).'" WHERE `id` = "'.$battle['id'].'" AND `lvl`="'.$lvlx.'"');
}
if($user['level'] >= 80 && $user['level'] <= 99) { 
 $opponent_hp = 2000000;
$lvlx=5;
mysql_query('UPDATE `undying` SET `opponents` = "'.($battle['opponents'] +$opponent_hp).'", `hp_max4` = "'.($battle['opponents'] + $opponent_hp).'" WHERE `id` = "'.$battle['id'].'" AND `lvl`="'.$lvlx.'"');
}
if($user['level'] >= 100 && $user['level'] <= 129) { 
 $opponent_hp = 3000000;
$lvlx=6;
mysql_query('UPDATE `undying` SET `opponents` = "'.($battle['opponents'] +$opponent_hp).'", `hp_max5` = "'.($battle['opponents'] + $opponent_hp).'" WHERE `id` = "'.$battle['id'].'" AND `lvl`="'.$lvlx.'"');
}
if($user['level'] >= 130 && $user['level'] <= 149) { 
 $opponent_hp = 8000000;
$lvlx=7;
mysql_query('UPDATE `undying` SET `opponents` = "'.($battle['opponents'] +$opponent_hp).'", `hp_max6` = "'.($battle['opponents'] + $opponent_hp).'" WHERE `id` = "'.$battle['id'].'" AND `lvl`="'.$lvlx.'"');
}

    header('location: /bunt/');

    }
  
?>

<div class="block center">
        <span class="btn_start"><span class="btn_end"><a class="btn" href="?start">Присоединиться</a></span> </span>    </div>
<?
  
  }
  else
  {

?>


   <div class="block center s125">
        <img src="/images/icons/swords.png" width="16" height="16" alt="">        Вы участвуете в сражении
    </div>
<div class="block center">
        <span class="btn_start"><span class="btn_end"><a class="btn" href="?">Обновить</a></span> </span>    </div>





<?
  
  }


?>  

    <div class="dotted"></div>
    <div class="block center">
        <img src="/images/icons/date.png" width="16" height="16" alt="">        Начало сражения через:  <?=_time($battle['time'] - time())?>   </div>
  
<div class="dotted"></div>
<ul class="block small">
    <li class="color2">
        Бунт это - сражение с Беспредельщиком . Ваша задача победить Беспредельщика  за определённое время
    </li>
<li class="color2">Награда выдаётся пропорционально.</li>
</ul>
    <div class="dotted"></div>
   </div>
<?

  }

}
else
{
 
$_SESSION['not']='<div class="alert"><div>                Бунт доступен с 10-го уровня</div><div class="alert_bottom"></div></div>';
header('location: /menu/');
}
  
include './system/f.php';

?>