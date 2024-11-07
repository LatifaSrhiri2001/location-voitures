<?php

$is_logged_in = isset($_SESSION['user_id']); // Assuming user_id is stored in session
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Location</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body>
    <nav class="bg-gray-50">
        <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
            <div class="relative flex h-16 items-center justify-between">
                <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
                    <!-- Mobile menu button -->
                    <button id="mobile-menu-button" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400" onclick="toggleMobileMenu()">
                        <!-- Icons for menu -->
                        <svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                        </svg>
                        <svg class="hidden h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <div class="flex flex-1 items-center justify-center sm:items-stretch sm:justify-start">
                    <div class="flex flex-shrink-0 items-center">
                        <p class="font-bold text-gray-800 text-2xl"><a href="index.php">RentCar</a></p>
                    </div>
                    <div class="hidden sm:block sm:ml-6">
                        <div class="flex space-x-4">
                            <a href="index.php" class="text-gray-800 px-3 py-2 rounded-md text-sm font-medium">Accueil</a>
                            <a href="#" class="text-gray-800 px-3 py-2 rounded-md text-sm font-medium">Nos voitures</a>
                            <a href="#" class="text-gray-800 px-3 py-2 rounded-md text-sm font-medium">Réservations</a>
                            <a href="#" class="text-gray-800 px-3 py-2 rounded-md text-sm font-medium">Contact</a>
                        </div>
                    </div>
                </div>

                <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
                    <?php if ($is_logged_in): ?>
                        <!-- Profile dropdown -->
                        <div class="relative ml-3">
                            <button id="user-menu-button" class="flex rounded-full bg-gray-800 text-sm" onclick="toggleDropdown()">
                                <span class="sr-only">Open user menu</span>
                                <img class="h-8 w-8 rounded-full" src="assets/images/test.jpeg" alt="User Image">
                            </button>
                            <div id="dropdown-menu" class="hidden absolute right-0 mt-2 w-48 origin-top-right bg-white rounded-md shadow-lg py-1">
                                <a href="auth/profile.php" class="block px-4 py-2 text-sm text-gray-700">Votre Profil</a>
                                <a href="auth/logout.php" class="block px-4 py-2 text-sm text-gray-700">Déconnexion</a>
                            </div>
                        </div>
                    <?php else: ?>
                        <!-- If not logged in, show login link -->
                        <a href="auth/login_form.php" class="text-gray-800 px-3 py-2 rounded-md text-sm font-medium">Connexion</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Mobile menu -->
        <div class="hidden sm:hidden" id="mobile-menu">
            <div class="space-y-1 px-2 pt-2 pb-3">
                <a href="index.php" class="text-gray-300 block px-3 py-2 rounded-md">Accueil</a>
                <a href="#" class="text-gray-300 block px-3 py-2 rounded-md">Nos voitures</a>
                <a href="#" class="text-gray-300 block px-3 py-2 rounded-md">Réservations</a>
                <a href="#" class="text-gray-300 block px-3 py-2 rounded-md">Contact</a>
            </div>
        </div>
    </nav>

    <script>
        function toggleDropdown() {
            const dropdown = document.getElementById("dropdown-menu");
            dropdown.classList.toggle("hidden");
        }

        function toggleMobileMenu() {
            const menu = document.getElementById("mobile-menu");
            menu.classList.toggle("hidden");
        }
    </script>
</body>
</html>
