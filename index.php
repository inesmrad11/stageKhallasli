<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil - Khallasli CRM</title>
    <link href="assets/vendor/fontawesome/css/fontawesome.min.css" rel="stylesheet">
    <link href="assets/vendor/fontawesome/css/solid.min.css" rel="stylesheet">
    <link href="assets/vendor/fontawesome/css/brands.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/master.css" rel="stylesheet">
    <link href="assets/vendor/flagiconcss/css/flag-icon.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.5.0/css/swiper.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="./assets/css/components.css">
    <link rel="stylesheet" href="./assets/css/index.css">
    <link rel="stylesheet" href="./assets/css/blocks.css">
    <link rel="stylesheet" href="./assets/css/text.css">
    <link rel="stylesheet" href="./assets/css/images.css">
    <link rel="stylesheet" href="./assets/css/loader.css">
    <link rel="stylesheet" href="./assets/css/swiper.css">
    <link rel="stylesheet" href="./assets/css/responsive.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Raleway:wght@900&display=swap">
    <link rel="stylesheet" href="css/admin.css"> <!-- Lien vers le fichier CSS personnalisé -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;900&family=Raleway:wght@900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;900&display=swap" rel="stylesheet">

    <style>
        .btn-link {
            font-family: 'poppins', sans-serif;
            font-weight: 900;
            font-size: 0.8rem;
            color: #1c2b4b;
        }
        .btn-link:hover {
            color: #93c021;
        }
        .btn-custom {
            background-color: #1c2b4b;
            color: white;
            font-weight: 700;
        }
        .btn-custom:hover {
            background-color: #93c021;
        }

        .navbar {
            transition: transform 0.3s ease-in-out, opacity 0.3s ease-in-out;
            position: fixed;
            width: 100%;
            top: 0;
            left: 0;
            z-index: 1000; /* Ensure it stays above other content */
        }

        .navbar.hidden {
            transform: translateY(-100%);
            opacity: 0;
        }
    </style>
</head>
<body>
<!--
<div class="loading-area">
            <div class="loader">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>
        <div x-data="setup()" x-init="$refs.loading.classList.add('hidden');">
            <div class=" h-screen antialiased text-gray-900 bg-gray-100 ">
                <div x-ref="loading" class="fixed inset-0 z-50 flex items-center justify-center text-2xl font-semibold text-black bg-blue-600"></div> !-->

        <header class="navbar navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <img src="photos/logo-new-khallasli-removebg-preview.png" alt="Khallasli-img" style="width: 225px; height: auto; ">
            </a>
            <nav class="ml-auto">
                <a href="https://www.khallasli.com/home.html#home" class="btn btn-link">Accueil</a>
                <a href="https://www.khallasli.com/home.html#solutions" class="btn btn-link">Nos services</a>
                <a href="https://www.khallasli.com/home.html#aboutus" class="btn btn-link">Qui Sommes-Nous ?</a>
                <a href="https://www.khallasli.com/home.html#canaux" class="btn btn-link">Nos canaux</a>
                <a href="https://www.khallasli.com/home.html#marketplace" class="btn btn-link">Marketplace</a>
                <a href="https://www.khallasli.com/contactez" class="btn btn-link">Contact</a>
                <a href="https://www.khallasli.com/blogs.html" class="btn btn-link">Blog</a>
                <a href="https://www.khallasli.com/guide" class="btn btn-link">Guides</a>
                <a href="login.php" class="btn btn-custom">Connexion</a>
            </nav>
        </div>
        </header>


    <div class="container text-center">
        <div class="row justify-content-center align-items-center" style="height: 120vh;">
            <div class="col-12 col-md-6">
                <h1 class="mb-4">Bienvenue sur Khallasli CRM</h1>
                <p class="mb-4">Pour accéder à l'application, veuillez vous connecter.</p>
                <a href="login.php" class="btn btn-custom">Connexion</a>
            </div>
            <div class="col-12 col-md-6">
                <img src="photos/3Dillustru.gif" alt="CRM Illustration" class="img-fluid">
            </div>
        </div>
    </div>
    <!-- Footer -->
    <footer class="footer">
        <div class="waves-container" >
            <img src="photos/bg footer-8.png" alt="waves" width="1350">
        </div>
        <div class="logo-container">
        <img src="photos/logo-new-khallasli-removebg-preview.png" alt="Khallasli-footer" width="350">
        </div>
        <div class="container">
            <div class="row">
            <div class="col-md-3">
            <h5>A PROPOS DE KHALLASLI</h5>
            <p>Tous vos paiements, à portée de main. <span class="khallasli">KHALLASLI</span> est la première plateforme de paiement tunisienne qui vous permet d'effectuer diverses transactions sécurisées instantanément.</p>
        </div>

            <div class="col-md-3">
                <h5>NOS SERVICES</h5>
                <ul class="list-unstyled">
                    <li><a href="#">Recharge Téléphonique</a></li>
                    <li><a href="#">Paiement De Facture</a></li>
                    <li><a href="#">Recharge Carte&solde</a></li>
                    <li><a href="#">Paiement e-commerce</a></li>
                </ul>
            </div>
            <div class="col-md-3">
                <h5>LIEN RAPIDE</h5>
                <ul class="list-unstyled">
                    <li><a href="https://www.khallasli.com/guide">Guide d’activation coupon</a></li>
                    <li><a href="https://www.khallasli.com/FAQ">FAQ</a></li>
                    <li><a href="https://www.khallasli.com/inscription">Rejoindre-nous</a></li>
                    <li><a href="https://www.khallasli.com/politique-de-confidentialit%C3%A9">Politique de confidentialité</a></li>
                </ul>
            </div>
            <div class="col-md-3">
                <h5>INFO</h5>
                <ul class="list-unstyled">
                    <li>+216 29 976 658</li>
                    <li>+216 29976658</li>
                    <li>+216 29976659</li>
                </ul>
                <div class="social-icons">
                    <a href="https://www.facebook.com/khallaslitunisia"><i class="fab fa-facebook-f"></i></a>
                    <a href="https://www.linkedin.com/company/khallasli/"><i class="fab fa-linkedin-in"></i></a>
                    <a href="https://x.com/khallasli?s=20"><i class="fab fa-twitter"></i></a>
                    <a href="https://www.youtube.com/@khallasli7857"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="copy">
                    <p>Copyright © KHALLASLI 2024®</p>
                </div>
            </div>
        </div>
    </div>
</footer>


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script>
    let lastScrollTop = 0; // Variable to hold the last scroll position

    window.addEventListener('scroll', function() {
        const navbar = document.querySelector('.navbar');
        const currentScrollTop = window.pageYOffset || document.documentElement.scrollTop;

        if (currentScrollTop > lastScrollTop) {
            // Scrolling down
            navbar.classList.add('hidden');
        } else {
            // Scrolling up
            navbar.classList.remove('hidden');
        }

        lastScrollTop = currentScrollTop <= 0 ? 0 : currentScrollTop; // For Mobile or negative scrolling
    });
    </script>

</body>
</html>
