<?
    
    include './system/common.php';
    
 include './system/functions.php';
        
      include './system/user.php';
    
if(!$user) {

  header('location: /');
    
exit;

}

$id = _string(_num($_GET['id']));
  if($id && $id != $user['id']) {
    $i = mysql_query('SELECT * FROM `users` WHERE `id` = "'.$id.'"');
    $i = mysql_fetch_array($i);
    if(!$i) {    
      header('location: /user/');
    exit; 
    }
    $title = $i['login'];
    }
    else
    {
        $i = $user;
    $title = $i['login'];
    }
    

include './system/h.php';  


?>


                           
    <div class="content"><div class="block center color3 s125"><a href="/user/<?=$i['id']?>"> <?=$i['login']?> </a>/ Снаряжение</div>
            <div class="line"></div>
                        

                        

<?

    for($w = 1; $w < 9; $w++) {
      
    switch($w) {
      case 1:
      $w_name = '<div class="block">
        <img class="left mr8" src="/images/items/0.jpg" width="50" height="50" alt="">        Голова        <div class="clear"></div>
    </div><div class="dotted"></div>';
      break;
      case 2:
      $w_name = '<div class="block">
        <img class="left mr8" src="/images/items/0.jpg" width="50" height="50" alt="">        Глаза        <div class="clear"></div>
    </div><div class="dotted"></div>';
      break;
      case 3:
      $w_name = '<div class="block">
        <img class="left mr8" src="/images/items/0.jpg" width="50" height="50" alt="">        Шея        <div class="clear"></div>
    </div><div class="dotted"></div>';
      break;
      case 4:
      $w_name = '<div class="block">
        <img class="left mr8" src="/images/items/0.jpg" width="50" height="50" alt="">        Торс        <div class="clear"></div>
    </div><div class="dotted"></div>';
      break;
      case 5:
      $w_name = '<div class="block">
        <img class="left mr8" src="/images/items/0.jpg" width="50" height="50" alt="">        Левая рука        <div class="clear"></div>
    </div><div class="dotted"></div>';
      break;
      case 6:
      $w_name = '<div class="block">
        <img class="left mr8" src="/images/items/0.jpg" width="50" height="50" alt="">        Правая рука        <div class="clear"></div>
    </div><div class="dotted"></div>';
      break;
      case 7:
      $w_name = '<div class="block">
        <img class="left mr8" src="/images/items/0.jpg" width="50" height="50" alt="">        Ноги        <div class="clear"></div>
    </div><div class="dotted"></div>';
      break;
      case 8:
      $w_name = '<div class="block">
        <img class="left mr8" src="/images/items/0.jpg" width="50" height="50" alt="">        Стопы        <div class="clear"></div>
    </div><div class="dotted"></div>';
      break;
    }

?>

<div class='content'>
<table cellpadding='0' cellspacing='0'>
<tr>
  
<?

        if($i['w_'.$w]) {
        
    $inv = mysql_query('SELECT * FROM `inv` WHERE `id` = "'.$i['w_'.$w].'"');      
    $inv = mysql_fetch_array($inv);

        $item = mysql_query('SELECT * FROM `items` WHERE `id` = "'.$inv['item'].'"');
        $item = mysql_fetch_array($item);

  switch($item['quality']) {
    case 0:
  $bonus = 0;
      $quality = 'Простой';
$quality_color = "#986";
     break;
    case 1:
  $bonus = 5;
      $quality = 'Обычный';
$quality_color = "#6c3";
     break;

    case 2:
 $bonus = 10;
      $quality = 'Редкий';
$quality_color = "#69c";
     break;

    case 3:
 $bonus = 15;
 
      $quality = 'Эпический';
$quality_color = "#c6f";
     break;

    case 4:
 $bonus = 20;
 
      $quality = 'Легенарный';
$quality_color = "#f60";
     break;


    case 5:
 $bonus = 50;
      $quality = 'Божественный';
$quality_color = "#999";
     break;


    case 6:
 $bonus = 65; 
      $quality = 'Сверх Божественный';
$quality_color = "#999";
     break;

  }  



$itemquality = array('Старый', 'Обычный', 'Редкий', 'Очень редки', 'Великолепное', 'Легендарный', 'Божественный', 'Сверх-Божественный');



  $quality_col = array('', '#9B9B9B', '#F6FF73', '#FF9F20', '#FF7032', '#7BFF6C', '#6CABFF', '#FF2222', '#FF1B6E','#D822FF');


$qul = array('', ' ', ' ', ' ', ' ', ' ', '', ' ', '',''.$i['login'].'');
?>


<div class="block">
            <a href="/item/<?=$inv['id']?>/"><img class="left mr8" src="/images/items/<?=$item['id']?>.jpg" alt=""></a>

            <img src="/images/icons/equip.png" width="16" height="16" alt=""> <a href="#"><font color="<?=$quality_col[$item['quality']]?>"> <?=$item['name']?> <?=$qul[$item['quality']]?></font></a>
        <span class="white">
    
    <img src="/images/icons/level.png" width="16" height="16" alt=""> <?=$item['lvl']?> ур.    </span>



<div>
    <span class="color2">
    <img src="/images/icons/health.png" width="16" height="16" alt=""> <?=$inv['vit_']?></span>
<?
  if($inv['rune']) {
  
    switch($inv['rune']) {
      case 1:
      $rune_stats = 400; 
       break;
      case 2:
      $rune_stats = 1650; 
       break;
      case 3:
      $rune_stats = 5400; 
       break;
      case 4:
      $rune_stats = 11500; 
       break;
      case 5:
      $rune_stats = 14800; 
       break;
      case 6:
      $rune_stats = 18700; 
       break;
      case 7:
      $rune_stats = 22800; 
       break;
      case 8:
      $rune_stats = 31000; 
       break;
      case 9:
      $rune_stats = 62000; 
       break;

    }

?>

                   <sup class="blue">+<?=$rune_stats?>
</sup>

<?
}
?>
            <span class="color2">
    <img src="/images/icons/damage.png" width="16" height="16" alt="">  <?=$inv['str_']?></span>
 <?
  if($inv['rune']) {
  
    switch($inv['rune']) {
      case 1:
      $rune_stats = 400; 
       break;
      case 2:
      $rune_stats = 1650; 
       break;
      case 3:
      $rune_stats = 5400; 
       break;
      case 4:
      $rune_stats = 11500; 
       break;
      case 5:
      $rune_stats = 14800; 
       break;
      case 6:
      $rune_stats = 18700; 
       break;
      case 7:
      $rune_stats = 22800; 
       break;
      case 8:
      $rune_stats = 31000; 
       break;
      case 9:
      $rune_stats = 62000; 
       break;

    }

?>

                   <sup class="blue">+<?=$rune_stats?>
</sup>

<?
}
?>

            <span class="color2">
    <img src="/images/icons/armor.png" width="16" height="16" alt="">  <?=$inv['def_']?></span>
  <?
  if($inv['rune']) {
  
    switch($inv['rune']) {
      case 1:
      $rune_stats = 400; 
       break;
      case 2:
      $rune_stats = 1650; 
       break;
      case 3:
      $rune_stats = 5400; 
       break;
      case 4:
      $rune_stats = 11500; 
       break;
      case 5:
      $rune_stats = 14800; 
       break;
      case 6:
      $rune_stats = 18700; 
       break;
      case 7:
      $rune_stats = 22800; 
       break;
      case 8:
      $rune_stats = 31000; 
       break;
      case 9:
      $rune_stats = 62000; 
       break;

    }

?>

                   <sup class="blue">+<?=$rune_stats?>
</sup>

<?
}

 if($i['id'] == $user['id']) {
if($inv['run'] <= 0) {
?>
            <a href="/smith/item/<?=$inv['id']?>/">[улучшить]</a> 
<?
}
}
?>
   <br/>
<?

$itemqualit = array('Старое качество', 'Обычное качество', 'Редкое качество', 'Очень редкое качество', 'Великолепное качество', 'Легендарное качество', 'Божественное качество', 'Сверх-Божественное качество','Эксклюзивное качество');
  $quality_cool = array('#9B9B9B', '#F6FF73', '#FF9F20', '#FF7032', '#7BFF6C', '#6CABFF', '#FF2222', '#FF1B6E','#D822FF');
 if($i['id'] == $user['id']) {
?>

<?

}else {
?>     
  <?

}

if($user['id'] == $i['id']) {
?>
       
 <img src="/images/icons/stripe.png" width="16" height="16" alt="">                                    <a href="/smith/po/<?=$inv['id']?>/"><font color="<?=$quality_cool[$inv['smith']]?>"> <?=$itemqualit[$inv['smith']]?></font></a>
<?
}else {
?>     
  
 <img src="/images/icons/stripe.png" width="16" height="16" alt="">                                    <font color="<?=$quality_cool[$inv['smith']]?>"> <?=$itemqualit[$inv['smith']]?></font>
   
<?
}
?>
</div></div>                
<?
if($user['id'] == $i['id']) {
?>
<div class="dotted"></div>
    <div class="block center">     
   <span class="btn_start"><span class="btn_end"><a class="btn" href="/inv/move/0/<?=$inv['id']?>/">Снять вещь</a></span> </span>  

 </div>

<?
}
?>
     
        <div class="dotted"></div>
<?
    if($user['w_'.$item['w']] != 0) {
      
      $equip_item = mysql_query('SELECT * FROM `inv` WHERE `id` = "'.$user['w_'.$item['w']].'"');
      $equip_item = mysql_fetch_array($equip_item);        
    
      if(($inv['_str']+$inv['_vit']+$inv['_agi']+$inv['_def']) - ($equip_item['_str']+$equip_item['_vit']+$equip_item['_agi']+$equip_item['_def']) > 0) {
    
?>

<?

      }

  
    }
    else
    {

?>
<?

    }



?>


  </small></small>
  </td>

<?

  }
  else
  {
        
?>
 <?=$w_name?>
<?
        
  }

?>

</div>
<?
    if($i < 8) {
?>
<div class='line'></div>
<?
    }

  }
  
include './system/f.php';

?>