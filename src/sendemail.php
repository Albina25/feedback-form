<?php
// $inputJSON = file_get_contents('php://input');
// $input = json_decode($inputJSON, TRUE);

// $name = $input['name'];
// $phone = $input['phone'];

// $message = "Name: ".$name."\nPhone: ".$phone;

$name = 'Имя: '.$_POST['name'];
$phone =  'Почта: '.$_POST['phone'];
$time =  'Время: '.$_POST['time'];
$allInOne =  $name.$phone.$time;
$to = 'site@test.ru'; 
$headers="From: Site <site@test.ru>\nContent-Type: text/html; charset=\"utf-8\"\n"; 
 
if (!empty($phone)) {
  if (!preg_match('/^(8|7)(\d{10})$/', $phone)) {
    echo 'Поле Телефон содержит не корректный номер!';
    
  }
}
if (!empty($name)) {
  if (!preg_match('/^[A-Za-zА-Яа-яЁё]*$/i', $name)) {
    echo 'Поле Имя не корректное!';
    
  }
}

if (mail($to, 'Свяжитесь с нами', $AllInOne, $headers)) {
    http_response_code(200);
    echo "Данные отправлены.";
} else {
    http_response_code(400);
    echo "Ошибка. Данные не отправлены.";
  }

 
?>