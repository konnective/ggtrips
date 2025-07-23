<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ggtrips";


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    

    $name = $_POST['phone'];
    $email = $_POST['email'];

    $stmt = $conn->prepare("INSERT INTO inquiries (type, email, phone) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $type, $email, $phone);

if ($stmt->execute()) {
    $toastr_message = "Record added successfully!";
    $toastr_type = "success";



    $to = "info@gogotripsus.com";
    $from = "coopermath1@gmail.com";
    $fromName = "Go GO Trips";
    $subject = "New User Registration";

    $smtpHost = "smtp.gmail.com";
    $smtpPort = 587;
    $smtpUsername = "coopermath1@gmail.com";
    $smtpPassword = "irxl bnrs vmiv asky";
    // Send email using PHPMailer
    $mail = new PHPMailer(true);
    try {
      // Server settings
      $mail->isSMTP();
      $mail->Host = $smtpHost;
      $mail->SMTPAuth = true;
      $mail->Username = $smtpUsername;
      $mail->Password = $smtpPassword;
      $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
      $mail->Port = $smtpPort;

      // Recipients
      $mail->setFrom($from, $fromName);
      $mail->addAddress($to);
      $mail->addReplyTo($from);

      // Content
      $mail->isHTML(true);
      $mail->Subject = $subject;
      $mail->Body = "<h3>New User Registered</h3>
                                <p><strong>Email:</strong> $email</p>
                                <p><strong>phone:</strong> $phone</p>
                              <p><strong>Time:</strong> " . date('Y-m-d H:i:s') . "</p>";
      $mail->AltBody = "New User Registered\nEmail: $name\nPhone: $phone\nTime: " . date('Y-m-d H:i:s');

      $mail->send();
    } catch (Exception $e) {
      $toastr_message .= " However, failed to send email: {$mail->ErrorInfo}";
      $toastr_type = "warning";
    }
  } else {
    $toastr_message = "Error: " . $stmt->error;
    $toastr_type = "error";
  }

  $stmt->close();


    

}
?>