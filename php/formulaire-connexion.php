<?php
    require 'config.php';
    require 'function.php';

    // Vérifier si l'utilisateur est connecté
    $isConnected = isset($_SESSION['utilisateur_id']);
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
    <title> Connexion </title>

    <!-- Meta description de la page (max 160 caractères) -->
    <meta name="description"
        content="Connectez-vous pour accéder aux prédictions personnalisées de Mélanie, voyante et cartomancienne. Entrez votre email et mot de passe pour découvrir vos prédictions.">
</head>

<body>
    <!-- En-tête de la page -->
    <header>
        <!-- Navigation pour retourner à la page d'accueil -->
        <nav class="lien-page-inscription">

            <!-- Logo maison accueil -->
            <div class="lien-home">
                <img class="back-home" src="../images/maison-accueil.png" alt="Retour à la page d'accueil"
                    onclick="window.location.href='accueil.php'">
                <span class="home"> Accueil </span>
            </div>

            <!-- Titre de la page -->
            <h1 class="title"> Les Prédictions de Mélanie </h1>
        </nav>
    </header>

    <!-- Section du formulaire d'avis -->
    <div class="container-2">

        <form action="connexion.php" method="POST">
            <?php if (isset($_SESSION['successMessages']['inscription'])): ?>
            <span style="display: block; margin: 20px auto; padding: 10px; width: fit-content; border: 2px solid #4CAF50; background: #D4EDDA; color: #155724; border-radius: 5px; text-align: center; font-size: 16px;"> <?php echo $_SESSION['successMessages']['inscription']; ?> </span>
            <?php endif; ?>

            <?php if (isset($_SESSION['successMessages']['password_reset'])): ?>
            <span style="display: block; margin: 20px auto; padding: 10px; width: fit-content; border: 2px solid #4CAF50; background: #D4EDDA; color: #155724; border-radius: 5px; text-align: center; font-size: 16px;"> <?php echo $_SESSION['successMessages']['password_reset']; ?> </span>
            <?php endif; ?>

            <?php if (isset($_SESSION['successMessages']['confirmation'])): ?>
            <span style="display: block; margin: 20px auto; padding: 10px; width: fit-content; border: 2px solid #4CAF50; background: #D4EDDA; color: #155724; border-radius: 5px; text-align: center; font-size: 16px;"> <?php echo $_SESSION['successMessages']['confirmation']; ?> </span>
            <?php endif; ?>

            <?php if (isset($_SESSION['errorMessages']['isLoggedIn'])): ?>
            <span style="display: block; margin: 20px auto; padding: 10px; width: fit-content; border: 2px solid #C62828; background: #FFEBEE; color: #C62828; border-radius: 5px; text-align: center; font-size: 16px;"> <?php echo $_SESSION['errorMessages']['isLoggedIn']; ?> </span>
            <?php endif; ?>

            <?php if (isset($_SESSION['errorMessages']['confirmation'])): ?>
            <span style="display: block; margin: 20px auto; padding: 10px; width: fit-content; border: 2px solid #C62828; background: #FFEBEE; color: #C62828; border-radius: 5px; text-align: center; font-size: 16px;"> <?php echo $_SESSION['errorMessages']['confirmation']; ?> </span>
            <?php endif; ?>

            <h2 >Connexion </h2>

            <!-- Champ pour entrer l'email -->
            <label for="email"> Email <span class="star">*</span> </label>
            <input type="email" id="email" name="email" placeholder="Entrez votre adresse email" value="<?php echo isset($_SESSION['form_data']['email']) ? htmlspecialchars($_SESSION['form_data']['email']) : ''; ?>" required>
            <?php if (isset($_SESSION['errorMessages']['email'])): ?>
            <span style="color: red; font-size: 14px;"> <?php echo $_SESSION['errorMessages']['email']; ?> </span>
            <?php endif; ?>
            <br><br>

            <!-- Champ pour entrer le mot de passe -->
            <label for="mot_de_passe"> Mot de passe <span class="star">*</span> </label>
            <input type="password" id="mot_de_passe" name="mot_de_passe" placeholder="Entrez votre mot de passe" required>
            <?php if (isset($_SESSION['errorMessages']['mot_de_passe'])): ?>
            <span style="color: red; font-size: 14px;"> <?php echo $_SESSION['errorMessages']['mot_de_passe']; ?> </span>
            <?php endif; ?>
            <br><br>
            <!-- Lien pour mot de passe oublié -->
            <a class="forgot-your-password" href="./mot-de-passe-perdu.php"> Mot de passe oublié </a>
            <br><br>

            <!-- Input Se connecter -->
            <input type="submit" name="connexion" value="Se connecter">
            <br><br>
            
            <div class="inscription-google">
                <!-- Lien pour s'inscrire si c'est la première visite -->
                <p> Première visite ? <a href="formulaire-inscription.php"> Inscrivez-vous </a></p>
                <br>

                <!-- <div class="compte-google">
                    <a class="logo-google" href="./google-login.php">
                        <img src="../images/google.png" alt="Logo Google">
                        <span class="google"> Se connecter avec Google </span>
                    </a>
                </div> -->
            </div>
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
            <div class="footer-accueil">
                <ul>
                    <li><a href="accueil.php"> Accueil </a></li>
                    <li><a href="../html/tarif.html"> Tarif </a></li>
                    <li><a href="formulaire-horoscope.php"> Horoscope </a></li>
                </ul>

                <ul>
                    <li><a href="formulaire-inscription.php"> Inscription </a></li>
                    <li><a href="formulaire-connexion.php"> Connexion </a></li>
                    <li><a href="formulaire-contact.php"> Contact </a></li>
                </ul>
            </div>
            
            <div class="footer-works">
                <ul>
                    <h6> Voyance </h6>
                    <li><a href="../html/definition-voyance.html"> Définition </a></li>
                    <li><a href="../html/pratique-voyance.html"> Pratique </a></li>
                </ul>

                <ul>
                    <h6> Cartomancie </h6>
                    <li><a href="../html/definition-cartomancie.html"> Définition </a></li>
                    <li><a href="../html/pratique-cartomancie.html"> Pratique </a></li>
                </ul>

                <ul>
                    <h6> Ressenti Photo </h6>
                    <li><a href="../html/definition-ressenti-photo.html"> Définition </a></li>
                    <li><a href="../html/pratique-ressenti-photo.html"> Pratique </a></li>
                </ul>
            </div>
        </div>

        <div class="copyright-info">
            <p> © 2024 Les Prédictions de Mélanie. Tous droits réservés </p>
            <a href="../html/mentions-legales.html"> Mentions Légales </a>
        </div>
    </footer>

    <script src="../script/menu-hamburger.js"></script>

    <?php
        if (isset($_SESSION['errorMessages'])) {
            unset($_SESSION['errorMessages']);
        }
        if (isset($_SESSION['successMessages'])) {
            unset($_SESSION['successMessages']);
        }
        if (isset($_SESSION['form_data'])) {
        unset($_SESSION['form_data']);
        }
    ?>
</body>

</html>