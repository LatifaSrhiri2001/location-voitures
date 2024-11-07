<?php
require_once 'includes/db_connect.php';
session_start();


$vehicle_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($vehicle_id <= 0) {
    die("L'ID du véhicule n'est pas valide. Valeur reçue : " . htmlspecialchars($_GET['id']));
}


$stmt = $pdo->prepare("SELECT * FROM voitures WHERE id = ?");
$stmt->execute([$vehicle_id]);
$vehicle = $stmt->fetch();

if (!$vehicle) {
    die("Véhicule introuvable."); 
}


if (!isset($_SESSION['user_id'])) {
    die("Vous devez être connecté pour effectuer un achat.");
}

$id_acheteur = $_SESSION['user_id'];

if (isset($_POST['vehicle_id']) && is_numeric($_POST['vehicle_id'])) {
    $vehicle_id = intval($_POST['vehicle_id']);
} else {
    die("L'ID du véhicule n'est pas défini ou est invalide.");
}


$mobile = isset($_POST['mobile']) ? trim($_POST['mobile']) : '';
$prenom = isset($_POST['prenom']) ? trim($_POST['prenom']) : '';
$date_naissance = isset($_POST['date_naissance']) ? trim($_POST['date_naissance']) : '';
$numero_permis = isset($_POST['numero_permis']) ? trim($_POST['numero_permis']) : '';
$date_expiration_permis = isset($_POST['date_expiration_permis']) ? trim($_POST['date_expiration_permis']) : '';


$errors = [];

if (empty($mobile) || !preg_match('/^[0-9]{10}$/', $mobile)) {
    $errors[] = "Veuillez entrer un numéro de mobile valide (10 chiffres).";
}

if (empty($prenom)) {
    $errors[] = "Veuillez entrer votre prénom.";
}

if (empty($date_naissance)) {
    $errors[] = "Veuillez entrer votre date de naissance.";
}

if (empty($numero_permis)) {
    $errors[] = "Veuillez entrer le numéro de votre permis de conduire.";
}

if (empty($date_expiration_permis)) {
    $errors[] = "Veuillez entrer la date d'expiration de votre permis de conduire.";
} elseif (strtotime($date_expiration_permis) < time()) {
    $errors[] = "La date d'expiration de votre permis de conduire ne peut pas être dans le passé.";
}


if (!empty($errors)) {
    foreach ($errors as $error) {
        echo "<div class='text-red-500'>$error</div>";
    }
    exit(); 
}


$stmt = $pdo->prepare("SELECT prix FROM voitures WHERE id = ?");
$stmt->execute([$vehicle_id]);
$vehicle = $stmt->fetch();

if ($vehicle) {
    $amount = $vehicle['prix'];

   
    $stmt = $pdo->prepare("INSERT INTO commandes (id_vehicule, id_acheteur, montant, statut_paiement) VALUES (?, ?, ?, 'en attente')");
    $stmt->execute([$vehicle_id, $id_acheteur, $amount]);

   
    $commande_id = $pdo->lastInsertId();

   
    $paypalUrl = "https://www.sandbox.paypal.com/cgi-bin/webscr";  
    $returnUrl = "http://votre-site.com/confirmation.php?commande_id=" . $commande_id; 

    $params = [
        'cmd' => '_xclick',
        'business' => 'latifasrhiri2021@gmail.com', 
        'item_name' => 'Achat d\'un véhicule',
        'amount' => $amount,
        'currency_code' => 'EUR',
        'return' => $returnUrl,
        'cancel_return' => 'http://votre-site.com/cancel.php',
    ];

    $queryString = http_build_query($params);


    header("Location: $paypalUrl?$queryString");
    exit();
} else {
    die("Véhicule introuvable.");
}
?>
