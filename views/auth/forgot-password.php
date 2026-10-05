
<?php
// La variable $error vient de AuthController
?>

<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Mot de passe oublié - Parc de Jeux</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link
        rel="preconnect"
        href="https://fonts.gstatic.com"
        crossorigin
    >

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

<div class="login-page">

    <div class="login-box">

        <!-- LOGO -->
        <div class="login-logo-box">

            <img
                src="images/logo.png"
                alt="Parc de Jeux"
            >

        </div>


        <!-- TITRE -->
        <div class="login-header">

            <h2>Mot de passe oublié ?</h2>

            <p>
                Entrez votre adresse email pour continuer
            </p>

        </div>


        <!-- ERREUR -->
        <?php if (!empty($error)): ?>

            <div class="login-error">

                <i class="fa-solid fa-circle-exclamation"></i>

                <?= htmlspecialchars($error) ?>

            </div>

        <?php endif; ?>


        <!-- FORMULAIRE -->
        <form
            action="?page=forgot-password"
            method="POST"
        >

            <!-- EMAIL -->
            <div class="form-group">

                <label for="email">
                    Adresse email
                </label>

                <div class="input-box">

                    <i class="fa-regular fa-envelope"></i>

                    <input
                        type="email"
                        id="email"
                        name="email"
                        placeholder="Entrez votre adresse email"
                        required
                    >

                </div>

            </div>


            <!-- BOUTON -->
            <button
                type="submit"
                class="login-button"
            >

                <span>
                    Continuer
                </span>

            </button>

        </form>


        <!-- RETOUR -->
        <div class="register-area">

            <p>
                Vous vous souvenez de votre mot de passe ?
            </p>

            <a href="?page=login">

                

                Retour à la connexion

            </a>

        </div>

    </div>

</div>

</body>

</html>

