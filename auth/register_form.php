<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto mt-10">
        <div class="max-w-md mx-auto bg-white shadow-md rounded-lg overflow-hidden">
            <div class="p-6">
                <h2 class="text-2xl font-semibold text-center">Register</h2>

                <!-- Display Errors -->
                <?php if (isset($errors) && !empty($errors)): ?>
                    <div class="mt-4 bg-red-200 text-red-800 p-3 rounded">
                        <ul>
                            <?php foreach ($errors as $error): ?>
                                <li><?php echo htmlspecialchars($error); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <form action="process_register.php" method="POST">
                    <!-- Name -->
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                        <input type="text" name="name" id="name" class="mt-1 block w-full border-gray-300 rounded-md bg-gray-100  focus:border-blue-500 focus:ring-blue-500 p-2" required>
                    </div>

                    <!-- Email -->
                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" name="email" id="email" class="mt-1 block w-full border-gray-300 bg-gray-100  rounded-md focus:border-blue-500 focus:ring-blue-500 p-2" required>
                    </div>
                    
                    <!-- Password -->
                    <div class="mb-4">
                        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                        <input type="password" name="password" id="password" class="mt-1 block w-full bg-gray-100 border-gray-300 rounded-md focus:border-blue-500 focus:ring-blue-500 p-2" required>
                    </div>

                    <!-- Submit -->
                    <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700">Register</button>
                </form>

                <div class="text-center mt-4">
                    <a href="login_form.php" class="text-blue-600 hover:underline">Already have an account? Login</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
