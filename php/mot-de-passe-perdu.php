<?php
    require 'config.php';
    require 'function.php';

    // Vérifier si l'utilisateur est connecté
    $isConnected = isset($_SESSION['utilisateurs_id']);
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
    <title> Mot de passe oublié </title>

    <!-- Meta description de la page (max 160 caractères) -->
    <meta name="description"
        content="Vous avez oublié votre mot de passe ? Pas de problème ! Réinitialisez votre mot de passe en quelques étapes simples en utilisant notre formulaire sécurisé. Recevez un lien de réinitialisation directement dans votre boîte de réception.">
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
            <h1 class="title"> Les prédictions de Mélanie </h1>
        </nav>
    </header>

    <!-- Section du formulaire mot de passe perdu -->
    <div class="container-2">

        <form action="password_requests.php" method="POST">
            <?php if (isset($_SESSION['successMessages']['password_perdu'])): ?>
            <span style="display: block; margin: 20px auto; padding: 10px; width: fit-content; border: 2px solid #4CAF50; background: #D4EDDA; color: #155724; border-radius: 5px; text-align: center; font-size: 16px;"> <?php echo $_SESSION['successMessages']['password_perdu']; ?> </span>
            <?php endif; ?>

            <?php if (isset($_SESSION['errorMessages']['isLoggedIn'])): ?>
            <span style="display: block; margin: 20px auto; padding: 10px; width: fit-content; border: 2px solid #C62828; background: #FFEBEE; color: #C62828; border-radius: 5px; text-align: center; font-size: 16px;"> <?php echo $_SESSION['errorMessages']['isLoggedIn']; ?> </span>
            <?php endif; ?>

            <h2> Mot de passe oublié </h2>

            <!-- Champ pour entrer l'email -->
            <label for="email"> E-mail <span class="star">*</span> </label>
            <input type="email" id="email" name="email" placeholder="votre.email@exemple.com" required>
            <?php if (isset($_SESSION['errorMessages']['email'])): ?>
            <span style="color: red; font-size: 14px;"> <?php echo $_SESSION['errorMessages']['email']; ?> </span>
            <?php endif; ?>
            <br><br>

            <!-- Input Réinitialisation du mot de passe -->
            <input type="submit" name="reinitialisation" value="Mot de passe oublié">

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
    ?>
</body>

</html>