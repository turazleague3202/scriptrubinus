<?

    
    include './system/common.php';
    
 include './system/functions.php';
        
      include './system/user.php';    
if(!$user) {

  header('location: /');
    
exit;

}

$place = _string(_num($_GET['place']));

switch($place) {

  default: case 0:

  $title = 'Тумбочка';

  break;

  case 1:

if($user['chest'] == 0) {

mysql_query('UPDATE `users` SET `chest` ="1" WHERE `id` = "'.$user['id'].'"');
    header('location: /inv/bag/');

    exit;

  }
  $title = 'Тумбочка';

  break;

}

include './system/h.php';

$wear = _string(_num($_GET['wear']));

if($wear) {
	
	$inv = mysql_fetch_array(mysql_query('SELECT * FROM `inv` WHERE `id` = "'.$wear.'" AND `equip` = "0" AND `user` = "'.$user['id'].'"'));
	    
	    if($inv) {
		
		$item = mysql_fetch_array(mysql_query('SELECT * FROM `items` WHERE `id` = "'.$inv['item'].'"'));
		
		if($user['level'] < $item['lvl']) exit(header('location: /inv/'.($inv['place'] == 0 ? 'bag':'chest').'/'));
		
		if($user['w_'.$item['w']]) {
			
			$_inv = mysql_fetch_array(mysql_query('SELECT * FROM `inv` WHERE `id` = "'.$user['w_'.$item['w']].'" AND `user` = "'.$user['id'].'"'));
			$_item = mysql_fetch_array(mysql_query('SELECT * FROM `items` WHERE `id` = "'.$_inv['item'].'"'));
			
			mysql_query('UPDATE `users` SET `str` = `str` - '.$_inv['_str'].', `vit` = `vit` - '.$_inv['_vit'].', `def` = `def` - '.$_inv['_def'].', `w_'.$_item['w'].'` = "0" WHERE `id` = \''.$user['id'].'\'');
			
			mysql_query('UPDATE `inv` SET `equip` = "0" WHERE `id` = "'.$_inv['id'].'"');
			
			exit(header('location: /inv/wear/'.$wear.'/'));
			
		}
		
		if(!$user['w_'.$item['w']]) {
			
	     mysql_query('UPDATE `users` SET `str` = `str` + '.$inv['_str'].', `vit` = `vit` + '.$inv['_vit'].', `def` = `def` + '.$inv['_def'].', `w_'.$item['w'].'` = \''.$inv['id'].'\' WHERE `id` = \''.$user['id'].'\'');
		 
		 mysql_query('UPDATE `inv` SET `equip` = "1" WHERE `id` = "'.$inv['id'].'"');
			
			exit(header('location: /inv/'.($inv['place'] == 0 ? 'bag':'chest').'/'));
}}}


$unwear = _string(_num($_GET['unwear']));

if($unwear) {

  $query = mysql_query('SELECT * FROM `inv` WHERE `id` = \''.$unwear.'\' AND `user` = \''.$user['id'].'\'');
    $inv = mysql_fetch_array($query);

  if($inv) {
    
    $query = mysql_query('SELECT * FROM `items` WHERE `id` = \''.$inv['item'].'\'');
     $item = mysql_fetch_array($query);

    if($user['w_'.$item['w']] && $user['w_'.$item['w']] == $inv['id']) {
    
      if(mysql_result(mysql_query('SELECT COUNT(*) FROM `inv` WHERE `place` = \''.$place.'\' AND `user` = \''.$user['id'].'\' AND `equip` = \'0\''),0) + 1 > 50) $errors[] = 'Ошибка, Тумбочка заполнена';



if($errors) {
foreach($errors as $error) {
echo '<div class="alert">';
echo $error;
echo '</div><div class="alert_bottom"></div>';
}
}else{
      mysql_query('UPDATE `users` SET `str` = `str` - '.$inv['_str'].',
                                      
                                      `vit` = `vit` - '.$inv['_vit'].',
                                      
                                      `def` = `def` - '.$inv['_def'].',
                                      
                         `w_'.$item['w'].'` = \'0\' WHERE `id` = \''.$user['id'].'\'');

      if($place == 1 && $user['chest'] == 0) $place = 0;
    
      mysql_query('UPDATE `inv` SET `equip` = \'0\',
      
                                    `place` = \''.$place.'\' WHERE `id` = \''.$inv['id'].'\'');


      header('location: /equip/');
    
      }
    
    }
    else
    {

      if($place == 1 && $user['chest'] == 0) $place = 0;
    
      mysql_query('UPDATE `inv` SET `place` = \''.$place.'\' WHERE `id` = \''.$inv['id'].'\'');

      header('location: /inv/'.($place == 0 ? 'bag':'chest').'/');
    
    }
        
  }       

}

