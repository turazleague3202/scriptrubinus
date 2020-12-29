<?php
$w = 100;
$h = 25;
$image = imagecreatetruecolor( $w, $h ) or die('Cannot create image');

$text = htmlspecialchars($_GET['text']);

//Цвета
$white = 0x993300;
$black = 0x993300;
$red = 0x993300; 

//Cам текст
$text = iconv( 'cp1251', 'utf-8', $text);

//Шрифт 
$font = realpath('/font/fyg.ttf'); // - обязательно надо указать путь до шрифта
$fontsize = 18; // размер шрифта, gd1 - в пикселях, gd2 - в пунктах

///Централизация шрифта
$sz = imagettfbbox( $fontsize, 0 , $font , $text );
$x = ( imageSX($image) - ( $sz[2] - $sz[0] ) ) / 2 ;
$y = ( imageSY($image) + ( $sz[1] - $sz[7] ) ) / 2 ;

//Делаем изображение прозрачным
imagesavealpha($image,true);
imagefill($image, 1, 1, imagecolorallocatealpha( $image, 255, 255, 255, 127 ) );
imagecolortransparent($image, $black);

//Вставляем текст
imagettftext( $image, $fontsize, 0, $x, $y, $red, $font, $text );

//Выводим изображение
header('Content-type: image/png');

imagepng($image);
imagedestroy($image);

?>