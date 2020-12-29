<?
    
    include './system/common.php';
    
 include './system/functions.php';
        
      include './system/user.php';
        
    $title = 'Подарки'; 

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

mysql_query('UPDATE `users` SET `gift` =  "0"WHERE `id` = "'.$user['id'].'"');
?>

<div class="content"><div class="block center color3 s125"><a href="/user/<?=$i['id']?>"><?=$i['login']?></a>/ Подарки</div>
<div class="line"></div>

<?

$max = 5;
  $count = mysql_result(mysql_query('SELECT COUNT(*) FROM `gifts` WHERE `id_user` = "'.$a['id'].'"'),0);
  $pages = ceil($count/$max);
   $page = _string(_num($_GET['page']));

    if($page > $pages) {
    
   $page = $pages;
    
    }
  
    if($page < 1) {
    
   $page = 1;
    
    }
    
  $start = $page * $max - $max;

$delete = _string(_num($_GET['delete']));
if($delete) {
    mysql_query('DELETE FROM `gifts` WHERE `id_gifts` = "'.$delete.'"');
  header('location: ?');
  }
        
if($count > 0) {



 $q = mysql_query('SELECT * FROM `gifts` WHERE `id_user` = "'.$a['id'].'" ORDER BY `time` DESC LIMIT '.$start.', '.$max.'');    
  while($row = mysql_fetch_array($q)) {


$i++;
$ank=mysql_fetch_array(mysql_query('SELECT * FROM `users` WHERE `id` = "'.$row['ot_id'].'" LIMIT 1'));
 

echo '<div class="block">
            <img src="/images/icons/'.$ank['r'].'.png" width="16" height="16" alt=""> <a class="color3" href="/user/'.$ank['id'].'">'.$ank['login'].'</a><span class="color2 small">,
               '.date('H:i:s',$row['time']).' </span>
        </div>
        <div class="dotted"></div>
        <div class="block">
            <div><img src="/images/gifts/'.$row['id_gifts'].'.png" alt=""></div>
                                                '.smiles($row['text']).'                            <div></div>';
if($user['access']==3){ echo '<a href="?delete='.$row['id_gifts'].'">удалить</a> ';}
echo'</div>
        <div class="dotted"></div>';
        
?>
<?
}

  }else{
?>
    
<div class="block">Нет подарков :(</div>
<?
}
?>


 <div class="dotted"></div>
<ul class="pagination"><li class="next"><?=pages('?');?></li></ul>

</div>
<?
   include './system/f.php';  
?>