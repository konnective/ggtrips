
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Newsletter with Dual Airplanes</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f7f7f7;
    }
    .newsletter-vip {
      max-width: 900px;
      margin: 40px auto;
      padding: 30px 25px;
      background: linear-gradient(135deg, #102770, #1d3a8a);
      border-radius: 12px;
      text-align: center;
      color: #fff;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
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
      0% { transform: translateY(0) rotate(0deg); opacity: 0.2; }
      50% { transform: translateY(-5px) rotate(0deg); opacity: 0.4; }
      100% { transform: translateY(0) rotate(0deg); opacity: 0.2; }
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
    .newsletter-form button:hover {
      background-color: #c2185b;
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
