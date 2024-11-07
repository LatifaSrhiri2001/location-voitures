<?php

$errors = isset($errors) ? $errors : []; 
$success = isset($success) ? $success : ''; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto mt-10">
        <div class="max-w-md mx-auto bg-white p-8 rounded shadow-md">
            <h2 class="text-2xl font-bold text-center mb-4">Register Admin</h2>

            <!-- Affichage des erreurs -->
            <?php if (!empty($errors)): ?>
                <div class="bg-red-100 text-red-700 p-2 rounded mb-4">
                    <ul>
                        <?php foreach ($errors as $error): ?>
                            <li><?php echo htmlspecialchars($error); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <!-- Affichage du message de succès -->
            <?php if (!empty($success)): ?>
                <div class="bg-green-100 text-green-700 p-2 rounded mb-4">
                    <?php echo htmlspecialchars($success); ?>
                </div>
            <?php endif; ?>

            <form action="process_register.php" method="POST">
                <!-- Name -->
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                    <input type="text" name="name" id="name" class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500" value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>" required>
                </div>

                <!-- Email -->
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="email" id="email" class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>" required>
                </div>
                
                <!-- Password -->
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="password" name="password" id="password" class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>

                <!-- Role -->
                <input type="hidden" name="role" value="admin">

                <!-- Submit -->
                <div>
                    <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded hover:bg-blue-600">Register</button>
                </div>

                <div class="mt-4 text-center">
                    <a href="login_form.php" class="text-blue-500">Already have an account? Login here.</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
