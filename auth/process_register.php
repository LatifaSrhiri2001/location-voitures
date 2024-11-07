<?php
session_start();
include '../includes/db_connect.php';

$errors = [];

// Traitement du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Validation des champs
    if (empty($name)) {
        $errors[] = "Le nom est requis.";
    }
    if (empty($email)) {
        $errors[] = "L'email est requis.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "L'email n'est pas valide.";
    }
    if (empty($password)) {
        $errors[] = "Le mot de passe est requis.";
    }

    // Vérification des erreurs
    if (empty($errors)) {
        // Vérification si l'email existe déjà
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $email_exists = $stmt->fetchColumn();

        if ($email_exists) {
            $errors[] = "Cet email est déjà utilisé.";
        } else {
            // Hachage du mot de passe
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Insertion dans la base de données
            $stmt = $pdo->prepare("INSERT INTO users (name, email, password) VALUES (:name, :email, :password)");
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $hashed_password);

            if ($stmt->execute()) {
               
                header("Location:../index.php");
                exit();
            } else {
                $errors[] = "Une erreur s'est produite lors de l'inscription. Veuillez réessayer.";
            }
        }
    }
}


if (!empty($errors)) {
    $_SESSION['errors'] = $errors;
    header("Location: register_form.php"); 
    exit();
}
?>
