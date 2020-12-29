<?
    include './system/common.php';
    
 include './system/functions.php';
        
      include './system/user.php';
    
if(!$user OR $user['access'] < 2) {

  header('location: /');
    
exit;

}

    $title = 'Передача средств всем игрокам';    

include './system/h.php';

?>

<style>
.but {margin:1px;
background-image:url(http://213.239.195.28/xaos/style2/btn.png);
border:1px solid #131313;
color:white;
text-align:center;
text-decoration:none;
display:inline-block;
height:20px;
padding:2px;
padding-left:6px;
padding-right:6px;
border-radius:3px;
font-size:12px}
</style>
<div class='title'><?=$title?></div>
 <div class='line'></div>

<?

  if($_POST['submit']) {
  
           $type = _string($_POST['type']);
    $count= _string(_num($_POST['count']));
  
    $texet = _string($_POST['texet']);

  if(mysql_query('UPDATE `users` SET `'.$type.'` = `'.$type.'` + '.$count.' WHERE `id`')) {

$all=mysql_num_rows(mysql_query("SELECT `id` FROM `users` "));


mysql_query("INSERT INTO `mail` SET `from`='2',`to`='".$all."',`text`=' ".$texet." <img src=\'/images/icon/".$type.".png\'> ".$count." ".$text."',`time`='".time()."'");

   mysql_query('INSERT INTO `contacts` (`user`,`ho`, `time`) VALUES (\''.$all.'\',  \'2\',    \''.time().'\')');

?>

<div class='content' align='center'>Перевод успешно выполнен!</div>
<div class='line'></div>

<?  
  
  }
  else
  {
  
  
  }
  
  }

?>

<div class='content'>

  <form action='/dep.php' method='post'>
    <select name='type'>
    <option value='s'>Серебро</option>
    <option value='g'>Золото</option>

    </select>
<br/>
    Сообщения:<br/>
<input style='width:33%;height:28px;' name='texet' value='Вам зачислено'/><br/>
    <br/>
    Количество средств:<br/>
<input style="width:33%;height:18px;" name='count' size='2' value='0'/><br/>
    <input class='but' type='submit' name='submit' value='Перевести'/>
  </form>

</div>

<?
		
		include './system/f.php';
?>