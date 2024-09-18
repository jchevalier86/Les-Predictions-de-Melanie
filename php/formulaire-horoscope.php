<?php
  require './config.php';
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
  <link rel="stylesheet" href="../style/horoscope.css">

  <!-- Favicon pour le site -->
  <link rel="shortcut icon" href="../images/favicon-6.ico" type="image/x-icon">

  <!-- Lien vers les icônes Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

  <!-- Titre de la page (max 60 caractères) -->
  <title> Horoscope </title>

  <!-- Meta description de la page (max 160 caractères) -->
  <meta name="description"
    content="Découvrez votre horoscope du jour ou hebdomadaire et obtenez des prédictions précises pour chaque signe astrologique.">
</head>

<body>
  <!-- En-tête de la page -->
  <header>
    <!-- Ajout du bouton hamburger -->
    <div class="hamburger-container">
      <div class="hamburger" onclick="toggleMenu()">&#9776;</div>
    </div>

    <!-- Navigation principale -->
    <nav class="lien-page-header">

      <!-- Logo maison accueil -->
      <div class="lien-home">
        <img class="back-home" src="../images/maison-accueil.png" alt="Retour à la page d'accueil"
          onclick="window.location.href='./accueil.php'">
        <span class="home"> Accueil </span>
      </div>

      <div class="navbar">
        <!-- Menu déroulant pour Accueil -->
        <div class="dropdown">
          <div class="accueil">
            <button class="dropbtn">
              Accueil
              <i class="fa fa-caret-down"> </i>
            </button>
          </div>
          <div class="dropdown-content">
            <a href="./formulaire-inscription.php"> Inscription </a>
            <a href="./formulaire-connexion.php"> Connexion </a>
          </div>
        </div>

        <!-- Menu déroulant pour Voyance -->
        <div class="dropdown">
          <button class="dropbtn">
            Voyance
            <i class="fa fa-caret-down"> </i>
          </button>
          <div class="dropdown-content">
            <a href="../html/definition-voyance.html"> Définition </a>
            <a href="../html/pratique-voyance.html"> Pratique </a>
          </div>
        </div>

        <!-- Menu déroulant pour Cartomancie -->
        <div class="dropdown">
          <button class="dropbtn">
            Cartomancie
            <i class="fa fa-caret-down"> </i>
          </button>
          <div class="dropdown-content">
            <a href="../html/definition-cartomancie.html"> Définition </a>
            <a href="../html/pratique-cartomancie.html"> Pratique </a>
          </div>
        </div>

        <!-- Menu déroulant pour Ressenti photo -->
        <div class="dropdown">
          <button class="dropbtn">
            Ressenti photo
            <i class="fa fa-caret-down"> </i>
          </button>
          <div class="dropdown-content">
            <a href="../html/definition-ressenti-photo.html"> Définition </a>
            <a href="../html/pratique-ressenti-photo.html"> Pratique </a>
          </div>
        </div>
      </div>

      <!-- Liens directs pour Tarif, Contact, Avis clients et Horoscope -->
      <div class="tarif-contact-avis">
        <a href="../html/tarif.html"> Tarif </a>
        <a href="./formulaire-contact.php"> Contact </a>
        <a href="./formulaire-avis.php"> Avis </a>
        <a href="./formulaire-horoscope.php"> Horoscope </a>
      </div>
    </nav>
  </header>

  <!-- Conteneur principal pour le formulaire d'horoscope -->
  <div class="container">
    <!-- Formulaire pour sélectionner le signe astrologique et obtenir l'horoscope -->
    <form action="./choix-horoscope.php" method="POST">
      <h1> Choisissez le type d'horoscope </h1>

      <label for="type"> Type d'horoscope : </label>
      <select name="type" id="type">
        <option value="" disabled selected> Sélectionnez votre choix </option>
        <option value="jour"> Horoscope du jour </option>
        <option value="hebdomadaire"> Horsocope hebdomadaire </option>
      </select>

      <button type="submit"> Voir l'horoscope </button>
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