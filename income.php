<html>
<head>
  <meta charset="utf-8"/>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" rel="stylesheet"/>
  <title>Income Track</title>
  <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
  <link rel = "stylesheet" href ="style.css">
</head>
<body class="bg-gray-50">
<div class="flex flex-col h-screen w-full">
  <?php include 'header.php'?>

    
    <main class="flex-1 bg-gray-50/50 px-4 py-8 sm:px-6 lg:px-8">
      <div class="max-w-7xl mx-auto">
        <header class="mb-8">
          <h1 class="text-3xl font-bold text-gray-900">Income Tracking</h1>
          <p class="mt-1 text-sm text-gray-500">Log your income sources to track your financial inflows.</p>
        </header>
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
          <div class="col-span-1">
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
              <h3 class="text-lg font-semibold mb-6">Add New Income</h3>
              <form class="space-y-6">
                <div>
                  <label for="source-name" class="block text-sm font-medium text-gray-700">Source Name</label>
                  <input id="source-name" name="source-name" type="text" placeholder="e.g., Salary, Freelance"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-600 focus:ring-blue-600 sm:text-sm"/>
                </div>
                <div>
                  <label for="amount" class="block text-sm font-medium text-gray-700">Amount</label>
                  <div class="mt-1 relative rounded-md shadow-sm">
                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                      <span class="text-gray-500 sm:text-sm">$</span>
                    </div>
                    <input id="amount" name="amount" type="number" step="0.01" placeholder="0.00"
                      class="block w-full rounded-md border-gray-300 pl-7 pr-12 focus:border-blue-600 focus:ring-blue-600 sm:text-sm"/>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                      <span class="text-gray-500 sm:text-sm">USD</span>
                    </div>
                  </div>
                </div>
                <div>
                  <label for="frequency" class="block text-sm font-medium text-gray-700">Frequency</label>
                  <select id="frequency" name="frequency"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-600 focus:ring-blue-600 sm:text-sm">
                    <option>One-time</option>
                    <option selected>Monthly</option>
                    <option>Quarterly</option>
                    <option>Annually</option>
                  </select>
                </div>
                <button type="submit"
                  class="w-full flex justify-center items-center gap-2 py-2.5 px-4 rounded-md shadow-sm text-sm font-medium text-white bg-[var(--primary-color)] hover:bg-blue-700 focus:ring-2 focus:ring-offset-2 focus:ring-blue-600">
                  <i class="fa-solid fa-plus text-sm"></i>
                  Add Income
                </button>
              </form>
            </div>
          </div>
          <div class="col-span-2">
            <div class="bg-white rounded-xl shadow-sm border border-gray-200">
              <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold">Logged Income Sources</h3>
              </div>
              <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                  <thead class="bg-gray-50">
                    <tr>
                      <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Source</th>
                      <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Amount</th>
                      <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Frequency</th>
                      <th class="px-6 py-3"></th>
                    </tr>
                  </thead>
                  <tbody class="bg-white divide-y divide-gray-200">
                    <tr>
                      <td class="px-6 py-4 text-sm font-medium text-gray-900">Salary</td>
                      <td class="px-6 py-4 text-sm text-gray-500">$5,000.00</td>
                      <td class="px-6 py-4 text-sm text-gray-500">Monthly</td>
                      <td class="px-6 py-4 text-right text-sm">
                        <a href="#" class="text-blue-600 hover:text-blue-900 flex items-center gap-1">
                          <i class="fa-solid fa-pen text-sm"></i> Edit
                        </a>
                      </td>
                    </tr>
                    <tr>
                      <td class="px-6 py-4 text-sm font-medium text-gray-900">Freelance Project</td>
                      <td class="px-6 py-4 text-sm text-gray-500">$1,500.00</td>
                      <td class="px-6 py-4 text-sm text-gray-500">One-time</td>
                      <td class="px-6 py-4 text-right text-sm">
                        <a href="#" class="text-blue-600 hover:text-blue-900 flex items-center gap-1">
                          <i class="fa-solid fa-pen text-sm"></i> Edit
                        </a>
                      </td>
                    </tr>
                    <tr>
                      <td class="px-6 py-4 text-sm font-medium text-gray-900">Investment Dividend</td>
                      <td class="px-6 py-4 text-sm text-gray-500">$800.00</td>
                      <td class="px-6 py-4 text-sm text-gray-500">Quarterly</td>
                      <td class="px-6 py-4 text-right text-sm">
                        <a href="#" class="text-blue-600 hover:text-blue-900 flex items-center gap-1">
                          <i class="fa-solid fa-pen text-sm"></i> Edit
                        </a>
                      </td>
                    </tr>
                    <tr>
                      <td class="px-6 py-4 text-sm font-medium text-gray-900">Rental Income</td>
                      <td class="px-6 py-4 text-sm text-gray-500">$1,200.00</td>
                      <td class="px-6 py-4 text-sm text-gray-500">Monthly</td>
                      <td class="px-6 py-4 text-right text-sm">
                        <a href="#" class="text-blue-600 hover:text-blue-900 flex items-center gap-1">
                          <i class="fa-solid fa-pen text-sm"></i> Edit
                        </a>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

        </div>
      </div>
    </main>
  </div>
</div>
</body>
</html>
