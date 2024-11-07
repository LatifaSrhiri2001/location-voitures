<?php

require_once 'includes/db_connect.php';
 
function getCars($filters) {
    global $pdo;
    $query = "SELECT * FROM voitures WHERE 1=1";
    $params = [];

    if (!empty($filters['marque'])) {
        $query .= " AND marque LIKE :marque";
        $params[':marque'] = '%' . $filters['marque'] . '%';
    }
    if (!empty($filters['date_depart']) && !empty($filters['date_retour'])) {
        $query .= " AND date_depart <= :date_depart AND date_retour >= :date_retour";
        $params[':date_depart'] = $filters['date_depart'];
        $params[':date_retour'] = $filters['date_retour'];
    }
    if (!empty($filters['prix'])) {
        if ($filters['prix'] === '0-50') {
            $query .= " AND prix BETWEEN 0 AND 50";
        } elseif ($filters['prix'] === '50-100') {
            $query .= " AND prix BETWEEN 50 AND 100";
        } elseif ($filters['prix'] === '100-200') {
            $query .= " AND prix BETWEEN 100 AND 200";
        } elseif ($filters['prix'] === '200+') {
            $query .= " AND prix > 200";
        }
    }
    if (!empty($filters['type'])) {
        $query .= " AND type LIKE :type";
        $params[':type'] = '%' . $filters['type'] . '%';
    }
    if (!empty($filters['annee'])) {
        if ($filters['annee'] === '2018+') {
            $query .= " AND annee >= 2018";
        } else {
            $query .= " AND annee = :annee";
            $params[':annee'] = $filters['annee'];
        }
    }
    if (!empty($filters['sieges'])) {
        $query .= " AND sieges = :sieges";
        $params[':sieges'] = $filters['sieges'];
    }

    $stmt = $pdo->prepare($query);
    $stmt->execute($params);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}





 
$conn = mysqli_connect('localhost', 'root', '', 'rentcar');  
if (!$conn) {  
    die("Échec de la connexion : " . mysqli_connect_error());  
}  

// Définir le nombre total de résultats par page  
$results_per_page = 10;  



// Construire la requête en incluant les filtres
$filter_query = "SELECT * FROM voitures";
if (count($conditions) > 0) {
    $filter_query .= " WHERE " . implode(" AND ", $conditions);
}

// Trouver le nombre total de résultats dans la base de données avec les filtres  
$result = mysqli_query($conn, $filter_query);  
$number_of_result = mysqli_num_rows($result);  

// Déterminer le nombre total de pages disponibles  
$number_of_page = ceil($number_of_result / $results_per_page);  

// Déterminer le numéro de la page courante  
if (!isset($_GET['page'])) {  
    $page = 1;  
} else {  
    $page = (int)$_GET['page'];  
}  

// Calculer le premier résultat de la page actuelle  
$page_first_result = ($page - 1) * $results_per_page;  

// Récupérer les résultats sélectionnés avec pagination  
$paged_query = $filter_query . " LIMIT " . $page_first_result . ',' . $results_per_page;  
$result = mysqli_query($conn, $paged_query);  





?>



 
 
