<?php
header('Content-Type: application/json');


$toEmail = "mwanamfumucontractors@gmail.com"; 

// Get POST data and sanitize
$name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
$subject = filter_input(INPUT_POST, 'subject', FILTER_SANITIZE_STRING);
$message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING);

// Validate required fields
if (!$name || !$email || !$message) {
    echo json_encode([
        'success' => false,
        'message' => 'Please fill in all required fields.'
    ]);
    exit;
}

// Validate email format
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode([
        'success' => false,
        'message' => 'Invalid email format.'
    ]);
    exit;
}

// Prepare email content
$emailSubject = $subject ? $subject : "New Contact Form Message";
$emailBody = "You have received a new message from your website contact form.\n\n";
$emailBody .= "Name: $name\n";
$emailBody .= "Email: $email\n";
$emailBody .= "Subject: $subject\n";
$emailBody .= "Message:\n$message\n";

// Email headers
$headers = "From: $name <$email>\r\n";
$headers .= "Reply-To: $email\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

// Send email
$mailSent = mail($toEmail, $emailSubject, $emailBody, $headers);

if ($mailSent) {
    echo json_encode([
        'success' => true,
        'message' => 'Thank you for contacting us! We will get back to you shortly.'
    ]);
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Failed to send your message. Please try again later.'
    ]);
}
