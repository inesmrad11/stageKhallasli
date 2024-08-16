-- Création de la base de données (ajustez le nom si nécessaire)
CREATE DATABASE IF NOT EXISTS crm_db;
USE crm_db;

-- Table users avec le rôle de manager
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    role ENUM('admin', 'manager', 'employee') NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Table prospects
CREATE TABLE prospects (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    phone VARCHAR(20),
    address VARCHAR(255),
    birth_date DATE,
    occupation VARCHAR(100),
    source VARCHAR(100),
    creation_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    notes TEXT,
    status ENUM('nouveau', 'contacté', 'en_cours', 'fermé') NOT NULL
);

CREATE TABLE prospects (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    status ENUM('nouveau', 'contacté', 'en_cours', 'fermé') NOT NULL
);

INSERT INTO prospects (first_name, last_name, email, status)
VALUES ('Ahmed', 'Ben Ali', 'ahmed.benali@example.com', 'contacté');


-- Table points_de_vente
CREATE TABLE points_de_vente (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    address VARCHAR(255),
    phone VARCHAR(15),
    email VARCHAR(100) UNIQUE,
    manager_name VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Table rendez_vous
CREATE TABLE rendez_vous (
    id INT AUTO_INCREMENT PRIMARY KEY,
    prospect_id INT,
    point_de_vente_id INT,
    date_time DATETIME NOT NULL,
    status ENUM('prévu', 'terminé', 'annulé') DEFAULT 'prévu',
    notes TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (prospect_id) REFERENCES prospects(id) ON DELETE SET NULL,
    FOREIGN KEY (point_de_vente_id) REFERENCES points_de_vente(id) ON DELETE SET NULL
);

-- Table reclamations
CREATE TABLE reclamations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    point_de_vente_id INT,
    description TEXT NOT NULL,
    status ENUM('ouvert', 'en_cours', 'fermé') DEFAULT 'ouvert',
    priority ENUM('basse', 'moyenne', 'haute') DEFAULT 'moyenne',
    assigned_to INT NULL,
    assigned_at TIMESTAMP NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL,
    FOREIGN KEY (point_de_vente_id) REFERENCES points_de_vente(id) ON DELETE SET NULL,
    FOREIGN KEY (assigned_to) REFERENCES users(id) ON DELETE SET NULL,
    INDEX idx_status (status),
    INDEX idx_priority (priority),
    INDEX idx_assigned_to (assigned_to)
);

-- Exemple 1
INSERT INTO reclamations (user_id, point_de_vente_id, description, status, priority, assigned_to, assigned_at)
VALUES (1, 9, 'Problème avec le système de caisse. Le logiciel ne répond plus.', 'ouvert', 'haute', NULL, NULL);

-- Exemple 2
INSERT INTO reclamations (user_id, point_de_vente_id, description, status, priority, assigned_to, assigned_at)
VALUES (2, 10, 'Défaillance du matériel de point de vente, ne s’allume pas.', 'en_cours', 'moyenne', 3, '2024-08-12 10:00:00');

-- Exemple 3
INSERT INTO reclamations (user_id, point_de_vente_id, description, status, priority, assigned_to, assigned_at)
VALUES (3, 11, 'Erreur dans les transactions enregistrées.', 'fermé', 'basse', 4, '2024-08-11 15:30:00');

-- Exemple 4
INSERT INTO reclamations (user_id, point_de_vente_id, description, status, priority, assigned_to, assigned_at)
VALUES (4, 12, 'Problème de connectivité avec le serveur.', 'ouvert', 'haute', 5, '2024-08-12 09:00:00');

-- Exemple 5
INSERT INTO reclamations (user_id, point_de_vente_id, description, status, priority, assigned_to, assigned_at)
VALUES (5, 13, 'Les imprimantes de reçus ne fonctionnent plus.', 'en_cours', 'moyenne', 6, '2024-08-12 11:00:00');

-- Exemple 6
INSERT INTO reclamations (user_id, point_de_vente_id, description, status, priority, assigned_to, assigned_at)
VALUES (6, 9, 'Mauvais affichage des prix sur le terminal.', 'ouvert', 'basse', NULL, NULL);

-- Exemple 7
INSERT INTO reclamations (user_id, point_de_vente_id, description, status, priority, assigned_to, assigned_at)
VALUES (7, 10, 'Problème de configuration du logiciel de caisse.', 'fermé', 'haute', 2, '2024-08-10 14:00:00');

