<?php 
use App\core\Security;

$csrfToken = Security::generateCSRFToken();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gradient-to-r from-gray-900 to-gray-800 text-white">
    <div class="min-h-screen flex items-center justify-center">
        <div class="bg-gray-700 p-8 rounded-lg shadow-xl w-full max-w-md">
            <h2 class="text-3xl font-bold mb-6 text-center">Login</h2>
            
            <?php if (isset($error)): ?>
                <div class="bg-red-600 border border-red-800 text-white px-4 py-3 rounded mb-4">
                    <?php echo Security::sanitizeXSS($error); ?>
                </div>
            <?php endif; ?>

            <?php if (isset($errors)): ?>
                <div class="bg-red-600 border border-red-800 text-white px-4 py-3 rounded mb-4">
                    <ul>
                        <?php foreach ($errors as $field => $error): ?>
                            <li><?php echo Security::sanitizeXSS($error); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form method="POST" action="/MVC/handllogin">
                <input type="hidden" name="csrf_token" value="<?php echo $csrfToken; ?>">
                
                <div class="mb-4">
                    <label class="block text-gray-300 text-sm font-bold mb-2" for="email">Email</label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 bg-gray-800 text-white leading-tight focus:outline-none focus:shadow-outline"
                           id="email"
                           type="email"
                           name="email"
                           value="<?php echo isset($email) ? Security::sanitizeXSS($email) : ''; ?>"
                           required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-300 text-sm font-bold mb-2" for="password">Password</label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 bg-gray-800 text-white leading-tight focus:outline-none focus:shadow-outline"
                           id="password"
                           type="password"
                           name="password"
                           required>
                </div>

                <div class="flex items-center justify-between">
                    <button class="bg-blue-600 hover:bg-blue-800 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                            type="submit">
                        Sign In
                    </button>
                    <a class="inline-block align-baseline font-bold text-sm text-blue-400 hover:text-blue-600"
                       href="/register">
                        Register
                    </a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
