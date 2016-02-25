<?php
function Send_Mail($to,$subject,$body)
{
require 'class.phpmailer.php';
$from = "MyHalls";
$mail = new PHPMailer();
$mail->IsSMTP(true); // SMTP
$mail->SMTPAuth   = true;  // SMTP authentication
$mail->Mailer = "smtp";
$mail->Host= "tls://smtp.gmail.com"; // GMail SMTP
$mail->Port = 465;  // SMTP Port
$mail->Username = "myhallsactivation@gmail.com";  // SMTP  Username
$mail->Password = "MyHalls2015";  // SMTP Password
$mail->SetFrom($from, 'MyHalls');
$mail->AddReplyTo($from,'MyHalls');
$mail->Subject = $subject;
$mail->MsgHTML($body);
$address = $to;
$mail->AddAddress($address, $to);

if(!$mail->Send())
return false;
else
return true;

}
?>