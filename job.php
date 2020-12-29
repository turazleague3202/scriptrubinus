<?
    
    include './system/common.php';
    
 include './system/functions.php';
        
      include './system/user.php';
    
if(!$user) {

  header('location: /');
    
exit;

}


    $title = 'Поход';    

include './system/h.php';

$farm = mysql_query('SELECT * FROM `farm` WHERE `user` = "'.$user['id'].'"');  
  $farm = mysql_fetch_array($farm);

  

  $farmy = mysql_query('SELECT * FROM `farm_logs` WHERE `user` = "'.$user['id'].'"');  
  $farmy = mysql_fetch_array($farmy);

 if(!$farmy) {
  
    mysql_query('INSERT INTO `farm_logs` (`user`) VALUES ("'.$user['id'].'")');
  
  }

  if(!$farm) {
  
    mysql_query('INSERT INTO `farm` (`user`) VALUES ("'.$user['id'].'")');
  
  }
?>
                            
    <div class="content"><div class="block center color3 s125"><img src="/images/icons/circle.png" alt=""> <a href="/job?">Работа</a></div>
            <div class="line"></div>    

        <div class="block">
        <div class="left mr8">
            <img src="/images/job/1.jpg" width="150" height="75" alt="">        </div>
        <div class="blue bold">Канализация</div>
