<?php
    // Inclusion des configurations et fonctions communes
    require 'config.php';
    require 'function.php';

    // Inclure les librairies PHPMailer
    require '../libs/PHPMailer/src/PHPMailer.php';
    require '../libs/PHPMailer/src/SMTP.php';
    require '../libs/PHPMailer/src/Exception.php';

    // Inclure la librairie phpdotenv
    require '../vendor/autoload.php';

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    use Dotenv\Dotenv;

    // Charger les variables d'environnement depuis le fichier .env
    $dotenv = Dotenv::createImmutable(__DIR__ . '/../');
    $dotenv->load();

    // Démarrer la session si elle n'est pas déjà démarrée
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    // Ouvrir une connexion à la base de données
    $conn = openConnection();

    // Vérifier si l'utilisateur est déjà connecté
    if (isLoggedIn()) {
        $_SESSION['errorMessages']['isLoggedIn'] = "Vous êtes déjà connecté !";
        header("Location: formulaire-inscription.php");
        exit();
    }

    // Vérification que tous les champs de formulaire nécessaires sont définis
    if (!isset($_POST['nom'], $_POST['prenom'], $_POST['date_naissance'], $_POST['email'], $_POST['phone'], $_POST['mot_de_passe'], $_POST['confirmation_mot_de_passe'])) {
        $_SESSION['errorMessages'] = ["Tous les champs ne sont pas remplis."];
        header("Location: formulaire-inscription.php");
        exit();
    }

    // Récupération et stockage des valeurs du formulaire dans des variables
    $utilisateurs_nom = $_POST['nom'];
    $utilisateurs_prenom = $_POST['prenom'];
    $utilisateurs_date_naissance = $_POST['date_naissance'];
    $utilisateurs_email = $_POST['email'];
    $utilisateurs_phone = $_POST['phone'];
    $utilisateurs_mot_de_passe = $_POST['mot_de_passe'];
    $confirmation_mot_de_passe = $_POST['confirmation_mot_de_passe'];

    $_SESSION['form_data'] = [
        'nom' => $utilisateurs_nom,
        'prenom' => $utilisateurs_prenom,
        'date_naissance' => $utilisateurs_date_naissance,
        'email' => $utilisateurs_email,
        'phone' => $utilisateurs_phone,
    ];

    $errorMessages = [];
    if (!validateAge($utilisateurs_date_naissance)) {
        $errorMessages['age'] = "* Vous devez avoir au moins 18 ans pour vous inscrire.";
    }
    if (!validateEmail($utilisateurs_email)) {
        $errorMessages['email'] = "* Cet utilisateur est déjà inscrit avec cet email.";
    }
    if (!validatePhone($utilisateurs_phone)) {
        $errorMessages['phone'] = "* Le numéro de téléphone n'est pas valide.";
    }
    // Validation de la longueur du mot de passe
    if (strlen($utilisateurs_mot_de_passe) < 8) {
        $errorMessages['longueur_mot_de_passe'] = "* Votre mot de passe doit contenir 8 caractères minimum.";
    }
    if ($utilisateurs_mot_de_passe !== $confirmation_mot_de_passe) {
        $errorMessages['mot_de_passe'] = "* Les mots de passe ne correspondent pas.";
    }

    if (!empty($errorMessages)) {
        $_SESSION['errorMessages'] = $errorMessages;
        header("Location: formulaire-inscription.php");
        exit();
    }

    // Hachage du mot de passe pour des raisons de sécurité
    $utilisateurs_mot_de_passe = password_hash($_POST['mot_de_passe'], PASSWORD_DEFAULT);

    // Génération du token de confirmation
    $confirmation_token = bin2hex(random_bytes(16));

    // Connexion à la base de données
    $conn = openConnection();

    // Vérification si l'email existe déjà dans la base de données
    $sql_check = "SELECT email FROM utilisateurs WHERE email = ?";
    $stmt_check = $conn->prepare($sql_check);
    if ($stmt_check) {
        $stmt_check->bind_param("s", $utilisateurs_email);
        $stmt_check->execute();
        $result_check = $stmt_check->get_result();
        if ($result_check->num_rows > 0) {
            $_SESSION['errorMessages']['email'] = "* Cet utilisateur est déjà inscrit avec cet email.";
            header("Location: formulaire-inscription.php");
            exit();
        } else {
            // Préparation de la requête SQL d'insertion
            $sql = "INSERT INTO utilisateurs (nom, prenom, date_naissance, email, phone, mot_de_passe, confirmation_token) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            if ($stmt) {
                $stmt->bind_param("sssssss", $utilisateurs_nom, $utilisateurs_prenom, $utilisateurs_date_naissance, $utilisateurs_email, $utilisateurs_phone, $utilisateurs_mot_de_passe, $confirmation_token);
                if ($stmt->execute()) {
                    // Stocker le nom et le prénom dans la session
                    $_SESSION['user_name'] = $utilisateurs_nom;
                    $_SESSION['user_prenom'] = $utilisateurs_prenom;

                    // Envoi de l'e-mail de confirmation à l'utilisateur
                    try {
                        $mail = new PHPMailer(true);
                        $mail->isSMTP();
                        $mail->Host = $_ENV['SMTP_HOST'];
                        $mail->SMTPAuth = true;
                        $mail->Username = $_ENV['SMTP_USER'];
                        $mail->Password = $_ENV['SMTP_PASS']; // J'utilise des variables d'environnement dans le fichier .env qui se trouve à la racine de mon projet
                        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                        $mail->Port = $_ENV['SMTP_PORT'];

                        // Désactiver la vérification du certificat SSL pour le développement local
                        $mail->SMTPOptions = [
                            'ssl' => [
                                'verify_peer' => false,
                                'verify_peer_name' => false,
                                'allow_self_signed' => true
                            ]
                        ];

                        // Définir l'encodage en UTF-8
                        $mail->CharSet = 'UTF-8';
                        $mail->Encoding = 'base64'; // Encodage du message

                        // Destinataire
                        $mail->setFrom($_ENV['SMTP_USER'], 'Les Prédictions de Mélanie');
                        $mail->addAddress($utilisateurs_email, $utilisateurs_prenom . ' ' . $utilisateurs_nom);

                        // Contenu de l'e-mail de confirmation
                        $confirmation_link = "http://localhost/les_predictions_de_melanie/php/confirmation.php?token=" . $confirmation_token;
                        $mail->isHTML(true);
                        $mail->Subject = 'Confirmez votre adresse e-mail';
                        $mail->Body    = "Bonjour " . htmlspecialchars($utilisateurs_prenom) . ",<br><br>
                                        Merci pour votre inscription sur notre site. Veuillez confirmer votre adresse e-mail en cliquant sur le lien ci-dessous :<br><br>
                                        <a href=\"" . htmlspecialchars($confirmation_link) . "\">Confirmer mon adresse e-mail</a><br><br>
                                        Si vous n'avez pas demandé cette inscription, ignorez simplement cet e-mail.";
                        $mail->AltBody = "Bonjour " . htmlspecialchars($utilisateurs_prenom) . ",\n\n
                            Merci pour votre inscription sur notre site. Veuillez confirmer votre adresse e-mail en cliquant sur le lien ci-dessous :\n\n
                            " . htmlspecialchars($confirmation_link) . "\n\n
                            Si vous n'avez pas demandé cette inscription, ignorez simplement cet e-mail.";
                        $mail->send();
                    } catch (Exception $e) {
                        // Vous pouvez choisir d'enregistrer l'erreur dans un log
                        error_log("Erreur d'envoi de l'e-mail de confirmation : " . $mail->ErrorInfo);
                    }

                    // Envoi de l'e-mail à l'administrateur
                    try {
                        $mailAdmin = new PHPMailer(true);
                        $mailAdmin->isSMTP();
                        $mailAdmin->Host = $_ENV['SMTP_HOST'];
                        $mailAdmin->SMTPAuth = true;
                        $mailAdmin->Username = $_ENV['SMTP_USER'];
                        $mailAdmin->Password = $_ENV['SMTP_PASS']; // J'utilise des variables d'environnement dans le fichier .env qui se trouve à la racine de mon projet
                        $mailAdmin->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                        $mailAdmin->Port = $_ENV['SMTP_PORT'];

                        // Désactiver la vérification du certificat SSL pour le développement local
                        $mailAdmin->SMTPOptions = [
                            'ssl' => [
                                'verify_peer' => false,
                                'verify_peer_name' => false,
                                'allow_self_signed' => true
                            ]
                        ];

                        // Définir l'encodage en UTF-8
                        $mailAdmin->CharSet = 'UTF-8';
                        $mailAdmin->Encoding = 'base64'; // Encodage du message

                        // Destinataire
                        $mailAdmin->setFrom($_ENV['SMTP_USER'], 'Les Prédictions de Mélanie');
                        $mailAdmin->addAddress($_ENV['SMTP_USER'], 'Les Prédictions de Mélanie');

                        // Contenu de l'e-mail
                        $mailAdmin->isHTML(true);
                        $mailAdmin->Subject = 'Nouvelle inscription sur le site';
                        $mailAdmin->Body    = "Un nouvel utilisateur s'est inscrit sur le site.<br><br>
                                            <strong>Nom : </strong> " . htmlspecialchars($utilisateurs_nom) . "<br>
                                            <strong>Prénom : </strong> " . htmlspecialchars($utilisateurs_prenom) . "<br>
                                            <strong>Email : </strong> " . htmlspecialchars($utilisateurs_email) . "<br>
                                            <strong>Téléphone : </strong> " . htmlspecialchars($utilisateurs_phone) . "<br>";
                        $mailAdmin->AltBody = "Un nouvel utilisateur s'est inscrit sur le site.\n\n
                            Nom : " . htmlspecialchars($utilisateurs_nom) . "\n
                            Prénom : " . htmlspecialchars($utilisateurs_prenom) . "\n
                            Email : " . htmlspecialchars($utilisateurs_email) . "\n
                            Téléphone :\n" . htmlspecialchars($utilisateurs_phone);
                        $mailAdmin->send();
                    } catch (Exception $e) {
                        // Vous pouvez choisir d'enregistrer l'erreur dans un log
                        error_log("Erreur d'envoi de l'e-mail à l'administrateur : " . $mailAdmin->ErrorInfo);
                    }

                    // Redirection avec un message de succès
                    $_SESSION['successMessages']['inscription'] = "Inscription réussie ! Veuillez vérifier votre e-mail pour confirmer votre adresse.";
                    header("Location: formulaire-connexion.php");
                    exit();
                } else {
                    $_SESSION['errorMessages'] = ["Erreur lors de l'insertion des données : " . $stmt->error];
                    header("Location: formulaire-inscription.php");
                    exit();
                }
                $stmt->close();
            } else {
                $_SESSION['errorMessages'] = ["Erreur de préparation de la requête : " . $conn->error];
                header("Location: formulaire-inscription.php");
                exit();
            }
        }
        $stmt_check->close();
    } else {
        $_SESSION['errorMessages'] = ["Erreur de préparation de la requête de vérification : " . $conn->error];
        header("Location: formulaire-inscription.php");
        exit();
    }

    closeConnection($conn);
?>
