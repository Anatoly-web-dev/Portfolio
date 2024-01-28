<?php

use PHPMailer\PHPMailer\PHPMailer;

require 'phpmailer/src/PHPMailer.php';

$mail = new PHPMailer(true);
$mail->CharSet = 'UTF-8';
$mail->setLanguage('ru', 'phpmailer/language/');
$mail->isHTML(true);

// От кого письмо
$mail->setFrom('anatolclub777@mail.ru', 'Анатолий Кострыкин');
// Кому отправить
$mail->addAddress('anatoly-web-dev@mail.ru');
// Тема письма
$mail->Subject = 'Сообщение c личного сайта';

$body = '<h1>Новое сообщение от пользователя!</h1>';

if (trim(!empty($_POST['name']))) {
	$body .= '<p><strong>Имя:</strong> ' . $_POST['name'] . '</p>';
}

if (trim(!empty($_POST['email']))) {
	$body .= '<p><strong>E-mail:</strong> ' . $_POST['email'] . '</p>';
}

if (trim(!empty($_POST['message']))) {
	$body .= '<p><strong>Сообщение:</strong> ' . $_POST['message'] . '</p>';
}

$mail->Body = $body;

// Отправляем
if (!$mail->send()) {
	$message = 'Ошибка отправки запроса!';
} else {
	$message = 'Сообщение отправлено!';
}

$response = ['message' => $message];

header('Content-type: application/json');
echo json_encode($response);
