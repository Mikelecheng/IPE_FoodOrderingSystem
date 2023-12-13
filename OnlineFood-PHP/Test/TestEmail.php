<?php
$to = 'recipient@example.com';
$subject = 'Test Email';
$message = 'Hello, this is a test email from PHP!';
$headers = 'From: webmaster@example.com' . "\r\n" .
    'Reply-To: webmaster@example.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

mail($to, $subject, $message, $headers);
?>
