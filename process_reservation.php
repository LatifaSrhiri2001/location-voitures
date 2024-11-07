<?php
require_once 'includes/db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $id_vehicule = intval($_GET['id']); 
    $date_debut = $_GET['start'];
    $heure_debut = $_GET['start-time']; 
    $date_fin = $_GET['end']; 
    $heure_fin = $_GET['end-time'];

    session_start();
    $id_acheteur = $_SESSION['user_id']; 

    
    $datetime_debut = $date_debut . ' ' . $heure_debut;
    $datetime_fin = $date_fin . ' ' . $heure_fin;

    // CETTE REQUEUTE  Vérifie si le véhicule est disponible
    $stmt = $pdo->prepare("
        SELECT COUNT(*) 
        FROM reservations 
        WHERE id_vehicule = :id_vehicule 
        AND (
            (:datetime_debut BETWEEN CONCAT(date_debut, ' ', heure_debut) AND CONCAT(date_fin, ' ', heure_fin))
            OR (:datetime_fin BETWEEN CONCAT(date_debut, ' ', heure_debut) AND CONCAT(date_fin, ' ', heure_fin))
            OR (CONCAT(date_debut, ' ', heure_debut) BETWEEN :datetime_debut AND :datetime_fin)
        )
    ");
    $stmt->execute([
        ':id_vehicule' => $id_vehicule,
        ':datetime_debut' => $datetime_debut,
        ':datetime_fin' => $datetime_fin,
    ]);
    $reservation_count = $stmt->fetchColumn();

    if ($reservation_count > 0) {
        // Le véhicule est déjà réservé pour ces dates
        header("Location: carDetails.php?id=$id_vehicule&message=Le véhicule est déjà réservé pour cette période.");
        exit();
    }
    

    
    $stmt = $pdo->prepare("SELECT prix FROM voitures WHERE id = :id");
    $stmt->execute([':id' => $id_vehicule]);
    $vehicle = $stmt->fetch(PDO::FETCH_ASSOC);
    $montant = $vehicle['prix']; 

    
    $stmt = $pdo->prepare("
        INSERT INTO reservations (id_vehicule, id_acheteur, date_debut, heure_debut, date_fin, heure_fin, montant, statut)
        VALUES (:id_vehicule, :id_acheteur, :date_debut, :heure_debut, :date_fin, :heure_fin, :montant, 'en attente')
    ");
    $stmt->execute([
        ':id_vehicule' => $id_vehicule,
        ':id_acheteur' => $id_acheteur,
        ':date_debut' => $date_debut,
        ':heure_debut' => $heure_debut,
        ':date_fin' => $date_fin,
        ':heure_fin' => $heure_fin,
        ':montant' => $montant,
    ]);

    header("Location: confirmation.php?id=" . $pdo->lastInsertId());
    exit();
}
?>
