<?php
    use phpMailer\PHPMailer\PHPMailer;
    use phpMailer\PHPMailer\Exception;

    require 'autoload.php';

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = htmlspecialchars($_POST['name']);
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $message = htmlspecialchars($_POST['message']);
        
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'bulchaleta9@gmai.com';
            $mail->Password = 'bulchaleta9@1234!';
            $mail->SMTPSecure = phpMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->setFrom($email, $name);
            $mail->addAddress('bulchaleta9@gmail.com');

            $mail->isHTML(true);
            $mail->Subject = 'Contact Form Submission';
            $mail->Body = "<h3>Name : $name <br>Email : $email <br>Message : $message</h3>";

            $mail->send();
            echo '<script>alert("Message has baaeen sent successfully")</script>';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
        
    }
      else {
        echo '<script>alert("Invalid request ")</script>';
    }







?>