$fyl=mysql_result(mysql_query('SELECT COUNT(`id`) FROM `inv` WHERE `user` = "'.$user['id'].'" AND `equip` = "0" AND `place` = "0"'),0);
$cena1 = $fyl*400; 
if(isset($_GET['shop'])) 
{ 




 $s1 = mysql_query('SELECT * FROM `inv` WHERE `quality` = \'1\' AND `equip` = \'0\' AND `user` = \''.$user['id'].'\'');
$s10 = mysql_query('SELECT * FROM `inv` WHERE `quality` = \'2\' AND `equip` = \'0\' AND `user` = \''.$user['id'].'\'');
$s20 = mysql_query('SELECT * FROM `inv` WHERE `quality` = \'3\' AND `equip` = \'0\' AND `user` = \''.$user['id'].'\'');
$s30 = mysql_query('SELECT * FROM `inv` WHERE `quality` = \'4\' AND `equip` = \'0\' AND `user` = \''.$user['id'].'\'');
$s40 = mysql_query('SELECT * FROM `inv` WHERE `quality` = \'5\' AND `equip` = \'0\' AND `user` = \''.$user['id'].'\'');


$shop = $s1+$s10+$s20+$s30+$s40; 
if($shop == 1) 
{ 
header('Location: /inv/bag/'); 
exit(); 
} 

if(mysql_result(mysql_query('SELECT COUNT(*) FROM `inv` WHERE `place` = \''.$place.'\' AND `user` = \''.$user['id'].'\' AND `equip` = \'0\''),0)<0) $errors[] = 'Ошибка, Тумбочка пустая ';
if(mysql_result(mysql_query('SELECT COUNT(*) FROM `inv` WHERE `place` = \''.$place.'\' AND `user` = \''.$user['id'].'\' AND `equip` = \'0\' AND `quality` < \'6\''),0)<1) $errors[] = 'Ошибка,';
if($errors) {
foreach($errors as $error) {
echo '<div class="alert">';
echo $error;
echo '</div><div class="alert_bottom"></div>';
}
}else{
mysql_query('UPDATE `users` SET `s` = "'.($user['s'] + $cena1).'" WHERE `id` = "'.$user['id'].'"');


mysql_query('DELETE FROM `inv` WHERE  `quality` = \'1\' AND `equip` = \'0\' AND `user` = \''.$user['id'].'\' AND `place` = "0"');
mysql_query('DELETE FROM `inv` WHERE  `quality` = \'2\' AND `equip` = \'0\' AND `user` = \''.$user['id'].'\' AND `place` = "0"');
mysql_query('DELETE FROM `inv` WHERE  `quality` = \'3\' AND `equip` = \'0\' AND `user` = \''.$user['id'].'\' AND `place` = "0"');
mysql_query('DELETE FROM `inv` WHERE  `quality` = \'4\' AND `equip` = \'0\' AND `user` = \''.$user['id'].'\' AND `place` = "0"');
mysql_query('DELETE FROM `inv` WHERE  `quality` = \'5\' AND `equip` = \'0\' AND `user` = \''.$user['id'].'\' AND `place` = "0"');
mysql_query('DELETE FROM `inv` WHERE  `quality` = \'6\' AND `equip` = \'0\' AND `user` = \''.$user['id'].'\' AND `place` = "0"');

$_SESSION['not'] = ' <div class="alert"> Продано вещей <img src="/images/icons/silver.png" width="16" height="16" alt=""> '.$cena1.' рублей</div><div class="alert_bottom"></div>'; 
header('Location: /inv/bag/'); 
exit(); 

}
} 


    
$sell = _string(_num($_GET['sell']));
    
if($sell) {


  $query = mysql_query('SELECT * FROM `inv` WHERE `id` = \''.$sell.'\' AND `equip` = \'0\' AND `user` = \''.$user['id'].'\'');
    $inv = mysql_fetch_array($query);
  
  if($inv) {
          
    $_sell = array(100, 1000, 2500, 5000, 10000, 25000, 50000, 50000, 400000);
  
    mysql_query('UPDATE `users` SET `s` = `s` + 800 WHERE `id` = \''.$user['id'].'\'');

    mysql_query('DELETE FROM `inv` WHERE `id` = \''.$inv['id'].'\'');

    header('location: /inv/'.($place == 0 ? 'bag':'chest').'/');

  }

}

$by = _string(_num($_GET['by']));
    
