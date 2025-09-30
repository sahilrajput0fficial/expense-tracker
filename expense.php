<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <title>My Money - Expense</title>
  <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" crossorigin="anonymous" />
  <link rel="stylesheet" href="style.css">
</head>

<body class="bg-gray-50">
  <div class="flex flex-col h-screen w-full">
    <?php include 'header.php' ?>

    <main class="flex-1  px-10 py-8">
      <div class="mx-auto max-w-7xl">
        <div class="mb-8 flex items-center justify-between">
          <h1 class="text-3xl font-bold text-slate-900">Expenses</h1>
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
          <div class="col-span-1">
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
              <h3 class="text-lg font-semibold mb-6">Add New Expense</h3>
              <form class="space-y-6">
                <div>
                  <label for="expense-name" class="block text-sm font-medium text-gray-700">Expense Name</label>
                  <input id="expense-name" name="expense-name" type="text" placeholder="e.g., Groceries, Rent"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-red-600 focus:ring-red-600 sm:text-sm" />
                </div>

                <div>
                  <label for="amount" class="block text-sm font-medium text-gray-700">Amount</label>
                  <div class="mt-1 relative rounded-md shadow-sm">
                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                      <span class="text-gray-500 sm:text-sm">$</span>
                    </div>
                    <input id="amount" name="amount" type="number" step="0.01" placeholder="0.00"
                      class="block w-full rounded-md border-gray-300 pl-7 pr-12 focus:border-red-600 focus:ring-red-600 sm:text-sm" />
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                      <span class="text-gray-500 sm:text-sm">USD</span>
                    </div>
                  </div>
                </div>
                <div>
                  <label for="category" class="block text-sm font-medium text-gray-700">Category</label>
                  <select id="category" name="category"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-red-600 focus:ring-red-600 sm:text-sm">
                    <option>Food</option>
                    <option>Rent</option>
                    <option>Transportation</option>
                    <option>Entertainment</option>
                    <option>Other</option>
                  </select>
                </div>
                <div>
                  <label for="frequency" class="block text-sm font-medium text-gray-700">Frequency</label>
                  <select id="frequency" name="frequency"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-red-600 focus:ring-red-600 sm:text-sm">
                    <option>One-time</option>
                    <option selected>Monthly</option>
                    <option>Quarterly</option>
                    <option>Annually</option>
                  </select>
                </div>

                <!-- Submit Button -->
                <button type="submit"
                  class="w-full flex justify-center items-center gap-2 py-2.5 px-4 rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:ring-2 focus:ring-offset-2 focus:ring-red-600">
                  <i class="fa-solid fa-plus text-sm"></i>
                  Add Expense
                </button>
              </form>
            </div>
          </div>

          <div class="col-span-2">
            <div class="mb-6 flex items-center gap-4">
              <div class="relative flex-1">
                <input type="text" placeholder="Search expenses..."
                  class="w-full rounded-md border border-gray-300 bg-white py-2 pl-2 pr-4 text-sm shadow-sm focus:border-blue-500 focus:ring-blue-500" />
              </div>
            </div>
            <div class="overflow-hidden rounded-md border border-gray-200 bg-white shadow-sm">
              <table class="w-full text-sm">
                <thead class="border-b border-gray-200 bg-gray-50 text-left">
                  <tr>
                    <th class="px-6 py-3 font-medium text-slate-600">Amount</th>
                    <th class="px-6 py-3 font-medium text-slate-600">Category</th>
                    <th class="px-6 py-3 font-medium text-slate-600">Date</th>
                    <th class="px-6 py-3 font-medium text-slate-600">Payment Method</th>
                    <th class="px-6 py-3 font-medium text-slate-600">Notes</th>
                    <th class="px-6 py-3 font-medium text-slate-600 text-right">Actions</th>
                  </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                  <tr>
                    <td class="px-6 py-4 text-slate-800">$50.00</td>
                    <td class="px-6 py-4 text-slate-600">Food</td>
                    <td class="px-6 py-4 text-slate-600">2024-01-15</td>
                    <td class="px-6 py-4 text-slate-600">Credit Card</td>
                    <td class="px-6 py-4 text-slate-600">Lunch with client</td>
                    <td class="px-6 py-4 text-right">
                      <div class="flex items-center justify-end gap-2">
                        <button class="flex h-8 w-8 items-center justify-center rounded-md text-slate-500 hover:bg-gray-100 hover:text-slate-700">
                          <span> <i class="fa-solid fa-pen-to-square"></i></span>
                        </button>
                        <button class="flex h-8 w-8 items-center justify-center rounded-md text-slate-500 hover:bg-red-50 hover:text-red-600">
                          <span> <i class="fa-solid fa-trash"></i> </span>
                        </button>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </main>
  </div>

</body>

</html>