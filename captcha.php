<?php
/**
* КАПТЧА 1.0
* Site: http://bezramok-tlt.ru
* Создание КАПТЧИ своими руками
* Autor: Админ
*/

//Запускаем сессию
session_start();

//Устанавливаем кодировку и вывод всех ошибок
header('Content-Type: text/html; charset=UTF-8');
error_reporting(E_ALL);

function getRandString($num)
{
    //Генерим массив из букв
    $letter = range('a', 'z');
    //Генерим массив из цифр
    $number = range(0, 9);

    //Создаем строку с маленькими и большими буквами и цифрами
    $letter = implode('',$letter);
    $letter = $letter.strtoupper($letter).implode('',$number);

    //Строка с генерированым кодом
    $randStr = '';
    for ($i = 0; $i < $num; $i++){
        //Прогоняем циклом столько, сколько нужно символов в строке
        $randStr .= $letter[rand(0, strlen($letter) - 1)];
    }
    return $randStr;
}

//Функция генерации цвета
function randColor($imgPng, $red = null, $green = null, $blue = null)
{
    if(is_numeric($red) and is_numeric($green) and is_numeric($blue))
        return imagecolorallocate($imgPng, $red, $green, $blue);
    else
        return imagecolorallocate($imgPng, rand(0, 255), rand(0, 255),rand(0, 255));
}

//Путь до нужного шрифта
$fonts = "./font/verdana.ttf";

//Нижняя плашка каптчи
$url = "";

//Размер шрифта каптчи
$fontSize    = 24;
$fontSizeUrl = 12;

//Размеры холста холста
$width  = 200;
$height = 80;

//Количество линий и пикселей на холсте
$countLine = rand(0, 10);
$countPixel = rand(200, 1000);

// Сколько символов будем выводить на картинке
$numbers = 5;

//Получаем сгенерированую строку
$randStr = getRandString($numbers);

// Записываем каптчу в сессию
$_SESSION['captcha'] = $randStr;

// Создаем картинку (холст) размером 200 X 60
$imgPng = imagecreatetruecolor($width, $height);

// Создаем фон холста, RGB(255, 181, 181)
$imgColor   = randColor($imgPng, 255, 181, 181); 

//Зададим цвет линиям, у меня он динамический
$lineСolor  = randColor($imgPng);

//Зададим цвет для точек, у меня он динамический
$pixelСolor = randColor($imgPng);

//Цвет текста, у меня он динамический
$textColor  = randColor($imgPng);

//Цвет полоски с текстом в низу картинки
$bgColor  = randColor($imgPng, 0, 0, 0);

//Цвет текста URL красный
$redColor  = randColor($imgPng, 255, 0, 0);

//Определяем фон картинки
imagefilledrectangle($imgPng, 0, 0, $width, $height, $imgColor);

//Создаем линии на холсте
for ($i = 0; $i < $countLine; $i++) {
	imageline($imgPng, 0, rand(0, $height), $width, rand(0, $height), $lineСolor);
}

//Создаем точки на холсте
for ($i = 0; $i < $countPixel; $i++) {
    imagesetpixel($imgPng, rand(0, $width) , rand(0, $height), $pixelСolor);
}

//Пишем по букве не холсте
for ($i = 0; $i < strlen($randStr); $i++)
  {
    //Растояние между символами
    $x = ($width - 20) / strlen($randStr) * $i + 10;
    
    //Случайное смещение
    $x = rand($x, $x + 4);

    //Координата Y
    $y = $height - (($height - $fontSize) / 2 );

    //Случайны цвет отдельного символа
    $letterColor = randColor($imgPng);
    
    //Случайный угол наклона символов 
    $angle = rand(-25, 50);

    //Пишем текст на холсте (наш код каптчи)
    imagettftext($imgPng, $fontSize, $angle, $x, $y, $letterColor, $fonts, $randStr[$i]);
  }

// создаем рамку для текста
$bbox = imagettfbbox($fontSizeUrl, 0, $fonts, $url);

//Высчитываем координаты для выравнивания по центру
$textX = $bbox[0] + (imagesx($imgPng) / 2) - ($bbox[4] / 2);

//Определяем фон картинки
imagefilledrectangle($imgPng, 0, 60, $width, $height, $bgColor);

//Надпись с URL
imagettftext($imgPng, $fontSizeUrl, 0, $textX, 75, $redColor, $fonts, $url);


// Посылаем заголовок серверу о том что у нас картинка в формате png
header("Content-type: image/png");
imagepng($imgPng);

//Освобождаем
imagedestroy($imgPng);

?>