if($by) {


  $query = mysql_query('SELECT * FROM `inv` WHERE `id` = \''.$by.'\' AND `equip` = \'0\' AND `user` = \''.$user['id'].'\'');
    $inv = mysql_fetch_array($query);

$itemshop = mysql_fetch_array(mysql_query('SELECT * FROM `shop` WHERE `id` = \''.$inv['item'].'\''));
 
  $item = mysql_fetch_array(mysql_query('SELECT * FROM `items` WHERE `id` = \''.$inv['item'].'\''));
if(isset($_GET['by'])){echo ' <div class="content">
<div class="menu">        <li><a href="?sell='.$inv['id'].'"><img src="/images/icons/ok.png" width="16" height="16" alt=""> Да,
    подтверждаю!</a></li><li><a href="/"><img src="/images/icons/cross.png" width="16" height="16" alt=""> Нет, отказываюсь!</a></li></div></div><div class="line"></div>
';
include './system/f.php';
exit();
}
}

if($place == 0) {

  if($user['chest'] == 0) {

    if($_GET['buy_chest'] == true) {
  
      if($user['g'] < $config['chest']) $errors[] = 'Ошибка, нехватает <img src=\'/images/icon/g.png\'> '.($config['chest'] - $user['g']).' золота';
if($errors) {
foreach($errors as $error) {
echo '<div class="alert">';
echo $error;
echo '</div><div class="alert_bottom"></div>';
}
}else{
          mysql_query('UPDATE `users` SET `g` = `g` - 100,
          
                                         `chest` = \'1\' WHERE `id` = \''.$user['id'].'\'');
  
          header('location: /inv/chest/');
      
        }
  
    }

  }

}

if(isset($_GET['shopy'])) {
echo '    <div class="content"><div class="block center color3 s125"> Продать все вещи</div>
            <div class="line"></div>
<div class="dotted"></div>
<div class="menu"><li><a href="?shop"><img src="/images/icons/ok.png" width="16" height="16" alt=""> Да, я подтверждаю!</a></li><li><a href="/inv/bag/"><img src="/images/icons/cross.png" width="16" height="16" alt=""> Нет!</a></li></div></div>
';
include './system/f.php';
exit();
}

echo '    <div class="content"><div class="block center color3 s125"><a href="/user/'.$user['id'].'/?'.$udet.'">'.$user['login'].'</a>/
    '.($place == 0 ? 'Тумбочка':'Сундук').'</div>
<div class="line"></div>';


