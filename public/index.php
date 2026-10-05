<?php

if (
    isset($_GET['page']) &&
   in_array($_GET['page'], [
    'login',
    'register',
    'forgot-password',
    'reset-password',
    'dashboard'
])
) {

    require_once __DIR__ . '/../routes/routes.php';

    exit;
}

?>


<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Parc de Jeux</title>

    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link
        href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@400;500;600;700;800&family=Nunito:wght@400;500;600;700;800&display=swap"
        rel="stylesheet"
    >

    <!-- Font Awesome -->
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    >

    <!-- CSS -->
    <link rel="stylesheet" href="css/style.css">

</head>


<body>


<!-- =========================================
     HEADER
========================================= -->

<header class="header">

    <!-- LOGO -->

    <a href="#" class="logo">

        <img src="images/logo.png" alt="Parc de Jeux">

        

    </a>


    <!-- NAVIGATION -->

    <nav class="navbar">

        <a href="#" class="active">

            <i class="fa-solid fa-house"></i>

            <span>Accueil</span>

        </a>


       <a href="#jeux">
    <i class="fa-solid fa-gamepad"></i>
    Nos Jeux
</a>

<a href="#billets">
    <i class="fa-solid fa-ticket"></i>
    Billets & tarifs
</a>

<a href="#infos">
    <i class="fa-solid fa-circle-info"></i>
    Infos pratiques
</a>

    </nav>


    <!-- CONNEXION -->

   <a href="/parc-jeux/public/?page=login" class="btn-login">
    <i class="fa-solid fa-user"></i>
    Connexion
</a>
</header>



<!-- =========================================
     HERO
========================================= -->

<section class="hero">


    <!-- Décorations -->

    <span class="decoration decoration-yellow"></span>

    <span class="decoration decoration-red"></span>

    <span class="decoration decoration-blue"></span>

    <span class="decoration decoration-yellow-2"></span>

    

    


    <!-- CONTENU -->

    <div class="hero-content">


        <h1 class="hero-title">

            <span>Le bonheur</span>

            <span>
                au <strong>rendez-vous !</strong>
            </span>

        </h1>


        <p class="hero-description">

            Vivez des moments inoubliables en famille ou entre amis
            dans notre parc de jeux. Des attractions pour tous les âges,
            des sensations fortes et des souvenirs plein la tête !

        </p>


        <a href="#jeux" class="btn-primary">

            Découvrir nos jeux

            <i class="fa-solid fa-arrow-right"></i>

        </a>


    </div>


</section>
<!-- =========================================
     AVANTAGES
========================================= -->

<section class="advantages">

    <div class="advantage-item">

        <div class="advantage-icon icon-red">
            <i class="fa-regular fa-face-smile"></i>
        </div>

        <div class="advantage-content">
            <h3>Des jeux pour tous</h3>
            <p>Pour tous les âges et tous les goûts</p>
        </div>

    </div>


    <div class="advantage-item">

        <div class="advantage-icon icon-yellow">
            <i class="fa-solid fa-shield-halved"></i>
        </div>

        <div class="advantage-content">
            <h3>Sécurité garantie</h3>
            <p>Un parc aux normes de sécurité</p>
        </div>

    </div>


    <div class="advantage-item">

        <div class="advantage-icon icon-green">
            <i class="fa-solid fa-users"></i>
        </div>

        <div class="advantage-content">
            <h3>Équipe accueillante</h3>
            <p>Toujours à votre service</p>
        </div>

    </div>


    <div class="advantage-item">

        <div class="advantage-icon icon-blue">
            <i class="fa-regular fa-star"></i>
        </div>

        <div class="advantage-content">
            <h3>Des souvenirs inoubliables</h3>
            <p>Des moments de joie en famille</p>
        </div>

    </div>

</section>
<!-- =========================================
     NOS JEUX
========================================= -->

