<?

include './system/common.php';
    
include './system/functions.php';
        
include './system/user.php';


if(!$user) {

  header('location: /menu');
    
exit;

}
 if($user['level'] >= 0) {
}else{

$_SESSION['not']='<div class="alert"><div>                закрыт временно!!!</div></div>';
header('location: /menu?'.$udet.'');
    exit;

}

$action = _string($_GET['action']);

switch($action) {
  default:


$title = 'Побег';

include './system/h.php';
    



$bosy = mysql_query('SELECT * FROM `bas_a` WHERE `user` = "'.$user['id'].'"');
  $bot = mysql_fetch_array($bosy);

if($bot['bo'] == 0){
       }else{
header('location: /bas/a/?'.$udet.'');
}


$start = _string(_num($_GET['start']));
if($start) {
	
 $shop = mysql_fetch_array(mysql_query('SELECT * FROM `bas` WHERE `id` = \''.$start.'\''));

if($user['boss_u'] == 0){
       }else{
header('location: /bas/a/?'.$udet.'');
}

if($shop['id'] == 17) {
   if($user['key16'] <=0) {header('location: /bas/?'.$udet.'');
    exit;
}
}else{
}
if($shop['id'] == 16) {
   if($user['key15'] <=0) {header('location: /bas/?'.$udet.'');
    exit;
}
}else{
}
if($shop['id'] == 15) {
   if($user['key14'] <=0) {header('location: /bas/?'.$udet.'');
    exit;
}
}else{
}
if($shop['id'] == 14) {
   if($user['key13'] <=0) {header('location: /bas/?'.$udet.'');
    exit;
}
}else{
}
if($shop['id'] == 13) {
   if($user['key12'] <= 0) {header('location: /bas/?'.$udet.'');
    exit;
}
}else{
}
if($shop['id'] == 12) {
   if($user['key11'] <=0) {header('location: /bas/?'.$udet.'');
    exit;
}
}else{
}
if($shop['id'] == 11) {
   if($user['key10'] <= 0) {header('location: /bas/?'.$udet.'');
    exit;
}
}else{
}
if($shop['id'] == 10) {
   if($user['key9'] <=0) {header('location: /bas/?'.$udet.'');
    exit;
}
}else{
}
if($shop['id'] == 9) {
   if($user['key8'] <= 0) {header('location: /bas/?'.$udet.'');
    exit;
}
}else{
}
if($shop['id'] == 8) {
   if($user['key7'] <=0) {header('location: /bas/?'.$udet.'');
    exit;
}
}else{
}
if($shop['id'] == 7) {
   if($user['key6'] <=0) {header('location: /bas/?'.$udet.'');
    exit;
}
}else{
}
if($shop['id'] == 6) {
   if($user['key5'] <=0) {header('location: /bas/?'.$udet.'');
    exit;
}
}else{
}
if($shop['id'] == 5) {
   if($user['key4'] <=0) {header('location: /bas/?'.$udet.'');
    exit;
}
}else{
}
if($shop['id'] == 4) {
   if($user['key3'] <=0) {header('location: /bas/?'.$udet.'');
    exit;
}
}else{
}
if($shop['id'] == 3) {
   if($user['key2'] <=0) {header('location: /bas/?'.$udet.'');
    exit;
}
}else{
}
if($shop['id'] == 2) {
   if($user['key1'] <=0) {header('location: /bas/?'.$udet.'');
    exit;
}
}else{
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


 if($user['level'] >= $shop['lvl']) {
}else{

$_SESSION['not']='<div class="alert"><div>                '.$shop['name'].' доступен с '.$shop['lvl'].' уровня </div></div>';
header('location: ?'.$udet.'');
    exit;
}

mysql_query('INSERT INTO `bas_a` SET  `clan` = "'.$clan['id'].'",`user` = "'.$user['id'].'",`name` = "'.$shop['name'].'",`boss` = "'.$shop['id'].'",`hp` = "'.$shop['hp'].'",`str` = "'.$shop['str'].'",`def` = "'.$shop['def'].'",`time` = "'.(time() + (2000)).'",`gold` = "'.$shop['gold'].'",`exp` = "'.$shop['exp'].'",`lvl` = "'.$shop['lvl'].'",`hp_m` = "'.$shop['hp'].'",`bo` =  "1" ');


   header('location: /bas/a/?'.$udet.'');
  
}
}
?>


 <div class="content"><div class="block center color3 s125">Побег</div>
            <div class="line"></div>    
<div class="separ2"></div><div style="text-align:center;padding:3px" class="menu_link2"><div style="border:1px solid #131313;padding:1px;background:#232323;border-radius:3px;display:inline-block"><img src="/images/title/gun.jpg" alt="" style="border:1px solid #1b1b1b;border-radius:3px;"/></div></div>
<div class="dotted"></div>



<div class="separ3"></div><div class="jour2"><div class="jour" style="padding:4px;font-size:16px;text-align:center;color:#a5a5a5;border:1px solid #090909;border-radius:3px">Убей их и получи ништяки !<div style="padding:3px"></div>

<div class="h-navig-item">
<span
            class="active">
Убито боссов  <img src="/images/icons/boss.png" width="16" alt="" hegiht="16">    <?=$user['bos_boy']?> 
</span>
</div>



</div>
    <div class="content">
            <div class="line"></div>    
<?
$complexity = _string(_num($_GET['complexity']));
if($complexity) {

  if($complexity == 1 OR $complexity == 2 OR $complexity == 3 OR $complexity == 4 OR $complexity == 5 OR $complexity == 6 OR $complexity == 7 OR $complexity == 8 ) {
    

    
  }

?>
<?
if($complexity == 1) {
?>
<div class="h-navig"><table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tbody><tr>
<td class="h-navig-item"><span
            class="active">лёгкие</span></td>
<td class="h-navig-item"><a href="?complexity=2?<?=$udet?>">средние</a></td><td class="h-navig-item"><a href="?complexity=3?<?=$udet?>">сложные</a></td><td class="h-navig-item"><a href="?complexity=4?<?=$udet?>">сверх-сложные</a></td>
</tr></tbody></table></div>
<?
}
?>
<?
if($complexity == 2) {
?>
<div class="h-navig"><table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tbody><tr>
<td class="h-navig-item"><a href="?complexity=1?<?=$udet?>">лёгкие</a></td>
<td class="h-navig-item"><span
            class="active">средние</span></td><td class="h-navig-item"><a href="?complexity=3?<?=$udet?>">сложные</a></td><td class="h-navig-item"><a href="?complexity=4?<?=$udet?>">сверх-сложные</a></td>
</tr></tbody></table></div>
<?
}
?>
<?
if($complexity == 3) {
?>
<div class="h-navig"><table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tbody><tr>
<td class="h-navig-item"><a href="?complexity=1?<?=$udet?>">лёгкие</a></td>
<td class="h-navig-item"><a href="?complexity=2?<?=$udet?>">средние</a></td><td class="h-navig-item"><span
            class="active">сложные</span></td><td class="h-navig-item"><a href="?complexity=4?<?=$udet?>">сверх-сложные</a></td>
</tr></tbody></table></div>
<?
}
?>
<?
if($complexity == 4) {
?>
<div class="h-navig"><table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tbody><tr>
<td class="h-navig-item"><a href="?complexity=1?<?=$udet?>">лёгкие</a></td>
<td class="h-navig-item"><a href="?complexity=2?'.$udet.'">средние</a></td><td class="h-navig-item"><a href="?complexity=3?<?=$udet?>">сложные</a></td><td class="h-navig-item"><span
            class="active">сверх-сложные</span></td>
</tr></tbody></table></div>
<?
}
?>
<div class="line"></div>
<?
 $q = mysql_query('SELECT * FROM `bas` WHERE `quality` = \''.$complexity.'\'');    
  while($bas = mysql_fetch_array($q)) {

?>




<div class="separ2"></div><div class="menu_link3"><table><tr><td style="width:52px;padding-right:4px;padding-top:5px"><a href="?start=<?=$bas['id']?>/?<?=$udet?>"><img src="/images/basement/<?=$bas['id']?>.jpg" alt="" style="border:1px solid #131313;border-radius:2px;height:50px;width:50px"/></a>
</td><td><div><a href="#" style="font-size:16px"><?=$bas['name']?></a>
<span class="white"><img src="/images/icons/level.png" width="16" height="16" alt=""> 
<?=$bas['lvl']?> ур.    </span>
</div>
<div style="font-size:14px;color:#a5a5a5">
<img src="/images/icons/experience.png" width="16" height="16" alt=""> Авторитет +<?=$bas['exp']?> <img src="/images/icons/silver.png" width="16" height="16" alt=""> Рубли +<?=$bas['gold']?> <br/>

</div>
</td></tr></table></div>

<?
if($bas['id'] == 17){
if($user['key16'] <= 0){
?>
<div class="dotted"></div>
 <div class="block center color3">
<img src="/images/icons/key.png" alt=""> Ключи: <b class="red">0 шт.</b>
</div>
<?
}else{
?>
<div class="dotted"></div>
 <div class="block center color3">
<img src="/images/icons/key.png" alt=""> Ключи: <b class="green"><?=$user['key16']?> шт.</b>
     </div>
 <div class="dotted"></div>

        <div class="block center">
            <span class="btn_start"><span class="btn_end"><a class="btn" href="?start=<?=$bas['id']?>/?<?=$udet?>">Ηачать cражение</a></span> </span>        </div>
<?
}
}
if($bas['id'] == 16){
if($user['key15'] <= 0){
?>
<div class="dotted"></div>
 <div class="block center color3">
<img src="/images/icons/key.png" alt=""> Ключи: <b class="red">0 шт.</b>
</div>
<?
}else{
?>
<div class="dotted"></div>
 <div class="block center color3">
<img src="/images/icons/key.png" alt=""> Ключи: <b class="green"><?=$user['key15']?> шт.</b>
     </div>
 <div class="dotted"></div>

        <div class="block center">
            <span class="btn_start"><span class="btn_end"><a class="btn" href="?start=<?=$bas['id']?>/?<?=$udet?>">Ηачать cражение</a></span> </span>        </div>
<?
}
}
if($bas['id'] == 15){
if($user['key14'] <= 0){
?>
<div class="dotted"></div>
 <div class="block center color3">
<img src="/images/icons/key.png" alt=""> Ключи: <b class="red">0 шт.</b>
</div>
<?
}else{
?>
<div class="dotted"></div>
 <div class="block center color3">
<img src="/images/icons/key.png" alt=""> Ключи: <b class="green"><?=$user['key14']?> шт.</b>
     </div>
 <div class="dotted"></div>

        <div class="block center">
            <span class="btn_start"><span class="btn_end"><a class="btn" href="?start=<?=$bas['id']?>/?<?=$udet?>">Ηачать cражение</a></span> </span>        </div>
<?
}
}
if($bas['id'] == 14){
if($user['key13'] <= 0){
?>
<div class="dotted"></div>
 <div class="block center color3">
<img src="/images/icons/key.png" alt=""> Ключи: <b class="red">0 шт.</b>
</div>
<?
}else{
?>
<div class="dotted"></div>
 <div class="block center color3">
<img src="/images/icons/key.png" alt=""> Ключи: <b class="green"><?=$user['key13']?> шт.</b>
     </div>
 <div class="dotted"></div>

        <div class="block center">
            <span class="btn_start"><span class="btn_end"><a class="btn" href="?start=<?=$bas['id']?>/?<?=$udet?>">Ηачать cражение</a></span> </span>        </div>
<?
}
}
if($bas['id'] == 13){
if($user['key12'] <= 0){
?>
<div class="dotted"></div>
 <div class="block center color3">
<img src="/images/icons/key.png" alt=""> Ключи: <b class="red">0 шт.</b>
</div>
<?
}else{
?>
<div class="dotted"></div>
 <div class="block center color3">
<img src="/images/icons/key.png" alt=""> Ключи: <b class="green"><?=$user['key12']?> шт.</b>
     </div>
 <div class="dotted"></div>

        <div class="block center">
            <span class="btn_start"><span class="btn_end"><a class="btn" href="?start=<?=$bas['id']?>/?<?=$udet?>">Ηачать cражение</a></span> </span>        </div>
<?
}
}
if($bas['id'] == 12){
if($user['key11'] <= 0){
?>
<div class="dotted"></div>
 <div class="block center color3">
<img src="/images/icons/key.png" alt=""> Ключи: <b class="red">0 шт.</b>
</div>
<?
}else{
?>
<div class="dotted"></div>
 <div class="block center color3">
<img src="/images/icons/key.png" alt=""> Ключи: <b class="green"><?=$user['key11']?> шт.</b>
     </div>
 <div class="dotted"></div>

        <div class="block center">
            <span class="btn_start"><span class="btn_end"><a class="btn" href="?start=<?=$bas['id']?>/?<?=$udet?>">Ηачать cражение</a></span> </span>        </div>
<?
}
}
if($bas['id'] == 11){
if($user['key10'] <= 0){
?>
<div class="dotted"></div>
 <div class="block center color3">
<img src="/images/icons/key.png" alt=""> Ключи: <b class="red">0 шт.</b>
</div>
<?
}else{
?>
<div class="dotted"></div>
 <div class="block center color3">
<img src="/images/icons/key.png" alt=""> Ключи: <b class="green"><?=$user['key10']?> шт.</b>
     </div>
 <div class="dotted"></div>

        <div class="block center">
            <span class="btn_start"><span class="btn_end"><a class="btn" href="?start=<?=$bas['id']?>/?<?=$udet?>">Ηачать cражение</a></span> </span>        </div>
<?
}

}
if($bas['id'] == 10){
if($user['key9'] <= 0){
?>
<div class="dotted"></div>
 <div class="block center color3">
<img src="/images/icons/key.png" alt=""> Ключи: <b class="red">0 шт.</b>
</div>
<?
}else{
?>
<div class="dotted"></div>
 <div class="block center color3">
<img src="/images/icons/key.png" alt=""> Ключи: <b class="green"><?=$user['key9']?> шт.</b>
     </div>
 <div class="dotted"></div>

        <div class="block center">
            <span class="btn_start"><span class="btn_end"><a class="btn" href="?start=<?=$bas['id']?>/?<?=$udet?>">Ηачать cражение</a></span> </span>        </div>
<?
}
}
if($bas['id'] == 9){
if($user['key8'] <= 0){
?>
<div class="dotted"></div>
 <div class="block center color3">
<img src="/images/icons/key.png" alt=""> Ключи: <b class="red">0 шт.</b>
</div>

<?
}else{
?>
<div class="dotted"></div>
 <div class="block center color3">
<img src="/images/icons/key.png" alt=""> Ключи: <b class="green"><?=$user['key8']?> шт.</b>
     </div>
 <div class="dotted"></div>

        <div class="block center">
            <span class="btn_start"><span class="btn_end"><a class="btn" href="?start=<?=$bas['id']?>/?<?=$udet?>">Ηачать cражение</a></span> </span>        </div>
<?
}
}
if($bas['id'] == 8){
if($user['key7'] <= 0){
?>
<div class="dotted"></div>
 <div class="block center color3">
<img src="/images/icons/key.png" alt=""> Ключи: <b class="red">0 шт.</b>
</div>
<?
}else{
?>
<div class="dotted"></div>
 <div class="block center color3">
<img src="/images/icons/key.png" alt=""> Ключи: <b class="green"><?=$user['key7']?> шт.</b>
     </div>




 <div class="dotted"></div>

        <div class="block center">
            <span class="btn_start"><span class="btn_end"><a class="btn" href="?start=<?=$bas['id']?>/?<?=$udet?>">Ηачать cражение</a></span> </span>        </div>
<?
}
}
if($bas['id'] == 7){
if($user['key6'] <= 0){
?>
<div class="dotted"></div>
 <div class="block center color3">
<img src="/images/icons/key.png" alt=""> Ключи: <b class="red">0 шт.</b>
</div>
<?
}else{
?>
<div class="dotted"></div>
 <div class="block center color3">
<img src="/images/icons/key.png" alt=""> Ключи: <b class="green"><?=$user['key6']?> шт.</b>
     </div>
 <div class="dotted"></div>

        <div class="block center">
            <span class="btn_start"><span class="btn_end"><a class="btn" href="?start=<?=$bas['id']?>/?<?=$udet?>">Ηачать cражение</a></span> </span>        </div>
<?
}
}
if($bas['id'] == 6){
if($user['key5'] <= 0){
?>
<div class="dotted"></div>
 <div class="block center color3">
<img src="/images/icons/key.png" alt=""> Ключи: <b class="red">0 шт.</b>
</div>
<?
}else{
?>
<div class="dotted"></div>
 <div class="block center color3">
<img src="/images/icons/key.png" alt=""> Ключи: <b class="green"><?=$user['key5']?> шт.</b>
     </div>
 <div class="dotted"></div>

        <div class="block center">
            <span class="btn_start"><span class="btn_end"><a class="btn" href="?start=<?=$bas['id']?>/?<?=$udet?>">Ηачать cражение</a></span> </span>        </div>
<?
}
}
if($bas['id'] == 5){
if($user['key4'] <= 0){
?>
<div class="dotted"></div>
 <div class="block center color3">
<img src="/images/icons/key.png" alt=""> Ключи: <b class="red">0 шт.</b>
</div>
<?
}else{
?>
<div class="dotted"></div>
 <div class="block center color3">
<img src="/images/icons/key.png" alt=""> Ключи: <b class="green"><?=$user['key4']?> шт.</b>
     </div>
 <div class="dotted"></div>

        <div class="block center">
            <span class="btn_start"><span class="btn_end"><a class="btn" href="?start=<?=$bas['id']?>/?<?=$udet?>">Ηачать cражение</a></span> </span>        </div>
<?
}
}
if($bas['id'] == 4){
if($user['key3'] <= 0){
?>
<div class="dotted"></div>
 <div class="block center color3">
<img src="/images/icons/key.png" alt=""> Ключи: <b class="red">0 шт.</b>
</div>
<?
}else{
?>
<div class="dotted"></div>
 <div class="block center color3">
<img src="/images/icons/key.png" alt=""> Ключи: <b class="green"><?=$user['key3']?> шт.</b>
     </div>
 <div class="dotted"></div>

        <div class="block center">
            <span class="btn_start"><span class="btn_end"><a class="btn" href="?start=<?=$bas['id']?>/?<?=$udet?>">Ηачать cражение</a></span> </span>        </div>
<?
}
}
if($bas['id'] == 3){
if($user['key2'] <= 0){
?>
<div class="dotted"></div>
 <div class="block center color3">
<img src="/images/icons/key.png" alt=""> Ключи: <b class="red">0 шт.</b>
</div>
<?
}else{
?>
<div class="dotted"></div>
 <div class="block center color3">
<img src="/images/icons/key.png" alt=""> Ключи: <b class="green"><?=$user['key2']?> шт.</b>
     </div>
 <div class="dotted"></div>

        <div class="block center">
            <span class="btn_start"><span class="btn_end"><a class="btn" href="?start=<?=$bas['id']?>/?<?=$udet?>">Ηачать cражение</a></span> </span>        </div>
<?
}
}
if($bas['id'] == 2){
if($user['key1'] <= 0){
?>
<div class="dotted"></div>
 <div class="block center color3">
<img src="/images/icons/key.png" alt=""> Ключи: <b class="red">0 шт.</b>
</div>
<?
}else{
?>
<div class="dotted"></div>
 <div class="block center color3">
<img src="/images/icons/key.png" alt=""> Ключи: <b class="green"><?=$user['key1']?> шт.</b>
     </div>
 <div class="dotted"></div>

        <div class="block center">
            <span class="btn_start"><span class="btn_end"><a class="btn" href="?start=<?=$bas['id']?>/?<?=$udet?>">Ηачать cражение</a></span> </span>        </div>
<?
}
}
if($bas['id'] == 1){
?> <div class="block center color3">
</div>
<div class="dotted"></div>

        <div class="block center">
            <span class="btn_start"><span class="btn_end"><a class="btn" href="?start=<?=$bas['id']?>/?<?=$udet?>">Ηачать cражение</a></span> </span>        </div>
<?
}
?>
   
        <div class="line"></div>

<?
}
?>
<div class="separ3"></div><div class="jour2"><div class="jour" style="padding:4px;font-size:14px;text-align:center;color:#a5a5a5;border:1px solid #090909;border-radius:3px">За боссов вы получаете <img src="/images/icons/experience.png" width="16" height="16" alt=""> Авторитет, <img src="/images/icons/silver.png" width="16" height="16" alt=""> Рубли.</div></div></div>
<?

}else {
?>
<div class="h-navig"><table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tbody><tr>
<td class="h-navig-item"><span
            class="active">лёгкие</span></td>
<td class="h-navig-item"><a href="?complexity=2?<?=$udet?>">средние</a></td><td class="h-navig-item"><a href="?complexity=3?<?=$udet?>">сложные</a></td><td class="h-navig-item"><a href="?complexity=4?<?=$udet?>">сверх-сложные</a></td>
</tr></tbody></table></div>
<div class="line"></div>
<?
 $q = mysql_query('SELECT * FROM `bas` WHERE `quality` = "1"');    
  while($bas = mysql_fetch_array($q)) {


?>

<div class="separ2"></div><div class="menu_link3"><table><tr><td style="width:52px;padding-right:4px;padding-top:5px"><a href="?start=<?=$bas['id']?>/?<?=$udet?>"><img src="/images/basement/<?=$bas['id']?>.jpg" alt="" style="border:1px solid #131313;border-radius:2px;height:50px;width:50px"/></a></td><td><div><a href="#" style="font-size:16px"><?=$bas['name']?></a>
<span class="white"><img src="/images/icons/level.png" width="16" height="16" alt=""> 
<?=$bas['lvl']?> ур.    </span>
</div>
<div style="font-size:14px;color:#a5a5a5">
<img src="/images/icons/experience.png" width="16" height="16" alt=""> Авторитет +<?=$bas['exp']?> <img src="/images/icons/silver.png" width="16" height="16" alt=""> Рубли +<?=$bas['gold']?> <br/>

</div>
</td></tr></table></div>

<?
if($bas['id'] == 17){
if($user['key16'] <= 0){
?>
<div class="dotted"></div>
 <div class="block center color3">
<img src="/images/icons/key.png" alt=""> Ключи: <b class="red">0 шт.</b>
</div>
<?
}else{
?>
<div class="dotted"></div>
 <div class="block center color3">
<img src="/images/icons/key.png" alt=""> Ключи: <b class="green"><?=$user['key16']?> шт.</b>
     </div>
 <div class="dotted"></div>

        <div class="block center">
            <span class="btn_start"><span class="btn_end"><a class="btn" href="?start=<?=$bas['id']?>/?<?=$udet?>">Ηачать cражение</a></span> </span>        </div>
<?
}
}
if($bas['id'] == 16){
if($user['key15'] <= 0){
?>
<div class="dotted"></div>
 <div class="block center color3">
<img src="/images/icons/key.png" alt=""> Ключи: <b class="red">0 шт.</b>
</div>
<?
}else{
?>
<div class="dotted"></div>
 <div class="block center color3">
<img src="/images/icons/key.png" alt=""> Ключи: <b class="green"><?=$user['key15']?> шт.</b>
     </div>
 <div class="dotted"></div>

        <div class="block center">
            <span class="btn_start"><span class="btn_end"><a class="btn" href="?start=<?=$bas['id']?>/?<?=$udet?>">Ηачать cражение</a></span> </span>        </div>
<?
}
}
if($bas['id'] == 15){
if($user['key14'] <= 0){
?>
<div class="dotted"></div>
 <div class="block center color3">
<img src="/images/icons/key.png" alt=""> Ключи: <b class="red">0 шт.</b>
</div>
<?
}else{
?>
<div class="dotted"></div>
 <div class="block center color3">
<img src="/images/icons/key.png" alt=""> Ключи: <b class="green"><?=$user['key14']?> шт.</b>
     </div>
 <div class="dotted"></div>

        <div class="block center">
            <span class="btn_start"><span class="btn_end"><a class="btn" href="?start=<?=$bas['id']?>/?<?=$udet?>">Ηачать cражение</a></span> </span>        </div>
<?
}
}
if($bas['id'] == 14){
if($user['key13'] <= 0){
?>
<div class="dotted"></div>
 <div class="block center color3">
<img src="/images/icons/key.png" alt=""> Ключи: <b class="red">0 шт.</b>
</div>
<?
}else{
?>
<div class="dotted"></div>
 <div class="block center color3">
<img src="/images/icons/key.png" alt=""> Ключи: <b class="green"><?=$user['key13']?> шт.</b>
     </div>
 <div class="dotted"></div>

        <div class="block center">
            <span class="btn_start"><span class="btn_end"><a class="btn" href="?start=<?=$bas['id']?>/?<?=$udet?>">Ηачать cражение</a></span> </span>        </div>
<?
}
}
if($bas['id'] == 13){
if($user['key12'] <= 0){
?>
<div class="dotted"></div>
 <div class="block center color3">
<img src="/images/icons/key.png" alt=""> Ключи: <b class="red">0 шт.</b>
</div>
<?
}else{
?>
<div class="dotted"></div>
 <div class="block center color3">
<img src="/images/icons/key.png" alt=""> Ключи: <b class="green"><?=$user['key12']?> шт.</b>
     </div>
 <div class="dotted"></div>

        <div class="block center">
            <span class="btn_start"><span class="btn_end"><a class="btn" href="?start=<?=$bas['id']?>/?<?=$udet?>">Ηачать cражение</a></span> </span>        </div>
<?
}
}
if($bas['id'] == 12){
if($user['key11'] <= 0){
?>
<div class="dotted"></div>
 <div class="block center color3">
<img src="/images/icons/key.png" alt=""> Ключи: <b class="red">0 шт.</b>
</div>
<?
}else{
?>
<div class="dotted"></div>
 <div class="block center color3">
<img src="/images/icons/key.png" alt=""> Ключи: <b class="green"><?=$user['key11']?> шт.</b>
     </div>
 <div class="dotted"></div>

        <div class="block center">
            <span class="btn_start"><span class="btn_end"><a class="btn" href="?start=<?=$bas['id']?>/?<?=$udet?>">Ηачать cражение</a></span> </span>        </div>
<?
}
}
if($bas['id'] == 11){
if($user['key10'] <= 0){
?>
<div class="dotted"></div>
 <div class="block center color3">
<img src="/images/icons/key.png" alt=""> Ключи: <b class="red">0 шт.</b>
</div>
<?
}else{
?>
<div class="dotted"></div>
 <div class="block center color3">
<img src="/images/icons/key.png" alt=""> Ключи: <b class="green"><?=$user['key10']?> шт.</b>
     </div>
 <div class="dotted"></div>

        <div class="block center">
            <span class="btn_start"><span class="btn_end"><a class="btn" href="?start=<?=$bas['id']?>/?<?=$udet?>">Ηачать cражение</a></span> </span>        </div>
<?
}
}
if($bas['id'] == 10){
if($user['key9'] <= 0){
?>
<div class="dotted"></div>
 <div class="block center color3">
<img src="/images/icons/key.png" alt=""> Ключи: <b class="red">0 шт.</b>
</div>
<?
}else{
?>
<div class="dotted"></div>
 <div class="block center color3">
<img src="/images/icons/key.png" alt=""> Ключи: <b class="green"><?=$user['key9']?> шт.</b>
     </div>
 <div class="dotted"></div>

        <div class="block center">
            <span class="btn_start"><span class="btn_end"><a class="btn" href="?start=<?=$bas['id']?>/?<?=$udet?>">Ηачать cражение</a></span> </span>        </div>
<?
}
}
if($bas['id'] == 9){
if($user['key8'] <= 0){
?>
<div class="dotted"></div>
 <div class="block center color3">
<img src="/images/icons/key.png" alt=""> Ключи: <b class="red">0 шт.</b>
</div>

<?
}else{
?>
<div class="dotted"></div>
 <div class="block center color3">
<img src="/images/icons/key.png" alt=""> Ключи: <b class="green"><?=$user['key8']?> шт.</b>
     </div>
 <div class="dotted"></div>

        <div class="block center">
            <span class="btn_start"><span class="btn_end"><a class="btn" href="?start=<?=$bas['id']?>/?<?=$udet?>">Ηачать cражение</a></span> </span>        </div>
<?
}
}
if($bas['id'] == 8){
if($user['key7'] <= 0){
?>
<div class="dotted"></div>
 <div class="block center color3">
<img src="/images/icons/key.png" alt=""> Ключи: <b class="red">0 шт.</b>
</div>
<?
}else{
?>
<div class="dotted"></div>
 <div class="block center color3">
<img src="/images/icons/key.png" alt=""> Ключи: <b class="green"><?=$user['key7']?> шт.</b>
     </div>
 <div class="dotted"></div>

        <div class="block center">
            <span class="btn_start"><span class="btn_end"><a class="btn" href="?start=<?=$bas['id']?>/?<?=$udet?>">Ηачать cражение</a></span> </span>        </div>
<?
}
}
if($bas['id'] == 7){
if($user['key6'] <= 0){
?>
<div class="dotted"></div>
 <div class="block center color3">
<img src="/images/icons/key.png" alt=""> Ключи: <b class="red">0 шт.</b>
</div>
<?
}else{
?>
<div class="dotted"></div>
 <div class="block center color3">
<img src="/images/icons/key.png" alt=""> Ключи: <b class="green"><?=$user['key6']?> шт.</b>
     </div>
 <div class="dotted"></div>

        <div class="block center">
            <span class="btn_start"><span class="btn_end"><a class="btn" href="?start=<?=$bas['id']?>/?<?=$udet?>">Ηачать cражение</a></span> </span>        </div>
<?
}
}
if($bas['id'] == 6){
if($user['key5'] <= 0){


?>
<div class="dotted"></div>
 <div class="block center color3">
<img src="/images/icons/key.png" alt=""> Ключи: <b class="red">0 шт.</b>
</div>
<?
}else{
?>
<div class="dotted"></div>
 <div class="block center color3">
<img src="/images/icons/key.png" alt=""> Ключи: <b class="green"><?=$user['key5']?> шт.</b>
     </div>
 <div class="dotted"></div>

        <div class="block center">
            <span class="btn_start"><span class="btn_end"><a class="btn" href="?start=<?=$bas['id']?>/?<?=$udet?>">Ηачать cражение</a></span> </span>        </div>
<?
}
}
if($bas['id'] == 5){
if($user['key4'] <= 0){
?>
<div class="dotted"></div>
 <div class="block center color3">
<img src="/images/icons/key.png" alt=""> Ключи: <b class="red">0 шт.</b>
</div>
<?
}else{
?>
<div class="dotted"></div>
 <div class="block center color3">
<img src="/images/icons/key.png" alt=""> Ключи: <b class="green"><?=$user['key4']?> шт.</b>
     </div>
 <div class="dotted"></div>

        <div class="block center">
            <span class="btn_start"><span class="btn_end"><a class="btn" href="?start=<?=$bas['id']?>/?<?=$udet?>">Ηачать cражение</a></span> </span>        </div>
<?
}
}
if($bas['id'] == 4){
if($user['key3'] <= 0){
?>
<div class="dotted"></div>
 <div class="block center color3">
<img src="/images/icons/key.png" alt=""> Ключи: <b class="red">0 шт.</b>
</div>
<?
}else{
?>
<div class="dotted"></div>
 <div class="block center color3">
<img src="/images/icons/key.png" alt=""> Ключи: <b class="green"><?=$user['key3']?> шт.</b>
     </div>
 <div class="dotted"></div>

        <div class="block center">
            <span class="btn_start"><span class="btn_end"><a class="btn" href="?start=<?=$bas['id']?>/?<?=$udet?>">Ηачать cражение</a></span> </span>        </div>
<?
}
}
if($bas['id'] == 3){
if($user['key2'] <= 0){
?>
<div class="dotted"></div>
 <div class="block center color3">
<img src="/images/icons/key.png" alt=""> Ключи: <b class="red">0 шт.</b>
</div>
<?
}else{
?>
<div class="dotted"></div>
 <div class="block center color3">
<img src="/images/icons/key.png" alt=""> Ключи: <b class="green"><?=$user['key2']?> шт.</b>
     </div>
 <div class="dotted"></div>

        <div class="block center">
            <span class="btn_start"><span class="btn_end"><a class="btn" href="?start=<?=$bas['id']?>/?<?=$udet?>">Ηачать cражение</a></span> </span>        </div>
<?
}
}
if($bas['id'] == 2){
if($user['key1'] <= 0){
?>
<div class="dotted"></div>
 <div class="block center color3">
<img src="/images/icons/key.png" alt=""> Ключи: <b class="red">0 шт.</b>
</div>
<?
}else{
?>
<div class="dotted"></div>
 <div class="block center color3">
<img src="/images/icons/key.png" alt=""> Ключи: <b class="green"><?=$user['key1']?> шт.</b>
     </div>
 <div class="dotted"></div>

        <div class="block center">
            <span class="btn_start"><span class="btn_end"><a class="btn" href="?start=<?=$bas['id']?>/?<?=$udet?>">Ηачать cражение</a></span> </span>        </div>
<?
}
}
if($bas['id'] == 1){
?> <div class="block center color3">
</div>
<div class="dotted"></div>

        <div class="block center">
            <span class="btn_start"><span class="btn_end"><a class="btn" href="?start=<?=$bas['id']?>/?<?=$udet?>">Ηачать cражение</a></span> </span>        </div>
<?
}
?>


        <div class="line"></div>


<?
}
echo '<div class="separ3"></div><div class="jour2"><div class="jour" style="padding:4px;font-size:14px;text-align:center;color:#a5a5a5;border:1px solid #090909;border-radius:3px">За боссов вы получаете <img src="/images/icons/experience.png" width="16" height="16" alt=""> Авторитет, <img src="/images/icons/silver.png" width="16" height="16" alt=""> Рубли.</div></div>';

}
?>

</div>
</div>
</div>
<?
include './system/f.php';

break;
  case 'a':
  $title = 'Побег';    
  include './system/h.php';

              $bossu = mysql_query('SELECT * FROM `bas_a` WHERE `user` = "'.$user['id'].'"');
               $bg = mysql_fetch_array($bossu);

			   $pets_t = (20+10);
			   $param = (rand(1,2));

if(isset($_GET['deled'])){
mysql_query('DELETE FROM `bas_a` WHERE `user` = "'.$user['id'].'"');

mysql_query('DELETE FROM `bas_log` WHERE `user` = "'.$user['id'].'"');
header('location: /bas/?'.$udet.'');
exit();
}


if(isset($_GET['po'])){
echo ' <div class="content"><div class="block center s125 red">
    Ты потерпел поражение
</div>
<div class="dotted"></div>
<div class="block center">
            <span class="btn_start"><span class="btn_end"><a class="btn" href="/bas/a/deled?'.$udet.'">Завeршить сpажениe</a></span> </span>    </div>';
include './system/f.php';
exit();
}

if($bg['time'] < time()){

header('location: /bas/a/po');
}


if($user['vip']==0){
$ex=$bg['exp'];
$go=$bg['gold'];
}else{
$ex=$bg['exp']*2;
$go=$bg['gold']*2;
}

$gol=($bg['boss']);
$tru=rand(1,5);
if(isset($_GET['deledp'])){

if($bg['hp'] <= 1){


mysql_query('DELETE FROM `bas_a` WHERE `user` = "'.$user['id'].'"');

mysql_query('DELETE FROM `bas_log` WHERE `user` = "'.$user['id'].'"');
mysql_query('UPDATE `users` SET `s` = `s` +"'.($go).'", `exp` = `exp` + "'.($ex+$clan['built_4']).'", `exepy` = `exepy` + "'.($ex+$clan['built_4']).'",`g` = `g` + "'.($gol).'",`bos_boy` = `bos_boy` +1,`avtor` = `avtor` + "'.($tru).'" WHERE `id` = "'.$user['id'].'"');

mysql_query('UPDATE `clans` SET `s` = `s` + "'.($go*3).'", `exp` = `exp` + "'.($ex*2 + $clan['built_5']).'" WHERE `id` = "'.$clan['id'].'"');

       mysql_query('UPDATE `clan_memb` SET `expl` = `expl` + 1 WHERE `clan` = "'.$clan['id'].'" AND `user` = "'.$user['id'].'"');
mysql_query('UPDATE `clans` SET `boss` =  "0" WHERE `id` = "'.$clan['id'].'"');

if($bg['boss'] == 1) {
mysql_query('UPDATE `users` SET `key1` =  `key1` + 1 WHERE `id` = "'.$user['id'].'"');


}
if($bg['boss'] == 2) {
mysql_query('UPDATE `users` SET `key2` =  `key2` + 1 WHERE `id` = "'.$user['id'].'"');

mysql_query('UPDATE `users` SET `key1` =  `key1` - 1 WHERE `id` = "'.$user['id'].'"');

if($user['level']>=60){
mysql_query('UPDATE `users` SET `bosy2` = `bosy2` + 1 WHERE `id` = \''.$user['id'].'\'');
}
}
if($bg['boss'] == 3) {
mysql_query('UPDATE `users` SET `key3` =  `key3` + 1 WHERE `id` = "'.$user['id'].'"');

mysql_query('UPDATE `users` SET `key2` =  `key2` - 1 WHERE `id` = "'.$user['id'].'"');

}
if($bg['boss'] == 4) {
mysql_query('UPDATE `users` SET `key4` =  `key4` + 1 WHERE `id` = "'.$user['id'].'"');

mysql_query('UPDATE `users` SET `key3` =  `key3` - 1 WHERE `id` = "'.$user['id'].'"');

if($user['level']>=60){
mysql_query('UPDATE `users` SET `boss4` = `boss4` + 1 WHERE `id` = \''.$user['id'].'\'');
mysql_query('UPDATE `users` SET `bosy4` = `bosy4` + 1 WHERE `id` = \''.$user['id'].'\'');
}
}
if($bg['boss'] == 5) {
mysql_query('UPDATE `users` SET `key5` =  `key5` + 1 WHERE `id` = "'.$user['id'].'"');

mysql_query('UPDATE `users` SET `key4` =  `key4` - 1 WHERE `id` = "'.$user['id'].'"');
}
if($bg['boss'] == 6) {
mysql_query('UPDATE `users` SET `key6` =  `key6` + 1 WHERE `id` = "'.$user['id'].'"');

mysql_query('UPDATE `users` SET `key5` =  `key5` - 1 WHERE `id` = "'.$user['id'].'"');

if($user['level']>=60){
mysql_query('UPDATE `users` SET `bosy6` = `bosy6` + 1 WHERE `id` = \''.$user['id'].'\'');
}
}
if($bg['boss'] == 7) {
mysql_query('UPDATE `users` SET `key7` =  `key7` + 1 WHERE `id` = "'.$user['id'].'"');
mysql_query('UPDATE `users` SET `key6` =  `key6` - 1 WHERE `id` = "'.$user['id'].'"');

}
if($bg['boss'] == 8) {
mysql_query('UPDATE `users` SET `key8` =  `key8` + 1 WHERE `id` = "'.$user['id'].'"');
mysql_query('UPDATE `users` SET `key7` =  `key7` - 1 WHERE `id` = "'.$user['id'].'"');

}
if($bg['boss'] == 9) {
mysql_query('UPDATE `users` SET `key9` =  `key9` + 1 WHERE `id` = "'.$user['id'].'"');
mysql_query('UPDATE `users` SET `key8` =  `key8` - 1 WHERE `id` = "'.$user['id'].'"');

}
if($bg['boss'] == 10) {
mysql_query('UPDATE `users` SET `key10` =  `key10` + 1 WHERE `id` = "'.$user['id'].'"');
mysql_query('UPDATE `users` SET `key9` =  `key9` - 1 WHERE `id` = "'.$user['id'].'"');

}
if($bg['boss'] == 11) {
mysql_query('UPDATE `users` SET `key11` =  `key11` + 1 WHERE `id` = "'.$user['id'].'"');
mysql_query('UPDATE `users` SET `key10` =  `key10` - 1 WHERE `id` = "'.$user['id'].'"');

}
if($bg['boss'] == 12) {
mysql_query('UPDATE `users` SET `key12` =  `key12` + 1 WHERE `id` = "'.$user['id'].'"');
mysql_query('UPDATE `users` SET `key11` =  `key11` - 1 WHERE `id` = "'.$user['id'].'"');

}
if($bg['boss'] == 13) {
mysql_query('UPDATE `users` SET `key13` =  `key13` + 1 WHERE `id` = "'.$user['id'].'"');
mysql_query('UPDATE `users` SET `key12` =  `key12` - 1 WHERE `id` = "'.$user['id'].'"');

}
if($bg['boss'] == 14) {
mysql_query('UPDATE `users` SET `key14` =  `key14` + 1 WHERE `id` = "'.$user['id'].'"');
mysql_query('UPDATE `users` SET `key13` =  `key13` - 1 WHERE `id` = "'.$user['id'].'"');

}
if($bg['boss'] == 15) {
mysql_query('UPDATE `users` SET `key15` =  `key15` + 1 WHERE `id` = "'.$user['id'].'"');
mysql_query('UPDATE `users` SET `key14` =  `key14` - 1 WHERE `id` = "'.$user['id'].'"');

}
if($bg['boss'] == 16) {
mysql_query('UPDATE `users` SET `key16` =  `key16` + 1 WHERE `id` = "'.$user['id'].'"');
mysql_query('UPDATE `users` SET `key15` =  `key15` - 1 WHERE `id` = "'.$user['id'].'"');

}
if($bg['boss'] == 17) {
mysql_query('UPDATE `users` SET `key17` =  `key17` + 1 WHERE `id` = "'.$user['id'].'"');
mysql_query('UPDATE `users` SET `key16` =  `key16` - 1 WHERE `id` = "'.$user['id'].'"');

}

$_SESSION['not']=' <div class="alert"><div>                                     <div class="blue"><img src="/images/icons/reward.png" width="16" height="16" alt=""> Прибыль:</div>
 <img src="/images/icons/experience.png" width="16" height="16" alt=""> Авторитет:+'.($ex).'  <img src="/images/icons/silver.png" width="16" height="16" alt=""> Рубли +'.$go.' <img src="/images/icons/gold.png" width="16" height="16" alt=""> Сахар +'.$gol.' '.$candy.' <img src="/images/icons/experience.png" width="16" height="16" alt="">+'.($tru).'</div></div><div class="alert_bottom"></div>';
header('location: /bas/?'.$udet.'');
exit();
}else{
header('location: ?'.$udet.'');
}
}

if($bg['hp'] <0){

header('location: /bas/a/deledp?'.$udet.'');
}








if(isset($_GET['atk'])) {


$_hp = ceil($user['vit']*20/100);
if($user['hp'] < $_hp){
header('location: /bas/a/hpnoy?'.$udet.'');
exit;
}else{
}

$my_atk += rand(round($user['str']/6), round($user['str']/1));
$bos_atk += rand(round($bg['str']/8), round($bg['str']/3));
$bos_atk -= rand(round($user['def']/12), round($user['def']/7));
$my_atk -= rand(round($bg['def']/12), round($bg['def']/7));

if($bos_atk < 0)$bos_atk = 0;
if($my_atk < 0)$my_atk = 0;

$bos_atka = $bos_atk;
$bos_ataka = $bos_atk;

$my_atka = $my_atk;
$my_ataka = $my_atk;
$my_a = ($my_ataka*3);

$krit=rand(1,10);
if($krit<3){$kr=" $my_a - (Крит-урон)";}else{$kr=" $my_ataka ";}
if($bos_atka > 0){ $bos_atka="нанёс $bos_atka ";}else{$bos_atka=" <span class=color2> промах </span>";}


if($bg['hp'] <= 0){


}else{
if($user['g']>=1)
{

mysql_query('UPDATE `bas_a` SET `hp` =  `hp` - "'.$kr.'" WHERE `user` = "'.$user['id'].'"');
mysql_query('UPDATE `users` SET `hp` =  `hp` - "'.$bos_ataka.'" WHERE `id` = "'.$user['id'].'"');

$atas= " <img src=/images/icons/$user[r].png width=16 height=16 alt=> <span class=color3>$user[login]</span> нанёс $kr <img src=/images/icons/uron.png width=16 height=16 alt=> урона <span class=red>$bg[name]</span> ";

mysql_query('INSERT INTO `bas_log` SET  `clan` = "'.$clan['id'].'",`user` = "'.$user['id'].'",`time` = "'.time().'",`text` = "'.$atas.'",`boss` = "'.$bg['boss'].'",`uron` = "'.$my_ataka.'"');

$ats= "<img src=/images/icons/boss.png width=16 height=16 alt=> <span class=color3>$bg[name]</span> $bos_atka ";

mysql_query('INSERT INTO `bas_log` SET  `clan` = "'.$clan['id'].'",`user` = "'.$user['id'].'",`time` = "'.time().'",`text` = "'.$ats.'",`boss` = "'.$bg['boss'].'",`uron` = "'.$bos_atka.'"');

}else{
}
}    

header('location: /bas/a/?'.$udet.'&'.$user['id'].'');

}
 #
  $bosy = mysql_query('SELECT * FROM `bas_a` WHERE `user` = "'.$user['id'].'"');
  $bot = mysql_fetch_array($bosy);

      if(!$bot){
		  


		  header('location: /bas/?'.$udet.'');

       }else{


if(isset($_GET['potion'])) {
    mysql_query('UPDATE `users` SET `s` = `s` - 80, `hp` = "'.($user['vit']).'"WHERE `id` = "'.$user['id'].'"');

header('location: /bas/a/?'.$udet.'');
exit;
}

if(isset($_GET['hpnoy'])) {
echo '<div class="alert"><div>    <div class="red s125">Не хватает здоровья</div>
    <div class="a_separator"></div>
    <div class="inline-block"><div class="block">
            <a href="#"><img class="left mr8" src="/images/items/794.jpg" alt=""></a>
            <img src="/images/icons/mixture.png" width="16" height="16" alt=""> <a class="" href="#"><span class="">Здоровяк</span></a>
        <span class="white">
    <img src="/images/icons/level.png" width="16" height="16" alt=""> 1 ур.    </span>
<div>
<span class="green">
<img src="/images/icons/currentHealth.png" width="16" height="16" alt="">&nbsp;+100%,</span>
<img src="/images/icons/date.png" width="16" height="16" alt="">    моментально
</div><div class="clear"></div>
</div>
<div class="clear"></div>
</div>
    <div class="a_separator"></div>
    <span class="btn_start"><span class="btn_end"><a class="btn" href="/bas/a/potion?'.$udet.'">Восстановить за     <img src="/images/icons/silver.png" width="16" height="16" alt=""> 84</a></span> </span></div></div><div class="alert_bottom"></div>';
}




if($bot['bo'] == 1){

$hp_b = round(100 / ($bg['hp_m']/ $bg['hp']));
if($hp_m){
$hp_m=100;
}
?>



   <div class="content"><div class="block center color3 s125"><img src="/images/icons/circle.png" alt=""> <a href="/bas/a/?'.$udet.'"><?=$bg['name']?></a><span class="white">, <?=_time($bg['time'] - time())?>
</span></div>
            <div class="line"></div>

<div class="block">        
    <div class="center">    <a href="/bas/a/atk"><img class="left mr8" src="/images/basement/<?=$bg['boss']?>.jpg" width="50" height="50" alt=""></a>    </div>
                                <img src="/images/icons/boss.png" width="16" alt="" hegiht="16"> <span class="center"><?=$bg['name']?></span>        <span class="white">
    

    <img src="/images/icons/level.png" width="16" height="16" alt=""> <?=$bg['lvl']?> ур.    </span>
    <div class="m3" style="padding-left: 58px">    <div style="width: 100%; height: 4px"
            class="progress-grey">
            <div style="width: <?=$hp_b?>%; height: 4px" class="progress-green"></div></div>    </div>    <div>
            
    <img src="/images/icons/currentHealth.png" width="16" height="16" alt=""> <?=$bg['hp']?>            
    <img src="/images/icons/damage.png" width="16" height="16" alt=""> <?=$bg['str']?>            
    <img src="/images/icons/armor.png" width="16" height="16" alt=""> <?=$bg['def']?>        </div>
<div class="clear"></div>
</div>    <div class="dotted"></div>
    <div class="block center">
        <span class="btn_start"><span class="btn_end"><a class="btn" href="/bas/a/atk?<?=$user['id']?>">Ηaнеcти yдар</a></span> </span>    </div>
    <div class="dotted"></div>
<div class="block">          
<?

   $w_1 = mysql_query('SELECT * FROM `inv` WHERE `user` = "'.$user['id'].'" AND `id` = "'.$user['w_1'].'"');
    $w_1 = mysql_fetch_array($w_1);
if(!$w_1) {
$w_1['item'] = 0;
}
    $w_2 = mysql_query('SELECT * FROM `inv` WHERE `user` = "'.$user['id'].'" AND `id` = "'.$user['w_2'].'"');
    $w_2 = mysql_fetch_array($w_2);
if(!$w_2) {
$w_2['item'] = 0;
}
    $w_3 = mysql_query('SELECT * FROM `inv` WHERE `user` = "'.$user['id'].'" AND `id` = "'.$user['w_3'].'"');
    $w_3 = mysql_fetch_array($w_3);
if(!$w_3) {
$w_3['item'] = 0;
}
    $w_4 = mysql_query('SELECT * FROM `inv` WHERE `user` = "'.$user['id'].'" AND `id` = "'.$user['w_4'].'"');
    $w_4 = mysql_fetch_array($w_4);
if(!$w_4) {
$w_4['item'] = 0;
}
    $w_5 = mysql_query('SELECT * FROM `inv` WHERE `user` = "'.$user['id'].'" AND `id` = "'.$user['w_5'].'"');
    $w_5 = mysql_fetch_array($w_5);
if(!$w_5) {
$w_5['item'] = 0;
}
    $w_6 = mysql_query('SELECT * FROM `inv` WHERE `user` = "'.$user['id'].'" AND `id` = "'.$user['w_6'].'"');
    $w_6 = mysql_fetch_array($w_6);
if(!$w_6) {
$w_6['item'] = 0;
}
    $w_7 = mysql_query('SELECT * FROM `inv` WHERE `user` = "'.$user['id'].'" AND `id` = "'.$user['w_7'].'"');
    $w_7 = mysql_fetch_array($w_7);
if(!$w_7) {
$w_7['item'] = 0;
}
    $w_8 = mysql_query('SELECT * FROM `inv` WHERE `user` = "'.$user['id'].'" AND `id` = "'.$user['w_8'].'"');
    $w_8 = mysql_fetch_array($w_8);
if(!$w_8) {
$w_8['item'] = 0;
}

if($user['r'] == 0) {
?>
       <img class="left mr8" src="http://bespredel.mobi/maneken?sex=man&amp;width=120&amp;height=160&amp;fragment=1&amp;frame=&amp;equip%5B1%5D=<?=$w_1['item']?>&amp;equip%5B2%5D=<?=$w_2['item']?>&amp;equip%5B3%5D=<?=$w_3['item']?>&amp;equip%5B4%5D=<?=$w_4['item']?>&amp;equip%5B5%5D=<?=$w_5['item']?>&amp;equip%5B6%5D=<?=$w_6['item']?>&amp;equip%5B7%5D=<?=$w_7['item']?>&amp;equip%5B8%5D=<?=$w_8['item']?>" width="50" height="50" alt="">


<?
}
if($user['r'] == 1) {
?>
      <img class="left mr8" src="http://bespredel.mobi/maneken?sex=woman&amp;width=120&amp;height=160&amp;fragment=1&amp;frame=&amp;equip%5B1%5D=<?=$w_1['item']?>&amp;equip%5B2%5D=<?=$w_2['item']?>&amp;equip%5B3%5D=<?=$w_3['item']?>&amp;equip%5B4%5D=<?=$w_4['item']?>&amp;equip%5B5%5D=<?=$w_5['item']?>&amp;equip%5B6%5D=<?=$w_6['item']?>&amp;equip%5B7%5D=<?=$w_7['item']?>&amp;equip%5B8%5D=<?=$w_8['item']?>" width="50" height="50" alt="">


<?
}
?>

                    <img src="/images/icons/<?=$user['r']?>.png" width="16" height="16" alt=""> <span><?=$user['login']?></span>      <span class="white">
    
    <img src="/images/icons/level.png" width="16" height="16" alt=""> <?=$user['level']?> ур.    </span>
    <div class="m3" style="padding-left: 58px">    <div style="width: 100%; height: 4px"
            class="progress-grey">
            <div style="width: <?=$hp_u?>%; height: 4px" class="progress-green"></div></div>    </div>    <div>
            
    <img src="/images/icons/currentHealth.png" width="16" height="16" alt=""> <?=$user['hp']?>            
    <img src="/images/icons/damage.png" width="16" height="16" alt=""> <?=$user['str']?>            
    <img src="/images/icons/armor.png" width="16" height="16" alt=""> <?=$user['def']?>        </div>
<div class="clear"></div>
</div>    

  <div class="dotted"></div>

        
<?

echo '<div class="block"><div class="color2 small"> <img src="/images/icons/swords.png" width="16" height="16" alt=""> Журнал сражения:</div>';

$q = mysql_query('SELECT * FROM `bas_log` WHERE `user` = "'.$user['id'].'" ORDER BY `time` DESC LIMIT 5');    
  while($row = mysql_fetch_array($q)) {


echo '<div class="small">

'.$row['text'].'
 <span class="color2 small">, '._times(time() - $row['time']).'</span>

</div>';
}
?>
</div>
</div></div>
<?
 }
}

include './system/f.php';

break;
}
?>