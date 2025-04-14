<?php
header('Content-Type: application/json');

// Ensure the request is POST.
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and retrieve the form data.
    $name    = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $email   = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING);

    // Change this to your own email address.
    $to = "daothihaan@gmail.com";
    $subject = "New Contact Form Submission from $name";

    // Build the HTML email body with inline CSS.
    $body = '<html><head><meta charset="UTF-8"><style>
        body { font-family: Arial, sans-serif; background-color: #f8f8f8; margin: 0; padding: 0; }
        .email-container { width: 90%; max-width: 600px; margin: 30px auto; background-color: #ffffff; border: 1px solid #dddddd; border-radius: 5px; overflow: hidden; }
        .header { background-color: #007bff; color: #ffffff; padding: 20px; text-align: center; }
        .content { padding: 20px; color: #333333; }
        .content p { line-height: 1.6; }
        .footer { background-color: #f1f1f1; color: #555555; padding: 15px; text-align: center; font-size: 12px; }
    </style></head><body>';
    $body .= '<div class="email-container">';
    $body .= '<div class="header"><h2>New Contact Form Submission</h2></div>';
    $body .= '<div class="content">';
    $body .= "<p><strong>Name:</strong> " . htmlspecialchars($name) . "</p>";
    $body .= "<p><strong>Email:</strong> " . htmlspecialchars($email) . "</p>";
    $body .= "<p><strong>Message:</strong><br>" . nl2br(htmlspecialchars($message)) . "</p>";
    $body .= '</div>';
    $body .= '<div class="footer">This is an automated message. Please do not reply directly to this email.</div>';
    $body .= '</div></body></html>';

    // Set the email headers.
    $headers  = "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=UTF-8\r\n";
    // Use a valid & authorized sender email – do not use the user's email here.
    $headers .= "From: no-reply@gmail.com\r\n";
    // Set user email as Reply-To so that if you hit reply, it goes to the user.
    $headers .= "Reply-To: $email\r\n";    $headers .= "X-Mailer: PHP/" . phpversion() . "\r\n";
    // Mark the email as high priority.
    $headers .= "X-Priority: 1\r\n";
    $headers .= "Importance: High\r\n";

    // Send the email.
    if (mail($to, $subject, $body, $headers)) {
        echo json_encode(["success" => true, "message" => "Email sent successfully!"]);
    } else {
        echo json_encode(["success" => false, "message" => "Error sending email."]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Invalid request method!"]);
}
?>