<section class="games-section" id="jeux">

    <!-- TITRE -->

    <div class="section-heading">

        <div class="heading-decoration left-decoration">
            <span></span>
            <span></span>
        </div>

        <h2>Nos Jeux</h2>

        <div class="heading-decoration right-decoration">
            <span></span>
            <span></span>
        </div>

        <p>
            Découvrez toutes nos attractions et choisissez votre aventure !
        </p>

    </div>


    <!-- CATEGORIES -->

    <div class="games-filters">

        <button class="filter-btn active">
            Tous
        </button>

        <button class="filter-btn">
            Sensations fortes
        </button>

        <button class="filter-btn">
            Enfants
        </button>

        <button class="filter-btn">
            Famille
        </button>

        <button class="filter-btn">
            Manèges
        </button>

        <button class="filter-btn">
            Jeux d'adresse
        </button>

    </div>


    <!-- CARTES -->

    <div class="games-grid">


        <!-- 1. GRAND HUIT -->

        <div class="game-card">

            <div class="game-image">

                <img src="images/grand-huit.jpg" alt="Grand huit">

                <div class="game-info red-card">

                    <div class="game-text">

                        <h3>Grand huit</h3>

                        <p>À partir de 8 ans</p>

                    </div>

                    

                </div>

            </div>

        </div>


        <!-- 2. CARROUSEL -->

        <div class="game-card">

            <div class="game-image">

                <img src="images/carrousel.jpg" alt="Carrousel">

                <div class="game-info yellow-card">

                    <div class="game-text">

                        <h3>Carrousel</h3>

                        <p>Pour tous les âges</p>

                    </div>

                    

                </div>

            </div>

        </div>


        <!-- 3. ROUE PANORAMIQUE -->

        <div class="game-card">

            <div class="game-image">

                <img src="images/roue-panoramique.jpg" alt="Roue panoramique">

                <div class="game-info blue-card">

                    <div class="game-text">

                        <h3>Roue panoramique</h3>

                        <p>Pour tous les âges</p>

                    </div>

                    

                </div>

            </div>

        </div>


        <!-- 4. AUTO TAMPONNEUSES -->

        <div class="game-card">

            <div class="game-image">

                <img src="images/auto-tamponneuses.jpg" alt="Auto tamponneuses">

                <div class="game-info green-card">

                    <div class="game-text">

                        <h3>Auto tamponneuses</h3>

                        <p>À partir de 5 ans</p>

                    </div>

                   

                </div>

            </div>

        </div>


        <!-- 5. TRAIN FANTOME -->

        <div class="game-card">

            <div class="game-image">

                <img src="images/train-fantome.jpg" alt="Train fantôme">

                <div class="game-info purple-card">

                    <div class="game-text">

                        <h3>Train fantôme</h3>

                        <p>À partir de 6 ans</p>

                    </div>

                    

                </div>

            </div>

        </div>


        <!-- 6. MANEGE -->

        <div class="game-card">

            <div class="game-image">

                <img src="images/manege.jpg" alt="Manège">

                <div class="game-info cyan-card">

                    <div class="game-text">

                        <h3>Manège</h3>

                        <p>Pour tous les âges</p>

                    </div>

                   

                </div>

            </div>

        </div>


        <!-- 7. MAISON HANTEE -->

        <div class="game-card">

            <div class="game-image">

                <img src="images/maison-hantee.jpg" alt="Maison hantée">

                <div class="game-info pink-card">

                    <div class="game-text">

                        <h3>Maison hantée</h3>

                        <p>À partir de 10 ans</p>

                    </div>

                   

                </div>

            </div>

        </div>


        <!-- 8. TIR A LA CARABINE -->

        <div class="game-card">

            <div class="game-image">

                <img src="images/tir-carabine.jpg" alt="Tir à la carabine">

                <div class="game-info orange-card">

                    <div class="game-text">

                        <h3>Tir à la carabine</h3>

                        <p>À partir de 6 ans</p>

                    </div>

                    

                </div>

            </div>

        </div>


        <!-- 9. JEUX GONFLABLES -->

        <div class="game-card">

            <div class="game-image">

                <img src="images/jeux-gonflables.jpg" alt="Jeux gonflables">

                <div class="game-info pink-card">

                    <div class="game-text">

                        <h3>Jeux gonflables</h3>

                        <p>De 2 à 10 ans</p>

                    </div>

                    

                </div>

            </div>

        </div>


        <!-- 10. PETITS TRAINS -->

        <div class="game-card">

            <div class="game-image">

                <img src="images/petits-trains.jpg" alt="Petits trains">

                <div class="game-info turquoise-card">

                    <div class="game-text">

                        <h3>Petits trains</h3>

                        <p>Pour tous les âges</p>

                    </div>

                   

                </div>

            </div>

        </div>

    </div>
    

