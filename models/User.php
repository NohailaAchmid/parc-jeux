<?php

require_once __DIR__ . '/../config/database.php';

class User
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    // Chercher un utilisateur avec son email
    public function findByEmail($email)
    {
        $sql = "
            SELECT *
            FROM utilisateur
            WHERE email = :email
            LIMIT 1
        ";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            ':email' => $email
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Créer un compte client
    public function createClient(
        $nom,
        $prenom,
        $email,
        $passwordHash
    ) {

        $sql = "
            INSERT INTO utilisateur
            (
                nom,
                prenom,
                email,
                mot_de_passe,
                role,
                statut
            )
            VALUES
            (
                :nom,
                :prenom,
                :email,
                :mot_de_passe,
                'client',
                'actif'
            )
        ";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            ':nom' => $nom,
            ':prenom' => $prenom,
            ':email' => $email,
            ':mot_de_passe' => $passwordHash
        ]);

        return true;
    }
}