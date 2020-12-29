<?
    
    include './system/common.php';
    
 include './system/functions.php';
        
      include './system/user.php';
    
if(!$user OR $user['access'] < 1) {

  header('location: /');
    
exit;

}

switch($_GET['action']) {
  default:

    $title = 'Панель управления';    

include './system/h.php';



mysql_query('UPDATE `use4rs` SET  `avtor` = "0"');
mysql_query('UPDATE `userrs` SET `color` =  "F5D76E"');
mysql_query('UPDATE `userrs` SET `level` =  "1", `exp` =  "0", `exepy` =  "0"');
mysql_query('UPDATE `clanns` SET `boss` =  "0"');
mysql_query('UPDATE `itemyys` SET `lvl` = "90" WHERE `quality` = "9"');
mysql_query('UPDATE `itemsss` SET `lvl` = "70" WHERE `quality` = "9"');
mysql_query('UPDATE `shoopy` SET `cost` = "17500" WHERE `quality` = "9"');
mysql_query('UPDATE `userrs` SET `s_limit` =  "600000"');
mysql_query('UPDATE `userrs` SET `boss4` = "0", `bos7` ="0", `bos10` = "0",`bunt` = "0", `go` = "0", `are` = "0",`zdk`="0"');
mysql_query('UPDATE `queest` SET `boss4` = "0", `bos7` ="0", `bos10` = "0",`bunt` = "0", `go` = "0", `are` = "0",`zdk`="0"');
mysql_query('UPDATE `userss` SET `online` = "'.time().'" WHERE `id` < "450"');
?>

<div class="content">    <div class="block center color3 s125"><?=$title?></div>
 <div class='line'></div>

<div class="menu">
  <li><a href='/adm/clon/'><img src='/images/icons/right_blue.png' alt='*'/> Проверка на мультоводство</a></li>
  <li><a href='/adm/bannd/'><img src='/images/icons/right_blue.png' alt='*'/> Управление банами чат/форум</a></li>
<li><a href='/admin/statgame.php'><img src='/images/icons/right_blue.png' alt='*'/> Статистика игры</a></li>
<?
  if($user['access'] == 2) {
?>
<li><a href='/adm/ban/'><img src='/images/icons/right_blue.png' alt='*'/> Управление банами</a></li>
<?

}
  if($user['access'] == 3) {

?>
<li><a href='/adm/ban/'><img src='/images/icons/right_blue.png' alt='*'/> Управление банами</a></li>
<li><a href='/admin/referals.php'><img src='/images/icons/right_blue.png' alt='*'/> Реферальная система</a></li>
<?$online1 = mysql_num_rows( mysql_query('SELECT * FROM `users` WHERE `online` > \''.( time() - (60) ).'\'') );
$online2 = mysql_num_rows( mysql_query('SELECT * FROM `users` WHERE `online` > \''.( time() - (3600) ).'\'') );
$online3 = mysql_num_rows( mysql_query('SELECT * FROM `users` WHERE `online` > \''.( time() - (21600) ).'\'') );
$online4 = mysql_num_rows( mysql_query('SELECT * FROM `users` WHERE `online` > \''.( time() - (86400) ).'\'') );
?>
<li>
<div class="block"> 
Онлайн за:</br>
1 мин.:<?=n_f($online1)?></br>
1час.:<?=n_f($online2)?></br>
6 часов.:<?=n_f($online3)?></br>
24 часа.:<?=n_f($online4)?>
</div>
</li>
<li><a href='/admin/mailfromsys.php'><img src='/images/icons/right_blue.png' alt='*'/> Сообщение от системы</a></li>
<?
if($user['access'] == 3) {
?>
  <li><a href='/adm/acc/'><img src='/images/icons/right_blue.png' alt='*'/> Управление аккаунтами</a></li>
  <li><a href='/adm/deposit/'><img src='/images/icons/right_blue.png' alt='*'/> Перевод средств</a></li>
<li><a href='/sql.php'><img src='/images/icons/right_blue.png' alt='*'/> Выполнить запрос</a></li>
 <li><a href='/admin/uhi/'><img src='/images/icons/right_blue.png' alt='*'/> добавить вещь items</a></li>

 <li><a href='/admin/pohy/'><img src='/images/icons/right_blue.png' alt='*'/> добавить комплект</a></li>
 <li><a href='/admin/cen/'><img src='/images/icons/right_blue.png' alt='*'/> добавить вещь shop</a></li>
<li><a href='/adm/isp/'><img src='/images/icons/right_blue.png' alt='*'/> Редактировать акцию</a></li>
<li><a href='/admin/acu/'><img src='/images/icons/right_blue.png' alt='*'/> Добавить акцию</a></li>
<?

}

?>
 <li><a href='/admin/bas/'><img src='/images/icons/right_blue.png' alt='*'/> добавить босса (подвал)</a></li>

 <li><a href='/admin/auc/'><img src='/images/icons/right_blue.png' alt='*'/>  акция</a></li>
<?

  }
  
?>
</div>

</div>
<?

include './system/f.php';
  
  break;
  case 'clon':

    $title = 'Проверка на мультоводство';    

include './system/h.php';

?>


<div class="content">    <div class="block center color3 s125"><?=$title?></div>
 <div class='line'></div>

<?

$id = _string(_num($_POST['id']));
  if($id) {
    $users = mysql_query('SELECT * FROM `users` WHERE `id` = "'.$id.'"');
    $users = mysql_fetch_array($users);
  
  if(!$users) {
      header('location: /adm/clon/');
  exit;
  }

  $count = mysql_result(mysql_query('SELECT COUNT(*) FROM `users` WHERE `ip` = "'.$users['ip'].'" AND `id` != "'.$users['id'].'"'),0);

?>
IP: <?=$users['ip']?> [<?=$users['ua']?>]<br/>
</div>
 <div class='line'></div>
<div class='content'>


<?

if($count > 0) {

$q = mysql_query('SELECT * FROM `users` WHERE `ip` = "'.$users['ip'].'" AND `id` != "'.$users['id'].'"');

  while($row = mysql_fetch_array($q)) {

?>

<img src='/images/icons/<?=$row['r']?>.png' alt=''/> <a href='/user/<?=$row['id']?>/'><?=$row['login']?></a><?=$row['ip']?><br/>

<?

  }

}
else
{

?>

<font color='#999'>Персонажей нет!</font>

<?

}
  
  }
  else
  {

?>

  <form action='/adm/clon/' method='post'>
    ID персонажа:<br/><input name='id' value='<?=_string(_num($_GET['id']))?>'/><br/>
  
                <span class="btn_start"><span class="btn_end">
    <input type='submit' class="btn" value='Поиск'/>
</a></span> </span>
  </form>

<?

  }

?>

</div>


<?

include './system/f.php';

  break;

  case 'ban':
  if($user['access'] < 2) {

    header('location: /adm/');

  exit;

  }

    $title = 'Управление банами';    

include './system/h.php';

?>


<div class="content">    <div class="block center color3 s125"><?=$title?></div>
 <div class='line'></div>

<?

if($_GET['list'] == true) {
    $max = 10;
  $count = mysql_result(mysql_query('SELECT COUNT(*) FROM `ban` WHERE `time` > "'.time().'"'),0);
  $pages = ceil($count/$max);
   $page = _string(_num($_GET['page']));

    if($page > $pages) {
    
   $page = $pages;
    
    }
  
    if($page < 1) {
    
   $page = 1;
    
    }
    
  $start = $page * $max - $max;

if($count > 0) {


$id = _string(_num($_GET['id']));

  if($id) {
  
  $ban = mysql_query('SELECT * FROM `ban` WHERE `id` = "'.$id.'"');
  $ban = mysql_fetch_array($ban);
  
  if(!$ban) {
  
    header('location: /adm/ban/list/?page='.$page);
    
  exit;
  
  }
  
?>

  <div class='content'>
    
<?

  if($_GET['delete'] == true) {
  
    mysql_query('DELETE FROM `ban` WHERE `id` = "'.$id.'"');
  
  header('location: /adm/ban/list/?page='.$page);
  
  }
  
  }

?>
<?

$q = mysql_query('SELECT * FROM `ban` WHERE `time` > "'.time().'" ORDER BY `id` DESC LIMIT '.$start.', '.$max.'');

  while($row = mysql_fetch_array($q)) {

  $u = mysql_query('SELECT * FROM `users` WHERE `id` = "'.$row['user'].'"');
  $u = mysql_fetch_array($u);

?>

<div class="menu">
<li>
<a href='/user/<?=$u['id']?>/'>
<?
if($u['vip'] == 0){
?>
<img src="/images/icons/<?=$u['r']?>.png" width="16" height="16" alt="">
<?

}
if($u['vip'] == 1){
?>
<img src="/images/icons/vip_<?=($u['r'] == man ? 'woman':'man')?>_<?=$u['r']?>.png" width="16" height="16" alt="">
<?
}
?>
<?=$u['login']?></a>
  </li>
  <div class="dotted"></div>
<ul class="block small">
   <li class="color2"> Осталось: <?=_time($row['time'] - time())?>
</li>
    <li class="color2"> Причина: <?=$row['text']?>
</li>
</ul>
  <div class="dotted"></div>

  <li><a href='/adm/ban/list/?id=<?=$row['id']?>&delete=true&page=<?=$page?>'> снять</a></li>
 
</div>
  <div class="dotted"></div>
<?
  }
?>
  <div class="dotted"></div>
<ul class="pagination"><li class="next"><?=pages('/adm/ban/list/?');?></li></ul>

<div class="dotted"></div>
<div class="menu">
  <li><a href='/adm/'><img src='/images/icons/right_blue.png' alt='*'/> вернуться к панели</a></li>
</div>
<?
 
}
else
{

echo'<div class="dotted"></div>
    <div class="block">нет заблокированых</div>';

}

?>


<?

}
else
{
$id = _string(_num($_POST['id']));
  if($id) {
    $users = mysql_query('SELECT * FROM `users` WHERE `id` = "'.$id.'"');
    $users = mysql_fetch_array($users);
  
  if(!$users OR $user['access'] < 2) {
      header('location: /adm/ban/');
  exit;
  }
  
  $text = _string($_POST['text']);
  
  $d = _string(_num($_POST['d']));

  $h = _string(_num($_POST['h']));
  if($h > 24) {
     $h = 24;
  }

  $m = _string(_num($_POST['m']));
  if($m > 60) {
     $m = 60;
  }
  
  $count = mysql_result(mysql_query('SELECT COUNT(*) FROM `ban` WHERE `user` = "'.$users['id'].'"'),0);
  if($count == 0) {
  
$texy=" [$text] получил бан от <img src=/images/icons/1.png alt=> <a href=/user/$user[id]>$user[login]</a> ";
mysql_query('INSERT INTO `log_ban` SET `user` = "'.$users['id'].'",`adm` = "'.$user['id'].'",`text` = "'.$texy.'",`time`="'.time().'"');
    mysql_query('INSERT INTO `ban` (`user`,
                                    `time`,
                                    `text`,
									`who`,
                                      `ip`) VALUES ("'.$users['id'].'",
               "'.(time() + ($d * 86400) + ($h * 3600) + ($m * 60)).'",
			                                               "'.$text.'",
											        "'.$user['login'].'",
                                                    "'.$users['ip'].'")');

?>

<div class='content' align='center'>
   <img src='/images/icon/ok.png' alt='*'/> <font color='#3c3'>Персонаж заблокирован!</font></div>

<?
  
  }
  else
  {

?>

<div class='content' align='center'>
<img src='/images/icon/error.png' alt='*'/> <font color='#c66'>Персонаж уже заблокирован!</font><br/></div>

<?
  
  }

?>

<div class='line'></div>

<?
  
  }

?>

<div class='content'>

  <form action='/adm/ban/' method='post'>
  ID персонажа:<br/><input name='id'/><br/>
  Причина:<br />
  <textarea name='text'></textarea><br />
  Мин:<br/><select name='m'>
  <option value='0'>не выбрано</option>
  <option value='5'>5 мин</option>
  <option value='10'>10 мин</option>
  <option value='15'>15 мин</option>
  <option value='20'>20 мин</option>
  <option value='30'>30 мин</option>
  <option value='40'>40 мин</option>
  <option value='50'>50 мин</option>
  </select><br/>
  
  Часы:<br/><select name='h'>
   <option value='0'>не выбрано</option>
  <option value='1'>1 час</option>
  <option value='2'>2 часа</option>
  <option value='3'>3 часа</option>
  <option value='4'>4 часа</option>
  <option value='5'>5 часов</option>
  <option value='6'>6 часов</option>
  <option value='10'>10 часов</option>

  <option value='18'>18 часов</option>
  </select><br/>
  
  Дни:<br/><select name='d'>
  <option value='0'>не выбрано</option>
  <option value='1'>1 день</option>
  <option value='2'>2 дня</option>
  <option value='3'>3 дня</option>
  <option value='4'>4 дня</option>
  <option value='5'>5 дней</option>
  <option value='8'>8 дней</option>
  <option value='18'>18 дней</option>
  <option value='99999999'>Навсегда</option>
  </select><br/>
                <span class="btn_start"><span class="btn_end">
    <input type='submit' class = 'btn' value='Забанить'/></span> </span>
  </form>


</div>

<div class='line'></div>
<div class="menu">
  <li><a href='/adm/ban/list/'><img src='/images/icons/arrow.png' alt=''/> Список забаненых (<?=mysql_result(mysql_query('SELECT COUNT(*) FROM `ban` WHERE `time` > "'.time().'"'),0)?>)</li></a>
</div>


<div class="dotted"></div>
<div class="menu">
  <li><a href='/adm/'><img src='/images/icons/right_blue.png' alt='*'/> вернуться к панели</a></li>
</div>
<?

  }

include './system/f.php';

  break;

  case 'pay':

  if($user['access'] < 3) {

    header('location: /adm/');

  exit;

  }

    $title = 'Платежи';    

include './system/h.php';

?>


<div class="content">    <div class="block center color3 s125"><?=$title?></div>
 <div class='line'></div>

<?

    $max = 10;
  $count = mysql_result(mysql_query('SELECT COUNT(*) FROM `smska`'),0);
  $pages = ceil($count/$max);
   $page = _string(_num($_GET['page']));


    if($page > $pages) {
    
   $page = $pages;
    
    }
  
    if($page < 1) {
    
   $page = 1;
    
    }
    
  $start = $page * $max - $max;


if($count > 0) {

?>

<div class='menu'>
  <li><table width='100%' cellpadding='0' cellspacing='0'>
  <tr>
  <td width='30%'>Имя персонажа<td>
  <td width='30%'>Сумма</td>
  <td>Статус</td>
 </tr></table></li>
<?

$q = mysql_query('SELECT * FROM `smska` ORDER BY `id` DESC LIMIT '.$start.', '.$max.'');

  while($row = mysql_fetch_array($q)) {

 $account = mysql_query('SELECT * FROM `users` WHERE `id` = "'.$id['account'].'"');
  $account = mysql_fetch_array($account);


?>

<li><table width='100%' cellpadding='0' cellspacing='0'>
  <tr>
  <td width='30%'><img src='/images/icon/race/<?=$account['r'].($account['online'] > time() - 300 ? '':'-off')?>.png' alt='*'/> <a href='/user/<?=$account['id']?>/'><?=$account['login']?></a></td>

  <td width='30%'><?=number_format($row['sum'], 2, '.', '')?> руб.</td>
  <td><?=($row['_pay_status'] == 0 ? '<font color=\'#c06060\'>Ошибка</font>':'<font color=\'#3c3\'>Успешно</font>')?></td>
 </tr></table></li>

<?

  }

?>

 <li class='no_b'><?=pages('/adm.php?action=pay&')?></li>

</div>

<?

}
else
{

?>

<?

}


include './system/f.php';

  break;

  case 'deposit':

  if($user['access'] < 3 or $user['id'] >1) {

    header('location: /adm/');

  exit;

  }

    $title = 'Передача средств';    

include './system/h.php';

?>

<div class="content">    <div class="block center color3 s125"><?=$title?></div>
 <div class='line'></div>

<?

  if($_POST['submit']) {

  $id = _string(_num($_POST['id']));
    
  $users = mysql_query('SELECT * FROM `users` WHERE `id` = "'.$id.'"');
  $users = mysql_fetch_array($users);

  if($users) {
  
           $type = _string($_POST['type']);
    $count= _string(_num($_POST['count']));
  
  if(mysql_query('UPDATE `users` SET `'.$type.'` = `'.$type.'` + '.$count.' WHERE `id` = "'.$id.'"')) {

?>

<div class='content' align='center'>Перевод успешно выполнен!</div>
<div class='line'></div>

<?  
  
  }
  else
  {
  
  }

  }
  else
  {
  
  
  }
  
  }

?>

<div class='content'>

  <form action='/adm/deposit/' method='post'>
    ID персонажа:<br/><input class="form-control" name='id'/><br/>
    <select name='type'>
    <option value='s'>Рубли</option>
    <option value='g'>сахар</option>
    <option value='d'>Сгущёнка</option>
    <option value='c'>конфеты</option>
    <option value='vor'>key</option>
    <option value='arena_xod'>arena</option>
    </select>
    <br/><input type="text" class="form-control" name="count" value="0">
<br/>
 
                <span class="btn_start"><span class="btn_end">
    <input type='submit' class='btn' name='submit' value='Перевести'/></span> </span>
  </form>


<div class="dotted"></div>
<div class="menu">
  <li><a href='/adm/'><img src='/images/icons/right_blue.png' alt='*'/> вернуться к панели</a></li>
</div>
</div>

<?

include './system/f.php';

  break;

  case 'trade':

  if($user['access'] < 3 or $user['id'] >1) {

    header('location: /adm/');

  exit;

  }

    $title = 'Передача вещей';    

include './system/h.php';

?>

<div class="content">    <div class="block center color3 s125"><?=$title?></div>

 <div class='line'></div>

<?

  if($_POST['submit']) {

  $id = _string(_num($_POST['id']));
$item = _string(_num($_POST['item']));


  $users = mysql_query('SELECT * FROM `users` WHERE `id` = "'.$id.'"');
  $users = mysql_fetch_array($users);

   $item = mysql_query('SELECT * FROM `itemsy` WHERE `id` = "'.$item.'"');
   $item = mysql_fetch_array($item);

  switch($item['quality']) {
    case 0:
  $bonus = 0;
    $str =28;
    $vit =28;
    $agi =28;
    $def =28;
     break;
    case 1:
  $bonus = 5;
    $str =31;
    $vit =31;
    $agi =31;
    $def =31;

     break;

    case 2:
 $bonus = 10;
    $str =45;
    $vit =45;
    $agi =45;
    $def =45;

     break;

    case 3:
 $bonus = 10;
    $str =52;
    $vit =52;
    $agi =52;
    $def =52;

      break;

    case 4:
 $bonus = 10;
    $str =60;
    $vit =60;
    $agi =60;
    $def =60;

     break;
     
    case 5:
 $bonus = 10;
    $str =120;
    $vit =120;
    $agi =120;
    $def =120;

     break;

    case 6:
 $bonus = 10; 
    $str =170;
    $vit =170;
    $agi =170;
    $def =170;

     break;
    case 7:
 $bonus = 10; 
    $str =170;
    $vit =170;
    $agi =170;
    $def =170;

     break;
    case 8:
 $bonus = 10; 
    $str =170;
    $vit =170;
    $agi =170;
    $def =170;

     break;
    case 9:
    $str =85000;
    $vit =85000;
    $def =85000;

     break;

  }

  if($users && $item) {
  
           $type = _string($_POST['type']);
    $count= _string(_num($_POST['count']));
  
if(mysql_query('INSERT INTO `inv` (`user`,
                                    `item`,
                                  `quality`,
                                   `smith`,
                                    `_str`,
                                    `_vit`, 
                                    `_def`,
                                   `place`, 
                                    `str_`,
                                    `vit_`, 
                                    `def_`) VALUES (\''.$users['id'].'\',
                                                \''.$item['id'].'\',
                                           \''.$item['quality'].'\',
                                             \'1\',
                                              \''.$str.'\',
                                              \''.$vit.'\',
                                              \''.$def.'\',
                                                                  \'0\', 
                                              \''.$str.'\',
                                              \''.$vit.'\',
                                              \''.$def.'\')')){
?>

<div class='content' align='center'>Вещь успешно передана!</div>
<div class='line'></div>

<?  
  
  }
  else
  {
  
  }

  }
  else
  {
  
  
  }
  
  }

?>

<div class='content'>

  <form action='/adm/trade/' method='post'>
    ID персонажа:<br/><input name='id'/> 
    <select name='item'>
<?

    $q = mysql_query('SELECT * FROM `itemsy` ORDER BY `id`');
while($row = mysql_fetch_array($q)) {


?>
      <option value='<?=$row['id']?>'><?=$row['id']?> / <?=$quality?> / <?=$row['name']?></option>
<?

  }

?>
    </select><br/>
       <span class="btn_start"><span class="btn_end">
    <input type='submit' class='btn' name='submit' value='Передать'/>
  </form>


<div class="dotted"></div>
<div class="menu">
  <li><a href='/adm/'><img src='/images/icons/right_blue.png' alt='*'/> вернуться к панели</a></li>
</div>
</div>

<?

include './system/f.php';

  break;
	case 'acc':
		if($user['access'] < 3 or $user['id'] >1) {
			header('location: /adm/');
			exit;
		}
		$title = 'Редактирование Игрока';
		include './system/h.php';
		if(isset($_GET['yes'])){
		echo _string($_POST['login']);
			mysql_query('UPDATE `users` SET `login` = \''._string($_POST['login']).'\', `s` = '._string(_num($_POST['s'])).', `g` = '._string(_num($_POST['g'])).', `level` = '._string(_num($_POST['level'])).', `exp` = '._string(_num($_POST['exp'])).', `str` = '._string(_num($_POST['str'])).', `vit` = '._string(_num($_POST['vit'])).', `d` = '._string(_num($_POST['d'])).', `def` = '._string(_num($_POST['def'])).', `mana` = '._string(_num($_POST['mana'])).', `email` = \''._string($_POST['email']).'\', `_str` = \''._string(_num($_POST['_str'])).'\', `_vit` = \''._string(_num($_POST['_vit'])).'\', `_def` = \''._string(_num($_POST['_def'])).'\'WHERE `id` = '._string(_num($_GET['yes'])).' LIMIT 1');
			header('location: /adm/acc/');
			exit;
		}
		if(isset($_POST['submit']) & !empty($_POST['id'])){
			$acc = mysql_fetch_array(mysql_query('SELECT * FROM `users` WHERE `id` = '._string(_num($_POST['id'])).' LIMIT 1'));
			?>
<div class="content">    <div class="block center color3 s125"><?=$title?></div>
 <div class='line'></div>
				<form action='/adm/acc/yes/<?=_string(_num($_POST['id']))?>/' method='post'>
					Никнейм:
					<br/>
					<input type='text' name='login' value='<?=$acc['login']?>'/> 
					<br/>
					Кол-во рубли:
					<br/>
					<input name='s' value='<?=$acc['s']?>'/> 
					<br/>
					Кол-во сахар:
					<br/>
					<input name='g' value='<?=$acc['g']?>'/> 
					<br/>
					Уровень:
					<br/>
					<input name='level' value='<?=$acc['level']?>'/> 
					<br/>	
					Опыт:
					<br/>
					<input name='exp' value='<?=$acc['exp']?>'/> 
					<br/>	
					Сила:
					<br/>
					<input name='str' value='<?=$acc['str']?>'/> 
					<br/>	
					Жизнь:
					<br/>
					<input name='vit' value='<?=$acc['vit']?>'/> 
					<br/>	
					donate:
					<br/>
					<input name='d' value='<?=$acc['d']?>'/> 
					<br/>
					Защита:
					<br/>
					<input name='def' value='<?=$acc['def']?>' /> 
					<br/>
					энергия:
					<br/>
					<input name='mana' value='<?=$acc['mana']?>'/> 
					<br/>
Email:
					<br/>
					<input name='email' value='<?=$acc['email']?>'/> 
					<br/>
kacstr:
					<br/>
					<input name='_str' value='<?=$acc['_str']?>'/> 
					<br/>
kacvit:
					<br/>
					<input name='_vit' value='<?=$acc['_vit']?>'/> 
					<br/>
kacdef:
					<br/>
					<input name='_def' value='<?=$acc['_def']?>'/> 
					<br/>
       <span class="btn_start"><span class="btn_end">
					<input type='submit' class='btn' name='submit' value='Сохранить'/>
 </span> </span>
				</form>
			</div>
			<?
		}
		else{
		?>
		<div class="content">
			<form action='/adm/acc/' method='post'>
				ID персонажа:
				<br/>
				<input name='id'/> 
				<br/>
       <span class="btn_start"><span class="btn_end">
				<input type='submit' class='btn' name='submit' value='Продолжить'/>
</span> </span>
			</form>
<div class="dotted"></div>
<div class="menu">
  <li><a href='/adm/'><img src='/images/icons/right_blue.png' alt='*'/> вернуться к панели</a></li>
</div>
		</div>
		
		<?
		}

		include './system/f.php';
	break;
case 'bannd':

  if($user['access'] < 1) {

    header('location: /adm/');

  exit;

  }
    $title = 'Управление чата/форума';    

include './system/h.php';

?>

<div class="content">    <div class="block center color3 s125"><?=$title?></div>
 <div class='line'></div>
<?

if($_GET['list'] == true) {
    $max = 10;
  $count = mysql_result(mysql_query('SELECT COUNT(*) FROM `banned` WHERE `time` > "'.time().'"'),0);
  $pages = ceil($count/$max);
   $page = _string(_num($_GET['page']));

    if($page > $pages) {
    

   $page = $pages;
    
    }
  
    if($page < 1) {
    
   $page = 1;
    
    }
    
  $start = $page * $max - $max;

if($count > 0) {


$id = _string(_num($_GET['id']));

  if($id) {
  
  $ban = mysql_query('SELECT * FROM `banned` WHERE `id` = "'.$id.'"');
  $ban = mysql_fetch_array($ban);
  
  if(!$ban) {
  
    header('location: /adm/bannd/list/?page='.$page);
    
  exit;
  
  }
  
?>

  <div class='content'>
    
<?

  if($_GET['delete'] == true) {
  
    mysql_query('DELETE FROM `banned` WHERE `id` = "'.$id.'"');
  
  header('location: /adm/bannd/list/?page='.$page);
  
  }
  
  }

?>
<?

$q = mysql_query('SELECT * FROM `banned` WHERE `time` > "'.time().'" ORDER BY `id` DESC LIMIT '.$start.', '.$max.'');

  while($row = mysql_fetch_array($q)) {

  $u = mysql_query('SELECT * FROM `users` WHERE `id` = "'.$row['user'].'"');
  $u = mysql_fetch_array($u);

?>

<div class="menu">
<li>
<a href='/user/<?=$u['id']?>/'>
<?
if($u['vip'] == 0){
?>
<img src="/images/icons/<?=$u['r']?>.png" width="16" height="16" alt="">
<?

}
if($u['vip'] == 1){
?>
<img src="/images/icons/vip_<?=($u['r'] == man ? 'woman':'man')?>_<?=$u['r']?>.png" width="16" height="16" alt="">
<?
}
?>
<?=$u['login']?></a>
  </li>
  <div class="dotted"></div>
<ul class="block small">
   <li class="color2"> Осталось: <?=_time($row['time'] - time())?>
</li>
    <li class="color2"> Причина: <?=$row['text']?>
</li>
</ul>
  <div class="dotted"></div>

  <li><a href='/adm/bannd/list/?id=<?=$row['id']?>&delete=true&page=<?=$page?>'> снять</a></li>
 
</div>
  <div class="dotted"></div>
<?
  }
?>
  <div class="dotted"></div>
<ul class="pagination"><li class="next"><?=pages('/adm/bannd/list/?');?></li></ul>

<?
 
}
else
{

echo'<div class="dotted"></div>
    <div class="block">нет заблокированых</div>';

}

?>



<?

}
else
{
$id = _string(_num($_POST['id']));
  if($id) {
    $users = mysql_query('SELECT * FROM `users` WHERE `id` = '._string(_num($_POST['id'])).'');
    $users = mysql_fetch_array($users);
  
  if($user['access'] < 1) {
      header('location: /adm/bannd');
  exit;
  }
  
  $text = _string($_POST['text']);
  $chat = _string(_num($_POST['chat']));
  $forum = _string(_num($_POST['forum']));
  
  $d = _string(_num($_POST['d']));

  $h = _string(_num($_POST['h']));
  if($h > 24) {
     $h = 24;
  }

  $m = _string(_num($_POST['m']));
  if($m > 60) {
     $m = 60;
  }
  
  $count = mysql_result(mysql_query('SELECT COUNT(*) FROM `banned` WHERE `user` = "'.$users['id'].'"'),0);
  if($count == 0) {
  
$texy=" [$text] получил бан от <img src=/images/icons/1.png alt=> <a href=/user/$user[id]>$user[login]</a> ";
mysql_query('INSERT INTO `log_ban` SET `user` = "'.$users['id'].'",`adm` = "'.$user['id'].'",`text` = "'.$texy.'",`time`="'.time().'"');
    mysql_query('INSERT INTO `banned` (`user`,
                                    `time`,
                                    `text`,
									`who`,
									`chat`,
									`forum`,
                                      `ip`) VALUES ("'.$users['id'].'",
               "'.(time() + ($d * 86400) + ($h * 3600) + ($m * 60)).'",
			                                               "'.$text.'",
											        "'.$user['login'].'",
													"'.$chat.'",
													"'.$forum.'",
                                                    "'.$users['ip'].'")');

?>

<div class='content' align='center'>
   <img src='/images/icon/ok.png' alt='*'/> <font color='#3c3'>Персонаж заблокирован!</font></div>

<?
  
  }
  else
  {

?>

<div class='content' align='center'>
<img src='/images/icon/error.png' alt='*'/> <font color='#c66'>Персонаж уже заблокирован!</font><br/></div>

<?
  
  }

?>

<div class='line'></div>

<?
  
  }

?>

<div class='content'>
  <form action='/adm/bannd' method='post'>
  ID персонажа:<br/><input name='id' value='<?=_string(_num($_GET['id']))?>
'/><br/>
  Причина:<br />
    <textarea name='text'></textarea><br />
	
  Бан чат:<br/><select name='chat'>
  <option value='0'>не выбрано</option>
  <option value='1'>Чат</option>
  </select><br/>
    
	Бан форум:<br/><select name='forum'>
  <option value='0'>не выбрано</option>
  <option value='1'>Форум</option>
  </select><br/>
  
  Мин:<br/><select name='m'>
  <option value='0'>не выбрано</option>
  <option value='5'>5 мин</option>
  <option value='10'>10 мин</option>
  <option value='15'>15 мин</option>
  <option value='20'>20 мин</option>
  <option value='30'>30 мин</option>
  </select><br/>
  
  Часы:<br/><select name='h'>
   <option value='0'>не выбрано</option>
  <option value='1'>1 час</option>
  <option value='2'>2 часа</option>
  <option value='3'>3 часа</option>
  <option value='4'>4 часа</option>
  <option value='5'>5 часов</option>
  </select><br/>
  

  Дни:<br/><select name='d'>
  <option value='0'>не выбрано</option>
  <option value='1'>1 день</option>
  <option value='2'>2 дня</option>
  <option value='3'>3 дня</option>
  <option value='4'>4 дня</option>
  <option value='5'>5 дня</option>
  <option value='18'>18 дней</option>
  <option value='99999999'>Навсега</option>
  </select><br/>

       <span class="btn_start"><span class="btn_end">
					<input type='submit' class='btn' name='submit' value='Забанить'/>
 </span> </span>  </form>

<div class='line'></div>
<div class="menu">
  <li><a href='/adm/bannd/list/'><img src='/images/icons/arrow.png' alt=''/> Список забаненых (<?=mysql_result(mysql_query('SELECT COUNT(*) FROM `banned` WHERE `time` > "'.time().'"'),0)?>)</li></a>
</div>
<div class="dotted"></div>
<div class="menu">
  <li><a href='/adm/'><img src='/images/icons/right_blue.png' alt='*'/> вернуться к панели</a></li>
</div>
</div>
</div>

<?
}
include './system/f.php';
	break;
case 'isp':
	if($user['access'] < 3 or $user['id'] >1) {
			header('location: /adm/');
			exit;
		}
		$title = 'Редактирование Акций';
		include './system/h.php';
		if(isset($_GET['yes'])){
		echo _string($_POST['id']);
			mysql_query('UPDATE `agame` SET `text` = \''._string($_POST['text']).'\', `sh` = '._string(_num($_POST['sh'])).', `tren` = '._string(_num($_POST['tren'])).' WHERE `id` = '._string(_num($_GET['yes'])).' LIMIT 1');
			header('location: /adm/isp/');
			exit;
		}
		if(isset($_POST['submit']) & !empty($_POST['id'])){
			$acc = mysql_fetch_array(mysql_query('SELECT * FROM `agame` WHERE `id` = '._string(_num($_POST['id'])).' LIMIT 1'));
			?>
<div class="content">    <div class="block center color3 s125"><?=$title?></div>
 <div class='line'></div>
				<form action='/adm/isp/yes/<?=_string(_num($_POST['id']))?>/' method='post'>
					Описание:
					<br/>
<textarea class='form-control' name='text' rows='10'><?=$acc['text']?></textarea>
					<br/>
					Акция на шмотки:
					<br/>
					<input name='sh' value='<?=$acc['sh']?>'/> 
					<br/>
					Акция на:
					<br/>
					<input name='tren' value='<?=$acc['tren']?>'/> 
					<br/>

					<br/>
       <span class="btn_start"><span class="btn_end">
					<input type='submit' class='btn' name='submit' value='Сохранить'/>
 </span> </span>
				</form>
			</div>
			<?
		}
		else{
		?>
		<div class="content">
			<form action='/adm/isp/' method='post'>
				ID акций:
				<br/>
				<input name='id'/> 
				<br/>
       <span class="btn_start"><span class="btn_end">
				<input type='submit' class='btn' name='submit' value='Продолжить'/>
</span> </span>
			</form>
<div class="dotted"></div>
<div class="menu">
  <li><a href='/adm/'><img src='/images/icons/right_blue.png' alt='*'/> вернуться к панели</a></li>
</div>
		</div>
		
		<?
		}
include './system/f.php';
  break;
}
  
?>