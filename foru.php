<?php
	/**
	* Главный файл
	* Site: http://bezramok-tlt.ru
	* Создание КАПТЧИ своими руками
	*/

	//Запускаем сессию
	session_start();

	//Устанавливаем кодировку и вывод всех ошибок
	header('Content-Type: text/html; charset=UTF8');
	error_reporting(E_ALL);

	//Инициализируем переменные для работы
	$err = array();

	//Если нажата кнопка отправки формы
	if(isset($_POST['send']))
	{
		//Утюжим пересенные
		if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
			$err[] = 'Не верный email!';

		if($_SESSION['captcha'] != $_POST['captcha'])
			$err[] = 'Код с картинки не совпадает!';

		if(empty($err))
			$ok = 'Вы прошли проверку!';
	}

	//Подключаем наш шаблон
	include './form.html';
?>
