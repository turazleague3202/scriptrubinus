<?
    include './system/common.php';
    
 include './system/functions.php';
         
      include './system/user.php';
    
if(!$user) {

  header('location: /');
  exit;

}

      $id = _string(_num($_GET['id']));
$complect = mysql_fetch_array(mysql_query('SELECT * FROM `complects` WHERE `id` = \''.$id.'\''));
 
  if(!$complect) {

    header('location: /');
    exit;

  }
    

$title = $complect['name'];

include './system/h.php';


 $ac = mysql_query('SELECT * FROM `agame` WHERE `id` = "1"');
  $ac = mysql_fetch_array($ac);

$buy = _string(_num($_GET['buy']));
if($buy) {


  $itemshop = mysql_fetch_array(mysql_query('SELECT * FROM `shop` WHERE `id` = \''.$buy.'\''));
  
  if(mysql_result(mysql_query('SELECT COUNT(*) FROM `inv` WHERE `place` = \'0\' AND `user` = \''.$user['id'].'\' AND `equip` = \'0\''),0) + 1 > 50) $errors[] = 'Ошибка, ваша тумбочка заполнена';

  $item = mysql_fetch_array(mysql_query('SELECT * FROM `items` WHERE `id` = \''.$buy.'\''));

    if($user['level'] >= $item['lvl']) {
}else{

header('location: ?'.$udet.'');
    exit;
}

if($ac['sh'] <= 0){
  if($itemshop['cost'] > $user['s']) $errors[] = 'Ошибка, нехватает <img src=\'/images/icons/silver.png\' alt=\'\'/> '.($itemshop['cost'] - $user['s']).'';  
if($itemshop['cost2'] > $user['g']) $errors[] = 'Ошибка, нехватает <img src=\'/images/icons/gold.png\' alt=\'\'/> '.($itemshop['cost2'] - $user['g']).'';  

}
else
{
if($itemshop['cost3'] > $user['s']) $errors[] = 'Ошибка, нехватает <img src=\'/images/icons/silver.png\' alt=\'\'/> '.($itemshop['cost3'] - $user['s']).'';  
if($itemshop['cost4'] > $user['g']) $errors[] = 'Ошибка, нехватает <img src=\'/images/icons/gold.png\' alt=\'\'/> '.($itemshop['cost4'] - $user['g']).'';  
  
}
if($itemshop['id'] < $buy) $errors[] = 'Ошибка ';  
  if($errors) {
   
        foreach($errors as $error) {
 

echo '<div class="alert">';
          echo $error;
echo '</div><div class="alert_bottom"></div>';
          
        }
      
  }
  else
  {

if($ac['sh'] <= 0){
    mysql_query('UPDATE `users` SET `s` = `s` - '.$itemshop['cost'].', `g` = `g` - '.$itemshop['cost2'].' WHERE `id` = \''.$user['id'].'\'');
$texy="купил шмотку $item[name] <img src=/images/icons/silver.png width=16 height=16 alt=> $itemshop[cost] <img src=/images/icons/gold.png width=16 height=16 alt=> $itemshop[cost2] ";
mysql_query('INSERT INTO `golds` SET `user` = "'.$user['id'].'",`time` = "'.time().'",`text` = "'.$texy.'",`loc`="3"');
}
else
{
mysql_query('UPDATE `users` SET `s` = `s` - '.$itemshop['cost3'].', `g` = `g` - '.$itemshop['cost4'].' WHERE `id` = \''.$user['id'].'\'');
$texy="купил шмотку $item[name] <img src=/images/icons/silver.png width=16 height=16 alt=> $itemshop[cost3] <img src=/images/icons/gold.png width=16 height=16 alt=> $itemshop[cost4] ";
mysql_query('INSERT INTO `golds` SET `user` = "'.$user['id'].'",`time` = "'.time().'",`text` = "'.$texy.'",`loc`="3"');
}
  




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
                                                \''.$itemshop['id'].'\',
                                           \''.$itemshop['quality'].'\',
                                             \'1\',
                                              \''.$itemshop['_str'].'\',
                                              \''.$itemshop['_vit'].'\',
                                              \''.$itemshop['_def'].'\',
                                                                  \'0\', 
                                              \''.$itemshop['_str'].'\',
                                              \''.$itemshop['_vit'].'\',
                                              \''.$itemshop['_def'].'\')');



$_SESSION['not'] = ' <div class="alert"><div><div class="color3 s125">Новая шмотка</div>
<div class="a_separator"></div>
    <div class="inline-block">
<div class="block">
            <a href="#"><img class="left mr8" src="/images/items/'.$itemshop['id'].'.jpg" alt=""></a>

            <img src="/images/icons/equip.png" width="16" height="16" alt=""> <a class="color-quality'.$itemshop['quality'].'" href="#"><span class="color-quality'.$itemshop['quality'].'"> '.$item['name'].'</span></a>

        <span class="white">
    
    <img src="/images/icons/level.png" width="16" height="16" alt=""> '.$item['lvl'].' ур.    </span>

      

<div>

    <span class="green">
    <img src="/images/icons/health.png" width="16" height="16" alt=""> '.$itemshop['_vit'].'</span>
            <span class="green">
    <img src="/images/icons/damage.png" width="16" height="16" alt=""> '.$itemshop['_str'].'</span>
            <span class="green">
    <img src="/images/icons/armor.png" width="16" height="16" alt=""> '.$itemshop['_def'].'</span>
        <div class="clear"></div>
</div></div>    <div class="dotted"></div>
</div>
<div class="a_separator"></div>
<span class="btn_start"><span class="btn_end"><a class="btn" href="/inv/bag/">Перейти в тумбочку</a></span> </span></div></div><div class="alert_bottom"></div> ';
    header('location: ?');
  
  }
  
}

