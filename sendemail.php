<?php 
if (isset($_POST["firstName"])) {  
    // Read and sanitize form values
    $success = false;
    
    $firstName = isset($_POST['firstName']) ? htmlspecialchars($_POST['firstName'], ENT_QUOTES, 'UTF-8') : "";
    $lastName = isset($_POST['lastName']) ? htmlspecialchars($_POST['lastName'], ENT_QUOTES, 'UTF-8') : "";
    $senderEmail = isset($_POST['email']) ? filter_var($_POST['email'], FILTER_SANITIZE_EMAIL) : "";
    $phone = isset($_POST['phone']) ? htmlspecialchars($_POST['phone'], ENT_QUOTES, 'UTF-8') : "";
    $messageContent = isset($_POST['message']) ? htmlspecialchars($_POST['message'], ENT_QUOTES, 'UTF-8') : "";
    
    // Check if required fields are not empty
    if (empty($firstName) || empty($lastName) || empty($senderEmail) || empty($phone) || empty($messageContent)) {
        echo '<div class="failed">Failed: All fields are required.</div>';
        exit;
    }

    // Email details
    $to = "alihamza292@gmail.com";
    $subject = "New Contact Form Submission"; // Define subject
    $headers = "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=UTF-8\r\n";
    $headers .= "From: " . $senderEmail . "\r\n"; // Proper "From" header

    // Construct the email message
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

    // Send email
    if (mail($to, $subject, $emailMessage, $headers)) {
        echo '<div class="success">Email has been sent successfully.</div>';
    } else {
        echo '<div class="failed">Error: Email did not send.</div>';
    }
} else {
    echo '<div class="failed">Failed: Email not sent.</div>';
}
?>
