<?php
include '../config.php';

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $role = 'admin'; // Rôle fixé à admin

    // Validation des champs
    if (empty($name)) {
        $errors[] = "Name is required.";
    }
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "A valid email is required.";
    }
    if (empty($password)) {
        $errors[] = "Password is required.";
    }

    if (empty($errors)) {
        // Hachage du mot de passe
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Insertion dans la base de données
        try {
            $stmt = $pdo->prepare("INSERT INTO users (name, email, password, role) VALUES (:name, :email, :password, :role)");
            $stmt->execute([
                ':name' => $name,
                ':email' => $email,
                ':password' => $hashedPassword,
                ':role' => $role
            ]);

            // Démarrer une session
            session_start();
            $_SESSION['user_id'] = $pdo->lastInsertId(); // Récupérer l'ID de l'utilisateur inséré
            $_SESSION['user_name'] = $name;
            $_SESSION['user_role'] = $role;

            // Redirection vers le tableau de bord admin
            header("Location: ../../admin_dashboard.php");
            exit();
        } catch (PDOException $e) {
            $errors[] = "Registration failed: " . $e->getMessage();
        }
    }
}

// Inclure le formulaire d'inscription, en passant les erreurs
include '../admin_register.php'; // Changer le nom du fichier si nécessaire
?>