$by = _string(_num($_GET['by']));
if($by) {


  $itemshop = mysql_fetch_array(mysql_query('SELECT * FROM `shop` WHERE `id` = \''.$by.'\''));
 
  $item = mysql_fetch_array(mysql_query('SELECT * FROM `items` WHERE `id` = \''.$by.'\''));

if(isset($_GET['by'])){echo ' <div class="content"><div class="block center color3 s125">
    Покупка
</div>
<div class="line"></div>

<div class="block">
            <a href="#"><img class="left mr8" src="/images/items/'.$itemshop['id'].'.jpg" alt=""></a>

            <img src="/images/icons/equip.png" width="16" height="16" alt=""> <a class="color-quality'.$itemshop['quality'].'" href="#"><span class="color-quality'.$itemshop['quality'].'">'.$item['name'].'</span></a>
        <span class="white">
    
    <img src="/images/icons/level.png" width="16" height="16" alt=""> '.$item['lvl'].' ур.    </span>




<div>

    <span class="green">
    <img src="/images/icons/health.png" width="16" height="16" alt=""> '.$itemshop['_vit'].'</span>
            <span class="green">
    <img src="/images/icons/damage.png" width="16" height="16" alt=""> '.$itemshop['_str'].'</span>
            <span class="green">
    <img src="/images/icons/armor.png" width="16" height="16" alt=""> '.$itemshop['_def'].'</span>
        <div class="clear"></div>
</div></div>
<div class="dotted"></div>
<div class="block">';
      if($ac['sh'] <= 0){
  echo'<img src="/images/icons/money.png" width="16" height="16" alt=""> Стоимость:     <img src="/images/icons/silver.png" width="16" height="16" alt=""> '.$itemshop['cost'].'    <img src="/images/icons/gold.png" width="16" height="16" alt=""> '.$itemshop['cost2'].'';
}else{
echo'<img src="/images/icons/money.png" width="16" height="16" alt=""> Стоимость:     <img src="/images/icons/silver.png" width="16" height="16" alt=""> '.$itemshop['cost3'].'    <img src="/images/icons/gold.png" width="16" height="16" alt=""> '.$itemshop['cost4'].'';
}
echo'</div>
<div class="dotted"></div>
<div class="menu">        <li><a href="?buy='.$itemshop['id'].'"><img src="/images/icons/ok.png" width="16" height="16" alt=""> Да,
    подтверждаю!</a></li><li><a href="/"><img src="/images/icons/cross.png" width="16" height="16" alt=""> Нет, отказываюсь!</a></li></div></div><div class="line"></div>
';
}
}

$udet=rand(111111,999999);

$itemquality = array('нет', 'Старый', 'Обычный', 'Редкий', 'Очень редки', 'Великолепное', 'Легендарный', 'Божественный', 'Сверх-Божественный');


