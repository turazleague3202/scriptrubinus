<?
    
    include './system/common.php';
    
 include './system/functions.php';
        
      include './system/user.php';
    
if(!$user) {

  header('location: /');
    
exit;

}

$title =' название';
    include './system/h.php';
?>

                        
    <div class="content"><div class="block center color3 s125"><a href="/user/<?=$user['id']?>"><?=$user['login']?></a>/ Способности</div>
            <div class="line"></div>    <div class="block">
    <div class="left mr8">
        <img src="/images/series.jpg" alt="">    </div>
    <img src="/images/icons/series.png" width="16" height="16" alt="">        Двойной удар: <span class="green"><?=$user['lvl_sp']?> раз</span> <span class="blue">(<?=$user['lvl_sp']?> из 20)</span>
        <div class="small">Серия ударов</div>
    <div class="m3"></div>
    <div style="margin: 0 0 0 56px;">
        <div style="width: 100%; height: 4px"
            class="progress-white">
            <div style="width: <?=$progress_sp = round(100 / (20/$user['lvl_sp']));
?>%; height: 4px" class="progress-green"></div></div>    </div>
                    <div class="small blue">
            бонус +<?=$user['lvl_sp']*275?> к силе        </div>
                <div class="block"></div>

<?
     $lvl = 1500+ ($user['lvl_sp'] * 2500)*2;
    $lvl1 = 20 + ($user['lvl_sp'] * 6)*3;

$str1 = ($user['lvl_sp'] * 275);
  if($user['lvl_sp'] < 20) {

  if(isset($_GET['train'])) {
if($lvl1 && $lvl <$user['s'] && $user['d']){
}else{

$_SESSION['err'] = '<div class="alert">
    <div class="color1 s125">Не хватает Ресурсов</div>
    <div class="a_separator"></div>
   </div>';

header('location: ?'.$udet.'');
}
    if($user['lvl_sp'] >= 20) {
  
}else{
if($user['s']>=$lvl && $user['d']>=$lvl1)
{
    mysql_query('UPDATE `users` SET `s` = "'.($user['s']-$lvl).'", `d` = "'.($user['d']-$lvl1).'",`lvl_sp`=`lvl_sp`+1,`str`=`str` + '.$str1.' WHERE `id` = "'.$user['id'].'"');
    
    header('location: ?'.$udet.'');
    
    }
  
}
  }

  
?>
      <div class="dotted"></div>
      <div class="block center">
                        <span class="btn_start"><span class="btn_end"><a class="btn" href="?train=<?=$udet?>">Прокачать за     <img src="/images/icons/silver.png" width="16" height="16" alt="">  <?=$lvl?>    <img src="/images/icons/donate.png" width="16" height="16" alt="">  <?=$lvl1?></a></span> </span>  </div>


<?
  }
?>
        <div class="clear"></div>
</div>    <div class="dotted"></div>
<ul class="block">
    <li class="small">Способности позволяют сделать персонажа сильнее!</li>
    <li class="small">Способности работают только в подвале!</li>
    <li class="small">Способности, помимо прямого назначения, также дают бонус к параметрам!</li>
</ul></div>


<?
include './system/f.php';
?>