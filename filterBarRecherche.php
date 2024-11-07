<!-- filterBarRecherche.php -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Filter</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
  
<?php
require_once 'includes/db_connect.php';


$stmtYear = $pdo->query("SELECT DISTINCT annee FROM voitures ORDER BY annee");
$years = $stmtYear->fetchAll(PDO::FETCH_ASSOC);


$stmtMarques = $pdo->query("SELECT DISTINCT marque FROM voitures");
$marques = $stmtMarques->fetchAll(PDO::FETCH_ASSOC);


$stmtSeats = $pdo->query("SELECT DISTINCT sieges FROM voitures");
$seats = $stmtSeats->fetchAll(PDO::FETCH_ASSOC);
?>


<div class="container mx-auto mt-10 p-4 bg-white rounded-lg shadow-lg">
  <form method="GET" action="recherche.php">
    <div class="flex flex-wrap justify-center items-center space-x-4">
      
    
      <div class="w-full md:w-auto">
        <select class="form-select block w-full px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" name="prix">
          <option value="" selected>Prix</option>
          <option value="0-50">0 - 50€</option>
          <option value="50-100">50 - 100€</option>
          <option value="100-200">100 - 200€</option>
          <option value="200+">200€ et plus</option>
        </select>
      </div>

      <!-- Années -->
      <div class="w-full md:w-auto">
        <select class="form-select block w-full px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" name="annee">
          <option value="" selected>Années</option>
          <?php foreach ($years as $year): ?>
            <option value="<?php echo htmlspecialchars($year['annee']); ?>">
              <?php echo htmlspecialchars($year['annee']); ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>

      <!-- Marque -->
      <div class="w-full md:w-auto">
        <select class="form-select block w-full px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" name="marque">
          <option value="" selected>Marque</option>
          <?php foreach ($marques as $marque): ?>
            <option value="<?php echo htmlspecialchars($marque['marque']); ?>">
              <?php echo htmlspecialchars($marque['marque']); ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>

      <!-- Sièges -->
      <div class="w-full md:w-auto">
        <select class="form-select block w-full px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" name="sieges">
          <option value="" selected>Sièges</option>
          <?php foreach ($seats as $seat): ?>
            <option value="<?php echo htmlspecialchars($seat['sieges']); ?>">
              <?php echo htmlspecialchars($seat['sieges']); ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>

      <!-- Submit Button -->
      <div class="w-full md:w-auto">
        <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-500">
          Rechercher
        </button>
      </div>
      
    </div>
  </form>
</div>

</body>
</html>

