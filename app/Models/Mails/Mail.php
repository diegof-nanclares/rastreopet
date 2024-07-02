<?php
namespace Models\Mails;
require __DIR__ . '/../../lib/PHPMailer/src/PHPMailer.php';
require __DIR__ . '/../../lib/PHPMailer/src/SMTP.php';
require __DIR__ . '/../../lib/PHPMailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Models\Utils\Logger;
class Mail
{
    public function sendmail($address, $subject, $body)
    {
        $mail = new PHPMailer(true);
        $logger = new Logger();
        try {
            // Configurar el servidor SMTP
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'diegof.nanclares@gmail.com';
            $mail->Password = 'kcrkhtdhpwzxllns';
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;

            // Configurar remitente y destinatario
            $mail->setFrom('diegof.nanclares@gmail.com', 'Rastreo Pet');
            $mail->addAddress($address, 'Sublismart');

            // Configurar asunto y contenido
            $mail->Subject = $subject;
            $mail->isHTML(true);
            $mail->Body = $body;
            $mail->send();
        } catch (Exception $e) {
            $logger->logError('500', $e->getMessage() .  ' ' .  $mail->ErrorInfo );
        }
    }
}

?>
