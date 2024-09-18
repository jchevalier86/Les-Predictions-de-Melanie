<?php
    require './config.php';
    require './function.php';

    // Démarrer la session si elle n'est pas déjà démarrée
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    // Ouvrir une connexion à la base de données
    $conn = openConnection();

    // Vérifier que le token est présent dans l'URL
    if (isset($_GET['token'])) {
        $token = $_GET['token'];

        // Préparation de la requête SQL pour vérifier le token
        $sql = "SELECT user_id FROM utilisateurs WHERE confirmation_token = ?";
        $stmt = $conn->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("s", $token);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows === 1) {
                // Activer le compte en réinitialisant le token de confirmation
                $sql_update = "UPDATE utilisateurs SET confirmation_token = NULL, actif = 1 WHERE confirmation_token = ?";
                $stmt_update = $conn->prepare($sql_update);
                if ($stmt_update) {
                    $stmt_update->bind_param("s", $token);
                    if ($stmt_update->execute()) {
                        $_SESSION['successMessages']['confirmation'] = "Votre adresse e-mail a été confirmée avec succès.";
                        header("Location: ./formulaire-connexion.php");
                        exit();
                    } else {
                        $_SESSION['errorMessages']['confirmation'] = "Erreur lors de la confirmation de l'adresse e-mail.";
                        header("Location: ./formulaire-connexion.php");
                        exit();
                    }
                    $stmt_update->close();
                } else {
                    $_SESSION['errorMessages']['confirmation'] = "Erreur de préparation de la requête de confirmation : " . $conn->error;
                    header("Location: ./formulaire-connexion.php");
                    exit();
                }
            } else {
                $_SESSION['errorMessages']['confirmation'] = "Token de confirmation invalide.";
                header("Location: ./formulaire-connexion.php");
                exit();
            }
            $stmt->close();
        } else {
            $_SESSION['errorMessages']['confirmation'] = "Erreur de préparation de la requête de vérification : " . $conn->error;
            header("Location: ./formulaire-connexion.php");
            exit();
        }
    } else {
        $_SESSION['errorMessages']['confirmation'] = "Token de confirmation manquant.";
        header("Location: ./formulaire-connexion.php");
        exit();
    }

    closeConnection($conn);
?>
