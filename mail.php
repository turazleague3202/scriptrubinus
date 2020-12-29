<?
    
    include './system/common.php';
    
 include './system/functions.php';
        
      include './system/user.php';
    
if(!$user) {

  header('location: /');
  
  exit;

}

$id = _string(_num($_GET['id']));

if($id) {

  $ho = mysql_fetch_array(mysql_query('SELECT * FROM `users` WHERE `id` = \''.$id.'\''));

  if(!$ho OR $id == $user['id']) {
  
    header('location: /mail/');
    
    exit;
  
  }


 

  $title = $ho['login'];    

  include './system/h.php';


  

echo '<div class="content"><div class="block center color3 s125"><a href="/mail">Малявы</a>/ <a href="/user/'.$ho['id'].'/">'.$title.'</a>/ <img src="/images/icons/circle.png" alt=""> <a href="/mail/'.$ho['id'].'/?">Переписка</a></div>
<div class="line"></div>';



 


    $max = 10;
  $count = mysql_result(mysql_query('SELECT COUNT(*) FROM `mail` WHERE `from` = "'.$user['id'].'" AND `to` = "'.$ho['id'].'" OR `to` = "'.$user['id'].'" AND `from` = "'.$ho['id'].'"'),0);
  $pages = ceil($count/$max);
   $page = _string(_num($_GET['page']));

  if($page > $pages) $page = $pages;

  if($page < 1) $page = 1;
    
  $start = $page * $max - $max;

  if($count > 0) {
    
    $col = array('#ffffff', '#f09060', '#90c0c0');
    
    $q = mysql_query('SELECT * FROM `mail` WHERE `from` = \''.$user['id'].'\' AND `to` = \''.$ho['id'].'\' OR `to` = \''.$user['id'].'\' AND `from` = \''.$ho['id'].'\' ORDER BY `time` DESC LIMIT '.$start.', '.$max.'');

    while($row = mysql_fetch_array($q)) {


$delete = _string(_num($_GET['delete']));
if($delete) {
  
    mysql_query('DELETE FROM `mail` WHERE `id` = "'.$delete.'"');
  
  header('location: ?');
  
  }

      $from = mysql_fetch_array(mysql_query('SELECT * FROM `users` WHERE `id` = \''.$row['from'].'\''));

      if($row['from']!='2'){

            echo '<div class="block">';

if($from['vip'] == 0 && $from['access'] == 0){
echo'<img src="/images/icons/'.$from['r'].'.png" width="16" height="16" alt="">';
}
if($from['access'] == 1) {
echo'<img src="/images/icons/mod.png" width="16" height="16" alt="">';
}
if($from['access'] == 2) {
echo'<img src="/images/icons/mod.png" width="16" height="16" alt="">';
}
if($from['access'] == 3) {
echo'<img src="/images/icons/adminy.png" width="16" height="16" alt="">';
}
if($from['vip'] == 1 && $from['access'] == 0){
echo'<img src="/images/icons/vip_'.($from['r'] == man ? 'woman':'man').'_'.$from['r'].'.png" width="16" height="16" alt="">';
}

echo ' <a class="color3" href="/user/'.$from['id'].'/">'.$from['login'].' </a><span class="small green"> * </span>                                    <font color=\''.$col[$from['access']].'\'>'.bb(smiles($row['text'])).'</font>            <div class="color2 small"> <div class="color2 small">'.(date('d ', $row['time']) . $monthes[(date('n', $row['time']))] . date(' H:i', $row['time'])).'               |';

if($from['id'] != $ho['id']) {
echo '<a class="color3" href="/mail/'.$id.'/?delete='.$row['id'].'">удалить</a>
';
}
    $new = mysql_result(mysql_query('SELECT COUNT(*) FROM `mail` WHERE `from` = \''.$user['id'].'\' AND `to` = \''.$ho['id'].'\' AND `read` = \'0\' AND `id` = \''.$row['id'].'\' '),0);
       if($new > 0) echo '<span color=\'#90c090\'> не прочитано</span>';
       if($new == 0) echo '<span class="color2 small">прочитано</span>';
 

echo '</div></div></div><div class="dotted"></div>';
     
  

    }elseif ($row['from']=='2') {
    

   echo '<div class="menu">';
      echo '<li><span style=\'float: right; color: '.(($row['read'] == 0) ? '#90c090':'#909090').';\'>'.(date('d ', $row['time']) . $monthes[(date('n', $row['time']))] . date(' H:i', $row['time'])).'</span><img src=\'/images/bot.png\' alt=\'\'/><font color=\'red\'> Система</font> <br/><font color=\''.$col[$from['access']].'\'>'.bb(smiles($row['text'])).'</font></li></div><div class="dotted"></div>';
}
      if($row['to'] == $user['id'] && $row['read'] == 0) mysql_query('UPDATE `mail` SET `read` = \'1\' WHERE `id` = \''.$row['id'].'\'');
  
}

echo '<div class="line"></div>';
     

echo '<div class="dotted"></div>
<ul class="pagination"><li class="next">';
echo ' '.pages('/mail/'.$ho['id'].'/?').'</li></ul>
';

  }
  else
  {
  
echo '    <div class="block">Здесь пока нет переписки</div><div class="line"></div>';
  }



 
mysql_query('INSERT INTO `contaccts` SET `user`=\''.$user['id'].'\',`ho`=\''.$ho['id'].'\',`time`=\''.time().'\'');


mysql_query('INSERT INTO `contaccts` SET `user`=\''.$user['id'].'\',`ho`=\''.$ho['id'].'\',`time`=\''.time().'\'');

mysql_query('INSERT INTO `connntacts` (`user`, `ho`,
`time`) VALUES (\''.$user['id'].'\',
 \''.$ho['id'].'\', \''.time().'\')');


 if(mysql_result(mysql_query('SELECT COUNT(*) FROM `contacts` WHERE `user` = \''.$user['id'].'\' AND `ho` = \''.$ho['id'].'\''),0) == 0) {
    
    mysql_query('INSERT INTO `contacts` (`user`,
                                           
                                           `ho`,
                                         
                                         `time`) VALUES (\''.$user['id'].'\',
                                         
                                                           \''.$ho['id'].'\',
                                         
                                                              \''.time().'\')');
  
  
  }

  if(mysql_result(mysql_query('SELECT COUNT(*) FROM `contacts` WHERE `ho` = "'.$user['id'].'" AND `user` = "'.$ho['id'].'"'),0) == 0) {
   
    mysql_query('INSERT INTO `contacts` (`ho`,
    
                                       `user`,
    
                                       `time`) VALUES (\''.$user['id'].'\',
    
                                                         \''.$ho['id'].'\',
    
                                                            \''.time().'\')');
  
  }



  if($ho['r'] != $user['r']) $_s = 0; else $_s = 0;


  $text = _string($_POST['text']);
  
  if($text) {

    $antiflood = mysql_fetch_array(mysql_query('SELECT * FROM `mail` WHERE `from` = \''.$user['id'].'\' ORDER BY `time` DESC LIMIT 1'));
  
    if(time() - $antiflood['time'] < 10) $errors[] = 'Ошибка';


	$BanChat = mysql_query('SELECT * FROM `banned` WHERE `user` = "'.$user['id'].'" AND `chat` = "1"');
    while($BanChat = mysql_fetch_array($BanChat))
    {
		if(time() - $BanChat['time']) $errors[] = '<div class="alert"><div>                                     <div class="blue">На вас наложен бан </div><span>Осталось:'._time($BanChat['time'] - time()).'
</div></span>Причина: '.$BanChat['text'].'</div><div class="alert_bottom"></div>';
	}
  
    if($user['s'] < $_s) $errors[] = 'Ошибка, не хватает <img src=\'/images/icon/silver.png\' alt=\'*\'/> '.($_s - $user['s']).' серебра<div class=\'separator\'></div><a href=\'/trade/\' class=\'button\'>Купить</a>';

    if($errors) {

      echo '<div class=\'content\' align=\'center\'>';
        
      foreach($errors as $error) {
          
        echo $error.'<br/>';
          
      }
      
      echo 'ю';

    }
    else
    {

      
        $text = eregi_replace( "[[:alpha:]]+://[^<>[:space:]]+[[:alnum:]/]", "*", $text);
        
        $arrReplace = array('.ru',
                                 '.net',
                                 '.com',
                                  '.рф',
                                  '.tk',
                                  '.su',
                                  '.us',
 '.keo', 'http', 'www',
                                '.mobi',
                                  '.ua',
                                'заходи на сайт', 'ссылку без',
                                 '.ru',
                                
                                'http','заходи в игру','btvar.ru');

$size = count($arrReplace);
  while($size--)
{
if(substr_count($text, $arrReplace[$size]))
{
mysql_query("INSERT INTO `mail` SET `from`='2',`to`='1',`text`=' Пользователь ".$user['login']." | ID: ".$user['id']." нарушает правила игры! Сообщение: ".$text."',`time`='".time()."'");
mysql_query("INSERT INTO `ban` SET `user`='".$user['id']."',`time`='".(time()+(56*84000))."',`text`='Нарушение правил игры!',`who`='Система', `ip`='".$user['ip']."'");
break;
}
}
$text = str_replace($arrReplace, '*', $text);
if($ho['access'] == '4'){

echo '   <div class="content"><div class="block center color3 s125"> <div class="block">Ошибка, Запрешено писать администраторам игры !!!<div> Есть вопросы пишите в тех.поддержку !</div></div></div></div>';
}else{
if($user['level']<15){

$_SESSION['not']='<div class="dotted"></div>
    <div class="block">писать можно с 15 уровня</div>';
header('location: ?');
exit;
}else{
}
      mysql_query('UPDATE `users` SET `s` = `s` - '.$_s.' WHERE `id` = \''.$user['id'].'\'');



      mysql_query('INSERT INTO `mail` (`from`,
      
                                         `to`,
      
                                       `text`,
      
                                       `time`) VALUES (\''.$user['id'].'\',
                                                         
                                                         \''.$ho['id'].'\',
      
                                                             \''.$text.'\',
      
                                                            \''.time().'\')');
                                                       
  
      mysql_query('UPDATE `contacts` SET `time` = \''.time().'\' WHERE `user` = \''.$user['id'].'\' AND `ho` = \''.$ho['id'].'\'');
     
      mysql_query('UPDATE `contacts` SET `time` = \''.time().'\' WHERE `ho` = \''.$user['id'].'\' AND `user` = \''.$ho['id'].'\'');
     
$randum = rand(3764,5677);
      header('location: /mail.php?id='.$ho['id'].'&'.$randum.'');
   
    }

  }

}


 
 


if($ho['id']!='2'){

echo '<div class="block">
<img src="/images/icons/emoji/smile.png" width="16" height="16" alt="">&nbsp;<a id="toggler" class="tdnone dashed" href="?nocache=618470201#?nocache=1782656872">Показать смайлы</a><div id="smiles" style="display: none;">
            <img src="/images/icons/emoji/1.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:)&#039;)">            <img src="/images/icons/emoji/2.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:-D&#039;)">            <img src="/images/icons/emoji/3.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;;-)&#039;)">            <img src="/images/icons/emoji/4.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;xD&#039;)">            <img src="/images/icons/emoji/5.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;;-P&#039;)">            <img src="/images/icons/emoji/6.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;8-)&#039;)">            <img src="/images/icons/emoji/7.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:]&#039;)">            <img src="/images/icons/emoji/8.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;3(&#039;)">            <img src="/images/icons/emoji/9.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:_-(&#039;)">            <img src="/images/icons/emoji/10.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:_(&#039;)">            <img src="/images/icons/emoji/11.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:|&#039;)">            <img src="/images/icons/emoji/12.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;8|&#039;)">            <img src="/images/icons/emoji/13.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;^3&#039;)">            <img src="/images/icons/emoji/14.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;(XX)&#039;)">            <img src="/images/icons/emoji/15.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;|O^&#039;)">            <img src="/images/icons/emoji/16.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;^FU^&#039;)">            <img src="/images/icons/emoji/17.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;^((&#039;)">            <img src="/images/icons/emoji/18.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;^zz&#039;)">            <img src="/images/icons/emoji/19.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:*&#039;)">            <img src="/images/icons/emoji/20.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:^|&#039;)">            <img src="/images/icons/emoji/21.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:(x)&#039;)">            <img src="/images/icons/emoji/22.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:pf&#039;)">            <img src="/images/icons/emoji/23.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;O^^O&#039;)">            <img src="/images/icons/emoji/24.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;}:}&#039;)">            <img src="/images/icons/emoji/25.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;}:{&#039;)">            <img src="/images/icons/emoji/26.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:like:&#039;)">            <img src="/images/icons/emoji/27.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:dislike:&#039;)">            <img src="/images/icons/emoji/28.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:up:&#039;)">            <img src="/images/icons/emoji/29.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:v:&#039;)">            <img src="/images/icons/emoji/30.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:ok:&#039;)">            <img src="/images/icons/emoji/31.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:beer:&#039;)">            <img src="/images/icons/emoji/32.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:banan:&#039;)">            <img src="/images/icons/emoji/33.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;rose&#039;)">            <img src="/images/icons/emoji/34.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:pitushok:&#039;)">            <img src="/images/icons/emoji/35.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:sos:&#039;)">            <img src="/images/icons/emoji/36.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:cel:&#039;)">            <img src="/images/icons/emoji/37.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:crown:&#039;)">            <img src="/images/icons/emoji/38.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:baby:&#039;)">            <img src="/images/icons/emoji/39.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:boom:&#039;)">            <img src="/images/icons/emoji/40.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:gun:&#039;)">            <img src="/images/icons/emoji/41.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:love:&#039;)">            <img src="/images/icons/emoji/42.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:hurt:&#039;)">            <img src="/images/icons/emoji/43.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:police:&#039;)">            <img src="/images/icons/emoji/44.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:bolls:&#039;)">            <img src="/images/icons/emoji/45.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:ear:&#039;)">            <img src="/images/icons/emoji/46.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:fuck:&#039;)">            <img src="/images/icons/emoji/47.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:smoke:&#039;)">            <img src="/images/icons/emoji/48.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:donate:&#039;)">            <img src="/images/icons/emoji/49.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:gold:&#039;)">            <img src="/images/icons/emoji/50.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:silver:&#039;)">            <img src="/images/icons/emoji/51.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:health:&#039;)">            <img src="/images/icons/emoji/52.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:damage:&#039;)">            <img src="/images/icons/emoji/53.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:armor:&#039;)">            <img src="/images/icons/emoji/54.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:energy:&#039;)">            <img src="/images/icons/emoji/vp1.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:vp1:&#039;)">            <img src="/images/icons/emoji/vp2.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:vp2:&#039;)">            <img src="/images/icons/emoji/vp3.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:vp3:&#039;)">            <img src="/images/icons/emoji/vp4.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:vp4:&#039;)">            <img src="/images/icons/emoji/vp5.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:vp5:&#039;)">            <img src="/images/icons/emoji/vp6.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:vp6:&#039;)">            <img src="/images/icons/emoji/vp7.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:vp7:&#039;)">            <img src="/images/icons/emoji/vp8.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:vp8:&#039;)">            <img src="/images/icons/emoji/vp9.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:vp9:&#039;)">            <img src="/images/icons/emoji/vp10.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:vp10:&#039;)">            <img src="/images/icons/emoji/vp11.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:vp11:&#039;)">            <img src="/images/icons/emoji/vp12.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:vp12:&#039;)">            <img src="/images/icons/emoji/vp13.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:vp13:&#039;)">            <img src="/images/icons/emoji/vp14.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:vp14:&#039;)">            <img src="/images/icons/emoji/vp15.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:vp15:&#039;)">            <img src="/images/icons/emoji/vp16.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:vp16:&#039;)">            <img src="/images/icons/emoji/vp17.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:vp17:&#039;)">            <img src="/images/icons/emoji/vp18.png" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:vp18:&#039;)"><img src="/images/icons/sm/sm1.gif" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:sm1:&#039;)">    <img src="/images/icons/sm/sm2.gif" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:sm2:&#039;)">    <img src="/images/icons/sm/sm3.gif" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:sm3:&#039;)">    <img src="/images/icons/sm/sm4.gif" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:sm4:&#039;)">    <img src="/images/icons/sm/sm5.gif" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:sm5:&#039;)">    <img src="/images/icons/sm/sm6.gif" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:sm6:&#039;)">    <img src="/images/icons/sm/sm7.gif" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:sm7:&#039;)">    <img src="/images/icons/sm/sm8.gif" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:sm8:&#039;)">    <img src="/images/icons/sm/sm9.gif" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:sm9:&#039;)">    <img src="/images/icons/sm/sm10.gif" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:sm10:&#039;)">    <img src="/images/icons/sm/sm11.gif" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:sm11:&#039;)">    <img src="/images/icons/sm/sm12.gif" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:sm12:&#039;)">    <img src="/images/icons/sm/sm13.gif" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:sm13:&#039;)"> <img src="/images/icons/sm/sm14.gif" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:sm14:&#039;)">  <img src="/images/icons/sm/sm15.gif" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:sm15:&#039;)">    <img src="/images/icons/sm/sm16.gif" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:sm16:&#039;)">    <img src="/images/icons/sm/sm17.gif" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:sm17:&#039;)">    <img src="/images/icons/sm/sm18.gif" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:sm18:&#039;)">    <img src="/images/icons/sm/sm19.gif" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:sm19:&#039;)">    <img src="/images/icons/sm/sm20.gif" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:sm20:&#039;)">    <img src="/images/icons/sm/sm21.gif" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:sm21:&#039;)">    <img src="/images/icons/sm/sm22.gif" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:sm22:&#039;)">    <img src="/images/icons/sm/sm23.gif" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:sm23:&#039;)">    <img src="/images/icons/sm/sm24.gif" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:sm24:&#039;)">
<img src="/images/icons/sm/sm25.gif" alt="" style="cursor: pointer; margin: 3px;" onclick="InsertSmile(&#039;:sm25:&#039;)">    </div>';

echo '<form id="comment" action="/mail.php?id='.$ho['id'].'/?'.$randum = rand(3764,5677).'" method="post">
   <div class="form-group field-text required">
<label class="control-label" for="text">Текст малявы</label>
<textarea id="text" class="form-control" name="text" rows="10"></textarea>

<div class="help-block"></div>
</div>        <span class="m3 btn_start middle"><span class="btn_end">
            <button name="send_message" type="submit" class="btn">Отправить</button></span>
    </span>
 
</div>
    </form></div>
';



  
}else{

  
}

  include './system/f.php';

}
else
{
  
  $title = 'Малява';    

  include './system/h.php';



echo ' <div class="content"><div class="block center color3 s125">Малявы</div><div class="line"></div>
';

    $max = 10;
  $count = mysql_result(mysql_query('SELECT COUNT(*) FROM `contacts` WHERE `user` = \''.$user['id'].'\''),0);
  $pages = ceil($count/$max);
   $page = _string(_num($_GET['page']));

  if($page > $pages) $page = $pages;
  
  if($page < 1) $page = 1;
    
  $start = $page * $max - $max;

  if($count > 0) {

  

if(isset($_GET['read_all'])) {

    mysql_query('UPDATE `mail` SET `read` = "1" WHERE `to` = "'.$user['id'].'"');
    
    header('location: /mail/?'.$udet.'');
  
  }


    $q = mysql_query('SELECT * FROM `contacts` WHERE `user` = \''.$user['id'].'\' ORDER BY `time` DESC LIMIT '.$start.', '.$max.'');

    while($row = mysql_fetch_array($q)) {

      $ho = mysql_fetch_array(mysql_query('SELECT * FROM `users` WHERE `id` = \''.$row['ho'].'\''));

if(isset($_GET['dialogs'])) {
mysql_query('DELETE FROM `mail` WHERE `from` = \''.$ho['id'].'\' AND `to` = "'.$user['id'].'" AND `from` = \''.$user['id'].'\' AND `to` = "'.$ho['id'].'"');
mysql_query('DELETE FROM `contacts` WHERE `user` = "'.$user['id'].'"');
header('location: /mail/?'.$udet.'');
}
    $new = mysql_result(mysql_query('SELECT COUNT(*) FROM `mail` WHERE `from` = \''.$ho['id'].'\' AND `to` = \''.$user['id'].'\' AND `read` = \'0\''),0);
       
      if($ho['id']=='2'){


    echo '<div class="menu">                            <li><a href="/mail/'.$row['ho'].'/"><img src="/images/icons/mail.png" width="16" height="16" alt=""> Система ';

if($new > 0) echo '<font color=\'#90c090\'>[не прочитано +'.$new.']</font>';
    if($new == 0) echo '<font color=\'#90c090\'> [прочитано]</font>';
echo' </a></li></div><div class="dotted"></div>';
      }else{

    echo '<div class="menu">                            <li><a href="/mail/'.$row['ho'].'/"><img src="/images/icons/mail.png" width="16" height="16" alt=""> '.$ho['login'].' ';
if($new > 0) echo '<font color=\'#90c090\'>[не прочитано +'.$new.']</font>';
    if($new == 0) echo '<font color=\'#90c090\'> [прочитано]</font>';
echo' </a></li></div><div class="dotted"></div>';

  }
  
    $lost = mysql_fetch_array(mysql_query('SELECT * FROM `mail` WHERE `from` = \''.$user['id'].'\' AND `to` = \''.$ho['id'].'\' OR `to` = \''.$user['id'].'\' AND `from` = \''.$ho['id'].'\' ORDER BY `time` DESC LIMIT 1'));
    

    
    }

  

echo '<div class="dotted"></div>
<ul class="pagination"><li class="next">';
echo ' '.pages('/mail/?').'</li></ul>
';
  }
  else
  {


echo '    <div class="block">Здесь будет выводиться ваша переписка с другими арестантами</div>';
  }

echo '<div class="line"></div>
<div class="menu">    <li><a href="?dialogs"><img src="/images/icons/cross.png" width="16" height="16" alt=""> Удалить все диалоги</a></li>
<li><a href="?read_all"><img src="/images/icons/ok.png" width="16" height="16" alt=""> Отметить всё как прочитано!</a></li>
</div></div>';
  include './system/f.php';

}

?>