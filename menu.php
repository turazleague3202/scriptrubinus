<?
    
    include './system/common.php';
    
 include './system/functions.php';
        
      include './system/user.php';
        
    $title = 'На главную';

include './system/h.php';  

    if(!$user) {

header('location: /');
exit;
}
$udet=rand(111111,999999);

 $ac = mysql_query('SELECT * FROM `agame` WHERE `id` = "1"');
  $ac = mysql_fetch_array($ac);

if($user['podarok_vsem'] == 0) {
mysql_query('UPDATE `users` SET `g` = `g` + 5000,`s` = `s` + 600000,`d` = `d` + 1000,`podarok_vsem`="1" WHERE `id` = "'.$user['id'].'"');
$_SESSION['not'] =  '<div class="dotted"></div>
<div class="alert"><div>                                                 <div class="blue"><img src="/images/icons/reward.png" width="16" height="16" alt=""> Подарок:</div>
    <img src="/images/icons/silver.png" width="16" height="16" alt=""> Рубли:+600000,   <img src="/images/icons/gold.png" width="16" height="16" alt=""> Сахар:+5000 <img src="/images/icons/donate.png" width="16" height="16" alt=""> Сгущёнка:+1000</div></div><div class="alert_bottom"></div>';
header('location: ?');
exit;
}
?>
   <div class="content"><div class="block center" style="background-image: url('/daerk/snow.png')">
    <img src="/images/title/log.jpg" width="230" height="85" alt=""></div>
<div class="line"></div>
<?
if($user['save'] == 0){
echo '<div class="block center"><span class="blue">
            <img src="/images/icons/ok.png" width="16" height="16" alt="">            Сохрани и получи</span>
            <img src="/images/icons/silver.png" width="16" height="16" alt=""> 5500    <img src="/images/icons/gold.png" width="16" height="16" alt=""> 1250       
                    <div class="m3"><span class="btn_start"><span class="btn_end"><a class="btn" href="/save?'.$udet.'">Сохранить</a></span> </span></div></div><div class="dotted"></div>
';
}
?>
<div class="menu">            <li><a href="/arena?<?=$udet?>"><img src="/images/icons/arena.jpg" width="16" height="16" alt=""> Разборки  <span class="green">(+)</span></a></li></div><div class="dotted"></div>
                        <div class="menu">        <li><a href="/job?<?=$udet?>"><img src="/images/icons/job.jpg" width="16" height="16" alt=""> Работа 
<?

  $farm = mysql_query('SELECT * FROM `farm` WHERE `user` = "'.$user['id'].'"');
  $farm = mysql_fetch_array($farm);

  if(!$farm OR $farm['h'] == 0 && $farm['time'] == 0 OR $farm['h'] > 0 && $farm['time'] <= time()) {

?>

<span class="green">($)</span>
<?

  }

?>
</a></li></div>    <div class="dotted"></div>

<?
 if($clan) {
	 
	 $podval = mysql_fetch_array(mysql_query('SELECT * FROM `podval_clan` WHERE `clan` = "'.$clan['id'].'"'));
 ?>
<div class="menu">            <li><a href='/clan/podval/'><img src="/images/icons/basement.jpg" width="16" height="16" alt=""> Подвал <?= ( !$podval ? ' <span style="color:#30c030;">(+)</span>':'<span style="color:red;">(+)</span>' ) ?></a></li></div><div class="dotted"></div>

 <?
}else{
?>
<div class="menu">    <li><a href="/menu?<?=$udet?>"><img src="/images/icons/basement.jpg" width="16" height="16" alt=""> <span class="color2">Подвал <span class="small">(нужна банда)</span></span></a></li></div><div class="dotted"></div>
<?
}
?>
<?
if($clan){
?>
<div class="menu">            <li><a href="/dop/?<?=$udet?>"><img src="/images/icons/basement.jpg" width="16" height="16" alt=""> Голодовка <font color='#909090'>(<?=_time(($battl['time'] - time()))?>)</font>
</a></li></div><div class="dotted"></div>
<?
}else{
?>
<div class="menu">    <li><a href="/menu?<?=$udet?>"><img src="/images/icons/basement.jpg" width="16" height="16" alt=""> <span class="color2">Голодовка <span class="small">(нужна банда)</span></span></a></li></div><div class="dotted"></div>
<?
}
?>
<div class="menu">            <li><a href="/bas/?<?=$udet?>"><img src="/images/icons/gun.jpg" width="16" height="16" alt=""> Побег </a></li></div><div class="dotted"></div>

<div class="menu">    <li><a href="/bunt/?<?=$udet?>"><img src="/images/icons/starvation.jpg" width="16" height="16" alt=""> Бунт
<font color='#909090'>(<?=_time(($battle['time'] - time()))?>)</font>
</a></li></div><div class="dotted"></div>

<div class="menu"><li><a href="/vor?<?=$udet?>"><img src="/images/icons/dice.jpg" width="16" height="16" alt=""> <span class="blue">Аршин:</span> Барыга </a></li></div><div class="dotted"></div>
<div class="menu">            <li><a href="/outfit?<?=$udet?>"><img src="/images/icons/outfit.jpg" width="16" height="16" alt=""> Замутить шмотки <? if($ac['sh'] <=0){
}else{?> <span class="green">Акция!</span> <?}?></a></li>
<li><a href="/paywk/?<?=$udet?>"><img src="/images/icons/donate.png" width="16" height="16" alt=""> Замутить Сгущёнку </a></li><li><a href="/clans?<?=$udet?>"><img src="/images/icons/clan.jpg" width="16" height="16" alt=""> Малина банд</a></li></div><div class="dotted"></div>
<div class="menu">
<li><a href="/rating?<?=$udet?>"><img src="/images/icons/rating.jpg" width="16" height="16" alt=""> Блатная малина <span class="blue"></span></a></li>
</div><div class="dotted"></div>
<div class="menu">
<li><a href="/tur?<?=$udet?>"><img src="/images/icons/rating.jpg" width="16" height="16" alt=""> Турнир лучший Авторитет <span class="blue"></span></a></li>
</div><div class="dotted"></div>

</div>


<?
    
include './system/f.php';

?>