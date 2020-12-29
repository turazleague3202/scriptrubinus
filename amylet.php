<?
    
    include './system/common.php';
    
 include './system/functions.php';
        
      include './system/user.php';
    
if(!$user) {

  header('location: /');
    
exit;

}
if($user['level']<=29){
header('Location: /menu?');exit;

}

$title =' Амулеты';
    include './system/h.php';

$amy = mysql_query('SELECT * FROM `amylet` WHERE `user` = "'.$user['id'].'"');  
  $amy = mysql_fetch_array($amy);

  if(!$amy) {
  
    mysql_query('INSERT INTO `amylet` (`user`) VALUES ("'.$user['id'].'")');
  
  }
?>
      <div class="content"><div class="block center color3 s125"><img src="/images/icons/circle.png" alt=""> <a href="?">Амулеты</a></div>
            <div class="line"></div>    

<?

$am_progress = round(100 / (20 /
$amy['lvl']));

if($user['am_o'] >= 1) {
?>

</td></tr></table><table><tr><td style="width:52px;padding:4px"><img src="/images/items/3.jpg" alt=""/></td><td style="padding:4px"><div style="font-size:14px;">Амулет Авторитета<div style="color:#a5a5a5;"><?=$amy['lvl']?> из 45.ур</div></span> <div style="color:#a5a5a5"><img src="/images/icons/plus.png" alt=""/> Авторитет увеличен на  <span style="color:green"><?=$amy['vpa']?>%</span></div></td></tr></table>
<?
     $lvl = 1370+ ($amy['lvl'] * 1400)*2;
    $lvl1 = 20 + ($amy['lvl'] * 12)*4;
  if($amy['lvl'] < 45) {

  if(isset($_GET['pro'])) {
if($lvl1 && $lvl <$user['s'] && $user['g']){
}else{

$_SESSION['err'] = '<div class="alert">
    <div class="color1 s125">Не хватает Ресурсов</div>
    <div class="a_separator"></div>
   </div>';

header('location: ?'.$udet.'');
}
    if($amy['lvl'] >= 45) {
  
}else{
if($user['s']>=$lvl && $user['g']>=$lvl1)
{
      mysql_query('UPDATE `amylet` SET `lvl` = `lvl` + 1, `vpa` = `vpa` + 1 WHERE `user` = "'.$user['id'].'"');
    mysql_query('UPDATE `users` SET `s` = "'.($user['s']-$lvl).'", `g` = "'.($user['g']-$lvl1).'" WHERE `id` = "'.$user['id'].'"');
    
$texy="Улучшил Амулет авторитета <img src=/images/icons/silver.png width=16 height=16 alt=> $lvl <img src=/images/icons/gold.png width=16 height=16 alt=> $lvl1 ";
mysql_query('INSERT INTO `golds` SET `user` = "'.$user['id'].'",`time` = "'.time().'",`text` = "'.$texy.'",`loc`="5"');
    header('location: ?'.$udet.'');
    
    }
  
}
  }

  
?>
      <div class="dotted"></div>
      <div class="block center">
                        <span class="btn_start"><span class="btn_end"><a class="btn" href="/amylet/?pro=<?=$randp = rand(222,999)?>">Прокачать за     <img src="/images/icons/silver.png" width="16" height="16" alt="">  <?=$lvl?>    <img src="/images/icons/gold.png" width="16" height="16" alt="">  <?=$lvl1?></a></span> </span>  </div>


<?
  }
}else{
$rt = 700;
  if(isset($_GET['ot'])) {
  
if($user['d']>=$rt)
{
      mysql_query('UPDATE `users` SET `am_o` = "1" WHERE `id` = "'.$user['id'].'"');
    mysql_query('UPDATE `users` SET `d` = "'.($user['d']-$rt).'" WHERE `id` = "'.$user['id'].'"');
    
    header('location: ?'.$udet.'');
    
    }
  
}

?>

<div class="dotted"></div>
<div class="block">У вас нет Амулета </div>
<div class="dotted"></div>
<div class="menu">   <li><a href="/amylet/?ot=<?=$randp = rand(222,999)?>"><img src="/images/icons/right_blue.png" width="16" height="16" alt=""> Купить за <img src="/images/icons/donate.png" width="16" height="16" alt="">  <?=$rt?>  </a></li> </div>
<?
}
?>

</div>

<?
include './system/f.php';
?>