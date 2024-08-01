<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$mail = new PHPMailer(true);

try {
    $mail->SMTPDebug = 0;
    $mail->isSMTP();
    $mail->Host       = 'smtp.hostinger.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'support@fichescapeps2025.fr';
    $mail->Password   = 'Baobabito707#';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port       = 465;

    $mail->setFrom('support@fichescapeps2025.fr', 'Support FichesCapeps2025');
    $mail->addAddress(htmlspecialchars($email));

    foreach ($cart as $item) {
        $mail->addAttachment('pdfs/' . htmlspecialchars($item['id']) . '.pdf');
    }

    $mail->isHTML(true);
    $mail->Subject = 'Vos fiches CAPEPS';
    $mail->Body    = '<h1>Merci pour votre achat</h1><p>Vous trouverez ci-joint vos fiches CAPEPS.</p>';
    $mail->AltBody = 'Merci pour votre achat. Vous trouverez ci-joint vos fiches CAPEPS.';

    $mail->send();
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: " . htmlspecialchars($mail->ErrorInfo);
}
?>
