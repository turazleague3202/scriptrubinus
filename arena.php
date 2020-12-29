<?
    
    include './system/common.php';
    
 include './system/functions.php';
        
      include './system/user.php';
    
if(!$user OR $user['access'] < 0) {
  header('location: /');
exit;
}

$chest  = mysql_fetch_array(mysql_query('SELECT * FROM `chest_user` WHERE `user` = "'.$user['id'].'"'));
		 
		 if(!$chest) {
			 mysql_query('INSERT INTO `chest_user` SET `user` = "'.$user['id'].'"');
			 exit(header('Location: /chest/user/'));
		 }

 if($user['level'] >= 0) {
}else{

$_SESSION['not']='<div class="alert"><div>                закрыт временно!!!</div></div>';
header('location: /menu?'.$udet.'');
    exit;
}
$title =' Разборки';
    include './system/h.php';

$amy = mysql_query('SELECT * FROM `amylet` WHERE `user` = "'.$user['id'].'"');  
  $amy = mysql_fetch_array($amy);
$ary = mysql_query('SELECT * FROM `arena_xod` WHERE `user` = "'.$user['id'].'"');  
  $ary = mysql_fetch_array($ary);

$opponent = mysql_query('SELECT * FROM `users` WHERE `str` + `vit` + `def` >= "'.(($user['str'] + $user['vit']+ $user['def'])).'" AND `str` + `vit` + `def` <= "'.($user['str'] + $user['vit'] + $user['def']).'" AND `id` != "'.$user['id'].'" ORDER BY RAND() LIMIT 1');
$opponent = mysql_fetch_array($opponent);
if(!$opponent) {
$opponent = mysql_query('SELECT * FROM `users` WHERE `str` + `vit` + `def` <= "'.($user['str'] + $user['vit'] + $user['def']).'" AND `id` != "'.$user['id'].'" ORDER BY RAND() LIMIT 1');
$opponent = mysql_fetch_array($opponent);}


if(isset($_GET['potion'])) {
    mysql_query('UPDATE `users` SET `s` = `s` - 80, `hp` = "'.($user['vit']).'", `mp` = "'.($user['mana']).'"WHERE `id` = "'.$user['id'].'"');

header('location: ?'.$udet.'');
exit;
}

if(isset($_GET['hp'])) {
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
    <span class="btn_start"><span class="btn_end"><a class="btn" href="?potion">Восстановить за     <img src="/images/icons/silver.png" width="16" height="16" alt=""> 84</a></span> </span></div></div><div class="alert_bottom"></div>';
}

$vrag_str1= ceil($user['str']*85/100);
$vrag_str2= ceil($user['str']*89/100);
$vrag_str1=rand($vrag_str1,$vrag_str2);

$vrag_hp1= ceil($user['vit']*85/100);
$vrag_hp2= ceil($user['vit']*88/100);
$vrag_hp2=rand($vrag_hp1,$vrag_hp2);

$vrag_def1= ceil($user['def']*85/100);
$vrag_def2 = ceil($user['def']*89/100);
$vrag_def3=rand($vrag_def1,$vrag_def2);


$user_str1 = ceil($user['str']*85/100);
$user_str2 = ceil($user['str']*90/100);
$user_str3=rand($user_str1,$user_str2);

$user_hp1 = ceil($user['vit']*85/100);
$user_hp2 = ceil($user['vit']*90/100);
$user_hp3=rand($user_hp1,$user_hp2);

$user_def1 = ceil($user['def']*85/100);
$user_def2 = ceil($user['def']*90/100);
$user_def3=rand($user_def1,$user_def2);

