<?php
// Inclure la configuration pour se connecter à la base de données
include '../includes/db_connect.php';

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer et valider les données
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Validation de l'email
    if (empty($email)) {
        $errors[] = 'Email is required';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Invalid email format';
    }

    // Validation du mot de passe
    if (empty($password)) {
        $errors[] = 'Password is required';
    }

    // Si aucune erreur
    if (empty($errors)) {
        // Vérification des informations d'identification
        try {
            $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
            $stmt->execute([':email' => $email]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($password, $user['password'])) {
                session_start();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['name'];

                // Redirection vers la page d'accueil ou tableau de bord
                header("Location: ../index.php");
                exit();
            } else {
                $errors[] = 'Invalid email or password';
            }
        } catch (PDOException $e) {
            $errors[] = "An error occurred: " . $e->getMessage();
        }
    }
}

// Inclure le formulaire de connexion, en passant les erreurs
include 'login_form.php';
?>
