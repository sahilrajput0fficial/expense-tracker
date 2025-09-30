<html>
  <head>
    <meta charset="utf-8" />
    <title>My Money - Sign Up</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
    <link rel = "stylesheet" href ="style.css">
  </head>

  <body class="bg-gray-50">
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
                <a href="login.php" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 flex items-center justify-center gap-2">
                    Log In
                </a>
            </div>
        </header>
      <main class="flex flex-1 items-center justify-center py-12">
        <div class="w-full max-w-md bg-white p-8 rounded-lg shadow">
          <div class="text-center mb-6">
            <h1 class="text-2xl font-bold text-gray-900">Create your account</h1>
            <p class="text-gray-500 mt-2">Start tracking your expenses today.</p>
          </div>

          <form class="space-y-4">
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

            <button class="w-full py-3 bg-blue-600 text-white font-semibold rounded hover:bg-blue-700">
              Sign Up
            </button>
          </form>

          <div class="flex items-center my-6">
            <hr class="flex-grow border-gray-200" />
            <span class="mx-2 text-sm text-gray-500">OR</span>
            <hr class="flex-grow border-gray-200" />
          </div>

          <button class="w-full flex items-center justify-center gap-2 py-3 border border-gray-300 rounded hover:bg-gray-50">
            <i class="fab fa-google text-red-500"></i>
            Sign up with Google
          </button>

          <p class="mt-6 text-sm text-gray-500 text-center">
            Already have an account?
            <a href="login.php" class="text-blue-600 hover:underline">Log in</a>
          </p>
        </div>
      </main>
    </div>
  </body>
</html>
