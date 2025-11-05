<?php 
if (isset($_POST["firstName"])) {  
    $firstName = isset($_POST['firstName']) ? htmlspecialchars($_POST['firstName'], ENT_QUOTES, 'UTF-8') : "";
    $lastName = isset($_POST['lastName']) ? htmlspecialchars($_POST['lastName'], ENT_QUOTES, 'UTF-8') : "";
    $senderEmail = isset($_POST['email']) ? filter_var($_POST['email'], FILTER_SANITIZE_EMAIL) : "";
    $phone = isset($_POST['phone']) ? htmlspecialchars($_POST['phone'], ENT_QUOTES, 'UTF-8') : "";
    $messageContent = isset($_POST['message']) ? htmlspecialchars($_POST['message'], ENT_QUOTES, 'UTF-8') : "";

    if (empty($firstName) || empty($lastName) || empty($senderEmail) || empty($phone) || empty($messageContent)) {
        echo '<div class="failed">Failed: All fields are required.</div>';
        exit;
    }

    $to = "info@latwisters.in";
    $subject = "New Contact Form Submission";
    
    // Use your domain email in From
    $headers = "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=UTF-8\r\n";
    $headers .= "From: info@latwisters.in\r\n"; // Must be domain email
    $headers .= "Reply-To: " . $senderEmail . "\r\n"; // Reply to user

    $emailMessage = "
        <html>
        <head>
            <title>$subject</title>
        </head>
        <body>
            <p><strong>Name:</strong> $firstName $lastName</p>
            <p><strong>Email:</strong> $senderEmail</p>
            <p><strong>Phone:</strong> $phone</p>
            <p><strong>Message:</strong><br>" . nl2br($messageContent) . "</p>
        </body>
        </html>
    ";

    if (mail($to, $subject, $emailMessage, $headers)) {
        echo '<div class="success">Email has been sent successfully.</div>';
    } else {
        echo '<div class="failed">Error: Email did not send. Check server mail configuration.</div>';
    }
} else {
    echo '<div class="failed">Failed: Email not sent.</div>';
}
?>
