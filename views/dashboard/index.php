<?php

$prenomAdmin = $_SESSION['user_prenom'] ?? 'Admin';

?>

<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Tableau de bord - Parc de Jeux</title>


    <!-- Google Fonts -->

    <link rel="preconnect"
          href="https://fonts.googleapis.com">

    <link rel="preconnect"
          href="https://fonts.gstatic.com"
          crossorigin>

    <link
        href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@400;500;600;700;800&family=Nunito:wght@400;500;600;700;800&display=swap"
        rel="stylesheet"
    >


    <!-- Font Awesome -->

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    >


    <!-- CSS Dashboard -->

    <link
        rel="stylesheet"
        href="css/dashboard.css"
    >


    <!-- Chart.js -->

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>


<body>


<div class="admin-layout">


    <!-- =====================================================
         SIDEBAR
    ====================================================== -->

    <aside class="sidebar">


        <!-- LOGO -->

        <div class="sidebar-logo">

            <img
                src="images/logo.png"
                alt="Parc de Jeux"
            >

        </div>


        <!-- MENU -->

        <nav class="sidebar-menu">


            <a
                href="?page=dashboard"
                class="menu-item active"
            >

                <i class="fa-solid fa-house"></i>

                <span>Tableau de bord</span>

            </a>


            <a href="#" class="menu-item">

                <i class="fa-solid fa-gamepad"></i>

                <span>Jeux</span>

                <i class="fa-solid fa-chevron-right menu-arrow"></i>

            </a>


            <a href="#" class="menu-item">

                <i class="fa-solid fa-user-tie"></i>

                <span>Responsables</span>

                <i class="fa-solid fa-chevron-right menu-arrow"></i>

            </a>


            <a href="#" class="menu-item">

                <i class="fa-solid fa-users"></i>

                <span>Clients</span>

                <i class="fa-solid fa-chevron-right menu-arrow"></i>

            </a>


            <a href="#" class="menu-item">

                <i class="fa-solid fa-ticket"></i>

                <span>Billets & tarifs</span>

                <i class="fa-solid fa-chevron-right menu-arrow"></i>

            </a>


            <a href="#" class="menu-item">

                <i class="fa-solid fa-cart-shopping"></i>

                <span>Ventes</span>

                <i class="fa-solid fa-chevron-right menu-arrow"></i>

            </a>


            <a href="#" class="menu-item">

                <i class="fa-solid fa-calendar-days"></i>

                <span>Réservations</span>

                <i class="fa-solid fa-chevron-right menu-arrow"></i>

            </a>


            <a href="#" class="menu-item">

                <i class="fa-solid fa-wallet"></i>

                <span>Dépenses</span>

                <i class="fa-solid fa-chevron-right menu-arrow"></i>

            </a>


            <a href="#" class="menu-item">

                <i class="fa-solid fa-arrow-trend-up"></i>

                <span>Recettes</span>

                <i class="fa-solid fa-chevron-right menu-arrow"></i>

            </a>


            <a href="#" class="menu-item">

                <i class="fa-solid fa-screwdriver-wrench"></i>

                <span>Maintenance</span>

                <i class="fa-solid fa-chevron-right menu-arrow"></i>

            </a>


            <a href="#" class="menu-item">

                <i class="fa-solid fa-user-gear"></i>

                <span>Utilisateurs</span>

                <i class="fa-solid fa-chevron-right menu-arrow"></i>

            </a>


            <a href="#" class="menu-item">

                <i class="fa-solid fa-file-lines"></i>

                <span>Rapports</span>

                <i class="fa-solid fa-chevron-right menu-arrow"></i>

            </a>


            <a href="#" class="menu-item">

                <i class="fa-solid fa-gear"></i>

                <span>Paramètres</span>

                <i class="fa-solid fa-chevron-right menu-arrow"></i>

            </a>


        </nav>


        <!-- DECONNEXION -->

        <div class="sidebar-bottom">

            <a
                href="?page=logout"
                class="menu-item logout"
            >

                <i class="fa-solid fa-right-from-bracket"></i>

                <span>Déconnexion</span>

            </a>

        </div>


    </aside>



    <!-- =====================================================
         CONTENU PRINCIPAL
    ====================================================== -->

    <main class="main-content">


        <!-- TOPBAR -->

        <header class="topbar">


            <button
                class="menu-toggle"
                id="menuToggle"
            >

                <i class="fa-solid fa-bars"></i>

            </button>


            <div class="topbar-right">


                <button class="notification-button">

                    <i class="fa-regular fa-bell"></i>

                    <span class="notification-badge">
                        <?= count($alertesMaintenance) ?>
                    </span>

                </button>


                <div class="admin-profile">

                    <div class="admin-avatar">

                        <i class="fa-solid fa-user"></i>

                    </div>


                    <div class="admin-info">

                        <strong>
                            <?= htmlspecialchars($prenomAdmin) ?>
                        </strong>

                        <span>
                            Administrateur
                        </span>

                    </div>


                    <i class="fa-solid fa-chevron-down"></i>

                </div>

            </div>

        </header>



        <!-- CONTENU -->

        <div class="dashboard-content">


            <!-- =================================================
                 BIENVENUE
            ================================================== -->

            <section class="welcome-section">


                <div>

                    <h1>
                        Bonjour <?= htmlspecialchars($prenomAdmin) ?>
                    </h1>

                    <p>
                        Voici un aperçu de l'activité de votre parc de jeux aujourd'hui.
                    </p>

                </div>


                <div class="date-box">

                    <i class="fa-regular fa-calendar"></i>

                    <div>

                        <strong>Aujourd'hui</strong>

                        <span>
                            <?= date('d/m/Y') ?>
                        </span>

                    </div>

                </div>


            </section>



            <!-- =================================================
                 CARTES STATISTIQUES
            ================================================== -->

            <section class="stats-grid">


                <!-- JEUX -->

                <div class="stat-card blue">

                    <div class="stat-icon">

                        <i class="fa-solid fa-gamepad"></i>

                    </div>

                    <div>

                        <span>Total des jeux</span>

                        <strong>
                            <?= $totalJeux ?>
                        </strong>

                        <small>
                            Jeux dans le parc
                        </small>

                    </div>

                </div>


                <!-- DISPONIBLES -->

                <div class="stat-card green">

                    <div class="stat-icon">

                        <i class="fa-solid fa-circle-check"></i>

                    </div>

                    <div>

                        <span>Jeux disponibles</span>

                        <strong>
                            <?= $jeuxDisponibles ?>
                        </strong>

                        <small>
                            En service
                        </small>

                    </div>

                </div>


                <!-- MAINTENANCE -->

                <div class="stat-card red">

                    <div class="stat-icon">

                        <i class="fa-solid fa-screwdriver-wrench"></i>

                    </div>

                    <div>

                        <span>Jeux en maintenance</span>

                        <strong>
                            <?= $jeuxMaintenance ?>
                        </strong>

                        <small>
                            Hors service
                        </small>

                    </div>

                </div>


                <!-- RESPONSABLES -->

                <div class="stat-card purple">

                    <div class="stat-icon">

                        <i class="fa-solid fa-user-tie"></i>

                    </div>

                    <div>

                        <span>Responsables</span>

                        <strong>
                            <?= $totalResponsables ?>
                        </strong>

                        <small>
                            Équipe active
                        </small>

                    </div>

                </div>


                <!-- CLIENTS -->

                <div class="stat-card orange">

                    <div class="stat-icon">

                        <i class="fa-solid fa-users"></i>

                    </div>

                    <div>

                        <span>Clients</span>

                        <strong>
                            <?= $totalClients ?>
                        </strong>

                        <small>
                            Clients enregistrés
                        </small>

                    </div>

                </div>


                <!-- RESERVATIONS -->

                <div class="stat-card cyan">

                    <div class="stat-icon">

                        <i class="fa-solid fa-calendar-check"></i>

                    </div>

                    <div>

                        <span>Réservations</span>

                        <strong>
                            <?= $totalReservations ?>
                        </strong>

                        <small>
                            Réservations enregistrées
                        </small>

                    </div>

                </div>


                <!-- BILLETS -->

                <div class="stat-card pink">

                    <div class="stat-icon">

                        <i class="fa-solid fa-ticket"></i>

                    </div>

                    <div>

                        <span>Billets vendus</span>

                        <strong>
                            <?= $totalBillets ?>
                        </strong>

                        <small>
                            Billets enregistrés
                        </small>

                    </div>

                </div>


                <!-- RECETTES -->

                <div class="stat-card green">

                    <div class="stat-icon">

                        <i class="fa-solid fa-coins"></i>

                    </div>

                    <div>

                        <span>Total recettes</span>

                        <strong>
                            <?= number_format($totalRecettes, 2, ',', ' ') ?> DH
                        </strong>

                        <small>
                            Revenus du parc
                        </small>

                    </div>

                </div>


                <!-- DEPENSES -->

                <div class="stat-card red">

                    <div class="stat-icon">

                        <i class="fa-solid fa-money-bill-wave"></i>

                    </div>

                    <div>

                        <span>Total dépenses</span>

                        <strong>
                            <?= number_format($totalDepenses, 2, ',', ' ') ?> DH
                        </strong>

                        <small>
                            Dépenses enregistrées
                        </small>

                    </div>

                </div>


                <!-- RESULTAT -->

                <div class="stat-card blue">

                    <div class="stat-icon">

                        <i class="fa-solid fa-chart-column"></i>

                    </div>

                    <div>

                        <span>Résultat financier</span>

                        <strong>
                            <?= number_format($resultatFinancier, 2, ',', ' ') ?> DH
                        </strong>

                        <small>
                            Recettes − dépenses
                        </small>

                    </div>

                </div>


            </section>



            <!-- =================================================
                 LIGNE GRAPHIQUES
            ================================================== -->

            <section class="dashboard-grid">


                <!-- GRAPHIQUE RECETTES / DEPENSES -->

                <div class="dashboard-card chart-card">

                    <div class="card-header">

                        <div>

                            <h2>
                                <i class="fa-solid fa-chart-line"></i>
                                Évolution des recettes et dépenses
                            </h2>

                            <p>
                                Activité des 7 derniers jours
                            </p>

                        </div>

                    </div>


                    <div class="chart-container">

                        <canvas id="financialChart"></canvas>

                    </div>

                </div>



                <!-- REPARTITION DES VENTES -->

                <div class="dashboard-card chart-card">

                    <div class="card-header">

                        <div>

                            <h2>
                                <i class="fa-solid fa-chart-pie"></i>
                                Répartition des ventes
                            </h2>

                            <p>
                                Types de billets vendus
                            </p>

                        </div>

                    </div>


                    <div class="chart-container doughnut-container">

                        <canvas id="salesChart"></canvas>

                    </div>

                </div>


            </section>



            <!-- =================================================
                 JEUX LES PLUS FREQUENTES
            ================================================== -->

            <section class="dashboard-card popular-games-card">


                <div class="card-header">

                    <div>

                        <h2>

                            <i class="fa-solid fa-gamepad"></i>

                            Jeux les plus fréquentés

                        </h2>

                        <p>
                            Les attractions les plus demandées
                        </p>

                    </div>

                </div>


                <div class="popular-games">


                    <?php if (!empty($jeuxFrequents)): ?>


                        <?php foreach ($jeuxFrequents as $jeu): ?>


                            <?php

                            $imageJeu =
                                $imagesJeux[$jeu['nom']]
                                ?? 'images/logo.png';

                            ?>


                            <div class="popular-game">


                                <img
                                    src="<?= htmlspecialchars($imageJeu) ?>"
                                    alt="<?= htmlspecialchars($jeu['nom']) ?>"
                                >


                                <div class="popular-game-info">

                                    <strong>
                                        <?= htmlspecialchars($jeu['nom']) ?>
                                    </strong>

                                    <span>
                                        <?= htmlspecialchars($jeu['categorie'] ?? 'Attraction') ?>
                                    </span>

                                </div>


                                <div class="reservation-count">

                                    <strong>
                                        <?= (int) $jeu['nombre_reservations'] ?>
                                    </strong>

                                    <span>
                                        réservations
                                    </span>

                                </div>


                            </div>


                        <?php endforeach; ?>


                    <?php else: ?>


                        <div class="empty-state">

                            <i class="fa-solid fa-gamepad"></i>

                            <p>
                                Aucun jeu avec réservation pour le moment.
                            </p>

                        </div>


                    <?php endif; ?>


                </div>

            </section>



            <!-- =================================================
                 TABLEAUX
            ================================================== -->

            <section class="bottom-grid">


                <!-- DERNIERES RESERVATIONS -->

                <div class="dashboard-card table-card">


                    <div class="card-header">

                        <div>

                            <h2>

                                <i class="fa-solid fa-calendar-days"></i>

                                Dernières réservations

                            </h2>

                        </div>

                        <a href="#">
                            Voir tout
                        </a>

                    </div>


                    <div class="table-wrapper">

                        <table>

                            <thead>

                                <tr>

                                    <th>N° Réservation</th>

                                    <th>Client</th>

                                    <th>Date visite</th>

                                    <th>Statut</th>

                                    <th>Montant</th>

                                </tr>

                            </thead>


                            <tbody>


                                <?php if (!empty($dernieresReservations)): ?>


                                    <?php foreach ($dernieresReservations as $reservation): ?>

                                        <tr>

                                            <td>
                                                <?= htmlspecialchars($reservation['numero_reservation']) ?>
                                            </td>

                                            <td>
                                                <?= htmlspecialchars(
                                                    ($reservation['prenom'] ?? '') .
                                                    ' ' .
                                                    ($reservation['nom'] ?? '')
                                                ) ?>
                                            </td>

                                            <td>
                                                <?= date(
                                                    'd/m/Y',
                                                    strtotime($reservation['date_visite'])
                                                ) ?>
                                            </td>

                                            <td>

                                                <?php

                                                $statut =
                                                    $reservation['statut'];

                                                $statutLabel = [
                                                    'en_attente' => 'En attente',
                                                    'confirmee' => 'Confirmée',
                                                    'annulee' => 'Annulée',
                                                    'terminee' => 'Terminée'
                                                ];

                                                ?>

                                                <span class="status <?= htmlspecialchars($statut) ?>">

                                                    <?= $statutLabel[$statut] ?? $statut ?>

                                                </span>

                                            </td>

                                            <td>

                                                <?= number_format(
                                                    $reservation['montant'],
                                                    2,
                                                    ',',
                                                    ' '
                                                ) ?>

                                                DH

                                            </td>

                                        </tr>

                                    <?php endforeach; ?>


                                <?php else: ?>

                                    <tr>

                                        <td colspan="5"
                                            class="empty-table">

                                            Aucune réservation.

                                        </td>

                                    </tr>

                                <?php endif; ?>


                            </tbody>

                        </table>

                    </div>

                </div>



                <!-- VENTES RECENTES -->

                <div class="dashboard-card table-card">


                    <div class="card-header">

                        <div>

                            <h2>

                                <i class="fa-solid fa-cart-shopping"></i>

                                Ventes récentes

                            </h2>

                        </div>

                        <a href="#">
                            Voir tout
                        </a>

                    </div>


                    <div class="table-wrapper">

                        <table>

                            <thead>

                                <tr>

                                    <th>N° Vente</th>

                                    <th>Client</th>

                                    <th>Montant</th>

                                    <th>Paiement</th>

                                </tr>

                            </thead>


                            <tbody>


                                <?php if (!empty($ventesRecentes)): ?>


                                    <?php foreach ($ventesRecentes as $vente): ?>

                                        <tr>

                                            <td>
                                                <?= htmlspecialchars($vente['numero_commande']) ?>
                                            </td>

                                            <td>
                                                <?= htmlspecialchars(
                                                    ($vente['prenom'] ?? '') .
                                                    ' ' .
                                                    ($vente['nom'] ?? '')
                                                ) ?>
                                            </td>

                                            <td>

                                                <?= number_format(
                                                    $vente['montant_total'],
                                                    2,
                                                    ',',
                                                    ' '
                                                ) ?>

                                                DH

                                            </td>

                                            <td>

                                                <span class="payment-badge">

                                                    <?= htmlspecialchars(
                                                        ucfirst(
                                                            str_replace(
                                                                '_',
                                                                ' ',
                                                                $vente['mode_paiement']
                                                            )
                                                        )
                                                    ) ?>

                                                </span>

                                            </td>

                                        </tr>

                                    <?php endforeach; ?>


                                <?php else: ?>

                                    <tr>

                                        <td colspan="4"
                                            class="empty-table">

                                            Aucune vente.

                                        </td>

                                    </tr>

                                <?php endif; ?>


                            </tbody>

                        </table>

                    </div>

                </div>



                <!-- ALERTES -->

                <div class="dashboard-card alerts-card">


                    <div class="card-header">

                        <div>

                            <h2>

                                <i class="fa-solid fa-bell"></i>

                                Alertes et notifications

                            </h2>

                        </div>

                    </div>


                    <div class="alerts-list">


                        <?php if (!empty($alertesMaintenance)): ?>


                            <?php foreach ($alertesMaintenance as $alerte): ?>

                                <div class="alert-item">


                                    <div class="alert-icon">

                                        <i class="fa-solid fa-screwdriver-wrench"></i>

                                    </div>


                                    <div class="alert-content">

                                        <strong>

                                            <?= htmlspecialchars(
                                                $alerte['jeu_nom']
                                            ) ?>

                                        </strong>

                                        <span>

                                            <?= htmlspecialchars(
                                                $alerte['type_intervention']
                                            ) ?>

                                        </span>

                                    </div>


                                    <div class="alert-date">

                                        <?= date(
                                            'd/m',
                                            strtotime(
                                                $alerte['date_prochaine_maintenance']
                                            )
                                        ) ?>

                                    </div>


                                </div>

                            <?php endforeach; ?>


                        <?php else: ?>


                            <div class="empty-state">

                                <i class="fa-regular fa-bell-slash"></i>

                                <p>
                                    Aucune alerte pour le moment.
                                </p>

                            </div>


                        <?php endif; ?>


                    </div>

                </div>


            </section>


        </div>

    </main>

