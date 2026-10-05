-- =========================================================
-- Base de données : parc_jeux
-- Projet : Gestion d'un parc de jeux
-- =========================================================

CREATE DATABASE IF NOT EXISTS parc_jeux
CHARACTER SET utf8mb4
COLLATE utf8mb4_general_ci;

USE parc_jeux;

SET FOREIGN_KEY_CHECKS = 0;

DROP TABLE IF EXISTS reservation_jeu;
DROP TABLE IF EXISTS billet;
DROP TABLE IF EXISTS achat;
DROP TABLE IF EXISTS reservation;
DROP TABLE IF EXISTS maintenance;
DROP TABLE IF EXISTS depense;
DROP TABLE IF EXISTS recette;
DROP TABLE IF EXISTS type_billet;
DROP TABLE IF EXISTS jeu;
DROP TABLE IF EXISTS responsable;
DROP TABLE IF EXISTS client;
DROP TABLE IF EXISTS utilisateur;

SET FOREIGN_KEY_CHECKS = 1;

-- =========================================================
-- 1. UTILISATEUR
-- =========================================================

CREATE TABLE utilisateur (
    id_utilisateur INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    prenom VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    mot_de_passe VARCHAR(255) NOT NULL,
    role ENUM('admin','responsable','agent_vente','client') NOT NULL,
    statut ENUM('actif','inactif') NOT NULL DEFAULT 'actif'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- =========================================================
-- 2. RESPONSABLE
-- =========================================================

CREATE TABLE responsable (
    id_responsable INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    prenom VARCHAR(100) NOT NULL,
    telephone VARCHAR(30),
    adresse_electronique VARCHAR(150),
    fonction VARCHAR(100),
    date_embauche DATE,
    statut ENUM('actif','inactif') NOT NULL DEFAULT 'actif'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- =========================================================
-- 3. CLIENT
-- =========================================================

CREATE TABLE client (
    id_client INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    prenom VARCHAR(100) NOT NULL,
    telephone VARCHAR(30),
    email VARCHAR(150) NOT NULL UNIQUE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- =========================================================
-- 4. JEU
-- =========================================================

CREATE TABLE jeu (
    id_jeu INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(150) NOT NULL,
    description TEXT,
    categorie VARCHAR(100),
    age_minimum INT,
    capacite INT,
    duree_session INT,
    tarif DECIMAL(10,2) NOT NULL DEFAULT 0,
    etat ENUM('disponible','maintenance','indisponible')
        NOT NULL DEFAULT 'disponible',
    date_mise_en_service DATE,
    id_responsable INT,
    CONSTRAINT fk_jeu_responsable
        FOREIGN KEY (id_responsable)
        REFERENCES responsable(id_responsable)
        ON DELETE SET NULL
        ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- =========================================================
-- 5. TYPE BILLET
-- =========================================================

CREATE TABLE type_billet (
    id_type_billet INT AUTO_INCREMENT PRIMARY KEY,
    libelle VARCHAR(100) NOT NULL,
    prix DECIMAL(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- =========================================================
-- 6. RESERVATION
-- =========================================================

CREATE TABLE reservation (
    id_reservation INT AUTO_INCREMENT PRIMARY KEY,
    numero_reservation VARCHAR(50) NOT NULL UNIQUE,
    date_creation DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    date_visite DATE NOT NULL,
    nombre_personnes INT NOT NULL,
    montant DECIMAL(10,2) NOT NULL DEFAULT 0,
    statut ENUM('en_attente','confirmee','annulee','terminee')
        NOT NULL DEFAULT 'en_attente',
    id_client INT NOT NULL,
    CONSTRAINT fk_reservation_client
        FOREIGN KEY (id_client)
        REFERENCES client(id_client)
        ON DELETE CASCADE
        ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- =========================================================
-- 7. RESERVATION_JEU
-- =========================================================

CREATE TABLE reservation_jeu (
    id_reservation INT NOT NULL,
    id_jeu INT NOT NULL,
    PRIMARY KEY (id_reservation, id_jeu),
    CONSTRAINT fk_reservation_jeu_reservation
        FOREIGN KEY (id_reservation)
        REFERENCES reservation(id_reservation)
        ON DELETE CASCADE
        ON UPDATE CASCADE,
    CONSTRAINT fk_reservation_jeu_jeu
        FOREIGN KEY (id_jeu)
        REFERENCES jeu(id_jeu)
        ON DELETE CASCADE
        ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- =========================================================
-- 8. ACHAT
-- =========================================================

CREATE TABLE achat (
    id_achat INT AUTO_INCREMENT PRIMARY KEY,
    numero_commande VARCHAR(50) NOT NULL UNIQUE,
    date_achat DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    quantite INT NOT NULL,
    montant_total DECIMAL(10,2) NOT NULL DEFAULT 0,
    mode_paiement ENUM('especes','carte','en_ligne') NOT NULL,
    statut_paiement ENUM('en_attente','paye','echoue','rembourse')
        NOT NULL DEFAULT 'en_attente',
    id_client INT,
    CONSTRAINT fk_achat_client
        FOREIGN KEY (id_client)
        REFERENCES client(id_client)
        ON DELETE SET NULL
        ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- =========================================================
-- 9. BILLET
-- =========================================================

CREATE TABLE billet (
    id_billet INT AUTO_INCREMENT PRIMARY KEY,
    numero_billet VARCHAR(50) NOT NULL UNIQUE,
    id_achat INT NOT NULL,
    id_type_billet INT NOT NULL,
    CONSTRAINT fk_billet_achat
        FOREIGN KEY (id_achat)
        REFERENCES achat(id_achat)
        ON DELETE CASCADE
        ON UPDATE CASCADE,
    CONSTRAINT fk_billet_type
        FOREIGN KEY (id_type_billet)
        REFERENCES type_billet(id_type_billet)
        ON DELETE RESTRICT
        ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- =========================================================
-- 10. DEPENSE
-- =========================================================

CREATE TABLE depense (
    id_depense INT AUTO_INCREMENT PRIMARY KEY,
    categorie VARCHAR(100) NOT NULL,
    description TEXT,
    montant DECIMAL(10,2) NOT NULL,
    date_depense DATE NOT NULL,
    type_depense VARCHAR(100),
    justificatif VARCHAR(255),
    id_jeu INT,
    id_utilisateur INT,
    CONSTRAINT fk_depense_jeu
        FOREIGN KEY (id_jeu)
        REFERENCES jeu(id_jeu)
        ON DELETE SET NULL
        ON UPDATE CASCADE,
    CONSTRAINT fk_depense_utilisateur
        FOREIGN KEY (id_utilisateur)
        REFERENCES utilisateur(id_utilisateur)
        ON DELETE SET NULL
        ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- =========================================================
-- 11. MAINTENANCE
-- =========================================================

CREATE TABLE maintenance (
    id_maintenance INT AUTO_INCREMENT PRIMARY KEY,
    type_intervention VARCHAR(100) NOT NULL,
    description TEXT,
    date_intervention DATE NOT NULL,
    cout DECIMAL(10,2) NOT NULL DEFAULT 0,
    etat_intervention ENUM('planifiee','en_cours','terminee')
        NOT NULL DEFAULT 'planifiee',
    date_prochaine_maintenance DATE,
    id_jeu INT NOT NULL,
    id_responsable INT,
    CONSTRAINT fk_maintenance_jeu
        FOREIGN KEY (id_jeu)
        REFERENCES jeu(id_jeu)
        ON DELETE CASCADE
        ON UPDATE CASCADE,
    CONSTRAINT fk_maintenance_responsable
        FOREIGN KEY (id_responsable)
        REFERENCES responsable(id_responsable)
        ON DELETE SET NULL
        ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- =========================================================
-- 12. RECETTE
-- =========================================================

CREATE TABLE recette (
    id_recette INT AUTO_INCREMENT PRIMARY KEY,
    montant DECIMAL(10,2) NOT NULL,
    date_recette DATE NOT NULL,
    origine VARCHAR(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- =========================================================
-- DONNEES DE DEMONSTRATION
-- Mot de passe des 3 comptes : 123456
-- =========================================================

INSERT INTO utilisateur
(nom, prenom, email, mot_de_passe, role, statut)
VALUES
('Admin', 'Principal',
 'admin@parcdejeux.ma',
 '$2y$10$dNjLbZfEHOYlMTG4BWxT5OvIRxTcNk7pbvE1UJN8DCRoMk0E0XQ/C',
 'admin', 'actif'),

('Alami', 'Youssef',
 'responsable@parcdejeux.ma',
 '$2y$10$dNjLbZfEHOYlMTG4BWxT5OvIRxTcNk7pbvE1UJN8DCRoMk0E0XQ/C',
 'responsable', 'actif'),

('Vente', 'Agent',
 'vente@parcdejeux.ma',
 '$2y$10$dNjLbZfEHOYlMTG4BWxT5OvIRxTcNk7pbvE1UJN8DCRoMk0E0XQ/C',
 'agent_vente', 'actif');

INSERT INTO responsable
(nom, prenom, telephone, adresse_electronique, fonction, date_embauche, statut)
VALUES
('Alami', 'Youssef', '0612345678',
 'youssef@parcdejeux.ma', 'Responsable du parc',
 '2026-01-15', 'actif');

INSERT INTO client
(nom, prenom, telephone, email)
VALUES
('Amrani', 'Sara', '0611111111', 'sara@example.com'),
('Bennani', 'Omar', '0622222222', 'omar@example.com');

INSERT INTO type_billet
(libelle, prix)
VALUES
('Billet Enfant', 70.00),
('Billet Adulte', 90.00),
('Billet Famille', 280.00),
('Pass Journée', 150.00);

INSERT INTO jeu
(nom, description, categorie, age_minimum, capacite, duree_session,
 tarif, etat, date_mise_en_service, id_responsable)
VALUES
('Grand huit', 'Montagnes russes pour les amateurs de sensations fortes.',
 'Sensations', 12, 24, 5, 50.00, 'disponible', '2026-01-01', 1),

('Carrousel', 'Manège familial classique.',
 'Famille', 3, 20, 5, 30.00, 'disponible', '2026-01-01', 1),

('Roue panoramique', 'Grande roue avec vue panoramique.',
 'Famille', 5, 32, 10, 40.00, 'disponible', '2026-01-01', 1),

('Auto tamponneuses', 'Jeu familial avec voitures électriques.',
 'Famille', 6, 16, 5, 35.00, 'disponible', '2026-01-01', 1),

('Train fantôme', 'Parcours intérieur à thème.',
 'Sensations', 10, 12, 7, 45.00, 'disponible', '2026-01-01', 1),

('Manège', 'Manège pour enfants.',
 'Enfants', 3, 18, 5, 25.00, 'disponible', '2026-01-01', 1),

('Maison hantée', 'Parcours thématique.',
 'Sensations', 10, 10, 8, 40.00, 'disponible', '2026-01-01', 1),

('Tir à la carabine', 'Jeu d’adresse et de précision.',
 'Jeux', 8, 6, 5, 30.00, 'disponible', '2026-01-01', 1),

('Jeux gonflables', 'Espace de jeux gonflables pour enfants.',
 'Enfants', 3, 20, 10, 30.00, 'disponible', '2026-01-01', 1),

('Petits trains', 'Petit train pour les enfants.',
 'Enfants', 3, 15, 8, 25.00, 'disponible', '2026-01-01', 1);

INSERT INTO reservation
(numero_reservation, date_creation, date_visite, nombre_personnes,
 montant, statut, id_client)
VALUES
('RES-2026-001', NOW(), '2026-10-10', 4, 280.00, 'confirmee', 1),
('RES-2026-002', NOW(), '2026-10-12', 2, 180.00, 'en_attente', 2);

INSERT INTO reservation_jeu
(id_reservation, id_jeu)
VALUES
(1, 2),
(1, 3),
(2, 1);

INSERT INTO achat
(numero_commande, date_achat, quantite, montant_total,
 mode_paiement, statut_paiement, id_client)
VALUES
('CMD-2026-001', NOW(), 2, 180.00, 'carte', 'paye', 1),
('CMD-2026-002', NOW(), 4, 280.00, 'en_ligne', 'paye', 2);

INSERT INTO billet
(numero_billet, id_achat, id_type_billet)
VALUES
('BIL-2026-001', 1, 2),
('BIL-2026-002', 1, 2),
('BIL-2026-003', 2, 3),
('BIL-2026-004', 2, 3),
('BIL-2026-005', 2, 3),
('BIL-2026-006', 2, 3);

INSERT INTO depense
(categorie, description, montant, date_depense, type_depense,
 justificatif, id_jeu, id_utilisateur)
VALUES
('Maintenance', 'Entretien préventif du Grand huit.',
 500.00, '2026-10-01', 'Entretien',
 'facture-grand-huit.pdf', 1, 1),

('Fournitures', 'Achat de fournitures pour le parc.',
 250.00, '2026-10-02', 'Fournitures',
 'facture-fournitures.pdf', NULL, 1);

INSERT INTO maintenance
(type_intervention, description, date_intervention, cout,
 etat_intervention, date_prochaine_maintenance, id_jeu, id_responsable)
VALUES
('Entretien préventif',
 'Vérification générale du Grand huit.',
 '2026-10-01', 500.00,
 'terminee', '2026-11-01', 1, 1),

('Contrôle technique',
 'Contrôle des systèmes de sécurité.',
 '2026-10-05', 300.00,
 'planifiee', '2026-10-20', 4, 1);

INSERT INTO recette
(montant, date_recette, origine)
VALUES
(180.00, '2026-10-03', 'Vente de billets'),
(280.00, '2026-10-04', 'Vente de billets'),
(460.00, '2026-10-05', 'Réservations');

-- =========================================================
-- FIN
-- =========================================================
