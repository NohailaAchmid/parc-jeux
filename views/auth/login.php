<?php
// La variable $error vient de AuthController
?>

<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Connexion - Parc de Jeux</title>

    <!-- Google Fonts -->
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

            <h2>Connexion</h2>

            <p>
                Accédez à votre espace du Parc de Jeux
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
        <form action="" method="POST">


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


            <!-- MOT DE PASSE -->
            <div class="form-group">

                <div class="password-label">

                    <label for="password">
                        Mot de passe
                    </label>

                    <a href="?page=forgot-password">
                        Mot de passe oublié ?
                    </a>

                </div>


                <div class="input-box">

                    <i class="fa-solid fa-lock"></i>

                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="Entrez votre mot de passe"
                        required
                    >

                    <button
                        type="button"
                        class="show-password"
                        onclick="togglePassword()"
                    >

                        <i
                            class="fa-regular fa-eye"
                            id="eyeIcon"
                        ></i>

                    </button>

                </div>

            </div>


            <!-- CONNEXION -->
            <button
                type="submit"
                class="login-button"
            >

                <span>
                    Se connecter
                </span>

               

            </button>

        </form>


        <!-- CREATION COMPTE -->
        <div class="register-area">

            <p>
                Vous êtes visiteur ?
            </p>

            <a href="?page=register">
                Créer un compte
                
            </a>

        </div>

    </div>

</div>


<script>

function togglePassword() {

    const password = document.getElementById("password");
    const icon = document.getElementById("eyeIcon");

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