</div>



<!-- =========================================================
     DONNEES GRAPHIQUES
========================================================= -->

<script>

const financialLabels =
    <?= json_encode($labelsGraphique) ?>;

const financialRevenue =
    <?= json_encode($recettesGraphique) ?>;

const financialExpenses =
    <?= json_encode($depensesGraphique) ?>;


const salesLabels =
    <?= json_encode(
        array_column(
            $repartitionVentes,
            'libelle'
        )
    ) ?>;

const salesValues =
    <?= json_encode(
        array_map(
            'intval',
            array_column(
                $repartitionVentes,
                'total'
            )
        )
    ) ?>;



/*
|--------------------------------------------------------------------------
| GRAPHIQUE RECETTES / DEPENSES
|--------------------------------------------------------------------------
*/

new Chart(
    document.getElementById('financialChart'),
    {

        type: 'line',

        data: {

            labels: financialLabels,

            datasets: [

                {

                    label: 'Recettes',

                    data: financialRevenue,

                    borderWidth: 3,

                    tension: 0.4,

                    fill: true

                },

                {

                    label: 'Dépenses',

                    data: financialExpenses,

                    borderWidth: 3,

                    tension: 0.4,

                    fill: true

                }

            ]

        },

        options: {

            responsive: true,

            maintainAspectRatio: false,

            plugins: {

                legend: {

                    position: 'top'

                }

            },

            scales: {

                y: {

                    beginAtZero: true

                }

            }

        }

    }
);



/*
|--------------------------------------------------------------------------
| GRAPHIQUE REPARTITION DES VENTES
|--------------------------------------------------------------------------
*/

new Chart(
    document.getElementById('salesChart'),
    {

        type: 'doughnut',

        data: {

            labels: salesLabels,

            datasets: [

                {

                    data: salesValues,

                    borderWidth: 3

                }

            ]

        },

        options: {

            responsive: true,

            maintainAspectRatio: false,

            cutout: '65%',

            plugins: {

                legend: {

                    position: 'right'

                }

            }

        }

    }
);



/*
|--------------------------------------------------------------------------
| MENU MOBILE
|--------------------------------------------------------------------------
*/

const menuToggle =
    document.getElementById('menuToggle');

const sidebar =
    document.querySelector('.sidebar');


if (menuToggle) {

    menuToggle.addEventListener(
        'click',
        function () {

            sidebar.classList.toggle('open');

        }
    );

}

</script>


</body>

</html>