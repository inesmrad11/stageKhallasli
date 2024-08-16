<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Utilisateurs - Khallasli CRM</title>
    <link href="assets/vendor/fontawesome/css/fontawesome.min.css" rel="stylesheet">
    <link href="assets/vendor/fontawesome/css/solid.min.css" rel="stylesheet">
    <link href="assets/vendor/fontawesome/css/brands.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/datatables/datatables.min.css" rel="stylesheet">
    <link href="assets/css/master.css" rel="stylesheet">
</head>

<body>
    <div class="wrapper">
        <nav id="sidebar" class="active">
            <div class="sidebar-header">
                <img src="assets/img/logo_nobg.png" alt="bootraper logo" class="app-logo">
            </div>
            <ul class="list-unstyled components text-secondary">
                <li>
                    <a href="CRUD_prospects.html"><i class="fa-solid fa-users"></i> Gestion De Prospects</a>
                </li>
                <li>
                    <a href="CRUD_PDV.html"><i class="fa-solid fa-shop"></i> Gestion Des Points De Vente</a>
                </li>
                <li>
                    <a href="CRUD_RDV.html"><i class="fa-solid fa-calendar-check"></i> Gestion Des Rendez-vous</a>
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
                                        <li><a href="index.html" class="dropdown-item"><i class="fa-solid fa-house"></i> Tableau de Bord</a></li>
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
                                            echo isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : 'Invité';
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
                        <h3>Utilisateurs
                            <a href="roles.html" class="btn btn-sm btn-outline-secondary float-end"><i class="fas fa-user-shield"></i> Roles</a>
                        </h3>
                    </div>
                    <div class="box box-primary">
                        <div class="box-body">
                            <table width="100%" class="table table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>identifiant</th>
                                        <th>nom</th>
                                        <th>e-mail</th>
                                        <th>role</th>
                                        <th>date de création</th>
                                        <th>date de mise à jour</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>admin_tunis</td>
                                        <td>admin.tunis@example.com</td>
                                        <td>admin</td>
                                        <td>2024-08-06 12:55:28</td>
                                        <td>2024-08-06 13:39:29</td>
                                        <td class="text-end">
                                            <a href="" class="btn btn-outline-primary btn-rounded"><i class="fas fa-pen"></i></a>
                                            <a href="" class="btn btn-outline-danger btn-rounded"><i class="fas fa-trash"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>manager_tunis</td>
                                        <td>manager.tunis@example.com</td>
                                        <td>manager</td>
                                        <td>2024-08-06 12:55:28</td>
                                        <td>2024-08-06 13:38:41</td>
                                        <td class="text-end">
                                            <a href="" class="btn btn-outline-primary btn-rounded"><i class="fas fa-pen"></i></a>
                                            <a href="" class="btn btn-outline-danger btn-rounded"><i class="fas fa-trash"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>employe_sousse</td>
                                        <td>employe.sousse@example.com</td>
                                        <td>employee</td>
                                        <td>2024-08-06 12:55:28</td>
                                        <td>2024-08-06 13:38:08</td>
                                        <td class="text-end">
                                            <a href="" class="btn btn-outline-primary btn-rounded"><i class="fas fa-pen"></i></a>
                                            <a href="" class="btn btn-outline-danger btn-rounded"><i class="fas fa-trash"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>employe_nabeul</td>
                                        <td>employe.nabeul@example.com</td>
                                        <td>employee</td>
                                        <td>2024-08-06 12:55:28</td>
                                        <td>2024-08-06 13:37:32</td>
                                        <td class="text-end">
                                            <a href="" class="btn btn-outline-primary btn-rounded"><i class="fas fa-pen"></i></a>
                                            <a href="" class="btn btn-outline-danger btn-rounded"><i class="fas fa-trash"></i></a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/datatables/datatables.min.js"></script>
    <script src="assets/js/initiate-datatables.js"></script>
    <script src="assets/js/script.js"></script>
</body>

</html>