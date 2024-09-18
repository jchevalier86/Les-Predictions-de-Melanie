<?php
    require './config.php'; // Inclure le fichier de connexion
    require './function.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $token = $_POST['token'];
        $newPassword = $_POST['mot_de_passe'];
        $confirmation_mot_de_passe = $_POST['confirmation_mot_de_passe'];

        if ($newPassword !== $confirmation_mot_de_passe) {
            $_SESSION['errorMessages']['mot_de_passe'] = "* Les mots de passe ne correspondent pas.";
            header("Location: reset_password.php?token=$token");
            exit();
        }
        if (strlen($newPassword) < 8 || strlen($confirmation_mot_de_passe) < 8) {
            $_SESSION['errorMessages']['longueur_mot_de_passe'] = "* Votre mot de passe doit contenir 8 caractères minimum.";
            header("Location: reset_password.php?token=$token");
            exit();
        }

        $newPassword = password_hash($_POST['mot_de_passe'], PASSWORD_BCRYPT);

        $conn = openConnection(); // Ouvrir la connexion

        // Rechercher le jeton dans la base de données et vérifier qu'il n'est pas expiré ou utilisé
        $stmt = $conn->prepare("SELECT user_id FROM password_resets WHERE token = ? AND used = 0 AND expiration_date > NOW()");
        if ($stmt) {
            $stmt->bind_param("s", $token);
            $stmt->execute();
            $result = $stmt->get_result();
            $resetRequest = $result->fetch_assoc();

            if ($resetRequest) {
                // Mettre à jour le mot de passe de l'utilisateur
                $stmt = $conn->prepare("UPDATE utilisateurs SET mot_de_passe = ? WHERE user_id = ?");
                if ($stmt) {
                    $stmt->bind_param("si", $newPassword, $resetRequest['user_id']);
                    $stmt->execute();

                    // Marquer le token comme utilisé après réinitialisation
                    $stmt = $conn->prepare("UPDATE password_resets SET used = 1 WHERE token = ?");
                    if ($stmt) {
                        $stmt->bind_param("s", $token);
                        $stmt->execute();
                        $_SESSION['successMessages']['password_reset'] = "Votre mot de passe a été réinitialisé avec succès !";
                        header ('Location: ./formulaire-connexion.php');
                        exit();
                    } else {
                        echo "Erreur de préparation de la requête : " . $conn->error;
                    }
                } else {
                    echo "Erreur de préparation de la requête : " . $conn->error;
                }
            } else {
                echo '<script>alert("Jeton de réinitialisation invalide ou expiré.");</script>';
            }
            $stmt->close();
        } else {
            echo "Erreur de préparation de la requête : " . $conn->error;
        }

        closeConnection($conn); // Fermer la connexion
    } elseif (isset($_GET['token'])) {
        $token = $_GET['token'];
        // Afficher le formulaire de réinitialisation
?>

<!DOCTYPE html>
<html lang="fr">

    <head>
        <!-- La balise meta charset spécifie le jeu de caractères utilisé. Utiliser UTF-8 est recommandé pour une compatibilité maximale -->
        <meta charset="UTF-8">

        <!-- La balise meta viewport contrôle la mise en page sur les appareils mobiles et est essentielle pour un design responsive -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Liens vers les feuilles de style CSS -->
        <link rel="stylesheet" href="../style/reset.css">
        <link rel="stylesheet" href="../style/style.css">
        <link rel="stylesheet" href="../style/inscription-connexion-contact.css">

        <!-- Favicon pour le site -->
        <link rel="shortcut icon" href="../images/favicon-5.ico" type="image/x-icon">

        <!-- Lien vers les icônes Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

        <!-- Titre de la page (max 60 caractères) -->
        <title> Réinitialiser le mot de passe </title>

        <!-- Meta description de la page (max 160 caractères) -->
        <meta name="description" content="Réinitialisez votre mot de passe après avoir reçu un email avec un token. Entrez votre nouveau mot de passe et confirmez-le pour accéder à nouveau à votre compte Les Prédictions de Mélanie.">
    </head>
    
<body>
    <!-- En-tête de la page -->
    <header>
        <!-- Navigation pour retourner à la page d'accueil -->
        <nav class="lien-page-inscription">

            <!-- Logo maison accueil -->
            <div class="lien-home">
                <img class="back-home" src="../images/maison-accueil.png" alt="Retour à la page d'accueil" onclick="window.location.href='./accueil.php'">
                <span class="home"> Accueil </span>
            </div>

            <!-- Titre de la page -->
            <h1 class="title"> Les prédictions de Mélanie </h1>
            
        </nav>
    </header>

    <!-- Section du formulaire réinitialisation du mot de passe -->
    <div class="container-2">

        <form action="./reset_password.php" method="POST">
            <h2>Réinitialiser le mot de passe</h2>
            
            <!-- Ce champ caché inclut un token CSRF (Cross-Site Request Forgery) dans le formulaire. Ce token est généré par le serveur et inclus dans le formulaire pour protéger contre les attaques CSRF. Lors de la soumission du formulaire, le serveur vérifie ce token pour s'assurer que la requête provient de l'utilisateur légitime et non d'un attaquant. -->
            <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>">
            
            <!-- Champ pour entrer le nouveau mot de passe -->
            <label for="mot_de_passe"> Nouveau mot de passe <span class="star">*</span> </label>
            <input type="password" id="mot_de_passe" name="mot_de_passe" placeholder="Créer votre nouveau mot de passe" required>
            <?php if (isset($_SESSION['errorMessages']['longueur_mot_de_passe'])): ?>
            <span style="color: red; font-size: 14px;"> <?php echo $_SESSION['errorMessages']['longueur_mot_de_passe']; ?> </span>
            <?php endif; ?>
            <?php if (isset($_SESSION['errorMessages']['mot_de_passe'])): ?>
            <span style="color: red; font-size: 14px;"> <?php echo $_SESSION['errorMessages']['mot_de_passe']; ?> </span>
            <?php endif; ?>
            <br><br>
            
            <!-- Champ de confirmation du mot de passe -->
            <label for="confirmation_mot_de_passe"> Confirmation du mot de passe <span class="star">*</span> </label>
            <input type="password" id="confirmation_mot_de_passe" name="confirmation_mot_de_passe" placeholder="Confirmer votre nouveau mot de passe" required>
            
            <!-- Input Réinitialisation du mot de passe -->
            <input type="submit" name="reinitialisation" value="Réinitialiser votre mot de passe">

        </form>
    </div>
    
    <!-- Pied de page avec des liens vers les différentes pages du site -->
    <footer class="lien-page-footer">
        
        <div class="nav-links-1">
            <div class="social-link">
                <!-- Liens vers les réseaux sociaux et PayPal -->
                <a class="logo-footer" href="https://www.instagram.com/melanievoyante/" target="_blank">
                    <img src="../images/instagram.png" alt="Logo Instagram">
                    <span class="insta-paypal-mail"> Suivez-moi sur Instagram </span>
                </a>
            </div>
            
            <div class="social-link">
                <a class="logo-footer" href="https://www.paypal.me/maupin20" target="_blank">
                    <img src="../images/paypal.png" alt="Logo Paypal">
                    <span class="insta-paypal-mail"> PayPal </span>
                </a>
            </div>

            <!-- Lien mailto pour contacter par email -->
            <div class="social-link">
                <a class="logo-footer " href="mailto:les-predictions-de-melanie@outlook.com" target="_blank">
                    <img src="../images/gmail.png" alt="Logo Gmail">
                    <span class="insta-paypal-mail"> Contactez-moi par mail </span>
                </a>
            </div>
        </div>

        <div class="nav-links-2">
            <ul>
                <li><a href="./accueil.php"> Accueil </a></li>
                <li><a href="./formulaire-inscription.php"> Inscription </a></li>
                <li><a href="./formulaire-connexion.php"> Connexion </a></li>
            </ul>

            <ul>
                <li><a href="../html/definition-voyance.html"> Définition voyance </a></li>
                <li><a href="../html/definition-cartomancie.html"> Définition cartomancie </a></li>
                <li><a href="../html/definition-ressenti-photo.html"> Définition ressenti photo </a></li>
            </ul>

            <ul>
                <li><a href="../html/pratique-voyance.html"> Pratique voyance </a></li>
                <li><a href="../html/pratique-cartomancie.html"> Pratique cartomancie </a></li>
                <li><a href="../html/pratique-ressenti-photo.html"> Pratique ressenti photo </a></li>
            </ul>

            <ul>
                <li><a href="./formulaire-avis.php"> Avis </a></li>
                <li><a href="./formulaire-contact.php"> Contact </a></li>
                <li><a href="./formulaire-horoscope.php"> Horoscope </a></li>
            </ul>
        </div>

        <div class="copyright-info">
            <p> © 2024 Les Prédictions de Mélanie. Tous droits réservés </p>
            <a href="../html/mentions-legales.html"> Mentions Légales </a>
        </div>
    </footer>
    
    <script src="../script/menu-hamburger.js"></script>
</body>

</html>

<?php
} else {
    echo '<script>alert("Aucun jeton fourni.");</script>';
}
?>
