<?
include_once 'system/common.php';
include_once 'system/functions.php';
include_once 'system/user.php';
$title='Подарки';
include_once 'system/h.php';


if($user['level']<=19){
header("Location: /menu?");exit;

}

////////////		открываем информацию о данных игрока снова 	//////////////
//-------------------------------------
  $log = $user[id];
  $reqdsdfrfd = mysql_query("SELECT * FROM `users` WHERE `id` = '$log' and `id` = '$user[id]' LIMIT 1");
  $user = mysql_fetch_assoc($reqdsdfrfd);
//-------------------------------------
///////////////////////////////////////////////////////////////////////////////


if (!isset($user) && !isset($_GET['id'])){header("Location: /index.php?".SID);exit;}

if (mysql_result(mysql_query("SELECT COUNT(*) FROM `users` WHERE `id` = '$ank[id]' LIMIT 1"))){header("Location: /index.php?".SID);exit;}
$ank=mysql_fetch_array(mysql_query("SELECT * FROM `users` WHERE `id` = '".mysql_real_escape_string($_GET[id])."' LIMIT 1"));





if ((!isset($_SESSION['refer']) || $_SESSION['refer']==NULL)
&& isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER']!=NULL &&
!ereg('gifts\.php',$_SERVER['HTTP_REFERER']))
$_SESSION['refer']=str_replace('&','&amp;',ereg_replace('^http://[^/]*/','/', $_SERVER['HTTP_REFERER']));


$p = (isset($_GET['p'])) ? htmlspecialchars($_GET['p']) : null;



