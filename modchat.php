<?
    
include './system/common.php';
    
include './system/functions.php';
         
include './system/user.php';
    
if(!$user) { header('location: /'); exit; }

$title = 'Общий чат';

include './system/h.php';  


if($user['access'] == 0) {

header('location: /menu'); exit; 
  
}
else
{



  if($user['level'] < 0) {

    
  }
  else
  {

$text = _string($_POST['text']);
  $to = _string(_num($_GET['to']));

  if($to) {

      $_to = mysql_query('SELECT * FROM `users` WHERE `id` = "'.$to.'"');
      $_to = mysql_fetch_array($_to);
  
  if(!$_to OR $_to['id'] == $user['id']) {
  
    header('location: /chat/'.($_GET['clan'] == true ? 'clan/':''));
    
  exit;
  
  }
  
  }

  if($text && $user['level'] > 2) {
  
    $antiflood = mysql_fetch_array(mysql_query('SELECT * FROM `mod_chat` WHERE `clan` = \''.($_GET['clan'] == true ? $clan['id']:0).'\' AND `user` = \''.$user['id'].'\' ORDER BY `time` DESC LIMIT 1'));
  
    if(time() - $antiflood['time'] < 0) $errors[] = 'Ошибка';

	# ban chat
	
	$BanChat = mysql_query('SELECT * FROM `banned` WHERE `user` = "'.$user['id'].'" AND `chat` = "1"');
    while($BanChat = mysql_fetch_array($BanChat))
    {
		if(time() - $BanChat['time']) $errors[] = '<div class="alert"><div>                                     <div class="blue">На вас наложен бан </div><span>Осталось:'._time($BanChat['time'] - time()).'
</div></span>Причина: '.$BanChat['text'].'</div><div class="alert_bottom"></div>';
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

      if($_to) {
      
        $text = str_replace($_to['login'].', ', '', $text);
mysql_query("INSERT INTO `journal` SET  `from`='".$_to['id']."', 
						                                 `text`='Вам ответили в ЧАТЕ MOD [$text]',
						                                  `read`='0',
                                                              `time`='".time()."',`us`='".$user['id']."'");  
      
      }
      
        $text = eregi_replace( "[[:alpha:]]+://[^<>[:space:]]+[[:alnum:]/]", "*", $text);
           $arrReplace = array('.ru',
                                 '.net',
                                 '.com',
                                  '.рф',
                                  '.tk',
                                  '.su',
                                  '.us',
                                '.mobi',
                                  '.ua',
                                 
                                 '.ru',
                                

                                'http');

$size = count($arrReplace);
  while($size--)
{
if(substr_count($text, $arrReplace[$size]))
{
mysql_query("INSERT INTO `mail` SET `from`='2',`to`='1',`text`=' Пользователь ".$user['login']." | ID: ".$user['id']." нарушает правила игры! Сообщение: ".$text."',`time`='".time()."'");
mysql_query("INSERT INTO `baan` SET `user`='".$user['id']."',`time`='".(time()+(4*84000))."',`text`='Реклама сторонних ресурсов!',`who`='Система', `ip`='".$user['ip']."'");
break;
}
}
$text = str_replace($arrReplace, ' ', $text);
$typemsg=_string($_POST['typemsg']);
      if($user['access']=='2' && $typemsg=='sys'){
  
  mysql_query('INSERT INTO `mod_chat` (`clan`,
                                         `user`,
                                           `to`,
                                         `text`,
                                         `time`) VALUES ("'.($_GET['clan'] == true ? $clan['id']:0).'",
                                                         "0", 
                                                          "'.$_to['id'].'",
                                                               "'.$text.'",
                                                              "'.time().'")');


}else{
        mysql_query('INSERT INTO `mod_chat` (`clan`,
                                         `user`,
                                           `to`,
                                         `text`,
                                         `time`) VALUES ("'.($_GET['clan'] == true ? $clan['id']:0).'",
                                                         "'.$user['id'].'", 
                                                          "'.$_to['id'].'",
                                                               "'.$text.'",
                                                              "'.time().'")');
}
      
      header('location: /modchat/'.($_GET['clan'] == true ? 'clan/':''));
  
    }
  
  }
?>
<script type="text/javascript">
   function tag(text1, text2) {

                if ((document.selection)) {

                document.message.msg.focus();

                document.message.document.selection.createRange().text = text1+document.message.document.selection.createRange().text+text2;

                } else if(document.forms['message'].elements['msg'].selectionStart!=undefined) {

                var element = document.forms['message'].elements['msg'];

                var str = element.value;

                var start = element.selectionStart;

                var length = element.selectionEnd - element.selectionStart;

                element.value = str.substr(0, start) + text1 + str.substr(start, length) + text2 + str.substr(start + length);

				document.forms['message'].elements['msg'].focus();

                } else document.message.msg.value += text1+text2;

				document.forms['message'].elements['msg'].focus();}
        </script>

   <div class="content">

    <div class="block center color3 s125"><img src="/images/icons/back.png" alt=""> <a href="?">Общий чат</a></div>
            <div class="line"></div>
    <div class="h-navig"><table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tbody>            <tr><td class="h-navig-item"><span
            class="active">Чат mod</a></span></td><td class="h-navig-item"><a href="/chat/">Общий чат</a></td></tr></tbody></table>      </div>
  <div class="line"></div>



    <div class="block">

<img src="/images/icons/emoji/smile.png" width="16" height="16" alt="">&nbsp;<a id="toggler" class="tdnone dashed" href="/modchat/?nocache=618470201#?nocache=1782656872">Показать смайлы</a><div id="smiles" style="display: none;">
            <img src="/images/icons/emoji/1.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:)&#039;)">            <img src="/images/icons/emoji/2.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:-D&#039;)">            <img src="/images/icons/emoji/3.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;;-)&#039;)">            <img src="/images/icons/emoji/4.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;xD&#039;)">            <img src="/images/icons/emoji/5.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;;-P&#039;)">            <img src="/images/icons/emoji/6.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;8-)&#039;)">            <img src="/images/icons/emoji/7.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:]&#039;)">            <img src="/images/icons/emoji/8.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;3(&#039;)">            <img src="/images/icons/emoji/9.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:_-(&#039;)">            <img src="/images/icons/emoji/10.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:_(&#039;)">            <img src="/images/icons/emoji/11.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:|&#039;)">            <img src="/images/icons/emoji/12.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;8|&#039;)">            <img src="/images/icons/emoji/13.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;^3&#039;)">            <img src="/images/icons/emoji/14.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;(XX)&#039;)">            <img src="/images/icons/emoji/15.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;|O^&#039;)">            <img src="/images/icons/emoji/16.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;^FU^&#039;)">            <img src="/images/icons/emoji/17.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;^((&#039;)">            <img src="/images/icons/emoji/18.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;^zz&#039;)">            <img src="/images/icons/emoji/19.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:*&#039;)">            <img src="/images/icons/emoji/20.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:^|&#039;)">            <img src="/images/icons/emoji/21.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:(x)&#039;)">            <img src="/images/icons/emoji/22.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:pf&#039;)">            <img src="/images/icons/emoji/23.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;O^^O&#039;)">            <img src="/images/icons/emoji/24.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;}:}&#039;)">            <img src="/images/icons/emoji/25.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;}:{&#039;)">            <img src="/images/icons/emoji/26.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:like:&#039;)">            <img src="/images/icons/emoji/27.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:dislike:&#039;)">            <img src="/images/icons/emoji/28.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:up:&#039;)">            <img src="/images/icons/emoji/29.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:v:&#039;)">            <img src="/images/icons/emoji/30.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:ok:&#039;)">            <img src="/images/icons/emoji/31.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:beer:&#039;)">            <img src="/images/icons/emoji/32.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:banan:&#039;)">            <img src="/images/icons/emoji/33.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;rose&#039;)">            <img src="/images/icons/emoji/34.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:pitushok:&#039;)">            <img src="/images/icons/emoji/35.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:sos:&#039;)">            <img src="/images/icons/emoji/36.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:cel:&#039;)">            <img src="/images/icons/emoji/37.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:crown:&#039;)">            <img src="/images/icons/emoji/38.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:baby:&#039;)">            <img src="/images/icons/emoji/39.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:boom:&#039;)">            <img src="/images/icons/emoji/40.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:gun:&#039;)">            <img src="/images/icons/emoji/41.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:love:&#039;)">            <img src="/images/icons/emoji/42.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:hurt:&#039;)">            <img src="/images/icons/emoji/43.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:police:&#039;)">            <img src="/images/icons/emoji/44.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:bolls:&#039;)">            <img src="/images/icons/emoji/45.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:ear:&#039;)">            <img src="/images/icons/emoji/46.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:fuck:&#039;)">            <img src="/images/icons/emoji/47.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:smoke:&#039;)">            <img src="/images/icons/emoji/48.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:donate:&#039;)">            <img src="/images/icons/emoji/49.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:gold:&#039;)">            <img src="/images/icons/emoji/50.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:silver:&#039;)">            <img src="/images/icons/emoji/51.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:health:&#039;)">            <img src="/images/icons/emoji/52.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:damage:&#039;)">            <img src="/images/icons/emoji/53.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:armor:&#039;)">            <img src="/images/icons/emoji/54.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:energy:&#039;)">            <img src="/images/icons/emoji/vp1.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:vp1:&#039;)">            <img src="/images/icons/emoji/vp2.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:vp2:&#039;)">            <img src="/images/icons/emoji/vp3.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:vp3:&#039;)">            <img src="/images/icons/emoji/vp4.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:vp4:&#039;)">            <img src="/images/icons/emoji/vp5.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:vp5:&#039;)">            <img src="/images/icons/emoji/vp6.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:vp6:&#039;)">            <img src="/images/icons/emoji/vp7.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:vp7:&#039;)">            <img src="/images/icons/emoji/vp8.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:vp8:&#039;)">            <img src="/images/icons/emoji/vp9.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:vp9:&#039;)">            <img src="/images/icons/emoji/vp10.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:vp10:&#039;)">            <img src="/images/icons/emoji/vp11.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:vp11:&#039;)">            <img src="/images/icons/emoji/vp12.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:vp12:&#039;)">            <img src="/images/icons/emoji/vp13.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:vp13:&#039;)">            <img src="/images/icons/emoji/vp14.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:vp14:&#039;)">            <img src="/images/icons/emoji/vp15.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:vp15:&#039;)">            <img src="/images/icons/emoji/vp16.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:vp16:&#039;)">            <img src="/images/icons/emoji/vp17.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:vp17:&#039;)">            <img src="/images/icons/emoji/vp18.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:vp18:&#039;)">    <img src="/images/icons/sm/sm1.gif" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:sm1:&#039;)">    <img src="/images/icons/sm/sm2.gif" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:sm2:&#039;)">    <img src="/images/icons/sm/sm3.gif" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:sm3:&#039;)">    <img src="/images/icons/sm/sm4.gif" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:sm4:&#039;)">    <img src="/images/icons/sm/sm5.gif" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:sm5:&#039;)">    <img src="/images/icons/sm/sm6.gif" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:sm6:&#039;)">    <img src="/images/icons/sm/sm7.gif" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:sm7:&#039;)">    <img src="/images/icons/sm/sm8.gif" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:sm8:&#039;)">    <img src="/images/icons/sm/sm9.gif" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:sm9:&#039;)">    <img src="/images/icons/sm/sm10.gif" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:sm10:&#039;)">    <img src="/images/icons/sm/sm11.gif" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:sm11:&#039;)">    <img src="/images/icons/sm/sm12.gif" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:sm12:&#039;)">    <img src="/images/icons/sm/sm13.gif" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:sm13:&#039;)"> <img src="/images/icons/sm/sm14.gif" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:sm14:&#039;)">  <img src="/images/icons/sm/sm15.gif" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:sm15:&#039;)">    <img src="/images/icons/sm/sm16.gif" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:sm16:&#039;)">    <img src="/images/icons/sm/sm17.gif" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:sm17:&#039;)">    <img src="/images/icons/sm/sm18.gif" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:sm18:&#039;)">    <img src="/images/icons/sm/sm19.gif" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:sm19:&#039;)">    <img src="/images/icons/sm/sm20.gif" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:sm20:&#039;)">    <img src="/images/icons/sm/sm21.gif" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:sm21:&#039;)">    <img src="/images/icons/sm/sm22.gif" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:sm22:&#039;)">    <img src="/images/icons/sm/sm23.gif" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:sm23:&#039;)">    <img src="/images/icons/sm/sm24.gif" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:sm24:&#039;)">
<img src="/images/icons/sm/sm25.gif" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:sm25:&#039;)">    </div>      

    <form id="comment" action="/modchat/?to=<?=$to?>" method="post">


<input id="toggler" class="form-control" value="<?=($to ? $_to['login'].', ':'')?>" name="text" rows="1">

<div class="help-block"></div>
</div>        <span class="m3 btn_start middle"><span class="btn_end">
            <button type="submit" class="btn">Отправить</button></span>
        </span>
<div>


<?
if($user['access']=='2'){
?>
<Select name='typemsg'/>
<option value='adm'><?=$user['login'];?></option>
<option value='sys'>Система</option>
</Select>
<?
}
?>
        </form> 

<div class="line"></div>
  
</div>
<div>
</div>



<?
if(isset($_GET['showSmiles'])){
?>

 
<?
}

}

?>



<?

    $max = 10;
  $count = mysql_result(mysql_query('SELECT COUNT(*) FROM `mod_chat` WHERE `clan` = "'.($_GET['clan'] == true ? $clan['id']:0).'"'),0);
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



$msg = _string(_num($_GET['msg']));

       if($msg) {

    $i_msg = mysql_query('SELECT * FROM `mod_chat` WHERE `id` = "'.$msg.'"');
    $i_msg = mysql_fetch_array($i_msg);

    if(!$i_msg) {
    
      header('location: /modchat/'.($_GET['clan'] == true ? 'clan/':'').'?page='.$page);
      exit;
    
    }

    if($_GET['clan'] == true && $clan_memb['rank'] == 4 OR $user['access'] > 0) {
        
      mysql_query('DELETE FROM `mod_chat` WHERE `clan` = "'.($_GET['clan'] == true ? $clan['id']:0).'" AND`id` = "'.$i_msg['id'].'"');

    }

    header('location: /modchat/'.($_GET['clan'] == true ? 'clan/':'').'?page='.$page);

  }



$q = mysql_query('SELECT * FROM `mod_chat` WHERE `clan` = "'.($_GET['clan'] == true ? $clan['id']:0).'" ORDER BY `id` DESC LIMIT '.$start.', '.$max.'');
  while($row = mysql_fetch_array($q)) {
if($row['user']=='0'){

?>

<img src='/images/bot.png'><font color='red'> Система: </font>
<div class="green"> <?=bbc(smiles($row['text']))?>
</div>
<?
 if($row['to']) {
      $__to = mysql_query('SELECT * FROM `users` WHERE `id` = "'.$row['to'].'"');
      $__to = mysql_fetch_array($__to);
if($__to['id'] != $user['id']) {
?>
<span  class='color-quality4'>
<?
    }
?>
|   <a class="color-quality4" href="/user/<?=$__to['id']?>/"><?=$__to['login']?> </a>
<?
if($__to['id'] != $user['id']) {
?>
</span>
<?
    }
    }
?>



<?
  if($user['access'] > 0) {


?>

<a href='/modchat/<?=($_GET['clan'] == true ? 'clan/':'')?>?msg=<?=$row['id']?>'>[x]</a>

<?

  }
echo '<br/><div class="dotted"></div>';

}else{
  if($row['to'] == $user['id'] && $row['read'] == 0) {
  
    mysql_query('UPDATE `modchat` SET `read` = "1" WHERE `id` = "'.$row['id'].'"');
  
  }

  $sender = mysql_query('SELECT * FROM `users` WHERE `id` = "'.$row['user'].'"');
  $sender = mysql_fetch_array($sender);

?>

    
            <div class="block">
<?
if($sender['vip'] == 0 && $sender['access'] == 0){
?>
<img src="/images/icons/<?=$sender['r']?>.png" width="16" height="16" alt="">
<?
}

if($sender['access'] == 1) {
?>
<img src="/images/icons/mod.png" width="16" height="16" alt="">
<?
}

if($sender['access'] == 2) {
?>
<img src="/images/icons/mod.png" width="16" height="16" alt="">

<?}
if($sender['access'] == 3) {
?>
<img src="/images/icons/adminy.png" width="16" height="16" alt="">
<?
}
if($sender['vip'] == 1 && $sender['access'] == 0){
?>
<img src="/images/icons/vip_<?=($sender['r'] == man ? 'woman':'man')?>_<?=$sender['r']?>.png" width="16" height="16" alt="">
<?
}
$color=$sender['color'];
?>
  <a class="color3" href="/user/<?=$sender['id']?>/"><font style="text-shadow: 0px 5px 6px;" color=#<?=$color?>><?=$sender['login']?> </font></a>

<span class="color2 small">, <?=_times(time() - $row['time'])?>. назад</span>
<?
    if($sender['access'] == 1) {

?>

<font color='#f09060'>

<?

    }

?>


<?

    if($sender['access'] == 2) {

?>

<font color='#90c0c0'> 

<?

    }

?>
                  <div class=""> <?=bbc(smiles($row['text']))?>
</div>
</font>

    <div class="color2 small">
<?

    if($row['to']) {

      $__to = mysql_query('SELECT * FROM `users` WHERE `id` = "'.$row['to'].'"');
      $__to = mysql_fetch_array($__to);

if($__to['id'] == $user['id']) {

?>



<?

    }


?>

|  <a class="color-quality4" href="/user/<?=$__to['id']?>/"><?=$__to['login']?> </a>


<?

if($__to['id'] == $user['id']) {

?>




<?

    }
    
    }
?>



<?

  if($sender['id'] != $user['id']) {

?>| <a id='toggler' href='/modchat/<?=($_GET['clan'] == true ? 'clan/':'')?>?to=<?=$sender['id']?>'>(ответить)</a><?

  }

?>


<?

  if($user['access'] > 0) {


?>

<a href='/modchat/<?=($_GET['clan'] == true ? 'clan/':'')?>?msg=<?=$row['id']?>'>[x]</a>

<?

  }
  
?>


  </font>  
      </div>       
</div>       
<div class="dotted"></div>

<?

  }
}
  }
  else
  {
  
?>

<div class="dotted"></div>
    <div class="block">Чат пуст</div>
<?
  
  }

?>


<?

  if($clan) {
  
     $_chat = mysql_query('SELECT COUNT(*) FROM `mod_chat` WHERE `clan` = "0" AND `to` = "'.$user['id'].'" AND `read` = "0"');
     $_chat = mysql_result($_chat,0);

$_clan_chat = mysql_query('SELECT COUNT(*) FROM `mod_chat` WHERE `clan` = "'.$clan['id'].'" AND `to` = "'.$user['id'].'" AND `read` = "0"');

$_clan_chat = mysql_result($_clan_chat,0);

?>

  
<?

  }

?>



  <div class="dotted"></div>
<ul class="pagination"><li class="next"><?=pages('/modchat/?');?></li></ul>




<?

  if($_GET['read_all'] == true) {

    mysql_query('UPDATE `mod_chat` SET `read` = "1" WHERE '.($_GET['clan'] == true ? '`clan` = "'.$clan['id'].'" AND':'').' `to` = "'.$user['id'].'"');
    
    header('location: /modchat/'.($_GET['clan'] == true ? 'clan/':''));
  
  }

?>


</div>
<?

}

include './system/f.php';

?>