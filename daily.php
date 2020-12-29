<?
    include './system/common.php';
    
 include './system/functions.php';
        
      include './system/user.php';

include './system/h.php';  
if($user['level']<=59){
header('Location: /menu?');exit;

}
# ID
$id = _string(_num($_GET['id']));
  if($id) {
    $users = mysql_query('SELECT * FROM `users` WHERE `id` = "'.$id.'"');
    $users = mysql_fetch_array($users);
    
    if(!$users) {
      header('location: /user/');
      exit;
    }

    }
    else
    { 
      $users = $user;
    }
	
	   $title = ' '.$users['login'].'';    
	
# zadanij
if($users['boss4'] > 50) $users['boss4'] = 50;
if($users['bunt'] > 6) $users['bunt'] = 6;
if($users['go'] > 3) $users['go'] = 3;
if($users['are'] > 100) $users['are'] = 100;
if($users['bos7'] > 10) $users['bos7'] = 10;
if($users['bos10'] > 8) $users['bos10'] = 8;
if($users['zdk'] > 6) $users['zdk'] = 6;
#zadanij2
if($users['bosy2'] > 30) $users['bosy2'] = 30;
if($users['bosy4'] > 15) $users['bosy4'] = 15;
if($users['bosy6'] > 20) $users['bosy6'] = 20;
if($users['are1'] > 80) $users['are1'] = 80;
if($users['bossy3'] > 18) $users['bossy3'] = 18;
if($users['bossy5'] > 14) $users['bossy5'] = 14;
if($users['chat_ob'] > 200) $users['chat_ob'] = 200;
# array
$ach = array (''.$users['bosy2'].'',''.$users['bosy4'].'',''.$users['bosy6'].'',''.$users['are1'].'',''.$users['bossy3'].'',''.$users['bossy5'].''
,''.$users['chat_ob'].'');
$ach1 = array (''.$users['boss4'].'',''.$users['bunt'].'',''.$users['go'].'',''.$users['are'].'',''.$users['bos7'].'',''.$users['bos10'].''
,''.$users['zdk'].'');
$ach3 = array (''.$users['bosy2'].'',''.$users['bosy4'].'',''.$users['bosy6'].'',''.$users['are1'].'');

$level = array('30','15','20','80','18','14','200');
$level1 = array('50','6','3','100','10','8','6');
$cost = array('16','18','16','20','18','35','100');
$cost2 = array('1200','1750','1300','2450','2320','3480','3677');
$cost3 = array('1130','1367','1424','1589','2368','2186','3367');
$cost4 = array('120','145','100','80','130','180','780');
$cost5 = array('3200','3650','2300','4450','4320','6480','16460');
$cost6 = array('6200','6650','4300','6450','7320','7435','23870');
$text1 = array (' Победи Топора в Побеге',' Победи Монгола в Побеге ',' Победи Константина в Побеге ','Одержи 80 побед в Разборке',' Победи Копа в Подвале','Победи Аборигенов в Подвале','Общайся в чате');

$text2 = array (' Победи Монгола в Побеге',' Проведи 6 боёв в Бунте ',' Проведи  3 боя в Голодовке ','Одержи 100 побед в Разборке',' Победи Анархиста в Подвале','Победи Бальтазара в Подвале','Выполни все срочняки');


$complexity = _string(_num($_GET['complexity']));
if($complexity) {

  if($complexity == 1 OR $complexity == 2) {
  }
if($complexity == 333) {
echo' <div class="content"><div class="block center color3 s125"><a href="/user/'.$users['id'].'"> '.$users['login'].'</a>/ Еженедельные срочняки</div>
            <div class="line"></div>
';
echo' <div class="h-navig"><table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tbody><tr><td class="h-navig-item"><a href="?complexity=1">Ежечасное</a></td>
		<td class="h-navig-item"><a href="?complexity=2">Ежедневные</a></td>
		<td class="h-navig-item"><span class="active">Еженедельные</span></td>
		</tr></tbody></table></div>
<div class="dotted"></div>
';

}}

