<?php
  require 'config.php';

  // Vérifiez si l'utilisateur est connecté
  if (!isLoggedIn()) {
    // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
    header('Location: ./formulaire-inscription.php');
    exit();
}
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
  <link rel="shortcut icon" href="../images/favicon-1.ico" type="image/x-icon">

  <!-- Lien vers les icônes Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

  <!-- Titre de la page (max 60 caractères) -->
  <title> Contact </title>

  <!-- Meta description de la page (max 160 caractères) -->
  <meta name="description"
    content="Contactez Mélanie, voyante et cartomancienne, pour toute question ou demande de prédictions personnalisées. Remplissez le formulaire avec votre nom, prénom, email et message.">
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

    <div class="lien-home-connect">
      <!-- Logo maison accueil -->
      <div class="lien-home">
        <img class="back-home" src="../images/maison-accueil.png" alt="Retour à la page d'accueil"
          onclick="window.location.href='accueil.php'">
        <span class="home"> Accueil </span>
      </div>

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
    </nav>
  </header>

  <!-- Section du formulaire d'avis -->
  <div class="container-2">

    <form action="contact.php" method="POST">
      <?php if (isset($_SESSION['successMessages']['contact'])): ?>
      <span style="display: block; margin: 20px auto; padding: 10px; width: fit-content; border: 2px solid #4CAF50; background: #D4EDDA; color: #155724; border-radius: 5px; text-align: center; font-size: 16px;"> <?php echo $_SESSION['successMessages']['contact']; ?> </span>
      <?php endif; ?>

      <h2> Contact </h2>

      <!-- Champ pour entrer le nom -->
      <label for="nom"> Nom <span class="star">*</span> </label>
      <input type="text" id="nom" name="nom" placeholder="Votre nom" value="<?php echo isset($_SESSION['form_data']['nom']) ? htmlspecialchars($_SESSION['form_data']['nom']) : ''; ?>" required>

      <!-- Champ pour entrer le prénom -->
      <label for="prenom"> Prénom <span class="star">*</span> </label>
      <input type="text" id="prenom" name="prenom" placeholder="Votre prénom" value="<?php echo isset($_SESSION['form_data']['prenom']) ? htmlspecialchars($_SESSION['form_data']['prenom']) : ''; ?>" required>

      <label for="sujet"> Sujet <span class="star">*</span> </label>
      <select name="sujet" id="sujet" required>
        <option value="" disabled selected> Sélectionnez un sujet </option>
        <option value="Question" id="Question"> Question </option>
        <option value="Tirage" id="Tirage"> Tirage </option>
        <option value="Ressenti" id="Ressenti"> Ressenti photo </option>
        <option value="Personnalite" id="Personnalite"> Personnalité </option>
        <option value="Information" id="Information"> Renseignement </option>
      </select>
      <?php if (isset($_SESSION['errorMessages']['sujet'])): ?>
      <span style="color: red; font-size: 14px;"> <?php echo $_SESSION['errorMessages']['sujet']; ?> </span>
      <?php endif; ?>

      <label for="domaine"> Domaine <span class="star">*</span> </label>
      <select name="domaine" id="domaine" required>
        <option value="" disabled selected> Sélectionnez un domaine </option>
        <option value="Avenir" id="Avenir"> Avenir </option>
        <option value="Tirage_general" id="Tirage_general"> Tirage Général </option>
        <option value="Grossesse" id="Grossesse"> Grossesse </option>
        <option value="Demenagement" id="Demenagement"> Déménagement </option>
        <option value="Amour" id="Amour"> Amour </option>
        <option value="Travail" id="Travail"> Travail </option>
        <option value="Permis" id="Permis"> Permis </option>
        <option value="Argent" id="Argent"> Argent </option>
        <option value="General" id="General"> Général </option>
        <option value="Autres" id="Autres"> Autres </option>
      </select>
      <?php if (isset($_SESSION['errorMessages']['domaine'])): ?>
      <span style="color: red; font-size: 14px;"> <?php echo $_SESSION['errorMessages']['domaine']; ?> </span>
      <?php endif; ?>

      <label for="paiement"> Type de paiement <span class="star">*</span> </label>
      <select name="paiement" id="paiement" required>
        <option value="" disabled selected> Sélectionnez un type de paiement </option>
        <option value="Paypal" id="Paypal"> Paypal </option>
        <option value="Virement" id="Virement"> Virement bancaire </option>
      </select>
      <?php if (isset($_SESSION['errorMessages']['paiement'])): ?>
      <span style="color: red; font-size: 14px;"> <?php echo $_SESSION['errorMessages']['paiement']; ?> </span>
      <?php endif; ?>

      <label for="message_envoi"> Message <span class="star">*</span> </label>
      <textarea id="message_envoi" name="message_envoi" rows="5" cols="46"
        placeholder="Entrez votre message ici" required></textarea>
      <br><br>

      <!-- Input Envoyer -->
      <input type="submit" name="contact" value="Envoyer">
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
  <!-- Start of LiveChat (www.livechat.com) code -->
  <script>
    window.__lc = window.__lc || {};
    window.__lc.license = 18291969;
    window.__lc.integration_name = "manual_onboarding";
    window.__lc.product_name = "livechat";
    ; (function (n, t, c) { function i(n) { return e._h ? e._h.apply(null, n) : e._q.push(n) } var e = { _q: [], _h: null, _v: "2.0", on: function () { i(["on", c.call(arguments)]) }, once: function () { i(["once", c.call(arguments)]) }, off: function () { i(["off", c.call(arguments)]) }, get: function () { if (!e._h) throw new Error("[LiveChatWidget] You can't use getters before load."); return i(["get", c.call(arguments)]) }, call: function () { i(["call", c.call(arguments)]) }, init: function () { var n = t.createElement("script"); n.async = !0, n.type = "text/javascript", n.src = "https://cdn.livechatinc.com/tracking.js", t.head.appendChild(n) } }; !n.__lc.asyncInit && e.init(), n.LiveChatWidget = n.LiveChatWidget || e }(window, document, [].slice))
  </script>

  <noscript> <a href="https://www.livechat.com/chat-with/18291969/" rel="nofollow">Chat with us </a>, powered by <a
      href="https://www.livechat.com/?welcome" rel="noopener nofollow" target="_blank"> LiveChat </a> </noscript>
  <!-- End of LiveChat code -->

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