<?php 
session_start(); 
$is_logged_in = isset($_SESSION['user_id']); 
include 'components/navbar.php';
include 'includes/db_connect.php';
$marque = isset($_GET['marque']) ? $_GET['marque'] : '';

// Fetch models for the specified brand
$stmt = $pdo->prepare("SELECT * FROM voitures WHERE marque = :marque LIMIT 3");
$stmt->execute(['marque' => $marque]);
$voitures = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Location d'une <?php echo htmlspecialchars($marque); ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
    <link rel="stylesheet" href="assets/css/reserveBymodel.css">
</head>
<body class="bg-gray-100">

<div class="py-24  bg-cover  bg-center" style="background-image: url('assets/images/CAR5.jfif');">
    <div class=" py-12">
        <h1 class="text-center mt-6 mb-8 text-5xl font-bold text-white">Location d'une <?php echo htmlspecialchars($marque); ?></h1>
        <p class="text-center mt-5 mb-8 text-white">Découvrez RentCar, la plus grande plateforme d'autopartage au monde</p>

        <div class="container mx-0">
            <form action="recherche.php" method="GET" class=" mx-2 flex flex-wrap px-4 gap-5 py-4 items-center bg-white shadow-lg space-x-6 rounded-3xl">
                <input type="text" placeholder="Recherche un lieu..." name="lieu" class="border-none bg-gray-50 rounded-lg p-2 w-full sm:w-1/4">
                <input type="date" name="date-depart" class="border-none bg-gray-50 rounded-lg p-2 w-full sm:w-1/4">
                <input type="date" name="date-retour" class="border-none bg-gray-50 rounded-lg p-2 w-full sm:w-1/4">
                <button type="submit" class="flex items-center bg-gray-50 bg-blue-900 text-white rounded-lg p-2">
                    <span class="ml-1">Recherche</span>
                </button>
            </form>
        </div>
    </div>
</div>


<div class="container my-48 mx-auto px-4">
    <h2 class="text-3xl mt-16 mb-5 font-bold text-blue-800 text-center">Les mieux notées <?php echo htmlspecialchars($marque); ?></h2>
    <div class="row mt-4 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
        <?php foreach ($voitures as $car): ?>
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <img src="assets/images/<?php echo htmlspecialchars($car['image']); ?>" class="w-full h-50 object-cover" alt="<?php echo htmlspecialchars($car['modele']); ?>">
                <div class="p-4">
                    <h5 class="text-lg font-bold text-blue-900"><?php echo htmlspecialchars($car['modele']); ?></h5>
                    <p class="text-blue-500">5.0 ★ (33 voyages)</p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="text-center mt-12">
        <a href="recherche.php?marque=<?php echo urlencode($marque); ?>" class="text-blue-50 rounded px-6 py-4 bg-blue-900 font-bold">Réserver une <?php echo htmlspecialchars($marque); ?></a>
    </div>
</div>

<div class="container my-5 p-5 mx-auto mt-48">
    <div class="flex flex-col lg:flex-row bg-light rounded-lg p-4">
        <div class="lg:w-1/2 flex justify-center items-center">
            <img src="assets/images/8.avif" class="img-fluid w-1/2 rounded-lg" alt="car">
        </div>
        <div class="lg:w-1/2 flex flex-col justify-center p-4">
            <h2 class="text-3xl text-blue-800 font-bold">Location d'une <?php echo htmlspecialchars($marque); ?></h2>
            <p class="text-1xl">Profitez d'une voiture de location à la fois performante, innovante et respectueuse de l'environnement. Louez une <?php echo htmlspecialchars($marque); ?> et vivez une expérience unique sur la route...</p>
        </div>
    </div>
</div>

<?php include 'components/marques.php'; ?>
<?php include 'components/footer.html'; ?>

</body>
</html>
