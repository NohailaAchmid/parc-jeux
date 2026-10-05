```php
<?php
// Les variables $error et $success viennent de AuthController
?>

<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Nouveau mot de passe - Parc de Jeux</title>

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

            <h2>Nouveau mot de passe</h2>

            <p>
                Choisissez votre nouveau mot de passe
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
            action="?page=reset-password"
            method="POST"
        >

            <!-- NOUVEAU MOT DE PASSE -->
            <div class="form-group">

                <label for="password">
                    Nouveau mot de passe
                </label>

                <div class="input-box">

                    <i class="fa-solid fa-lock"></i>

                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="Entrez votre nouveau mot de passe"
                        required
                    >

                    <button
                        type="button"
                        class="show-password"
                        onclick="togglePassword('password', 'eyeIcon1')"
                    >

                        <i
                            class="fa-regular fa-eye"
                            id="eyeIcon1"
                        ></i>

                    </button>

                </div>

            </div>


            <!-- CONFIRMATION -->
            <div class="form-group">

                <label for="password_confirmation">
                    Confirmer le mot de passe
                </label>

                <div class="input-box">

                    <i class="fa-solid fa-lock"></i>

                    <input
                        type="password"
                        id="password_confirmation"
                        name="password_confirmation"
                        placeholder="Confirmez votre nouveau mot de passe"
                        required
                    >

                    <button
                        type="button"
                        class="show-password"
                        onclick="togglePassword('password_confirmation', 'eyeIcon2')"
                    >

                        <i
                            class="fa-regular fa-eye"
                            id="eyeIcon2"
                        ></i>

                    </button>

                </div>

            </div>


            <!-- BOUTON -->
            <button
                type="submit"
                class="login-button"
            >

                <span>
                    Modifier le mot de passe
                </span>

            </button>

        </form>


        <!-- RETOUR -->
        <div class="register-area">

            <a href="?page=login">

                <i class="fa-solid fa-arrow-left"></i>

                Retour à la connexion

            </a>

        </div>

    </div>

</div>


<script>

function togglePassword(inputId, iconId) {

    const password =
        document.getElementById(inputId);

    const icon =
        document.getElementById(iconId);

    if (password.type === "password") {

        password.type = "text";

        icon.classList.remove("fa-eye");
        icon.classList.add("fa-eye-slash");

    } else {

        password.type = "password";

        icon.classList.remove("fa-eye-slash");
        icon.classList.add("fa-eye");
    }
}

</script>

</body>

</html>