<?
if($farm['h'] <= 0) {
if($user['vip'] == 0){ 
$guy=($farm['lvl'] * 140);
}else{$guy=($farm['lvl'] * 140)*2;}
?>
  <img src="/images/icons/reward.png" width="16" height="16" alt=""> Доход/час:     <img src="/images/icons/experience.png" width="16" height="16" alt="">  <?=$guy?>                  



<?

}
  if($farm['h'] == 0 && $farm['time'] == 0) {
  
  $h = _string(_num($_POST['h']));
  
    if($h && $user['level'] >= $h * 1) {
    
      $hs = ($h * (60 * 60));

  if($h) {
     mysql_query('UPDATE `farm_logs` SET `h` = "'.$h.'" WHERE `user` = "'.$user['id'].'"');
  }
            
      mysql_query('UPDATE `farm` SET `h` = "'.$h.'", `time` = "'.(time() + $hs).'" WHERE `user` = "'.$user['id'].'"');
    
    header('location: /job');
    
    }

?>


<div class="form-group field-jobworkform-hour_id required">

<form action='/job' method='post'>
  <select name='h'>

<?

   for($h = 1; $h < 9; $h++) {

if($user['level'] >= $h * 1) {

?>

<option value='<?=$h?>'><?=$h?> час(ов)<?=($h == 1 ? '':($h == 9 ? '':''))?></option>

<?

    }

  }

?>

  </select>
<div class="help-block"></div>
</div>            <span class="m3 btn_start middle"><span class="btn_end">
                    <button type="submit" class="btn">Работать</button></span>
            </span>
</form>
</div>
<?

  }
  else
  {


if($farm['time'] > time()) {

  if(isset($_GET['end'])) {
    mysql_query('UPDATE `farm` SET `h` = "0", 
                                `time` = "0" WHERE `user` = "'.$user['id'].'"');
    header('location: /job/');
  }
  

if($user['vip'] == 0){ 
$guy=($farmy['h'] * $farm['lvl'] * 140);
}else{$guy=($farmy['h'] * $farm['lvl'] * 140)*2;}
?>
 </div>

       <img src="/images/icons/reward.png" width="16" height="16" alt="">                    Доход:     <img src="/images/icons/experience.png" width="16" height="16" alt="">   <?=$guy?>          <div>
    <img src="/images/icons/date.png" width="16" height="16" alt=""> <?=_time($farm['time'] - time())?><br/>

  <span class="m3 btn_start middle">
<span class="btn_end"><a href='/job/?end=true' class='btn'>Отменить</a>
</span>
</span>
</br>


<?

  }
  else
  {

if($user['vip'] == 0){ 
$guy=($farmy['h'] * $farm['lvl'] * 140);
}else{$guy=($farmy['h'] * $farm['lvl'] * 140)*2;}

  if(isset($_GET['zavr'])) {
     mysql_query('UPDATE `users` SET `exp` = `exp` + '.$guy.', `exepy` = `exepy` + '.$guy.' WHERE `id` = "'.$user['id'].'"');  
      mysql_query('UPDATE `farm` SET `h` = "0",
                                  `time` = "0" WHERE `user` = "'.$user['id'].'"');
    
$_SESSION['not']='<div class="alert"><div>                                     <div class="blue"><img src="/images/icons/reward.png" width="16" height="16" alt=""> Прибыль:</div>
    <img src="/images/icons/experience.png" width="16" height="16" alt=""> Авторитет:+ '.$guy.'</div></div><div class="alert_bottom"></div>';
   header('location: /job/?'.$udet.'');
}
?>

        <div>
        <img src="/images/icons/reward.png" width="16" height="16" alt="">                    Доход:     <img src="/images/icons/experience.png" width="16" height="16" alt="">     <?=$guy?>                </div>


</div>
                        <div class="clear"></div>
                <div class="dotted"></div>
        <div class="block center">
  <span class="m3 btn_start middle"><span class="btn_end"><a class="btn" href="/job/?zavr=<?=$randp = rand(222,999)?>">Завершить работу</a></span> </span> </div>
      
<?

  }

  }

?>
<?
if($farm['h'] <= 0) {
?>
<?
     $lvl = 10 + ($farm['lvl'] * 180);

    $lvl1 = 4 + ($farm['lvl'] * 13);
  if($farm['lvl'] < 14) {

  if(isset($_GET['pro'])) {
  
    if($farm['lvl'] >= 14) {
  
}else{
if($user['s']>=$lvl && $user['g']>=$lvl1)
{
      mysql_query('UPDATE `farm` SET `lvl` = `lvl` + 1 WHERE `user` = "'.$user['id'].'"');
    mysql_query('UPDATE `users` SET `s` = "'.($user['s']-$lvl).'", `g` = "'.($user['g']-$lvl1).'" WHERE `id` = "'.$user['id'].'"');
    
    header('location: /job/');
    
    }
  
}
  }

  
?>
      <div class="dotted"></div>
      <div class="block center">
                        <span class="btn_start"><span class="btn_end"><a class="btn" href="/job/?pro=<?=$randp = rand(222,999)?>">Прокачать за     <img src="/images/icons/silver.png" width="16" height="16" alt="">  <?=$lvl?>    <img src="/images/icons/gold.png" width="16" height="16" alt="">  <?=$lvl1?></a></span> </span>  </div>


<?

  }

}
?>

 

         <div class="line"></div>
        <div class="block">
        <div class="left mr8">
            <img src="/images/job/2.jpg" width="150" height="75" alt="">        </div>
        <div class="blue bold">Шахта</div>

<?
if($farm['h2'] <= 0) {
if($user['vip'] == 0){ 
$guy=($farm['lvl2'] * 50);
}else{$guy=($farm['lvl2'] * 50)*2;}
?>
 <img src="/images/icons/reward.png" width="16" height="16" alt=""> Доход/час:     <img src="/images/icons/silver.png" width="16" height="16" alt="">  <?=$guy?>                  


<?

}
  if($farm['h2'] == 0 && $farm['time2'] == 0) {
  
  $h2 = _string(_num($_POST['h2']));
  

    if($h2 && $user['level'] >= $h2 * 1) {
    
      $hsi = ($h2 * (60 * 60));

  if($h2) {
     mysql_query('UPDATE `farm_logs` SET `h2` = "'.$h2.'" WHERE `user` = "'.$user['id'].'"');
  }
            
      mysql_query('UPDATE `farm` SET `h2` = "'.$h2.'", `time2` = "'.(time() + $hsi).'" WHERE `user` = "'.$user['id'].'"');
    
    header('location: /job');
    
    }

?>


<div class="form-group field-jobworkform-hour_id required">

<form action='/job' method='post'>
  <select name='h2'>

<?

   for($h2 = 1; $h2 < 9; $h2++) {

if($user['level'] >= $h2 * 1) {

?>

<option value='<?=$h2?>'><?=$h2?> час(ов)<?=($h2 == 1 ? '':($h2 == 9 ? '':''))?></option>

<?

    }

  }

?>

  </select>
<div class="help-block"></div>
</div>            <span class="m3 btn_start middle"><span class="btn_end">
                    <button type="submit" class="btn">Работать</button></span>
            </span>
</form>
</div>
<?

  }
  else
  {


if($farm['time2'] > time()) {

  if(isset($_GET['endy'])) {
    mysql_query('UPDATE `farm` SET `h2` = "0", 
                                `time2` = "0" WHERE `user` = "'.$user['id'].'"');
    header('location: /job/');
  }
  


if($user['vip'] == 0){ 
$guy=($farmy['h2'] * $farm['lvl2'] * 50);
}else{$guy=($farmy['h2'] * $farm['lvl2'] * 50)*2;}

?>
 </div>

       <img src="/images/icons/reward.png" width="16" height="16" alt="">                    Доход:     <img src="/images/icons/silver.png" width="16" height="16" alt=""> <?=$guy?>            <div>
    <img src="/images/icons/date.png" width="16" height="16" alt=""> <?=_time($farm['time2'] - time())?><br/>

  <span class="m3 btn_start middle">
<span class="btn_end"><a href='/job/?endy=true' class='btn'>Отменить</a>
</span>
</span>
</br>


<?

  }
  else
  {

if($user['vip'] == 0){ 
$guy=($farmy['h2'] * $farm['lvl2'] * 50);
}else{$guy=($farmy['h2'] * $farm['lvl2'] * 50)*2;}
  if(isset($_GET['zavr2'])) {
     mysql_query('UPDATE `users` SET `s` = `s` + '.$guy.' WHERE `id` = "'.$user['id'].'"');  
      mysql_query('UPDATE `farm` SET `h2` = " 0",
                                  `time2` = "0" WHERE `user` = "'.$user['id'].'"');
    
$_SESSION['not']='<div class="alert"><div>                                     <div class="blue"><img src="/images/icons/reward.png" width="16" height="16" alt=""> Прибыль:</div>
    <img src="/images/icons/silver.png" width="16" height="16" alt=""> Рубли:+ '.$guy.'</div></div><div class="alert_bottom"></div>';
   header('location: /job/?'.$udet.'');
}
    
?>

        <div>
        <img src="/images/icons/reward.png" width="16" height="16" alt="">                    Доход:     <img src="/images/icons/silver.png" width="16" height="16" alt=""> <?=$guy?>      
 </div>


</div>
                        <div class="clear"></div>
                <div class="dotted"></div>
        <div class="block center">
  <span class="m3 btn_start middle"><span class="btn_end"><a class="btn" href="/job/?zavr2=<?=$randp = rand(222,999)?>">Завершить работу</a></span> </span> </div>
      
<?

  }

  }

?>
 
<?
if($farm['h2'] <= 0) {
?>
<?
     $lvl2 = 10 + ($farm['lvl2'] * 180);

    $lvl_2 = 4 + ($farm['lvl2'] * 13);
  if($farm['lvl2'] < 14) {

  if(isset($_GET['pro2'])) {
  
    if($farm['lvl2'] >= 14) {
  
}else{
if($user['s']>=$lvl2&&$user['g']>=$lvl_2)
{
      mysql_query('UPDATE `farm` SET `lvl2` = `lvl2` + 1 WHERE `user` = "'.$user['id'].'"');
    mysql_query('UPDATE `users` SET `s` = "'.($user['s']-$lvl2).'", `g` = "'.($user['g']-$lvl_2).'" WHERE `id` = "'.$user['id'].'"');
    
    header('location: /job/');
    
    }
  
}
  }

  
?>
      <div class="dotted"></div>
      <div class="block center">
                        <span class="btn_start"><span class="btn_end"><a class="btn" href="/job/?pro2=<?=$randp = rand(222,999)?>">Прокачать за     <img src="/images/icons/silver.png" width="16" height="16" alt="">  <?=$lvl2?>    <img src="/images/icons/gold.png" width="16" height="16" alt="">  <?=$lvl_2?></a></span> </span>  </div>


<?

  }
}

?>



         <div class="line"></div>
        <div class="block">
        <div class="left mr8">
            <img src="/images/job/3.jpg" width="150" height="75" alt="">        </div>
        <div class="blue bold">Лесоповал</div>  
<?
if($farm['h3'] <= 0) {
if($user['vip'] == 0){ 
$guy=($farm['lvl3'] * 3);
}else{$guy=($farm['lvl3'] * 3)*2;}
?>
<img src="/images/icons/reward.png" width="16" height="16" alt=""> Доход/час:     <img src="/images/icons/gold.png" width="16" height="16" alt="">  <?=$guy?>                  



<?
}

  if($farm['h3'] == 0 && $farm['time3'] == 0) {
  
  $h3 = _string(_num($_POST['h3']));
  
    if($h3 && $user['level'] >= $h3 * 1) {
    
      $hsid = ($h3 * (60 * 60));
            
  if($h3) {
     mysql_query('UPDATE `farm_logs` SET `h3` = "'.$h3.'" WHERE `user` = "'.$user['id'].'"');
  }

      mysql_query('UPDATE `farm` SET `h3` = "'.$h3.'", `time3` = "'.(time() + $hsid).'" WHERE `user` = "'.$user['id'].'"');
    
    header('location: /job');
    
    }

?>


<div class="form-group field-jobworkform-hour_id required">

<form action='/job' method='post'>
  <select name='h3'>

<?

   for($h3 = 1; $h3 < 9; $h3++) {

if($user['level'] >= $h3 * 1) {

?>

<option value='<?=$h3?>'><?=$h3?> час(ов)<?=($h3 == 1 ? '':($h3 == 9 ? '':''))?></option>

<?

    }

  }

?>

  </select>
<div class="help-block"></div>
</div>            <span class="m3 btn_start middle"><span class="btn_end">
                    <button type="submit" class="btn">Работать</button></span>
            </span>
</form>
</div>
<?

  }
  else
  {


if($farm['time3'] > time()) {

  if(isset($_GET['endi'])) {
    mysql_query('UPDATE `farm` SET `h3` = "0", 
                                `time3` = "0" WHERE `user` = "'.$user['id'].'"');
    header('location: /job');
  }
  

if($user['vip'] == 0){ 
$guy=($farmy['h3'] * $farm['lvl3'] * 3);
}else{$guy=($farmy['h3'] * $farm['lvl3'] * 3)*2;}
?>
 </div>

       <img src="/images/icons/reward.png" width="16" height="16" alt="">                    Доход:     <img src="/images/icons/gold.png" width="16" height="16" alt="">    <?=$guy?>            <div>
    <img src="/images/icons/date.png" width="16" height="16" alt=""> <?=_time($farm['time3'] - time())?><br/>

  <span class="m3 btn_start middle">
<span class="btn_end"><a href='/job/?endi=<?=$randp = rand(222,999)?>' class='btn'>Отменить</a>
</span>
</span>
</br>


<?

  }
  else
  {

if($user['vip'] == 0){ 
$guy=($farmy['h3'] * $farm['lvl3'] * 3);
}else{$guy=($farmy['h3'] * $farm['lvl3'] * 3)*2;}
  if(isset($_GET['zavr3'])) {
     mysql_query('UPDATE `users` SET `g` = `g` + '.$guy.' WHERE `id` = "'.$user['id'].'"');  
      mysql_query('UPDATE `farm` SET `h3` = "0",
                                  `time3` = "0" WHERE `user` = "'.$user['id'].'"');

$_SESSION['not']='<div class="alert"><div>                                     <div class="blue"><img src="/images/icons/reward.png" width="16" height="16" alt=""> Прибыль:</div>
    <img src="/images/icons/gold.png" width="16" height="16" alt=""> Сахар:+ '.$guy.'</div></div><div class="alert_bottom"></div>';
   header('location: /job/?'.$udet.'');
}
    
?>


        <div>

        <img src="/images/icons/reward.png" width="16" height="16" alt="">                    Доход:     <img src="/images/icons/gold.png" width="16" height="16" alt="">    <?=$guy?>              </div>


</div>
                        <div class="clear"></div>
                <div class="dotted"></div>
        <div class="block center">
  <span class="m3 btn_start middle"><span class="btn_end"><a class="btn" href="/job/?zavr3=<?=$randp = rand(222,999)?>">Завершить работу</a></span> </span> </div>

      
<?

  }

  }

?>
<?
if($farm['h3'] <= 0) {
?>
<?
     $lvl3 = 10 + ($farm['lvl3'] * 180);

    $lvl_3 = 4 + ($farm['lvl3'] * 13)*2;
  if($farm['lvl3'] < 14) {

  if(isset($_GET['pro3'])) {
  
    if($farm['lvl3'] >= 14) {


  
}else{
if($user['s']>=$lvl3&&$user['g']>=$lvl_3)
{
      mysql_query('UPDATE `farm` SET `lvl3` = `lvl3` + 1 WHERE `user` = "'.$user['id'].'"');
    mysql_query('UPDATE `users` SET `s` = "'.($user['s']-$lvl3).'", `g` = "'.($user['g']-$lvl_3).'" WHERE `id` = "'.$user['id'].'"');
    
    header('location: /job/');
    
    }
  
}
  }

  
?>
      <div class="dotted"></div>
      <div class="block center">
                        <span class="btn_start"><span class="btn_end"><a class="btn" href="/job/?pro3=<?=$randp = rand(222,999)?>">Прокачать за     <img src="/images/icons/silver.png" width="16" height="16" alt="">  <?=$lvl3?>    <img src="/images/icons/gold.png" width="16" height="16" alt="">  <?=$lvl_3?></a></span> </span>  </div>


<?

  }

}
?>


         <div class="line"></div>
<ul class="block small">
   <li class="color2">Чем выше ваш уровень, тем выше время работы </li>
    <li class="color2">Повышение мастерства позволит вам получать больше дохода</li>
</ul></div>
<?

  
include './system/f.php';

?>