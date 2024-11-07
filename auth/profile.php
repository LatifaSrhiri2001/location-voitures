<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: auth/login.php'); 
    exit();
}

include '../includes/db_connect.php';
include '../components/navbar.php';
include 'detailProfile.php';  

$user_id = $_SESSION['user_id'];

$user = getUserDetails($pdo, $user_id);

$conductor = getConductorDetails($pdo, $user_id);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Votre Profil</title>
</head>
<body>
<h1 class="text-2xl font-bold mb-4">Profil de <?php echo htmlspecialchars($user['name']); ?></h1>
<p class="mb-4">Email: <?php echo htmlspecialchars($user['email']); ?></p>

<!-- Display conductor details if available -->
<?php if ($conductor): ?>
    <h2 class="text-xl font-semibold mb-2">Détails du Conducteur</h2>
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-300 container bg-gray-100">
            <thead>
                <tr class="bg-gray-200 text-gray-700">
                    <th class="py-2 px-4 border-b">Champ</th>
                    <th class="py-2 px-4 border-b">Détails</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="py-2 px-4 border-b font-semibold">Mobile</td>
                    <td class="py-2 px-4 border-b"><?php echo htmlspecialchars($conductor['mobile']); ?></td>
                </tr>
                <tr>
                    <td class="py-2 px-4 border-b font-semibold">Prénom</td>
                    <td class="py-2 px-4 border-b"><?php echo htmlspecialchars($conductor['prenom']); ?></td>
                </tr>
                <tr>
                    <td class="py-2 px-4 border-b font-semibold">Nom</td>
                    <td class="py-2 px-4 border-b"><?php echo htmlspecialchars($conductor['nom']); ?></td>
                </tr>
                <tr>
                    <td class="py-2 px-4 border-b font-semibold">Pays</td>
                    <td class="py-2 px-4 border-b"><?php echo htmlspecialchars($conductor['pays']); ?></td>
                </tr>
                <tr>
                    <td class="py-2 px-4 border-b font-semibold">Numéro de permis</td>
                    <td class="py-2 px-4 border-b"><?php echo htmlspecialchars($conductor['numero_permis']); ?></td>
                </tr>
                <tr>
                    <td class="py-2 px-4 border-b font-semibold">Date de délivrance</td>
                    <td class="py-2 px-4 border-b"><?php echo htmlspecialchars($conductor['date_delivrance']); ?></td>
                </tr>
                <tr>
                    <td class="py-2 px-4 border-b font-semibold">Date d'expiration</td>
                    <td class="py-2 px-4 border-b"><?php echo htmlspecialchars($conductor['date_expiration']); ?></td>
                </tr>
            </tbody>
        </table>
    </div>
<?php else: ?>
    <p>Pas de détails de conducteur trouvés.</p>
<?php endif; ?>

