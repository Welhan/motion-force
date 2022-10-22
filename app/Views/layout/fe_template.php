<?php
$db = \config\Database::connect();
$categorys = $db->query('SELECT * FROM category WHERE active = 1 and ID IN(SELECT categoryID FROM product where active=1)');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Motion Force</title>
    <meta name="robots" content="noindex, nofollow">
    <meta content="" name="description">
    <meta content="" name="keywords">
    <link href="herobiz/assets/img/favicon.png" rel="icon">
    <link href="herobiz/assets/img/apple-touch-icon.png" rel="apple-touch-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <!-- <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Source+Sans+Pro:ital,wght@0,300;0,400;0,600;0,700;1,300;1,400;1,600;1,700&display=swap" rel="stylesheet">
    <link href="herobiz/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="herobiz/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="herobiz/assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="herobiz/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="herobiz/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    <link href="herobiz/assets/css/variables.css" rel="stylesheet">
    <link href="herobiz/assets/css/main.css" rel="stylesheet">
</head>

<body>
    <header id="header" class="header fixed-top" data-scrollto-offset="0">
        <div class="container-fluid d-flex align-items-center justify-content-between"> <a href="#" class="logo d-flex align-items-center scrollto me-auto me-lg-0">
                <h1>Motion <span>Force</span></h1>
            </a>
            <nav id="navbar" class="navbar">
                <ul>
                    <li class="dropdown <?= (count($categorys->getResult()) > 1) ? 'megamenu' : ''; ?> "><a href="#"><span>Products</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
                        <ul>
                            <?php
                            foreach ($categorys->getResult() as $category) :
                            ?>
                                <li> <a href="#"><b><?= $category->category; ?></b></a>
                                    <?php
                                    $products = $db->query("SELECT * FROM product WHERE active=1 and categoryID = $category->id");
                                    foreach ($products->getResult() as $product) :
                                    ?>
                                        <a href="#">>> <?= $product->name; ?></a>
                                    <?php endforeach; ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                    <li><a class="nav-link scrollto" href="#about">About</a></li>
                    <li><a class="nav-link scrollto" href="#services">Services</a></li>
                    <li><a class="nav-link scrollto" href="#portfolio">Portfolio</a></li>
                    <!-- <li><a class="nav-link scrollto" href="#team">Team</a></li> -->
                    <li><a href="blog.html">Blog</a></li>
                    <li class="dropdown"><a href="#"><span>Drop Down</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
                        <ul>
                            <li><a href="#">Drop Down 1</a></li>
                            <li class="dropdown"><a href="#"><span>Deep Drop Down</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
                                <ul>
                                    <li><a href="#">Deep Drop Down 1</a></li>
                                    <li><a href="#">Deep Drop Down 2</a></li>
                                    <li><a href="#">Deep Drop Down 3</a></li>
                                    <li><a href="#">Deep Drop Down 4</a></li>
                                    <li><a href="#">Deep Drop Down 5</a></li>
                                </ul>
                            </li>
                            <li><a href="#">Drop Down 2</a></li>
                            <li><a href="#">Drop Down 3</a></li>
                            <li><a href="#">Drop Down 4</a></li>
                        </ul>
                    </li>
                    <li><a class="nav-link scrollto" href="index.html#contact">Contact</a></li>
                </ul> <i class="bi bi-list mobile-nav-toggle d-none"></i>
            </nav>
            <div class="scrollto" href="index.html#about"></div>
        </div>
    </header>
    <!-- <section id="hero-animated" class="hero-animated d-flex align-items-center">
        <div class="container d-flex flex-column justify-content-center align-items-center text-center position-relative" data-aos="zoom-out"> <img src="herobiz/assets/img/hero-carousel/hero-carousel-3.svg" class="img-fluid animated">
            <h2>Welcome to <span>Motion Force</span></h2>
            <p>Et voluptate esse accusantium accusamus natus reiciendis quidem voluptates similique aut.</p>
        </div>
    </section> -->
    <main id="main">
        <?= $this->renderSection('fe_content'); ?>
    </main>
    <footer id="footer" class="footer">
        <!-- <div class="footer-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="footer-info">
                            <h3>HeroBiz</h3>
                            <p> A108 Adam Street <br> NY 535022, USA<br><br> <strong>Phone:</strong> +1 5589 55488 55<br> <strong>Email:</strong> <a href="https://mail.google.com/mail/#inbox?compose=new" target="_blank" class="__cf_email__">welhan.susanto@gmail.com</a><br></p>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-6 footer-links">
                        <h4>Useful Links</h4>
                        <ul>
                            <li><i class="bi bi-chevron-right"></i> <a href="#">Home</a></li>
                            <li><i class="bi bi-chevron-right"></i> <a href="#about">About us</a></li>
                            <li><i class="bi bi-chevron-right"></i> <a href="#services">Services</a></li>
                            <li><i class="bi bi-chevron-right"></i> <a href="#">Terms of service</a></li>
                            <li><i class="bi bi-chevron-right"></i> <a href="#">Privacy policy</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-3 col-md-6 footer-links">
                        <h4>Our Services</h4>
                        <ul>
                            <li><i class="bi bi-chevron-right"></i> <a href="#">Web Design</a></li>
                            <li><i class="bi bi-chevron-right"></i> <a href="#">Web Development</a></li>
                            <li><i class="bi bi-chevron-right"></i> <a href="#">Product Management</a></li>
                            <li><i class="bi bi-chevron-right"></i> <a href="#">Marketing</a></li>
                            <li><i class="bi bi-chevron-right"></i> <a href="#">Graphic Design</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-4 col-md-6 footer-newsletter">
                        <h4>Our Newsletter</h4>
                        <p>Tamen quem nulla quae legam multos aute sint culpa legam noster magna</p>
                        <form action="" method="post"> <input type="email" name="email"><input type="submit" value="Subscribe"></form>
                    </div>
                </div>
            </div>
        </div> -->
        <div class="footer-legal text-center">
            <div class="container d-flex flex-column flex-lg-row justify-content-center justify-content-lg-between align-items-center">
                <div class="d-flex flex-column align-items-center align-items-lg-start">
                    <div class="copyright"> &copy; Copyright <strong><span>Motion Force (Powered By: WProject & HeroBiz)</span></strong>. All Rights Reserved</div>
                    <!-- <div class="credits"> Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a></div> -->
                </div>
                <div class="social-links order-first order-lg-last mb-3 mb-lg-0"> <a href="#" class="twitter"><i class="bi bi-twitter"></i></a> <a href="#" class="facebook"><i class="bi bi-facebook"></i></a> <a href="#" class="instagram"><i class="bi bi-instagram"></i></a> <a href="#" class="google-plus"><i class="bi bi-skype"></i></a> <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a></div>
            </div>
        </div>
    </footer> <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
    <!-- <div id="preloader"></div> -->
    <!-- <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script> -->
    <script src="herobiz/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="herobiz/assets/vendor/aos/aos.js"></script>
    <script src="herobiz/assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="herobiz/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="herobiz/assets/vendor/swiper/swiper-bundle.min.js"></script>
    <!-- <script src="herobiz/assets/vendor/php-email-form/validate.js"></script> -->
    <script src="herobiz/assets/js/main.js"></script>
    <script async src='https://www.googletagmanager.com/gtag/js?id=G-P7JSYB1CSP'></script>
    <script>
        if (window.self == window.top) {
            window.dataLayer = window.dataLayer || [];

            function gtag() {
                dataLayer.push(arguments);
            }
            gtag('js', new Date());
            gtag('config', 'G-P7JSYB1CSP');
        }
    </script>
</body>

</html>