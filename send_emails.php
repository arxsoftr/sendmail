<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';

$mailList = [];
$names = [];

if (isset($_FILES['mailFile']) && $_FILES['mailFile']['error'] === UPLOAD_ERR_OK) {
    $fileTmpPath = $_FILES['mailFile']['tmp_name'];
    $fileContent = file($fileTmpPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($fileContent as $line) {
        list($email, $name) = explode(',', $line);
        $mailList[] = trim($email);
        $names[] = trim($name);
    }
}

if (isset($_POST['emails']) && !empty($_POST['emails'])) {
    $emails = explode(',', $_POST['emails']);
    $emails = array_map('trim', $emails);
    $mailList = array_merge($mailList, $emails);
    
    $postedNames = array_fill(0, count($emails), ''); 
    $names = array_merge($names, $postedNames);
}

if (empty($mailList)) {
    die(json_encode(['status' => 'completed', 'message' => 'Hiçbir mail adresi girilmedi veya yüklenmedi.']));
}

$subject = isset($_POST['subject']) ? $_POST['subject'] : '';
$message = isset($_POST['message']) ? $_POST['message'] : '';

$mail = new PHPMailer(true);

$totalEmails = count($mailList);
$sentEmails = 0;

try {
    $mail->SMTPDebug = 0;
    $mail->isSMTP();
    $mail->Host = 'mail.yourmailserver.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'mail@yourdomain.com';
    $mail->Password = 'yourpassword';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;
    $mail->setFrom('mail@yourdomain.com', 'Sender Name');
    $mail->isHTML(true);
    $mail->Charset = 'UTF-8'; 
    $mail->Subject = $subject;

    foreach ($mailList as $index => $recipient) {
        $personalizedMessage = str_replace('{{name}}', $names[$index], $message);
        $mail->Body = $personalizedMessage;
        $mail->addAddress($recipient);
        
        $success = $mail->send();
        $mail->clearAddresses();
        $sentEmails++;
        
        echo json_encode([
            'status' => 'progress',
            'email' => $recipient,
            'success' => $success
        ]);
        ob_flush();
        flush();
    }

    echo json_encode([
        'status' => 'completed',
        'message' => "Tüm mailler gönderildi. ($sentEmails / $totalEmails)"
    ]);
} catch (Exception $e) {
    echo json_encode([
        'status' => 'completed',
        'message' => "Mail gönderilemedi. Hata: {$mail->ErrorInfo}"
    ]);
}
?>