$dmg=($user_str1+$user_hp2+$user_def3);
$vrag_dmg=($vrag_str1+$vrag_hp2+$vrag_def3);
if(isset($_GET['attack'])) {
if($user['arena_xod'] >= 0) {
}else{
header('location: ?'.$udet.'');
exit;
}

$_hp = ceil($user['vit']*20/100);
if($user['hp'] < $_hp){
header('location: ?hp');
exit;
}else{
}
if($user['mp'] < 40){
header('location: ?hp');
exit;
}else{
}
if($dmg >= $vrag_dmg) {
$ry =  rand(20,$user['level']) + rand(15,$user['level']);

$av = rand(8,$user['level']) + rand(9, $user['level']);

if($user['level'] >= 30) {
$av+=($amy['lvl']*15);
}
if($user['vip']==0){
$av=$av;
}else{
$av=$av*2;
}
$tru=rand(3,8);
mysql_query('UPDATE `users` SET `exp` = `exp` + '.$av.',`exepy` = `exepy` + '.$av.',`s` =   `s` + '.$ry.', `arena_xod`=`arena_xod` -1,`mp` = `mp` - 20,`avtor` = `avtor` + '.$tru.' WHERE `id` = "'.$user['id'].'"');

if($user['level']>=60){
mysql_query('UPDATE `users` SET `are` = `are` + 1,`are1`=`are1`+1 WHERE `id` = \''.$user['id'].'\'');
}
$_SESSION['not'] = '<div class="alert"><div><img src="/images/icons/swords.png" width="16" height="16" alt=""> <span class="green s125">Победа</span> <img src="/images/icons/swords.png" width="16" height="16" alt=""></div><div class="a_separator"></div><div>                                                 <div class="blue"><img src="/images/icons/reward.png" width="16" height="16" alt=""> Прибыль:</div><img src="/images/icons/experience.png" width="16" height="16" alt=""> Авторитет:+ '.$av.', <img src="/images/icons/silver.png" width="16" height="16" alt=""> Рубли:+ '.$ry.' <img src="/images/icons/experience.png" width="16" height="16" alt="">+'.($tru).'</div></div><div class="alert_bottom"></div>';
if($user['level'] <= 65) {
$w_chanse = rand(1,25);
    $chanse = rand(1,15) * rand(1,20);
  if($chanse < $w_chanse) {
$w = mysql_fetch_array(mysql_query('SELECT * FROM `shop` WHERE `id` < \'37\' ORDER BY RAND() LIMIT 1'));

  if(mysql_num_rows(mysql_query('SELECT * FROM `inv` WHERE `place` = \'0\' AND `user` = \''.$user['id'].'\'')) + 1 < 59) {

    mysql_query('INSERT INTO `inv` (`user`,
                                    `item`,
                                  `quality`,
                                   `smith`,
                                    `_str`,
                                    `_vit`, 
                                    `_def`,
                                   `place`, 
                                    `str_`,
                                    `vit_`, 
                                    `def_`) VALUES (\''.$user['id'].'\',
                                                \''.$w['id'].'\',
                                           \''.$w['quality'].'\',
                                             \'1\',
                                              \''.$w['_str'].'\',
                                              \''.$w['_vit'].'\',
                                              \''.$w['_def'].'\',
                                                                  \'0\', 
                                              \''.$w['_str'].'\',
                                              \''.$w['_vit'].'\',
                                              \''.$w['_def'].'\')');
  $w_id = mysql_insert_id();

     $w = mysql_fetch_array(mysql_query('SELECT * FROM `inv` WHERE `id` = \''.$w_id.'\''));
  $item = mysql_fetch_array(mysql_query('SELECT * FROM `items` WHERE `id` = \''.$w['item'].'\''));

$_SESSION['err'] = '<div class="alert"><div>
<div><div class="color3 s125">Новая шмотка</div>
<div class="a_separator"></div>
    <div class="inline-block">
<div class="block">
            <a href="#"><img class="left mr8" src="/images/items/'.$item['id'].'.jpg" alt=""></a>

            <img src="/images/icons/equip.png" width="16" height="16" alt=""> <a class="color-quality'.$w['quality'].'" href="#"><span class="color-quality'.$w['quality'].'"> '.$item['name'].'</span></a>
        <span class="white">
    
    <img src="/images/icons/level.png" width="16" height="16" alt=""> '.$item['lvl'].' ур.    </span>
<div>
    <span class="color2">
    <img src="/images/icons/health.png" width="16" height="16" alt=""> '.$w['_vit'].'</span>
            <span class="color2">
    <img src="/images/icons/damage.png" width="16" height="16" alt=""> '.$w['_str'].'</span>
            <span class="color2">
    <img src="/images/icons/armor.png" width="16" height="16" alt=""> '.$w['_def'].'</span>
        <div class="clear"></div>
</div></div>    <div class="dotted"></div>
</div>
<span class="btn_start"><span class="btn_end"><a class="btn" href="/inv/bag/">Перейти в тумбочку</a></span> </span></div></div></div>';
}
}
}
header('location: /arena/?');
exit;
}else{
$hpy= round(6/(100/$user['hp']));
mysql_query('UPDATE `users` SET `hp` = `hp` - '.$hpy.',`mp` = `mp` - 20, `arena_xod`=`arena_xod` -1 WHERE `id` = "'.$user['id'].'"');
$_SESSION['not'] = '<div class="alert"><div><img src="/images/icons/swords.png" width="16" height="16" alt=""> <span class="green s125"><font color="#c06060">Поражение!</font> </span> <img src="/images/icons/swords.png" width="16" height="16" alt=""></div><div class="a_separator"></div><div>                                                 <div class="blue"><img src="/images/icons/reward.png" width="16" height="16" alt=""> Прибыль:</div><img src="/images/icons/experience.png" width="16" height="16" alt=""> Авторитет:+ 3,    <img src="/images/icons/silver.png" width="16" height="16" alt=""> Рубли:+ 1</div></div><div class="alert_bottom"></div>';
header('location: /arena/?');
exit;
}
}
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

