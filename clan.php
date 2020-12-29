<?
    
    include './system/common.php';
    
 include './system/functions.php';
        
      include './system/user.php';
    
if(!$user OR $user['access'] < 0) {
$_SESSION['not']='<div class="alert"><div>                Тех.работы!</div></div>';
  header('location: /menu');
exit;
}
$id = _string(_num($_GET['id']));

if(!$id && $clan) {
    $id = $clan['id'];
}

  $i = mysql_query('SELECT * FROM `clans` WHERE `id` = "'.$id.'"');
  $i = mysql_fetch_array($i);

  if(!$i) {
  
      header('location: /clans/');
  
  exit;
  
  }

switch($_GET['action']) {
  default:

    $title = $i['name'];    

include './system/h.php';
?>

<?
if(isset($_GET['medals'])) {

echo '<div class="content"><div class="block center color3 s125"><a href="/clan/'.$i['id'].'">'.$i['name'].'</a>/ Медали</div>
<div class="line"></div>';

$q = mysql_query('SELECT * FROM `podval_key` WHERE `clan` = "'.$i['id'].'"');
  while($row = mysql_fetch_array($q)) {
	  
	  for($n = 1; $n <= 17; $n++) {
		  if($row['boss_'.$n.''] > 0) {
			  
			  $_list = mysql_fetch_array(mysql_query('SELECT * FROM `podval_list` WHERE `id` = "'.$n.'"'));
echo '<div class="block">
            <img class="left mr8" src="/images/basement/'.$n.'.jpg" width="50" height="50" alt="">            <div class="color3"><img src="/images/icons/boss.png" width="16" height="16" alt=""> '.$_list['name'].' </div>
            <div><img src="/images/icons/basement_rating.png" width="16" height="16" alt=""> Побеждён: '.$row['boss_'.$n.''].' раз(а)</div>
            <div class="clear"></div>
        </div>
        <div class="dotted"></div>';
}
}
}
include './system/f.php';
exit;
}
?>
 <div class="content"><div class="block center color3 s125"> <?=$title?></div><div class="line"></div> 
<?

$lvlc = 250 + ($i['level'] * $i['level'] * 125)*4;
  $_exp = round(100 / ($lvlc / $i['exp']));

  if($_exp > 100) {
  
     $_exp = 100;
  
  }

?>



<?

  if($clan && $clan['id'] == $i['id'] && $clan_memb['rank'] == 4) {

?>

<?

  }

?>

 

 <div class="block">
    <img class="left mr8" src="/images/clan/logo.jpg" width="50" height="50" alt="">    <img src="/images/icons/clan.png" width="16" height="16" alt="">    <a href="/clan"><?=$i['name']?></a>    <br/>
    <img src="/images/icons/level.png" width="16" height="16" alt=""> Уровень: <?=$i['level']?>    <br/>    <img src="/images/icons/experience.png" width="16" height="16" alt=""> <?=$i['exp']?> / <?=$lvlc?>     <div class="clear"></div>
</div>    <div style="margin: -4px 5px 5px 5px;">
</div>
<?

$kol = mysql_query('SELECT * FROM `podval_key` WHERE `clan` = "'.$i['id'].'"');
  $kol = mysql_fetch_array($kol);

$boss=array('1'=>'1', '2'=>'2', '3'=>'3', '4'=>'4', '5'=>'5', '6'=>'6', '7'=>'7', '8'=>'8', '9'=>'9', '10'=>'10', '11'=>'11', '12'=>'12', '13'=>'13', '14'=>'14', '15'=>'15', '16'=>'16', '17'=>'17');
$bos=rand(1,17);
?>


 <div class="dotted"></div>
<a href="/clan/medals/?id=<?=$i['id'];?>/">
<div class="block">
            <img class="left mr8" src="/images/basement/<?=$boss[$bos]?>.jpg" width="50" height="50" alt="">            <div class="color3"><img src="/images/icons/boss.png" width="16" height="16" alt=""> Медали</div>
            <div><img src="/images/icons/basement_rating.png" width="16" height="16" alt=""> Кол-во поверженных: <?=$kol['boss_1']+$kol['boss_2']+$kol['boss_3']+$kol['boss_4']+$kol['boss_5']+$kol['boss_6']+$kol['boss_7']+$kol['boss_8']+$kol['boss_9']+$kol['boss_10']+$kol['boss_11']+$kol['boss_12']+$kol['boss_13']+$kol['boss_14']+$kol['boss_15']+$kol['boss_16']+$kol['boss_17']?>раз(а)</div>
 <div class="clear"></div>
        </div>
</a>
<div class="dotted"></div>

<?
if(!$id && $clan) {
    $id = $clan['id'];
}

if($clan['id'] == $i['id']) {
}else{
?>
 
 <div class="block">
    <img class="left mr8" src="/images/pay/2.jpg" width="50" height="50" alt="">    <img src="/images/icons/money.png" width="16" height="16" alt="">    Общак    <br/>
    <img src="/images/icons/silver.png" width="16" height="16" alt=""> <?=$i['s']?>
  <br/>    <img src="/images/icons/gold.png" width="16" height="16" alt=""> <?=$i['g']?>

</div>
<?

}
if($clan['id'] == $i['id']) {

?>
 
<a href="/clan/money/">
 <div class="block">
    <img class="left mr8" src="/images/pay/2.jpg" width="50" height="50" alt="">    <img src="/images/icons/money.png" width="16" height="16" alt="">    Общак    <br/>
    <img src="/images/icons/silver.png" width="16" height="16" alt=""> <?=$i['s']?>
  <br/>    <img src="/images/icons/gold.png" width="16" height="16" alt=""> <?=$i['g']?>

</div> 
</a>

<?

}

?>
<div class="dotted"></div>
<?
    $max = 10;
  $count = mysql_result(mysql_query('SELECT COUNT(*) FROM `clan_memb` WHERE `clan` = "'.$i['id'].'"'),0);
  $pages = ceil($count/$max);
   $page = _string(_num($_GET['page']));

    if($page > $pages) {
    
   $page = $pages;
    
    }
  
    if($page < 1) {
    
   $page = 1;
    
    }
    
  $start = $page * $max - $max;

?>
<div class="block">
    <img src="/images/icons/members.png" width="16" height="16" alt=""> Члены банды: (<?=$count?>)
</div>

<div class="dotted"></div>
<?

if($count > 0) {

$q = mysql_query('SELECT * FROM `clan_memb` WHERE `clan` = "'.$i['id'].'" ORDER BY `rank` DESC,`exp` DESC LIMIT '.$start.', '.$max.'');
  while($row = mysql_fetch_array($q)) {

  $memb = mysql_query('SELECT * FROM `users` WHERE `id` = "'.$row['user'].'"');
  $memb = mysql_fetch_array($memb);

  switch($row['rank']) {
  
    case 1:
    $rank = 'Новобранец';
     break;
    case 2:
    $rank = 'Смотрящий';
     break;
    case 3:
    $rank = 'Помощник';
     break;
    case 4:
    $rank = 'Заместитель';
     break;
    case 5:
    $rank = 'Главарь';
     break;
    
  }




















?>





    <div class="block">
            <div>
<?
if($memb['vip'] == 0 && $memb['access'] == 0){
?>
<img src="/images/icons/<?=$memb['r']?>.png" width="16" height="16" alt="">
<?
}

if($memb['access'] == 1) {
?>
<img src="/images/icons/mod.png" width="16" height="16" alt="">
<?}
if($memb['access'] == 2) {
?>
<img src="/images/icons/mod.png" width="16" height="16" alt="">
<?}
if($memb['access'] == 3) {
?>
<img src="/images/icons/adminy.png" width="16" height="16" alt="">
<?
}
if($memb['vip'] == 1 && $memb['access'] == 0){
?>
<img src="/images/icons/vip_<?=($memb['r'] == man ? 'woman':'man')?>_<?=$memb['r']?>.png" width="16" height="16" alt="">
<?
}
?>
 <a class="color3" href="/clan/memb/<?=$row['id']?>/"><?=$memb['login']?></a>,
        <?=($row['exp'])?> <img src="/images/icons/basement_rating.png" width="16" height="16" alt=""> |   (<?=($row['expl'])?>) - <img src="/images/icons/basement_rating.png" width="16" height="16" alt="">    <?=$rank?></div>
        </div>
            <div class="dotted"></div>

<?

  }

?>

   <div class="dotted"></div>
<ul class="pagination"><li class="next"><?=pages('/clan/'.$i['id'].'/'.($_GET['adm'] == true ? '?adm=true&':'?'));?></li></ul>
<div class="dotted"></div>
<?

$cu = mysql_fetch_array(mysql_query('SELECT * FROM `clan_quest` WHERE `clan` = "'.$i['id'].'"'));
if($clan['id'] == $i['id']) {

?>
  <div class="menu">        
<li><a href="/chat/clan"><img src="/images/icons/topic.png" width="16" height="16" alt=""> Чат банды <?=($_clan_chat > 0 ? '<font color=\'#30c030\'>(+)</font>':'')?></a></li></div>    <div class="dotted"></div>

<?
}
?>
 <div class="menu">        
<li><a href="/clan/daily/<?=$i['id']?>/"><img src="/images/icons/dailyQuest.png" width="16" height="16" alt=""> Срочняки <span class='white'>(<?=$ach = $cu['bos3']+$cu['bos5']+$cu['bos7']?> из 3)</span></a></li></div>
<div class="menu"><li><a href="/clan/built/<?=$i['id']?>"><img src="/images/icons/topic.png" width="16" height="16" alt=""> Подогревы банды</a></li></div>
<?

if($clan['id'] == $i['id']) {

?>
    <div class="dotted"></div>
    <div class="menu">        <li><a href="/clan_journal"><img src="/images/icons/note.png" width="16" height="16" alt=""> Журнал банды</a></li></div> 
   <div class="dotted"></div>
<?
  
}
  }
  else
  {
 
?>


<?

  }

?>
 



<?

if($clan && $clan['id'] == $i['id']) {

  if(isSet($_GET['exit']) && $clan_memb['rank'] != 5) {
  
  mysql_query('DELETE FROM `clan_memb` WHERE `clan` = "'.$clan['id'].'" AND `user` = "'.$user['id'].'"');
    
$timey = time();

$texy="покинул банду
";
mysql_query('INSERT INTO `clan_journal` SET `cl_id` = "'.$clan['id'].'",`time` = "'.$timey.'",`login` = "'.$user['login'].'",`user` = "'.$user['id'].'", `cl` = "2",`text` = "'.$texy.'"');

    header('location: /clans/');

  exit;

  }
if(isset($_GET['vexit'])){echo ' <div class="content">
<div class="menu">        <li><a href="?exit"><img src="/images/icons/ok.png" width="16" height="16" alt=""> Да,
    подтверждаю!</a></li><li><a href="/"><img src="/images/icons/cross.png" width="16" height="16" alt=""> Нет, отказываюсь!</a></li></div></div><div class="line"></div>
';
include './system/f.php';
exit();
}

?>


<?

if($clan['id'] == $i['id'] && $clan_memb['rank'] ==5) {

?>
 
  <div class="menu">            <li><a href="/clan-settings/"><img src="/images/icons/settings.png" width="16" height="16" alt="">Настройки</a>
</li>
   
 
   <div class="dotted"></div>

<?

  }else{
?>


<?

}
}

?>

<?

if($clan['id'] == $i['id'] && $clan_memb['rank'] ==4) {

?>
 
  <div class="menu">            <li><a href="/clan-settings/"><img src="/images/icons/settings.png" width="16" height="16" alt="">Настройки</a>
</li>
   
 
   <div class="dotted"></div>

<?

  }else{


if($clan['id'] == $i['id'] && $clan_memb['rank'] >=0 && $clan_memb['rank'] <=3) {

echo '<div class="menu">        <li>  <a href="/clan/?vexit"><img src="/images/icons/cross.png" alt=""/> Покинуть Банду</a></li>
</div>

</div>
';
}

}
?>



<?
?>
</div>

</div>

<?
  
include './system/f.php';
  break;



  case 'money':
    $title = 'Общяг';    

include './system/h.php';  

if(!$clan['id'] OR $clan['id'] != $i['id']) {

  header('location: /clan/');

exit;

}

if($user['level']<=45){
$_SESSION['err'] = '<div class="alert"><div>  Общяг доступен с <img src="/images/icons/level.png" width="16" height="16" alt=""> 45-го уровня, у вас <img src="/images/icons/level.png" width="16" height="16" alt=""> '.$user['level'].' уровень</div></div>';
header('location: /clan/?'.$udet.'');
exit;
}


if(isset($_GET['vznos'])){
if(isset($_POST['g']) && isset($_POST['s'])){
$g = _string(_num($_POST['g']));

$s = _string(_num($_POST['s']));
if($g < 0 or $s < 0)$err = 'Ошибка взноса средств';
if(!$err){

  if($g OR $s) {

    if($g && $user['g'] >= $g && $_POST['g'] < $user['gold_clan']+1) {

  if($s < 1000000 && $g < $user['gold_clan'])$err='errors';
      mysql_query('UPDATE `clans` SET `g` = `g` + '.$g.' WHERE `id` = "'.$clan['id'].'"');
      mysql_query('UPDATE `users` SET `g` = `g` - '.$g.' WHERE `id` = "'.$user['id'].'"');
    
mysql_query('UPDATE `users` SET `gold_clan` = `gold_clan` - '.$g.' WHERE `id` = "'.$user['id'].'"');

$timey = time();

$texy="<img src='/images/icons/gold.png' alt=''> $g ";
mysql_query('INSERT INTO `clan_journal` SET `cl_id` = "'.$clan['id'].'",`time` = "'.$timey.'",`login` = "'.$user['login'].'",`user` = "'.$user['id'].'", `cl` = "1",`text` = "'.$texy.'"');
    }
    
    if($s && $user['s'] >= $s && $_POST['s'] < 1000000) {
      
      mysql_query('UPDATE `clans` SET `s` = `s` + '.$s.' WHERE `id` = "'.$clan['id'].'"');
      mysql_query('UPDATE `users` SET `s` = `s` - '.$s.' WHERE `id` = "'.$user['id'].'"');
    
$timey = time();

$texy="<img src='/images/icons/silver.png' alt=''> $s ";
mysql_query('INSERT INTO `clan_journal` SET `cl_id` = "'.$clan['id'].'",`time` = "'.$timey.'",`login` = "'.$user['login'].'",`user` = "'.$user['id'].'", `cl` = "1",`text` = "'.$texy.'"');


    }
  

  header('location: /clan/money/');
  
  }

}else{
header('Location: ?');
exit();

}}
}


?>

    <div class="content"><div class="block center color3 s125"><a href="/clan"><?=$clan['name']?></a>/ Общак</div>
            <div class="line"></div>
<div class="block">Лимит обновится через <?=_time($user['gold_clan_time'] -time())?></div>
<form class="block" action="/clan/money/?vznos" method="post">

<label class="control-label" for="clanbankform-silver">Рубли</label>
<input type="text" class="form-control" name="s" value="0" maxlength="7">
<div class="hint-block">Сегодня не более 10000000<img src="/images/icons/silver.png" alt=""></div>
<div class="help-block"></div>
<div class="form-group field-clanbankform-gold required">

<label class="control-label" for="clanbankform-gold">Сахар</label>
<input type="text" class="form-control" name="g" value="0" maxlength="4">
<div class="hint-block">Сегодня не более <?=$user['gold_clan']?><img src="/images/icons/gold.png" alt=""></div>
<div class="help-block"></div>
</div><span class="m3 btn_start middle"><span class="btn_end">
        <button type="submit" class="btn">Закинуть в общак</button></span>
</span>
</form>

</div>


<?
include './system/f.php';
  break;

  case 'memb':


if(!$i['id'] OR $clan['id'] != $i['id']) {

header('location: /clan/');

exit;
  

}

$memb = _string(_num($_GET['memb']));

  $memb = mysql_query('SELECT * FROM `clan_memb` WHERE `id` = "'.$memb.'"');
  $memb = mysql_fetch_array($memb);

  if(!$memb) {

  
  }
  
  $memb_user = mysql_query('SELECT * FROM `users` WHERE `id` = "'.$memb['user'].'"');
  $memb_user = mysql_fetch_array($memb_user);
$hu = mysql_query('SELECT * FROM `clans` WHERE `id` = "'.$memb['clan'].'"');
  $hu = mysql_fetch_array($hu);
  
    $title = $memb_user['login'];    

include './system/h.php';  

   
  
  if($memb['rank'] != 5 && $memb['rank'] < $clan_memb['rank']) {
$typ = _string($_POST['typ']);
  if($typ) {
  
      mysql_query('UPDATE `clan_memb` SET `rank` = "'.$typ.'" WHERE `clan` = "'.$clan['id'].'" AND `id` = "'.$memb['id'].'"');

      header('location: /clan/memb/'.$memb['id'].'/');
  
  }
     
  }

  if($memb['rank'] < $clan_memb['rank'] && $memb['rank'] > 5) {


    if(_string(_num($_GET['down'] == true))) {

      mysql_query('UPDATE `clan_memb` SET `rank` = "'.($memb['rank'] - 1).'" WHERE `clan` = "'.$clan['id'].'" AND `id` = "'.$memb['id'].'"');

        header('location: /clan/memb/'.$memb['id'].'/');

    }

  }

?>


<div class="content"><div class="block center color3 s125"><a href="/clan/<?=$hu['id']?>/"><?=$hu['name']?></a>/ <?=$title?></div>
            <div class="line"></div>


<?

  switch($memb['rank']) {
  
    case 1:
    $rank = 'Новобранец';
     break;
    case 2:
    $rank = 'Смотрящий';
     break;
    case 3:
    $rank = 'Помощник';
     break;
    case 4:
    $rank = 'Заместитель';
     break;
    case 5:
    $rank = 'Главарь';
     break;
    
  }


?>


<?

$w_1 = mysql_query('SELECT * FROM `inv` WHERE `user` = "'.$memb_user['id'].'" AND `id` = "'.$memb_user['w_1'].'"');
$w_1 = mysql_fetch_array($w_1);
if(!$w_1) {
  $w_1['item'] = 0;
}
$w_1_item = mysql_query('SELECT * FROM `items` WHERE `id` = "'.$w_1['item'].'"');
$w_1_item = mysql_fetch_array($w_1_item);

$w_2 = mysql_query('SELECT * FROM `inv` WHERE `user` = "'.$memb_user['id'].'" AND `id` = "'.$memb_user['w_2'].'"');
$w_2 = mysql_fetch_array($w_2);
if(!$w_2) {
  $w_2['item'] = 0;
}

$w_2_item = mysql_query('SELECT * FROM `items` WHERE `id` = "'.$w_2['item'].'"');
$w_2_item = mysql_fetch_array($w_2_item);

$w_3 = mysql_query('SELECT * FROM `inv` WHERE `user` = "'.$memb_user['id'].'" AND `id` = "'.$memb_user['w_3'].'"');
$w_3 = mysql_fetch_array($w_3);
if(!$w_3) {
  $w_3['item'] = 0;
}

$w_3_item = mysql_query('SELECT * FROM `items` WHERE `id` = "'.$w_3['item'].'"');
$w_3_item = mysql_fetch_array($w_3_item);


$w_4 = mysql_query('SELECT * FROM `inv` WHERE `user` = "'.$memb_user['id'].'" AND `id` = "'.$memb_user['w_4'].'"');
$w_4 = mysql_fetch_array($w_4);

if(!$w_4) {
  $w_4['item'] = 0;
}

$w_4_item = mysql_query('SELECT * FROM `items` WHERE `id` = "'.$w_4['item'].'"');
$w_4_item = mysql_fetch_array($w_4_item);

$w_5 = mysql_query('SELECT * FROM `inv` WHERE `user` = "'.$memb_user['id'].'" AND `id` = "'.$memb_user['w_5'].'"');
$w_5 = mysql_fetch_array($w_5);
if(!$w_5) {
  $w_5['item'] = 0;
}
$w_5_item = mysql_query('SELECT * FROM `items` WHERE `id` = "'.$w_5['item'].'"');
$w_5_item = mysql_fetch_array($w_5_item);

$w_6 = mysql_query('SELECT * FROM `inv` WHERE `user` = "'.$memb_user['id'].'" AND `id` = "'.$memb_user['w_6'].'"');
$w_6 = mysql_fetch_array($w_6);
if(!$w_6) {
  $w_6['item'] = 0;
}
$w_6_item = mysql_query('SELECT * FROM `items` WHERE `id` = "'.$w_6['item'].'"');
$w_6_item = mysql_fetch_array($w_6_item);

$w_7 = mysql_query('SELECT * FROM `inv` WHERE `user` = "'.$memb_user['id'].'" AND `id` = "'.$memb_user['w_7'].'"');
$w_7 = mysql_fetch_array($w_7);
if(!$w_7) {
  $w_7['item'] = 0;
}
$w_7_item = mysql_query('SELECT * FROM `items` WHERE `id` = "'.$w_7['item'].'"');
$w_7_item = mysql_fetch_array($w_7_item);

$w_8 = mysql_query('SELECT * FROM `inv` WHERE `user` = "'.$memb_user['id'].'" AND `id` = "'.$memb_user['w_8'].'"');
$w_8 = mysql_fetch_array($w_8);
if(!$w_8) {
  $w_8['item'] = 0;
}
$w_8_item = mysql_query('SELECT * FROM `items` WHERE `id` = "'.$w_8['item'].'"');
$w_8_item = mysql_fetch_array($w_8_item);

?>

<div class="block">
<?
if($memb_user['r'] == 0) {
?>
       <a class="left mr8" href="/user/<?=$memb_user['id']?>/"><img src="http://bespredel.mobi/maneken?sex=man&amp;width=120&amp;height=160&amp;fragment=1&amp;frame=&amp;equip%5B1%5D=<?=$w_1['item']?>&amp;equip%5B2%5D=<?=$w_2['item']?>&amp;equip%5B3%5D=<?=$w_3['item']?>&amp;equip%5B4%5D=<?=$w_4['item']?>&amp;equip%5B5%5D=<?=$w_5['item']?>&amp;equip%5B6%5D=<?=$w_6['item']?>&amp;equip%5B7%5D=<?=$w_7['item']?>&amp;equip%5B8%5D=<?=$w_8['item']?>" width="50" height="50" alt=""></a>


<?
}
if($memb_user['r'] == 1) {

?>
       <a class="left mr8" href="/user/<?=$memb_user['id']?>/"><img src="http://bespredel.mobi/maneken?sex=woman&amp;width=120&amp;height=160&amp;fragment=1&amp;frame=&amp;equip%5B1%5D=<?=$w_1['item']?>&amp;equip%5B2%5D=<?=$w_2['item']?>&amp;equip%5B3%5D=<?=$w_3['item']?>&amp;equip%5B4%5D=<?=$w_4['item']?>&amp;equip%5B5%5D=<?=$w_5['item']?>&amp;equip%5B6%5D=<?=$w_6['item']?>&amp;equip%5B7%5D=<?=$w_7['item']?>&amp;equip%5B8%5D=<?=$w_8['item']?>" width="50" height="50" alt=""></a>


<?
}
?>
 </div>


<?
if($memb_user['vip'] == 0 && $memb_user['access'] == 0){
?>
<img src="/images/icons/<?=$memb_user['r']?>.png" width="16" height="16" alt="">
<?
}

if($memb_user['access'] == 1) {
?>
<img src="/images/icons/mod.png" width="16" height="16" alt="">
<?
}
if($memb_user['access'] == 2) {
?>
<img src="/images/icons/mod.png" width="16" height="16" alt="">
<?}
if($memb_user['access'] == 3) {
?>
<img src="/images/icons/adminy.png" width="16" height="16" alt="">
<?
}
if($memb_user['vip'] == 1 && $memb_user['access'] == 0){
?>
<img src="/images/icons/vip_<?=($memb_user['r'] == man ? 'woman':'man')?>_<?=$memb_user['r']?>.png" width="16" height="16" alt="">
<?
}
?>
 <a class="color3" href="/user/<?=$memb_user['id']?>/"><?=$memb_user['login']?></a>, <?=$rank?>    <div class="color2 small"><img src="/images/icons/date.png" width="16" height="16" alt=""> Поступление:
    <?=(date('d ', $memb['time']) . $monthes[(date('n', $memb['time']))] . date(' H:i', $memb['time']));?> </div>
    <div class="clear"></div>

<div class="dotted"></div>
<div class="block">
    Кол-во участий в подвале: <img src="/images/icons/basement_rating.png" width="16" height="16" alt="">    <?=($memb['exp'])?></div>
    <div class="dotted"></div>


<?




if(!$i['id'] OR $hu['id'] == $i['id']) {
  if($memb['rank'] != 1 && $memb['rank'] < $clan_memb['rank']) {
}
if($memb['rank'] != 4 && $clan_memb['rank'] >= 4) {
}
$me = mysql_query('SELECT * FROM `clan_memb` WHERE `clan` = "'.$clan['id'].'" AND `user` = "'.$user['id'].'"');
  $me = mysql_fetch_array($me);


if($me['rank'] != 4 OR $me['rank'] == 5) {
if($me['rank'] == 5 OR $me['rank'] == 4 OR $memb['rank'] == 4 OR $memb['rank'] == 3 OR $memb['rank'] == 2 OR $memb['rank'] == 1) {
  if($_GET['delete'] == true) {
    mysql_query('DELETE FROM `clan_memb` WHERE `id` = "'.$memb['id'].'"');
 mysql_query('DELETE FROM `bes_u` WHERE `user` = "'.$user['id'].'"');

 

$timey = time();

$texy=" изгнан из банды <img src=/images/icons/1.png alt=> <a href=/user/$user[id]>$user[login]</a> ";
mysql_query('INSERT INTO `clan_journal` SET `cl_id` = "'.$clan['id'].'",`time` = "'.$timey.'",`login` = "'.$memb_user['login'].'",`user` = "'.$memb_user['id'].'", `cl` = "2",`text` = "'.$texy.'",`loginp` = "'.$user['login'].'",`userp` = "'.$user['id'].'"');
  header('location: /clan/');
  
  }

?>
    <form class="block" action="/clan/memb/<?=$memb['id']?>/" method="post">

<label class="control-label" for="clanprivilegeform-privilege">Чин</label>
<select class="form-control" name="typ">
<? if($me['rank'] == 5){?><option value="4">Заместитель</option>
<?}?>
<option value="3">Помощник</option>
<option value="2">Смотрящий</option>
<option value="1">Новобранец</option>
</select>

<div class="help-block"></div>
    <span class="m3 btn_start middle"><span class="btn_end"><button type="submit" class="btn">Сохранить</button></span></span>
    </form>    <div class="dotted"></div>
    <div class="block center">
    <span class="btn_start"><span class="btn_end"><a class="btn" href="/clan/memb/<?=$memb['id']?>/?delete=true">Изгнать из банды</a></span> </span>    </div>
</div>


 
<?


}


}
?>

<?

}


include './system/f.php';
  break;

  case 'built':
    $title = 'Статуя клана';    

include './system/h.php';  


$id = _string(_num($_GET['id']));

if(!$id && $clan) {
    $id = $clan['id'];
}

  $i = mysql_query('SELECT * FROM `clans` WHERE `id` = "'.$id.'"');
  $i = mysql_fetch_array($i);

  if(!$i) {
  
      header('location: /clan/');
  
  exit;
  
  }




  $progress = round(100 / (34 / $i['built_1']));

  function cost($i) {
    
    switch($i) {
      case 0:
      $cost = 1200; 
       break;
      case 1:
      $cost = 1200; 
       break;
      case 2:
      $cost = 1230; 
       break;
      case 3:
      $cost = 180; 
       break;
      case 4:
      $cost = 1300; 
       break;
      case 5:
      $cost = 1330; 
       break;


      case 6:

      $cost = 1350; 
       break;
      case 7:

      $cost = 1370; 
       break;
      case 8:
      $cost = 360; 
       break;
      case 9:
      $cost = 1400; 
       break;
      case 10:
      $cost = 1430; 
       break;
      case 11:
      $cost = 1450; 
       break;
      case 12:

      $cost = 720; 
       break;
      case 13:



      $cost = 1500; 
       break;
      case 14:
      $cost = 1600; 
       break;
      case 15:
      $cost = 1700; 
       break;
      case 16:
      $cost = 1440; 
       break;
      case 17:
      $cost = 3200; 
       break;
      case 18:
      $cost = 3300; 
       break;
      case 19:
      $cost = 3500; 
       break;
      case 20:
      $cost = 2880; 
       break;
      case 21:
      $cost = 4500; 
       break;
      case 22:
      $cost = 4800; 
       break;
      case 23:
      $cost = 5200; 
       break;
      case 24:
      $cost = 3000; 
       break;
      case 25:
      $cost = 6000; 
       break;
      case 26:
      $cost = 6200; 
       break;
      case 27:
      $cost = 6400; 
       break;
      case 28:
      $cost = 3300; 
       break;
      case 29:
      $cost = 6500; 
       break;
      case 30:
      $cost = 7000; 
       break;
      case 31:
      $cost = 7400; 
       break;
      case 32:
      $cost = 3500; 
       break;
      case 33:
      $cost = 8000; 
       break;
      case 34:
      $cost = 8100;
       break;
      case 35:
      $cost = 8300;
       break;
      case 36:
      $cost = 4000;
       break;
      case 37:
      $cost = 9000;
       break;
      case 38:
      $cost = 9100;
       break;
      case 39:
      $cost = 9300;
       break;
      case 40:
      $cost = 4200;
       break;
      case 41:
      $cost = 10000;
       break;
      case 42:
      $cost = 11000;
       break;
      case 43:
      $cost = 11500;
       break;
      case 44:
      $cost = 4400;
       break;
      case 45:
      $cost = 12000;
       break;
      case 46:
      $cost = 12500;
       break;
      case 47:
      $cost = 13000;
       break;

      case 48:
      $cost = 4600;
       break;
      case 49:
      $cost = 13500;
       break;
      case 50:
      $cost = 14000;
       break;
      case 51:
      $cost = 14500;
       break;
      case 52:
      $cost = 4800;
       break;
      case 53:
      $cost = 15500;
       break;
      case 54:
      $cost = 16000;
       break;
      case 55:
      $cost = 16500;
       break;
      case 56:

      $cost = 5200;
       break;
      case 57:
      $cost = 17000;

       break;
      case 58:
      $cost = 17500;
       break;
      case 59:
      $cost = 18000;
       break;
      case 60:
      $cost = 5400;
       break;
      case 61:
      $cost = 19000;
       break;
      case 62:
      $cost = 20000;
       break;
      case 63:
      $cost = 21000;
       break;
      case 64:
      $cost = 5600;

       break;
      case 65:
      $cost = 22000;
       break;
      case 66:
      $cost = 23000;
       break;
      case 67:
      $cost = 24000;
       break;
      case 68:

      $cost = 5800;
       break;
      case 69:
      $cost = 25000;
       break;
      case 70:
      $cost = 27000;
       break;
      case 71:
      $cost = 29000;
       break;
      case 72:
      $cost = 6000;
       break;
      case 73:
      $cost = 31000;
       break;
      case 74:
      $cost = 33000;
       break;
      case 75:
      $cost = 35000;
       break;
      case 76:
      $cost = 6200;
       break;
      case 77:
      $cost = 37000;
       break;
      case 78:
      $cost = 39000;
       break;
      case 79:
      $cost = 41000;
       break;
      case 80:
      $cost = 6400;
       break;
      case 81:
      $cost = 44000;
       break;
      case 82:
      $cost = 46000;
       break;
      case 83:
      $cost = 48000;
       break;

      case 84:
      $cost = 6600;
       break;


      case 85:

      $cost = 50000;
       break;
      case 86:
      $cost = 52000;
       break;
      case 87:
      $cost = 54000;
       break;
      case 88:
      $cost = 6800;
       break;
      case 89:
      $cost = 56000;
       break;
      case 90:
      $cost = 58000;
       break;
      case 91:
      $cost = 60000;
       break;
      case 92:
      $cost = 7000;
       break;
      case 93:
      $cost = 62000;
       break;
      case 94:
      $cost = 63000;
       break;
      case 95:
      $cost = 64000;
       break;
      case 96:
      $cost = 7400;
       break;
      case 97:
      $cost = 68000;
       break;
      case 98:
      $cost = 74000;
       break;
      case 99:
      $cost = 80000;
       break;
      case 100:
      $cost = 8800;
       break;


    }
  
  return $cost;
  
  }
  
  function value($i) {
  
    switch($i) {
      case 0:
      $value = 0; 
       break;
      case 1:
      $value = 0; 
       break;
      case 2:
      $value = 0; 
       break;
      case 3:
      $value = 1; 
       break;
      case 4:
      $value = 0; 
       break;
      case 5:
      $value = 0; 
       break;
      case 6:
      $value = 0; 
       break;
      case 7:
      $value = 0; 
       break;
      case 8:
      $value = 1; 
       break;
      case 9:
      $value = 0; 
       break;
      case 10:
      $value = 0; 
       break;
      case 11:
      $value = 0; 
       break;
      case 12:
      $value = 1; 
       break;
      case 13:
      $value = 0; 
       break;
      case 14:
      $value = 0; 
       break;
      case 15:
      $value = 0; 
       break;
      case 16:
      $value = 1; 
       break;
      case 17:
      $value = 0; 
       break;
      case 18:
      $value = 0; 
       break;
      case 19:
      $value = 0; 
       break;
      case 20:
      $value = 1; 
       break;
      case 21:
      $value = 0; 
       break;
      case 22:
      $value = 0; 
       break;
      case 23:
      $value = 0; 
       break;
      case 24:
      $value = 1; 
       break;
      case 25:
      $value = 0; 
       break;
      case 26:
      $value = 0; 
       break;
      case 27:
      $value = 0; 
       break;
      case 28:
      $value = 1; 
       break;
      case 29:
      $value = 0; 
       break;
      case 30:
      $value = 0; 
       break;
      case 31:
      $value = 0; 
       break;
      case 32:
      $value = 1; 
       break;

      case 33:
      $value = 0; 
       break;
      case 34:
      $value = 0; 
       break;
      case 35:
      $value = 0; 
       break;
      case 36:
      $value = 1; 
       break;
      case 37:
      $value = 0; 
       break;
      case 38:
      $value = 0; 
       break;
      case 39:
      $value = 0; 

       break;
      case 40:
      $value = 1; 
       break;
      case 41:
      $value = 0; 
       break;
      case 42:
      $value = 0; 
       break;
      case 43:
      $value = 0; 
       break;
      case 44:
      $value = 1; 
       break;
      case 45:
      $value = 0; 
       break;
      case 46:
      $value = 0; 
       break;
      case 47:
      $value = 0; 
       break;
      case 48:
      $value = 1; 
       break;
      case 49:
      $value = 0; 
       break;
      case 50:
      $value = 0; 
       break;
      case 51:
      $value = 0; 
       break;
      case 52:
      $value = 1; 
       break;
      case 53:
      $value = 0; 
       break;
      case 54:
      $value = 0; 
       break;
      case 55:
      $value = 0; 
       break;
      case 56:
      $value = 1; 
       break;
      case 57:
      $value = 0; 
       break;
      case 58:
      $value = 0; 
       break;
      case 59:
      $value = 0; 
       break;
      case 60:
      $value = 1; 
       break;
      case 61:
      $value = 0; 
       break;
      case 62:
      $value = 0; 
       break;
      case 63:
      $value = 0; 
       break;
      case 64:
      $value = 1; 
       break;
      case 65:
      $value = 0; 
       break;
      case 66:
      $value = 0; 
       break;
      case 67:
      $value = 0; 
       break;
      case 68:
      $value = 1; 
       break;
      case 69:
      $value = 0; 
       break;
      case 70:
      $value = 0; 
       break;
      case 71:
      $value = 0; 
       break;
      case 72:
      $value = 1; 
       break;
      case 73:
      $value = 0; 
       break;
      case 74:
      $value = 0; 
       break;
      case 75:
      $value = 0; 
       break;
      case 76:
      $value = 1; 
       break;
      case 77:
      $value = 0; 
       break;
      case 78:
      $value = 0; 
       break;
      case 79:
      $value = 0; 
       break;
      case 80:
      $value = 1; 
       break;
      case 81:
      $value = 0; 
       break;
      case 82:
      $value = 0; 
       break;
      case 83:
      $value = 0; 
       break;
      case 84:
      $value = 1; 
       break;
      case 85:
      $value = 0; 
       break;
      case 86:
      $value = 0; 
       break;
      case 87:
      $value = 0; 
       break;
      case 88:
      $value = 1; 
       break;
      case 89:
      $value = 0; 
       break;
      case 90:
      $value = 0; 
       break;
      case 91:
      $value = 0; 
       break;
      case 92:
      $value = 1; 
       break;
      case 93:
      $value = 0; 
       break;
      case 94:
      $value = 0; 
       break;
      case 95:
      $value = 0; 
       break;
      case 96:
      $value = 1; 
       break;
      case 97:
      $value = 0; 
       break;
      case 98:
      $value = 0; 
       break;
      case 99:
      $value = 0; 
       break;
      case 100:
      $value = 1; 

    }
    
  return $value;
      
  }

?>



   <div class="content"><div class="block center color3 s125"><a href="/clan/<?=$i['id']?>/"> <?=$i['name']?></a>/ Подогревы</div>
            <div class="line"></div>    <div class="block">
        <div class="left">
            
<?

  $_built_1_progress = round(100 / (100 / $i['built_1']));

$clan1 = round($i['built_1']*250)*6;
?>

    <div>
    <img src="/images/icons/currentHealth.png" width="16" height="16" alt=""> Здоровье:  <?=$clan1?>  </div>
        </div>
        <div>&nbsp;(<?=$i['built_1']?>/100)</div>
        <div class="clear"></div>
        <div class="m3"><div style="width: 50%; height: 6px"
            class="progress-white">
            <div style="width: <?=$_built_1_progress?>%; height: 6px" class="progress-green"></div></div></div>
    </div>
            <div class="dotted"></div>



<?

  if($i['id'] == $clan['id'] && $clan_memb['rank'] == 5 && $i['built_1'] < 100) {

  if(isset($_GET['up'])) {
  
    if($i[(value($i['built_1']) == 1 ? 'g':'s')] >= cost($i['built_1'])) {
    
      mysql_query('UPDATE `clans` SET `built_1` = `built_1` + 1,
     `'.(value($i['built_1']) == 1 ? 'g':'s').'` = `'.(value($i['built_1']) == 1 ? 'g':'s').'` - '.cost($i['built_1']).' WHERE `id` = "'.$i['id'].'"');
    
    header('location: /clan/built/?'.$udet.'');
    
    }
  
  }

?>
      <div class="block center">


                        <span class="btn_start"><span class="btn_end"><a class="btn" href="/clan/built/?up=<?=$randp = rand(222,999)?>">Прокачать за     <img src="/images/icons/<?=(value($i['built_1']) == 1 ? 'gold':'silver')?>.png" width="16" height="16" alt=""> <?=cost($i['built_1'])?></a></span> </span>        </div>
    

         
    <div class="dotted"></div>
  
<?

  }

?>
            
  <div class="block">
        <div class="left">


<?

  $_built_2_progress = round(100 / (100 / $i['built_2']));

$clan2 = round($i['built_2']*250)*6;
?>

    <div>
    <img src="/images/icons/damage.png" width="16" height="16" alt=""> Сила:  <?=$clan2?>    </div>
        </div>
        <div>&nbsp;(<?=$i['built_2']?>/100)</div>
        <div class="clear"></div>
        <div class="m3"><div style="width: 50%; height: 6px"
            class="progress-white">
            <div style="width: <?=$_built_2_progress?>%; height: 6px" class="progress-green"></div></div></div>
    </div>
            <div class="dotted"></div>
   


<?

  if($i['id'] == $clan['id'] && $clan_memb['rank'] == 5 && $i['built_2'] < 100) {

  if(isset($_GET['upi'])) {
  
    if($i[(value($i['built_2']) == 1 ? 'g':'s')] >= cost($i['built_2'])) {
    
      mysql_query('UPDATE `clans` SET `built_2` = `built_2` + 1,
     `'.(value($i['built_2']) == 1 ? 'g':'s').'` = `'.(value($i['built_2']) == 1 ? 'g':'s').'` - '.cost($i['built_2']).' WHERE `id` = "'.$i['id'].'"');
    
    header('location: /clan/built/?'.$udet.'');
    
    }
  
  }

?>
      <div class="block center">



                        <span class="btn_start"><span class="btn_end"><a class="btn" href="/clan/built/?upi=<?=$randp = rand(222,999)?>">Прокачать за     <img src="/images/icons/<?=(value($i['built_2']) == 1 ? 'gold':'silver')?>.png" width="16" height="16" alt=""> <?=cost($i['built_2'])?> </a></span> </span>        
</div>
        

 <div class="dotted"></div>
  

<?

  }

?>
            

  <div class="block">
        <div class="left">

  
<?

  $_built_3_progress = round(100 / (100 / $i['built_3']));

$clan3 = round($i['built_3']*250)*6;

?>
    <div>
    <img src="/images/icons/armor.png" width="16" height="16" alt=""> Защита:  <?=$clan3?>   </div>
        </div>
        <div>&nbsp;(<?=$i['built_3']?>/100)</div>
        <div class="clear"></div>
        <div class="m3"><div style="width: 50%; height: 6px"
            class="progress-white">
            <div style="width: <?=$_built_3_progress?>%; height: 6px" class="progress-green"></div></div></div>
    </div>
            <div class="dotted"></div>
    
<?

  if($i['id'] == $clan['id'] && $clan_memb['rank'] == 5 && $i['built_3'] < 100) {

  if(isset($_GET['upo'])) {
  
    if($i[(value($i['built_3']) == 1 ? 'g':'s')] >= cost($i['built_3'])) {
    
      mysql_query('UPDATE `clans` SET `built_3` = `built_3` + 1,
     `'.(value($i['built_3']) == 1 ? 'g':'s').'` = `'.(value($i['built_3']) == 1 ? 'g':'s').'` - '.cost($i['built_3']).' WHERE `id` = "'.$i['id'].'"');
    
    header('location: /clan/built/?'.$udet.'');
    
    }
  
  }

?>

      <div class="block center">



                        <span class="btn_start"><span class="btn_end"><a class="btn" href="/clan/built/?upo=<?=$randp = rand(222,999)?>">Прокачать за     <img src="/images/icons/<?=(value($i['built_3']) == 1 ? 'gold':'silver')?>.png" width="16" height="16" alt=""> <?=cost($i['built_3'])?> </a></span> </span>        
</div>
     


    <div class="dotted"></div>
   
<?


  }

?>


  <div class="block">
        <div class="left">


<?

  $_built_4_progress = round(100 / (100 / $i['built_4']));

?>
    <div>
    <img src="/images/icons/experience.png" width="16" height="16" alt=""> Опыт:  <?=$_built_4_progress?>%    </div>
        </div>
        <div>&nbsp;(<?=$i['built_4']?>/100)</div>
        <div class="clear"></div>
        <div class="m3"><div style="width: 50%; height: 6px"
            class="progress-white">
            <div style="width: <?=$_built_4_progress?>%; height: 6px" class="progress-green"></div></div></div>
    </div>
            <div class="dotted"></div>
   

<?

  if($i['id'] == $clan['id'] && $clan_memb['rank'] == 5 && $i['built_4'] < 100) {

  if(isset($_GET['upr'])) {
  
    if($i[(value($i['built_4']) == 1 ? 'g':'s')] >= cost($i['built_4'])) {
    
      mysql_query('UPDATE `clans` SET `built_4` = `built_4` + 1,
     `'.(value($i['built_4']) == 1 ? 'g':'s').'` = `'.(value($i['built_4']) == 1 ? 'g':'s').'` - '.cost($i['built_4']).' WHERE `id` = "'.$i['id'].'"');
    
    header('location: /clan/built/?'.$udet.'');
    
    }
  
  }

?>

      <div class="block center">


                        <span class="btn_start"><span class="btn_end"><a class="btn" href="/clan/built/?upr=<?=$randp = rand(222,999)?>">Прокачать за     <img src="/images/icons/<?=(value($i['built_4']) == 1 ? 'gold':'silver')?>.png" width="16" height="16" alt="">  <?=cost($i['built_4'])?></a></span> </span>        
</div>
       
   <div class="dotted"></div>
 
<?

  }

?>


  <div class="block">
        <div class="left">

 

<?

  $_built_5_progress = round(100 / (2745 / $i['built_5']));


?>
    <div>
    <img src="/images/icons/experience.png" width="16" height="16" alt=""> Опыт банды:  <?=$i['built_5']?>%    </div>
        </div>
        <div>&nbsp;(<?=$i['built_5']?>/2745)</div>
        <div class="clear"></div>
        <div class="m3"><div style="width: 50%; height: 6px"
            class="progress-white">
            <div style="width: <?=$_built_5_progress?>%; height: 6px" class="progress-green"></div></div></div>
    </div>
            <div class="dotted"></div>
  
<?
  

  
    $clan_99 = 250 + ($i['built_5'] * 100);

  $lvl1 = 35 + ($i['built_5'] * 5);
  if($i['id'] == $clan['id'] && $clan_memb['rank'] != 4 && $i['built_5'] < 2745) {

  if(isset($_GET['upe'])) {
  
    if($i['built_5'] >= 2745) {
  
}else{
if($i['s']>=$clan_99 && $i['g']>=$lvl1)
{
      mysql_query('UPDATE `clans` SET `built_5` = `built_5` + 1,
`s` = "'.($i['s']-$clan_99).'",`g`= "'.($i['g']-$lvl1).'" WHERE `id` = "'.$i['id'].'"');
    
    header('location: /clan/built/?'.$udet.'');
    
    }
  
}
  }

  
?>
      <div class="block center">



                        <span class="btn_start"><span class="btn_end"><a class="btn" href="/clan/built/?upe=<?=$randp = rand(222,999)?>">Прокачать за     <img src="/images/icons/silver.png" width="16" height="16" alt="">  <?=$clan_99?>  <img src="/images/icons/gold.png" width="16" height="16" alt="">  <?=$lvl1?></a></span> </span>        </div>
        <div class="dotted"></div>
</div>

<?

  }

?>


<?

include './system/f.php';
  break;


}

?>