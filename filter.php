<?php

include 'includes/db_connect.php';


function getFilterConditions() {
    $conditions = [];
    $params = [];

    if (isset($_GET['prix']) && !empty($_GET['prix'])) {
        $prix = htmlspecialchars($_GET['prix']);
        $conditions[] = match ($prix) {
            '0-50' => "prix BETWEEN 0 AND 50",
            '50-100' => "prix BETWEEN 50 AND 100",
            '100-200' => "prix BETWEEN 100 AND 200",
            '200+' => "prix > 200",
            default => null,
        };
    }

    if (isset($_GET['type']) && !empty($_GET['type'])) {
        $type = htmlspecialchars($_GET['type']);
        $conditions[] = "modele = :modele";
        $params[':modele'] = $type;
    }

    if (isset($_GET['marque']) && !empty($_GET['marque'])) {
        $marque = htmlspecialchars($_GET['marque']);
        $conditions[] = "marque = :marque";
        $params[':marque'] = $marque;
    }

    if (isset($_GET['annee']) && !empty($_GET['annee'])) {
        $annee = htmlspecialchars($_GET['annee']);
        $conditions[] = $annee === '2018+' ? "annee >= 2018" : "annee = :annee";
        if ($annee !== '2018+') {
            $params[':annee'] = $annee;
        }
    }

    if (isset($_GET['sieges']) && !empty($_GET['sieges'])) {
        $sieges = htmlspecialchars($_GET['sieges']);
        $conditions[] = "sieges = :sieges";
        $params[':sieges'] = $sieges;
    }

    return [$conditions, $params];
}

function fetchVoitures($pdo) {
    list($conditions, $params) = getFilterConditions();
    $sql = "SELECT * FROM voitures";

    if (count($conditions) > 0) {
        $sql .= " WHERE " . implode(" AND ", $conditions);
    }

    $stmt = $pdo->prepare($sql);
    
    foreach ($params as $param => $value) {
        $stmt->bindValue($param, $value);
    }

    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Main Code
$voitures = fetchVoitures($pdo);
?>


<!-- Display filtered results -->
<div class="container mx-auto py-8">
  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    <?php
    if (!empty($voitures)) {
        foreach ($voitures as $voiture) {
            echo '<div class="bg-white shadow-md rounded-lg overflow-hidden">';
            echo '<img src="assets/images/' . htmlspecialchars($voiture['image']) . '" class="w-full h-48 object-cover" alt="' . htmlspecialchars($voiture['marque'] . ' ' . $voiture['modele']) . '">';
            echo '<div class="p-4">';
            echo '<h5 class="text-lg font-semibold">' . htmlspecialchars($voiture['marque'] . ' ' . $voiture['modele']) . '</h5>';
            echo '<p class="text-gray-700 mt-2"><strong>Prix: </strong>' . htmlspecialchars($voiture['prix']) . '€</p>';
            echo '</div>';
            echo '<div class="p-4 bg-gray-100">';
            echo '<a href="reservation.php?id=' . $voiture['id'] . '" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-500">Réserver</a>';
            echo '</div>';
            echo '</div>';
        }
    } else {
        echo '<p class="text-center">Aucun véhicule ne correspond à votre recherche.</p>';
    }
    ?>
  </div>
</div>
