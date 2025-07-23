<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tripType = $_POST['trip_type'];
    $departure = $_POST['departure_date'];
    $return = $_POST['return_date'];
    $from = $_POST['from_country'];
    $to = $_POST['to_country'];
    $name = $_POST['full_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    $toEmail = "hemangini@savitarainfotel.in"; // Change to your email
    $subject = "New Travel Quote Request";
    $body = "Trip Type: $tripType\nDeparture: $departure\nReturn: $return\nFrom: $from\nTo: $to\nName: $name\nEmail: $email\nPhone: $phone";
    $headers = "From: no-reply@yourdomain.com";

    if (mail($toEmail, $subject, $body, $headers)) {
        echo "Thank you! Your quote request has been sent.";
    } else {
        echo "Sorry, something went wrong.";
    }
}
?>
