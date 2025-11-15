<?php
header('Content-Type: application/json');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$name    = $_POST['name'] ?? '';
$email   = $_POST['email'] ?? '';
$message = $_POST['message'] ?? '';

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'info@sandkmedtransit.com';
    $mail->Password   = 'btim vfxk eprp byts';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port       = 465;

    $mail->setFrom('info@sandkmedtransit.com', 'Website Contact');
    $mail->addAddress('info@sandkmedtransit.com');

    $mail->isHTML(true);
    $mail->Subject = "New Contact Form Submission";

   // HTML Email Template
    $mail->Body = '
    <table width="100%" cellpadding="0" cellspacing="0" style="background:#f5f5f5; padding:20px; font-family:Arial, sans-serif;">
      <tr>
        <td>
          <table width="600" align="center" cellpadding="0" cellspacing="0" style="background:#ffffff; border-radius:10px; overflow:hidden; box-shadow:0px 0px 10px rgba(0,0,0,0.1);">
            
            <!-- Header -->
            <tr>
              <td style="background:#0E4A5A; padding:20px; text-align:center;">
                <img src="https://www.sandkmedtransit.com/transportwebsitelogo.webp" width="120" style="margin-bottom:10px;" />
                <h2 style="color:white; margin:0; font-size:22px;">New Contact Form Submission</h2>
              </td>
            </tr>

            <!-- Body -->
            <tr>
              <td style="padding:25px;">
                <p style="font-size:16px; color:#333; margin:0 0 10px;">
                  <strong>Name:</strong> '.htmlspecialchars($name).'
                </p>

                <p style="font-size:16px; color:#333; margin:0 0 10px;">
                  <strong>Email:</strong> '.htmlspecialchars($email).'
                </p>

                <p style="font-size:16px; color:#333; margin:0 0 10px;">
                  <strong>Message:</strong><br><br>
                  '.nl2br(htmlspecialchars($message)).'
                </p>
              </td>
            </tr>

            <!-- Footer -->
            <tr>
              <td style="background:#f0f0f0; padding:15px; text-align:center; font-size:13px; color:#777;">
                This message was sent from your website contact form.<br>
                © '.date("Y").' S & K Medical Transportation
              </td>
            </tr>

          </table>
        </td>
      </tr>
    </table>
    ';

    $mail->send();

    echo json_encode([
        "status" => "success",
        "message" => "Message sent successfully"
    ]);

} catch (Exception $e) {
    echo json_encode([
        "status" => "error",
        "message" => "Mailer Error: {$mail->ErrorInfo}"
    ]);
}
