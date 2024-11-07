<?php
session_start(); 


$is_logged_in = isset($_SESSION['user_id']); 

include 'components/navbar.php'; 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>location voitures</title>
    <script src="https://cdn.tailwindcss.com"></script> 
</head>
<body>

<!-- Main Container -->
<div class="max-w-8xl flex flex-col md:flex-row mt-16 bg-gradient-to-b from-blue-50 mx-0 sm:mx-24 rounded-3xl">
    <!-- Left Side: Content -->
    <div class="p-6 w-full md:w-1/2 flex flex-col justify-center">
        <h1 class="text-4xl sm:text-6xl font-bold mb-4 text-gray-700">Louez la Voiture Parfaite pour Votre Prochain Voyage</h1>
        <p class="text-gray-700 mb-6 text-sm sm:text-md">Trouvez les meilleures offres de location de voitures dans différentes villes. Que vous planifiez un court séjour ou une longue escapade, choisissez un véhicule qui correspond à vos besoins.</p>

        <!-- Search Form -->
        <form class="search-bar container bg-white mx-auto rounded-lg p-4 shadow-lg" action="<?= $is_logged_in ? 'recherche.php' : 'auth/login_form.php?redirect=recherche.php'; ?>" method="GET" style="max-width: 800px;">
            <div class="flex flex-wrap -mx-2 items-center">
                <?php
                $inputFields = [
                    ['type' => 'text', 'name' => 'lieu', 'placeholder' => 'Rabat/Casablanca/Marrakech', 'class' => 'w-full md:w-1/2'],
                    ['type' => 'date', 'name' => 'date_depart', 'value' => '2024-09-27', 'class' => 'w-full md:w-1/4'],
                    ['type' => 'time', 'name' => 'heure_depart', 'value' => '10:00', 'class' => 'w-full md:w-1/4'],
                    ['type' => 'date', 'name' => 'date_retour', 'value' => '2024-09-30', 'class' => 'w-full md:w-1/4'],
                    ['type' => 'time', 'name' => 'heure_retour', 'value' => '10:00', 'class' => 'w-full md:w-1/4'],
                ];
                foreach ($inputFields as $input): ?>
                    <div class="<?= $input['class'] ?> px-2 mb-2">
                        <input type="<?= $input['type'] ?>" name="<?= $input['name'] ?>" value="<?= $input['value'] ?? '' ?>" class="bg-gray-200 border-0 p-2 w-full rounded-md" placeholder="<?= $input['placeholder'] ?? '' ?>" required>
                    </div>
                <?php endforeach; ?>
                <div class="w-full px-2">
                    <button class="bg-[#102542] text-white w-full py-2 rounded-md border-0">
                        Rechercher une voiture
                    </button>
                </div>
            </div>
        </form>
        
    </div>
    
    <!-- Right Side: Image -->
    <div class="w-full md:w-1/2 flex justify-center items-center">
        <img src="assets/images/landing2.jpeg" alt="Car Rental" class="rounded-lg w-3/4 h-auto max-w-xs md:max-w-sm" />
    </div>
</div>

<!-- Intro Section -->
<section class="intro-text text-center p-5 container mx-auto mt-48">
    <h1 class="font-bold mb-5 text-blue-800 text-5xl">Découvrez votre voyage idéal</h1>
    <p class="text-lg font-bold text-gray-800">Louez le véhicule qu’il vous faut, où et quand vous le souhaitez<br>pour des déplacements sans souci à tout moment</p>
</section>

<!-- Hero Section -->
<section class="hero mt-5 container mx-auto rounded-lg overflow-hidden bg-gray-100">
    <div class="flex flex-col md:flex-row justify-center items-center">
        <div class="mb-3 md:w-1/2">
            <img src="assets/images/offre.webp" alt="Voiture 1" class="img-fluid w-full mt-3 h-auto rounded-lg">
        </div>
        <div class="md:w-1/2 p-5">
            <h1 class="font-bold md:text-left text-gray-700 text-4xl">Louez une voiture pour chaque moment spécial</h1>
            <p class="md:text-left text-1xl text-gray-600">Découvrez une vaste gamme de véhicules, du plus classique au plus luxueux.</p>
            <div class="flex justify-center md:justify-start mt-4">
                <a href="recherche.php" class="px-6 py-3.5 text-base font-medium text-white inline-flex items-center bg-blue-800 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg text-center">
                     Voir la gamme
                     <svg xmlns="http://www.w3.org/2000/svg" class="m-2" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                         <circle cx="12" cy="12" r="10"/>
                         <path d="m10 8 4 4-4 4"/>
                     </svg>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Include Other Components -->
<?php 
include 'components/marques.php'; 
include 'components/swipper.html'; 
include 'components/faq.html'; 
include 'components/footer.html'; 
?>

</body>
</html>
