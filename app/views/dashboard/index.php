<?php 
use App\core\Security;

$csrfToken = Security::generateCSRFToken();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gradient-to-r from-gray-900 to-gray-800 text-white">
    <div class="min-h-screen flex flex-col">
        <nav class="bg-gray-700 p-4 shadow-lg">
            <div class="container mx-auto flex justify-between items-center">
                <div class="font-bold text-xl">User Dashboard</div>
                <div class="flex items-center space-x-4">
                    <span class="text-gray-300">Welcome, <?php echo htmlspecialchars($user->username); ?></span>
                    <a href="/logout" class="bg-red-600 hover:bg-red-800 text-white font-bold py-2 px-4 rounded">Logout</a>
                </div>
            </div>
        </nav>

        <div class="container mx-auto mt-8 px-4 flex-grow flex items-center justify-center">
            <div class="bg-gray-700 rounded-lg shadow-xl p-8 w-full max-w-lg">
                <h2 class="text-3xl font-bold mb-6 text-center">Your Profile</h2>
                <div class="mb-4 text-gray-300">
                    <p><strong>Username:</strong> <?php echo htmlspecialchars($user->username); ?></p>
                    <p><strong>Email:</strong> <?php echo htmlspecialchars($user->email); ?></p>
                    <p><strong>Role:</strong> <?php echo htmlspecialchars($user->role); ?></p>
                </div>

                
            </div>
        </div>
    </div>
</body>
</html>