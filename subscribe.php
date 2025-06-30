<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $subscriber = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

    $to = "mwanamfumucontractors@gmail.com";
    $subject = "New Newsletter Subscription";
    $message = "New subscriber:\n\nEmail: $subscriber";
    //$headers = "From: noreply@mwanamfumu.com";  // Optional: use a domain-based email if hosted

    if (mail($to, $subject, $message, $headers)) {
        echo "<script>
                alert('Thank you for subscribing!');
                window.location.href = 'index.html';
              </script>";
        exit();
    } else {
        echo "<script>
                alert('Failed to subscribe. Please try again later.');
                window.history.back();
              </script>";
        exit();
    }
}
?>
