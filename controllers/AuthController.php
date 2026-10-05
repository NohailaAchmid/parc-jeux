
<?php

require_once __DIR__ . '/../models/User.php';

class AuthController
{
    /*
    |--------------------------------------------------------------------------
    | CONNEXION
    |--------------------------------------------------------------------------
    */
    public function login()
    {
        $error = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';

            if (empty($email) || empty($password)) {

                $error = "Veuillez remplir tous les champs.";

            } else {

                $userModel = new User();

                $user = $userModel->findByEmail($email);

                if (
                    $user &&
                    password_verify(
                        $password,
                        $user['mot_de_passe']
                    )
                ) {

                    if (session_status() === PHP_SESSION_NONE) {
                        session_start();
                    }

                    $_SESSION['user_id'] =
                        $user['id_utilisateur'];

                    $_SESSION['user_nom'] =
                        $user['nom'];

                    $_SESSION['user_prenom'] =
                        $user['prenom'];

                    $_SESSION['user_email'] =
                        $user['email'];

                    $_SESSION['role'] =
                        $user['role'];


                    switch ($user['role']) {

                        case 'admin':

                            header(
                                'Location: /parc-jeux/public/index.php?page=dashboard'
                            );

                            exit;


                        case 'responsable':

                            header(
                                'Location: /parc-jeux/public/index.php?page=responsable'
                            );

                            exit;


                        case 'agent_vente':

                            header(
                                'Location: /parc-jeux/public/index.php?page=ventes'
                            );

                            exit;


                        case 'client':

                            header(
                                'Location: /parc-jeux/public/index.php?page=client'
                            );

                            exit;


                        default:

                            $error =
                                "Rôle utilisateur inconnu.";
                    }

                } else {

                    $error =
                        "Email ou mot de passe incorrect.";
                }
            }
        }

