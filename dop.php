<?
    
    include './system/common.php';
    
 include './system/functions.php';
        
      include './system/user.php';
    
if(!$user) {

  header('location: /');
    
exit;

}


if(!$clan) {
  header('location: /menu');
exit;
}


    $title = 'Бунт';    

include './system/h.php';  
 
$clan_memb = mysql_query('SELECT * FROM `clan_memb` WHERE `user` = "'.$user['id'].'"');
  $clan_memb = mysql_fetch_array($clan_memb);

 
    if($clan_memb) {

       $clan = mysql_fetch_array(mysql_query('SELECT * FROM `clans` WHERE `id` = "'.$clan_memb['clan'].'"'));

    if($clan_memb['last_update'] <= time()) {
        
      mysql_query('UPDATE `clan_memb` SET `last_update` = "'.($clan_memb['last_update'] + ((60 * 60) * 24 )).'",
                                                    `v` = `v` + 3 WHERE `id` = "'.$clan_memb['id'].'"');

    }
   
    $clan_1 = ($clan['built_1'] * 250);


    if($clan['built_1'] > 0 && $clan_1) {
 
      $user['vit'] += $clan_1;

      $user['hp'] += $clan_1;

    }

 $clan_2 = ($clan['built_2'] * 250);


    
 if($clan['built_2'] > 0 && $clan_2) {
    
 
       $user['str'] += $clan_2;
    }

 $clan_3 = ($clan['built_3'] * 250);



 if($clan['built_3'] > 0 && $clan_3) {
  
      $user['def'] += $clan_3;
 
    }

  

}
if($clan['level'] >= 30) {




if($clan['level'] >= 30 && $clan['level'] <= 150) { 
 $opponent_str = 200000;
 $opponent_def = 180000;
$lvlx=1;
}

if($clan['level'] >= 150 && $clan['level'] <= 300) { 
 $opponent_str = 250000;
 $opponent_def = 270000;
$lvlx=2;
}

if($clan['level'] >= 300 && $clan['level'] <= 550) { 
 $opponent_str = 300000;
 $opponent_def = 450000;
$lvlx=3;
}

if($clan['level'] >= 550 && $clan['level'] <= 700) { 
 $opponent_str = 670000;
 $opponent_def = 780000;
$lvlx=4;
}

if($clan['level'] >= 700 && $clan['level'] <= 950) { 
 $opponent_str = 1000000;
 $opponent_def = 1120000;
$lvlx=5;
}

if($clan['level'] >= 950 && $clan['level'] <= 1100) { 
 $opponent_str = 1300000;
 $opponent_def = 1345000;
$lvlx=6;
}

if($clan['level'] >= 1100 && $clan['level'] <= 1350) { 
 $opponent_str = 1470000;
 $opponent_def = 1580000;
$lvlx=7;
}

if($clan['level'] >= 1350 && $clan['level'] <= 1600) { 
 $opponent_str = 1780000;
 $opponent_def = 1840000;
$lvlx=8;
}

if($clan['level'] >= 1600 && $clan['level'] <= 1850) { 
 $opponent_str = 1850000;
 $opponent_def = 1960000;
$lvlx=9;
}

if($clan['level'] >= 1850 && $clan['level'] <= 2050) { 
 $opponent_str = 2200000;
 $opponent_def = 2146000;
$lvlx=10;
}
if($clan['level'] >= 2050 && $clan['level'] <= 2450) { 
 $opponent_str = 2240000;
 $opponent_def = 2186000;
$lvlx=11;
}
if($clan['level'] >= 2450 && $clan['level'] <= 3050) { 
 $opponent_str = 2300000;
 $opponent_def = 2246000;
$lvlx=12;
}

  
  $member = mysql_query('SELECT * FROM `podval_member` WHERE `user` = "'.$user['id'].'" ORDER BY `id` DESC LIMIT 1');
  $member = mysql_fetch_array($member);
  
  $battl = mysql_query('SELECT * FROM `podval` WHERE `id` = "'.$member['battle'].'"');
  $battl = mysql_fetch_array($battl);  
  
$hp_b = round(100 / ($battl['hp_max']/ $battl['opponents']));
if($hp_b > 100){
$hp_b=100;
}
$hp_ur = round(100 / ($user['vit']/ $user['hp']));
if($hp_ur > 100){
$hp_ur=100;
}

  if($member['exit'] == 0 && $battl['start'] == 1 && $battl['end'] == 0) {

    $titans = mysql_result(mysql_query('SELECT COUNT(*) FROM `podval_member` WHERE `dead` = "0" AND `battle` = "'.$battl['id'].'"'),0);
if($titans == 0 OR $battl['opponents'] <= 0) {
              
    mysql_query('UPDATE `podval` SET `end` = "1" WHERE `id` = "'.$battl['id'].'" AND `clan` = "'.$clan['id'].'"');

    header('location: /dop/');
              
    exit;

  }
  
  if($battl['time'] < time()) {
  
    mysql_query('UPDATE `podval` SET `end` = "1" WHERE `id` = "'.$battl['id'].'" AND `clan` = "'.$clan['id'].'"');
    
  header('location: /dop/');
  
  exit;
  
  }
  

  
if(isset($_GET['potion'])) {
    mysql_query('UPDATE `users` SET `s` = `s` - 80, `hp` = "'.($user['vit']).'", `mp` = "'.($user['mana']).'"WHERE `id` = "'.$user['id'].'"');

header('location: /dop/?'.$udet.'');
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
    <span class="btn_start"><span class="btn_end"><a class="btn" href="/dop/?potion">Восстановить за     <img src="/images/icons/silver.png" width="16" height="16" alt=""> 84</a></span> </span></div></div><div class="alert_bottom"></div>';
}
?>
<div class="content">

<div class="block center color3 s125"><img src="/images/icons/circle.png" alt=""> <a href="?">Голодовка</a><span class="white">, <?=_time($battl['time'] - time())?></span>

          </div>  <div class="line"></div>   
<div class="content">
<?

  if($member['dead'] == 0) {


  if($_GET['attack'] == true) {




$_hp = ceil($user['vit']*40/100);
if($user['hp'] < $_hp OR $user['mp'] < 100){
header('location: /dop/?hpnoy');
exit;
}else{
}

if($user['mp'] < 100){
header('location: /dop/?hpnoy');
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
    mysql_query('UPDATE `podval_member` SET `kills` = "'.($member['kills'] + $kil).'" WHERE `user` = "'.$user['id'].'" AND `battle` = "'.$battl['id'].'" AND `clan` = "'.$clan['id'].'"');

    

  if($battl['opponents'] == 0) {
  
    header('location: /dop/');
  
  }


mysql_query('UPDATE `podval` SET `opponents` = `opponents` - "'.$my_ataka.'" WHERE `id` = "'.$battl['id'].'" AND `clan` = "'.$clan['id'].'"');

$sek=1;
$expo=rand(3,30);
$say=rand(1,60);
mysql_query('UPDATE `users` SET `hp` = `hp` - "'.$bos_ataka.'" WHERE `id` = "'.$user['id'].'"');
    mysql_query('UPDATE `podval_member` SET `time` = "'.(time() + $sek).'",
`timer` = "'.time().'", `dmg` = `dmg` + "'.$my_ataka.'",`exp` = `exp` + "'.$expo.'",`s` = `s` + "'.$say.'" WHERE `user` = "'.$user['id'].'" AND `battle` = "'.$battl['id'].'" AND `clan` = "'.$clan['id'].'"');
  



  mysql_query('UPDATE `users` SET `mp` = "'.($user['mp'] - 30).'" WHERE `id` = "'.$user['id'].'"');
    
 


?>



</div>
            <div class="block"><div class="color2 small"> <img src="/images/icons/swords.png" width="16" height="16" alt=""> Журнал сражения:</div><div class="small">
<img src="/images/icons/essence.png" width="16" height="16" alt="">&nbsp;<span class="color3">Беспредельщик</span>  <?=$bos_atku?> <img src="/images/icons/uron.png" width="16" height="16" alt=""> урона

<div class="small">
<img src="/images/icons/<?=$user['r']?>.png" width="16" height="16" alt="">&nbsp;<span class="color3"><?=$user['login']?></span> <?=$my_atku?> <img src="/images/icons/uron.png" width="16" height="16" alt=""> урона
</div></div><div class="dotted"></div> 

</div>
<?    
  
  }
  else
  {
  
?>

</div>
<?

  }

?>

   <div class="block center">
        <span class="s125">
            <img src="/images/icons/reward.png" width="16" height="16" alt=""> Ништяки:
                <img src="/images/icons/experience.png" width="16" height="16" alt=""> <?=$member['exp']?>    <img src="/images/icons/silver.png" width="16" height="16" alt=""> <?=$member['s']?>        </span>
            </div>
    <div class="dotted"></div>
            <div class="line"></div>

<div class="block">        
    <div class="center">   

      <img class="left mr8" src="/images/2.jpg" width="50" height="50" alt="">


</div>
                                <img src="/images/icons/boss.png" width="16" alt="" hegiht="16"> <span class="center">Враг</span>        <span class="white">
    

    <img src="/images/icons/level.png" width="16" height="16" alt=""> <?=$lvlx?> ур.    </span>
    <div class="m3" style="padding-left: 58px">    <div style="width: 100%; height: 4px"
            class="progress-grey">
            <div style="width: <?=$hp_b?>%; height: 4px" class="progress-green"></div></div>    </div>    <div>
            
    <img src="/images/icons/currentHealth.png" width="16" height="16" alt=""> <?=$battl['opponents']?>            
    <img src="/images/icons/damage.png" width="16" height="16" alt=""> <?=$opponent_str?>            
    <img src="/images/icons/armor.png" width="16" height="16" alt=""> <?=$opponent_def?>        </div>
<div class="clear"></div>
</div>    <div class="dotted"></div>
    <div class="block center">
        <span class="btn_start"><span class="btn_end"><a class="btn" href="?attack=true">Ηaнеcти yдар</a></span> </span>
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

<?

echo '   <div class="dotted"></div>
    <div class="block">
        <img src="/images/icons/medal.png" width="16" height="16" alt="">        <span class="blue">Лидеры сражения:</span>
    </div>
';

?>
<?

$q = mysql_query('SELECT * FROM `podval_member` WHERE `battle` = "'.$battl['id'].'" AND `clan` = "'.$clan['id'].'" ORDER BY `dmg` DESC, `timer` DESC LIMIT 10');    
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
}else{
echo '
    <div class="dotted"></div>
    <div class="block">
                                    '.$i.'    <a class="color3" href="/user/'.$ank['id'].'">'.$ank['login'].' </a>, урон:
                <img src="/images/icons/uron.png" width="16" height="16" alt=""> '.($row['dmg']).'
</div>
                    
';
}
?>

<?
}

echo'</div></div></div>';
  }
  else
  {
  

  }

  }
  else
  {

?>


<?


  if($member['exit'] == 0 && $battl['start'] == 1 && $battl['end'] == 1) {



    $titans = mysql_result(mysql_query('SELECT COUNT(*) FROM `podval_member` WHERE `dead` = "0" `battle` = "'.$battl['id'].'"'),0);

  if($titans == 0 && $battl['opponents'] > 0 OR $battl['opponents'] > 0) {
$av=0;
$sa=0;
$avban=0;
$goban=0;
$saban=0;
  }
  else
  {

$av=$member['exp'];
$sa=$member['s'];
$avban=100+($member['kills']*350);
$saban=250+($member['kills']*850);
$goban=50+($member['kills']*7);
  }

$tru=rand(100,400);



if($user['vip'] == 1){
$av= $av *2;
}
if($user['level']>=60){
mysql_query('UPDATE `users` SET `go` = `go` + 1 WHERE `id` = \''.$user['id'].'\'');
}
  mysql_query('UPDATE `users` SET `s` = "'.($user['s']   + $sa).'",
`exepy` = "'.($user['exepy'] + $av).'", `exp` = "'.($user['exp'] + $av).'",`avtor`=`avtor`+'.$tru.' WHERE `id` = "'.$user['id'].'"');
if($clan_memb['rank'] == 5){
mysql_query('UPDATE `clans` SET `s` = `s` + "'.($saban).'", `exp` = `exp` + "'.($avban).'", `g` = `g` + "'.($goban).'" WHERE `id` = "'.$clan['id'].'"');
}

$_SESSION['not']='<div class="alert"><div>                                     <div class="blue"><img src="/images/icons/reward.png" width="16" height="16" alt=""> Прибыль:</div>
    <img src="/images/icons/experience.png" width="16" height="16" alt=""> Авторитет:+ '.$av.' <img src="/images/icons/silver.png" width="16" height="16" alt=""> Рублей:+ '.$sa.' </div></div><div class="alert_bottom"></div>';


header('location: /dop/');

  mysql_query('UPDATE `podval_member` SET `exit` = "1" WHERE `battle` = "'.$battl['id'].'" AND `user` = "'.$user['id'].'"');


mysql_query('UPDATE `poodval` SET `end` = "0", `start` = "1" WHERE `id` = "'.$battl['id'].'"');
mysql_query('DELETE FROM `podval_member` WHERE `user` = "'.$user['id'].'"');
  }
  else
  {
  
?>

<?

  }

?>
<?

  if($member['exit'] == 0 && $battl['start'] == 1 && $battl['end'] == 1) {
$_SESSION['not']='<div class="alert"><div>                                     <div class="blue"><img src="/images/icons/reward.png" width="16" height="16" alt=""> Прибыль:</div>
    <img src="/images/icons/experience.png" width="16" height="16" alt=""> Авторитет:+ '.$av.' <img src="/images/icons/silver.png" width="16" height="16" alt=""> Рублей:+ '.$sa.' <img src="/images/icons/experience.png" width="16" height="16" alt="">+'.($tru).'</div></div><div class="alert"><div>                                     <div class="blue"><img src="/images/icons/reward.png" width="16" height="16" alt=""> Награда в банду:</div>
    <img src="/images/icons/experience.png" width="16" height="16" alt=""> Авторитет:+ '.$avban.' <img src="/images/icons/silver.png" width="16" height="16" alt=""> Рублей:+ '.$saban.' <img src="/images/icons/gold.png" width="16" height="16" alt=""> Сахар:+ '.$goban.' </div></div><div class="alert_bottom"></div>';
if($clan_memb['rank'] == 5){
$_SESSION['err']='<div class="alert"><div>                                     <div class="blue"><img src="/images/icons/reward.png" width="16" height="16" alt=""> Награда в банду:</div>
    <img src="/images/icons/experience.png" width="16" height="16" alt=""> Авторитет:+ '.$avban.' <img src="/images/icons/silver.png" width="16" height="16" alt=""> Рублей:+ '.$saban.' <img src="/images/icons/gold.png" width="16" height="16" alt=""> Сахар:+ '.$goban.' </div></div><div class="alert_bottom"></div>';
}
?>



<?

  }
  else
  {

?>

<?

}
  $battl = mysql_query('SELECT * FROM `podval` WHERE `start` = "0" AND `clan` = "'.$clan['id'].'"');
  $battl = mysql_fetch_array($battl);  

  if(!$battl) {
  
  $h = date('H',time());
    
  if($h > 22 && $h < 6)
  {
  
    $time = 3600;

  
  }
  else
  {

    $time = 2400;

  
  }


    
    mysql_query('INSERT INTO `podval` (`time`,`clan`) VALUES ("'.(time() + $time).'","'.$clan['id'].'")');
  
  }
  
  if($battl['time'] <= time()) {
    
    mysql_query('UPDATE `podval` SET `start` = "1", `time` = "'.(time() + (220)).'" WHERE `id` = "'.$battl['id'].'" AND `clan` = "'.$clan['id'].'"');
  
    header('location: /dop/');
  
  }


?>

 <div class="content">
    
<div class="block center color3 s125"><img src="/images/icons/circle.png" alt=""> <a href="?">Голодовка</a><span class="white"></span></div>
            <div class="line"></div> 
<div class="block center">
    <img src="/images/title/bun.jpg" width="150" height="75" alt="">    <div class="m3 blue">Ваша задача победить за определённое время.</div>
</div>

    <div class="dotted"></div>

<?
$hpu=(25*10000000);
  if($member['battle'] != $battl['id']) {
if(isset($_GET['start'])){
 if($clan_memb['rank'] == 5) {
mysql_query('INSERT INTO `pooodval` SET  `id` = "'.$battl['id'].'",`opponents` = "'.($battl['opponents']+3000000).'",`hp_max` = "'.($battl['opponents']+3000000).'"');
mysql_query('UPDATE `podval` SET `opponents` = "'.($battl['opponents'] + $hpu).'", `hp_max` = "'.($battl['opponents'] + $hpu).'" WHERE `id` = "'.$battl['id'].'"');
$q = mysql_query('SELECT * FROM `clan_memb` WHERE `clan` = "'.$clan['id'].'"'); 
while($m = mysql_fetch_array($q)) {
mysql_query('INSERT INTO `podval_member` SET  `battle` = "'.$battl['id'].'",`user` = "'.$m['user'].'",`clan` = "'.$m['clan'].'"');

}
header('location: /dop/');

}
}
    
 if($clan_memb['rank'] == 5) {
?>

<div class="block center">
        <span class="btn_start"><span class="btn_end"><a class="btn" href="?start">Подать заявку</a></span> </span>    </div>
<?}else{?>

<div class="block center">
        <span class="btn_start"><span class="btn_end"><a class="btn" href="?">Обновить</a></span> </span>  

</div>
<?
}
}else{
?>
   <div class="block center s125">
        <img src="/images/icons/swords.png" width="16" height="16" alt="">        Ваша банда участвуете в сражении
    </div>
<div class="block center">
        <span class="btn_start"><span class="btn_end"><a class="btn" href="?">Обновить</a></span> </span>  

</div>
    <div class="dotted"></div>
    <div class="block center">
        <img src="/images/icons/date.png" width="16" height="16" alt="">        Начало через:  <?=_time($battl['time'] - time())?>   </div>
  
<?}?>
<div class="dotted"></div>
<ul class="block small">
<li class="color2">Награда выдаётся пропорционально.</li>
<li class="color2">Подать заявку может только главарь банды.</li>
</ul>
    <div class="dotted"></div>
   </div>
<?

  }

}
else
{
 
$_SESSION['not']='<div class="alert"><div>                Голодовка доступна с 30 уровня банды</div></div>';
header('location: /menu/');
}
  
include './system/f.php';

?>