</section>
<!-- =========================================
     NOS JEUX
========================================= -->

<section class="games-section" id="jeux">

    <!-- tout ton contenu Nos Jeux ici -->

</section>
<section class="tickets-section" id="billets">

    <div class="tickets-header">
        <h2>Nos billets & tarifs</h2>
        <p>Choisissez le billet qui vous convient et préparez votre journée au parc !</p>
    </div>

    <div class="tickets-grid">

        <!-- Billet Enfant -->
        <div class="ticket-card ticket-child">

            <div class="ticket-icon">
                <i class="fa-solid fa-child"></i>
            </div>

            <div class="ticket-content">
                <span class="ticket-label">Pour les enfants</span>

                <h3>Billet Enfant</h3>

                <p>Accès au parc pour les enfants.</p>

                <div class="ticket-price">
                    <strong>70</strong>
                    <span>DH</span>
                </div>

                <a href="#" class="ticket-button">
                    Acheter
                    <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>

        </div>


        <!-- Billet Adulte -->
        <div class="ticket-card ticket-adult">

            <div class="ticket-icon">
                <i class="fa-solid fa-user"></i>
            </div>

            <div class="ticket-content">
                <span class="ticket-label">À partir de 18 ans</span>

                <h3>Billet Adulte</h3>

                <p>Accès au parc pour les adultes.</p>

                <div class="ticket-price">
                    <strong>90</strong>
                    <span>DH</span>
                </div>

                <a href="#" class="ticket-button">
                    Acheter
                    <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>

        </div>


        <!-- Billet Famille -->
        <div class="ticket-card ticket-family">

            <div class="ticket-icon">
                <i class="fa-solid fa-people-roof"></i>
            </div>

            <div class="ticket-content">
                <span class="ticket-label">Pour toute la famille</span>

                <h3>Billet Famille</h3>

                <p>Une formule adaptée aux familles.</p>

                <div class="ticket-price">
                    <strong>280</strong>
                    <span>DH</span>
                </div>

                <a href="#" class="ticket-button">
                    Acheter
                    <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>

        </div>


        <!-- Pass Journée -->
        <div class="ticket-card ticket-pass">

            <div class="ticket-icon">
                <i class="fa-solid fa-ticket"></i>
            </div>

            <div class="ticket-content">
                <span class="ticket-label">Profitez pleinement</span>

                <h3>Pass Journée</h3>

                <p>Profitez d'une journée complète au parc.</p>

                <div class="ticket-price">
                    <strong>150</strong>
                    <span>DH</span>
                </div>

                <a href="#" class="ticket-button">
                    Acheter
                    <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>

        </div>

    </div>

</section>
<!-- =====================================================
     PRÉPAREZ VOTRE JOURNÉE
     ===================================================== -->

