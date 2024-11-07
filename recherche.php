<?php include 'rechercheBackend.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Pagination - Voitures</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.1.2/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>

<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Liste des Voitures</h1>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
        <?php while ($car = mysqli_fetch_array($result)) : ?>
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <img src="assets/images/<?php echo htmlspecialchars($car['image']); ?>" class="w-full h-50 object-cover" alt="<?php echo htmlspecialchars($car['modele']); ?>">
                <div class="p-4">
                    <h5 class="text-lg font-bold text-blue-900"><?php echo htmlspecialchars($car['modele']); ?></h5>
                    <p class="text-blue-500">5.0 ★ (33 voyages)</p>
                    <p class="text-gray-700"><?php echo htmlspecialchars($car['marque']); ?></p>
                    <p class="text-gray-700"><?php echo htmlspecialchars($car['annee']); ?></p>
                    <p class="text-gray-700"><?php echo htmlspecialchars($car['prix']); ?> €</p>
                </div>
            </div>
        <?php endwhile; ?>
    </div>

    <!-- Pagination -->
    <div class="flex justify-center mt-4">
        <?php for ($page_num = 1; $page_num <= $number_of_page; $page_num++) : ?>
            <a href="recherche.php?page=<?php echo $page_num; ?>" 
               class="px-3 py-2 mx-1 border <?php echo ($page == $page_num) ? 'bg-blue-500 text-white' : 'bg-gray-200 text-blue-500'; ?> rounded">
                <?php echo $page_num; ?>
            </a>
        <?php endfor; ?>
    </div>
</div>

</body>
</html>
