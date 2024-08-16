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
$name = $email = $phone = $address = $manager_name = '';
$pdv_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Préparation des données du formulaire
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $manager_name = $_POST['manager_name'];

    // Préparation de la requête SQL
    $stmt = $conn->prepare("UPDATE points_de_vente SET name = ?, email = ?, phone = ?, address = ?, manager_name = ? WHERE id = ?");
    $stmt->bind_param("sssssi", $name, $email, $phone, $address, $manager_name, $pdv_id);

    // Exécution de la requête SQL
    if ($stmt->execute()) {
        echo "<div class='alert alert-success'>Point de vente modifié avec succès !</div>";
    } else {
        echo "<div class='alert alert-danger'>Erreur lors de la modification du point de vente : " . $stmt->error . "</div>";
    }

    // Fermeture de la connexion
    $stmt->close();
}

// Récupération des informations du point de vente à modifier
if ($pdv_id > 0) {
    $stmt = $conn->prepare("SELECT name, email, phone, address, manager_name FROM points_de_vente WHERE id = ?");
    $stmt->bind_param("i", $pdv_id);
    $stmt->execute();
    $stmt->bind_result($name, $email, $phone, $address, $manager_name);
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
    <title>Modifier Point de Vente - Khallasli CRM</title>
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
                        <h3>Points de Vente</h3>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">Modifier un point de vente</div>
                                <div class="card-body">
                                    <form method="POST" action="edit_pdv.php?id=<?php echo $pdv_id; ?>">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Nom du point de vente</label>
                                            <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($name, ENT_QUOTES, 'UTF-8'); ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($email, ENT_QUOTES, 'UTF-8'); ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="phone" class="form-label">Téléphone</label>
                                            <input type="tel" class="form-control" id="phone" name="phone" value="<?php echo htmlspecialchars($phone, ENT_QUOTES, 'UTF-8'); ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="address" class="form-label">Adresse</label>
                                            <input type="text" class="form-control" id="address" name="address" value="<?php echo htmlspecialchars($address, ENT_QUOTES, 'UTF-8'); ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="manager_name" class="form-label">Nom du Responsable</label>
                                            <input type="text" class="form-control" id="manager_name" name="manager_name" value="<?php echo htmlspecialchars($manager_name, ENT_QUOTES, 'UTF-8'); ?>" required>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                                        <a href="CRUD_PDV.php" class="btn btn-secondary">Retour</a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/main.js"></script>
</body>

</html>

