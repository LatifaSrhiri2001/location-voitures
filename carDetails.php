<?php session_start(); include 'components/navbar.php'; ?>

<?php

require_once 'includes/db_connect.php';

// Vérifiez si l'ID de la voiture est passé dans l'URL
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
  <title>Location
    <?php echo htmlspecialchars($vehicle['marque'] . " " . $vehicle['modele'] . " " . $vehicle['annee']); ?>
  </title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body class="">

  <!-- Main Container -->
  <div class="container mx-7 p-6">
    <!-- ---------------------ERREUR MSG----------------------- -->

    <?php if (isset($_GET['message'])): ?>
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
      <strong class="font-bold">Erreur!</strong>
      <span class="block sm:inline"><?php echo htmlspecialchars($_GET['message']); ?></span>
    </div>
    <?php endif; ?>

    <!------------------------ END ERROR MSG-------------------- -->
    <!-- Car Image and Gallery -->
    <div class="flex flex-col lg:flex-row">
      <div class="w-full lg:w-2/3 ">
        <img src="assets/images/<?php echo htmlspecialchars($vehicle['image']); ?>"
          class="img-fluid car-img rounded w-full" alt="Car Image">
      </div>

      <!-- Car Details and Booking -->
      <div class="w-full lg:w-1/3 bg-white rounded-lg p-6  ml-4">
        <h1 class="text-3xl font-bold  mb-2 text-blue-900">
          <?php echo htmlspecialchars($vehicle['marque'] . " " . $vehicle['modele'] . " " . $vehicle['annee']); ?>
        </h1>

        <!-- Vehicle Info -->
        <div class="text-gray-600 text-sm space-y-2">
          <p><i class="fas fa-gas-pump mr-2"></i><?php echo htmlspecialchars($vehicle['carburant']); ?>: Essence</p>
          <p><i class="fas fa-door-open mr-2"></i><?php echo htmlspecialchars($vehicle['portes']); ?>:Portes</p>
          <p><i class="fas fa-users mr-2"></i><?php echo htmlspecialchars($vehicle['sieges']); ?> :Siéges</p>
        </div>

        <!-- Price Section -->
        <div class="mt-4">
          <span class="text-2xl font-bold text-blue-600"><?php echo htmlspecialchars($vehicle['prix']); ?></span>
          <span class="text-2xl font-bold text-blue-600">MAD</span>
        </div>






        <!-- Booking Form -->
        <form class="mt-4" action="process_reservation.php" method="GET">
          <input type="hidden" name="id" value="<?php echo htmlspecialchars($vehicle['id']); ?>">

          <label for="start" class="block text-sm">Début</label>
          <input type="date" id="start" name="start" class="w-full p-2 border border-gray-300 rounded-lg">

          <label for="start-time" class="block mt-2 text-sm">Heure de début</label>
          <input type="time" id="start-time" name="start-time" class="w-full p-2 border border-gray-300 rounded-lg">

          <label for="end" class="block mt-2 text-sm">Fin</label>
          <input type="date" id="end" name="end" class="w-full p-2 border border-gray-300 rounded-lg">

          <label for="end-time" class="block mt-2 text-sm">Heure de fin</label>
          <input type="time" id="end-time" name="end-time" class="w-full p-2 border border-gray-300 rounded-lg">


          <button class="mt-4 w-full bg-blue-900 text-white p-2 rounded-lg hover:bg-blue-700 transition">Réserver
            maintenant</button>
        </form>

        <hr class="my-4">

        <!-- Pickup and Return Locations -->
        <div class="space-y-2">
          <div class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
              stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
              class="lucide lucide-map-pin-check">
              <path
                d="M19.43 12.935c.357-.967.57-1.955.57-2.935a8 8 0 0 0-16 0c0 4.993 5.539 10.193 7.399 11.799a1 1 0 0 0 1.202 0 32.197 32.197 0 0 0 .813-.728" />
              <circle cx="12" cy="10" r="3" />
              <path d="m16 18 2 2 4-4" />
            </svg>
            <p class="font-semibold text-gray-900">Lieu de prise :</p>
            <p class="ml-2 text-gray-700"><?php echo htmlspecialchars($vehicle['lieu_prise']); ?></p>
          </div>
          <div class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
              stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
              class="lucide lucide-map-pin-check">
              <path
                d="M19.43 12.935c.357-.967.57-1.955.57-2.935a8 8 0 0 0-16 0c0 4.993 5.539 10.193 7.399 11.799a1 1 0 0 0 1.202 0 32.197 32.197 0 0 0 .813-.728" />
              <circle cx="12" cy="10" r="3" />
              <path d="m16 18 2 2 4-4" />
            </svg>
            <p class="font-semibold text-gray-900">Lieu de retour :</p>
            <p class="ml-2 text-gray-700"><?php echo htmlspecialchars($vehicle['lieu_retour']); ?></p>
          </div>
        </div>

        <div class="flex items-center">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
            class="lucide lucide-split">
            <path d="M16 3h5v5" />
            <path d="M8 3H3v5" />
            <path d="M12 22v-8.3a4 4 0 0 0-1.172-2.872L3 3" />
            <path d="m15 9 6-6" />
          </svg>
          <p class="font-semibold text-gray-900">Distance :</p>
          <p class="ml-2 text-gray-700"><?php echo htmlspecialchars($vehicle['distance_incluse']); ?>Km</p>
        </div>
      </div>
    </div>
  </div>

  <!-- Description and Additional Details -->
  <div class="mt-8 p-16 bg-white rounded-lg shadow-lg mb-24 container">
    <h2 class="text-xl font-bold text-gray-900">Description</h2>
    <p class="text-gray-600 mt-2">Découvrez l'ultime expérience de conduite avec notre voiture de luxe, la
      **<?php echo htmlspecialchars($vehicle['marque'] . " " . $vehicle['modele'] ); ?>**. Conçue pour allier
      performance et élégance, cette voiture offre un confort inégalé.</p>
    <p class="text-gray-600 mt-2">Profitez de son moteur puissant, de ses technologies de pointe et de son intérieur
      raffiné, parfait pour vos trajets en ville ou vos escapades sur la route. Réservez dès maintenant et vivez la
      route comme jamais auparavant!</p>

    <!-- Vehicle Characteristics -->
    <div class="mt-4 text-sm text-gray-500">
      <i class="fas fa-star text-yellow-500 mr-2"></i>4.92 ★ (15 voyages)
      <span class="mx-4">•</span>
      <i class="fas fa-map-marker-alt text-gray-600 mr-1"></i><?php echo htmlspecialchars($vehicle['lieu_prise']); ?>
    </div>

    <!-- Luxury Class Info -->
    <h3 class="mt-6 text-lg font-bold text-gray-900">Caractéristiques</h3>
    <li class="text-gray-700"><?php echo htmlspecialchars($vehicle['caracteristiques']); ?></li>
  </div>
  </div>
  <?php include 'components/footer.html'; ?>

</body>