<?php
// config.php - Email configuration
class EmailConfig
{
  const SMTP_HOST = 'smtp.gmail.com';
  const SMTP_PORT = 587;
  const SMTP_USERNAME = 'coopermath1@gmail.com';
  const SMTP_PASSWORD = 'irxl bnrs vmiv asky';
  const FROM_EMAIL = 'coopermath1@gmail.com';
  const FROM_NAME = 'Go GO Trips';
  // const TO_EMAIL = 'info@gogotripsus.com';
  const TO_EMAIL = 'kunj@savitarainfotel.in';
}

// Include PHPMailer classes
if (file_exists('vendor/autoload.php')) {
  require_once 'vendor/autoload.php';
} elseif (file_exists('PHPMailer/src/PHPMailer.php')) {
  require_once 'PHPMailer/src/PHPMailer.php';
  require_once 'PHPMailer/src/SMTP.php';
  require_once 'PHPMailer/src/Exception.php';
} elseif (file_exists('phpmailer/PHPMailer.php')) {
  require_once 'phpmailer/PHPMailer.php';
  require_once 'phpmailer/SMTP.php';
  require_once 'phpmailer/Exception.php';
} else {
  die('PHPMailer library not found. Please install PHPMailer first.<br><br>
    <strong>Installation Options:</strong><br>
    1. <strong>Using Composer (Recommended):</strong><br>
    &nbsp;&nbsp;Run: <code>composer require phpmailer/phpmailer</code><br><br>
    2. <strong>Manual Download:</strong><br>
    &nbsp;&nbsp;Download from: <a href="https://github.com/PHPMailer/PHPMailer" target="_blank">https://github.com/PHPMailer/PHPMailer</a><br>
    &nbsp;&nbsp;Extract to a "PHPMailer" folder in your project directory<br><br>
    3. <strong>Quick Manual Setup:</strong><br>
    &nbsp;&nbsp;Create a "phpmailer" folder and place PHPMailer.php, SMTP.php, and Exception.php files in it.');
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Centralized email sending function
function sendEmail($formData, $type)
{
  $mail = new PHPMailer(true);
  try {
    // Server settings
    $mail->isSMTP();
    $mail->Host = EmailConfig::SMTP_HOST;
    $mail->SMTPAuth = true;
    $mail->Username = EmailConfig::SMTP_USERNAME;
    $mail->Password = EmailConfig::SMTP_PASSWORD;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = EmailConfig::SMTP_PORT;

    // Recipients
    $mail->setFrom(EmailConfig::FROM_EMAIL, EmailConfig::FROM_NAME);
    $mail->addAddress(EmailConfig::TO_EMAIL);
    $mail->addReplyTo($formData['email'] ?? EmailConfig::FROM_EMAIL);

    // Content
    $mail->isHTML(true);
    $mail->Subject = ($type === 'quote') ? 'New Quote Request' : 'New Trip Inquiry';

    // Customize email body based on type
    $body = "<h3>" . ($type === 'quote' ? 'New Quote Request' : 'New Trip Inquiry') . "</h3>";
    $altBody = ($type === 'quote' ? 'New Quote Request' : 'New Trip Inquiry') . "\n";

    if ($type === 'quote') {
      $body .= "<p><strong>Type:</strong> " . $type . "</p>";
      $body .= "<p><strong>Email:</strong> " . htmlspecialchars($formData['email']) . "</p>";
      $body .= "<p><strong>Phone:</strong> +1" . htmlspecialchars($formData['phone']) . "</p>";
      $altBody .= "Email: " . $formData['email'] . "\nPhone: " . $formData['phone'] . "\n";
    } else if ($type === 'subscribe') {
      $body .= "<p><strong>Type:</strong> " . $type . "</p>";
      $body .= "<p><strong>Email:</strong> " . htmlspecialchars($formData['email']) . "</p>";
      $body .= "<p><strong>Name:</strong> " . htmlspecialchars($formData['full_name']) . "</p>";
      $altBody .= "Email: " . $formData['email'] . "\nPhone: " . $formData['phone'] . "\n";
    } else if ($type === 'discount') {
      $body .= "<p><strong>Type:</strong> " . $type . "</p>";
      $body .= "<p><strong>Country:</strong> " . htmlspecialchars($formData['country']) . "</p>";
      $body .= "<p><strong>Email:</strong> " . htmlspecialchars($formData['email']) . "</p>";
      $body .= "<p><strong>Phone:</strong> +1" . htmlspecialchars($formData['phone']) . "</p>";
      $altBody .= "Email: " . $formData['email'] . "\nPhone: " . $formData['phone'] . "\n";
    } else {
      $body .= "<p><strong>Trip Type:</strong> " . htmlspecialchars($type) . "</p>";
      $body .= "<p><strong>Name:</strong> " . htmlspecialchars($formData['full_name']) . "</p>";
      $body .= "<p><strong>Email:</strong> " . htmlspecialchars($formData['email']) . "</p>";
      $body .= "<p><strong>Phone:</strong> +1" . htmlspecialchars($formData['phone']) . "</p>";
      $body .= "<p><strong>Departure Date:</strong> " . htmlspecialchars($formData['departure_date']) . "</p>";
      $body .= "<p><strong>Arrival Date:</strong> " . htmlspecialchars($formData['arrival_date']) . "</p>";
      $body .= "<p><strong>Departure Place:</strong> " . htmlspecialchars($formData['departure_place']) . "</p>";
      $body .= "<p><strong>Arrival Place:</strong> " . htmlspecialchars($formData['arrival_place']) . "</p>";
      $body .= "<p><strong>Message:</strong> " . $formData['details'] . "</p>";
      $altBody .= "Trip Type: " . $type . "\nName: " . $formData['full_name'] . "\nEmail: " . $formData['email'] . "\nPhone: " . $formData['phone'] . "\nDeparture Date: " . $formData['departure_date'] . "\nArrival Date: " . $formData['arrival_date'] . "\nDeparture Place: " . $formData['departure_place'] . "\nArrival Place: " . $formData['arrival_place'] . "\n";
    }
    $body .= "<p><strong>Time:</strong> " . date('Y-m-d H:i:s') . "</p>";
    $altBody .= "Time: " . date('Y-m-d H:i:s') . "\n";

    $mail->Body = $body;
    $mail->AltBody = $altBody;

    $mail->send();
    return ['success' => true, 'message' => 'Email sent successfully!'];
  } catch (Exception $e) {
    return ['success' => false, 'message' => "Failed to send email: {$mail->ErrorInfo}"];
  }
}

// Initialize variables
$toastr_message = '';
$toastr_type = '';
$formData = [
  'type' => '',
  'full_name' => '',
  'email' => '',
  'departure_date' => '',
  'arrival_date' => '',
  'departure_place' => '',
  'arrival_place' => '',
  'phone' => '',
  'details' => '',
];

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ggtrips";

// $servername = "localhost";
// $username = "u888973765_gogotripsus";
// $password = "Sau@2505";
// $dbname = "u888973765_gogotripsus";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $type = trim(filter_input(INPUT_POST, 'type', FILTER_SANITIZE_STRING));
  $formData['type'] = $type;

  if ($type === 'quote') {
    $formData['email'] = trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL));
    $formData['phone'] = trim(filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING));

    $stmt = $conn->prepare("INSERT INTO inquiries (type, email, phone) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $type, $formData['email'], $formData['phone']);
  } else if ($type === 'discount') {
    $formData['email'] = trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL));
    $formData['phone'] = trim(filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING));
    $formData['country'] = trim(filter_input(INPUT_POST, 'country', FILTER_SANITIZE_STRING));

    $stmt = $conn->prepare("INSERT INTO inquiries (type, email, phone, country) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $type, $formData['email'], $formData['phone'], $formData['country']);
  } else if ($type === 'subscribe') {
    $formData['email'] = trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL));

    $stmt = $conn->prepare("INSERT INTO inquiries (type, email) VALUES (?, ?)");
    $stmt->bind_param("ss", $type, $formData['email']);
  } else {
    $formData['full_name'] = trim(filter_input(INPUT_POST, 'full_name', FILTER_SANITIZE_STRING));
    $formData['email'] = trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL));
    $formData['departure_date'] = trim(filter_input(INPUT_POST, 'departure_date', FILTER_SANITIZE_STRING));
    $formData['arrival_date'] = trim(filter_input(INPUT_POST, 'arrival_date', FILTER_SANITIZE_STRING));
    $formData['departure_place'] = trim(filter_input(INPUT_POST, 'departure_place', FILTER_SANITIZE_STRING));
    $formData['phone'] = trim(filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING));
    $formData['details'] = trim(filter_input(INPUT_POST, 'details', FILTER_SANITIZE_STRING));

    if ($type === 'round-trip') {
      $multiArrival = $_POST['arrival_place'] ?? [];
      $multiArrival2 = $_POST['departure_place'] ?? [];
      $formData['arrival_place'] = implode(',', array_map('trim', array_filter($multiArrival, 'is_string')));
      $formData['departure_place'] = implode(',', array_map('trim', array_filter($multiArrival2, 'is_string')));
    } else {
      $formData['arrival_place'] = trim(filter_input(INPUT_POST, 'arrival_place', FILTER_SANITIZE_STRING));
    }

    $stmt = $conn->prepare("INSERT INTO inquiries (type, full_name, email, departure_date, arrival_date, departure_place, arrival_place, phone) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssss", $type, $formData['full_name'], $formData['email'], $formData['departure_date'], $formData['arrival_date'], $formData['departure_place'], $formData['arrival_place'], $formData['phone']);
  }

  if ($stmt->execute()) {
    $toastr_message = "Thank You For Visiting Us!";
    $toastr_type = "success";

    // Send email
    $emailResult = sendEmail($formData, $type);
    if (!$emailResult['success']) {
      $toastr_message .= " However, " . $emailResult['message'];
      $toastr_type = "warning";
    }
  } else {
    $toastr_message = "Error: " . $stmt->error;
    $toastr_type = "error";
  }
  header("Location: https://gogotripsus.com/thank-you"); // Redirect to a thank you page
  $stmt->close();
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <script>
    (function(w, d, s, l, i) {
      w[l] = w[l] || [];
      w[l].push({
        'gtm.start': new Date().getTime(),
        event: 'gtm.js'
      });
      var f = d.getElementsByTagName(s)[0],
        j = d.createElement(s),
        dl = l != 'dataLayer' ? '&l=' + l : '';
      j.async = true;
      j.src =
        'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
      f.parentNode.insertBefore(j, f);
    })(window, document, 'script', 'dataLayer', 'GTM-MXM8KC7M');
  </script>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Book Usa To India Air Ticket | Gogo Trips US</title>
  <meta name="description" content="Usa–India Fares From $999* — Personalized Quotes, Guaranteed Low Rates. Get 3 Best Fare Options In Just 10 Minutes." />
  <link rel="canonical" href="https://gogotripsus.com/flight-booking/" />


  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Jost:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
    rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.5.0/css/flag-icon.min.css" rel="stylesheet" />
  <!--  -->
  <!-- SweetAlert2 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
  <!-- Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">


  <style>
    .step-icon img {
      height: 100%;
    }

    .testimonial-section {
      padding: 60px 20px;
      background-color: #f5f6f8;
    }

    .testimonial-card {
      background: #fff;
      border-radius: 15px;
      box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
      overflow: hidden;
    }

    .testimonial-content {
      padding: 20px;
      text-align: center;
    }

    .testimonial-content h5 {
      font-weight: 600;
      margin-bottom: 10px;
    }

    .testimonial-content p {
      font-style: italic;
      color: #555;
    }

    .swiper-button-next,
    .swiper-button-prev {
      color: #000;
    }

    .newsletter-vip {
      max-width: 900px;
      margin: 40px auto;
      padding: 30px 25px;
      background: linear-gradient(135deg, #102770, #1d3a8a);
      border-radius: 12px;
      text-align: center;
      color: #fff;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
      position: relative;
      overflow: hidden;
    }

    /* Top Right Airplane */
    .newsletter-vip::after {
      content: "";
      position: absolute;
      top: 15px;
      right: 20px;
      width: 80px;
      height: 80px;
      background: url('https://img.icons8.com/ios-filled/100/ffffff/airplane-take-off.png') no-repeat center;
      background-size: contain;
      opacity: 0.2;
      animation: fly 4s ease-in-out infinite alternate;
    }

    /* Bottom Left Airplane */
    .newsletter-vip::before {
      content: "";
      position: absolute;
      bottom: 15px;
      left: 20px;
      width: 80px;
      height: 80px;
      background: url('https://img.icons8.com/ios-filled/100/ffffff/airplane-take-off.png') no-repeat center;
      background-size: contain;
      opacity: 0.2;
      transform: rotate(180deg);
      animation: fly 4s ease-in-out infinite alternate;
    }

    @keyframes fly {
      0% {
        transform: translateY(0) rotate(0deg);
        opacity: 0.2;
      }

      50% {
        transform: translateY(-5px) rotate(0deg);
        opacity: 0.4;
      }

      100% {
        transform: translateY(0) rotate(0deg);
        opacity: 0.2;
      }
    }

    .newsletter-vip h2 {
      font-size: 30px;
      font-weight: 700;
      margin-bottom: 10px;
    }

    .newsletter-vip p {
      font-size: 16px;
      margin-bottom: 20px;
      color: #e0e0e0;
    }

    .vip-tags {
      display: flex;
      justify-content: center;
      flex-wrap: wrap;
      gap: 10px;
      margin-bottom: 20px;
    }

    .vip-tags span {
      font-size: 13px;
      background: #e91e63;
      padding: 5px 12px;
      border-radius: 20px;
      font-weight: 500;
      color: #fff;
    }

    .newsletter-form {
      display: flex;
      justify-content: center;
      gap: 10px;
      flex-wrap: wrap;
    }

    .newsletter-form input {
      padding: 12px 15px;
      font-size: 14px;
      border-radius: 6px;
      border: none;
      flex: 1;
      min-width: 250px;
      max-width: 320px;
    }

    .newsletter-form button {
      padding: 12px 20px;
      font-size: 14px;
      border: none;
      border-radius: 6px;
      background-color: #e91e63;
      color: #fff;
      font-weight: 600;
      cursor: pointer;
      transition: background 0.3s ease;
    }
    .news-form input{
      padding: 5px 10px;
      border-radius: 10px;
    }

    .newsletter-form button:hover {
      background-color: #c2185b;
    }

    .footer-logo img {
      width: 150px;
      height: 180px;
    }

    @media (max-width: 480px) {
      .newsletter-vip {
        padding: 15px 10px;
      }

      .newsletter-vip h2 {
        font-size: 18px;
      }

      .newsletter-vip p {
        font-size: 12px;
      }

      .newsletter-form {
        flex-direction: column;
        align-items: center;
      }

      .newsletter-form input,
      .newsletter-form button {
        width: 100%;
        max-width: none;
      }
      .newsletter-btn{
        margin-top: 10px;
      }
    }


    iframe,
    video {
      width: 100%;
      height: 220px;
      border: none;
    }

    @media (min-width: 768px) {

      iframe,
      video {
        height: 300px;
      }
    }
  </style>
</head>

<body class="index-page">
  <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MXM8KC7M"
      height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>

  <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

      <a href="#" class="logo d-flex align-items-center me-xl-0 me-auto">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <img src="assets/img/logo-light.png" alt="logo-light">
        <!-- <h1 class="sitename">Arsha</h1> -->
      </a>

      <nav id="navmenu" class="navmenu mx-xl-auto">
        <ul>
          <!-- <li class="dropdown"><a href="#"><span>Dropdown</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
              <li><a href="#">Dropdown 1</a></li>
              <li class="dropdown"><a href="#"><span>Deep Dropdown</span> <i
                    class="bi bi-chevron-down toggle-dropdown"></i></a>
                <ul>
                  <li><a href="#">Deep Dropdown 1</a></li>
                  <li><a href="#">Deep Dropdown 2</a></li>
                  <li><a href="#">Deep Dropdown 3</a></li>
                  <li><a href="#">Deep Dropdown 4</a></li>
                  <li><a href="#">Deep Dropdown 5</a></li>
                </ul>
              </li>
              <li><a href="#">Dropdown 2</a></li>
              <li><a href="#">Dropdown 3</a></li>
              <li><a href="#">Dropdown 4</a></li>
            </ul>
          </li> -->

        </ul>
      </nav>
      <div class="order-2">
        <span class="text-white me-2 d-md-inline-block d-none"><a href="tel:+1 (229) 329-1796" class="text-white">📞 +1 (229) 329-1796</a></span>
        <a class="btn-getstarted" id="scrollTopBtn" href="#">Get 10% Off Now</a>
      </div>

    </div>
  </header>
  <!-- Bootstrap Modal -->
  <div class="modal fade" id="voucherModal" tabindex="-1" aria-labelledby="voucherModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content border-0 rounded shadow">

        <div class="modal-body p-4 text-center">
          <button type="button" class="btn-close d-block ms-auto" data-bs-dismiss="modal" aria-label="Close"></button>
          <!-- Envelope Image (You can replace src with your own image) -->
          <img src="assets/img/email.png" alt="Envelope" class="mb-3" width="50">

          <h2 class="fw-bold">Save 10% Instantly on Your Flight</h2>
          <!-- <p class="text-muted small mb-4">Join 2.5M+ travelers getting insider access to flight deals. Subscribe now and get your exclusive $30 voucher!</p> -->

          <!-- Form -->
          <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
            <input type="text" name="type" value="discount" hidden>
            <input type="email" name="email" class="form-control mb-2" placeholder="Your best email">
            <span class="text-center  text-muted">AND/OR</span>
            <div class="input-group mb-2">
              <span class="input-group-text">
                <select name="country" class="border-0 p-0">
                  <option selected value="US"><img src="assets/img/usa.png" alt="usa" srcset="" class="me-2">US</option>
                  <option value="IN"><img src="assets/img/india.png" alt="india" srcset="" class="me-2">IN</option>
                  <option value="UK"><img src="assets/img/uk.png" alt="uk" srcset="" class="me-2">UK</option>
                </select>
              </span>
              <input type="tel" class="form-control" name="phone" placeholder="Phone">
            </div>

            <!-- Terms Checkbox -->


            <!-- Submit Button -->
            <button type="submit" class="btn btn-secondary w-100 my-2 fs-3">Get 10% Off Now</button>

            <!-- Footer Note -->
            <p class="text-muted small mb-0"><i class="bi bi-lock-fill me-1"></i>100% Safety & Privacy Guaranteed. Unsubscribe anytime.</p>
          </form>

        </div>
      </div>
    </div>
  </div>
  <!-- Bootstrap Modal -->
  <div class="modal fade" id="flightDealModal" tabindex="-1" aria-labelledby="flightDealModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content border-0 rounded shadow">
        <div class="modal-body p-4 text-center">
          <button type="button" class="btn-close d-block ms-auto" data-bs-dismiss="modal" aria-label="Close"></button>
          <img src="assets/img/chartered-flight.png" alt="flight" srcset="">
          <h2 class="fw-bold my-3">Still Searching for the Best Flight Deal?</h2>
          <h4 class="text-muted fw-semibold mb-3">USA to India Round Trip from Just <span class="text-secondary">$999*</span></h4>

          <ul class="list-unstyled small mb-3">
            <li>✅ Secret Fares | 📞 Priority Callback | 💬 WhatsApp Support</li>
          </ul>

          <p class="text-muted small mb-4">Get your quote in 10 minutes – no spam, no bots.</p>

          <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
            <div class="mb-2">
              <input type="text" name="type" value="quote" hidden>
              <input type="email" name="email" class="form-control" placeholder="Email" required>
            </div>
            <div class="mb-2">
              <span class="text-center text-muted">AND/OR</span>
            </div>
            <div class="mb-3">
              <input type="tel" name="phone" class="form-control" placeholder="Phone" required>
            </div>
            <button type="submit" class="btn btn-secondary w-100 fw-semibold">Get My $999* Quote Now</button>
          </form>

        </div>
      </div>
    </div>
  </div>

  <main class="main">

    <!-- Hero Section -->
    <section id="hero" class="hero section ">

      <div class="container">
        <div class="row gy-4 mt-3 justify-content-center align-items-center">
          <div class="col-10">
            <h1 class="text-center">USA-India Flight Deals For Any City, Any Date!</h1>
            <!-- <h3 class="text-center">Exclusive USA–India Round-Trips — Just $999! Any City, Any Date — Your Journey, Our
              Expertise.</h3> -->
            <p class="text-center">One-Way, Round Trip - We'll Plan Your India Trip Your Way</p>
          </div>

          <div class="col-lg-6 order-1 order-lg-1 text-center" data-aos="zoom-out">
            <div class="card fare-card">
              <div class="fare-card-header">
                EXCLUSIVE FARES FOR <br>
                DEC 25 & JAN 26
              </div>
              <div class="fare-card-body">
                <h2 class="mb-2 fs-1">USA to India Round Trip</h2>
                <p class="mb-2 text-muted fs-3">We Beat Any Flight Fare</p>
                <div class="mb-3">
                  <span class="price">$999*</span>
                  <span class="old-price">$1899</span>
                </div>
                <p class="mb-3 fs-3">Share Your Fare Screenshot - <br>We'll beat the price</p>
                <p class="fw-medium">If we can't, enjoy $50 off your next journey as our gift.</p>
                <div class="contact-icons mt-3">
                  <a href="tel:+1 229 329-1796" class="me-3 fs-3"><i
                      class="bi bi-telephone-fill call-icon me-2"></i>Call</a>
                  <a href="https://w.meta.me/s/1VjD9RIXA2l48dm" class="fs-3"><i class="bi bi-whatsapp whatsapp-icon"></i>WhatsApp</a>
                </div>
              </div>
            </div>

          </div>
          <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-out" data-aos-delay="200">
            <!-- Trip Type Selector -->
            <div class="text-center">
              <h2 class="mb-2 fs-1">24/7 Urgent Booking Available</h2>
            </div>
            <div class="mb-3 text-center">
              <div class="form-check form-check-inline">
                <input class="form-check-input fs-4" type="radio" name="trip_type" id="roundTrip" value="Round Trip" checked />
                <label class="form-check-label fw-medium fs-4" for="roundTrip">Round Trip</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input fs-4" type="radio" name="trip_type" id="oneWay" value="One Way" />
                <label class="form-check-label fw-medium fs-4" for="oneWay">One Way</label>
              </div>
              <!-- <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="trip_type" id="multiCity" value="Multi-City" />
                <label class="form-check-label" for="multiCity">Multi-City</label>
              </div> -->
            </div>

            <!-- Round Trip Form -->
            <div id="roundTripForm">
              <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" class="p-3 border rounded shadow-sm">
                <!-- Travel Dates -->
                <input name="type" class="form-control" value="round-trip" hidden />
                <div class="row g-2 mb-3">
                  <div class="col-md-6 col-sm-6">
                    <input type="date" name="departure_date" placeholder="Departure Date" class="form-control" required />
                  </div>
                  <div class="col-md-6 col-sm-6">
                    <input type="date" name="arrival_date" placeholder="Return Date" class="form-control" required />
                  </div>
                </div>
                <!-- Route 1 & 2 -->
                <div class="row g-2 mb-3">
                  <div class="col-md-6">
                    <input type="text" name="departure_place[]" placeholder="Departure place" class="form-control" required />
                  </div>
                  <div class="col-md-6">
                    <input type="text" name="arrival_place[]" placeholder="Arrival place" class="form-control" required />
                  </div>
                </div>
                <!-- Traveler Info -->
                <div class="row g-2 mb-3">
                  <div class="col-md-12">
                    <input type="text" class="form-control mb-2" name="full_name" placeholder="Full Name" required />
                  </div>
                  <div class="col-md-6">
                    <input type="email" class="form-control mb-2" name="email" placeholder="Email Address" required />
                  </div>
                  <div class="col-md-6">
                    <input type="tel" class="form-control" name="phone" placeholder="Phone Number" required />
                  </div>
                  <div class="col-md-12">
                    <textarea class="form-control mb-2" name="details" value="" placeholder="Additional Information" rows="2" col="3"></textarea>
                  </div>
                </div>
                <div class="text-center">
                  <button type="submit" class="btn-get-started">Get Your Fare In 10 Minutes</button>
                </div>
              </form>
            </div>

            <!-- One Way Form -->
            <div id="oneWayForm" style="display: none;">
              <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" class="p-3 border rounded shadow-sm">
                <input name="type" class="form-control" value="one-trip" hidden />
                <!-- Departure Date Only -->
                <div class="row g-2 mb-3">
                  <div class="col-md-12">
                    <input type="date" name="departure_date" class="form-control" required />
                  </div>
                  <!-- <div class="col-md-6">
                    <input type="date" name="arrival_date" class="form-control" required />
                  </div>
                </div> -->
                  <!-- Single Route -->
                  <div class="row g-2 mb-3">
                    <div class="col-md-6">
                      <input type="text" name="departure_place" placeholder="Departure place" class="form-control" required />
                    </div>
                    <div class="col-md-6">
                      <input type="text" name="arrival_place" placeholder="Arrival place" class="form-control" required />
                    </div>
                  </div>
                  <!-- Traveler Info -->
                  <div class="row g-2 mb-3">
                    <div class="col-md-12">
                      <input type="text" class="form-control mb-2" name="full_name" placeholder="Full Name" required />
                    </div>
                    <div class="col-md-6">
                      <input type="email" class="form-control mb-2" name="email" placeholder="Email Address" required />
                    </div>
                    <div class="col-md-6">
                      <input type="tel" class="form-control" name="phone" placeholder="Phone Number" required />
                    </div>
                    <div class="col-md-12">
                      <textarea class="form-control mb-2" name="details" value="" placeholder="Additional Information" ></textarea>
                    </div>
                  </div>
                  <div class="text-center">
                    <button type="submit" class="btn-get-started">Get Your Fare In 10 Minutes</button>
                  </div>
              </form>
            </div>

            <!-- Multi-City Form -->


            <div class="mt-4 text-sm text-center">
              <p>24/7 Support | Zero IVR Wait | Our Team Is Always Here For You.</p>
            </div>
          </div>
        </div>
      </div>

    </section><!-- /Hero Section -->

    <!-- Clients Section -->
    <section id="clients" class="clients section light-background">

      <div class="container" data-aos="zoom-in">

        <div class="swiper init-swiper">
          <script type="application/json" class="swiper-config">
            {
              "loop": true,
              "speed": 600,
              "autoplay": {
                "delay": 5000
              },
              "slidesPerView": "auto",
              "pagination": {
                "el": ".swiper-pagination",
                "type": "bullets",
                "clickable": true
              },
              "breakpoints": {
                "320": {
                  "slidesPerView": 2,
                  "spaceBetween": 40
                },
                "480": {
                  "slidesPerView": 3,
                  "spaceBetween": 60
                },
                "640": {
                  "slidesPerView": 4,
                  "spaceBetween": 80
                },
                "992": {
                  "slidesPerView": 5,
                  "spaceBetween": 120
                },
                "1200": {
                  "slidesPerView": 6,
                  "spaceBetween": 120
                }
              }
            }
          </script>
          <div class="swiper-wrapper align-items-center">
            <div class="swiper-slide"><img src="assets/img/clients/1.png" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="assets/img/clients/2.png" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="assets/img/clients/3.png" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="assets/img/clients/4.png" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="assets/img/clients/5.png" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="assets/img/clients/6.png" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="assets/img/clients/7.png" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="assets/img/clients/8.png" class="img-fluid" alt=""></div>
          </div>
        </div>

      </div>

    </section><!-- /Clients Section -->



    <!-- Services Section -->
    <section id="services" class=" text-md-center section ">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>SUPPORT FROM TICKET TO TAKEOFF</h2>

      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="steps-section">
          <div class="step-line"></div>
          <div class="container">
            <div class="d-flex overflow-x-auto white-space-nowrap">

              <div class=" step-wrapper mb-4">
                <div class="step-icon"><img src="assets/img/stepper1.png" alt=""></div>
                <div class="text-center">
                  <div class="step-title">Step 1 - Instant Ticket Confirmation</div>
                  <p class="mb-0">Your booking is secured within minutes! <br> E-tickets are sent instantly to your email <br> and WhatsApp for a smooth start.</p>
                </div>
              </div>

              <div class=" step-wrapper mb-4">
                <div class="step-icon"><img src="assets/img/stepper2.png" alt=""></div>
                <div class="text-center">
                  <div class="step-title">Step 2 - Personalized Travel Setup</div>
                  <p class="mb-0">We handle seat preferences, meal choices, <br> extra baggage, wheelchair assistance, <br> and special requests to make your journey comfortable.</p>
                </div>
              </div>

              <div class=" step-wrapper mb-4">
                <div class="step-icon"><img src="assets/img/stepper3.png" alt=""></div>
                <div class="text-center">
                  <div class="step-title">Step 3 - Real-Time Updates & Alerts</div>
                  <p class="mb-0">Get live flight tracking, gate change notifications,<br>delay alerts, and check-in reminders – always on time.</p>
                </div>
              </div>

              <div class=" step-wrapper mb-4">
                <div class="step-icon"><img src="assets/img/stepper4.png" alt=""></div>
                <div class="text-center">
                  <div class="step-title">Step 4 - 24/7 Boarding & Travel Support</div>
                  <p class="mb-0">Our team is on WhatsApp or call round-the-clock<br>to assist with last-minute needs or travel queries.</p>
                </div>
              </div>

            </div>
          </div>
        </div>

      </div>

    </section><!-- /Services Section -->

    <!-- Work Process Section -->
    <section id="work-process" class="work-process section light-background">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Our Lowest Flight Deals – USA to India</h2>
        <!-- <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p> -->
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <!-- <div class="row gy-5">

          <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="200">
            <div class="steps-item">
              <div class="steps-image">
                <img src="assets/img/services/1.jpg" alt="Step 1" class="img-fluid" loading="lazy">
              </div>
              <div class="steps-content">
                <div class="steps-number">01</div>
                <h3>USA to Ahmedabad</h3>
                <a href="#" class="btn-getstarted">Call Us to Book</a>

              </div>
            </div>
          </div>

          <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="300">
            <div class="steps-item">
              <div class="steps-image">
                <img src="assets/img/services/2.jpg" alt="Step 2" class="img-fluid" loading="lazy">
              </div>
              <div class="steps-content">
                <div class="steps-number">02</div>
                <h3>USA to Mumbai</h3>
                <a href="#" class="btn-getstarted">Call Us to Book</a>

              </div>
            </div>
          </div>

          <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="400">
            <div class="steps-item">
              <div class="steps-image">
                <img src="assets/img/services/3.jpg" alt="Step 3" class="img-fluid" loading="lazy">
              </div>
              <div class="steps-content">
                <div class="steps-number">03</div>
                <h3>USA to Bengaluru</h3>
                <a href="#" class="btn-getstarted">Call Us to Book</a>

              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="500">
            <div class="steps-item">
              <div class="steps-image">
                <img src="assets/img/services/4.jpg" alt="Step 3" class="img-fluid" loading="lazy">
              </div>
              <div class="steps-content">
                <div class="steps-number">04</div>
                <h3>USA to Hyderabad</h3>
                <a href="#" class="btn-getstarted">Call Us to Book</a>

              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="600">
            <div class="steps-item">
              <div class="steps-image">
                <img src="assets/img/services/5.jpg" alt="Step 3" class="img-fluid" loading="lazy">
              </div>
              <div class="steps-content">
                <div class="steps-number">05</div>
                <h3>USA to Delhi</h3>
                <a href="#" class="btn-getstarted">Call Us to Book</a>

              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="700">
            <div class="steps-item">
              <div class="steps-image">
                <img src="assets/img/services/6.jpg" alt="Step 3" class="img-fluid" loading="lazy">
              </div>
              <div class="steps-content">
                <div class="steps-number">06</div>
                <h3>USA to Chennai</h3>
                <a href="#" class="btn-getstarted">Call Us to Book</a>

              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="800">
            <div class="steps-item">
              <div class="steps-image">
                <img src="assets/img/services/7.jpg" alt="Step 3" class="img-fluid" loading="lazy">
              </div>
              <div class="steps-content">
                <div class="steps-number">07</div>
                <h3>USA to Kolkata</h3>
                <a href="#" class="btn-getstarted">Call Us to Book</a>

              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="900">
            <div class="steps-item">
              <div class="steps-image">
                <img src="assets/img/services/8.jpg" alt="Step 3" class="img-fluid" loading="lazy">
              </div>
              <div class="steps-content">
                <div class="steps-number">08</div>
                <h3>USA to Amritsar</h3>
                <a href="#" class="btn-getstarted">Call Us to Book</a>

              </div>
            </div>
          </div>

        </div> -->

        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-5 py-lg-5 text-center justify-content-center">
          <div class="col up-down">
            <img src="assets/img/Ahmedabad.png" alt="" class="img-fluid motion" width="120">
            <h4 class="pt-2">USA to Ahmedabad</h4>
          </div>
          <div class="col up-down">
            <img src="assets/img/Mumbai.png" alt="" class="img-fluid motion" width="120">
            <h4 class="pt-2">Usa to Mumbai</h4>
          </div>
          <div class="col up-down">
            <img src="assets/img/Bengaluru.png" alt="" class="img-fluid motion" width="120">
            <h4 class="pt-2">USA to Bengaluru</h4>
          </div>
          <div class="col up-down">
            <img src="assets/img/Hyderabad.png" alt="" class="img-fluid motion" width="120">
            <h4 class="pt-2">USA to Hyderabad</h4>
          </div>
          <div class="col up-down">
            <img src="assets/img/Delhi.png" alt="" class="img-fluid motion" width="120">
            <h4 class="pt-2">USA to Delhi</h4>
          </div>
          <div class="col up-down">
            <img src="assets/img/Chennai.png" alt="" class="img-fluid motion" width="120">
            <h4 class="pt-2"> USA to Chennai</h4>
          </div>
          <div class="col up-down">
            <img src="assets/img/Kolkata.png" alt="" class="img-fluid motion" width="120">
            <h4 class="pt-2">USA to Kolkata</h4>
          </div>
          <div class="col up-down">
            <img src="assets/img/Amritsar.png" alt="" class="img-fluid motion" width="120">
            <h4 class="pt-2">USA to Amritsar</h4>
          </div>
        </div>
        <div class="text-center">
          <h3 class="mb-3 fs-3 text-primart">More Routes Available </h3>
          <a href="callto: +1 (229) 329-1796" class="btn-getstarted mt-3">Call to Book</a>
        </div>

      </div>

    </section><!-- /Work Process Section -->

    <!-- Services Section -->
    <section id="services" class="services section ">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Why Travelers Trust GoGo Trips</h2>
        <!-- <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p> -->
      </div><!-- End Section Title -->

      <div class="container">

        <div class="row gy-4">


          <div class="col-xl-3 col-6 d-flex" data-aos="fade-up" data-aos-delay="100">
            <div class="service-item h-100 w-100 position-relative">
              <div class="icon"><i class="bi bi-building icon"></i></div>
              <h4>Offices in USA & India</h4>
              <p class="d-md-block d-none">On-ground teams in both countries for reliable, real-time assistance from
                booking to boarding.</p>
            </div>
          </div>
          <div class="col-xl-3 col-6 d-flex" data-aos="fade-up" data-aos-delay="200">
            <div class="service-item h-100 w-100 position-relative">
              <div class="icon"><i class="bi bi-award icon"></i></div>
              <h4>Trusted USA–India Travel Experts</h4>
              <p class="d-md-block d-none"> We help Indian families, students, and professionals with personalized care — from finding the best fares to seamless booking.</p>
            </div>
          </div><!-- End Service Item -->

          <div class="col-xl-3 col-6 d-flex" data-aos="fade-up" data-aos-delay="300">
            <div class="service-item h-100 w-100 position-relative">
              <div class="icon"><i class="bi bi-currency-dollar icon"></i></div>
              <h4>Unbeatable USA → India Fares from $999*</h4>
              <p class="d-md-block d-none">We specialize in long-haul routes with exclusive, unpublished round-trip
                deals you won’t find online.
              </p>
            </div>
          </div><!-- End Service Item -->

          <div class="col-xl-3 col-6 d-flex" data-aos="fade-up" data-aos-delay="400">
            <div class="service-item h-100 w-100 position-relative">
              <div class="icon"><i class="bi bi-globe icon"></i></div>
              <h4>Global Reach & Airline Partnerships</h4>
              <p class="d-md-block d-none">With ties across 50+ countries, we unlock special fares through direct
                airline relationships.</p>
            </div>
          </div><!-- End Service Item -->

          <div class="col-xl-3 col-6 d-flex" data-aos="fade-up" data-aos-delay="500">
            <div class="service-item h-100 w-100 position-relative">
              <div class="icon"><i class="bi bi-tag icon"></i></div>
              <h4>Lowest Price Guarantee</h4>
              <p class="d-md-block d-none">Found a cheaper fare online? Send a screenshot — we’ll beat it, no questions
                asked.</p>
            </div>
          </div><!-- End Service Item -->

          <div class="col-xl-3 col-6 d-flex" data-aos="fade-up" data-aos-delay="600">
            <div class="service-item h-100 w-100 position-relative">
              <div class="icon"><i class="bi bi-headset icon"></i></div>
              <h4>24/7 Human Support — In Your Language</h4>
              <p class="d-md-block d-none">Call or WhatsApp real agents anytime. No IVR, no bots. We speak English,
                Hindi, Gujarati, Tamil,Telugu
                & more.</p>
            </div>
          </div><!-- End Service Item -->

          <div class="col-xl-3 col-6 d-flex" data-aos="fade-up" data-aos-delay="700">
            <div class="service-item h-100 w-100 position-relative">
              <div class="icon"><i class="bi bi-calendar-check icon"></i></div>
              <h4>Change Plans Anytime, Your Way</h4>
              <p class="d-md-block d-none">Need to reschedule or customize your trip? We’ll handle it quickly and
                stress-free — perfect for
                students, senior citizens, family trips, group getaways, and business flyers.
              </p>
            </div>
          </div><!-- End Service Item -->

          <div class="col-xl-3 col-6 d-flex" data-aos="fade-up" data-aos-delay="800">
            <div class="service-item h-100 w-100 position-relative">
              <div class="icon"><i class="bi bi-bag-check icon"></i></div>
              <h4>Extra Baggage Help</h4>
              <p class="d-md-block d-none">We help you understand baggage rules and get discounted extra luggage options
                to save more.</p>
            </div>
          </div><!-- End Service Item -->
          <!-- End Service Item -->

        </div>

      </div>

    </section><!-- /Services Section -->

    <!-- Testimonials Section -->
    <section id="team" class="team section light-background">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Testimonials</h2>
        <!-- <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p> -->
      </div>

      <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="row gy-4 flex-nowrap overflow-x-auto mt-2">

          <div class="col-lg-4 col-md-6 aos-init aos-animate" data-aos="fade-up" data-aos-delay="100">
            <div class="card h-100">
              <video class="img-fluid" controls muted>
                <source src="assets/videos/001.mp4" type="video/mp4">
                Your browser does not support the video tag.
              </video>
              <div class="card-body">
                <h5 class="card-title">Khushboo</h5>
                <p class="card-text">New York, USA</p>
                <p class="card-text">
                  <span>"I booked my flight from JFK to Ahmedabad with GoGo Trip.
                    They gave me the best price compared to other websites. Mohit was very helpful with the booking process.
                    I highly recommend GoGo Trip!"</span>
                </p>
              </div>
            </div>
          </div><!-- End Team Member -->

          <div class="col-lg-4 col-md-6 aos-init aos-animate" data-aos="fade-up" data-aos-delay="200">
            <div class="card h-100">
              <video class="img-fluid" controls muted>
                <source src="assets/videos/003.mp4" type="video/mp4">
                Your browser does not support the video tag.
              </video>
              <div class="card-body">
                <h5 class="card-title">Tom Richards</h5>
                <p class="card-text">Crystal Lake, Illinois, USA</p>
                <p class="card-text">
                  <span>"I’ve used GoGo Trips several times for flights between Dublin, Florida, New York, Chicago, and California. They’ve saved me well over $1,000 with unbeatable service and prices. I highly recommend them — if they were on Trustpilot, I’d give them a 12 out of 10!"</span>
                </p>
              </div>
            </div>
          </div><!-- End Team Member -->

          <div class="col-lg-4 col-md-6 aos-init aos-animate" data-aos="fade-up" data-aos-delay="300">
            <div class="card h-100">
              <video class="img-fluid" controls muted>
                <source src="assets/videos/2.mp4" type="video/mp4">
                Your browser does not support the video tag.
              </video>
              <div class="card-body">
                <h5 class="card-title">Dhruvil</h5>
                <p class="card-text">Birmingham, UK</p>
                <p class="card-text">
                  <span>"GoGo Trips made my Ahmedabad–Birmingham flight booking simple, transparent, and within budget. Henish Patel’s support and updates were excellent. I highly recommend them!"</span>
                </p>
              </div>
            </div>
          </div><!-- End Team Member -->
        </div>
      </div>

    </section><!-- /Testimonials Section -->

    <!-- Faq 2 Section -->
    <section id="faq-2" class="faq-2 section ">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Frequently Asked Questions</h2>
        <!-- <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint
          consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit
          in iste officiis commodi quidem hic quas.</p> -->
      </div><!-- End Section Title -->

      <div class="container">

        <div class="row justify-content-center">

          <div class="col-lg-10">

            <div class="faq-container">

              <div class="faq-item faq-active" data-aos="fade-up" data-aos-delay="200">
                <i class="faq-icon bi bi-arrow-right-circle"></i>
                <h3>Why book with GoGoTrips instead of online?</h3>
                <div class="faq-content">
                  <p>We offer unpublished fares, real human support (no bots), and custom itineraries you won’t find on
                    booking sites.</p>
                </div>
                <i class="faq-toggle bi bi-chevron-right"></i>
              </div><!-- End Faq item-->

              <div class="faq-item" data-aos="fade-up" data-aos-delay="300">
                <i class="faq-icon bi bi-arrow-right-circle"></i>
                <h3>Can I book via WhatsApp or phone?</h3>
                <div class="faq-content">
                  <p>Yes! Simply call or message us with your trip details. We’ll send your quote in minutes—no forms,no
                    wait.</p>
                </div>
                <i class="faq-toggle bi bi-chevron-right"></i>
              </div><!-- End Faq item-->

              <div class="faq-item" data-aos="fade-up" data-aos-delay="400">
                <i class="faq-icon bi bi-arrow-right-circle"></i>
                <h3>What’s your cancellation and refund policy?</h3>
                <div class="faq-content">
                  <p>We assist with cancellations, changes, refunds, and airline credit. Our team is available 24/7 to
                    support you.</p>
                </div>
                <i class="faq-toggle bi bi-chevron-right"></i>
              </div><!-- End Faq item-->

              <div class="faq-item" data-aos="fade-up" data-aos-delay="500">
                <i class="faq-icon bi bi-arrow-right-circle"></i>
                <h3>Do you offer a price match if I find a better deal?</h3>
                <div class="faq-content">
                  <p>Yes. Send us a screenshot—we’ll match or beat most online prices, with better service included.</p>
                </div>
                <i class="faq-toggle bi bi-chevron-right"></i>
              </div><!-- End Faq item-->

              <div class="faq-item" data-aos="fade-up" data-aos-delay="600">
                <i class="faq-icon bi bi-arrow-right-circle"></i>
                <h3>Do you help with wheelchairs or other special needs?</h3>
                <div class="faq-content">
                  <p>Absolutely. We handle wheelchair service, meal requests, medical support, and more—just let us know
                    in advance.</p>
                </div>
                <i class="faq-toggle bi bi-chevron-right"></i>
              </div><!-- End Faq item-->

              <div class="faq-item" data-aos="fade-up" data-aos-delay="600">
                <i class="faq-icon bi bi-arrow-right-circle"></i>
                <h3>What documents do I need to travel to India?</h3>
                <div class="faq-content">
                  <p>You’ll need a valid passport and an Indian visa or OCI card. We’ll guide you through the latest
                    travel rules if needed.</p>
                </div>
                <i class="faq-toggle bi bi-chevron-right"></i>
              </div><!-- End Faq item-->

            </div>

          </div>

        </div>

      </div>

    </section><!-- /Faq 2 Section -->

  </main>

  <footer id="footer" class="footer">

    <div class="footer-newsletter">
      <div class="container">
        <div class="row justify-content-center text-center">
          <section class="newsletter-vip">
            <h2 class="text-white">Get Deals Before Anyone Else!</h2>
            <p>Join our VIP list and unlock early access to flash sales, special fares, and exclusive flight offers.</p>
            <div class="vip-tags">
              <span>VIP Price Alerts</span>
              <span>Exclusive Discounts</span>
              <span>24/7 Priority Support</span>
            </div>
            <form class="news-form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
              <input name="type" value="subscribe" hidden>
              <input type="text" name="full_name" placeholder="Enter your name" required>
              <input type="email" name="email" placeholder="Enter your email" required>
              <input class="btn btn-danger newsletter-btn" type="submit" value="Join the VIP List">
            </form>
          </section>
        </div>
      </div>
    </div>
    <div class="bg-primary text-white">
      <div class="container footer-top">
        <div class="row gy-4">
          <div class="col-md-4">
            <a href="#" class="d-flex justify-content-center align-items-center footer-logo">
              <!-- <span class="sitename">Arsha</span> -->
              <img src="assets/img/logo-4.png" alt="" srcset="" class="mx-auto">
            </a>
          </div>
          <div class="col-md-4">
            <p class="text-center mt-2"><strong>Address:</strong> 8 The Green, Suite B,</p>
            <p class="text-center">Dover,Delaware -19901</p>
            <p class="mt-3 text-center"><strong>Phone:</strong><a href="tel:+1 (229) 329-1796" class="text-white"> +1 (229) 329-1796</a></p>
            <p class="mt-3 text-center"><strong>WhatsApp:</strong><a href="https://w.meta.me/s/1VjD9RIXA2l48dm" class="text-white"> +1954-347-5414</a></p>
            <!-- <p class="mt-3 text-center"><strong>WhatsApp:</strong> <a href="tel:+1954-347-5414" class="text-white">+1954-347-5414</a></p> -->
            <p class="mt-3 text-center">
              <strong>Email:</strong>
              <a href="mailto:info@gogotripsus.com?subject=Travel Inquiry" class="text-white">
                <span> info@gogotripsus.com</span>
              </a>
            </p>
          </div>
          <div class="col-md-4 footer-links d-flex flex-column align-items-center">
            <h5 class="text-white mb-3">Quick Links</h5>
            <ul class="d-flex flex-column gap-3">
              <li> <a href="https://gogotripsus.com/terms-conditions/" class="text-white">Terms and conditions</a></li>
              <li> <a href="https://gogotripsus.com/privacy-policy/" class="text-white">Privacy Policy</a></li>
            </ul>
          </div>
        </div>
      </div>

      <div class="container copyright text-center ">
        <p>© <span>Copyright</span> <strong class="px-1 sitename">GoGoTrips</strong> <span>All Rights Reserved</span></p>
        <div class="credits">

        </div>
      </div>
    </div>


  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
      class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/waypoints/noframework.waypoints.js"></script>
  <script src="assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>

  <!-- Main JS File -->
  <script src="assets/js/main.js"></script>
  <script>
    let skillIndex = 0;
    document.addEventListener("DOMContentLoaded", function() {

      if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
      }

      const roundTripRadio = document.getElementById("roundTrip");
      const oneWayRadio = document.getElementById("oneWay");
      const multiCityRadio = document.getElementById("multiCity");

      const roundTripForm = document.getElementById("roundTripForm");
      const oneWayForm = document.getElementById("oneWayForm");
      const multiCityForm = document.getElementById("multiCityForm");



      function toggleForms() {
        if (roundTripRadio.checked) {
          roundTripForm.style.display = "block";
          oneWayForm.style.display = "none";
          multiCityForm.style.display = "none";
        } else if (oneWayRadio.checked) {
          roundTripForm.style.display = "none";
          oneWayForm.style.display = "block";
          multiCityForm.style.display = "none";
        } else if (multiCityRadio.checked) {
          roundTripForm.style.display = "none";
          oneWayForm.style.display = "none";
          multiCityForm.style.display = "block";
        }
      }

      // Event listeners
      roundTripRadio.addEventListener("change", toggleForms);
      oneWayRadio.addEventListener("change", toggleForms);


      // Initialize view on load
      toggleForms();


      document.getElementById('add-more').addEventListener('click', function() {
        const container = document.getElementById('skills-container');
        const index = container.querySelectorAll('.skill-item').length;

        const newSkillItem = document.createElement('div');
        newSkillItem.className = 'col-md-6 skill-item';
        newSkillItem.setAttribute('data-index', index);
        newSkillItem.innerHTML = `
                        <div class="input-group">
                            <input type="text" name="arrival_place[]" placeholder="Arrival place" class="form-control skill-input" required />
                            <button type="button" class="btn btn-danger remove-btn">Remove</button>
                        </div>
                    `;

        container.appendChild(newSkillItem);

        // Add remove functionality to the new remove button
        newSkillItem.querySelector('.remove-btn').addEventListener('click', function() {
          newSkillItem.remove();
        });
      });




    });
  </script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    
    document.getElementById('scrollTopBtn').addEventListener('click', function() {
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
      });
    });
    
    const today = new Date().toISOString().split('T')[0];
    const departureInput = document.querySelector('input[name="arrival_date"]');
    const arrivalInput = document.querySelector('input[name="departure_date"]');

    arrivalInput.setAttribute('min', today);

    
    arrivalInput.addEventListener('change', function() {
      departureInput.setAttribute('min', arrivalInput.value);
    });
    let modalShown = false;

    window.addEventListener('scroll', function() {
      const scrollTop = window.scrollY || document.documentElement.scrollTop;
      const docHeight = document.documentElement.scrollHeight - document.documentElement.clientHeight;
      const scrollPercent = (scrollTop / docHeight) * 100;

      if (scrollPercent > 50 && !modalShown) {
        const myModal = new bootstrap.Modal(document.getElementById('flightDealModal'));
        myModal.show();
        modalShown = true;
      } else if (scrollPercent < 40) {
        modalShown = false; // Reset when user scrolls up
      }
    });
  </script>
  <script>
    <?php if (!empty($toastr_message)): ?>
      document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
          icon: '<?php echo $toastr_type; ?>',
          title: '<?php echo $toastr_type === 'success' ? 'Success!' : ($toastr_type === 'warning' ? 'Warning' : 'Error'); ?>',
          text: '<?php echo addslashes($toastr_message); ?>',
          showConfirmButton: true,
          timer: 5000,
          timerProgressBar: true
        });
      });
    <?php endif; ?>
  </script>

</body>

</html>