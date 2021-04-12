<? php>
// $inputJSON = file_get_contents('php://input');
// $input = json_decode($inputJSON, TRUE);

// $name = $input['name'];
// $phone = $input['phone'];

// $message = "Name: ".$name."\nPhone: ".$phone;
$name = 'Имя: '.$_POST['name'].' <br />';
$mail =  'Почта: '.$_POST['phone'].' <br />';
$time =  'Время: '.$_POST['time'].' <br />';
$allInOne =  $name.$phone.$time;
$to = 'axioma.25@gmail.com'; 
$headers="From: Alexryabikov.ru <site@test.ru>\nReply-to:info@alexryabikov.ru\nContent-Type: text/html; charset=\"utf-8\"\n"; 
    // функция, которая отправляет наше письмо
mail($to, 'Свяжитесь с нами', $AllInOne, $headers); 
?>