if(!$complexity==1 OR $complexity==1) {
echo' <div class="content"><div class="block center color3 s125"><a href="/user/'.$users['id'].'"> '.$users['login'].'</a>/ Ежечасные срочняки</div>
            <div class="line"></div>
';
echo' <div class="h-navig"><table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tbody><tr><td class="h-navig-item"><span class="active">Ежечасные</span></td>
		<td class="h-navig-item"><a href="?complexity=2">Ежедневные</a></td>
		</tr></tbody></table></div>
<div class="dotted"></div>';
for ($i = 0; $i < 7; $i++)
{
$pro = round(100 / ($level[$i]/$ach[$i]));
if($hp_m){
$hp_m=100;
}

?>

 <div class="block">
    <table>
        <tbody>
        <tr>
            <td>
                <?=($ach[$i] == $level[$i] ? '<img src=\'/images/icons/ok.png\'>':'<img src=\'/images/icons/cross.png\'>')?>
                                <?=$text1[$i];?>
                            </td>
        </tr>
        <tr>
            <td>
Прогресс: <span class="green"> <?=$ach[$i]; ?> из  <?=$level[$i]; ?></span>
<div style="width: 100%; height: 4px"
            class="progress-grey">
            <div style="width: <?=$pro; ?>%; height: 4px" class="progress-green"></div></div></td>
        </tr>
        <tr>
            <td>
<?=($ach[$i] == $level[$i] ? '[<span class="green">Выполнено</span>]':'Награда: <img src=\'/images/icons/gold.png\'>'.$cost[$i].'
<img src=\'/images/icons/silver.png\'>'.$cost2[$i].' <img src=\'/images/icons/experience.png\'>'.$cost3[$i].'')?>
<?if($i == 6){?>
<img src="/images/icons/donate.png" width="16" height="16" alt=""> 50 <?}?>
</td>
        </tr>
        </tbody>
    </table>
</div>    <div class="dotted"></div>

           
<?
}  
}
if($complexity == 2) {
echo' <div class="content"><div class="block center color3 s125"><a href="/user/'.$users['id'].'"> '.$users['login'].'</a>/ Ежедневные срочняки</div>
            <div class="line"></div>
';
echo' <div class="h-navig"><table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tbody><tr><td class="h-navig-item"><a href="?complexity=1">Ежечасное</a></td><td class="h-navig-item"><span class="active">Ежедневные</span></td>
		</tr></tbody></table></div>
<div class="dotted"></div>
';

for ($i = 0; $i < 7; $i++)
{
$pro = round(100 / ($level1[$i]/$ach1[$i]));
if($hp_m){
$hp_m=100;
}

?>

 <div class="block">
    <table>
        <tbody>
        <tr>
            <td>
                <?=($ach1[$i] == $level1[$i] ? '<img src=\'/images/icons/ok.png\'>':'<img src=\'/images/icons/cross.png\'>')?>
                                <?=$text2[$i];?>
                            </td>
        </tr>
        <tr>
            <td><div style="width: 100%; height: 4px"
            class="progress-grey">
            <div style="width: <?=$pro; ?>%; height: 4px" class="progress-green"></div></div></td>
        </tr>
        <tr>
            <td>Прогресс: <span class="green"> <?=$ach1[$i]; ?> из  <?=$level1[$i]; ?></span>
</td>
        </tr>
        </tbody>
    </table>
<?if($i == 6){?>
<?=($ach[$i] == $level[$i] ? '[<span class="green">Выполнено</span>]':'Награда: <img src=\'/images/icons/gold.png\'>'.$cost4[$i].'
<img src=\'/images/icons/silver.png\'>'.$cost5[$i].' <img src=\'/images/icons/experience.png\'>'.$cost6[$i].'')?>

<?}?>
</div>    <div class="dotted"></div>

           
<?
}  
}
?>
<div class="dotted"></div>
<ul class="block">
 <li class="small color1">Ежечасные Срочняки обновляются каждый час.</li>
    <li class="small color3">Ежедневные Срочняки обновляются в 00:00 по игровому времени</li>
</ul></div>
</div>
<?
include './system/f.php';

?>