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

// Vérification des erreurs pour la récupération des utilisateurs
$user_query = "SELECT id, username FROM users";
$user_result = $conn->query($user_query);
if (!$user_result) {
    die("Erreur lors de la récupération des utilisateurs : " . $conn->error);
}

// Vérification des erreurs pour la récupération des points de vente
$point_de_vente_query = "SELECT id, name FROM points_de_vente";
$point_de_vente_result = $conn->query($point_de_vente_query);
if (!$point_de_vente_result) {
    die("Erreur lors de la récupération des points de vente : " . $conn->error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Préparation des données du formulaire
    $user_id = $_POST['user_id'];
    $point_de_vente_id = $_POST['point_de_vente_id'];
    $description = $_POST['description'];
    $status = $_POST['status'];
    $priority = $_POST['priority'];
    $assigned_to = $_POST['assigned_to'];
    $assigned_at = !empty($_POST['assigned_at']) ? $_POST['assigned_at'] : NULL;

    // Préparation de la requête SQL pour insérer une réclamation
    $stmt = $conn->prepare("INSERT INTO reclamations (user_id, point_de_vente_id, description, status, priority, assigned_to, assigned_at) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("iisssis", $user_id, $point_de_vente_id, $description, $status, $priority, $assigned_to, $assigned_at);

    // Exécution de la requête SQL
    if ($stmt->execute()) {
        echo "<div class='alert alert-success'>Réclamation ajoutée avec succès !</div>";
    } else {
        echo "<div class='alert alert-danger'>Erreur lors de l'ajout de la réclamation : " . $stmt->error . "</div>";
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
    <title>Dashboard Admin - Khallasli CRM</title>
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
                    <a href="CRUD_reclamations.php"><i class="fa-solid fa-triangle-exclamation"></i> Gestion Des Réclamations</a>
                </li>
                <li>
                    <a href="users.php"><i class="fa-solid fa-user-tie"></i> Gestion Du Personnel</a>
                </li>
                <li>
                    <a href="charts.php"><i class="fa-solid fa-chart-pie"></i> Graphes</a>
                </li>
                <li>
                    <a href="settings.php"><i class="fas fa-cog"></i> Paramètres</a>
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


<div class="container">
    <div class="page-title">
        <h3>Réclamations</h3>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">Ajouter une réclamation</div>
                <div class="card-body">
                    <h5 class="card-title">Veuillez remplir le formulaire d'ajout de réclamation</h5>
                    <form class="needs-validation" novalidate accept-charset="utf-8" action="add_reclamations.php" method="POST">
                        <div class="row g-2">
                            <!-- Utilisateur -->
                            <div class="mb-3 col-md-6">
                                <label for="user_id" class="form-label">Utilisateur</label>
                                <select name="user_id" id="user_id" class="form-select" required>
                                    <option value="" selected>Sélectionner un utilisateur</option>
                                    <?php while ($user = $user_result->fetch_assoc()) : ?>
                                        <option value="<?php echo $user['id']; ?>"><?php echo htmlspecialchars($user['username'], ENT_QUOTES, 'UTF-8'); ?></option>
                                    <?php endwhile; ?>
                                </select>
                                <div class="invalid-feedback">Utilisateur obligatoire !</div>
                            </div>

                            <!-- Point de vente -->
                            <div class="mb-3 col-md-6">
                                <label for="point_de_vente_id" class="form-label">Point de vente</label>
                                <select name="point_de_vente_id" id="point_de_vente_id" class="form-select" required>
                                    <option value="" selected>Sélectionner un point de vente</option>
                                    <?php while ($point_de_vente = $point_de_vente_result->fetch_assoc()) : ?>
                                        <option value="<?php echo $point_de_vente['id']; ?>"><?php echo htmlspecialchars($point_de_vente['name'], ENT_QUOTES, 'UTF-8'); ?></option>
                                    <?php endwhile; ?>
                                </select>
                                <div class="invalid-feedback">Point de vente obligatoire !</div>
                            </div>

                            <!-- Description -->
                            <div class="mb-3 col-md-12">
                                <label for="description" class="form-label">Description</label>
                                <textarea name="description" id="description" class="form-control" rows="4" required></textarea>
                                <div class="invalid-feedback">La description est obligatoire !</div>
                            </div>

                            <!-- Statut -->
                            <div class="mb-3 col-md-6">
                                <label for="status" class="form-label">Statut</label>
                                <select name="status" id="status" class="form-select" required>
                                    <option value="ouverte">Ouverte</option>
                                    <option value="en_cours">En cours</option>
                                    <option value="fermee">Fermée</option>
                                </select>
                                <div class="invalid-feedback">Statut obligatoire !</div>
                            </div>

                            <!-- Priorité -->
                            <div class="mb-3 col-md-6">
                                <label for="priority" class="form-label">Priorité</label>
                                <select name="priority" id="priority" class="form-select" required>
                                    <option value="basse">Basse</option>
                                    <option value="moyenne">Moyenne</option>
                                    <option value="haute">Haute</option>
                                </select>
                                <div class="invalid-feedback">Priorité obligatoire !</div>
                            </div>

                            <!-- Assigné à -->
                            <div class="mb-3 col-md-6">
                                <label for="assigned_to" class="form-label">Assigné à</label>
                                <select name="assigned_to" id="assigned_to" class="form-select" required>
                                    <option value="" selected>Sélectionner un utilisateur</option>
                                    <?php
                                    $user_result->data_seek(0); // Réinitialiser le résultat
                                    while ($user = $user_result->fetch_assoc()) : ?>
                                        <option value="<?php echo $user['id']; ?>"><?php echo htmlspecialchars($user['username'], ENT_QUOTES, 'UTF-8'); ?></option>
                                    <?php endwhile; ?>
                                </select>
                                <div class="invalid-feedback">Assigné à obligatoire !</div>
                            </div>

                            <!-- Date d'attribution -->
                            <div class="mb-3 col-md-6">
                                <label for="assigned_at" class="form-label">Date d'attribution</label>
                                <input type="date" name="assigned_at" id="assigned_at" class="form-control">
                            </div>
                        </div>
                        
                        <div class="mb-3 ">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Ajouter Réclamation</button>
                            <a href="CRUD_reclamations.php" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Retour</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="assets/vendor/jquery/jquery.min.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/form-validator.js"></script>
<script src="assets/js/script.js"></script>
<script>
    // Exemple de validation pour Bootstrap
    (function () {
        'use strict'
        var forms = document.querySelectorAll('.needs-validation')
        Array.prototype.slice.call(forms)
            .forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }
                    form.classList.add('was-validated')
                }, false)
            })
    })()
</script>

</body>

</html>