if(mysql_result(mysql_query('SELECT COUNT(*) FROM `inv` WHERE `user` = \''.$user['id'].'\' AND `equip` = \'0\' AND `place` = \''.$place.'\''),0) > 0) {

  $i = 0;
  
  $q = mysql_query('SELECT * FROM `inv` WHERE `user` = \''.$user['id'].'\' AND `equip` = \'0\' AND `place` = \''.$place.'\' ORDER BY `id` DESC');
  while($row = mysql_fetch_array($q)) {  
  
    $i++;

  
    $item        = mysql_fetch_array(mysql_query('SELECT * FROM `items` WHERE `id` = \''.$row['item'].'\''));


    switch($row['quality']) {
      case 1:
      $quality = 'Старый';
  $quality_col = '#9B9B9B';
       break;

      case 2:
      $quality = 'Обычный';
  $quality_col = '#F6FF73';
       break;

      case 3:
      $quality = 'Редки';
  $quality_col = '#FF9F20';
       break;

      case 4:
      $quality = 'Очень редкое';
  $quality_col = '#FF7032';
       break;

      case 5:
      $quality = 'Великолепное';
  $quality_col = '#7BFF6C';
       break;

      case 6:
      $quality = 'Легендарный';
  $quality_col = '#6CABFF';
       break;

      case 7:
      $quality = 'Божественный';
  $quality_col = '#FF2222';
       break;

      case 8:
      $quality = 'Сверх-Божественный';
  $quality_col = '#FF1B6E';
       break;

    }
    
    if($row['new'] == 0) {
  
      mysql_query('UPDATE `inv` SET `new` = \'1\' WHERE `id` = \''.$row['id'].'\'');
  
    }
      

 $quality_col = array('', '#9B9B9B', '#F6FF73', '#FF9F20', '#FF7032', '#7BFF6C', '#6CABFF', '#FF2222', '#FF1B6E','#D822FF');

echo '<div class="block">
            <a href="#"><img class="left mr8" src="/images/items/'.$item['id'].'.jpg" alt=""></a>

            <img src="/images/icons/equip.png" width="16" height="16" alt=""> <a href="#"><font color=\''.$quality_col[$row['quality']].'\'>'.$item['name'].'  </font></a>
        <span class="white">
    
    <img src="/images/icons/level.png" width="16" height="16" alt=""> '.$item['lvl'].'  ур.    </span>';

  
    if($user['w_'.$item['w']]) {
      
      $equipitem = mysql_fetch_array(mysql_query('SELECT * FROM `inv` WHERE `id` = \''.$user['w_'.$item['w']].'\''));
      
      if( ( $row['_str'] + $row['_vit'] + $row['_def'] ) - ( $equipitem['_str'] + $equipitem['_vit'] + $equipitem['_def'] ) > 0) echo '<span class="color4 small">+'.(( $row['_str'] + $row['_vit'] + $row['_def'] ) - ( $equipitem['_str'] + $equipitem['_vit'] + $equipitem['_def'] )).'</span>';
   

    }
    else
    {
      
      echo '<span class="color4 small">+'.( $row['_str'] + $row['_vit'] + $row['_def'] ).'</span>';

    }
     
    echo '</div><span class="green">
    <img src="/images/icons/currentHealth.png" width="16" height="16" alt=""> '.$row['vit_'].'</span>';

  if($row['rune']) {
  
    switch($row['rune']) {
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

         echo '<sup class="blue">+'.$rune_stats.'
</sup>
';

}

            echo '<span class="green">
    <img src="/images/icons/damage.png" width="16" height="16" alt=""> '.$row['str_'].'</span>';

  if($row['rune']) {
  
    switch($row['rune']) {
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

         echo '<sup class="blue">+'.$rune_stats.'
</sup>
';

}

           echo '<span class="green">
    <img src="/images/icons/armor.png" width="16" height="16" alt=""> '.$row['def_'].'</span>';

  if($row['rune']) {
  
    switch($row['rune']) {
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

         echo '<sup class="blue">+'.$rune_stats.'
</sup>
';

}

        echo '<div class="clear"></div>';



     echo '<div class="block center">
<div class="dotted"></div>
         <span class="btn_start"><span class="btn_end"><a class="btn" href="/inv/wear/'.$row['id'].'/?'.$udet.'">Надеть шмотку</a></span> </span>       ';

 
if($user['chest']) echo ' <span class="btn_start"><span class="btn_end"><a href="/inv/move/'.($place == 0 ? 1:0).'/'.$row['id'].'/" class="btn">В '.($place == 0 ? 'Сундук':'Тумбучку').'</a></span> </span></div>
';


if($place == 0){
    if($user['w_'.$item['w']] != $inv['id']) {

      switch($item['quality']) {
        case 1:
       $_s = 100;
       $_g = 0;
        break;
        case 2:
       $_s = 1000;
       $_g = 0;
        break;
        case 3:
       $_s = 2500;
       $_g = 0;
        break;
        case 4:
       $_s = 5000;
       $_g = 0;
        break;
        case 5:
       $_s = 10000;
       $_g = 0;
        break;
        case 6:
       $_s = 25000;
       $_g = 0;
        break;
        case 7:
       $_s = 50000;
       $_g = 0;
        break;
        case 8:
       $_s = 50000;
       $_g = 0;
        break;
        case 9:
$_s=400000;
       $_g = 0;
        break;
      }



   echo '<div class="dotted"></div>
    <div class="block center">                    <span class="btn_start"><span class="btn_end"><a class="btn" href="/inv/'.($inv['place'] == 0 ? 'bag':'chest').'/?by='.$row['id'].'/?'.$udet.'">Продать за  <img src="/images/icons/silver.png" alt=""/> 800</a></span> </span>        </div><div class="dotted"></div> </div>  ';


    }

}



    if($i < mysql_result(mysql_query('SELECT COUNT(*) FROM `inv` WHERE `user` = \''.$user['id'].'\' AND `equip` = \'0\' AND `place` = \''.$place.'\''),0));


  }



if($place == 0){echo '<div class="content"><div class="dotted"></div>
        <ul class="block">
    <li>Вмещаемость тумбочки: 60 </li>
</ul><div class="dotted"></div>
<div class="menu"><li><a href="/inv/chest/"><img src="/images/icons/chest.png" width="16" height="16" alt=""> Показать сундуки</a></li>
<li><a href="/inv/bag/?shopy"><img src="/images/icons/chest.png" width="16" height="16" alt=""> Продать вещи  <img src="/images/icons/silver.png" width="16" height="16" alt=""> '.$cena1.' </a></li>
</div></div>';}
}
else
{


echo '<div class="dotted"></div>';
 echo '<div class="block">'.($place == 0 ? 'Тумбочка пуста':'Тут пусто').'</div>';
 

if($place == 0){echo '<div class="dotted"></div>
        <ul class="block">
    <li>Вмещаемость тумбочки: 50 </li>
</ul><div class="dotted"></div>
<div class="menu"><li><a href="/inv/chest/?'.$udet.'"><img src="/images/icons/chest.png" width="16" height="16" alt=""> Показать сундуки</a></li></div></div>';}
}
  
include './system/f.php';

?>