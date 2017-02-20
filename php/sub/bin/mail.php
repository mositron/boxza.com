<?php




require_once('../../handlers/boxza.php');

# Initialization Application
_::load('bin');

$mail = _::mail();

$mail->to='positron.th@gmail.com';
$mail->subject = 'ทดสอบ - BoxZa โซเชียลเน็ทเวิร์คสัญชาติไทย เทสเพ่อทดสอบ';
$mail->message = 'นี่คือการทดสอบ เทสเพือ่ทดสอบ';
echo $mail->send()?'send':'fail';
echo ' - '.$mail->_m->ErrorInfo;


$mail->to='intseo4@hotmail.com';
$mail->subject = 'ทดสอบ - BoxZa โซเชียลเน็ทเวิร์คสัญชาติไทย เทสเพ่อทดสอบ';
$mail->message = 'นี่คือการทดสอบ เทสเพือ่ทดสอบ';
echo $mail->send()?'send':'fail';
echo ' - '.$mail->_m->ErrorInfo;

?>				