-- Exemple 8
INSERT INTO reclamations (user_id, point_de_vente_id, description, status, priority, assigned_to, assigned_at)
VALUES (8, 11, 'Panne de la borne de paiement.', 'en_cours', 'moyenne', 7, '2024-08-12 12:00:00');

-- Exemple 9
INSERT INTO reclamations (user_id, point_de_vente_id, description, status, priority, assigned_to, assigned_at)
VALUES (9, 12, 'Erreur dans le traitement des remises.', 'ouvert', 'basse', NULL, NULL);

-- Exemple 10
INSERT INTO reclamations (user_id, point_de_vente_id, description, status, priority, assigned_to, assigned_at)
VALUES (1, 13, 'L’écran du point de vente est endommagé.', 'fermé', 'haute', 8, '2024-08-11 13:00:00');

-- Exemple 11
INSERT INTO reclamations (user_id, point_de_vente_id, description, status, priority, assigned_to, assigned_at)
VALUES (2, 9, 'Le terminal ne reconnaît pas certaines cartes de crédit.', 'en_cours', 'moyenne', 9, '2024-08-12 14:00:00');

-- Exemple 12
INSERT INTO reclamations (user_id, point_de_vente_id, description, status, priority, assigned_to, assigned_at)
VALUES (3, 10, 'Problème avec les mises à jour du logiciel.', 'ouvert', 'basse', NULL, NULL);

-- Exemple 13
INSERT INTO reclamations (user_id, point_de_vente_id, description, status, priority, assigned_to, assigned_at)
VALUES (4, 11, 'Des erreurs de calculs apparaissent dans le rapport quotidien.', 'en_cours', 'haute', 3, '2024-08-12 15:00:00');

-- Exemple 14
INSERT INTO reclamations (user_id, point_de_vente_id, description, status, priority, assigned_to, assigned_at)
VALUES (5, 12, 'Incohérence dans les données de ventes.', 'fermé', 'moyenne', 1, '2024-08-10 16:00:00');


-- Création des index pour améliorer les performances
CREATE INDEX idx_users_email ON users(email);
CREATE INDEX idx_prospects_status ON prospects(status);
CREATE INDEX idx_rendez_vous_prospect_id ON rendez_vous(prospect_id);
CREATE INDEX idx_rendez_vous_point_de_vente_id ON rendez_vous(point_de_vente_id);
CREATE INDEX idx_reclamations_user_id ON reclamations(user_id);
CREATE INDEX idx_reclamations_point_de_vente_id ON reclamations(point_de_vente_id);

-- Insertion d'exemples de données dans la table users
INSERT INTO users (username, password, email, role) VALUES
('admin_tunis', 'password123', 'admin.tunis@example.com', 'admin'),
('manager_tunis', 'password123', 'manager.tunis@example.com', 'manager'),
('employe_sousse', 'password123', 'employe.sousse@example.com', 'employee'),
('employe_nabeul', 'password123', 'employe.nabeul@example.com', 'employee');

-- Insertion d'exemples de données dans la table prospects
INSERT INTO prospects (first_name, last_name, email, phone, address, birth_date, occupation, source, notes, status) VALUES
('Ahmed', 'Ben Ali', 'ahmed.benali@example.com', '202-345-6789', '45 Rue de la République, Tunis', '1980-03-10', 'Comptable', 'Publicité', 'Intéressé par le plan premium', 'contacté'),
('Sofia', 'Boughdiri', 'sofia.boughdiri@example.com', '203-456-7890', '23 Avenue Habib Bourguiba, Sousse', '1992-07-22', 'Enseignante', 'Bouche-à-oreille', 'Demande de rendez-vous pour une consultation', 'nouveau'),
('Mounir', 'Ben Hassen', 'mounir.benhassen@example.com', '204-567-8901', '12 Rue de la Liberté, Nabeul', '1988-11-05', 'Ingénieur', 'Site Web', 'Rechercher des offres spéciales', 'contacté');

-- Insertion d'exemples de données dans la table points_de_vente
INSERT INTO points_de_vente (name, address, phone, email, manager_name) VALUES
('PDV Tunis Centre', '12 Rue de la Liberté, Tunis', '712345678', 'pdv.tuniscentre@example.com', 'Fatima Zahra'),
('PDV Sousse Plage', '45 Boulevard de la Mer, Sousse', '733456789', 'pdv.sousseplage@example.com', 'Mohamed Ali'),
('PDV Nabeul Centre', '67 Avenue Hedi Chaker, Nabeul', '752345678', 'pdv.nabeulcentre@example.com', 'Nadia Jaziri');