$lognu=array('1'=>'Шныpь', '2'=>'Μусорcкοй', '3'=>'Кpасный', '4'=>'Υгловοй', '5'=>'Беcпрeдeльщик', '6'=>'Κрюк');
$dfg=rand(1,6);


?>
    <div class="content"><div class="block center color3 s125"><img src="/images/icons/circle.png" alt=""> <a href="/arena?nocache=1266620476">Разборки</a></div><div class="line"></div>
<?
if($user['arena_xod'] <= 0) {
        
 

if($user['vip']==0){ $xoh=100;}else{$xoh=200; }
if(isset($_GET['fin'])) {
if($user['g'] >= 23) {
mysql_query('UPDATE `users` SET `arena_xod` = `arena_xod` + "'.$xoh.'", `g` =`g` - 80 WHERE `id` = "'.$user['id'].'"');
mysql_query('DELETE FROM `arena_xod` WHERE `user` = \''.$user['id'].'\'');
}else{

$_SESSION['not']='<div class="alert"><div>                Не хватает <img src="/images/icons/gold.png" width="16" height="16" alt="">'.(80-$user['g']).' </div></div>';
header('location: /arena/?'.$udet.'');
    

}
}

if(isset($_GET['xod'])) {
  echo '<div class="dotted"></div><div class="block center s125">Каждому бойцу нужен отдых. Ты показал свою силу. Возвращайся на
    битву через <img src="/images/icons/date.png" width="16" height="16" alt="">    '._time($ary['time'] - time()).'</div>
<div class="dotted"></div>
<div class="block center">
    <span class="btn_start"><span class="btn_end"><a class="btn" href="?fin">Ускорить за     <img src="/images/icons/gold.png" width="16" height="16" alt=""> 80</a></span> </span></div>
<div class="dotted"></div>
<div class="block center">
    <span class="btn_start"><span class="btn_end"><a class="btn" href="/menu?">Перейти на главную</a></span> </span></div></div>
';
include './system/f.php';
exit();
}
header('location: /arena/?xod');
}
?>
<div class="block center blue">
    Остепени беспредельщика, а то он совсем страх потерял
</div>
<div class="dotted"></div>
    <div class="block">           
  <a href="?attack&<?=$udet?>">  <?
