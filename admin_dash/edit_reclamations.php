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

$servername = "localhost"; // Remplacez par votre serveur de base de données
$username = "root";        // Remplacez par votre nom d'utilisateur de base de données
$password = "";            // Remplacez par votre mot de passe de base de données
$dbname = "khallasli_crm"; // Remplacez par le nom de votre base de données

// Connexion à la base de données
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérification de la connexion
if ($conn->connect_error) {
    die("Échec de la connexion : " . $conn->connect_error);
}

// Récupération de l'ID de la réclamation depuis l'URL
$reclamation_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Récupération des données de la réclamation
$stmt = $conn->prepare("SELECT * FROM reclamations WHERE id = ?");
$stmt->bind_param("i", $reclamation_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Réclamation non trouvée.");
}

$reclamation = $result->fetch_assoc();

// Préparation des données pour le formulaire
$user_id = $reclamation['user_id'];
$point_de_vente_id = $reclamation['point_de_vente_id'];
$description = $reclamation['description'];
$status = $reclamation['status'];
$priority = $reclamation['priority'];
$assigned_to = $reclamation['assigned_to'];
$assigned_at = $reclamation['assigned_at'];

// Récupération des utilisateurs et points de vente pour les listes déroulantes
$user_query = "SELECT id, username FROM users";
$user_result = $conn->query($user_query);

$point_de_vente_query = "SELECT id, name FROM points_de_vente";
$point_de_vente_result = $conn->query($point_de_vente_query);

