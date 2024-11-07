<?php
require_once 'includes/db_connect.php';

$id_reservation = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id_reservation > 0) {
    $stmt = $pdo->prepare("SELECT * FROM reservations WHERE id = :id");
    $stmt->execute([':id' => $id_reservation]);
    $reservation = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$reservation) {
        echo "Commande non trouvée.";
        exit;
    }
} else {
    echo "ID de commande invalide.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Document</title>
</head>
<body>
    

<div class="min-h-screen flex items-center justify-center bg-gray-100 py-6">
    <div class="bg-white shadow-lg rounded-lg p-8 max-w-md w-full">
        <h1 class="text-2xl font-bold text-gray-800 mb-4">Commande confirmée</h1>
        <p class="text-lg text-gray-600">Merci pour votre réservation !</p>
        
        <div class="mt-4">
            <p class="text-sm text-gray-500">ID de la commande :</p>
            <p class="text-lg font-semibold text-gray-800"><?php echo htmlspecialchars($reservation['id']); ?></p>
        </div>

        <div class="mt-4">
            <p class="text-sm text-gray-500">Date de début :</p>
            <p class="text-lg font-semibold text-gray-800"><?php echo htmlspecialchars($reservation['date_debut']); ?> à <?php echo htmlspecialchars($reservation['heure_debut']); ?></p>
        </div>

        <div class="mt-4">
            <p class="text-sm text-gray-500">Date de fin :</p>
            <p class="text-lg font-semibold text-gray-800"><?php echo htmlspecialchars($reservation['date_fin']); ?> à <?php echo htmlspecialchars($reservation['heure_fin']); ?></p>
        </div>

        <div class="mt-4">
            <p class="text-sm text-gray-500">Montant :</p>
            <p class="text-lg font-semibold text-gray-800"><?php echo htmlspecialchars($reservation['montant']); ?> MAD</p>
        </div>

        <div class="mt-6">
            <a href="paiementForm.php?id=<?php echo urlencode($reservation['id']); ?>" class="inline-block w-full text-center bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-lg shadow-md font-semibold">Continuer la réservation</a>
        </div>
    </div>
</div>
</body>
</html>