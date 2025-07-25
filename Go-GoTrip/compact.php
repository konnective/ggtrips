
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>VIP Newsletter</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      margin: 0;
      padding: 0;
    }
    .newsletter-vip {
      max-width: 800px;
      margin: 40px auto;
      padding: 30px 20px;
      background: #102770;
      border-radius: 12px;
      text-align: center;
      color: #fff;
      position: relative;
      overflow: hidden;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }
    .newsletter-vip::after {
      content: "";
      background: url('https://img.icons8.com/ios-filled/100/ffffff/airplane-take-off.png') no-repeat;
      opacity: 0.1;
      background-size: 80px;
      position: absolute;
      right: 15px;
      top: 15px;
      width: 80px;
      height: 80px;
    }
    .newsletter-vip h2 {
      font-size: 24px;
      font-weight: 700;
      margin: 0 0 10px;
    }
    .newsletter-vip p {
      font-size: 14px;
      margin: 0 0 20px;
      color: #e0e0e0;
    }
    .vip-tags {
      display: flex;
      justify-content: center;
      flex-wrap: wrap;
      gap: 8px;
      margin-bottom: 15px;
    }
    .vip-tags span {
      font-size: 12px;
      background: #e91e63;
      padding: 4px 10px;
      border-radius: 12px;
      color: #fff;
      font-weight: 500;
    }
    .newsletter-form {
      display: flex;
      justify-content: center;
      gap: 10px;
      flex-wrap: wrap;
    }
    .newsletter-form input {
      padding: 10px 12px;
      font-size: 13px;
      border-radius: 6px;
      border: none;
      flex: 1;
      min-width: 220px;
      max-width: 300px;
    }
    .newsletter-form button {
      padding: 10px 20px;
      font-size: 13px;
      border: none;
      border-radius: 6px;
      background-color: #e91e63;
      color: #fff;
      font-weight: 600;
      cursor: pointer;
      transition: background 0.3s ease;
    }
    .newsletter-form button:hover {
      background-color: #c2185b;
    }
  </style>
</head>
<body>
  <section class="newsletter-vip">
    <h2>Get Deals Before Anyone Else!</h2>
    <p>Join our VIP list and unlock 24-hour early access to flash sales, special fares, and exclusive offers.</p>
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
