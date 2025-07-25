
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>VIP Newsletter - Final Compact</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f7f7f7;
    }
    .newsletter-vip {
      max-width: 700px;
      margin: 25px auto;
      padding: 20px 15px;
      background: #102770;
      border-radius: 10px;
      text-align: center;
      color: #fff;
      position: relative;
      box-shadow: 0 3px 8px rgba(0, 0, 0, 0.15);
    }
    .newsletter-vip::after {
      content: "";
      background: url('https://img.icons8.com/ios-filled/100/ffffff/airplane-take-off.png') no-repeat;
      opacity: 0.1;
      background-size: 60px;
      position: absolute;
      right: 10px;
      top: 10px;
      width: 60px;
      height: 60px;
    }
    .newsletter-vip h2 {
      font-size: 22px;
      font-weight: 700;
      margin: 0 0 8px;
    }
    .newsletter-vip p {
      font-size: 13px;
      margin: 0 0 15px;
      color: #e0e0e0;
    }
    .vip-tags {
      display: flex;
      justify-content: center;
      flex-wrap: wrap;
      gap: 6px;
      margin-bottom: 12px;
    }
    .vip-tags span {
      font-size: 11px;
      background: #e91e63;
      padding: 3px 8px;
      border-radius: 10px;
      color: #fff;
      font-weight: 500;
    }
    .newsletter-form {
      display: flex;
      justify-content: center;
      gap: 8px;
      flex-wrap: wrap;
    }
    .newsletter-form input {
      padding: 8px 10px;
      font-size: 12px;
      border-radius: 5px;
      border: none;
      flex: 1;
      min-width: 180px;
      max-width: 260px;
    }
    .newsletter-form button {
      padding: 8px 16px;
      font-size: 12px;
      border: none;
      border-radius: 5px;
      background-color: #e91e63;
      color: #fff;
      font-weight: 600;
      cursor: pointer;
      transition: background 0.3s ease;
    }
    .newsletter-form button:hover {
      background-color: #c2185b;
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
      .newsletter-form input, .newsletter-form button {
        width: 100%;
        max-width: none;
      }
    }
  </style>
</head>
<body>
  <section class="newsletter-vip">
    <h2>Get Deals Before Anyone Else!</h2>
    <p>Join our VIP list and unlock early access to flash sales, special fares, and exclusive flight offers.</p>
    <div class="vip-tags">
      <span>VIP Price Alerts</span>
      <span>Exclusive Discounts</span>
      <span>24/7 Priority Support</span>
    </div>
    <form class="newsletter-form">
      <input type="email" placeholder="Enter your email" required>
      <button type="submit">Join the VIP List</button>
    </form>
  </section>
</body>
</html>