if($opponent['r'] == 0) {
?>
      <img class="left mr8" src="http://bespredel.mobi/maneken?sex=man&amp;width=120&amp;height=160&amp;fragment=0&amp;frame=&amp;equip%5B1%5D=<?=$w_1['item']?>&amp;equip%5B2%5D=<?=$w_2['item']?>&amp;equip%5B3%5D=<?=$w_3['item']?>&amp;equip%5B4%5D=<?=$w_4['item']?>&amp;equip%5B5%5D=<?=$w_5['item']?>&amp;equip%5B6%5D=<?=$w_6['item']?>&amp;equip%5B7%5D=<?=$w_7['item']?>&amp;equip%5B8%5D=<?=$w_8['item']?>" width="120" height="160" alt=""></a>



<?
}
if($opponent['r'] == 1) {
?>
<img class="left mr8" src="http://bespredel.mobi/maneken?sex=woman&amp;width=120&amp;height=160&amp;fragment=0&amp;frame=&amp;equip%5B1%5D=<?=$w_1['item']?>&amp;equip%5B2%5D=<?=$w_2['item']?>&amp;equip%5B3%5D=<?=$w_3['item']?>&amp;equip%5B4%5D=<?=$w_4['item']?>&amp;equip%5B5%5D=<?=$w_5['item']?>&amp;equip%5B6%5D=<?=$w_6['item']?>&amp;equip%5B7%5D=<?=$w_7['item']?>&amp;equip%5B8%5D=<?=$w_8['item']?>" width="120" height="160" alt=""></a>


<?
}
?>
                                <img src="/images/icons/essence.png" width="16" height="16" alt=""> <span><?=$lognu[$dfg]?></span>  <span class="white">
    
    <img src="/images/icons/level.png" width="16" height="16" alt=""> <?=$user['level']?> ур.    </span>
    <div>
            
    <div>
    <img src="/images/icons/health.png" width="16" height="16" alt=""> Здоровье:  <?=$vrag_hp2?>    </div>
            
    <div>
    <img src="/images/icons/damage.png" width="16" height="16" alt=""> Сила:  <?=$vrag_str1?>    </div>
            
    <div>
    <img src="/images/icons/armor.png" width="16" height="16" alt=""> Защита:  <?=$vrag_def3?>    </div>
        </div>
<br/>
<div><span class="btn_start"><span class="btn_end"><a class="btn" href="/arena/?attack&<?=$udet?>">Наехать</a></span> </span></div>
<div class="clear"></div>
</div>
<?=$atk?>
<div class="dotted"></div>
    <div class="mtrl5">Твои параметры:</div>
    <div class="block">            

<?

$w_1 = mysql_query('SELECT * FROM `inv` WHERE `user` = "'.$user['id'].'" AND `id` = "'.$user['w_1'].'"');
$w_1 = mysql_fetch_array($w_1);
if(!$w_1) {
  $w_1['item'] = 0;
}
$w_1_item = mysql_query('SELECT * FROM `items` WHERE `id` = "'.$w_1['item'].'"');
$w_1_item = mysql_fetch_array($w_1_item);

$w_2 = mysql_query('SELECT * FROM `inv` WHERE `user` = "'.$user['id'].'" AND `id` = "'.$user['w_2'].'"');
$w_2 = mysql_fetch_array($w_2);

if(!$w_2) {
  $w_2['item'] = 0;
}

$w_2_item = mysql_query('SELECT * FROM `items` WHERE `id` = "'.$w_2['item'].'"');
$w_2_item = mysql_fetch_array($w_2_item);

$w_3 = mysql_query('SELECT * FROM `inv` WHERE `user` = "'.$user['id'].'" AND `id` = "'.$user['w_3'].'"');
$w_3 = mysql_fetch_array($w_3);
if(!$w_3) {
  $w_3['item'] = 0;
}

$w_3_item = mysql_query('SELECT * FROM `items` WHERE `id` = "'.$w_3['item'].'"');
$w_3_item = mysql_fetch_array($w_3_item);


$w_4 = mysql_query('SELECT * FROM `inv` WHERE `user` = "'.$user['id'].'" AND `id` = "'.$user['w_4'].'"');
$w_4 = mysql_fetch_array($w_4);

if(!$w_4) {
  $w_4['item'] = 0;
}

$w_4_item = mysql_query('SELECT * FROM `items` WHERE `id` = "'.$w_4['item'].'"');
$w_4_item = mysql_fetch_array($w_4_item);

$w_5 = mysql_query('SELECT * FROM `inv` WHERE `user` = "'.$user['id'].'" AND `id` = "'.$user['w_5'].'"');
$w_5 = mysql_fetch_array($w_5);
if(!$w_5) {
  $w_5['item'] = 0;
}
$w_5_item = mysql_query('SELECT * FROM `items` WHERE `id` = "'.$w_5['item'].'"');
$w_5_item = mysql_fetch_array($w_5_item);

$w_6 = mysql_query('SELECT * FROM `inv` WHERE `user` = "'.$user['id'].'" AND `id` = "'.$user['w_6'].'"');
$w_6 = mysql_fetch_array($w_6);
if(!$w_6) {
  $w_6['item'] = 0;
}
$w_6_item = mysql_query('SELECT * FROM `items` WHERE `id` = "'.$w_6['item'].'"');

$w_6_item = mysql_fetch_array($w_6_item);

