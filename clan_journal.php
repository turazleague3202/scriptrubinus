<?
    
    include './system/common.php';
    
 include './system/functions.php';
        
      include './system/user.php';
        
    $title = 'Клановый журнал'; 

   include './system/h.php';  

   
    if(!$user && !$clan) {
header:('location:/');
}
?>
  <div class="content"><div class="block center color3 s125"><a href="/clan"><?=$clan['name']?></a>/ Журнал</div>
            <div class="line"></div>

<div class="h-navig"><table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tbody><tr><td class="h-navig-item"><a href="?cop=1">Общак</a></td><td class="h-navig-item"><a href="?cop=2">Члены банды</a></td><td class="h-navig-item"><a href="?cop=3">Подвал</a></td></tr></tbody></table></div><div class="line"></div>
     
<?

  if($clan_memb['rank'] == 4) {

?>
<div class="menu"><li><a href="?dell"><img src='/images/icons/arrow.png'>
 Очистить журнал</a></li></div><div class="dotted"></div>
<?

  }

?>

<?



$cop = _string(_num($_GET['cop']));
if($cop) {

  if($cop == 1 OR $cop == 2 OR $cop==3) {
    

  }
$max = 5;
  $count = mysql_result(mysql_query('SELECT COUNT(*) FROM `clan_journal` WHERE `cl_id` = "'.$clan['id'].'" AND `cl` = "'.$cop.'"'),0);
  $pages = ceil($count/$max);
   $page = _string(_num($_GET['page']));

    if($page > $pages) {
    
   $page = $pages;
    
    }
  
    if($page < 1) {
    
   $page = 1;
    
    }
    
  $start = $page * $max - $max;



if($cop==2) {
if($count>0) {
 $q = mysql_query('SELECT * FROM `clan_journal` WHERE `cl` = "'.$cop.'" AND `cl_id` = "'.$clan['id'].'" ORDER BY `time` DESC, `id` DESC LIMIT '.$start.', '.$max.'');    
  while($row = mysql_fetch_array($q)) {


  $i++;

?>
<div class="dotted"></div>
            <div class="block">
            <img src="/images/icons/1.png" width="16" height="16" alt=""> <a class="color3" href="/user/<?=$row['user']?>"><?=$row['login']?></a> <?=$row['text']?>  <span class="color2 small"><?=(date('d ', $row['time']) . $monthes[(date('n', $row['time']))] . date(' H:i', $row['time']));?></span>
        </div>

<?
}
 }else{
echo '<div class="dotted"></div>
    <div class="block">Журнал пуст</div>
</div>';
}

}


}


if($cop==3) {
if($count>0) {
$q = mysql_query('SELECT * FROM `clan_journal` WHERE `cl_id` = "'.$clan['id'].'"  AND `cl` = "3" ORDER BY `time` DESC, `id` DESC LIMIT 8');    
  while($row = mysql_fetch_array($q)) {


  $i++;

$a=mysql_fetch_array(mysql_query('SELECT * FROM `users` WHERE `id` = "'.$row['user'].'" LIMIT 1'));
?>

<div class="dotted"></div>
            <div class="block">
<?=$row['text']?> <span class="color2 small">,  <?=_times(time() - $row['time'])?> </span> ,
            <img src="/images/icons/<?=$a['r']?>.png" width="16" height="16" alt=""> <a class="color3" href="/user/<?=$a['id']?>/"><?=$a['login']?></a>

</div>

<?
}
}else{
echo '<div class="dotted"></div>
    <div class="block">Журнал пуст</div>
</div>';
}
}

if(!$cop OR $cop==1) {

$q = mysql_query('SELECT * FROM `clan_journal` WHERE `cl_id` = "'.$clan['id'].'"  AND `cl` = "1" ORDER BY `time` DESC, `id` DESC LIMIT 8');    
  while($row = mysql_fetch_array($q)) {


  $i++;

?>
<div class="dotted"></div>
            <div class="block">
            <img src="/images/icons/1.png" width="16" height="16" alt=""> <a class="color3" href="/user/<?=$row['user']?>"><?=$row['login']?></a> <?=$row['text']?>  <span class="color2 small"><?=(date('d ', $row['time']) . $monthes[(date('n', $row['time']))] . date(' H:i', $row['time']));?></span>
        </div>



<?
}

}

  
?>


</div>
<?
   include './system/f.php';  
?>