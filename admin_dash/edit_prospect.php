<?php
session_start();
if (!isset($_SESSION['email'])) {
    header('Location: login.php');
    exit();
}

if ($_SESSION['role'] !== 'admin') {
    header('Location: unauthorized.php');
    exit();
}

// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "khallasli_crm";

// Création de la connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérification de la connexion
if ($conn->connect_error) {
    die("Échec de la connexion : " . $conn->connect_error);
}

// Initialisation des variables pour le formulaire
$nom = $email = $telephone = $address = $status = '';
$prospect_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Préparation des données du formulaire
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];
    $address = $_POST['address'];
    $status = $_POST['status'];

    // Préparation de la requête SQL
    $stmt = $conn->prepare("UPDATE prospects SET name = ?, email = ?, phone = ?, address = ?, status = ? WHERE id = ?");
    $stmt->bind_param("sssssi", $nom, $email, $telephone, $address, $status, $prospect_id);

    // Exécution de la requête SQL
    if ($stmt->execute()) {
        echo "<div class='alert alert-success'>Prospect modifié avec succès !</div>";
    } else {
        echo "<div class='alert alert-danger'>Erreur lors de la modification du prospect : " . $stmt->error . "</div>";
    }

    // Fermeture de la connexion
    $stmt->close();
}

// Récupération des informations du prospect à modifier
if ($prospect_id > 0) {
    $stmt = $conn->prepare("SELECT name, email, phone, address, status FROM prospects WHERE id = ?");
    $stmt->bind_param("i", $prospect_id);
    $stmt->execute();
    $stmt->bind_result($nom, $email, $telephone, $address, $status);
    $stmt->fetch();
    $stmt->close();
}

$conn->close();
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Modifier Prospect - Khallasli CRM</title>
    <link href="assets/vendor/fontawesome/css/fontawesome.min.css" rel="stylesheet">
    <link href="assets/vendor/fontawesome/css/solid.min.css" rel="stylesheet">
    <link href="assets/vendor/fontawesome/css/brands.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/master.css" rel="stylesheet">
    <link href="assets/vendor/flagiconcss/css/flag-icon.min.css" rel="stylesheet">
</head>