<section class="booking-section">

    <div class="booking-container">

        <div class="booking-decoration decoration-yellow"></div>
        <div class="booking-decoration decoration-blue"></div>
        <div class="booking-decoration decoration-pink"></div>

        <div class="booking-icon">
            <i class="fa-regular fa-calendar-days"></i>
        </div>

        <div class="booking-text">
            <h2>Préparez votre journée !</h2>
            <p>Réservez votre visite dès maintenant</p>
        </div>

        <div class="booking-form">

            <div class="booking-field">
                <label>Date de visite</label>

                <div class="booking-input">
                    <i class="fa-regular fa-calendar"></i>
                    <input type="date" value="2026-10-03">
                    <i class="fa-regular fa-calendar-check"></i>
                </div>
            </div>


            <div class="booking-field persons-field">
                <label>Nombre de personnes</label>

                <div class="booking-input persons-input">
                    <i class="fa-regular fa-user"></i>

                    <span>1</span>

                    <button type="button">−</button>
                    <button type="button">+</button>
                </div>
            </div>


            <a href="/parc-jeux/public/?page=login" class="booking-button">
                Réserver maintenant
                <i class="fa-solid fa-arrow-right"></i>
            </a>

        </div>

    </div>

</section>


<!-- =====================================================
     INFOS PRATIQUES
     ===================================================== -->

<section class="info-section" id="infos">

    <div class="info-header">

    

        <h2>Infos pratiques</h2>

       

        <p>Tout ce qu'il faut savoir avant votre visite</p>

    </div>


    <div class="info-grid">

        <!-- HORAIRES -->
        <div class="info-card info-hours">

            <div class="info-icon">
                <i class="fa-regular fa-clock"></i>
            </div>

            <div class="info-content">

                <h3>Horaires d'ouverture</h3>

                <p>
                    Tous les jours de 10h00 à 22h00
                    <br>
                    <small>(Dernière entrée à 21h00)</small>
                </p>

            </div>

        </div>


        <!-- EMPLACEMENT -->
        <div class="info-card info-location">

            <div class="info-icon">
                <i class="fa-solid fa-location-dot"></i>
            </div>

            <div class="info-content">

                <h3>Notre emplacement</h3>

                <p>
                    Parc de Jeux, 123 Avenue du Bonheur
                    <br>
                    Nador, Maroc
                </p>

            </div>

        </div>


        <!-- CONTACT -->
        <div class="info-card info-contact">

            <div class="info-icon">
                <i class="fa-solid fa-phone"></i>
            </div>

            <div class="info-content">

                <h3>Contact</h3>

                <p>
                    +212 6 12 34 56 78
                    <br>
                    contact@parcdejeux.ma
                </p>

            </div>

        </div>


        <!-- SÉCURITÉ -->
        <div class="info-card info-security">

            <div class="info-icon">
                <i class="fa-solid fa-shield-halved"></i>
            </div>

            <div class="info-content">

                <h3>Sécurité</h3>

                <p>
                    Un parc sécurisé avec
                    <br>
                    des équipes qualifiées
                </p>

            </div>

        </div>

    </div>

</section>


<!-- =========================================
     FOOTER
========================================= -->

<footer class="footer">

    <span class="footer-decoration footer-yellow"></span>
    <span class="footer-decoration footer-blue"></span>
    <span class="footer-decoration footer-red"></span>

    <span class="footer-decoration footer-green"></span>
    <span class="footer-decoration footer-pink"></span>

    <div class="footer-container">

        <div class="footer-logo">
            <img src="images/logo.png" alt="Parc de Jeux">
        </div>

        <nav class="footer-nav">

            <a href="#">Accueil</a>
            <span>|</span>

            <a href="#jeux">Jeux</a>
            <span>|</span>

            <a href="#Billets & tarifs"> Billets & tarifs</a>
            <span>|</span>

            <a href="#Infos pratiques">Infos pratiques</a>
            


           

        </nav>

       <div class="footer-social">

    <a href="https://www.facebook.com/" target="_blank" rel="noopener noreferrer" aria-label="Facebook">
        <i class="fa-brands fa-facebook-f"></i>
    </a>

    <a href="https://www.instagram.com/" target="_blank" rel="noopener noreferrer" aria-label="Instagram">
        <i class="fa-brands fa-instagram"></i>
    </a>

    <a href="https://www.youtube.com/" target="_blank" rel="noopener noreferrer" aria-label="YouTube">
        <i class="fa-brands fa-youtube"></i>
    </a>

</div>
    </div>

    
</footer>


</body>

</html>