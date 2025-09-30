<html>
<head>
  <meta charset="utf-8"/>
  <title>Budget Dashboard</title>
  <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet"/>
  <link rel="stylesheet" href="style.css"/>
</head>
<body class="bg-gray-50">
  <?php include 'header.php'?>
  <div class="relative flex w-full flex-col">
    <div class="flex flex-col">
      <header class="bg-white p-6 pb-0 w-full">
        <div class="flex justify-between items-center">
          <div>
            <h1 class="text-2xl font-bold text-gray-900">Budgets</h1>
            <p class="text-gray-500 text-sm mt-1">Set and manage your budgets to stay on track with your financial goals.</p>
          </div>
          <button class="flex items-center justify-center gap-2 rounded-md h-10 px-4 bg-[var(--primary-color)] text-white text-sm font-bold hover:bg-blue-700">
            <i class="fa-solid fa-plus"></i>
            <span class="truncate">Add Budget</span>
          </button>
        </div>
        <div class="mt-6">
          <div class="flex border-b border-gray-200">
            <a class="flex items-center justify-center border-b-2 border-blue-600 text-blue-600 pb-3 px-4" href="#">
              <p class="text-sm font-bold">Monthly</p>
            </a>
            <a class="flex items-center justify-center border-b-2 border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 pb-3 px-4" href="#">
              <p class="text-sm font-bold">Weekly</p>
            </a>
          </div>
        </div>
      </header>
      <main class="p-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 w-full">
        <div class="bg-white p-6 rounded-lg border border-gray-200 flex flex-col gap-4">
          <div class="flex items-start justify-between gap-4">
            <div class="flex-1">
              <h3 class="text-lg font-bold text-gray-900">Groceries</h3>
              <p class="text-sm text-gray-500 mt-1"><span class="font-semibold text-gray-700">$250</span> remaining</p>
            </div>
            <button class="text-gray-400 hover:text-gray-600"><i class="fa-solid fa-ellipsis-vertical"></i></button>
          </div>
          <div class="flex flex-col gap-2">
            <div class="flex justify-between text-sm">
              <p class="text-gray-700 font-medium">Spent: $750</p>
              <p class="text-gray-500">75%</p>
            </div>
            <div class="w-full bg-gray-200 rounded-full h-2.5">
              <div class="bg-blue-600 h-2.5 rounded-full" style="width: 75%"></div>
            </div>
            <p class="text-sm text-gray-500 text-right">Budget: $1000</p>
          </div>
        </div>
        <div class="bg-white p-6 rounded-lg border border-gray-200 flex flex-col gap-4">
          <div class="flex items-start justify-between gap-4">
            <div class="flex-1">
              <h3 class="text-lg font-bold text-gray-900">Dining Out</h3>
              <p class="text-sm text-gray-500 mt-1"><span class="font-semibold text-gray-700">$100</span> remaining</p>
            </div>
            <button class="text-gray-400 hover:text-gray-600"><i class="fa-solid fa-ellipsis-vertical"></i></button>
          </div>
          <div class="flex flex-col gap-2">
            <div class="flex justify-between text-sm">
              <p class="text-gray-700 font-medium">Spent: $100</p>
              <p class="text-gray-500">50%</p>
            </div>
            <div class="w-full bg-gray-200 rounded-full h-2.5">
              <div class="bg-blue-600 h-2.5 rounded-full" style="width: 50%"></div>
            </div>
            <p class="text-sm text-gray-500 text-right">Budget: $200</p>
          </div>
        </div>
        <div class="bg-white p-6 rounded-lg border border-gray-200 flex flex-col gap-4">
          <div class="flex items-start justify-between gap-4">
            <div class="flex-1">
              <h3 class="text-lg font-bold text-gray-900">Entertainment</h3>
              <p class="text-sm text-gray-500 mt-1"><span class="font-semibold text-red-600">$50</span> over budget</p>
            </div>
            <button class="text-gray-400 hover:text-gray-600"><i class="fa-solid fa-ellipsis-vertical"></i></button>
          </div>
          <div class="flex flex-col gap-2">
            <div class="flex justify-between text-sm">
              <p class="text-gray-700 font-medium">Spent: $550</p>
              <p class="text-red-600 font-semibold">110%</p>
            </div>
            <div class="w-full bg-gray-200 rounded-full h-2.5 overflow-hidden">
              <div class="bg-red-500 h-2.5 rounded-full" style="width: 110%"></div>
            </div>
            <p class="text-sm text-gray-500 text-right">Budget: $500</p>
          </div>
        </div>
        <div class="bg-white p-6 rounded-lg border border-gray-200 flex flex-col gap-4">
          <div class="flex items-start justify-between gap-4">
            <div class="flex-1">
              <h3 class="text-lg font-bold text-gray-900">Transportation</h3>
              <p class="text-sm text-gray-500 mt-1"><span class="font-semibold text-gray-700">$200</span> remaining</p>
            </div>
            <button class="text-gray-400 hover:text-gray-600"><i class="fa-solid fa-ellipsis-vertical"></i></button>
          </div>
          <div class="flex flex-col gap-2">
            <div class="flex justify-between text-sm">
              <p class="text-gray-700 font-medium">Spent: $300</p>
              <p class="text-gray-500">60%</p>
            </div>
            <div class="w-full bg-gray-200 rounded-full h-2.5">
              <div class="bg-blue-600 h-2.5 rounded-full" style="width: 60%"></div>
            </div>
            <p class="text-sm text-gray-500 text-right">Budget: $500</p>
          </div>
        </div>
        <div class="bg-white p-6 rounded-lg border border-gray-200 flex flex-col gap-4">
          <div class="flex items-start justify-between gap-4">
            <div class="flex-1">
              <h3 class="text-lg font-bold text-gray-900">Shopping</h3>
              <p class="text-sm text-gray-500 mt-1"><span class="font-semibold text-green-600">$150</span> remaining</p>
            </div>
            <button class="text-gray-400 hover:text-gray-600"><i class="fa-solid fa-ellipsis-vertical"></i></button>
          </div>
          <div class="flex flex-col gap-2">
            <div class="flex justify-between text-sm">
              <p class="text-gray-700 font-medium">Spent: $50</p>
              <p class="text-gray-500">25%</p>
            </div>
            <div class="w-full bg-gray-200 rounded-full h-2.5">
              <div class="bg-green-500 h-2.5 rounded-full" style="width: 25%"></div>
            </div>
            <p class="text-sm text-gray-500 text-right">Budget: $200</p>
          </div>
        </div>

      </main>
    </div>
  </div>
</body>
</html>
