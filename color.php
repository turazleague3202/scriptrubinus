<?php
$title = 'Элитный цвет ника';
include './system/common.php';
include './system/functions.php';
include './system/user.php';
include './system/h.php';
# закрываем от гостей
if(!$user['id']) exit(header('Location: '.$HOME));

echo '<div class="title2">'.$title.'</div>';


if(isset($_REQUEST['ok2'])) {
if ($user['g'] < 15000){
header('Location: '.$HOME.'/colorss');
$_SESSION['err'] = "Нехватает золотых монет!";
exit();
}

else
{
$style = strong($_POST['colors']);

mysql_query('UPDATE `users` SET `elita_color` = "'.$style.'" WHERE `id` = "'.$user['id'].'"');
mysql_query('UPDATE `users` SET `g` = "'.($user['g']-15000).'", `elita_colors`="1" WHERE `id` = "'.$user['id'].'"');
echo '<div class="player">Вы успешно изменили свой цвет ника!</div>
<div class="wrapper">» <a href="'.$HOME.'/colors">Назад в Цвет ника</a></div>';
include './system/f.php'; exit;
}
}
if(isset($_REQUEST['ok3'])) {
if ($user['g'] < 30000){
header('Location: '.$HOME.'/colorss');
$_SESSION['err'] = "Нехватает золотых монет!";
exit();
}

else
{
$style = strong($_POST['colors']);

mysql_query('UPDATE `users` SET `elita_color` = "'.$style.'" WHERE `id` = "'.$user['id'].'"');
mysql_query('UPDATE `users` SET `g` = "'.($user['g']-30000).'", `elita_colors`="1" WHERE `id` = "'.$user['id'].'"');
echo '<div class="wrapper">Вы успешно изменили свой цвет ника!</div>
<div class="wrapper">» <a href="'.$HOME.'/colors">Назад в Цвет ника</a></div>';
include './system/f.php'; exit;
}
}



//1группа
echo '
<div class="god3 center light_bottom">Первая группа цветов:<br/>
<span class="gray">Стоимость перекраски:</span> <font color=gold>15000 <img src="/images/icon/gold.png"></font></div>
<div class="hr"></div>

<div class="god4 light_bottom">
<font style="text-shadow: 0px 0px 5px;" color=#FFA500><span class="baby"><b>'.$user['login'].'</b></span> - Оранжевый</font><br>
<font style="text-shadow: 0px 0px 5px;" color=#00FF7F><span class="baby"><b>'.$user['login'].'</b></span> - Весеней зелени</font><br>
<font style="text-shadow: 0px 0px 5px;" color=#FF6347><span class="baby"><b>'.$user['login'].'</b></span> - Томатный</font><br>
<font style="text-shadow: 0px 0px 5px;" color=#9ACD32><span class="baby"><b>'.$user['login'].'</b></span> - Желто-зеленый</font><br>
<font style="text-shadow: 0px 0px 5px;" color=#1E90FF><span class="baby"><b>'.$user['login'].'</b></span> - Небесно голубой</font><br>
<font style="text-shadow: 0px 0px 5px;" color=#6A5ACD><span class="baby"><b>'.$user['login'].'</b></span> - Аспидно-синий</font><br>
<font style="text-shadow: 0px 0px 5px;" color=#FF7C04><span class="baby"><b>'.$user['login'].'</b></span> - Огненный</font><br>
<div class="lines"></div>
<form method="POST"><b><center><span class="gray">Выберите цвет:</span></center></b>
<center><select name="colors">
<option value="FFA500">Оранжевый</option>
<option value="00FF7F">Весеней зелени</option>
<option value="FF6347">Томатный</option>
<option value="9ACD32">Желто-зеленый</option>
<option value="1E90FF">Небесно голубой</option>
<option value="6A5ACD">Аспидно-синий</option>
<option value="FF7C04">Огненный</option>
</select><br />
<input class="button" type="submit" name="ok2" value="Перекрасить">
</center></form></div><div class="hr"></div>
</div></div>';

//2группа
echo '<div class="god3 center light_bottom">Вторая группа цветов:<br/>
<span class="gray">Стоимость перекраски:</span> <font color=gold>30000 <img src="/images/icon/gold.png"></font></div>
<div class="hr"></div>

<div class="god4 light_bottom">
<font style="text-shadow: 0px 0px 5px;" color=#FFD700><span class="baby"><b>'.$user['login'].'</b></span> - Золотистый</font><br>
<font style="text-shadow: 0px 0px 5px;" color=#F08080><span class="baby"><b>'.$user['login'].'</b></span> - Светло-коралловый</font><br>
<font style="text-shadow: 0px 0px 5px;" color=#00FFFF><span class="baby"><b>'.$user['login'].'</b></span> - Бирюзовый</font><br>
<font style="text-shadow: 0px 0px 5px;" color=#8A2BE2><span class="baby"><b>'.$user['login'].'</b></span> - Сине-фиолетовый</font><br>
<font style="text-shadow: 0px 0px 5px;" color=#BA55D3><span class="baby"><b>'.$user['login'].'</b></span> - Умерено-лиловый</font><br>
<font style="text-shadow: 0px 0px 5px;" color=#DC143C><span class="baby"><b>'.$user['login'].'</b></span> - Малиновый</font><br>
<font style="text-shadow: 0px 0px 5px;" color=white><span class="baby"><b>'.$user['login'].'</b></span> - Белый</font><br>
<font style="text-shadow: 0px 0px 5px;" color=black><span class="baby"><b>'.$user['login'].'</b></span> - Черный</font><br>
<br/>
<form method="POST"><center><b><span class="gray">Выберите цвет:</span></b><br/>
<select name="colors">
<option value="FFD700">Золотистый</option>
<option value="F08080">Светло-коралловый</option>
<option value="00FFFF">Бирюзовый</option>
<option value="8A2BE2">Сине-фиолетовый</option>
<option value="BA55D3">Умерено-лиловый</option>
<option value="DC143C">Малиновый</option>
<option value="white">Белый</option>
<option value="black">Черный</option>
</select><br />
<input class="button" type="submit" name="ok3" value="Перекрасить">
</center></form></div><div class="hr"></div>
</div></div>';

echo'<div class="god3 center light_bottom"><div class="menu_link">';
echo '<a href="'.$HOME.'/settings"><img src="/images/nz.png"> Назад в настройки</a></div></div>';
//-----Подключаем низ-----//
include './system/f.php';
?>