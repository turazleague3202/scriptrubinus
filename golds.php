<?
    
    include './system/common.php';
    
 include './system/functions.php';
        
      include './system/user.php';
        
    $title = 'Лог'; 

   include './system/h.php';  



$id = _string(_num($_GET['id']));
  if($id) {
    $i = mysql_query('SELECT * FROM `users` WHERE `id` = "'.$id.'"');
    $i = mysql_fetch_array($i);
    
    if(!$i) {
      header('location: /user/');
      exit;
    }

    }
    else
    { 
      $i = $user;
    }

$a=mysql_fetch_array(mysql_query('SELECT * FROM `users` WHERE `id` = "'.$i['id'].'" LIMIT 1'));
    
    if(!$user) {
header:('location:/');
}


?>
<div class="content"><div class="block center color3 s125"><a href="/user/<?=$i['id']?>"><?=$i['login']?></a>/ log </div>
<div class="line"></div>
<div class="h-navig"><table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tbody><tr><td class="h-navig-item"><a href="?cop=1">погоняло</a></td><td class="h-navig-item"><a href="?cop=2">Улучшения шмотки</a></td><td class="h-navig-item"><a href="?cop=3">Покупка шмотки</a></td><td class="h-navig-item"><a href="?cop=4">Обменник</a></td><td class="h-navig-item"><a href="?cop=5">Амулет</a></td></tr></tbody></table></div><div class="line"></div>
<?

$cop = _string(_num($_GET['cop']));

if($cop){

  if($cop == 1 OR $cop == 2 OR $cop == 3 OR $cop == 4 OR $cop == 5 OR $cop == 6) {
    

  }
$max = 5;
  $count = mysql_result(mysql_query('SELECT COUNT(*) FROM `golds` WHERE `user` = "'.$a['id'].'" AND `loc` = "'.$cop.'"'),0);
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


$delete = _string(_num($_GET['delete']));
if($delete) {
  
 if($user['access']==2){
    mysql_query('DELETE FROM `golds` WHERE `id` = "'.$delete.'"');
  
}else{
header('location: ?');
exit; }
  header('location: ?');
  
  }

 $q = mysql_query('SELECT * FROM `golds` WHERE `user` = "'.$a['id'].'" AND `loc` = "'.$cop.'" ORDER BY `time` DESC LIMIT '.$start.', '.$max.'');    
  while($row = mysql_fetch_array($q)) {
?>
<div class="dotted"></div>
            <div class="block"><?=$row['text']?>  <span class="color2 small"><?=(date('d ', $row['time']) . $monthes[(date('n', $row['time']))] . date(' H:i', $row['time']));?></span>
<? if($user['access']==2){ echo '<a href="?delete='.$row['id'].'">удалить</a> ';}?>
        </div>
<?
}
?>
 <div class="dotted"></div>
<ul class="pagination"><li class="next"><?=pages('?cop='.$cop.'&');?></li></ul>


<?
  }else{
?>
    
<div class="block">Нет лога :(</div>
<?
}
}else{


 $q = mysql_query('SELECT * FROM `golds` WHERE `user` = "'.$a['id'].'" ORDER BY `time` DESC LIMIT 8');    
  while($row = mysql_fetch_array($q)) {
?>
<div class="dotted"></div>
            <div class="block"><?=$row['text']?>  <span class="color2 small"><?=(date('d ', $row['time']) . $monthes[(date('n', $row['time']))] . date(' H:i', $row['time']));?></span>
<? if($user['access']==2){ echo '<a href="?delete='.$row['id'].'">удалить</a> ';}?>
        </div>
<?
}
}
?>
</div>
<?
   include './system/f.php';  
?>