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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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

    // Préparation des données du formulaire
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];
    $address = $_POST['address'];
    $status = $_POST['status'];

    // Préparation de la requête SQL
    $stmt = $conn->prepare("INSERT INTO prospects (name, email, phone, address, status) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $nom, $email, $telephone, $address, $status);

    // Exécution de la requête SQL
    if ($stmt->execute()) {
        echo "<div class='alert alert-success'>Prospect ajouté avec succès !</div>";
    } else {
        echo "<div class='alert alert-danger'>Erreur lors de l'ajout du prospect : " . $stmt->error . "</div>";
    }

    // Fermeture de la connexion
    $stmt->close();
    $conn->close();
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Ajouter Prospect - Khallasli CRM</title>
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
                                        <li><a href="idex_admin.php" class="dropdown-item"><i class="fa-solid fa-house"></i> Tableau de Bord</a></li>
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
            <!-- end of navbar navigation -->

            <div class="content">
    <div class="container">
        <div class="page-title">
            <h3>Prospects</h3>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">Ajouter un prospect</div>
                    <div class="card-body">
                        <h5 class="card-title">Veuillez remplir le formulaire d'ajout de prospect</h5>
                        <form class="needs-validation" novalidate accept-charset="utf-8" action="add_prospect.php" method="POST">
                            <div class="row g-2">
    <!-- Nom Complet -->
    <div class="mb-3 col-md-12">
        <label for="nom" class="form-label">Nom Complet</label>
        <input type="text" class="form-control" name="nom" placeholder="Prénom Nom" pattern="[A-Za-z ]+" title="Le nom ne doit contenir que des lettres et des espaces" required>
        <small class="form-text text-muted">Nom complet obligatoire.</small>
        <div class="valid-feedback">Votre nom complet est bien enregistré !</div>
        <div class="invalid-feedback">Nom complet obligatoire !</div>
    </div>

    <!-- Email et Téléphone -->
    <div class="mb-3 col-md-6">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" name="email" placeholder="exemple@domaine.com" required>
        <small class="form-text text-muted">Adresse email obligatoire.</small>
        <div class="valid-feedback">Adresse email valide !</div>
        <div class="invalid-feedback">Email obligatoire !</div>
    </div>

    <div class="mb-3 col-md-6">
        <label for="telephone" class="form-label">Téléphone</label>
        <input type="tel" class="form-control" name="telephone" placeholder="+216" pattern="[0-9]{8}" title="Le numéro de téléphone doit contenir exactement 8 chiffres" required>
        <div class="valid-feedback">Numéro de téléphone valide !</div>
        <small class="form-text text-muted">Téléphone obligatoire.</small>
        <div class="invalid-feedback">Téléphone obligatoire !</div>
    </div>

                                <!-- Ville et Adresse -->
<!-- Ville -->
<div class="mb-3 col-md-6">
    <label for="city" class="form-label">Ville</label>
    <select name="city" class="form-select">
        <option value="" selected>Choisissez...</option>
        <option value="ariana">Ariana</option>
        <option value="beja">Béja</option>
        <option value="ben_arous">Ben Arous</option>
        <option value="bizerte">Bizerte</option>
        <option value="el_kef">El Kef</option>
        <option value="gabes">Gabès</option>
        <option value="gafsa">Gafsa</option>
        <option value="jendouba">Jendouba</option>
        <option value="kairouan">Kairouan</option>
        <option value="kasserine">Kasserine</option>
        <option value="kebili">Kébili</option>
        <option value="mahdia">Mahdia</option>
        <option value="manouba">Manouba</option>
        <option value="medenine">Médenine</option>
        <option value="monastir">Monastir</option>
        <option value="nabeul">Nabeul</option>
        <option value="sfax">Sfax</option>
        <option value="sidi_bouzid">Sidi Bouzid</option>
        <option value="siliana">Siliana</option>
        <option value="sousse">Sousse</option>
        <option value="tataouine">Tataouine</option>
        <option value="tozeur">Tozeur</option>
        <option value="tunis">Tunis</option>
        <option value="zaghouan">Zaghouan</option>
    </select>
    <small class="form-text text-muted">La ville est facultative.</small>
</div>


                                <div class="mb-3 col-md-6">
                                    <label for="address" class="form-label">Adresse</label>
                                    <input type="text" class="form-control" name="address" placeholder="123 Rue Principale, Ville, Pays" required>
                                    <small class="form-text text-muted">Adresse obligatoire.</small>
                                    <div class="valid-feedback">Adresse enregistrée !</div>
                                    <div class="invalid-feedback">Adresse obligatoire !</div>
                                </div>

                                <!-- Statut du Prospect -->
                                <div class="mb-3 col-md-12">
                                    <label for="status" class="form-label">Statut du Prospect</label>
                                    <input type="text" class="form-control" name="status" placeholder="Contacté, Intéressé, Non contacté, En attente..." required>
                                    <small class="form-text text-muted">Statut obligatoire.</small>
                                    <div class="valid-feedback">Statut enregistré !</div>
                                    <div class="invalid-feedback">Veuillez entrer le statut du prospect.</div>
                                </div>

                                <!-- Registre de Commerce et Nom de la Boutique -->
                                <div class="mb-3 col-md-6">
                                    <label for="commerce_registry" class="form-label">Registre de Commerce</label>
                                    <input type="text" class="form-control" name="commerce_registry">
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="shop_name" class="form-label">Nom de la Boutique</label>
                                    <input type="text" class="form-control" name="shop_name">
                                </div>
                            </div>

                                <!-- secteur d'activité du Prospect -->
                                <div class="mb-3 col-md-12">
                                    <label for="sector" class="form-label">Secteur d'activité</label>
                                    <input type="text" class="form-control" name="sector">
                                </div>

                            <!-- Plateformes Utilisées -->
                            <div class="mb-3">
                                <label class="form-label">Utilisation de la plateforme :</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" value="borne" id="borne">
                                    <label class="form-check-label" for="borne">Borne</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" value="computer" id="computer">
                                    <label class="form-check-label" for="computer">Ordinateur</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" value="tpe" id="tpe">
                                    <label class="form-check-label" for="tpe">TPE</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" value="mobile" id="mobile">
                                    <label class="form-check-label" for="mobile">Mobile</label>
                                </div>
                            </div>

                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Enregistrer</button>
                                <a href="javascript:history.back()" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Retour</a>
                            </div>
                        </form>
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