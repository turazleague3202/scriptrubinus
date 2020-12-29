<?
include './system/common.php';
include './system/functions.php';
include './system/user.php';
if(!$user) {header('location: /');exit;}
$title =' название';
include './system/h.php';
$b = mysql_query('SELECT * FROM `dice` WHERE `user` = "'.$user['id'].'"');
$b = mysql_fetch_array($b);


$cy=rand(1,3);
$dy=rand(1,4);
if(isset($_GET['sh'])) {
mysql_query('UPDATE `dice` SET `d` =  `d` + "'.$cy.'", `c` =  `c` + "'.$dy.'"WHERE `user` = "'.$user['id'].'"');

header('location: /dice/ger/?');

}
if(isset($_GET['ger'])) {

echo '<div class="content">
                    <div class="block center color3 s125"><img src="/images/icons/circle.png" alt=""> <a href="/dice?nocache=317130358">Кости</a><span class="white">,</span></div>
            <div class="line"></div> 

<div class="block center blue">
    <img src="/images/title/dice.jpg" width="150" height="75" alt="">    <div class="blue m3">
        Игрок — это вор, который крадет, не рискуя попасть под суд.
    </div>
</div>
<div class="dotted"></div>




    <div class="block center">
                    <img src="/images/dice/cards/'.$cy.'.gif" width="57" height="56" alt="5">                    <img src="/images/dice/cards/'.$dy.'.gif" width="57" height="56" alt="5">            </div>
    <div class="dotted"></div>
    <div class="block center s125">
        <img src="/images/icons/blackjack_points.png" width="16" height="16" alt=""> Очки: '.$b['c'].'    </div>
    <div class="dotted"></div>
    <div class="block center">
                <span class="btn_start"><span class="btn_end"><a class="btn" href="/dice/?sh">Продолжить со ставкой:     <img src="/images/icons/silver.png" width="16" height="16" alt=""> 180    <img src="/images/icons/gold.png" width="16" height="16" alt=""> 2</a></span> </span>    </div>
    <div class="dotted"></div>
    <div class="block center">
                <span class="btn_start"><span class="btn_end"><a class="btn" href="/dice/finish?next_game=0&amp;rand=7705&amp;nocache=317130358">Завершить партию</a></span> </span>    </div>
</div>';

include './system/f.php';
exit();
}

if(isset($_GET['start'])) {
mysql_query('INSERT INTO `dice` SET `user` = "'.$user['id'].'",`ot`="1"');
header('location: /dice/ger');
exit;
}
?>
 <div class="content">
    <div class="block center color3 s125"><a href="?nocache=1516147759">Аршин</a>/ Кости</div>
            <div class="line"></div>
<div class="block center blue">
    <img src="/images/title/dice.jpg" width="150" height="75" alt="">    <div class="blue m3">
        Игрок — это вор, который крадет, не рискуя попасть под суд.
    </div>
</div>
<div class="dotted"></div>

    <div class="block center s125">
        В случае победы ваша ставка удвоится!
    </div>
    <div class="dotted"></div>
    <div class="block center">
                <span class="btn_start"><span class="btn_end"><a class="btn" href="/dice/?start">Начать со ставкой:     <img src="/images/icons/silver.png" width="16" height="16" alt=""> 180    <img src="/images/icons/gold.png" width="16" height="16" alt=""> 2</a></span> </span>    </div>
<?
include './system/f.php';
?>