<?php
$w = 100;
$h = 25;
$image = imagecreatetruecolor( $w, $h ) or die('Cannot create image');

$text = htmlspecialchars($_GET['text']);

//�����
$white = 0x993300;
$black = 0x993300;
$red = 0x993300; 

//C�� �����
$text = iconv( 'cp1251', 'utf-8', $text);

//����� 
$font = realpath('/font/fyg.ttf'); // - ����������� ���� ������� ���� �� ������
$fontsize = 18; // ������ ������, gd1 - � ��������, gd2 - � �������

///������������� ������
$sz = imagettfbbox( $fontsize, 0 , $font , $text );
$x = ( imageSX($image) - ( $sz[2] - $sz[0] ) ) / 2 ;
$y = ( imageSY($image) + ( $sz[1] - $sz[7] ) ) / 2 ;

//������ ����������� ����������
imagesavealpha($image,true);
imagefill($image, 1, 1, imagecolorallocatealpha( $image, 255, 255, 255, 127 ) );
imagecolortransparent($image, $black);

//��������� �����
imagettftext( $image, $fontsize, 0, $x, $y, $red, $font, $text );

//������� �����������
header('Content-type: image/png');

imagepng($image);
imagedestroy($image);

?>