// Traitement du formulaire si soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Préparation des données du formulaire
    $user_id = $_POST['user_id'];
    $point_de_vente_id = $_POST['point_de_vente_id'];
    $description = $_POST['description'];
    $status = $_POST['status'];
    $priority = $_POST['priority'];
    $assigned_to = $_POST['assigned_to'];
    $assigned_at = !empty($_POST['assigned_at']) ? $_POST['assigned_at'] : NULL;

    // Préparation de la requête SQL pour mettre à jour la réclamation
    $stmt = $conn->prepare("UPDATE reclamations SET user_id = ?, point_de_vente_id = ?, description = ?, status = ?, priority = ?, assigned_to = ?, assigned_at = ? WHERE id = ?");
    $stmt->bind_param("iisssisi", $user_id, $point_de_vente_id, $description, $status, $priority, $assigned_to, $assigned_at, $reclamation_id);

    // Exécution de la requête SQL
    if ($stmt->execute()) {
        echo "<div class='alert alert-success'>Réclamation modifiée avec succès !</div>";
    } else {
        echo "<div class='alert alert-danger'>Erreur lors de la modification de la réclamation : " . $stmt->error . "</div>";
    }

    // Fermeture de la connexion
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
    <title>Modifier Réclamation - Khallasli CRM</title>
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
                <li><a href="CRUD_prospects.php"><i class="fa-solid fa-users"></i> Gestion De Prospects</a></li>
                <li><a href="CRUD_PDV.php"><i class="fa-solid fa-shop"></i> Gestion Des Points De Vente</a></li>
                <li><a href="CRUD_RDV.php"><i class="fa-solid fa-calendar-check"></i> Gestion Des Rendez-vous</a></li>
                <li><a href="CRUD_reclamations.php"><i class="fa-solid fa-triangle-exclamation"></i> Gestion Des Réclamations</a></li>
                <li><a href="users.php"><i class="fa-solid fa-user-tie"></i> Gestion Du Personnel</a></li>
                <li><a href="charts.php"><i class="fa-solid fa-chart-pie"></i> Graphes</a></li>
                <li><a href="settings.php"><i class="fas fa-cog"></i> Paramètres</a></li>
                <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Déconnexion</a></li>
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
                                        <li><a href="" class="dropdown-item"><i class="fa-solid fa-user"></i> Profil</a></li>
                                        <div class="dropdown-divider"></div>
                                        <li><a href="logout.php" class="dropdown-item"><i class="fa-solid fa-sign-out-alt"></i> Déconnexion</a></li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
            <!-- navbar navigation component end -->

    <div class="container">
        <div class="page-title">
            <h3>Réclamations</h3>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Modifier cette réclamation</div>
                    <div class="card-body">
                        <h5 class="">Veuillez remplir le formulaire de modification de la réclamation</h5>
                            <form action="edit_reclamations.php?id=<?php echo $reclamation_id; ?>" method="POST">
                                <div class="row g-2">
                                            
                                            <div class="mb-3 col-md-6">
                                                    <label for="user_id">Utilisateur</label>
                                                    <select id="user_id" name="user_id" class="form-control">
                                                        <?php while ($user = $user_result->fetch_assoc()) { ?>
                                                            <option value="<?php echo $user['id']; ?>" <?php echo ($user['id'] == $user_id) ? 'selected' : ''; ?>>
                                                                <?php echo htmlspecialchars($user['username'], ENT_QUOTES, 'UTF-8'); ?>
                                                            </option>
                                                        <?php } ?>
                                                    </select>
                                            </div>

                                            <div class="col-md-6">
                                                    <label for="point_de_vente_id">Point de Vente</label>
                                                    <select id="point_de_vente_id" name="point_de_vente_id" class="form-control">
                                                        <?php while ($point = $point_de_vente_result->fetch_assoc()) { ?>
                                                            <option value="<?php echo $point['id']; ?>" <?php echo ($point['id'] == $point_de_vente_id) ? 'selected' : ''; ?>>
                                                                <?php echo htmlspecialchars($point['name'], ENT_QUOTES, 'UTF-8'); ?>
                                                            </option>
                                                        <?php } ?>
                                                    </select>
                                            </div>

                                            <div class="mb-3 col-md-12">
                                                    <label for="description">Description</label>
                                                    <textarea id="description" name="description" class="form-control" rows="4"><?php echo htmlspecialchars($description, ENT_QUOTES, 'UTF-8'); ?></textarea>
                                            </div>

                                            <div class="mb-3 col-md-6">
                                                    <label for="status">Statut</label>
                                                    <select id="status" name="status" class="form-control">
                                                        <option value="en attente" <?php echo ($status == 'en attente') ? 'selected' : ''; ?>>En attente</option>
                                                        <option value="en cours" <?php echo ($status == 'en cours') ? 'selected' : ''; ?>>En cours</option>
                                                        <option value="résolu" <?php echo ($status == 'résolu') ? 'selected' : ''; ?>>Résolu</option>
                                                    </select>
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                    <label for="priority">Priorité</label>
                                                    <select id="priority" name="priority" class="form-control">
                                                        <option value="faible" <?php echo ($priority == 'faible') ? 'selected' : ''; ?>>Faible</option>
                                                        <option value="moyenne" <?php echo ($priority == 'moyenne') ? 'selected' : ''; ?>>Moyenne</option>
                                                        <option value="élevée" <?php echo ($priority == 'élevée') ? 'selected' : ''; ?>>Élevée</option>
                                                    </select>
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                    <label for="assigned_to">Assigné à</label>
                                                    <select id="assigned_to" name="assigned_to" class="form-control">
                                                        <?php
                                                            // Réinitialiser le résultat pour réutiliser
                                                            $user_result->data_seek(0);
                                                            while ($user = $user_result->fetch_assoc()) { ?>
                                                            <option value="<?php echo $user['id']; ?>" <?php echo ($user['id'] == $assigned_to) ? 'selected' : ''; ?>>
                                                                <?php echo htmlspecialchars($user['username'], ENT_QUOTES, 'UTF-8'); ?>
                                                            </option>
                                                        <?php } ?>
                                                    </select>
                                            </div>

                                            <!-- Date d'attribution -->
                                            <div class="mb-3 col-md-6">
                                                    <label for="assigned_at">Date d'Assignation</label>
                                                    <input type="date" id="assigned_at" name="assigned_at" class="form-control" value="<?php echo ($assigned_at) ? date('Y-m-d', strtotime($assigned_at)) : ''; ?>">
                                            </div>
                                        </div>

                                        <div class="mb-3 ">
                                            <button type="submit" class="btn btn-primary">Enregistrer</button>
                                            <a href="CRUD_reclamations.php" class="btn btn-secondary">Retour</a>
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
    <script src="assets/vendor/datepicker/js/bootstrap-datepicker.min.js"></script>
    <script src="assets/js/script.js"></script>
</body>

</html>
