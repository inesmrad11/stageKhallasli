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
$servername = "localhost"; // Remplacez par votre serveur de base de données
$username = "root";        // Remplacez par votre nom d'utilisateur de base de données
$password = "";            // Remplacez par votre mot de passe de base de données
$dbname = "khallasli_crm"; // Remplacez par le nom de votre base de données

// Création de la connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérification de la connexion
if ($conn->connect_error) {
    die("Échec de la connexion : " . $conn->connect_error);
}

// Vérifier si l'ID du rendez-vous est passé dans l'URL
if (!isset($_GET['id'])) {
    die("ID du rendez-vous non spécifié.");
}

$rendez_vous_id = intval($_GET['id']);

// Récupérer les détails du rendez-vous existant
$sql = "SELECT * FROM rendez_vous WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $rendez_vous_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Rendez-vous introuvable.");
}

$rendez_vous = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Préparation des données du formulaire
    $prospect_id = $conn->real_escape_string($_POST['prospect_id']);
    $point_de_vente_id = $conn->real_escape_string($_POST['point_de_vente_id']);
    $date_time = $conn->real_escape_string($_POST['date_time']);
    $status = $conn->real_escape_string($_POST['status']);
    $notes = $conn->real_escape_string($_POST['notes']);

    // Préparation de la requête SQL de mise à jour
    $update_sql = "UPDATE rendez_vous SET prospect_id = ?, point_de_vente_id = ?, date_time = ?, status = ?, notes = ? WHERE id = ?";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param("iisssi", $prospect_id, $point_de_vente_id, $date_time, $status, $notes, $rendez_vous_id);

    // Exécution de la requête SQL de mise à jour
    if ($update_stmt->execute()) {
        echo "<div class='alert alert-success'>Rendez-vous modifié avec succès !</div>";
    } else {
        echo "<div class='alert alert-danger'>Erreur lors de la modification du rendez-vous : " . $update_stmt->error . "</div>";
    }

    $update_stmt->close();
}
?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Modifier Rendez-vous - Khallasli CRM</title>
    <link href="assets/vendor/fontawesome/css/fontawesome.min.css" rel="stylesheet">
    <link href="assets/vendor/fontawesome/css/solid.min.css" rel="stylesheet">
    <link href="assets/vendor/fontawesome/css/brands.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/master.css" rel="stylesheet">
    <link href="assets/vendor/flagiconcss/css/flag-icon.min.css" rel="stylesheet">
    <link href="assets/vendor/datepicker/css/datepicker.min.css" rel="stylesheet">
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
                                        <li><a href="index_admin.php" class="dropdown-item"><i class="fa-solid fa-house"></i> Tableau de Bord</a></li>
                                        <div class="dropdown-divider"></div>
                                        <li><a href="https://www.khallasli.com/home.html#marketplace" class="dropdown-item"><i class="fa-solid fa-store"></i> Marketplace</a></li>
                                        <div class="dropdown-divider"></div>
                                        <li><a href="https://www.khallasli.com/home.html#home" class="dropdown-item"><i class="fa-solid fa-hand-holding-dollar"></i> Khallasli</a></li>
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

            <div class="content">
                <div class="container">
                    <h2>Modifier Rendez-vous</h2>
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <div class="card mt-3">
                                <div class="card-body">
                                    <h5 class="card-title text-center">Détails du Rendez-vous</h5>
                                    <form method="POST" action="">
                                        <div class="mb-3">
                                            <label for="prospect_id" class="form-label">Prospect</label>
                                            <select name="prospect_id" id="prospect_id" class="form-control" required>
                                                <?php
                                                // Récupérer la liste des prospects
                                                $prospects_sql = "SELECT id, name FROM prospects";
                                                $prospects_result = $conn->query($prospects_sql);

                                                while ($prospect = $prospects_result->fetch_assoc()) {
                                                    $selected = ($prospect['id'] === $rendez_vous['prospect_id']) ? 'selected' : '';
                                                    echo "<option value='{$prospect['id']}' $selected>{$prospect['name']}</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label for="point_de_vente_id" class="form-label">Point de Vente</label>
                                            <select name="point_de_vente_id" id="point_de_vente_id" class="form-control" required>
                                                <?php
                                                // Récupérer la liste des points de vente
                                                $points_de_vente_sql = "SELECT id, name FROM points_de_vente";
                                                $points_de_vente_result = $conn->query($points_de_vente_sql);

                                                while ($point_de_vente = $points_de_vente_result->fetch_assoc()) {
                                                    $selected = ($point_de_vente['id'] === $rendez_vous['point_de_vente_id']) ? 'selected' : '';
                                                    echo "<option value='{$point_de_vente['id']}' $selected>{$point_de_vente['name']}</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label for="date_time" class="form-label">Date et Heure</label>
                                            <input type="datetime-local" class="form-control" id="date_time" name="date_time" value="<?php echo date('Y-m-d\TH:i', strtotime($rendez_vous['date_time'])); ?>" required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="status" class="form-label">Statut</label>
                                            <select name="status" id="status" class="form-control" required>
                                                <option value="prévu" <?php if ($rendez_vous['status'] === 'prévu') echo 'selected'; ?>>Prévu</option>
                                                <option value="terminé" <?php if ($rendez_vous['status'] === 'terminé') echo 'selected'; ?>>Terminé</option>
                                                <option value="annulé" <?php if ($rendez_vous['status'] === 'annulé') echo 'selected'; ?>>Annulé</option>
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label for="notes" class="form-label">Notes</label>
                                            <textarea class="form-control" id="notes" name="notes" rows="3"><?php echo htmlspecialchars($rendez_vous['notes'], ENT_QUOTES, 'UTF-8'); ?></textarea>
                                        </div>

                                        <button type="submit" class="btn btn-primary">Modifier</button>
                                        <a href="CRUD_RDV.php" class="btn btn-secondary">Annuler</a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <footer class="bg-white text-center text-black-50 py-3 shadow">
                <p class="mb-0">Khallasli | Tous droits réservés</p>
            </footer>
        </div>
    </div>

    <!-- Scripts -->
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/datepicker/js/bootstrap-datepicker.min.js"></script>
    <script src="assets/js/script.js"></script>
</body>
</html>
<?php
$conn->close();
?>
