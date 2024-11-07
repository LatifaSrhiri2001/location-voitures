<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto mt-10">
        <div class="max-w-md mx-auto bg-white shadow-md rounded-lg overflow-hidden">
            <div class="p-6">
                <h2 class="text-2xl font-semibold text-center">Login</h2>
                
                <?php if (!empty($errors)): ?>
                    <div class="mt-4 bg-red-200 text-red-800 p-3 rounded">
                        <ul>
                            <?php foreach ($errors as $error): ?>
                                <li><?php echo htmlspecialchars($error); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>
                
                <form action="process_login.php" method="POST">
                    <!-- Email -->
                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" name="email" id="email" class="mt-1 block w-full border-gray-300 bg-gray-100 rounded-md  focus:border-blue-500 focus:ring-blue-500 p-2" required value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
                    </div>

                    <!-- Password -->
                    <div class="mb-4">
                        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                        <input type="password" name="password" id="password" class="mt-1 bg-gray-100 block w-full border-gray-300 rounded-md  focus:border-blue-500 focus:ring-blue-500 p-2" required>
                    </div>

                    <!-- Submit -->
                    <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700">Login</button>
                </form>

                <div class="text-center mt-4">
                    <a href="register_form.php" class="text-blue-600 hover:underline">Don't have an account? Register</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>
</html>
