<?
    
    include './system/common.php';
    
 include './system/functions.php';
        
      include './system/user.php';
    
if(!$user) {

  header('location: /');
    
exit;

}

if($user['level'] >= 0) {
}else{

$_SESSION['not']='<div class="alert"><div>                закрыт временно!!!</div></div>';
header('location: /menu?'.$udet.'');
    exit;
}
$title =' Обменник ';
    include './system/h.php';
if(isset($_GET['form'])){
$fygy=rand(111111,999999);
    $count= _string(_num($_POST['count']));
 $ftyp = _string($_POST['ftyp']);
    $ttyp = _string($_POST['ttyp']);
$lol=rand(1,10);
$resy=round($count/200);

if($count < 0 or $resy < 0)$err = 'Ошибка взноса средств';
if($count < 199)$err = 'Ошибка взноса средств';
 if(!$err){

if($_POST['count'] < $user['s_limit']+1) {

 if($count >$user['s_limit'])$err = 'Ошибка взноса средств';
 mysql_query('UPDATE `users` SET `s_limit` = `s_limit` - '.$count.' WHERE `id` = "'.$user['id'].'"');


if($user['g'] <$resy ){
$_SESSION['not']='<div class="alert">                                  Ошибка, не хватает ресурсов!</div><div class="alert_bottom"></div>';
header('Location: ?');
exit;
}


$texy="обменяно <img src=/images/icons/gold.png width=16 height=16 alt=> $resy <img src=/images/icons/silver.png width=16 height=16 alt=> $count ";
mysql_query('INSERT INTO `golds` SET `user` = "'.$user['id'].'",`time` = "'.time().'",`text` = "'.$texy.'",`loc`="4"');

  mysql_query('UPDATE `users` SET `'.$ttyp.'` = `'.$ttyp.'` + '.$count.' WHERE `id` = "'.$user['id'].'"');
  mysql_query('UPDATE `users` SET `'.$ftyp.'` = `'.$ftyp.'` - '.$resy.' WHERE `id` = "'.$user['id'].'"');

$_SESSION['not']='<div class="alert">                                   <img src="/images/icons/ok.png" width="16" height="16" alt=""> Ресурсы успешно обменены</div><div class="alert_bottom"></div>';
header('location: /exchanger.php?'.$fygy.'');
exit;

}else{
header('location: ?'.$fygy.'');
exit;
}
}
}

?>
    <div class="content"><div class="block center color3 s125">Обменник</div>
            <div class="line"></div><div class="block">
                                <div></div>
                            <img src="/images/icons/gold.png" width="16" height="16" alt=""> 5 =
                <img src="/images/icons/silver.png" width="16" height="16" alt=""> 200,
            не более
<div class="hint-block">Сегодня не более <?=$user['s_limit']?><img src="/images/icons/silver.png" alt=""></div>
</div>
<?if($user['s_limit'] ==0){?><div class="block">Лимит обновится через <?=_time($user['times_limit'] -time())?></div>
<?}?>
<div class="dotted"></div>
<form class="block" action="exchanger.php?form" method="post">
<div class="form-group field-exchangertransactionform-from_resource required">
<label class="control-label" for="exchangertransactionform-from_resource">Отдаём</label>
<select class="form-control" name="ftyp">
<option value="g">Сахар</option>
</select>

<div class="help-block"></div>
</div><div class="form-group field-exchangertransactionform-to_resource required">
<label class="control-label" for="exchangertransactionform-to_resource">Получаем</label>
<select class="form-control" name="ttyp">
<option value="s">Рубли</option>
</select>

<div class="help-block"></div>
</div><div class="form-group field-exchangertransactionform-to_amount required">
<label class="control-label" for="exchangertransactionform-to_amount">Получаем кол-во</label>
<input type="text" class="form-control" name="count" vslue="<?=$count?>" maxlength="6">

<div class="help-block"></div>
</div><span class="m3 btn_start middle">
    <span class="btn_end">
        <button type="submit" class="btn">Сохранить</button>    </span>
</span>
</form></div>
<?

  include './system/f.php';
?>
