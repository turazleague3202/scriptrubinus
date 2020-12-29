<?
    
    include './system/common.php';
    
 include './system/functions.php';
        
      include './system/user.php';
        
    $title = 'Тюремный Беспредел';

include './system/h.php';  

if(isset($user['id'])) header('Location: /menu?'.$udet.'');

function msg($sms){
echo '<div class="block center small red">'.$sms.'</div><div class="dotted"></div>
';
}

    if(isSet($_GET['exit'])) {
    
        setCookie('id', '');
  setCookie('password', '');
    
    header('location: /');
    
    }

$udet=rand(111111,999999);
$login = _string($_POST['login']);
  $login = strToLower($login);
    $password = _string($_POST['password']);

if($login && $password) {
    $q = mysql_query('SELECT * FROM `users` WHERE `login` = "'.$login.'" AND `password` = "'.md5($password).'" LIMIT 1');
 $user = mysql_fetch_array($q);
if(empty($login)) msg('Введите логин');
	elseif(empty($password)) msg('Введите пароль');
	elseif($user == 0) msg('Логин или пароль неверны');
	else {
    setCookie('id', $user['id'], time() + 999999, '/');
setCookie('password', md5($password), time() + 999999, '/');
header('location: /menu');
}}


$ref = _string(_num($_GET['ref']));

?>


        <div class="header">
            <div class="block center small">Тюремный беспредел</div>
    </div>            <div class="line2"></div>
                
    <div class="content">
<div class="block center">
    <img src="/images/title/log.jpg" width="230" height="85" alt="">    <br/>
    <b class="color1">В игре <?=mysql_result(mysql_query('SELECT COUNT(*) FROM `users`'),0)?> человек</b>
    <br/>
    Теперь твоя очередь!
    <br/>
    <span class="small">Погрузись в мир тюремного беспредела.</span>
    <br/>
    <span class="small">Твой ход может стать решающим!</span>
</div>
<div class="line"></div>

<div class="block center">
        <a href="/start/ref=<?=$ref?>"><img src="/dark/start.jpg" width="150" height="41" alt=""></a></div>
<div class="dotted"></div>
<div class="block center">
    <form action="?<?=$udet?>" method="post">
<label class="control-label" for="loginofficialform-login">Логин персонажа</label>
<input type='text' name='login' class='form-control'/>
<div class="help-block"></div>

<label class="control-label" for="loginofficialform-password">Пароль</label>

<input type='password' name='password' class='form-control'/>
<div class="help-block"></div>
</div>
<center>
        <span class="m3 btn_start middle"><span class="btn_end"><button type="submit" class="btn">Войти в игру</button></span></span>

</center>
</form>
<div class="block center">
        <a href="/pass/?<?=$udet?>">Восстановить пароль</a></div>
<div class="dotted"></div>

<div class="line"></div>
<div class="block center">
    Ожесточённые бои, отстаивание интересов, потерянные судьбы, противостояние банд. Один неверный ход и ты позади.
    Настало твоё время! Останови тюремный беспредел и стань легендой.
</div>
</div>
</div>

 
<?
    
include './system/f.php';

?>