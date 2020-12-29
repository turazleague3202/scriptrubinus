<?
    include './system/common.php';
    
 include './system/functions.php';
        
      include './system/user.php';

include './system/h.php';  
if(!$clan){
header('Location: /menu?');exit;

}
# ID
$id = _string(_num($_GET['id']));

if(!$id && $clan) {
    $id = $clan['id'];
}
  $i = mysql_query('SELECT * FROM `clans` WHERE `id` = "'.$id.'"');
  $i = mysql_fetch_array($i);
  if(!$i) {
      header('location: /clans/');
  exit;
  }
	   $title = ' '.$cln['name'].'';    
	
# zadanij
if($i['bos3'] > 700) $i['bos3'] = 700;
if($i['bos5'] > 350) $i['bos5'] = 350;
if($i['bos7'] > 200) $i['bos7'] = 200;

# array
$ach = array (''.$i['bos3'].'',''.$i['bos5'].'',''.$i['bos7'].'');

$level = array('700','350','200');

$cost = array('350','400','750');
$cost2 = array('24200','34750','45300');
$cost3 = array('240000','290000','350000');

$text = array (' Победи Копа в Подвале',' Победи Абориген в Подвале ',' Победи Анархист в Подвале ');


echo' <div class="content"><div class="block center color3 s125"><a href="/clan/'.$i['id'].'"> '.$i['name'].'</a>/ Ежедневные срочняки</div>
            <div class="line"></div>
';

for ($i = 0; $i < 3; $i++)
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
                                <?=$text[$i];?>
                            </td>
        </tr>
        <tr>
            <td><div style="width: 100%; height: 4px"
            class="progress-grey">
            <div style="width: <?=$pro; ?>%; height: 4px" class="progress-green"></div></div></td>
        </tr>
        <tr>
            <td>Прогресс: <span class="green"> <?=$ach[$i]; ?> из  <?=$level[$i]; ?></span>
</td>
        </tr>
        </tbody>
    </table>
<?=($ach[$i] == $level[$i] ? '[<span class="green">Выполнено</span>]':'Награда: <img src=\'/images/icons/gold.png\'>'.$cost[$i].'
<img src=\'/images/icons/silver.png\'>'.$cost2[$i].' <img src=\'/images/icons/experience.png\'>'.$cost3[$i].'')?>
</div>    <div class="dotted"></div>

           
<?
}
?>
<div class="dotted"></div>
<ul class="block">
  <li class="small color3">Ежедневные Срочняки обновляются в 00:00 по игровому времени</li>
</ul></div>
</div>
<?
include './system/f.php';

?>