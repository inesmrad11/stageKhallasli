<?php
session_start();
include "connexion.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];

    // Préparation de la requête SQL pour éviter les injections SQL
    $sql = "SELECT * FROM users WHERE email = ?";
    if ($stmt = $connect->prepare($sql)) {
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $ligne = $result->fetch_assoc();

            // Vérification du mot de passe
            if (password_verify($password, $ligne['password'])) {
                $_SESSION['email'] = $email;
                $_SESSION['username'] = $ligne['username']; // Utilisez 'username' pour le nom complet
                $_SESSION['role'] = $ligne['role']; // 'admin', 'manager', 'employee'

                // Redirection vers le dashboard approprié
                switch ($_SESSION['role']) {
                    case 'admin':
                        header('Location: admin_dash/index_admin.php');
                        break;
                    case 'manager':
                        header('Location: manager_dash/index_manager.php');
                        break;
                    case 'employee':
                        header('Location: employee_dash/index_employee.php');
                        break;
                    default:
                        $error = "Rôle non reconnu.";
                        break;
                }
                exit();
            } else {
                $error = "Email ou mot de passe incorrect.";
            }
        } else {
            $error = "Email ou mot de passe incorrect.";
        }

        $stmt->close();
    } else {
        $error = "Erreur de préparation de la requête.";
    }

    $connect->close();
}

if (isset($error)) {
    echo "<br><br><center><b><font color='red' size='4'>" . htmlspecialchars($error) . "</font></b></center>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil - Khallasli CRM</title>
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

        .form-container {
        margin-top: 200px; /* Ajustez cette valeur pour contrôler l'espacement par rapport au header */
        }
    </style>
</head>
<body>
<header class="navbar navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="login.php">
            <img src="photos/logo-new-khallasli-removebg-preview.png" alt="Khallasli-img" style="width: 225px; height: auto;">
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

<div class="container " style="margin-bottom: 60px;">
    <div class="form-container row">
        <div class="form-content col-md-6">
            <h2 style="font-weight: bold;">Connexion</h2>
            <?php if (isset($error)): ?>
                <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>
            <form action="login.php" method="post">
                <div class="form-group">
                    <label for="email">Email :</label>
                    <input type="email" name="email" id="email" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="password">Mot de passe :</label>
                    <input type="password" name="password" id="password" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-custom">Se connecter</button>
            </form>
        </div>
        <div class="illustration col-md-6">
            <img src="photos/web.png" alt="CRM Illustration" class="img-fluid">
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
