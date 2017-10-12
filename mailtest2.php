<?
require 'PHPMailer-master/PHPMailerAutoload.php';

 

$mail = new PHPMailer;

 

$mail->isSMTP();                                      // Set mailer to use SMTP

$mail->Host = 'mail.hku.hk';  // Specify main and backup SMTP servers

$mail->SMTPAuth = false;                               // Enable SMTP authentication

 

$mail->From = 'ptkyuen@hku.hk';

$mail->FromName = 'Philip Yuen';

$mail->addAddress('cyolanda@hku.hk', 'Yolanda');     // Add a recipient
//$mail->addAddress('asllee@hku.hk', 'Alex Lee');     // Add a recipient

//$mail->addAddress('anotheruser@yahoo.com');           // Name is optional

$mail->addReplyTo('ptkyuen@hku.hk', 'Philip Yuen');

//$mail->addCC('alex2@cetl.hku.hk');

 

$mail->WordWrap = 50;                                 // Set word wrap to 50 characters

$mail->isHTML(true);                                  // Set email format to HTML

 

$mail->Subject = 'Here is the subject';

$mail->Body    = 'This is the HTML message body <b>in bold!</b>.<p> This is <u>2nd paragraph.</u>';

$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

 

if(!$mail->send()) {

    echo 'Message could not be sent.';

    echo 'Mailer Error: ' . $mail->ErrorInfo;

} else {

    echo 'Message has been sent';

}
?>
