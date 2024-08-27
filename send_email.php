<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Composer'ning autoload faylini chaqirish

$mail = new PHPMailer(true);

try {
    // SMTP server sozlamalari
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com'; // Gmail SMTP serveri
    $mail->SMTPAuth = true;
    $mail->Username = getenv('EMAIL_USERNAME'); // Xavfsizlik uchun email manzilini muhit o'zgaruvchisida saqlang
    $mail->Password = getenv('EMAIL_PASSWORD'); // Xavfsizlik uchun parolni muhit o'zgaruvchisida saqlang yoki Ilova parolidan foydalaning
    $mail->SMTPSecure = 'tls'; // TLS shifrlash
    $mail->Port = 587; // TLS uchun 587 porti

    // Xabar sozlamalari
    $mail->setFrom(getenv('EMAIL_USERNAME'), 'Ismingiz'); // Sizning emailingiz, jo'natuvchi sifatida
    $mail->addAddress('gcccc406@gmail.com'); // Qabul qiluvchi email manzilingiz
    $mail->Subject = 'Kontakt Forma Yuborilishi';
    $mail->Body    = 'Ism: ' . htmlspecialchars($_POST['name']) . "\n" .
                     'Email: ' . htmlspecialchars($_POST['email']) . "\n" .
                     'Xabar: ' . htmlspecialchars($_POST['message']);

    $mail->send();
    echo 'Xabar muvaffaqiyatli yuborildi';
} catch (Exception $e) {
    echo 'Xabar yuborilmadi. Mailer xatosi: ', $mail->ErrorInfo;
}
?>
