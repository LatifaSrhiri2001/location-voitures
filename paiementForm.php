<?php
require_once 'includes/db_connect.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id > 0) {
   
    $stmt = $pdo->prepare("SELECT * FROM voitures WHERE id = :id");
    $stmt->execute([':id' => $id]);
    $vehicle = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$vehicle) {
        echo "Aucune voiture trouvée pour cet ID.";
        exit;
    }
} else {
    echo "ID de voiture invalide.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paiement par PayPal</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

<div class="container mx-auto mt-10 w-full max-w-md">
    <h2 class="text-2xl font-bold mb-6 text-center text-blue-600">Louer un véhicule</h2>

    <form action="paiement_paypal.php" method="POST" class="bg-white shadow-md rounded-lg px-8 pt-6 pb-8 mb-4">
        <input type="hidden" name="reservation_id" value="<?php echo htmlspecialchars($id_reservation); ?>">
        <input type="hidden" name="vehicle_id" value="<?php echo htmlspecialchars($vehicle['id']); ?>">
        <input type="hidden" name="amount" value="<?php echo htmlspecialchars($vehicle['prix']); ?>">

        <div class="mb-4">
            <label for="prenom" class="block text-gray-700 text-sm font-bold mb-2">Prénom</label>
            <input type="text" class=" appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring focus:border-blue-300" id="prenom" name="prenom" required>
        </div>

        <div class="mb-4">
            <label for="deuxieme_prenom" class="block text-gray-700 text-sm font-bold mb-2">Deuxième prénom</label>
            <input type="text" class=" appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring focus:border-blue-300" id="deuxieme_prenom" name="deuxieme_prenom">
        </div>
        <div class="flex flex-row items-center justify-center space-x-3">
           <div class="mb-4">
            <label for="nom" class="block text-gray-700 text-sm font-bold mb-2">Nom</label>
            <input type="text" class=" appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring focus:border-blue-300" id="nom" name="nom" required>
        </div>
         
        
        <div class="mb-4">
            <label for="mobile" class="block text-gray-700 text-sm font-bold mb-2">Mobile</label>
            <input type="tel" class=" appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring focus:border-blue-300" id="mobile" name="mobile" required>
        </div>  
        </div>

       
     <div class="flex flex-row items-center justify-center space-x-3">
        <div class="mb-4">
            <label for="pays" class="block text-gray-700 text-sm font-bold mb-2">Pays</label>
            <input type="text" class=" appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring focus:border-blue-300" id="pays" name="pays" required>
        </div>
        

        <div class="mb-4">
            <label for="numero_permis" class="block text-gray-700 text-sm font-bold mb-2">Numéro de permis </label>
            <input type="text" class=" appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring focus:border-blue-300" id="numero_permis" name="numero_permis" required>
        </div>
     </div>
        
        <div class="mb-4">
            <label for="date_delivrance" class="block text-gray-700 text-sm font-bold mb-2">Date de délivrance</label>
            <input type="date" class=" appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring focus:border-blue-300" id="date_delivrance" name="date_delivrance" required>
        </div>

        <div class="mb-4">
            <label for="date_expiration" class="block text-gray-700 text-sm font-bold mb-2">Date d'expiration</label>
            <input type="date" class="border appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring focus:border-blue-300" id="date_expiration" name="date_expiration" required>
        </div>
    

        <button class="bg-blue-500 hover:bg-yellow-400 text-white font-bold py-2 px-4 rounded w-full focus:outline-none focus:ring focus:ring-yellow-400 focus:ring-opacity-50" type="submit">Payer avec PayPal</button>
    </form>
</div>

</body>
</html>
