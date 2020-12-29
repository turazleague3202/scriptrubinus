<?
    
    include './system/common.php';
    
 include './system/functions.php';
        
      include './system/user.php';
    
if(!$user OR $user['access']<2) {

  header('location: /');
    
exit;

}



$title = 'Добавить босса';    

include './system/h.php';  



$color = _string($_POST['color']);

if($color) {
 
mysql_query('UPDATE `users` SET `color` = "'.$color.'" WHERE `id` = "'.$user['id'].'"');

echo 'color';
}

echo '<div class=\'title\'>'.$title.'</div>
<div class=\'line\'></div>
<div class=\'content\' align=\'center\'>
</div>
<div class=\'line\'></div>
<div class=\'content\' align=\'center\'>
  <form action=\'/col/\' method=\'post\'>
 ';
?>
<div class="god4 left">
<font style="text-shadow: 0px 0px 5px;" color=#FFA500><span class="baby"><b><?=$user['login']?></b></span> - Оранжевый</font><br>
<font style="text-shadow: 0px 0px 5px;" color=#00FF7F><span class="baby"><b><?=$user['login']?></b></span> - Весеней зелени</font><br>
<font style="text-shadow: 0px 0px 5px;" color=#FF6347><span class="baby"><b><?=$user['login']?></b></span> - Томатный</font><br>
<font style="text-shadow: 0px 0px 5px;" color=#9ACD32><span class="baby"><b><?=$user['login']?></b></span> - Желто-зеленый</font><br>
<font style="text-shadow: 0px 0px 5px;" color=#1E90FF><span class="baby"><b><?=$user['login']?></b></span> - Небесно голубой</font><br>
<font style="text-shadow: 0px 0px 5px;" color=#6A5ACD><span class="baby"><b><?=$user['login']?></b></span> - Аспидно-синий</font><br>
<font style="text-shadow: 0px 0px 5px;" color=#FF7C04><span class="baby"><b><?=$user['login']?></b></span> - Огненный</font><br></div>
<div class="god4 left">
<font style="text-shadow: 0px 0px 5px;" color=#FFD700><span class="baby"><b><?=$user['login']?></b></span> - Золотистый</font><br>
<font style="text-shadow: 0px 0px 5px;" color=#F08080><span class="baby"><b><?=$user['login']?></b></span> - Светло-коралловый</font><br>
<font style="text-shadow: 0px 0px 5px;" color=#00FFFF><span class="baby"><b><?=$user['login']?></b></span> - Бирюзовый</font><br>
<font style="text-shadow: 0px 0px 5px;" color=#8A2BE2><span class="baby"><b><?=$user['login']?></b></span> - Сине-фиолетовый</font><br>
<font style="text-shadow: 0px 0px 5px;" color=#BA55D3><span class="baby"><b><?=$user['login']?></b></span> - Умерено-лиловый</font><br>
<font style="text-shadow: 0px 0px 5px;" color=#DC143C><span class="baby"><b><?=$user['login']?></b></span> - Малиновый</font><br>
<font style="text-shadow: 0px 0px 5px;" color=white><span class="baby"><b><?=$user['login']?></b></span> - Белый</font><br></div>
color:<br/>
   <select name='color'>
   <option value='0000FF'>Синий</option>
   <option value='00FFFF'>морская волна</option>
   <option value='00FF00'>лайм</option>
   <option value='800080'>пурпурный</option>
   <option value='5'>нет</option>
   </select><br/>

<br/><br/>
<?
  echo '
  <input type=\'submit\' value=\'Сохранить\'/>
</form>
</div><br/><br/>
<div class=\'line\'></div>
<div class=\'list\'></div>';
  
include './system/f.php';

?>