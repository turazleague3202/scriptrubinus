<?

        /*
		*
		Create file chest_user.php
		Date 15.06.2017 09:16
		Author XxxDIABLOxxX
		*
		*/
          
		 foreach(array('common', 'functions', 'user', 'h') as $list) {
			 $title = 'Мои сундуки';
			 include './system/'.$list.'.php';
		 } 
		 
		 $chest  = mysql_fetch_array(mysql_query('SELECT * FROM `chest_user` WHERE `user` = "'.$user['id'].'"'));
		 
		 if(!$chest) {
			 mysql_query('INSERT INTO `chest_user` SET `user` = "'.$user['id'].'"');
			 exit(header('Location: /chest/user/'));
		 }
		 ?>
		  <div class="content">
		 <?
		 
		 $_chest_setting = array(

            'name' => array(1 => 'обычный', 2 => 'редкий', 3 => 'легендарный', 4 => 'божественный'),
            'cost' => array(1 => 180, 2 => 260, 3 => 350, 4 => 520),
					
'color' => array (1 => '#F6FF73', 2 => '#FF9F20', 3 => '#6CABFF', 4 => '#FF2222'),
		
		 );
		 
		 if(isSet($_GET['open'])) {
			 
			$id = _string(_num($_GET['id']));
			
			if($id <= 0 OR $id > 4) exit(header('Location: /chest/user/'));
			
			if($chest[$id] < 1 OR $user['g'] < $_chest_setting['cost'][$id]) exit(header('Location: /chest/user/'));
			 
			 $_chest_rand = rand(1,5);
			 
			 ?>
			 <div class='block'>
			 <font color='<?=$_chest_setting['color'][$id];?>'><b>Cундук открыт!</b></font>
			 <div class='separator'></div>
			 Награда:
			 <?
			 if($_chest_rand == 1) {
	$_SESSION['not']= '  <div class="alert"><div>                                     <div class="blue"><img src="/images/icons/reward.png" width="16" height="16" alt=""> Сундук открыт:</div>
   Пустой!</div></div><div class="alert_bottom"></div>';
			 }elseif($_chest_rand == 2) {
				 
				 $expChest = rand(300,800) * $id;
				 mysql_query('UPDATE `users` SET `exp` = `exp` + "'.$expChest.'" WHERE `id` = "'.$user['id'].'"');
$_SESSION['not']= '  <div class="alert"><div>                                     <div class="blue"><img src="/images/icons/reward.png" width="16" height="16" alt=""> Сундук открыт:</div>
    <img src="/images/icons/experience.png" width="16" height="16" alt=""> Авторитет:+'.$expChest.'</div></div><div class="alert_bottom"></div>';
			 }elseif($_chest_rand == 3) {
if($id==1){
$goldChest = rand(60, 165);
}
if($id==2){
$goldChest = rand(100, 195);
}
if($id==3){
$goldChest = rand(240, 435);
}
if($id==4){
$goldChest = rand(398, 835);
}
				 mysql_query('UPDATE `users` SET `g` = `g` + "'.$goldChest.'" WHERE `id` = "'.$user['id'].'"');
$_SESSION['not']= '  <div class="alert"><div>                                     <div class="blue"><img src="/images/icons/reward.png" width="16" height="16" alt=""> Сундук открыт:</div>
    <img src="/images/icons/gold.png" width="16" height="16" alt=""> Сахар:+'.$goldChest.'</div></div><div class="alert_bottom"></div>';
}elseif($_chest_rand == 4) {
				 $silverChest = rand(100, 250) * rand($id, $user['level']);
				 mysql_query('UPDATE `users` SET `s` = `s` + "'.$silverChest.'" WHERE `id` = "'.$user['id'].'"');
$_SESSION['not']= '  <div class="alert"><div>                                     <div class="blue"><img src="/images/icons/reward.png" width="16" height="16" alt=""> Сундук открыт:</div>
    <img src="/images/icons/silver.png" width="16" height="16" alt=""> Рубли:+'.$silverChest.'</div></div><div class="alert_bottom"></div>';
			 }elseif($_chest_rand == 5) {
				 
if($id==1){
$w = mysql_fetch_array(mysql_query('SELECT * FROM `shop` WHERE `quality` = \'2\' ORDER BY RAND() LIMIT 1'));

}
if($id==2){
$w = mysql_fetch_array(mysql_query('SELECT * FROM `shop` WHERE `quality` = \'3\' ORDER BY RAND() LIMIT 1'));

}
if($id==3){
$w = mysql_fetch_array(mysql_query('SELECT * FROM `shop` WHERE `quality` = \'6\' ORDER BY RAND() LIMIT 1'));

}
if($id==4){
$w = mysql_fetch_array(mysql_query('SELECT * FROM `shop` WHERE `quality` = \'7\' ORDER BY RAND() LIMIT 1'));

}
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

$_SESSION['not'] = '<div class="alert"><div>
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
					?>
					</div>
					<?
					mysql_query('UPDATE `users` SET `g` = `g` - "'.$_chest_setting['cost'][$id].'" WHERE `id` = "'.$user['id'].'"');
					mysql_query("UPDATE `chest_user` SET `$id` = `$id` - 1 WHERE `user` = ".$user['id']."");
exit(header('Location: /chest/user/?'));

					}
		 
		 $_chest = 0;
		 
		    for($i = 1; $i <= 4; $i++) {
		  	
			if($chest[$i] > 0) {
				
				$_chest++;
				
			?>
<div class="block">
            <a href="#"><img class="left mr8" src="/images/chet.jpg" alt=""></a>
<img src="/images/icons/equip.png" width="16" height="16" alt=""> <font color="<?=$_chest_setting['color'][$i];?>">Сундук <?=$_chest_setting['name'][$i];?></font> (<?=$chest[$i];?> шт.)<br></div>
        <div class="clear"></div>
    <div class="dotted"></div>
    <div class="block center">                    <span class="btn_start"><span class="btn_end"><a class="btn" href="/chest/user/?open&id=<?=$i;?>">Открыть за <img src="/images/icons/gold.png" width="16" height="16" alt=""> <?=$_chest_setting['cost'][$i];?></a></span> </span>        </div>    <div class="dotted"></div>

			<?
			}
		    }

			echo '</div>';
			
			if($_chest == 0) {
				?>
				<div class='content'>
				
 <div class="block">У вас нет сундуков!</div>
<div class="dotted"></div>
<ul class="block small">
    <li class="color2">
        Сундуки - вы падают в Бунте, в сундуках можно найти опыт,рубли,сахар, шмотки.
    </li> </ul>
				</div>

				<?
			}

            
		 include './system/f.php';
?>