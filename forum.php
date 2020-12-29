<?
    
    include './system/common.php';
    
 include './system/functions.php';
        
      include './system/user.php';
    
if(!$user) {

  header('location: /');
    
exit;

}

  $sub = _string(_num($_GET['sub']));
$topic = _string(_num($_GET['topic']));

if(!$sub && !$topic) {
    $title = 'Форум';    

include './system/h.php';  

?>

   <div class="content">    <div class="block center color3 s125">Форум</div>
            <div class="line"></div>           <div class="menu">      
<?

$count = mysql_result(mysql_query('SELECT COUNT(*) FROM `forum_sub`'),0);

if($count > 0) {


  if($_GET['create'] == true && $user['access'] == 3) {

  $name = _string($_POST['name']);
$access = _string(_num($_POST['access']));
  if($name) {
  
    mysql_query('INSERT INTO `forum_sub` (`name`,
                                        `access`) VALUES ("'.$name.'",
                                                        "'.$access.'")');

    header('location: /forum/');

  }

?>

  <div class='content'>
  
  <form action='/forum/?create=true' method='post'>
  
  Название раздела:<br/>
  <input name='name'/><br/>
  Создавать топики могут:<br/>
  <select name='access'>
  <option value='0'>все</option>
  <option value='1'>модераторы</option>
  <option value='2'>администраторы</option>
  </select><br/>
  <input type='submit' value='Создать'/>
  
  </form>

  </div>
  <div class='line'></div>

<?

  }

$id = _string(_num($_GET['id']));

  if($id && $user['access'] == 3) {
  
  $i = mysql_query('SELECT * FROM `forum_sub` WHERE `id` = "'.$id.'"');
  $i = mysql_fetch_array($i);
  
  if(!$i) {
  
    header('location: /forum/');
    
  exit;
  
  }
  
  
$name = _string($_POST['name']);
  if($name) {
  
    mysql_query('UPDATE `forum_sub` SET `name` = "'.$name.'" WHERE `id` = "'.$i['id'].'"');

    header('location: /forum/?adm=true');

  }
  
?>

  <div class='content'>
  
  <form action='/forum/?adm=true&id=<?=$i['id']?>' method='post'>
  
  Название раздела:<br/>
  <input name='name' value='<?=$i['name']?>'/> <input type='submit' value='Сохранить'/>
  
  </form>

  </div>
  <div class='line'></div>

<?

  if($_GET['delete'] == true) {
  
    $q = mysql_query('SELECT * FROM `forum_topic` WHERE `sub` = "'.$i['id'].'"');
    while($row = mysql_fetch_array($q)) {
      mysql_query('DELETE FROM `forum_comments` WHERE `topic` = "'.$row['id'].'"');
    }
    
   mysql_query('DELETE FROM `forum_topic` WHERE `sub` = "'.$i['id'].'"');
    
      mysql_query('DELETE FROM `forum_sub` WHERE `id` = "'.$i['id'].'"');
    
    header('location: /forum/?adm=true');
    
    }

  }

?>


<?

$q = mysql_query('SELECT * FROM `forum_sub` ORDER BY `id` DESC');

  while($row = mysql_fetch_array($q)) {

  

?>

                                                          <li>     <a href="/forum/sub/<?=$row['id']?>/"><img src="/images/icons/sub_forum_0.png" width="16" height="16" alt="">  <?=$row['name']?></a>
</li>

<?


  if($_GET['adm'] == true && $user['access'] == 3) {

?>
<li>
<h5><a href='/forum/?adm=true&id=<?=$row['id']?>&delete=true'>(Удалить)</a></h5>
</li>

<li>
<h5><a href='/forum/?adm=true&id=<?=$row['id']?>'>(Редактировать)</a></h5>
</li>
<?

  }

?>
<?
  
  }

?>


<?

  if($user['access'] == 3) {

?>

 <li>
 <a href='/forum/<?=($_GET['adm'] == true ? '':'?adm=true')?>' <?=($_GET['adm'] == true ? 'style=\'color: #909090;\'':'')?>><img src='/images/icons/right_blue.png' alt=''/> Управление форумом</a></li>

<?

  if($_GET['adm'] == true) {

?>

  <li><a href='/forum/?create=true'><img src='/images/icons/right_blue.png' alt=''/> Создать раздел</a></li>


<?
  
  }
  
  }

?>

</div>
<?

  }
  else
  {

?>


</div>

<?

  }
  
include './system/f.php';

  }
  elseif($sub) {
  
  $sub = mysql_query('SELECT * FROM `forum_sub` WHERE `id` = "'.$sub.'"');
  $sub = mysql_fetch_array($sub);

  if(!$sub) {
  
      header('location: /forum');
  
  exit;
  
  }

if($_GET['create'] == true && $user['access'] >= $sub['access']) {

    $title = 'Новое  обсуждения';    

include './system/h.php';

?>



<?

  if($user['save'] == 1) {


     $name = _string($_POST['name']);
              $text = _string($_POST['text']);

        $zakr = _string($_POST['zakr']);

  if($name && $text) {
    
  if($user['level'] > 14) {
  
    /**
     * для новостей 
     */
    if ($sub['id'] == 13)
    {
      mysql_query("UPDATE `users`  SET `news_read`='1' WHERE `news_read`='0'");
    }
    /**
     * Конец Для новостей 
     */

      mysql_query('INSERT INTO `forum_topic` (`sub`,
                                             `name`,
                                             `user`,
                                             `text`,
                                             `time`, `close`) VALUES ("'.$sub['id'].'",
                                                                  "'.$name.'",
                                                            "'.$user['id'].'",
                                                                  "'.$text.'",
                                                                 "'.time().'", "'.$zakr.'")');
  
    $topic_id = mysql_insert_id();
  
    header('location: /forum/topic/'.$topic_id.'/');
  
  }
  else
  {

?>

<div class="block">Обсуждения можно создавать с <img src='/images/icons/level.png' alt=''/> 15 уровня!</div>

<?
  
  }
  
  }

?>


<div class="content"><div class="block center color3 s125"><a href="/forum/sub/<?=$sub['id']?>"><?=$sub['name']?></a>/ Новое обсуждение</div>
            <div class="line"></div><div class="block">
    <form action="/forum/sub/<?=$sub['id']?>/?create=true" method="post">
<div class="form-group field-topicform-name required">
<label class="control-label" for="topicform-name">Название</label>
<input type="text" class="form-control" name="name">

<? if($user['access'] >1){?>
  Открыть/Закрыть:<br/>
    <select name='zakr'>
    <option value='0'>Открыть</option>
    <option value='1'>Закрыть</option>
    </select>
<br/>
<?}?>
<div class="help-block"></div>
</div>    <div class="form-group field-topicform-text required">
<label class="control-label" for="topicform-text">Описание</label>
<textarea class="form-control" name="text" rows="10"></textarea>

<div class="help-block"></div>
</div>    <span class="m3 btn_start middle"><span class="btn_end"><button type="submit" class="btn">Сохранить</button></span></span>
    </form></div>
<div class="dotted"></div>
<div class="block">
    Для форматирования обсуждений, вы можете использовать специальные BB коды:<br/>
    [b]жирный[/b] - <b>жирный</b> <br/>
    [i]наклонный[/i] - <i>наклонный</i> <br/>
    [u]подчёркнутый[/u] - <span style="text-decoration: underline">подчёркнутый</span><br/>
    [color=red]цвет[/color] - <span style="color: red">цвет</span><br/>
</div>
<div class="dotted"></div>
<div class="block">
    Ключевые значения цветов для тэга [color] <br/>
    Gray - <span style="color: gray">серый</span><br/>
    Silver - <span style="color: silver">серебрянный</span><br/>
    White - <span style="color: white">белый</span><br/>
    Fuchsia - <span style="color: fuchsia">розовый</span><br/>
    Purple - <span style="color: purple">пурпурный</span><br/>
    Red - <span style="color: red">красный</span><br/>
    Maroon - <span style="color: maroon">бордовый</span><br/>
    Yellow - <span style="color: yellow">жёлтый</span><br/>
    Olive - <span style="color: olive">оливковый</span><br/>
    Lime - <span style="color: olive">лаймовый</span><br/>
    Green - <span style="color: green">зелёный</span><br/>
    Aqua - <span style="color: aqua">голубой</span><br/>
    Blue - <span style="color: blue">синий</span><br/>
    Teal - <span style="color: teal">травянной</span><br/>
</div>
<div class="dotted"></div>
<div class="block">
    Заголовки:<br/>
    <h1>[h1]Заголовок 1[/h]</h1>
    <h2>[h2]Заголовок 2[/h]</h2>
    <h3>[h3]Заголовок 3[/h]</h3>
    <h4>[h4]Заголовок 4[/h]</h4>
    <h5>[h5]Заголовок 5[/h]</h5>
    <h6>[h6]Заголовок 6[/h]</h6>
</div>
<div class="dotted"></div>
<div class="block">
    <div style="text-align: center">[center]текст по-центру[/center]</div>
    <div style="text-align: left">[left]текст по-левому краю[/left]</div>
    <div style="text-align: right">[right]текст по-правому краю[/right]</div>
</div>
<div class="dotted"></div>
<div class="block">
    [hr]линия
 
</div>

<?

  
  }
  else
  {

?>

<div class="block">Для создания топика вам нужно сохранить своего персонажа</div>

<?
  
  }


include './system/f.php';  


}
else
{

    $title = $sub['name'];    

include './system/h.php';  

?>

  <div class="content"><div class="block center color3 s125"><a href="/forum">Форум</a>/ <img src="/images/icons/back.png" alt=""> <a href="?"><?=$title?></a></div>
            <div class="line"></div>    <div class="menu">    
                                                



<?

    $max = 10;
  $count = mysql_result(mysql_query('SELECT COUNT(*) FROM `forum_topic` WHERE `sub` = "'.$sub['id'].'"'),0);
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



<?

$q = mysql_query('SELECT * FROM `forum_topic` WHERE `sub` = "'.$sub['id'].'" ORDER BY `stick` DESC, `id` DESC LIMIT '.$start.', '.$max.'');
  while($row = mysql_fetch_array($q)) {
  
  $i++;


?>

                                                
                                                
                                                    <li><a href="/forum/topic/<?=$row['id']?>/"><img src="/images/icons/topic_closed_<?=($row['close'] == 0 ? 0:1)?>.png" width="16" height="16" alt=""> <?=$row['name']?> <span class="color2">*</span></a></li>



<?

  }
  
?>

   <div class="dotted"></div>
<ul class="pagination"><li class="next"><?=pages('/forum/sub/'.$sub['id'].'/?');?></li></ul>

<?
  
  }
  else
  {

?>

<div class="dotted"></div>
    <div class="block">Форум пуст</div>
<?

  }

?>


<div class="dotted"></div>
<div class="block color2 small">
    <img src="/images/icons/dialog.png" alt=""> ... </div>
<?

  if($user['access'] >= $sub['access']) {

?>

 <div class="line"></div>
  <li><a href="/forum/sub/<?=$sub['id']?>/?create=true"><img src="/images/icons/plus.png" width="16" height="16" alt=""> Создать обсуждение</a></li></div></div>


<?

  }
?>
</div>
<?

include './system/f.php';

}

}
elseif($topic) {

  $topic = mysql_query('SELECT * FROM `forum_topic` WHERE `id` = "'.$topic.'"');
  $topic = mysql_fetch_array($topic);

  if(!$topic) {
  
      header('location: /forum');
  
  exit;
  
  }

    $title = $topic['name'];

include './system/h.php';  

  $topic_user = mysql_query('SELECT * FROM `users` WHERE `id` = "'.$topic['user'].'"');
  $topic_user = mysql_fetch_array($topic_user);


?>

    <div class="content"><div class="block center color3 s125"><a href="/forum/sub/<?=$topic['sub']?>/">Форум</a>/ <img src="/images/icons/back.png" alt=""> <a href="/forum/topic/<?=$topic['id']?>/"><?=$title?></a></div>
            <div class="line"></div>






<?

if($_GET['adm'] == true && $user['access'] > 0) {

?>

<div class='content'>

<div class="h-navig"><table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tbody><tr>
<td class="h-navig-item"><a href="/forum/topic/red/<?=$topic['id']?>">Редактировать</a></td>
<td class="h-navig-item"><a href="/forum/topic/<?=$topic['id']?>/?stick=true"><?=($topic['stick'] == 0 ? 'Закрепить':'Открепить')?></a></td><td class="h-navig-item"><a href="/forum/topic/<?=$topic['id']?>/?close=true"><?=($topic['close'] == 0 ? 'Закрыть':'Открыть')?></a></td><td class="h-navig-item"><a href="/forum/topic/<?=$topic['id']?>/?delete=true">Удалить</a></td>
</tr></tbody></table></div>

</div>
 <div class='line'></div>

<?

}

$w_1 = mysql_query('SELECT * FROM `inv` WHERE `user` = "'.$topic_user['id'].'" AND `id` = "'.$topic_user['w_1'].'"');
$w_1 = mysql_fetch_array($w_1);
if(!$w_1) {
  $w_1['item'] = 0;
}
$w_1_item = mysql_query('SELECT * FROM `items` WHERE `id` = "'.$w_1['item'].'"');
$w_1_item = mysql_fetch_array($w_1_item);

$w_2 = mysql_query('SELECT * FROM `inv` WHERE `user` = "'.$topic_user['id'].'" AND `id` = "'.$topic_user['w_2'].'"');
$w_2 = mysql_fetch_array($w_2);
if(!$w_2) {
  $w_2['item'] = 0;
}

$w_2_item = mysql_query('SELECT * FROM `items` WHERE `id` = "'.$w_2['item'].'"');
$w_2_item = mysql_fetch_array($w_2_item);

$w_3 = mysql_query('SELECT * FROM `inv` WHERE `user` = "'.$topic_user['id'].'" AND `id` = "'.$topic_user['w_3'].'"');
$w_3 = mysql_fetch_array($w_3);
if(!$w_3) {
  $w_3['item'] = 0;
}

$w_3_item = mysql_query('SELECT * FROM `items` WHERE `id` = "'.$w_3['item'].'"');
$w_3_item = mysql_fetch_array($w_3_item);


$w_4 = mysql_query('SELECT * FROM `inv` WHERE `user` = "'.$topic_user['id'].'" AND `id` = "'.$topic_user['w_4'].'"');
$w_4 = mysql_fetch_array($w_4);

if(!$w_4) {
  $w_4['item'] = 0;
}

$w_4_item = mysql_query('SELECT * FROM `items` WHERE `id` = "'.$w_4['item'].'"');
$w_4_item = mysql_fetch_array($w_4_item);

$w_5 = mysql_query('SELECT * FROM `inv` WHERE `user` = "'.$topic_user['id'].'" AND `id` = "'.$topic_user['w_5'].'"');
$w_5 = mysql_fetch_array($w_5);
if(!$w_5) {
  $w_5['item'] = 0;
}
$w_5_item = mysql_query('SELECT * FROM `items` WHERE `id` = "'.$w_5['item'].'"');
$w_5_item = mysql_fetch_array($w_5_item);

$w_6 = mysql_query('SELECT * FROM `inv` WHERE `user` = "'.$topic_user['id'].'" AND `id` = "'.$topic_user['w_6'].'"');
$w_6 = mysql_fetch_array($w_6);
if(!$w_6) {
  $w_6['item'] = 0;
}
$w_6_item = mysql_query('SELECT * FROM `items` WHERE `id` = "'.$w_6['item'].'"');
$w_6_item = mysql_fetch_array($w_6_item);

$w_7 = mysql_query('SELECT * FROM `inv` WHERE `user` = "'.$topic_user['id'].'" AND `id` = "'.$topic_user['w_7'].'"');
$w_7 = mysql_fetch_array($w_7);
if(!$w_7) {
  $w_7['item'] = 0;
}
$w_7_item = mysql_query('SELECT * FROM `items` WHERE `id` = "'.$w_7['item'].'"');
$w_7_item = mysql_fetch_array($w_7_item);

$w_8 = mysql_query('SELECT * FROM `inv` WHERE `user` = "'.$topic_user['id'].'" AND `id` = "'.$topic_user['w_8'].'"');
$w_8 = mysql_fetch_array($w_8);
if(!$w_8) {
  $w_8['item'] = 0;
}
$w_8_item = mysql_query('SELECT * FROM `items` WHERE `id` = "'.$w_8['item'].'"');
$w_8_item = mysql_fetch_array($w_8_item);


 $count = mysql_result(mysql_query('SELECT COUNT(*) FROM `forum_comments` WHERE `topic` = "'.$topic['id'].'"'),0);
?>

<div class="block">
<?
if($topic_user['r'] == 0) {
?>
       <a class="left mr8" href="/user/<?=$topic_user['id']?>/"><img src="http://bespredel.mobi/maneken?sex=man&amp;width=120&amp;height=160&amp;fragment=1&amp;frame=&amp;equip%5B1%5D=<?=$w_1['item']?>&amp;equip%5B2%5D=<?=$w_2['item']?>&amp;equip%5B3%5D=<?=$w_3['item']?>&amp;equip%5B4%5D=<?=$w_4['item']?>&amp;equip%5B5%5D=<?=$w_5['item']?>&amp;equip%5B6%5D=<?=$w_6['item']?>&amp;equip%5B7%5D=<?=$w_7['item']?>&amp;equip%5B8%5D=<?=$w_8['item']?>" width="50" height="50" alt=""></a>


<?
}
if($topic_user['r'] == 1) {
?>
       <a class="left mr8" href="/user/<?=$topic_user['id']?>/"><img src="http://bespredel.mobi/maneken?sex=woman&amp;width=120&amp;height=160&amp;fragment=1&amp;frame=&amp;equip%5B1%5D=<?=$w_1['item']?>&amp;equip%5B2%5D=<?=$w_2['item']?>&amp;equip%5B3%5D=<?=$w_3['item']?>&amp;equip%5B4%5D=<?=$w_4['item']?>&amp;equip%5B5%5D=<?=$w_5['item']?>&amp;equip%5B6%5D=<?=$w_6['item']?>&amp;equip%5B7%5D=<?=$w_7['item']?>&amp;equip%5B8%5D=<?=$w_8['item']?>" width="50" height="50" alt=""></a>


<?
}
?>
            

<?
if($topic_user['vip'] == 0 && $topic_user['access'] == 0){
?>
<img src="/images/icons/<?=$topic_user['r']?>.png" width="16" height="16" alt="">
<?
}

if($topic_user['access'] == 1) {
?>
<img src="/images/icons/mod.png" width="16" height="16" alt="">
<?}
if($topic_user['access'] == 2) {
?>
<img src="/images/icons/mod.png" width="16" height="16" alt="">
<?}
if($topic_user['access'] == 3) {
?>
<img src="/images/icons/adminy.png" width="16" height="16" alt="">
<?
}
if($topic_user['vip'] == 1 && $topic_user['access'] == 0){
?>
<img src="/images/icons/vip_<?=($topic_user['r'] == man ? 'woman':'man')?>_<?=$topic_user['r']?>.png" width="16" height="16" alt="">
<?
}
?>
 <a href="/user/<?=$topic_user['id']?>/"><span><?=$topic_user['login']?></span></a>        <span class="white">
    
    <img src="/images/icons/level.png" width="16" height="16" alt=""> <?=$topic_user['level']?> ур.    </span>
    <div>
            
    <img src="/images/icons/currentHealth.png" width="16" height="16" alt=""> <?=$topic_user['vit']?>            
    <img src="/images/icons/damage.png" width="16" height="16" alt=""> <?=$topic_user['str']?>            
    <img src="/images/icons/armor.png" width="16" height="16" alt=""> <?=$topic_user['def']?>        </div>
<div class="clear"></div>
</div><div class="dotted"></div>
<div class="block">
    <div class="small right">
        <img src="/images/icons/dialog.png" alt=""> <b><?=$count?></b>
                    <img src="/images/icons/bullet_grey.png" width="16" height="16" alt="">                <span class="color2"><img src="/images/icons/date.png" alt=""> <?=(date('d ', $topic['time']) . $monthes[(date('n', $topic['time']))] . date(' H:i', $topic['time']));?>
</span>
    </div>



<?

  if($topic_user['access'] == 1) {
  
?>
<font color='f09060'>
<?
  
  }
  
  if($topic_user['access'] == 2) {
  
?>
<font color='008080'>
<?
  
  }

 if($topic_user['access'] == 3) {
  
?>
<font color='90c0c0'>
<?
  
  }

?>


    <div class="clear"></div>
<?=bbc(smiles($topic['text']))?></div>

<?

  if($topic_user['access'] > 0) {
  
?>
</font>
<?
  
  }

?>


<?

      if($user['access'] > 0) {
  
   if($_GET['stick'] == true) {

    mysql_query('UPDATE `forum_topic` SET `stick` = "'.($topic['stick'] == 0 ? 1:0).'" WHERE `id` = "'.$topic['id'].'"');
  
  header('location: /forum/topic/'.$topic['id'].'/?adm=true');
  
  }
  
   if($_GET['close'] == true) {

    mysql_query('UPDATE `forum_topic` SET `close` = "'.($topic['close'] == 0 ? 1:0).'" WHERE `id` = "'.$topic['id'].'"');
  
  header('location: /forum/topic/'.$topic['id'].'/?adm=true');
  
  }

if($_GET['delete'] == true) {

    $q = mysql_query('SELECT * FROM `forum_comments` WHERE `topic` = "'.$topic['id'].'"');
    while($row = mysql_fetch_array($q)) {
      mysql_query('DELETE FROM `forum_comments` WHERE `id` = "'.$row['id'].'"');
    }

  header('location: /forum/sub/'.$topic['sub'].'/?adm=true');
  
    mysql_query('DELETE FROM `forum_topic` WHERE `id` = "'.$topic['id'].'"');

  }


?>

<div class="dotted"></div>
<div class="menu">
  <li><a href='/forum/topic/<?=$topic['id']?>/<?=($_GET['adm'] == true ? '':'?adm=true')?>' <?=($_GET['adm'] == true ? 'style=\'color: #909090;\'':'')?>>Управление</a></li>
</div>

<?

  }



 


?>


<div class="line"></div>
<?




  if($count > 0) {


?>

<?

    $max = 10;

 $count = mysql_result(mysql_query('SELECT COUNT(*) FROM `forum_comments` WHERE `topic` = "'.$topic['id'].'"'),0);

  $pages = ceil($count/$max);
   $page = _string(_num($_GET['page']));

    if($page > $pages) {
    
   $page = $pages;
    
    }
  
    if($page < 1) {
    
   $page = 1;
    
    }
    
  $start = $page * $max - $max;

$q = mysql_query('SELECT * FROM `forum_comments` WHERE `topic` = "'.$topic['id'].'" ORDER BY `id` LIMIT '.$start.', '.$max.'');

  while($row = mysql_fetch_array($q)) {

  $comment_user = mysql_query('SELECT * FROM `users` WHERE `id` = "'.$row['user'].'"');
  $comment_user = mysql_fetch_array($comment_user);

?>


        <div class="dotted"></div>
            <div class="block">
 
<?
if($comment_user['vip'] == 0 && $comment_user['access'] == 0){
?>
<img src="/images/icons/<?=$comment_user['r']?>.png" width="16" height="16" alt="">
<?
}

if($comment_user['access'] == 1) {
?>
<img src="/images/icons/mod.png" width="16" height="16" alt="">
<?}
if($comment_user['access'] == 2) {
?>
<img src="/images/icons/mod.png" width="16" height="16" alt="">
<?}
if($comment_user['access'] == 3) {
?>
<img src="/images/icons/adminy.png" width="16" height="16" alt="">
<?
}
if($comment_user['vip'] == 1 && $comment_user['access'] == 0){
?>
<img src="/images/icons/vip_<?=($comment_user['r'] == man ? 'woman':'man')?>_<?=$comment_user['r']?>.png" width="16" height="16" alt="">
<?
}
?>
 <a class="color3" href="/user/<?=$comment_user['id']?>/"><?=$comment_user['login']?></a> 

<?
  if($comment_user['access'] == 1) {
  
?>
<font color='f09060'>
<?
  
  }
  
  if($comment_user['access'] == 2) {
  
?>
<font color='008080'>
<?
  
  }
  
  if($comment_user['access'] == 3) {
  
?>
<font color='90c0c0'>
<?
  
  }

?>

<?=bb(smiles($row['text']))?>

</font>
     <div class="small"><span class="color2">
<?=(date('d ', $row['time']) . $monthes[(date('n', $row['time']))] . date(' H:i', $row['time']));?>
  </span>
<?

    if($row['to']) {

      $__to = mysql_query('SELECT * FROM `users` WHERE `id` = "'.$row['to'].'"');
      $__to = mysql_fetch_array($__to);

if($__to['id'] == $user['id']) {

?>

<font color='#90c090'>

<?

    }

?>

| <a class="color2" href="/user/<?=$__to['id']?>/"><?=$__to['login']?></a> 

<?



if($__to['id'] == $user['id']) {

?>

</font>

<?

    }
    
    }
?>

<?
if($comment_user['id'] != $user['id']) {
if($topic['close'] == 0){
?>

|
<a href="/forum/topic/<?=$topic['id']?>/?page=<?=$page?>&to=<?=$comment_user['id']?>">ответить</a>                                            
<?
}
}
?>
<?

  if($comment_user['access'] > 0) {
  
?>


   

<?
  
  }
  
  if($user['access'] > 0) {

$comment = _string(_num($_GET['comment']));

             if($comment) {
  
    mysql_query('DELETE FROM `forum_comments` WHERE `id` = "'.$comment.'"');

    header('location: /forum/topic/'.$topic['id'].'/?page='.$page);

  }

?>

<a href='/forum/topic/<?=$topic['id']?>/?page=<?=$page?>&comment=<?=$row['id']?>'>[x]</a>

<?
  
  }

?>


</div></div>
<?

  }

?>

   <div class="dotted"></div>
<ul class="pagination"><li class="next"><?=pages('/forum/topic/'.$topic['id'].'/?');?></li></ul>


<?

  }
?>


<?

  if($topic['close'] == 0) {

  if($user['save'] == 1) {

  if($user['level'] > 5) {

$text = _string($_POST['text']);

  $to = _string(_num($_GET['to']));



  if($to) {

      $_to = mysql_query('SELECT * FROM `users` WHERE `id` = "'.$to.'"');
      $_to = mysql_fetch_array($_to);
  
  if(!$_to OR $_to['id'] == $user['id']) {

    header('location: /forum/topic/'.$topic['id'].'/?page='.$page);
    
  exit;
  
  }
  
}
  
  if($text) {


  if($_to) {
  
    $text = str_replace($_to['login'].', ', '', $text);
  
mysql_query("INSERT INTO `journal` SET  `from`='".$_to['id']."', 
						                                 `text`='Вам ответили на форуме [$text] <a href=/forum/topic/$topic[id]/>Перейти</a>',
						                                  `read`='0',
                                                              `time`='".time()."',`us`='".$user['id']."'");  
  }

 
$comm = mysql_fetch_array(mysql_query('SELECT * FROM `forum_comments` WHERE `user` = \''.$user['id'].'\' ORDER BY `time` DESC LIMIT 1'));
if(time() - $comm['time'] < 35) $errors[] = 'Ошибка';

$BanChat = mysql_query('SELECT * FROM `banned` WHERE `user` = "'.$user['id'].'" AND `forum` = "1"');
    while($BanChat = mysql_fetch_array($BanChat))
    {
		if(time() - $BanChat['time']) $errors[] = '<div class="alert"><div>                                     <div class="blue">На вас наложен бан </div><span>Осталось:'._time($BanChat['time'] - time()).'
</div></span>Причина: '.$BanChat['text'].'</div><div class="alert_bottom"></div>';
	}
 if($errors) {
    
      echo '<div class=\'content\' align=\'center\'>';
      
      foreach($errors as $error) {
        
        echo $error.'<br/>';
        
      }
    
      echo '</div>
      <div class=\'line\'></div>';
    
    }
    else
    {
    mysql_query('INSERT INTO `forum_comments` (`topic`,`user`,`to`,`text`,`time`) VALUES ("'.$topic['id'].'", "'.$user['id'].'", "'.$_to['id'].'", "'.$text.'", "'.time().'")');
  
  header('location: /forum/topic/'.$topic['id'].'/?page='.$pages);
  
}


}
  

?>


<img src="/images/icons/emoji/smile.png" width="16" height="16" alt="">&nbsp;<a id="toggler" class="tdnone dashed" href="/chat/?nocache=618470201#?nocache=1782656872">Показать смайлы</a><div id="smiles" style="display: none;">
            <img src="/images/icons/emoji/1.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:)&#039;)">            <img src="/images/icons/emoji/2.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:-D&#039;)">            <img src="/images/icons/emoji/3.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;;-)&#039;)">            <img src="/images/icons/emoji/4.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;xD&#039;)">            <img src="/images/icons/emoji/5.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;;-P&#039;)">            <img src="/images/icons/emoji/6.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;8-)&#039;)">            <img src="/images/icons/emoji/7.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:]&#039;)">            <img src="/images/icons/emoji/8.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;3(&#039;)">            <img src="/images/icons/emoji/9.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:_-(&#039;)">            <img src="/images/icons/emoji/10.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:_(&#039;)">            <img src="/images/icons/emoji/11.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:|&#039;)">            <img src="/images/icons/emoji/12.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;8|&#039;)">            <img src="/images/icons/emoji/13.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;^3&#039;)">            <img src="/images/icons/emoji/14.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;(XX)&#039;)">            <img src="/images/icons/emoji/15.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;|O^&#039;)">            <img src="/images/icons/emoji/16.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;^FU^&#039;)">            <img src="/images/icons/emoji/17.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;^((&#039;)">            <img src="/images/icons/emoji/18.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;^zz&#039;)">            <img src="/images/icons/emoji/19.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:*&#039;)">            <img src="/images/icons/emoji/20.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:^|&#039;)">            <img src="/images/icons/emoji/21.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:(x)&#039;)">            <img src="/images/icons/emoji/22.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:pf&#039;)">            <img src="/images/icons/emoji/23.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;O^^O&#039;)">            <img src="/images/icons/emoji/24.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;}:}&#039;)">            <img src="/images/icons/emoji/25.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;}:{&#039;)">            <img src="/images/icons/emoji/26.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:like:&#039;)">            <img src="/images/icons/emoji/27.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:dislike:&#039;)">            <img src="/images/icons/emoji/28.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:up:&#039;)">            <img src="/images/icons/emoji/29.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:v:&#039;)">            <img src="/images/icons/emoji/30.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:ok:&#039;)">            <img src="/images/icons/emoji/31.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:beer:&#039;)">            <img src="/images/icons/emoji/32.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:banan:&#039;)">            <img src="/images/icons/emoji/33.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;rose&#039;)">            <img src="/images/icons/emoji/34.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:pitushok:&#039;)">            <img src="/images/icons/emoji/35.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:sos:&#039;)">            <img src="/images/icons/emoji/36.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:cel:&#039;)">            <img src="/images/icons/emoji/37.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:crown:&#039;)">            <img src="/images/icons/emoji/38.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:baby:&#039;)">            <img src="/images/icons/emoji/39.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:boom:&#039;)">            <img src="/images/icons/emoji/40.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:gun:&#039;)">            <img src="/images/icons/emoji/41.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:love:&#039;)">            <img src="/images/icons/emoji/42.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:hurt:&#039;)">            <img src="/images/icons/emoji/43.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:police:&#039;)">            <img src="/images/icons/emoji/44.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:bolls:&#039;)">            <img src="/images/icons/emoji/45.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:ear:&#039;)">            <img src="/images/icons/emoji/46.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:fuck:&#039;)">            <img src="/images/icons/emoji/47.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:smoke:&#039;)">            <img src="/images/icons/emoji/48.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:donate:&#039;)">            <img src="/images/icons/emoji/49.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:gold:&#039;)">            <img src="/images/icons/emoji/50.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:silver:&#039;)">            <img src="/images/icons/emoji/51.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:health:&#039;)">            <img src="/images/icons/emoji/52.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:damage:&#039;)">            <img src="/images/icons/emoji/53.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:armor:&#039;)">            <img src="/images/icons/emoji/54.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:energy:&#039;)">            <img src="/images/icons/emoji/vp1.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:vp1:&#039;)">            <img src="/images/icons/emoji/vp2.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:vp2:&#039;)">            <img src="/images/icons/emoji/vp3.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:vp3:&#039;)">            <img src="/images/icons/emoji/vp4.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:vp4:&#039;)">            <img src="/images/icons/emoji/vp5.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:vp5:&#039;)">            <img src="/images/icons/emoji/vp6.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:vp6:&#039;)">            <img src="/images/icons/emoji/vp7.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:vp7:&#039;)">            <img src="/images/icons/emoji/vp8.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:vp8:&#039;)">            <img src="/images/icons/emoji/vp9.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:vp9:&#039;)">            <img src="/images/icons/emoji/vp10.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:vp10:&#039;)">            <img src="/images/icons/emoji/vp11.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:vp11:&#039;)">            <img src="/images/icons/emoji/vp12.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:vp12:&#039;)">            <img src="/images/icons/emoji/vp13.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:vp13:&#039;)">            <img src="/images/icons/emoji/vp14.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:vp14:&#039;)">            <img src="/images/icons/emoji/vp15.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:vp15:&#039;)">            <img src="/images/icons/emoji/vp16.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:vp16:&#039;)">            <img src="/images/icons/emoji/vp17.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:vp17:&#039;)">            <img src="/images/icons/emoji/vp18.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:vp18:&#039;)">
<img src="/images/icons/sm/sm1.gif" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:sm1:&#039;)">    <img src="/images/icons/sm/sm2.gif" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:sm2:&#039;)">    <img src="/images/icons/sm/sm3.gif" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:sm3:&#039;)">    <img src="/images/icons/sm/sm4.gif" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:sm4:&#039;)">    <img src="/images/icons/sm/sm5.gif" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:sm5:&#039;)">    <img src="/images/icons/sm/sm6.gif" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:sm6:&#039;)">    <img src="/images/icons/sm/sm7.gif" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:sm7:&#039;)">    <img src="/images/icons/sm/sm8.gif" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:sm8:&#039;)">    <img src="/images/icons/sm/sm9.gif" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:sm9:&#039;)">    <img src="/images/icons/sm/sm10.gif" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:sm10:&#039;)">    <img src="/images/icons/sm/sm11.gif" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:sm11:&#039;)">    <img src="/images/icons/sm/sm12.gif" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:sm12:&#039;)">    <img src="/images/icons/sm/sm13.gif" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:sm13:&#039;)"> <img src="/images/icons/sm/sm14.gif" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:sm14:&#039;)">  <img src="/images/icons/sm/sm15.gif" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:sm15:&#039;)">    <img src="/images/icons/sm/sm16.gif" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:sm16:&#039;)">    <img src="/images/icons/sm/sm17.gif" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:sm17:&#039;)">    <img src="/images/icons/sm/sm18.gif" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:sm18:&#039;)">    <img src="/images/icons/sm/sm19.gif" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:sm19:&#039;)">    <img src="/images/icons/sm/sm20.gif" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:sm20:&#039;)">    <img src="/images/icons/sm/sm21.gif" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:sm21:&#039;)">    <img src="/images/icons/sm/sm22.gif" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:sm22:&#039;)">    <img src="/images/icons/sm/sm23.gif" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:sm23:&#039;)">    <img src="/images/icons/sm/sm24.gif" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:sm24:&#039;)">
<img src="/images/icons/sm/sm25.gif" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:sm25:&#039;)">    
    </div>      
  <form id="comment" action="/forum/topic/<?=$topic['id']?>/?page=<?=$page?>&to=<?=$to?>" method="post">
<div class="form-group field-text required">
<label class="control-label" for="text">Комментарий</label>
<textarea class="form-control" name="text" rows="10"><?=($to ? $_to['login'].', ':'')?></textarea>

<div class="help-block"></div>
</div>        <div class="form-group field-topicmessageform-topic_id">
<div class="help-block"></div>
</div>        <span class="m3 btn_start middle"><span class="btn_end"><button type="submit" class="btn">Отправить</button></span></span>
        </form>    </div>
           

<?
  }
  else
  {

?>

<div class="block">Писать на форуме можно с <img src='/images/icons/level.png' alt=''/> 5 уровня</div>

<?
  
  }
  
  }
  else
  {

?>

<div class="block ">Для общения на форуме вам нужно сохранить своего персонажа</div>

<?
  
  }
  
  }
  else
  {

?>


<div class="dotted"></div>
    <div class="block red">Обсуждение закрыто</div>

<?
  
  }

?>


</div>

<?

include './system/f.php';  

}

?>