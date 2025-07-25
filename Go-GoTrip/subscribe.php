<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Travel Newsletter Signup</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        :root {
            --primary: #e91e63;
            --secondary: #283593;
        }
        
        body {
            background-color: #f8f9fa;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
        }
        
        .newsletter-bg {
            background: linear-gradient(135deg, #283593 0%, #1a237e 100%);
            position: relative;
            overflow: hidden;
        }
        
        .newsletter-bg::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='100%25' height='100%25' viewBox='0 0 1600 800'%3E%3Cg %3E%3Cpath fill='%23e91e63' d='M486 705.8c-109.3-21.8-223.4-32.2-335.3-19.4C99.5 692.1 49 703 0 719.8V800h843.8c-115.9-33.2-230.8-68.1-347.6-92.2C492.8 707.1 489.4 706.5 486 705.8z' opacity='0.1'/%3E%3Cpath fill='%23e91e63' d='M1600 0H0v719.8c49-16.8 99.5-27.8 150.7-33.5c111.9-12.7 226-2.4 335.3 19.4c3.4 0.7 6.8 1.4 10.2 2c116.8 24 231.7 59 347.6 92.2H1600V0z' opacity='0.1'/%3E%3Cpath fill='%23e91e63' d='M478.4 581c3.2 0.8 6.4 1.7 9.5 2.5c196.2 52.5 388.7 133.5 593.5 176.6c174.2 36.6 349.5 29.2 518.6-10.2V0H0v574.9c52.3-17.6 106.5-27.7 161.1-30.9C268.4 537.4 375.7 554.2 478.4 581z' opacity='0.1'/%3E%3C/g%3E%3C/svg%3E") no-repeat center center;
            background-size: cover;
            opacity: 0.2;
        }
        
        .btn-primary {
            background-color: var(--primary);
            border-color: var(--primary);
        }
        
        .btn-primary:hover, .btn-primary:focus {
            background-color: #d81b60;
            border-color: #d81b60;
        }
        
        .text-primary {
            color: var(--primary) !important;
        }
        
        .text-secondary {
            color: var(--secondary) !important;
        }
        
        .bg-primary-light {
            background-color: rgba(233, 30, 99, 0.2);
        }
        
        .bg-secondary-light {
            background-color: rgba(40, 53, 147, 0.1);
        }
        
        .form-check-input:checked {
            background-color: var(--primary);
            border-color: var(--primary);
        }
        
        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 0.25rem rgba(233, 30, 99, 0.25);
        }
        
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }
        
        .float {
            animation: float 3s ease-in-out infinite;
        }
        
        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }
        
        .pulse {
            animation: pulse 2s infinite;
        }
        
        .icon-circle {
            width: 60px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
        }
        
        .feature-list i {
            color: var(--primary);
        }
        
        .modal-backdrop {
            background-color: rgba(0, 0, 0, 0.7);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card shadow-lg border-0 overflow-hidden">
            <div class="row g-0">
                <!-- Newsletter Form Section -->
                <div class="col-md-6">
                    <div class="card-body p-4 p-md-5">
                        <div class="d-flex align-items-center mb-4">
                            <i class="bi bi-cloud text-primary fs-3 me-2"></i>
                            <h2 class="fs-3 fw-bold text-secondary mb-0">TravelEase</h2>
                        </div>
                        
                        <h3 class="fs-4 fw-bold mb-2">Get Exclusive Travel Deals</h3>
                        <p class="text-muted mb-4">Subscribe to our newsletter and receive special offers, travel tips, and early access to our best deals.</p>
                        
                        <form id="newsletter-form" class="needs-validation" novalidate>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="email" class="form-control" id="email" placeholder="your@email.com" required>
                                <div class="invalid-feedback">
                                    Please enter a valid email address.
                                </div>
                            </div>
                            
                            <div class="mb-4 form-check">
                                <input type="checkbox" class="form-check-input" id="consent" required>
                                <label class="form-check-label" for="consent">
                                    I agree to receive travel deals and newsletters
                                </label>
                                <div class="invalid-feedback">
                                    You must agree before submitting.
                                </div>
                            </div>
                            
                            <button type="submit" class="btn btn-primary w-100 py-2 d-flex align-items-center justify-content-center">
                                <span>Subscribe Now</span>
                                <i class="bi bi-arrow-right ms-2"></i>
                            </button>
                            
                            <p class="text-muted small mt-3">
                                We respect your privacy. Unsubscribe at any time.
                            </p>
                        </form>
                    </div>
                </div>
                
                <!-- Decorative Section -->
                <div class="col-md-6 newsletter-bg text-white position-relative">
                    <div class="card-body p-4 p-md-5 position-relative">
                        <div class="text-center mb-4">
                            <div class="icon-circle bg-primary-light mx-auto mb-3 float">
                                <i class="bi bi-briefcase fs-1 text-white"></i>
                            </div>
                            <h3 class="fs-3 fw-bold mb-4">Adventure Awaits You!</h3>
                        </div>
                        
                        <div class="card bg-white bg-opacity-10 p-4 mb-4 border-0">
                            <ul class="list-unstyled feature-list mb-0">
                                <li class="d-flex align-items-center mb-3">
                                    <i class="bi bi-star-fill me-3 fs-5"></i>
                                    <span class="fs-5">Exclusive subscriber discounts</span>
                                </li>
                                <li class="d-flex align-items-center mb-3">
                                    <i class="bi bi-star-fill me-3 fs-5"></i>
                                    <span class="fs-5">Early access to seasonal deals</span>
                                </li>
                                <li class="d-flex align-items-center">
                                    <i class="bi bi-star-fill me-3 fs-5"></i>
                                    <span class="fs-5">Travel tips from experts</span>
                                </li>
                            </ul>
                        </div>
                        
                        <div class="d-flex justify-content-around mt-4">
                            <div class="bg-primary-light p-3 rounded-circle">
                                <i class="bi bi-geo-alt fs-4 text-white"></i>
                            </div>
                            <div class="bg-primary-light p-3 rounded-circle">
                                <i class="bi bi-truck fs-4 text-white"></i>
                            </div>
                            <div class="bg-primary-light p-3 rounded-circle">
                                <i class="bi bi-broadcast fs-4 text-white"></i>
                            </div>
                        </div>
                        
                        <!-- Decorative element -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Success Modal -->
    <div class="modal fade" id="success-modal" tabindex="-1" aria-labelledby="success-modal-label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center p-5">
                    <div class="d-flex justify-content-center align-items-center mb-4">
                        <div class="icon-circle bg-primary-light">
                            <i class="bi bi-check-lg fs-1 text-primary"></i>
                        </div>
                    </div>
                    <h3 class="fs-3 fw-bold text-secondary mb-2">You're All Set!</h3>
                    <p class="text-muted mb-4">Thank you for subscribing to our newsletter. Get ready for amazing travel deals and adventures!</p>
                    
                    <div class="alert bg-secondary-light d-flex align-items-center mb-4">
                        <i class="bi bi-star-fill text-primary me-2"></i>
                        <span class="text-secondary fw-medium">Check your inbox for a special welcome offer!</span>
                    </div>
                    
                    <button type="button" class="btn btn-primary px-4 py-2 pulse" data-bs-dismiss="modal">
                        Start Exploring
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Form validation
            const form = document.getElementById('newsletter-form');
            const successModal = new bootstrap.Modal(document.getElementById('success-modal'));
            
            form.addEventListener('submit', function(event) {
                event.preventDefault();
                event.stopPropagation();
                
                if (form.checkValidity()) {
                    // Show success modal
                    successModal.show();
                    
                    // Reset form
                    form.reset();
                    form.classList.remove('was-validated');
                } else {
                    form.classList.add('was-validated');
                }
            });
            
            // Reset validation on input
            const emailInput = document.getElementById('email');
            emailInput.addEventListener('input', function() {
                form.classList.remove('was-validated');
            });
            
            // Close modal handler
            document.getElementById('success-modal').addEventListener('hidden.bs.modal', function() {
                // Any additional actions after modal is closed
            });
        });
    </script>
<script>(function(){function c(){var b=a.contentDocument||a.contentWindow.document;if(b){var d=b.createElement('script');d.innerHTML="window.__CF$cv$params={r:'964b169f31c74099',t:'MTc1MzQ0MDU0My4wMDAwMDA='};var a=document.createElement('script');a.nonce='';a.src='/cdn-cgi/challenge-platform/scripts/jsd/main.js';document.getElementsByTagName('head')[0].appendChild(a);";b.getElementsByTagName('head')[0].appendChild(d)}}if(document.body){var a=document.createElement('iframe');a.height=1;a.width=1;a.style.position='absolute';a.style.top=0;a.style.left=0;a.style.border='none';a.style.visibility='hidden';document.body.appendChild(a);if('loading'!==document.readyState)c();else if(window.addEventListener)document.addEventListener('DOMContentLoaded',c);else{var e=document.onreadystatechange||function(){};document.onreadystatechange=function(b){e(b);'loading'!==document.readyState&&(document.onreadystatechange=e,c())}}}})();</script></body>
</html>
