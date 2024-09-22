<?php
  require 'config.php';
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
  <link rel="stylesheet" href="../style/accueil.css">

  <!-- Favicon pour le site -->
  <link rel="shortcut icon" href="../images/favicon-1.ico" type="image/x-icon">

  <!-- Lien vers les icônes Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

  <!-- Titre de la page (max 60 caractères) -->
  <title> Les prédictions de Mélanie </title>

  <!-- Meta description de la page (max 160 caractères) -->
  <meta name="description"
    content="Explorez les prédictions de Mélanie, cartomancienne et voyante passionnée. Avec des années d'expérience, j'offre des guidances claires et authentiques en amour, travail, argent, et plus encore.">
</head>

<body>
    <header>
      <div class="photo-header">
        <img class="photo-logo" src="../images/melanie-voyante-2.jpg" alt="Logo Mélanie Voyante">
      </div>

      <!-- Ajout du bouton hamburger -->
      <div class="hamburger-container">
        <div class="hamburger" onclick="toggleMenu()"> &#9776; </div>
      </div>

      <!-- Navigation principale -->
      <nav class="lien-page-header">

      <?php if (isset($_SESSION['user_id'])): ?>
      <!-- Icône de déconnexion avec un lien vers la page de déconnexion -->
      <div class="lien-deconnect">
        <img class="icone-connect" src="../images/deconnexion.png" alt="Aller à la page accueil"
          onclick="window.location.href='deconnexion.php'">
        <span class="deconnect"> Déconnexion </span>
      </div>
      <?php else: ?>
      <!-- Icône de connexion avec un lien vers la page de connexion -->
      <div class="lien-connect">
        <img class="icone-connect" src="../images/connexion.png" alt="Aller à la page de connexion"
          onclick="window.location.href='formulaire-connexion.php'">
        <span class="connect"> Connexion </span>
      </div>
      <?php endif; ?>

        <div class="navbar">

          <!-- Menu déroulant pour Accueil -->
          <div class="dropdown">
            <button class="dropbtn">
              Accueil
              <i class="fa fa-caret-down"> </i>
            </button>
            <div class="dropdown-content">
              <a href="formulaire-inscription.php"> Inscription </a>
              <a href="formulaire-connexion.php"> Connexion </a>
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
            <a href="formulaire-contact.php"> Contact </a>
            <a href="formulaire-avis.php"> Avis </a>
            <a href="formulaire-horoscope.php"> Horoscope </a>
          </div>
        </div>
      </nav>
    </header>

    <!-- Section d'introduction -->
    <section class="intro">
      <h1>Les Prédictions de Mélanie</h1>
      <hr class="separator">
      <h2>Voyance et Cartomancie</h2>

      <?php if (isset($_SESSION['successMessages']['connexion'])): ?>
      <span style="display: block; margin: 20px auto; padding: 10px; width: fit-content; border: 2px solid #4CAF50; background: #D4EDDA; color: #155724; border-radius: 5px; text-align: center; font-size: 16px;"> <?php echo $_SESSION['successMessages']['connexion']; ?> </span>
      <?php endif; ?>

      <!-- Section de présentation -->
      <div class="section-presentation">
        <div class="section1-col1">
          <!-- Texte de présentation -->
          <div class="presentation">
            <span class="presentation-span"> Bonjour et bienvenue ! </span>
            <div class="presentation-text-content">
              <p>
                Je me présente Mélanie, je suis
                <span class="costum-word"> cartomancienne</span> et
                <span class="costum-word">voyante</span> passionnée, exerçant
                depuis septembre 2019. Mon parcours dans le monde mystique et
                spirituel m’a permis d’affiner mes dons et d’acquérir une
                profonde compréhension des cartes et de l’intuition. À travers
                mes consultations, je m’engage à vous offrir des guidances
                claires, empathiques et authentiques pour vous aider à naviguer
                à travers les défis de la vie et à découvrir votre plein
                potentiel. Que vous soyez en quête de réponses, de conseils ou
                de soutiens, je suis là pour vous accompagner sur votre chemin.
              </p>
            </div>

            <!-- Liste des domaines de pratique -->
            <div class="liste-domaines">
              <span> Les domaines que je pratique : </span>
              <div class="liste-domaines-conteneur">
                <ul class="liste-domaines-list-1">
                  <li> Avenir ⚛️ </li>
                  <li> Tirage Général 🌕 </li>
                  <li> Grossesse 🤰 </li>
                  <li> Déménagement 🏠 </li>
                </ul>
                <ul class="liste-domaines-list-2">
                  <li> Amour 🩷 </li>
                  <li> Travail 🛠️ </li>
                  <li> Permis 🚗 </li>
                  <li> Argent 💰 </li>
                </ul>
              </div>
            </div>
          </div>
        </div>

        <!-- Photo dans la section de présentation -->
        <div class="photo">
          <img class="photo-body" src="../images/melanie-cartomancienne.jpeg" alt="Mélanie Cartomancienne">
        </div>
      </div>
    </section>

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

  <script src="../script/script.js"></script>
  <script src="../script/menu-hamburger.js"></script>

</body>

<?php
    if (isset($_SESSION['errorMessages'])) {
      unset($_SESSION['errorMessages']);
    }
    if (isset($_SESSION['successMessages'])) {
        unset($_SESSION['successMessages']);
    }
?>

</html>