-- Insertion d'exemples de données dans la table rendez_vous
INSERT INTO rendez_vous (prospect_id, point_de_vente_id, date_time, status, notes) VALUES
(1, 1, '2024-08-10 11:00:00', 'prévu', 'Premier rendez-vous pour discuter des services offerts.'),
(2, 2, '2024-08-15 15:00:00', 'prévu', 'Présentation des options disponibles pour les étudiants.'),
(3, 3, '2024-08-20 09:00:00', 'prévu', 'Discussion sur les avantages pour les entreprises.');

-- Insertion d'exemples de données dans la table reclamations
INSERT INTO reclamations (user_id, point_de_vente_id, description, status) VALUES
(3, 1, 'Problème avec le paiement en ligne.', 'ouvert'),
(2, 2, 'Produit reçu endommagé.', 'en_cours'),
(1, 3, 'Retard dans la livraison.', 'fermé');

CREATE TABLE points_de_vente (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    address VARCHAR(255) NOT NULL,
    phone CHAR(8) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    manager_name VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT chk_name CHECK (name REGEXP '^[A-Za-z ]+$'),
    CONSTRAINT chk_phone CHECK (phone REGEXP '^[0-9]{8}$'),
    CONSTRAINT chk_email CHECK (email REGEXP '^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Z|a-z]{2,}$')
);

DELIMITER //

CREATE TRIGGER validate_manager_before_insert
BEFORE INSERT ON points_de_vente
FOR EACH ROW
BEGIN
    DECLARE manager_role VARCHAR(50);

    -- Vérifiez si le manager existe et a le rôle 'manager'
    SELECT role INTO manager_role
    FROM users
    WHERE username = NEW.manager_name;

    IF manager_role IS NULL THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Le manager spécifié n\'existe pas dans la table des utilisateurs.';
    ELSEIF manager_role <> 'manager' THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Le manager spécifié n\'a pas le rôle \'manager\'.';
    END IF;
END;
//

DELIMITER ;

DELIMITER //

CREATE TRIGGER validate_manager_before_update
BEFORE UPDATE ON points_de_vente
FOR EACH ROW
BEGIN
    DECLARE manager_role VARCHAR(50);

    -- Vérifiez si le manager existe et a le rôle 'manager'
    SELECT role INTO manager_role
    FROM users
    WHERE username = NEW.manager_name;

    IF manager_role IS NULL THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Le manager spécifié n\'existe pas dans la table des utilisateurs.';
    ELSEIF manager_role <> 'manager' THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Le manager spécifié n\'a pas le rôle \'manager\'.';
    END IF;
END;
//

DELIMITER ;


$2y$10$F8N79S3kEvr7GTMPWCoDveLwlLU8znpsjNU/W4rQIjluatKGq5sRa

-- Insertion de points de vente avec les managers spécifiés
INSERT INTO points_de_vente (name, address, phone, email, manager_name)
VALUES 
('Boutique de Bizerte', '110 Avenue Habib Bourguiba, Bizerte', '01234567', 'contact@boutiquebizerte.com', 'Tarek Houari'),
('Magasin de Kasserine', '120 Avenue de la Republique, Kasserine', '12345678', 'info@magasinkasserine.com', 'Sami Benali'),
('Librairie de Tunis', '5 Rue de la Liberte, Tunis', '09876543', 'contact@librairietunis.com', 'Amel Jebali'),
('Electronique Sousse', '32 Rue Khalifa Karoui, Sousse', '07654321', 'support@electroniquesousse.com', 'Rami Mekki'),
('Vetements Monastir', '45 Avenue de l Independace, Monastir', '06543210', 'info@vetementsmonastir.com', 'Soussi Khaled'),
('Supermarche de Gabes', '78 Avenue Mohamed V, Gabes', '05432109', 'contact@supermarchegabes.com', 'Faten Bouaziz'),
('Bijouterie Sfax', '16 Rue de l Eglise, Sfax', '04321098', 'support@bijouteriesfax.com', 'Youssef Nasri'),
('Pharmacie de Mahdia', '89 Rue du 18 Janvier, Mahdia', '03210987', 'info@pharmaciedemahdia.com', 'Nourhene Karray');


