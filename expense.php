<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <title>My Money - Expense</title>
  <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" crossorigin="anonymous" />
  <link rel="stylesheet" href="style.css">
  <script src="https://unpkg.com/@material-tailwind/html@latest/scripts/dialog.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@tailwindplus/elements@1" type="module"></script>
  <script defer src="expense.js"></script>
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
              <form class="space-y-6" method="POST" id="expense_form">
                <div>
                  <label for="expense-name" class="block text-sm font-medium text-gray-700">Expense Name</label>
                  <input id="expense-name" name="expense_name" type="text" placeholder="e.g., Groceries, Rent"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-red-600 focus:ring-red-600 sm:text-sm" />
                </div>

                <div>
                  <label for="amount" class="block text-sm font-medium text-gray-700">Amount</label>
                  <div class="mt-1 relative rounded-md shadow-sm">
                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                      <span class="text-gray-500 sm:text-sm">₹</span>
                    </div>
                    <input id="amount" name="amount" type="number" step="0.01" placeholder="0.00"
                      class="block w-full rounded-md border-gray-300 pl-7 pr-12 focus:border-red-600 focus:ring-red-600 sm:text-sm" />
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                      <span class="text-gray-500 sm:text-sm">INR</span>
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
                  <label for="Notes" class="block text-sm font-medium text-gray-700">Notes</label>
                  <input id="Notes" name="notes" type="text" placeholder="e.g.,Lunch with client"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-red-600 focus:ring-red-600 sm:text-sm" />
                </div>
                <div>
                  <label for="payment_method" class="block text-sm font-medium text-gray-700">Payment Method</label>
                  <input id="payment_method" name="payment_method" type="text" placeholder="e.g.,Credit Card"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-red-600 focus:ring-red-600 sm:text-sm" />
                </div>
                <div>
                  <label for="frequency" class="block text-sm font-medium text-gray-700">Frequency</label>
                  <select id="frequency" name="frequency"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-red-600 focus:ring-red-600 sm:text-sm">
                    <option selected>One-time</option>
                    <option>Monthly</option>
                    <option>Quarterly</option>
                    <option>Annually</option>
                  </select>
                </div>
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
            <div class="overflow-x-hidden rounded-md border border-gray-200 bg-white shadow-sm">
              <table class="w-full text-sm " id="expense">
                <thead class="border-b border-gray-200 bg-gray-50 text-left">
                  <tr>
                    <th class="px-6 py-3 font-medium text-slate-600">Expense Name</th>
                    <th class="px-6 py-3 font-medium text-slate-600">Amount</th>
                    <th class="px-6 py-3 font-medium text-slate-600">Category</th>
                    <th class="px-6 py-3 font-medium text-slate-600">Date</th>
                    <th class="px-6 py-3 font-medium text-slate-600">Payment Method</th>
                    <th class="px-6 py-3 font-medium text-slate-600">Frequency</th>
                    <th class="px-6 py-3 font-medium text-slate-600 text-center">Actions</th>

                  </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                  <tr>
                    <td class="px-6 py-4 text-slate-800">₹50.00</td>
                    <td class="px-6 py-4 text-slate-600">Food</td>
                    <td class="px-6 py-4 text-slate-600">2024-01-15</td>
                    <td class="px-6 py-4 text-slate-600">Credit Card</td>
                    <td class="px-6 py-4 text-slate-600">Lunch with client</td>
                    <td class="px-6 py-4 text-right">
                      <div class="flex items-center justify-end gap-2">
                        <button data-dialog-target="edit-dialog" class="flex h-8 w-8 items-center justify-center rounded-md text-slate-500 hover:bg-gray-100 hover:text-slate-700">
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
  <div data-dialog-backdrop="edit-dialog"
    class="pointer-events-none fixed inset-0 z-[999] grid h-screen w-screen place-items-center bg-gray-500/75 opacity-0 transition-opacity duration-300">
    <div data-dialog="edit-dialog"
      class="relative mx-auto w-full max-w-[28rem] rounded-lg overflow-hidden shadow-sm">
      <div class="relative flex flex-col bg-white">
        <div class="relative p-4 bg-slate-800 text-white text-center">
          <h3 class="text-xl font-semibold">Edit Expense</h3>
          <button type="button"
            class="absolute top-2 bottom-2 right-2  mr-2 flex items-center justify-center rounded-full  hover:text-red-500 transition-colors shadow-md "
            onclick="closeEdit('edit-dialog')"
            aria-label="Close">
            <i class="fa-solid text-2xl fa-xmark hover:text-red-500 "></i>
          </button>


        </div>
        <form id="edit_form" class="p-6 space-y-4">
          <input type="hidden" name="id" id="edit-id">
          <div>
            <label class="block text-sm font-medium text-gray-700">Expense Name</label>
            <input id="edit-expense_name" name="expense_name" type="text"
              class="mt-1 block w-full rounded-md border-gray-300 bg-gray-200" disabled />
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700">Amount</label>
            <input id="edit-amount" name="amount" type="number" step="0.01"
              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-red-600 focus:ring-red-600 sm:text-sm" />
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700">Category</label>
            <input id="edit-category" name="category" type="text"
              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-red-600 focus:ring-red-600 sm:text-sm" />
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700">Notes</label>
            <input id="edit-notes" name="notes" type="text"
              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-red-600 focus:ring-red-600 sm:text-sm" />
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700">Payment Method</label>
            <input id="edit-payment_method" name="payment_method" type="text"
              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-red-600 focus:ring-red-600 sm:text-sm" />
          </div>
          <button type="submit"
            class="w-full rounded-md bg-red-600 py-2 px-4 text-white font-medium hover:bg-red-700">
            Save Changes
          </button>
        </form>
      </div>
    </div>
  </div>
  <div data-dialog-backdrop="note-dialog"
    class="pointer-events-none fixed inset-0 z-[999] grid h-screen w-screen place-items-center bg-gray-500/75 opacity-0 transition-opacity duration-300">
    <div data-dialog="note-dialog"
      class="relative mx-auto w-full max-w-[28rem] rounded-lg overflow-hidden shadow-sm">
      <div class="relative flex flex-col bg-white">
        <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
          <div class="flex bg-slate-800 items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
            <h3 class="text-xl text-white font-medium text-gray-900 dark:text-white">
              Notes
            </h3>
            <button type="button" onclick="closeEdit('note-dialog')" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="small-modal">
              <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
              </svg>
              <span class="sr-only">Close modal</span>
            </button>
          </div>
          <div class="p-4 md:p-5 space-y-4">
            <p id="note-text" class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <el-dialog>
    <dialog id="dialog" aria-labelledby="dialog-title" class="fixed inset-0 size-auto max-h-none max-w-none overflow-y-auto bg-transparent backdrop:bg-transparent">
      <el-dialog-backdrop class="fixed inset-0 bg-gray-500/75 transition-opacity data-closed:opacity-0 data-enter:duration-300 data-enter:ease-out data-leave:duration-200 data-leave:ease-in"></el-dialog-backdrop>

      <div tabindex="0" class="flex min-h-full items-end justify-center p-4 text-center focus:outline-none sm:items-center sm:p-0">
        <el-dialog-panel class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all data-closed:translate-y-4 data-closed:opacity-0 data-enter:duration-300 data-enter:ease-out data-leave:duration-200 data-leave:ease-in sm:my-8 sm:w-full sm:max-w-lg data-closed:sm:translate-y-0 data-closed:sm:scale-95">
          <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
            <div class="sm:flex sm:items-start">
              <div class="mx-auto flex size-12 shrink-0 items-center justify-center rounded-full bg-red-100 sm:mx-0 sm:size-10">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" data-slot="icon" aria-hidden="true" class="size-6 text-red-600">
                  <path d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
              </div>
              <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                <h3 id="dialog-title" class="text-base font-semibold text-gray-900">Delete Expense</h3>
                <div class="mt-2">
                  <p class="text-sm text-gray-500">Are you sure you want to delete your expense? All of your data will be permanently removed. This action cannot be undone.</p>
                </div>
              </div>
            </div>
          </div>
          <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
            <button type="button" command="close" commandfor="dialog" id="delete"class="inline-flex w-full justify-center rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-red-500 sm:ml-3 sm:w-auto">Delete</button>
            <button type="button" command="close" commandfor="dialog" class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-xs inset-ring inset-ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">Cancel</button>
          </div>
        </el-dialog-panel>
      </div>
    </dialog>
  </el-dialog>


</body>
</script>

</html>