        require __DIR__ .
            '/../views/auth/login.php';
    }


    /*
    |--------------------------------------------------------------------------
    | INSCRIPTION CLIENT
    |--------------------------------------------------------------------------
    */
    public function register()
    {
        $error = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $prenom =
                trim($_POST['prenom'] ?? '');

            $nom =
                trim($_POST['nom'] ?? '');

            $email =
                trim($_POST['email'] ?? '');

            $password =
                $_POST['password'] ?? '';

            $passwordConfirmation =
                $_POST['password_confirmation'] ?? '';


            if (
                empty($prenom) ||
                empty($nom) ||
                empty($email) ||
                empty($password) ||
                empty($passwordConfirmation)
            ) {

                $error =
                    "Veuillez remplir tous les champs.";

            }

            elseif (
                !filter_var(
                    $email,
                    FILTER_VALIDATE_EMAIL
                )
            ) {

                $error =
                    "Veuillez saisir une adresse email valide.";

            }

            elseif (
                !preg_match(
                    '/^[\p{L}\s-]+$/u',
                    $prenom
                )
            ) {

                $error =
                    "Le prénom ne doit contenir que des lettres.";

            }

            elseif (
                !preg_match(
                    '/^[\p{L}\s-]+$/u',
                    $nom
                )
            ) {

                $error =
                    "Le nom ne doit contenir que des lettres.";

            }

            elseif (strlen($password) < 6) {

                $error =
                    "Le mot de passe doit contenir au moins 6 caractères.";

            }

            elseif (
                $password !== $passwordConfirmation
            ) {

                $error =
                    "Les mots de passe ne correspondent pas.";

            }

            else {

                $userModel =
                    new User();

                $existingUser =
                    $userModel->findByEmail($email);


                if ($existingUser) {

                    $error =
                        "Cette adresse email est déjà utilisée.";

                } else {

                    $passwordHash =
                        password_hash(
                            $password,
                            PASSWORD_DEFAULT
                        );


                    try {

                        $userModel->createClient(
                            $nom,
                            $prenom,
                            $email,
                            $passwordHash
                        );


                        header(
                            'Location: ?page=login&registered=1'
                        );

                        exit;

                    } catch (PDOException $e) {

                        $error =
                            "Une erreur est survenue lors de la création du compte.";
                    }
                }
            }
        }


        require __DIR__ .
            '/../views/auth/register.php';
    }


    /*
    |--------------------------------------------------------------------------
    | MOT DE PASSE OUBLIÉ
    |--------------------------------------------------------------------------
    */
    public function forgotPassword()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $error = null;


        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $email =
                trim($_POST['email'] ?? '');


            /*
             * Vérifier que l'email est rempli
             */
            if (empty($email)) {

                $error =
                    "Veuillez saisir votre adresse email.";
            }


            /*
             * Vérifier le format de l'email
             */
            elseif (
                !filter_var(
                    $email,
                    FILTER_VALIDATE_EMAIL
                )
            ) {

                $error =
                    "Veuillez saisir une adresse email valide.";
            }


            else {

                $userModel =
                    new User();

                $user =
                    $userModel->findByEmail($email);


                /*
                 * Vérifier que le compte existe
                 */
                if (!$user) {

                    $error =
                        "Aucun compte ne correspond à cette adresse email.";
                }


                /*
                 * Vérifier que c'est un client
                 */
                elseif ($user['role'] !== 'client') {

                    $error =
                        "La récupération du mot de passe est réservée aux clients.";
                }


                /*
                 * Client trouvé
                 */
                else {

                    /*
                     * Sauvegarder l'email du client
                     * temporairement dans la session.
                     */
                    $_SESSION['reset_email'] =
                        $user['email'];


                    /*
                     * Envoyer le client vers
                     * la page de nouveau mot de passe.
                     */
                    header(
                        'Location: ?page=reset-password'
                    );

                    exit;
                }
            }
        }


        require __DIR__ .
            '/../views/auth/forgot-password.php';
    }


    /*
    |--------------------------------------------------------------------------
    | NOUVEAU MOT DE PASSE
    |--------------------------------------------------------------------------
    */
    public function resetPassword()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $error = null;


        /*
         * Vérifier qu'un email de récupération
         * existe dans la session.
         */
        if (empty($_SESSION['reset_email'])) {

            header(
                'Location: ?page=forgot-password'
            );

            exit;
        }


        /*
         * Traitement du formulaire
         */
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $password =
                $_POST['password'] ?? '';

            $passwordConfirmation =
                $_POST['password_confirmation'] ?? '';


            /*
             * Vérifier les champs
             */
            if (
                empty($password) ||
                empty($passwordConfirmation)
            ) {

                $error =
                    "Veuillez remplir tous les champs.";
            }


            /*
             * Vérifier la longueur
             */
            elseif (strlen($password) < 6) {

                $error =
                    "Le mot de passe doit contenir au moins 6 caractères.";
            }


            /*
             * Vérifier la confirmation
             */
            elseif (
                $password !== $passwordConfirmation
            ) {

                $error =
                    "Les mots de passe ne correspondent pas.";
            }


            else {

                $userModel =
                    new User();


                /*
                 * Récupérer le client
                 */
                $user =
                    $userModel->findByEmail(
                        $_SESSION['reset_email']
                    );


                /*
                 * Vérifier que le compte existe
                 * et que c'est bien un client.
                 */
                if (
                    !$user ||
                    $user['role'] !== 'client'
                ) {

                    unset($_SESSION['reset_email']);

                    $error =
                        "Compte client introuvable.";
                }


                else {

                    /*
                     * Hasher le nouveau mot de passe
                     */
                    $passwordHash =
                        password_hash(
                            $password,
                            PASSWORD_DEFAULT
                        );


                    /*
                     * Modifier le mot de passe
                     */
                    $db =
                        Database::getConnection();


                    $sql = "
                        UPDATE utilisateur
                        SET mot_de_passe = :mot_de_passe
                        WHERE email = :email
                        AND role = 'client'
                    ";


                    $stmt =
                        $db->prepare($sql);


                    $stmt->execute([
                        ':mot_de_passe' =>
                            $passwordHash,

                        ':email' =>
                            $_SESSION['reset_email']
                    ]);


                    /*
                     * Supprimer l'email de récupération
                     */
                    unset($_SESSION['reset_email']);


                    /*
                     * Retour à la connexion
                     */
                    header(
                        'Location: ?page=login&reset=1'
                    );

                    exit;
                }
            }
        }


        require __DIR__ .
            '/../views/auth/reset-password.php';
    }
}

