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
  <link rel="stylesheet" href="../style/horoscope-jour-hebdo.css">
  <link rel="stylesheet" href="../style/horoscope-hebdo.css">

  <!-- Favicon pour le site -->
  <link rel="shortcut icon" href="../images/favicon-6.ico" type="image/x-icon">

  <!-- Lien vers les icônes Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

  <!-- Titre de la page (max 60 caractères) -->
  <title> Horoscope Hebdomadaire </title>

  <!-- Meta description de la page (max 160 caractères) -->
  <meta name="description"
    content="Découvrez votre horoscope hebdomadaire personnalisé et obtenez des prédictions précises pour chaque signe astrologique.">
</head>

<body>
  <!-- En-tête de la page -->
  <header>
    <!-- Ajout du bouton hamburger -->
    <div class="hamburger-container">
      <div class="hamburger" onclick="toggleMenu()"> &#9776; </div>
    </div>

    <!-- Navigation principale -->
    <nav class="lien-page-header">

      <!-- Logo maison accueil -->
      <div class="lien-home">
        <img class="back-home" src="../images/maison-accueil.png" alt="Retour à la page d'accueil"
          onclick="window.location.href='accueil.php'">
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
    </header>

    <div class="body-image">
      <?php
        // URL de l'API pour les horoscopes hebdomadaires
        $url = "https://kayoo123.github.io/astroo-api/hebdomadaire.json";

        // Initialiser une session cURL
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Exécuter la session cURL et récupérer la réponse
        $response = curl_exec($ch);
        curl_close($ch);

        // Vérifier si la réponse n'est pas vide et si cURL a réussi
        if ($response === false || $response === null) {
            echo "Erreur lors de la récupération des données de l'API.";
            exit();
        }

        // Décoder la réponse JSON en un tableau associatif
        $data = json_decode($response, true);

        // Vérifier si le JSON a été correctement décodé
        if ($data === null) {
            echo "Erreur lors du décodage des données JSON.";
            exit();
        }

        // Vérifier si la clé 'date' existe dans les données
        if (isset($data['date']) && !empty($data['date'])) {
            $dateString = $data['date'];

            // Créer un objet DateTime à partir de la date au format YYYY-MM-DD
            $date = DateTime::createFromFormat('Y-m-d', $dateString);

            // Vérifier si la création de l'objet DateTime a réussi
            if ($date !== false) {
                // Reformater la date en JJ/MM/YYYY
                $formattedDate = $date->format('d/m/Y');
            } else {
                echo "Erreur lors de la création de l'objet DateTime.";
                exit();
            }
        } else {
            echo "Date non disponible dans les données de l'API.";
            exit();
        }

        // Extraire les horoscopes
        $horoscopes = array_diff_key($data, ['date' => '']);

        // Tableau de traduction des semaines
        $index = [
            0 => "",
            1 => "Semaine 1 :",
            2 => "Semaine 2 :",
            3 => "Semaine 3 :"
            // Ajouter d'autres traductions si nécessaire
        ];

        echo "<h1> Horoscope Hebdomadaire du $formattedDate </h1>";

        // Afficher les horoscopes pour tous les signes
        foreach ($horoscopes as $signe => $descriptionArray) {
            echo "<div class='horoscope'>";
            echo "<h2> $signe </h2>";

            // Vérifier si $descriptionArray est un tableau
            if (is_array($descriptionArray)) {
                // Parcourir les descriptions pour le signe actuel
                foreach ($descriptionArray as $key => $description) {
                    // Utiliser la traduction si disponible, sinon afficher "Autre"
                    $categorie = isset($index[$key]) ? $index[$key] : "Autre";
                    echo "<br>";
                    echo "<div class='categorie'>";
                    echo "<p> $categorie </p>";
                    echo "</div>";
                    echo "<br>";
                    echo "<div class='description-hebdo'>";
                    echo "<p> $description </p>";
                    echo "</div>";
                }
            } else {
                echo "<p> Aucune description disponible pour $signe. </p>";
            }

            echo "</div>";
        }
      ?>
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
</body>

</html>
