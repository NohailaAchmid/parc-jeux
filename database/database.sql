<?php

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../helpers/auth.php';

class DashboardController
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    public function index()
    {
        // Vérifier que seul l'administrateur peut accéder au dashboard
        requireAdmin();

        /*
        |--------------------------------------------------------------------------
        | 1. STATISTIQUES DES JEUX
        |--------------------------------------------------------------------------
        */

        $stmt = $this->db->query("
            SELECT COUNT(*)
            FROM jeu
        ");

        $totalJeux = (int) $stmt->fetchColumn();


        $stmt = $this->db->query("
            SELECT COUNT(*)
            FROM jeu
            WHERE etat = 'disponible'
        ");

        $jeuxDisponibles = (int) $stmt->fetchColumn();


        $stmt = $this->db->query("
            SELECT COUNT(*)
            FROM jeu
            WHERE etat = 'maintenance'
        ");

        $jeuxMaintenance = (int) $stmt->fetchColumn();


        /*
        |--------------------------------------------------------------------------
        | 2. RESPONSABLES
        |--------------------------------------------------------------------------
        */

        $stmt = $this->db->query("
            SELECT COUNT(*)
            FROM responsable
            WHERE statut = 'actif'
        ");

        $totalResponsables = (int) $stmt->fetchColumn();


        /*
        |--------------------------------------------------------------------------
        | 3. CLIENTS
        |--------------------------------------------------------------------------
        */

        $stmt = $this->db->query("
            SELECT COUNT(*)
            FROM client
        ");

        $totalClients = (int) $stmt->fetchColumn();


        /*
        |--------------------------------------------------------------------------
        | 4. RESERVATIONS
        |--------------------------------------------------------------------------
        */

        $stmt = $this->db->query("
            SELECT COUNT(*)
            FROM reservation
        ");

        $totalReservations = (int) $stmt->fetchColumn();


        /*
        |--------------------------------------------------------------------------
        | 5. BILLETS VENDUS
        |--------------------------------------------------------------------------
        */

        $stmt = $this->db->query("
            SELECT COUNT(*)
            FROM billet
        ");

        $totalBillets = (int) $stmt->fetchColumn();


        /*
        |--------------------------------------------------------------------------
        | 6. RECETTES
        |--------------------------------------------------------------------------
        */

        $stmt = $this->db->query("
            SELECT COALESCE(SUM(montant), 0)
            FROM recette
        ");

        $totalRecettes = (float) $stmt->fetchColumn();


        /*
        |--------------------------------------------------------------------------
        | 7. DEPENSES
        |--------------------------------------------------------------------------
        */

        $stmt = $this->db->query("
            SELECT COALESCE(SUM(montant), 0)
            FROM depense
        ");

        $totalDepenses = (float) $stmt->fetchColumn();


        /*
        |--------------------------------------------------------------------------
        | 8. RESULTAT FINANCIER
        |--------------------------------------------------------------------------
        */

        $resultatFinancier = $totalRecettes - $totalDepenses;


        /*
        |--------------------------------------------------------------------------
        | 9. JEUX LES PLUS FREQUENTES
        |--------------------------------------------------------------------------
        */

        $stmt = $this->db->query("
            SELECT
                j.id_jeu,
                j.nom,
                j.categorie,
                COUNT(rj.id_reservation) AS nombre_reservations
            FROM jeu j

            LEFT JOIN reservation_jeu rj
                ON j.id_jeu = rj.id_jeu

            GROUP BY
                j.id_jeu,
                j.nom,
                j.categorie

            ORDER BY nombre_reservations DESC

            LIMIT 5
        ");

        $jeuxFrequents = $stmt->fetchAll(PDO::FETCH_ASSOC);


        /*
        |--------------------------------------------------------------------------
        | 10. DERNIERES RESERVATIONS
        |--------------------------------------------------------------------------
        */

        $stmt = $this->db->query("
            SELECT
                r.id_reservation,
                r.numero_reservation,
                r.date_visite,
                r.nombre_personnes,
                r.montant,
                r.statut,
                c.nom,
                c.prenom

            FROM reservation r

            LEFT JOIN client c
                ON r.id_client = c.id_client

            ORDER BY r.date_creation DESC

            LIMIT 5
        ");

        $dernieresReservations = $stmt->fetchAll(PDO::FETCH_ASSOC);


        /*
        |--------------------------------------------------------------------------
        | 11. VENTES RECENTES
        |--------------------------------------------------------------------------
        */

        $stmt = $this->db->query("
            SELECT
                a.id_achat,
                a.numero_commande,
                a.date_achat,
                a.quantite,
                a.montant_total,
                a.mode_paiement,
                a.statut_paiement,
                c.nom,
                c.prenom

            FROM achat a

            LEFT JOIN client c
                ON a.id_client = c.id_client

            ORDER BY a.date_achat DESC

            LIMIT 5
        ");

        $ventesRecentes = $stmt->fetchAll(PDO::FETCH_ASSOC);


        /*
        |--------------------------------------------------------------------------
        | 12. REPARTITION DES VENTES PAR TYPE DE BILLET
        |--------------------------------------------------------------------------
        */

        $stmt = $this->db->query("
            SELECT
                tb.libelle,
                COUNT(b.id_billet) AS total

            FROM type_billet tb

            LEFT JOIN billet b
                ON tb.id_type_billet = b.id_type_billet

            GROUP BY
                tb.id_type_billet,
                tb.libelle

            ORDER BY total DESC
        ");

        $repartitionVentes = $stmt->fetchAll(PDO::FETCH_ASSOC);


        /*
        |--------------------------------------------------------------------------
        | 13. EVOLUTION RECETTES / DEPENSES
        |--------------------------------------------------------------------------
        */

        $labelsGraphique = [];
        $recettesGraphique = [];
        $depensesGraphique = [];

        for ($i = 6; $i >= 0; $i--) {

            $date = date(
                'Y-m-d',
                strtotime("-$i days")
            );

            $labelsGraphique[] = date(
                'd/m',
                strtotime($date)
            );


            // Recettes du jour

            $stmt = $this->db->prepare("
                SELECT COALESCE(SUM(montant), 0)
                FROM recette
                WHERE date_recette = :date
            ");

            $stmt->execute([
                ':date' => $date
            ]);

            $recettesGraphique[] =
                (float) $stmt->fetchColumn();


            // Dépenses du jour

            $stmt = $this->db->prepare("
                SELECT COALESCE(SUM(montant), 0)
                FROM depense
                WHERE date_depense = :date
            ");

            $stmt->execute([
                ':date' => $date
            ]);

            $depensesGraphique[] =
                (float) $stmt->fetchColumn();
        }


        /*
        |--------------------------------------------------------------------------
        | 14. ALERTES MAINTENANCE
        |--------------------------------------------------------------------------
        */

        $stmt = $this->db->query("
            SELECT
                m.id_maintenance,
                m.type_intervention,
                m.date_prochaine_maintenance,
                m.etat_intervention,
                j.nom AS jeu_nom

            FROM maintenance m

            INNER JOIN jeu j
                ON m.id_jeu = j.id_jeu

            ORDER BY m.date_prochaine_maintenance ASC

            LIMIT 5
        ");

        $alertesMaintenance =
            $stmt->fetchAll(PDO::FETCH_ASSOC);


        /*
        |--------------------------------------------------------------------------
        | 15. ASSOCIATION DES IMAGES DES JEUX
        |--------------------------------------------------------------------------
        |
        | Les images existent déjà dans public/images/
        | et sont utilisées sur la page d'accueil.
        |
        */

        $imagesJeux = [

            'Grand huit'
                => 'images/grand-huit.jpg',

            'Carrousel'
                => 'images/carrousel.jpg',

            'Roue panoramique'
                => 'images/roue-panoramique.jpg',

            'Auto tamponneuses'
                => 'images/auto-tamponneuses.jpg',

            'Train fantôme'
                => 'images/train-fantome.jpg',

            'Manège'
                => 'images/manege.jpg',

            'Maison hantée'
                => 'images/maison-hantee.jpg',

            'Tir à la carabine'
                => 'images/tir-carabine.jpg',

            'Jeux gonflables'
                => 'images/jeux-gonflables.jpg',

            'Petits trains'
                => 'images/petits-trains.jpg'
        ];


        /*
        |--------------------------------------------------------------------------
        | 16. AFFICHER LE DASHBOARD
        |--------------------------------------------------------------------------
        */

        require __DIR__ . '/../views/dashboard/index.php';
    }
}