switch($p){

case 'send_gifts':



$pid = intval($_GET['pid']);

if (isset($_GET['go'])){

if ($user[id]==$ank[id]){echo "<font color=red><p>Себе дарить нельзя</p></font>";
include_once 'system/f.php';exit;
}

$curr=date("d.m.y / H:i");
$cena = 30;
$cena2= 600;
$msg= mysql_real_escape_string($_POST['msg']);
$ank['id'];
if($ank==0){
msg ('Пользователь не найден :(');
}else{if (isset($user) & $user['g']<=$cena){
echo "<font color=red><p>У Вас не достаточно Золота :(</p></font>";
}else{
////////////////////
mysql_query("UPDATE `users` SET `g` = '".($user['g']-$cena)."', `s` = '".($user['s']-$cena2)."'WHERE `id` = '$user[id]' LIMIT 1");
//mysql_query("UPDATE `users` SET `s` = '".($ank['s']+$cena2)."' WHERE `id` = '$ank[id]' LIMIT 1");
////////////////////
$time = time();


////////////////////
mysql_query("UPDATE `users` SET `gift` = '1' WHERE `id` = '$ank[id]' LIMIT 1");
mysql_query("INSERT INTO `gifts` (`id_user`, `ot_id`, `text`, `time`, `id_gifts`) values('$ank[id]', '$user[id]', '".mysql_real_escape_string($msg)."', '$time', '$pid')");
////////////////////


echo '<div class="alert">
    <div class="color1"><img src="/images/icons/gift.png" width="16" height="16" alt="">  Подарок успешно отправлен
</div>
    <div class="a_separator"></div>
    <span class="btn_start"><span class="btn_end"><a href="/user/'.$ank['id'].'/" class="btn">Перейти в профиль</a> </span>
        </span></div>';

}}
}

 echo '<div class="content"><div class="block center color3 s125"> Отправка</div>
            <div class="line"></div><div class="block center">
    <img src="/images/gifts/'.$pid.'.png" alt="">    <div>Стоимость:     <img src="/images/icons/silver.png" width="16" height="16" alt=""> 600   <img src="/images/icons/gold.png" width="16" height="16" alt=""> 30</div>
</div>
<div class="dotted"></div>
<div class="block center">
    
<img src="/images/icons/emoji/smile.png" width="16" height="16" alt="">&nbsp;<a id="toggler" class="tdnone dashed" href="?recipient_id=11484&amp;id=1_3&amp;nocache=1602510096#?nocache=1682797331">Показать смайлы</a><div id="smiles" style="display: none;">
            <img src="/images/icons/emoji/1.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:)&#039;)">            <img src="/images/icons/emoji/2.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:-D&#039;)">            <img src="/images/icons/emoji/3.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;;-)&#039;)">            <img src="/images/icons/emoji/4.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;xD&#039;)">            <img src="/images/icons/emoji/5.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;;-P&#039;)">            <img src="/images/icons/emoji/6.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;8-)&#039;)">            <img src="/images/icons/emoji/7.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:]&#039;)">            <img src="/images/icons/emoji/8.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;3(&#039;)">            <img src="/images/icons/emoji/9.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:_-(&#039;)">            <img src="/images/icons/emoji/10.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:_(&#039;)">            <img src="/images/icons/emoji/11.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:|&#039;)">            <img src="/images/icons/emoji/12.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;8|&#039;)">            <img src="/images/icons/emoji/13.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;^3&#039;)">            <img src="/images/icons/emoji/14.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;(XX)&#039;)">            <img src="/images/icons/emoji/15.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;|O^&#039;)">            <img src="/images/icons/emoji/16.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;^FU^&#039;)">            <img src="/images/icons/emoji/17.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;^((&#039;)">            <img src="/images/icons/emoji/18.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;^zz&#039;)">            <img src="/images/icons/emoji/19.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:*&#039;)">            <img src="/images/icons/emoji/20.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:^|&#039;)">            <img src="/images/icons/emoji/21.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:(x)&#039;)">            <img src="/images/icons/emoji/22.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:pf&#039;)">            <img src="/images/icons/emoji/23.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;O^^O&#039;)">            <img src="/images/icons/emoji/24.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;}:}&#039;)">            <img src="/images/icons/emoji/25.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;}:{&#039;)">            <img src="/images/icons/emoji/26.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:like:&#039;)">            <img src="/images/icons/emoji/27.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:dislike:&#039;)">            <img src="/images/icons/emoji/28.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:up:&#039;)">            <img src="/images/icons/emoji/29.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:v:&#039;)">            <img src="/images/icons/emoji/30.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:ok:&#039;)">            <img src="/images/icons/emoji/31.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:beer:&#039;)">            <img src="/images/icons/emoji/32.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:banan:&#039;)">            <img src="/images/icons/emoji/33.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;rose&#039;)">            <img src="/images/icons/emoji/34.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:pitushok:&#039;)">            <img src="/images/icons/emoji/35.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:sos:&#039;)">            <img src="/images/icons/emoji/36.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:cel:&#039;)">            <img src="/images/icons/emoji/37.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:crown:&#039;)">            <img src="/images/icons/emoji/38.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:baby:&#039;)">            <img src="/images/icons/emoji/39.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:boom:&#039;)">            <img src="/images/icons/emoji/40.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:gun:&#039;)">            <img src="/images/icons/emoji/41.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:love:&#039;)">            <img src="/images/icons/emoji/42.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:hurt:&#039;)">            <img src="/images/icons/emoji/43.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:police:&#039;)">            <img src="/images/icons/emoji/44.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:bolls:&#039;)">            <img src="/images/icons/emoji/45.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:ear:&#039;)">            <img src="/images/icons/emoji/46.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:fuck:&#039;)">            <img src="/images/icons/emoji/47.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:smoke:&#039;)">            <img src="/images/icons/emoji/48.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:donate:&#039;)">            <img src="/images/icons/emoji/49.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:gold:&#039;)">            <img src="/images/icons/emoji/50.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:silver:&#039;)">            <img src="/images/icons/emoji/51.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:health:&#039;)">            <img src="/images/icons/emoji/52.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:damage:&#039;)">            <img src="/images/icons/emoji/53.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:armor:&#039;)">            <img src="/images/icons/emoji/54.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:energy:&#039;)">            <img src="/images/icons/emoji/vp1.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:vp1:&#039;)">            <img src="/images/icons/emoji/vp2.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:vp2:&#039;)">            <img src="/images/icons/emoji/vp3.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:vp3:&#039;)">            <img src="/images/icons/emoji/vp4.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:vp4:&#039;)">            <img src="/images/icons/emoji/vp5.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:vp5:&#039;)">            <img src="/images/icons/emoji/vp6.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:vp6:&#039;)">            <img src="/images/icons/emoji/vp7.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:vp7:&#039;)">            <img src="/images/icons/emoji/vp8.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:vp8:&#039;)">            <img src="/images/icons/emoji/vp9.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:vp9:&#039;)">            <img src="/images/icons/emoji/vp10.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:vp10:&#039;)">            <img src="/images/icons/emoji/vp11.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:vp11:&#039;)">            <img src="/images/icons/emoji/vp12.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:vp12:&#039;)">            <img src="/images/icons/emoji/vp13.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:vp13:&#039;)">            <img src="/images/icons/emoji/vp14.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:vp14:&#039;)">            <img src="/images/icons/emoji/vp15.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:vp15:&#039;)">            <img src="/images/icons/emoji/vp16.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:vp16:&#039;)">            <img src="/images/icons/emoji/vp17.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:vp17:&#039;)">            <img src="/images/icons/emoji/vp18.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:vp18:&#039;)">    </div>';
echo '<form id="comment" action="?p=send_gifts&id='.$ank['id'].'&pid='. htmlspecialchars($_GET['pid']).'&go" method="post">
<div class="form-group field-text">
<label class="control-label" for="text">Комментарий</label>
<textarea id="text" class="form-control" name="msg" rows="5"></textarea>

<div class="help-block"></div>
</div>

<div class="help-block"></div>
</div>    <span class="m3 btn_start middle"><span class="btn_end">
            <button type="submit" class="btn">Отправить</button></span>
    </span>
    </form></div>
</div>';


  

echo '<div class="content"><div class="block center color3 s125"> Подарок для '.$ank['login'].'</div>
            <div class="line"></div>        <div class="block">
        <img src="/images/icons/gift.png" width="16" height="16" alt="">        <a href="#">Для мужчин</a>:
        <span class="bold">(5)</span>
    </div>
    <div class="dotted"></div>
    <div class="block">
                                                    <a href="?p=send_gifts&id='.$ank['id'].'&pid=1"><img src="/images/gifts/1.png" width="40" height="40" alt=""></a>                                                        <a href="?p=send_gifts&id='.$ank['id'].'&pid=2"><img src="/images/gifts/2.png" width="40" height="40" alt=""></a>                                                        <a href="?p=send_gifts&id='.$ank['id'].'&pid=3"><img src="/images/gifts/3.png" width="40" height="40" alt=""></a>                                                        <a href="?p=send_gifts&id='.$ank['id'].'&pid=4"><img src="/images/gifts/4.png" width="40" height="40" alt=""></a>
<a href="?p=send_gifts&id='.$ank['id'].'&pid=5"><img src="/images/gifts/5.png" width="40" height="40" alt=""></a>                                     </div>
    <div class="dotted"></div>
        <div class="block">
        <img src="/images/icons/gift.png" width="16" height="16" alt="">        <a href="#"> Для женщин</a>:
        <span class="bold">(12)</span>
    </div>
    <div class="dotted"></div>
    <div class="block">
<a href="?p=send_gifts&id='.$ank['id'].'&pid=6"><img src="/images/gifts/6.png" width="40" height="40" alt=""></a>
<a href="?p=send_gifts&id='.$ank['id'].'&pid=7"><img src="/images/gifts/7.png" width="40" height="40" alt=""></a>
<a href="?p=send_gifts&id='.$ank['id'].'&pid=8"><img src="/images/gifts/8.png" width="40" height="40" alt=""></a>
<a href="?p=send_gifts&id='.$ank['id'].'&pid=9"><img src="/images/gifts/9.png" width="40" height="40" alt=""></a>
<a href="?p=send_gifts&id='.$ank['id'].'&pid=10"><img src="/images/gifts/10.png" width="40" height="40" alt=""></a>
<a href="?p=send_gifts&id='.$ank['id'].'&pid=11"><img src="/images/gifts/11.png" width="40" height="40" alt=""></a>
<a href="?p=send_gifts&id='.$ank['id'].'&pid=12"><img src="/images/gifts/12.png" width="40" height="40" alt=""></a>
<a href="?p=send_gifts&id='.$ank['id'].'&pid=13"><img src="/images/gifts/13.png" width="40" height="40" alt=""></a>
<a href="?p=send_gifts&id='.$ank['id'].'&pid=14"><img src="/images/gifts/14.png" width="40" height="40" alt=""></a>
<a href="?p=send_gifts&id='.$ank['id'].'&pid=15"><img src="/images/gifts/15.png" width="40" height="40" alt=""></a>
<a href="?p=send_gifts&id='.$ank['id'].'&pid=16"><img src="/images/gifts/16.png" width="40" height="40" alt=""></a>
<a href="?p=send_gifts&id='.$ank['id'].'&pid=17"><img src="/images/gifts/17.png" width="40" height="40" alt=""></a>
</div>
    <div class="dotted"></div>
        <div class="block">
        <img src="/images/icons/gift.png" width="16" height="16" alt="">        <a href="#">Животные</a>:
        <span class="bold">(7)</span>
    </div>
    <div class="dotted"></div>
    <div class="block">
<a href="?p=send_gifts&id='.$ank['id'].'&pid=18"><img src="/images/gifts/18.png" width="40" height="40" alt=""></a>
<a href="?p=send_gifts&id='.$ank['id'].'&pid=19"><img src="/images/gifts/19.png" width="40" height="40" alt=""></a>
<a href="?p=send_gifts&id='.$ank['id'].'&pid=20"><img src="/images/gifts/20.png" width="40" height="40" alt=""></a>
<a href="?p=send_gifts&id='.$ank['id'].'&pid=21"><img src="/images/gifts/21.png" width="40" height="40" alt=""></a>
<a href="?p=send_gifts&id='.$ank['id'].'&pid=22"><img src="/images/gifts/22.png" width="40" height="40" alt=""></a>
<a href="?p=send_gifts&id='.$ank['id'].'&pid=23"><img src="/images/gifts/23.png" width="40" height="40" alt=""></a>
<a href="?p=send_gifts&id='.$ank['id'].'&pid=24"><img src="/images/gifts/24.png" width="40" height="40" alt=""></a>
 </div>
    <div class="dotted"></div>
        <div class="block">
        <img src="/images/icons/gift.png" width="16" height="16" alt="">        <a href="#">Еда и напитки</a>:
        <span class="bold">(6)</span>
    </div>
    <div class="dotted"></div>
    <div class="block">
<a href="?p=send_gifts&id='.$ank['id'].'&pid=25"><img src="/images/gifts/25.png" width="40" height="40" alt=""></a>
<a href="?p=send_gifts&id='.$ank['id'].'&pid=26"><img src="/images/gifts/26.png" width="40" height="40" alt=""></a>
<a href="?p=send_gifts&id='.$ank['id'].'&pid=27"><img src="/images/gifts/27.png" width="40" height="40" alt=""></a>
<a href="?p=send_gifts&id='.$ank['id'].'&pid=28"><img src="/images/gifts/28.png" width="40" height="40" alt=""></a>
<a href="?p=send_gifts&id='.$ank['id'].'&pid=29"><img src="/images/gifts/29.png" width="40" height="40" alt=""></a>
<a href="?p=send_gifts&id='.$ank['id'].'&pid=30"><img src="/images/gifts/30.png" width="40" height="40" alt=""></a>
</div>
    <div class="dotted"></div>
        <div class="block">
        <img src="/images/icons/gift.png" width="16" height="16" alt="">        <a href="#">Любовь и романтика</a>:
        <span class="bold">(8)</span>
    </div>
    <div class="dotted"></div>
    <div class="block">
<a href="?p=send_gifts&id='.$ank['id'].'&pid=31"><img src="/images/gifts/31.png" width="40" height="40" alt=""></a>
<a href="?p=send_gifts&id='.$ank['id'].'&pid=32"><img src="/images/gifts/32.png" width="40" height="40" alt=""></a>
<a href="?p=send_gifts&id='.$ank['id'].'&pid=33"><img src="/images/gifts/33.png" width="40" height="40" alt=""></a>
<a href="?p=send_gifts&id='.$ank['id'].'&pid=34"><img src="/images/gifts/34.png" width="40" height="40" alt=""></a>
<a href="?p=send_gifts&id='.$ank['id'].'&pid=35"><img src="/images/gifts/35.png" width="40" height="40" alt=""></a>
<a href="?p=send_gifts&id='.$ank['id'].'&pid=36"><img src="/images/gifts/36.png" width="40" height="40" alt=""></a>
<a href="?p=send_gifts&id='.$ank['id'].'&pid=37"><img src="/images/gifts/37.png" width="40" height="40" alt=""></a>
<a href="?p=send_gifts&id='.$ank['id'].'&pid=38"><img src="/images/gifts/38.png" width="40" height="40" alt=""></a>
</div>
    <div class="dotted"></div>
        <div class="block">
        <img src="/images/icons/gift.png" width="16" height="16" alt="">        <a href="#">Дружба</a>:
        <span class="bold">(6)</span>
    </div>
    <div class="dotted"></div>
    <div class="block">
<a href="?p=send_gifts&id='.$ank['id'].'&pid=39"><img src="/images/gifts/39.png" width="40" height="40" alt=""></a>
<a href="?p=send_gifts&id='.$ank['id'].'&pid=40"><img src="/images/gifts/40.png" width="40" height="40" alt=""></a>
<a href="?p=send_gifts&id='.$ank['id'].'&pid=41"><img src="/images/gifts/41.png" width="40" height="40" alt=""></a>
<a href="?p=send_gifts&id='.$ank['id'].'&pid=42"><img src="/images/gifts/42.png" width="40" height="40" alt=""></a>
<a href="?p=send_gifts&id='.$ank['id'].'&pid=43"><img src="/images/gifts/43.png" width="40" height="40" alt=""></a>
<a href="?p=send_gifts&id='.$ank['id'].'&pid=44"><img src="/images/gifts/44.png" width="40" height="40" alt=""></a>
 </div>
    <div class="dotted"></div>
        <div class="block">
        <img src="/images/icons/gift.png" width="16" height="16" alt="">        <a href="#">Новогодние</a>:
        <span class="bold">(8)</span>
    </div>
    <div class="dotted"></div>
    <div class="block">
<a href="?p=send_gifts&id='.$ank['id'].'&pid=45"><img src="/images/gifts/45.png" width="40" height="40" alt=""></a>
<a href="?p=send_gifts&id='.$ank['id'].'&pid=46"><img src="/images/gifts/46.png" width="40" height="40" alt=""></a>
<a href="?p=send_gifts&id='.$ank['id'].'&pid=47"><img src="/images/gifts/47.png" width="40" height="40" alt=""></a>
<a href="?p=send_gifts&id='.$ank['id'].'&pid=48"><img src="/images/gifts/48.png" width="40" height="40" alt=""></a>
<a href="?p=send_gifts&id='.$ank['id'].'&pid=49"><img src="/images/gifts/49.png" width="40" height="40" alt=""></a>
<a href="?p=send_gifts&id='.$ank['id'].'&pid=50"><img src="/images/gifts/50.png" width="40" height="40" alt=""></a>
<a href="?p=send_gifts&id='.$ank['id'].'&pid=51"><img src="/images/gifts/51.png" width="40" height="40" alt=""></a>
<a href="?p=send_gifts&id='.$ank['id'].'&pid=52"><img src="/images/gifts/52.png" width="40" height="40" alt=""></a>
</div>
    <div class="dotted"></div>
        <div class="block">
        <img src="/images/icons/gift.png" width="16" height="16" alt="">        <a href="#">VIP</a>:
        <span class="bold">(6)</span>
    </div>
    <div class="dotted"></div>
    <div class="block">
<a href="?p=send_gifts&id='.$ank['id'].'&pid=53"><img src="/images/gifts/53.png" width="40" height="40" alt=""></a>
<a href="?p=send_gifts&id='.$ank['id'].'&pid=54"><img src="/images/gifts/54.png" width="40" height="40" alt=""></a>
<a href="?p=send_gifts&id='.$ank['id'].'&pid=55"><img src="/images/gifts/55.png" width="40" height="40" alt=""></a>
<a href="?p=send_gifts&id='.$ank['id'].'&pid=56"><img src="/images/gifts/56.png" width="40" height="40" alt=""></a>
<a href="?p=send_gifts&id='.$ank['id'].'&pid=57"><img src="/images/gifts/57.png" width="40" height="40" alt=""></a>
<a href="?p=send_gifts&id='.$ank['id'].'&pid=58"><img src="/images/gifts/58.png" width="40" height="40" alt=""></a>
</div>
    <div class="dotted"></div>
    </div>';



  break;
}

$pod = (isset($_GET['pod'])) ? htmlspecialchars($_GET['pod']) : null;


////////////


switch($pod) {

}


include_once 'system/f.php';
?>