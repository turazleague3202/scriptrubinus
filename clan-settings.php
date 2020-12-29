<?
    
    include './system/common.php';
    
 include './system/functions.php';
        
      include './system/user.php';
    
if(!$user) {

  header('location: /');
    
exit;

}


$memb = mysql_query('SELECT * FROM `clan_memb` WHERE `clan` = "'.$clan['id'].'" AND `user` = "'.$user['id'].'"');
  $memb = mysql_fetch_array($memb);

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
  
 

if($memb['rank'] < 4 && 5) {

  header('location: /clan/');

exit;

}

$title ='Настройки банды';

    include './system/h.php';



  if(_string($_POST['change_name'])) {
  
    if($clan['g'] < 250) {
    
      header('location: /clan/');
     
    exit;
    
    }
    
    $name = _string($_POST['name']);
    
    if($name) {
    
    mysql_query('UPDATE `clans` SET `g` = `g` - 250,
                                 `name` = "'.$name.'" WHERE `id` = "'.$clan['id'].'"');
  
    }
  
    header('location: /clan-settings/?');
  
  }



if(isset($_GET['changename'])) {
echo ' <div class="content"><div class="block center color3 s125"><a href="/clan-settings">Настройки</a>/ Изменение названия</div>
            <div class="line"></div>
<div class="block">

    <form action="/clan-settings/?change_name=true" method="post">
        <div class="form-group field-clanchangenameform-name required">
<label class="control-label" for="clanchangenameform-name">Новое название <img src="/images/icons/gold.png" width="16" height="16" alt=""> 250</label>
  <input type="text" class="form-control" name="name"/> 
<div class="help-block"></div>
</div>
     <span class="btn_start"><span class="btn_end"><input type="submit" value="Сохранить
" class="btn" name="change_name"/>
</span></span>
  </form>

</div>


    </form>
</div>
</div>
';
include './system/f.php';
exit();
}

 if($memb['rank'] == 5) {
  if(isSet($_GET['delete'])) {
  
  mysql_query('DELETE FROM `clan_memb` WHERE `clan` = "'.$clan['id'].'"');
  mysql_query('DELETE FROM `clans` WHERE `id` = "'.$clan['id'].'"');
  mysql_query('DELETE FROM `clan_msg` WHERE `clan` = "'.$clan['id'].'"');
  mysql_query('DELETE FROM `clan_msg_read` WHERE `clan` = "'.$clan['id'].'"');
mysql_query('DELETE FROM `clan_journal` WHERE `cl_id` = "'.$clan['id'].'"');
mysql_query('DELETE FROM `clan_m` WHERE `clan` = "'.$clan['id'].'"');
mysql_query('DELETE FROM `clan_invite` WHERE `clan` = "'.$clan['id'].'"');
    
    header('location: /clans/');

  exit;

  }

}

if(isset($_GET['clandelet'])) {
echo '    <div class="content"><div class="block center color3 s125"><a href="/clan-settings">Настройки</a>/ Удаление банды</div>
            <div class="line"></div><div class="block center s125 red">
    Вы уверены, что хотите удалить банду? Все члены банды будут удалены и сама банда удалится безвозвратно
</div>
<div class="dotted"></div>
<div class="menu"><li><a href="/clan-settings/?delete"><img src="/images/icons/ok.png" width="16" height="16" alt=""> Да, я подтверждаю удаление банды!</a></li><li><a href="/clan-settings"><img src="/images/icons/cross.png" width="16" height="16" alt=""> Нет, я отказываюсь удалять банду!</a></li></div></div>
';
include './system/f.php';
exit();
}


  $text = _string($_POST['text']);
  if($text) {
    mysql_query('INSERT INTO `clan_msg` (`clan`,
                                             `user`,
                                             `text`,
                                             `time`) VALUES ("'.$clan['id'].'",
                                                             "'.$user['id'].'",
                                                                   "'.$text.'",
                                                                   "'.time().'")');
    header('location: /clan-settings');  
  }
?>




   <div class="content"><div class="block center color3 s125"><a href="/clan/"><?=$clan['name']?></a>/ Настройки банды</div>
            <div class="line"></div>    
 <form class="block" action="/clan-settings?<?=$udet?>" method="post">
<div class="form-group field-clanalertform-text required">
<label class="control-label" for="clanalertform-text">Оповещение</label>
<input type="text" class="form-control" name="text">

<div class="help-block"></div>
</div>    <span class="m3 btn_start middle">
        <span class="btn_end"><button type="submit" class="btn">Опубликовать</button></span>
    </span>
    </form>    <div class="dotted"></div>

<div class="menu">
    
    
    
<li><a href="/clan-settings/?changename=<?=$randp = rand(222,999)?>"><img src="/images/icons/right_blue.png" width="16" height="16" alt=""> Изменить название</a></li>
<?
  if($memb['rank'] == 5) {
?>
<li><a href="/clan-settings/?clandelet=<?=$randp = rand(222,999)?>"><img src="/images/icons/cross.png" width="16" height="16" alt=""> <span class="red">Удалить банду</span></a></li>
<?
}
?>
<?
  if($memb['rank'] == 4) {
?>
<li><a href="/clan/?vexit"><img src="/images/icons/cross.png" width="16" height="16" alt=""> <span class="red">Покинуть банду</span></a></li>
<?
}
?>
</div></div>
</div>

<?
include './system/f.php';

?>