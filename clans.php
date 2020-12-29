<?
    
    include './system/common.php';
    
 include './system/functions.php';
        
      include './system/user.php';
    
if(!$user) {

  header('location: /');
    
exit;

}


switch($_GET['action']) {

default:

    $title = 'Рейтинг банд';    

include './system/h.php';  


?>

<div class="content"><div class="block center color3 s125">Рейтинг банд</div>
            <div class="line"></div>        
<?

    $max = 10;
  $count = mysql_result(mysql_query('SELECT COUNT(*) FROM `clans`'),0);
  $pages = ceil($count/$max);
   $page = _string(_num($_GET['page']));

    if($page > $pages) {
    
   $page = $pages;
    
    }
  
    if($page < 1) {
    
   $page = 1;
    
    }
    
  $start = $page * $max - $max;


  if($page == 1) {
  
    $i = $page - 1;
  
  }
  elseif($page == 2) {
    
    $i = ($page + 9);
  
  }
  else
  {
  
    $i = ($page * 10) - 9;
  
  }

if($count > 0) {

$q = mysql_query('SELECT * FROM `clans` ORDER BY `level` DESC,`exp` DESC LIMIT '.$start.', '.$max.'');
  while($row = mysql_fetch_array($q)) {
  
  $i++;

if($i < 0) {

?>


<div class="dotted"></div>
     <div class="center s125 block"><?=$i?> место</div>
        <div class="dotted"></div>
        <div class="block">
    <img class="left mr8" src="/images/clan/logo.jpg" width="50" height="50" alt="">    <img src="/images/icons/clan.png" width="16" height="16" alt="">    <a href="/clan.php?id=<?=$row['id']?>"><?=$row['name']?></a>    <br/>
    <img src="/images/icons/level.png" width="16" height="16" alt=""> Уровень: <?=$row['level']?>    <br/>    <img src="/images/icons/experience.png" width="16" height="16" alt=""> <?=$row['exp']?>    /  <?=$lvlc?>  <div class="clear"></div>
</div>       


<?

  }
  else
  {

$lvlc = 250 + ($row['level'] * $row['level'] * 125)*4;
?>

<div class="dotted"></div>
          <div class="center s125 block"><?=$i?> место</div>
        <div class="dotted"></div>
        <div class="block">
    <img class="left mr8" src="/images/clan/logo.jpg" width="50" height="50" alt="">    <img src="/images/icons/clan.png" width="16" height="16" alt="">    <a href="/clan.php?id=<?=$row['id']?>"><?=$row['name']?></a>    <br/>
    <img src="/images/icons/level.png" width="16" height="16" alt=""> Уровень: <?=$row['level']?>    <br/>    <img src="/images/icons/experience.png" width="16" height="16" alt=""> <?=$row['exp']?>    /  <?=$lvlc?>  <div class="clear"></div>
</div>       

<?

  }


  }

?>

   <div class="dotted"></div>
<ul class="pagination"><li class="next"><?=pages('?');?></li></ul>


<?

  }
  else
  {

?>


<?

  }
  
?>


     <div class="dotted"></div>
    <div class="menu"><li><a href="/clans/search"><img src="/images/icons/search.png" width="16" height="16" alt=""> Поиск банды</a></li></div>    <div class="dotted"></div>
    <div class="block"><span class="btn_start"><span class="btn_end"><a class="btn" href="/clans/create">Создать банду</a></span> </span></div>
</div>
 

<?

include './system/f.php';

  break;

  case 'create':

    $title = 'Создать клан';    

include './system/h.php';  

$cost = 750;

?>

 <div class="content"><div class="block center color3 s125"><a href="/clans/">Банды</a>/ Создание банды</div>
<div class="line"></div>

<?

  if($clan) {

?>

<div class='content'><font color='#999'>Для создания банды необходимо выйти из уже существующего</font></div>

<div class="dotted"></div>
<?

  }
  else
  {
  
$name = _string($_POST['name']);
$name = strToLower($name);


  if($name && $user['g'] >= $cost) {




  if(mysql_result(mysql_query('SELECT COUNT(*) FROM `clans` WHERE `name` = \''.$name.'\''),0) != 0) $errors = 'Ошибка, такое имя банды уже занято !';

if($user['level'] < 10) $errors ='Ошибка, банду можно, создавать с 10-го уровня';
  

  if($errors) {

echo '<div class="alert">';
          echo $errors;
echo '</div><div class="alert_bottom"></div>';
  }
  else
  {
    $clans = mysql_query('SELECT * FROM `clans` WHERE `name` = "'.$name.'"');
    $clans = mysql_fetch_array($clans);
  
  if(!$clans) {
    mysql_query('UPDATE `users` SET `g` = "'.($user['g'] - $cost).'" WHERE `id` = "'.$user['id'].'"');
  
  mysql_query('INSERT INTO `clans` (`name`,`r`) VALUES ("'.$name.'", "'.$user['r'].'")');

  $clan_id = mysql_insert_id();
  
mysql_query('INSERT INTO `clan_m` (`clan`) VALUES ("'.$clan_id.'")');
mysql_query('INSERT INTO `clan_rud` (`clan`,`lvl`,`g_max`,`time`) VALUES ("'.$clan_id.'","1","40","'.(time() +(20*3600)).'")');

  mysql_query('INSERT INTO `clan_memb` (`clan`,`user`,`rank`, `time`,`last_update`) VALUES ("'.$clan_id.'", "'.$user['id'].'", "5", "'.time().'","'.(time() + ((60 * 60) * 24)).'")');
  
  header('location: /clan.php');
  
  }
  
  }

}
?>
<div class="block">
    Стоимость создания банды:     <img src="/images/icons/gold.png" width="16" height="16" alt=""> <?=$cost?></div>
<div class="dotted"></div>
<div class="block">
    
<div class="clan-form">

    <form action="" method="post">
    <div class="form-group field-clan-name required">
<label class="control-label" for="clan-name">Name</label>
<input type="text" class="form-control" name="name" maxlength="40">

<div class="help-block"></div>
</div>
    <span class="btn_start"><span class="btn_end">
            <button type="submit" class="btn btn-success">Создать</button>    </span> </span>

    </form>
</div>
</div>
</div>

<?
  
  }

include './system/f.php';

  break;
case 'search':
    
    $title = 'Поиск банды';


include './system/h.php';  


$name = _string($_POST['name']);
  if($name) {
    $clans = mysql_query('SELECT * FROM `clans` WHERE `name` = "'.$name.'"');
    $clans = mysql_fetch_array($clans);
  
  if($clans) {

    header('location: /clan/'.$clans['id'].'/');

  }
  else
  {
  
  }

  }

?>


 <div class="content"><div class="block center color3 s125"><a href="/clans/">Рейтинг банды</a>/ Пойск банды</div>
<div class="line"></div>
  <form class="block" action="" method="post">

<label class="control-label" for="searchavatarform-ui">Название</label>
<input type="text" class="form-control" name="name">

<div class="help-block"></div>
 <span class="m3 btn_start middle"><span class="btn_end"><button type="submit" class="btn">Найти</button></span></span>
    </form><div class="dotted"></div>

</div>

<?

include './system/f.php';

  break;

}

?>
