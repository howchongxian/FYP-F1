<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';
include('dataconnection.php');

// Initialize a variable to store the status message
$statusMessage = "";

// 处理邮件发送逻辑
if(isset($_POST['submit'])){
    $to = $_POST['to'];

    $sql = "SELECT * FROM user WHERE email = '$to'";
    $result = $connect->query($sql);
    
    if ($result->num_rows > 0) {
        // 如果存在匹配的记录，发送邮件
        $subject = "Password Reset";
        $message = '<html><body>';
        $message .= '<h1>Password Reset</h1>';
        $message .= '<p>To reset your password, click the link below:</p>';
        $message .= '<p><a href="http://localhost/FYP-F1/passwordreset.php">Reset Password</a></p>';
        $message .= '</body></html>';
        
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'howchongxian@gmail.com';
            $mail->Password = 'xnkm yzlm bazw swzk'; 
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $mail->setFrom('your_email@gmail.com', 'F1');
            $mail->addAddress($to);

            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body = $message;

            $mail->send();
            $statusMessage = "Email sent successfully";
        } catch (Exception $e) {
            $statusMessage = "Failed to send email. Error: {$mail->ErrorInfo}";
        }
    } else {
        // 如果数据库中不存在匹配的记录，显示消息给用户
        $statusMessage = "Email address not found in database";
    }

    $connect->close(); // 关闭数据库连接
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset</title>
    <link rel="stylesheet" type="text/css" href="css/forgetpassword.css">
    <link href='http://fonts.googleapis.com/css?family=Quicksand' rel='stylesheet' type='text/css'>
    <script>
        // Function to display popup message
        function showAlert(message) {
            alert(message);
        }
    </script>
</head>
<body>
    <h1>Password Reset</h1>
    <form method="post">
        <p>
            <input type="text" name="to" placeholder="Enter your email address"/>
        </p>
        <button type="submit" name="submit">Send Reset Link</button>
    </form>
    <?php
    if ($statusMessage) {
        echo "<script type='text/javascript'>showAlert('$statusMessage');</script>";
    }
    ?>
</body>
</html>
