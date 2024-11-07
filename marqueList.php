<?php
$is_logged_in = isset($_SESSION['user_id']); 
include 'components/navbar.php';
?>




<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

<!-- Filters Row -->
<div class="container filter">
  <form method="GET" action="marqueList.php">
    <div class="row justify-content-center align-items-center text-center g-3">
      
      <!-- Prix -->
      <div class="col-auto">
        <select class="form-select" name="prix">
          <option value="" selected>Prix</option>
          <option value="0-50">0 - 50€</option>
          <option value="50-100">50 - 100€</option>
          <option value="100-200">100 - 200€</option>
          <option value="200+">200€ et plus</option>
        </select>
      </div>

      <!-- Type de véhicule -->
      <div class="col-auto">
        <select class="form-select" name="type">
          <option value="" selected>Type de véhicule</option>
          <option value="Berline">Berline</option>
          <option value="SUV">SUV</option>
          <option value="Hatchback">Hatchback</option>
          <option value="Coupé">Coupé</option>
        </select>
      </div>

      <!-- Marque -->
      <div class="col-auto">
        <select class="form-select" name="marque">
          <option value="" selected>Marque</option>
          <option value="Toyota">Toyota</option>
          <option value="BMW">BMW</option>
          <option value="Mercedes">Mercedes</option>
          <option value="Audi">Audi</option>
        </select>
      </div>

      <!-- Années -->
      <div class="col-auto">
        <select class="form-select" name="annee">
          <option value="" selected>Années</option>
          <option value="2015">2015</option>
          <option value="2016">2016</option>
          <option value="2017">2017</option>
          <option value="2018+">2018 et plus</option>
        </select>
      </div>

      <!-- Sièges -->
      <div class="col-auto">
        <select class="form-select" name="sieges">
          <option value="" selected>Sièges</option>
          <option value="2">2</option>
          <option value="4">4</option>
          <option value="5">5</option>
          <option value="7+">7+</option>
        </select>
      </div>

      <div class="col-auto">
        <button type="submit" class="btn btn-primary">Rechercher</button>
      </div>
    </div>
  </form>
</div>






<?php
// Connect to database

include 'includes/db_connect.php';


$conditions = [];
$params = [];

// Vérifiez si une marque est spécifiée
if (isset($_GET['marque']) && !empty($_GET['marque'])) {
    $marque = htmlspecialchars($_GET['marque']);
    $conditions[] = "marque = :marque"; // Filtrer par marque
    $params[':marque'] = $marque;
} else {

    echo "Aucune marque spécifiée.";
    exit;
}

// Handle 'prix' filter
if (isset($_GET['prix']) && !empty($_GET['prix'])) {
    $prix = htmlspecialchars($_GET['prix']);
    if ($prix === '0-50') {
        $conditions[] = "prix BETWEEN 0 AND 50";
    } elseif ($prix === '50-100') {
        $conditions[] = "prix BETWEEN 50 AND 100";
    } elseif ($prix === '100-200') {
        $conditions[] = "prix BETWEEN 100 AND 200";
    } elseif ($prix === '200+') {
        $conditions[] = "prix > 200";
    }
}

// Handle 'annee' filter
if (isset($_GET['annee']) && !empty($_GET['annee'])) {
    $annee = htmlspecialchars($_GET['annee']);
    if ($annee === '2018+') {
        $conditions[] = "annee >= 2018";
    } else {
        $conditions[] = "annee = :annee";
        $params[':annee'] = $annee;
    }
}

// Handle 'sieges' filter
if (isset($_GET['sieges']) && !empty($_GET['sieges'])) {
    $sieges = htmlspecialchars($_GET['sieges']);
    $conditions[] = "sieges = :sieges";
    $params[':sieges'] = $sieges;
}


$sql = "SELECT * FROM voitures";


if (count($conditions) > 0) {
    $sql .= " WHERE " . implode(" AND ", $conditions);
}

// Prepare the query
$stmt = $pdo->prepare($sql);

// Bind parameters dynamically based on filters
foreach ($params as $param => $value) {
    $stmt->bindValue($param, $value);
}

// Execute the query
$stmt->execute();

// Fetch all results
$voitures = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Display the results
if (!empty($voitures)) {
    foreach ($voitures as $voiture) {
        echo '<div class="col-md-4 mb-4">';
        echo '<div class="card h-100">';
        echo '<img src="assets/images/' . htmlspecialchars($voiture['image']) . '" class="card-img-top" alt="' . htmlspecialchars($voiture['marque'] . ' ' . $voiture['modele']) . '">';
        echo '<div class="card-body">';
        echo '<h5 class="card-title">' . htmlspecialchars($voiture['marque'] . ' ' . $voiture['modele']) . '</h5>';
        echo '<p class="card-text"><strong>Prix: </strong>' . htmlspecialchars($voiture['prix']) . '€</p>';
        echo '</div>';
        echo '<div class="card-footer">';
        echo '<a href="reservation.php?id=' . $voiture['id'] . '" class="btn btn-primary">Réserver</a>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }
} else {
    echo '<p>Aucun modèle disponible pour cette marque avec les critères spécifiés.</p>';
}
?>
