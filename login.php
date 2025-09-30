<?php 
session_start();
require 'db.php';

if(isset($_POST['login'])){
    $_SESSION["user_id"]=1;
    header("Location: dashboard.php");
}




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <title>My Money - Welcome</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" crossorigin="anonymous"/>
    <link rel = "stylesheet" href ="style.css">
</head>
<body class="bg-white text-gray-900">
    <div class="flex flex-col min-h-screen">
        <header class="flex items-center justify-between px-10 py-4 border-b border-gray-200">
            <a href="#" class="flex items-center gap-2">
                <i class="fas fa-wallet text-blue-600 text-2xl"></i>
                <h1 class="text-xl font-bold">My Money</h1>
            </a>
            <nav class="hidden md:flex items-center gap-8">
                <a href="#" class="text-gray-600 hover:text-gray-900">Features</a>
                <a href="#" class="text-gray-600 hover:text-gray-900">Pricing</a>
                <a href="#" class="text-gray-600 hover:text-gray-900">Support</a>
            </nav>
            <div class="flex items-center gap-4">
                <a href="signup.php" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 flex items-center justify-center gap-2">
                    Sign Up
                </a>
            </div>
        </header>
        <section class="flex flex-1 items-center justify-center py-12">
            <div class="w-full max-w-md space-y-6 p-6 bg-white rounded-lg shadow">
                <div class="text-center">
                    <h2 class="text-3xl font-extrabold text-gray-900">Welcome Back</h2>
                    <p class="mt-2 text-gray-500">Manage your finances with ease. Get started in seconds.</p>
                </div>
                <form class="space-y-4" method="POST">
                    <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <div class="relative mt-1">
                        <input type="email" id="email" placeholder="you@example.com"
                            class="w-full pl-10 p-3 border border-gray-300 rounded focus:ring-2 focus:ring-blue-600 focus:outline-none" />
                        <i class="fas fa-envelope absolute left-3 top-3 text-gray-400"></i>
                    </div>
                    </div>

                    <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <div class="relative mt-1">
                        <input type="password" id="password" placeholder="••••••••"
                            class="w-full pl-10 p-3 border border-gray-300 rounded focus:ring-2 focus:ring-blue-600 focus:outline-none" />
                        <i class="fas fa-lock absolute left-3 top-3 text-gray-400"></i>
                    </div>
                    </div>

                    <button name="login" class="w-full py-3 bg-blue-600 text-white font-semibold rounded hover:bg-blue-700">
                    Sign in with Email
                    </button>
                </form>

                <div class="space-y-4 flex flex-col">
                    <a href="#" class="py-3 border border-gray-300 rounded flex items-center justify-center gap-2 hover:bg-gray-50">
                        <i class="fab fa-google text-red-500"></i>
                        <span>Continue with Google</span>
                    </a>
                </div>

                <p class="text-center text-gray-500 text-sm">
                    Not A Member?
                    <a href="signup.php" class="text-blue-600 font-semibold hover:underline">Sign Up</a>
                </p>
            </div>
        </section>
    </div>
    
</body>
</html>
