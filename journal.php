<?
# All author: XxxDIABLOxxX
# pabl mosule
# journal.php
   
include './system/common.php';
    
include './system/functions.php';
         
include './system/user.php';

if(!$user) {
    header('location: /'); 
    exit; 
	}

$title = 'Журнал';

include './system/h.php';
# title
echo '<div class="content"><div class="block center color3 s125"><a href="/user/'.$user['id'].'">'.$user['login'].'</a>/ Журнал</div>
<div class="line"></div>
';
  
# page
    $max = 10;
  $count = mysql_result(mysql_query('SELECT COUNT(*) FROM `journal` WHERE `from` = "'.$user['id'].'" ORDER BY `time`'),0);
  $pages = ceil($count/$max);
   $page = _string(_num($_GET['page']));

  if($page > $pages) $page = $pages;

  if($page < 1) $page = 1;
    
  $start = $page * $max - $max;

  if($count > 0) {
	  
$q = mysql_query('SELECT * FROM `journal` WHERE `from` = "'.$user['id'].'" ORDER BY `time` DESC LIMIT '.$start.', '.$max.'');
while($row = mysql_fetch_array($q)) {	  
# read for msg user
if($row['read'] == 0) mysql_query('UPDATE `journal` SET `read` = "1" WHERE `from` = "'.$user['id'].'"');
# msg user number count
$us=mysql_fetch_array(mysql_query('SELECT * FROM `users` WHERE `id` = "'.$row['us'].'" LIMIT 1'));
        
?>
<?
if($us['vip'] == 0 && $us['access'] == 0){
?>
<img src="/images/icons/<?=$us['r']?>.png" width="16" height="16" alt="">
<?
}

if($us['access'] == 1) {
?>
<img src="/images/icons/mod.png" width="16" height="16" alt="">
<?
}

if($us['access'] == 2) {
?>
<img src="/images/icons/mod.png" width="16" height="16" alt="">
<?}
if($us['access'] == 3) {
?>
<img src="/images/icons/adminy.png" width="16" height="16" alt="">
<?
}
if($us['vip'] == 1 && $us['access'] == 0){
?>
<img src="/images/icons/vip_<?=($us['r'] == man ? 'woman':'man')?>_<?=$us['r']?>.png" width="16" height="16" alt="">
<?
}
$color=$us['color'];
			?>
  <a class="color3" href="/user/<?=$us['id']?>/"><font style="text-shadow: 0px 5px 6px;" color=#<?=$color?>><?=$us['login']?> </font></a>

<?
    if($us['access'] == 1) {
?>
<font color='#f09060'>
<?
    }
    if($us['access'] == 2) {
?>
<font color='#008080'>
<?
    }
    if($us['access'] == 3) {
?>
<font color='#90c0c0'>
<?
    }
?>
                  <div class=""> <?=smiles($row['text'])?>
</div>
</font>
 <?=(date('d ', $row['time']) . $monthes[(date('n', $row['time']))] . date(' H:i', $row['time']));?>
 <div class="dotted"></div>
<?
}

  }else{
?>
    
<div class="block">Журнал пуст</div>
<?
}
?>


 <div class="dotted"></div>
<ul class="pagination"><li class="next"><?=pages('?');?></li></ul>

</div>
<?
  include './system/f.php';
?>