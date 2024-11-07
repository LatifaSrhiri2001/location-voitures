<?php
try {
  $pdo = new PDO('mysql:host=localhost;dbname=rentcar', 'root', ''); 
} catch (PDOException $e) {
  die('Connection failed: ' . $e->getMessage());
}