echo '   <div class="content"><div class="block center color3 s125"><a href="/outfit/'.$complect['quality'].'/?'.$udet.'">'.$itemquality[$complect['quality']].'</a>/ '.$complect['name'].' </div><div class="line"></div>
<div class="block center">
        <img src="/images/m/'.$complect['avatar'].'.jpg" alt=""></div>
<div class="line"></div>';
    

$cost = 0;

$cost2 = 0;




for($w = 1; $w < 9; $w++) {

  $itemshop = mysql_fetch_array(mysql_query('SELECT * FROM `shop` WHERE `id` = \''.$complect['w_'.$w].'\''));

$cost += $itemshop['cost'];

  $cost2 += $itemshop['cost2'];
}


for($w = 1; $w < 9; $w++) {



  $itemshop = mysql_fetch_array(mysql_query('SELECT * FROM `shop`  WHERE `id` = \''.$complect['w_'.$w].'\''));
  $item = mysql_fetch_array(mysql_query('SELECT * FROM `items` WHERE `id` = \''.$complect['w_'.$w].'\''));

$itemquality = array('Старый', 'Обычный', 'Редкий', 'Очень редки', 'Великолепное', 'Легендарный', 'Божественный', 'Сверх-Божественный');



  $quality_col = array('', '#9B9B9B', '#F6FF73', '#FF9F20', '#FF7032', '#7BFF6C', '#6CABFF', '#FF2222', '#FF1B6E');
  $itembonus   = array(0,5,10,15,20,50,65);


echo '<div class="block">
            <a href="#"><img class="left mr8" src="/images/items/'.$itemshop['id'].'.jpg" alt=""></a>
<img src="/images/icons/equip.png" width="16" height="16" alt=""> <a href="#"><font color=\''.$quality_col[$itemshop['quality']].'\'>'.$item['name'].'</font></a>
        <span class="white">
    <img src="/images/icons/level.png" width="16" height="16" alt=""> '.$item['lvl'].' ур.    </span>';

 
  if($user['w_'.$item['w']]) {

    $equipitem = mysql_fetch_array(mysql_query('SELECT * FROM `inv` WHERE `id` = \''.$user['w_'.$item['w']].'\''));      
    
    if( ($itemshop['_str'] + $itemshop['_vit'] +  $itemshop['_def']) - ($equipitem['_str'] + $equipitem['_vit'] + $equipitem['_def']) > 0) echo '<span class=\'color4 small\'>+'.(($itemshop['_str'] + $itemshop['_vit'] + $itemshop['_def']) - ($equipitem['_str'] + $equipitem['_vit'] + $equipitem['_def'])).'</span>';
    
  }
  else
  {
    
    echo '<span class=\'color4 small\'>+'.($itemshop['_str'] + $itemshop['_vit'] + $itemshop['_def']).'</span>';

  }
  


    echo '</div><span class="green">
    <img src="/images/icons/health.png" width="16" height="16" alt=""> '.$itemshop['_vit'].'</span>
            <span class="green">
    <img src="/images/icons/damage.png" width="16" height="16" alt=""> '.$itemshop['_str'].'</span>
            <span class="green">
    <img src="/images/icons/armor.png" width="16" height="16" alt=""> '.$itemshop['_def'].'</span>
        <div class="clear"></div>
    <div class="dotted"></div>';

$bon = round(30/(70/$itemshop['cost2']));
if($ac['sh'] <= 0){
if($user['level'] >= $item['lvl']){
   echo ' <div class="block center">                    <span class="btn_start"><span class="btn_end"><a class="btn" href="?by='.$itemshop['id'].'/?'.$udet.'">Купить за <img src="/images/icons/silver.png" width="16" height="16" alt=""> '.$itemshop['cost'].' <img src="/images/icons/gold.png" width="16" height="16" alt=""> '.$itemshop['cost2'].'</a></span> </span>        </div>    <div class="dotted"></div>';
}
}else{
if($user['level'] >= $item['lvl']){
   echo ' <div class="block center">                    <span class="btn_start"><span class="btn_end"><a class="btn" href="?by='.$itemshop['id'].'/?'.$udet.'">Купить за <img src="/images/icons/silver.png" width="16" height="16" alt=""> '.$itemshop['cost3'].' <img src="/images/icons/gold.png" width="16" height="16" alt=""> '.$itemshop['cost4'].'</a></span> </span>        </div>    <div class="dotted"></div>';
}
}

}


include './system/f.php';

?>