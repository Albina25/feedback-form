<?php
// $inputJSON = file_get_contents('php://input');
// $input = json_decode($inputJSON, TRUE);

// $name = $input['name'];
// $phone = $input['phone'];

// $message = "Name: ".$name."\nPhone: ".$phone;
$c = true;
$name = 'Имя: '.$_POST['name'];
$mail =  'Почта: '.$_POST['phone'];
$time =  'Время: '.$_POST['time'];
$allInOne =  $name.$phone.$time;
$to = 'axioma.25@gmail.com'; 
$headers="From: Site <site@test.ru>\nContent-Type: text/html; charset=\"utf-8\"\n"; 
 
if (mail($to, 'Свяжитесь с нами', $AllInOne, $headers)) {
    http_response_code(200);
    echo "Данные отправлены.";
} else {
    http_response_code(400);
    echo "Ошибка. Данные не отправлены.";
  }

 
?>