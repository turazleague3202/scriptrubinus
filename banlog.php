<?
    
    include './system/common.php';
    
 include './system/functions.php';
        
      include './system/user.php';
        
    $title = 'banlog'; 

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

<div class="content"><div class="block center color3 s125"><a href="/user/<?=$i['id']?>"><?=$i['login']?></a>/ История нарушения</div>
<div class="line"></div>

<?

$max = 5;
  $count = mysql_result(mysql_query('SELECT COUNT(*) FROM `log_ban` WHERE `user` = "'.$a['id'].'"'),0);
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



 $q = mysql_query('SELECT * FROM `log_ban` WHERE `user` = "'.$a['id'].'" ORDER BY `id` DESC LIMIT '.$start.', '.$max.'');    
  while($row = mysql_fetch_array($q)) {


$i++;
$ank=mysql_fetch_array(mysql_query('SELECT * FROM `users` WHERE `id` = "'.$row['user'].'" LIMIT 1'));
 

echo '
<div class="dotted"></div>
            <div class="block">
            <img src="/images/icons/1.png" width="16" height="16" alt=""> <a class="color3" href="/user/'.$row['user'].'">'.$ank['login'].'</a> '.$row['text'].' <span class="color2 small">'.(date('d ', $row['time']) . $monthes[(date('n', $row['time']))] . date(' H:i', $row['time'])).'</span>
        </div>
';
        
?>
<?
}

  }else{
?>
    
<div class="block">Нет нарушении</div>
<?
}
?>


 <div class="dotted"></div>
<ul class="pagination"><li class="next"><?=pages('?');?></li></ul>

</div>
<?
   include './system/f.php';  
?>