<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';
include('dataconnection.php');

// Initialize a variable to store the status message
$statusMessage = "";

if(isset($_POST['submit'])){
    $to = $_POST['to'];

    $sql = "SELECT * FROM user WHERE email = ?";
    $stmt = $connect->prepare($sql);
    $stmt->bind_param("s", $to);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // If user exists, generate a unique token
        $token = bin2hex(random_bytes(50));
        $expiry = date("Y-m-d H:i:s", strtotime('+1 hour'));

        // Store the token in the database
        $stmt_update = $connect->prepare("UPDATE user SET reset_token = ?, token_expiry = ? WHERE email = ?");
        $stmt_update->bind_param("sss", $token, $expiry, $to);
        $stmt_update->execute();

        // Send the token via email
        $subject = "Password Reset";
        $message = '<html><body>';
        $message .= '<h1>Password Reset</h1>';
        $message .= '<p>To reset your password, click the link below:</p>';
        $message .= '<p><a href="http://localhost/FYP-F1/passwordreset.php?token=' . $token . '">Reset Password</a></p>';
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
        $statusMessage = "Email address not found in database";
    }

    $connect->close(); // Close the database connection
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
