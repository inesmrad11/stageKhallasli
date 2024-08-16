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

    // Préparation des données du formulaire
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $manager_name = $_POST['manager_name'];

    // Préparation de la requête SQL
    $stmt = $conn->prepare("INSERT INTO points_de_vente (name, email, phone, address, manager_name) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $name, $email, $phone, $address, $manager_name);

    // Exécution de la requête SQL
    if ($stmt->execute()) {
        echo "<div class='alert alert-success'>Point de vente ajouté avec succès !</div>";
    } else {
        echo "<div class='alert alert-danger'>Erreur lors de l'ajout du point de vente : " . $stmt->error . "</div>";
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
    <title>Ajouter Point de Vente - Khallasli CRM</title>
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
            <!-- Sidebar content -->
        </nav>
        <div id="body" class="active">
            <!-- Navbar content -->

            <div class="content">
                <div class="container">
                    <div class="page-title">
                        <h3>Points de Vente</h3>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">Ajouter un Point de Vente</div>
                                <div class="card-body">
                                    <h5 class="card-title">Veuillez remplir le formulaire d'ajout de point de vente</h5>
                                    <form class="needs-validation" novalidate accept-charset="utf-8" action="add_PDV.php" method="POST">
                                        <div class="row g-2">
                                            <!-- Nom du Point de Vente -->
                                            <div class="mb-3 col-md-12">
                                                <label for="name" class="form-label">Nom du Point de Vente</label>
                                                <input type="text" class="form-control" name="name" placeholder="Nom du Point de Vente" required>
                                                <small class="form-text text-muted">Nom du point de vente obligatoire.</small>
                                                <div class="valid-feedback">Nom du point de vente enregistré !</div>
                                                <div class="invalid-feedback">Nom du point de vente obligatoire !</div>
                                            </div>

                                            <!-- Adresse -->
                                            <div class="mb-3 col-md-6">
                                                <label for="address" class="form-label">Adresse</label>
                                                <input type="text" class="form-control" name="address" placeholder="123 Rue Principale, Ville, Pays" required>
                                                <small class="form-text text-muted">Adresse obligatoire.</small>
                                                <div class="valid-feedback">Adresse enregistrée !</div>
                                                <div class="invalid-feedback">Adresse obligatoire !</div>
                                            </div>

                                            <!-- Téléphone -->
                                            <div class="mb-3 col-md-6">
                                                <label for="phone" class="form-label">Téléphone</label>
                                                <input type="tel" class="form-control" name="phone" placeholder="+216" pattern="[0-9]{8}" title="Le numéro de téléphone doit contenir exactement 8 chiffres" required>
                                                <small class="form-text text-muted">Téléphone obligatoire.</small>
                                                <div class="valid-feedback">Téléphone valide !</div>
                                                <div class="invalid-feedback">Téléphone obligatoire !</div>
                                            </div>

                                            <!-- Email -->
                                            <div class="mb-3 col-md-6">
                                                <label for="email" class="form-label">Email</label>
                                                <input type="email" class="form-control" name="email" placeholder="exemple@domaine.com" required>
                                                <small class="form-text text-muted">Adresse email obligatoire.</small>
                                                <div class="valid-feedback">Adresse email valide !</div>
                                                <div class="invalid-feedback">Email obligatoire !</div>
                                            </div>

                                            <!-- Nom du Manager -->
                                            <div class="mb-3 col-md-6">
                                                <label for="manager_name" class="form-label">Nom du Manager</label>
                                                <input type="text" class="form-control" name="manager_name" placeholder="Nom du Manager" required>
                                                <small class="form-text text-muted">Nom du manager obligatoire.</small>
                                                <div class="valid-feedback">Nom du manager enregistré !</div>
                                                <div class="invalid-feedback">Nom du manager obligatoire !</div>
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
