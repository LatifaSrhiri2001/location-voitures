<section class="mb-16 mt-48">
    <div class="text-center">
        <h3 class="font-bold mb-24 text-5xl text-blue-800 ">Parcourir par marque</h3>
    </div>

    <div class="flex flex-wrap justify-center gap-4 mx-auto max-w-screen-lg">
        <?php
        // Connexion à la base de données
        $dsn = 'mysql:host=localhost;dbname=rentcar';
        $username = 'root';
        $password = '';

        try {
            $pdo = new PDO($dsn, $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Requête pour récupérer les marques distinctes avec une seule image par marque
            $stmt = $pdo->query("SELECT marque, MIN(image) as image FROM voitures GROUP BY marque");
            $marques = $stmt->fetchAll(PDO::FETCH_ASSOC);
           
            // Boucle sur chaque marque et affichage dynamique
            foreach ($marques as $marque) {
                $marqueName = ucfirst($marque['marque']); // Première lettre en majuscule

                echo '
                    <div class="w-40 max-w-xs bg-gray-50 rounded-lg shadow-lg dark:bg-gray-100 dark:border-gray-700">
                        <a href="reserveByModel.php?marque=' . strtolower($marque['marque']) . '" class="text-decoration-none">
                            <!-- Vehicle Image -->
                            <img src="assets/images/' . htmlspecialchars($marque['image']) . '" class="img-fluid car-img rounded w-full" alt="' . htmlspecialchars($marqueName) . '">
                            
                            <div class="p-5 text-center">
                                <!-- Vehicle Name -->
                                <h5 class="mb-2 text-xl font-bold tracking-tight text-gray-900 dark:text-white text-center">' . htmlspecialchars($marqueName) . '</h5>
                                
                                <!-- Button to View Offers -->
                                
                                <a href="reserveByModel.php?marque=' . strtolower($marque['marque']) . '" class=" text-center inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-blue-900 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                   Voir 
                                    <svg class="rtl:rotate-180 w-3.5 h-3.5 ml-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                                    </svg>
                                </a>
                            </div>
                        </a>
                    </div>';
            }
        } catch (PDOException $e) {
            echo 'Erreur : ' . $e->getMessage();
        } 
        ?>
    </div>
</section>
