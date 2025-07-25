<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Travel Website Footer</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        .footer {
            background-color: #2e318e;
            color: white;
            padding: 40px 0;
        }
        .footer a {
            color: #e91e63;
            text-decoration: none;
        }
        .footer a:hover {
            color: #c2185b;
        }
        .footer-logo img {
            max-width: 150px;
        }
        .footer-contact i {
            margin-right: 10px;
            color: #e91e63;
        }
        .footer-links ul {
            list-style: none;
            padding: 0;
        }
        .footer-links ul li {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <footer class="footer">
        <div class="container">
            <div class="row">
                <!-- Logo Section -->
                <div class="col-md-4 text-center text-md-start mb-4 mb-md-0">
                    <div class="footer-logo">
                        <img src="https://via.placeholder.com/150x50?text=Logo" alt="Travel Logo">
                    </div>
                </div>
                <!-- Contact Section -->
                <div class="col-md-4 text-center text-md-start mb-4 mb-md-0">
                    <h5>Contact Us</h5>
                    <p class="footer-contact">
                        <i class="fas fa-map-marker-alt"></i> 123 Travel St, Wanderlust City, WL 12345<br>
                        <i class="fas fa-phone"></i> +1 (555) 123-4567<br>
                        <i class="fas fa-envelope"></i> <a href="mailto:info@travel.com">info@travel.com</a><br>
                        <i class="fab fa-whatsapp"></i> <a href="https://wa.me/15551234567">+1 (555) 123-4567</a>
                    </p>
                </div>
                <!-- Links Section -->
                <div class="col-md-4 text-center text-md-start">
                    <h5>Quick Links</h5>
                    <div class="footer-links">
                        <ul >
                            <li><a href="/about">About Us</a></li>
                            <li><a href="/destinations">Destinations</a></li>
                            <li><a href="/blog">Travel Blog</a></li>
                            <li><a href="/contact">Contact</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>