
<?php

include '../includes/db_connect.php';



function getUserDetails($db, $user_id) {
    $stmt = $db->prepare('SELECT * FROM users WHERE id = :id');
    $stmt->execute(['id' => $user_id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}


function getConductorDetails($db, $user_id) {
  $stmt = $db->prepare('SELECT * FROM conducteurs WHERE id = :user_id'); 
  $stmt->execute(['user_id' => $user_id]);
  return $stmt->fetch(PDO::FETCH_ASSOC);
}