$w_7 = mysql_query('SELECT * FROM `inv` WHERE `user` = "'.$user['id'].'" AND `id` = "'.$user['w_7'].'"');
$w_7 = mysql_fetch_array($w_7);
if(!$w_7) {
  $w_7['item'] = 0;
}
$w_7_item = mysql_query('SELECT * FROM `items` WHERE `id` = "'.$w_7['item'].'"');
$w_7_item = mysql_fetch_array($w_7_item);

$w_8 = mysql_query('SELECT * FROM `inv` WHERE `user` = "'.$user['id'].'" AND `id` = "'.$user['w_8'].'"');
$w_8 = mysql_fetch_array($w_8);
if(!$w_8) {
  $w_8['item'] = 0;
}
$w_8_item = mysql_query('SELECT * FROM `items` WHERE `id` = "'.$w_8['item'].'"');
$w_8_item = mysql_fetch_array($w_8_item);

?>
<?


if($user['r'] == 0) {
?>
       <a class="left mr8" href="/user/<?=$user['id']?>/"><img src="http://bespredel.mobi/maneken?sex=man&amp;width=120&amp;height=160&amp;fragment=1&amp;frame=&amp;equip%5B1%5D=<?=$w_1['item']?>&amp;equip%5B2%5D=<?=$w_2['item']?>&amp;equip%5B3%5D=<?=$w_3['item']?>&amp;equip%5B4%5D=<?=$w_4['item']?>&amp;equip%5B5%5D=<?=$w_5['item']?>&amp;equip%5B6%5D=<?=$w_6['item']?>&amp;equip%5B7%5D=<?=$w_7['item']?>&amp;equip%5B8%5D=<?=$w_8['item']?>" width="50" height="50" alt=""></a>


<?
}
if($user['r'] == 1) {
?>
       <a class="left mr8" href="/user/<?=$user['id']?>/"><img src="http://bespredel.mobi/maneken?sex=woman&amp;width=120&amp;height=160&amp;fragment=1&amp;frame=&amp;equip%5B1%5D=<?=$w_1['item']?>&amp;equip%5B2%5D=<?=$w_2['item']?>&amp;equip%5B3%5D=<?=$w_3['item']?>&amp;equip%5B4%5D=<?=$w_4['item']?>&amp;equip%5B5%5D=<?=$w_5['item']?>&amp;equip%5B6%5D=<?=$w_6['item']?>&amp;equip%5B7%5D=<?=$w_7['item']?>&amp;equip%5B8%5D=<?=$w_8['item']?>" width="50" height="50" alt=""></a>


<?
}
?>
                    <img src="/images/icons/essence.png" width="16" height="16" alt=""> <a href="/user/<?=$user['id']?>/"><span><?=$user['login']?></span></a>  <span class="white">
    
    <img src="/images/icons/level.png" width="16" height="16" alt=""> <?=$user['level']?> ур.    </span>
    <div class="m3" style="padding-left: 58px">    <div style="width: 100%; height: 4px"
class="progress-grey">
            <div style="width: 100%; height: 4px" class="progress-green"></div></div>    </div>    <div>
            
    <img src="/images/icons/currentHealth.png" width="16" height="16" alt=""> <?=$user['hp']?>            
    <img src="/images/icons/damage.png" width="16" height="16" alt=""> <?=$user['str']?>            
    <img src="/images/icons/armor.png" width="16" height="16" alt=""> <?=$user['def']?>        </div>
<div class="clear"></div>




</div>
<? if($user['level'] >= 30) {
?>
 <div class="line"></div>
</td></tr></table><table><tr><td style="width:52px;padding:4px"><img src="/images/items/3.jpg" alt=""/></td><td style="padding:4px"><div style="font-size:14px;">Амулет Авторитета <div style="color:#a5a5a5;"><?=$amy['lvl']?> из 45.ур</div></span> <div style="color:#a5a5a5"><img src="/images/icons/plus.png" alt=""/> Авторитет увеличен на <span style="color:green"><?=$amy['vpa']?>%</span></div></td></tr></table>

      <div class="dotted"></div>
      <div class="block center">
                        <span class="btn_start"><span class="btn_end"><a class="btn" href="/amylet/?<?=$udet?>">Перейти к амулету</a></span> </span>  </div>

<?}?>
</div></div>
<?
include './system/f.php';
?>