<body>
    <div class="wrapper">
        <nav id="sidebar" class="active">
            <div class="sidebar-header">
                <img src="assets/img/logo_nobg.png" alt="bootraper logo" class="app-logo">
            </div>
            <ul class="list-unstyled components text-secondary">
                <li>
                    <a href="CRUD_prospects.php"><i class="fa-solid fa-users"></i> Gestion De Prospects</a>
                </li>
                <li>
                    <a href="CRUD_PDV.php"><i class="fa-solid fa-shop"></i> Gestion Des Points De Vente</a>
                </li>
                <li>
                    <a href="CRUD_RDV.php"><i class="fa-solid fa-calendar-check"></i> Gestion Des Rendez-vous</a>
                </li>
                <li>
                    <a href="CRUD_reclamations.html"><i class="fa-solid fa-triangle-exclamation"></i> Gestion Des Réclamations</a>
                </li>
                <li>
                    <a href="users.html"><i class="fa-solid fa-user-tie"></i> Gestion Du Personnel</a>
                </li>
                <li>
                    <a href="charts.html"><i class="fa-solid fa-chart-pie"></i> Graphes</a>
                </li>
                <li>
                    <a href="settings.html"><i class="fas fa-cog"></i> Paramètres</a>
                </li>
                <li>
                    <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Déconnexion</a>
                </li>
            </ul>
        </nav>
        <div id="body" class="active">
            <!-- navbar navigation component -->
            <nav class="navbar navbar-expand-lg navbar-white bg-white">
                <button type="button" id="sidebarCollapse" class="btn btn-light">
                    <i class="fas fa-bars"></i><span></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="nav navbar-nav ms-auto">
                        <li class="nav-item dropdown">
                            <div class="nav-dropdown">
                                <a href="#" id="nav1" class="nav-item nav-link dropdown-toggle text-secondary" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-link"></i> <span>Liens</span> <i style="font-size: .8em;" class="fas fa-caret-down"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end nav-link-menu" aria-labelledby="nav1">
                                    <ul class="nav-list">
                                        <li><a href="#" class="dropdown-item"><i class="fa-solid fa-house"></i> Tableau de Bord</a></li>
                                        <div class="dropdown-divider"></div>
                                        <li><a href="https://www.khallasli.com/home.html#marketplace" class="dropdown-item"><i class="fa-solid fa-store"></i> Marketplace</a></li>
                                        <div class="dropdown-divider"></div>
                                        <li><a href="https://www.khallasli.com/home.html#home" class="dropdown-item"><i class="fa-solid fa-hand-holding-dollar"></i> Khallasli</i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <div class="nav-dropdown">
                                <a href="#" id="nav2" class="nav-item nav-link dropdown-toggle text-secondary" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-user"></i> 
                                    <span>
                                        <?php 
                                            if (isset($_SESSION['username'])) {
                                                $username = htmlspecialchars($_SESSION['username'], ENT_QUOTES, 'UTF-8');
                                                echo $username;
                                            } else {
                                                echo 'Invité';
                                            }
                                        ?>
                                    </span>
                                    <i style="font-size: .8em;" class="fas fa-caret-down"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end nav-link-menu">
                                    <ul class="nav-list">
                                        <li><a href="" class="dropdown-item"><i class="fas fa-address-card"></i> Profil</a></li>
                                        <li><a href="" class="dropdown-item"><i class="fas fa-envelope"></i> Messages</a></li>
                                        <li><a href="" class="dropdown-item"><i class="fas fa-cog"></i> Paramètres</a></li>
                                        <div class="dropdown-divider"></div>
                                        <li><a href="logout.php" class="dropdown-item"><i class="fas fa-sign-out-alt"></i> Déconnexion</a></li>
                                    </ul>
                                </div>
                            </div>
                        </li>                        
                    </ul>
                </div>
            </nav>
            <!-- end of navbar navigation -->

            <div class="content">
                <div class="container">
                    <div class="page-title">
                        <h3>Prospects</h3>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">Modifier un prospect</div>
                                <div class="card-body">
                                    <h5 class="card-title">Veuillez remplir le formulaire de modification du prospect</h5>
                                    <form class="needs-validation" novalidate accept-charset="utf-8" action="edit_prospect.php?id=<?php echo htmlspecialchars($prospect_id, ENT_QUOTES, 'UTF-8'); ?>" method="POST">
                                        <div class="row g-2">
                                            <!-- Nom Complet -->
                                            <div class="mb-3 col-md-12">
                                                <label for="nom" class="form-label">Nom Complet</label>
                                                <input type="text" class="form-control" id="nom" name="nom" value="<?php echo htmlspecialchars($nom, ENT_QUOTES, 'UTF-8'); ?>" required>
                                            </div>

                                            <!-- Email -->
                                            <div class="mb-3 col-md-6">
                                                <label for="email" class="form-label">Email</label>
                                                <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($email, ENT_QUOTES, 'UTF-8'); ?>" required>
                                            </div>

                                            <!-- Téléphone -->
                                            <div class="mb-3 col-md-6">
                                                <label for="telephone" class="form-label">Téléphone</label>
                                                <input type="text" class="form-control" id="telephone" name="telephone" value="<?php echo htmlspecialchars($telephone, ENT_QUOTES, 'UTF-8'); ?>" pattern="\d{8}" required>
                                            </div>

                                            <!-- Adresse -->
                                            <div class="mb-3 col-md-12">
                                                <label for="address" class="form-label">Adresse</label>
                                                <input type="text" class="form-control" id="address" name="address" value="<?php echo htmlspecialchars($address, ENT_QUOTES, 'UTF-8'); ?>">
                                            </div>

                                            <!-- Statut -->
                                            <div class="mb-3 col-md-12">
                                                <label for="status" class="form-label">Statut</label>
                                                <input type="text" class="form-control" id="status" name="status" value="<?php echo htmlspecialchars($status, ENT_QUOTES, 'UTF-8'); ?>" required>
                                            </div>

                                            <!-- Boutons -->
                                            <div class="mb-3 col-md-12">
                                                <button type="submit" class="btn btn-primary">Modifier</button>
                                                <a href="CRUD_prospects.php" class="btn btn-secondary">Retour</a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/form-validator.js"></script>
    <script src="assets/js/script.js"></script>
</body>
</html>