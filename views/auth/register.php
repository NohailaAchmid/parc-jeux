<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Créer un compte - Parc de Jeux</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link
        href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@400;500;600;700;800&family=Nunito:wght@400;500;600;700;800&display=swap"
        rel="stylesheet"
    >

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    >

    <link rel="stylesheet" href="css/style.css">

</head>

<body>

<div class="register-page">

    <div class="register-box">

        <!-- LOGO -->

        <div class="register-logo">

            <img
                src="images/logo.png"
                alt="Parc de Jeux"
            >

        </div>


        <!-- TITRE -->

        <div class="register-header">

            <h1>Créer un compte</h1>

            <p>
                Rejoignez le Parc de Jeux et profitez de nos services.
            </p>

        </div>


        <!-- ERREUR -->

        <?php if (!empty($error)): ?>

            <div class="register-error">

                <i class="fa-solid fa-circle-exclamation"></i>

                <?= htmlspecialchars($error) ?>

            </div>

        <?php endif; ?>


        <!-- FORMULAIRE -->

        <form
            action="?page=register"
            method="POST"
        >

            <!-- PRENOM -->

            <div class="register-form-group">

                <label for="prenom">
                    Prénom
                </label>

                <input
                    type="text"
                    id="prenom"
                    name="prenom"
                    required
                >

            </div>


            <!-- NOM -->

            <div class="register-form-group">

                <label for="nom">
                    Nom
                </label>

                <input
                    type="text"
                    id="nom"
                    name="nom"
                    required
                >

            </div>


            <!-- EMAIL -->

            <div class="register-form-group">

                <label for="email">
                    Email <span>*</span>
                </label>

                <input
                    type="email"
                    id="email"
                    name="email"
                    value="<?= htmlspecialchars($_POST['email'] ?? '') ?>"
                    required
                >

            </div>


            <!-- MOT DE PASSE -->

            <div class="register-form-group">

                <label for="password">
                    Mot de passe <span>*</span>
                </label>

                <input
                    type="password"
                    id="password"
                    name="password"
                    required
                >

            </div>


            <!-- CONFIRMATION -->

            <div class="register-form-group">

                <label for="password_confirmation">
                    Confirmer le mot de passe <span>*</span>
                </label>

                <input
                    type="password"
                    id="password_confirmation"
                    name="password_confirmation"
                    required
                >

            </div>


            <!-- BOUTON -->

            <button
                type="submit"
                class="register-button"
            >

                Créer mon compte

            </button>

        </form>


        <!-- RETOUR CONNEXION -->

        <div class="register-login">

            <span>
                Vous avez déjà un compte ?
            </span>

            <a href="?page=login">
                Se connecter
            </a>

        </div>

    </div>

</div>

</body>

</html>