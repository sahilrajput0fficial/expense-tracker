document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('#expense_form');
    form.onsubmit = async function(event) {
        event.preventDefault();

    const valuefromForm = new FormData(form);
    valuefromForm.append("user_id", 1);
    try {
      let response = await fetch("api/expense_api.php", {
        method: 'POST',
        body: valuefromForm
      });
      let data = await response.json();
      console.log(data);
      if (response.ok) {
        console.log('Expense added successfully');
        form.reset();
        loadExpenses();
      } else {
        alert('Failed to add expense: ' + data.message);
      }
    } catch(err) {
      console.error(err);
      alert('Error adding expense.');
    }
  };
});

async function loadExpenses() {
    try {
        let response = await fetch("api/expense_api.php", {
            method: 'GET'
        });
        console.log(response);
        let expenses = await response.json();
        console.log(expenses);
        let data = document.querySelector("#expense tbody");
        if(data == null) {
            console.log("tbody not found, creating one");
            const table = document.querySelector("#expense");
            data = document.createElement('tbody');
            data.className = 'divide-y divide-gray-200';
            table.appendChild(data);
        }
        data.innerHTML = '';
        expenses.forEach(exp => {
            data.innerHTML += `
        <tr data_row=${exp.id}>
          <td class="px-6 py-4 text-slate-800">${exp.expense_name}</td>
          <td class="px-6 py-4 text-slate-800">₹${exp.amount}</td>
          <td class="px-6 py-4 text-slate-600">${exp.category}</td>
          <td class="px-6 py-4 text-slate-600">${exp.created_at}</td>
          <td class="px-6 py-4 text-slate-600">${exp.payment_method}</td>
          <td class="px-6 py-4 text-slate-600">${exp.frequency}</td>
          <td class="px-6 py-4 text-right">
            <div class=" relative inline-block text-left dropdown-container">
              <button onclick="toggleDropdown(event)" class="inline-flex w-full justify-center gap-x-1.5 rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-xs inset-ring-1 inset-ring-gray-300 border hover:bg-gray-50">
                Options
                <svg viewBox="0 0 20 20" fill="currentColor" data-slot="icon" aria-hidden="true" class="-mr-1 size-5 text-gray-400">
                  <path d="M5.22 8.22a.75.75 0 0 1 1.06 0L10 11.94l3.72-3.72a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.22 9.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" fill-rule="evenodd" />
                </svg>
              </button>
              <div class="dropdown hidden absolute right-0 mt-2 w-36 bg-white rounded-md shadow-lg ring-1 ring-black ring-opacity-5 z-50">
                <button onclick="openEdit('${exp.id}', '${exp.expense_name}', '${exp.amount}', '${exp.category}', '${exp.notes}', '${exp.payment_method}')"
                  class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                  <i class="fa-solid fa-pen-to-square"></i>
                  Edit
                </button>
                <button onclick="openNotes('${exp.id}','${exp.notes}')"
                  class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                  <i class="fa-solid fa-note-sticky"></i>
                  Notes
                </button>

                <button command="show-modal" commandfor="dialog" onclick="deleteExpense('${exp.id}')"
                  class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50">
                  <i class="fa-solid fa-trash"></i>
                  Delete
                </button>
              </div>
            </div>
          </td>
          
          
        </tr>`

        });

    } catch (err) {
        console.log(err);
    }

}
function toggleDropdown(event) {
    const dropdown = event.currentTarget.nextElementSibling;
    console.log(dropdown);
    document.querySelectorAll('.dropdown').forEach(el => {
        if (el !== dropdown) {
            el.classList.add('hidden');
        }
    });
    dropdown.classList.toggle('hidden');
}
document.addEventListener('click', e => {
    if (!e.target.closest('.dropdown-container')) {
        document.querySelectorAll('.dropdown').forEach(el => {
            el.classList.add('hidden');
        });
    }
});
async function openEdit(id, name, amount, category, notes, method) {
    document.getElementById("edit-id").value = id;
    document.getElementById("edit-expense_name").value = name;
    document.getElementById("edit-amount").value = amount;
    document.getElementById("edit-category").value = category;
    document.getElementById("edit-notes").value = notes;
    document.getElementById("edit-payment_method").value = method;
    const backdrop = document.querySelector('[data-dialog-backdrop="edit-dialog"]');
    const dialog = document.querySelector('[data-dialog="edit-dialog"]');
    if (backdrop && dialog) {
        backdrop.classList.remove("pointer-events-none", "opacity-0");
        backdrop.classList.add("pointer-events-auto", "opacity-100");
        dialog.classList.add("scale-100");
    }
    let edit_form = document.getElementById("edit_form");
    edit_form.addEventListener("submit", async function (event) {
        event.preventDefault();
        const valuefromForm = new FormData(edit_form);
        console.log(valuefromForm.id);
        valuefromForm.append("user_id", 1);
        const payload = {};
        valuefromForm.forEach((value, key) => {
            payload[key] = value;
        });
        console.log(payload);

        try {
            console.log("START");
            let response = await fetch("api/expense_api.php", {
                method: 'PUT',
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify(payload)
            });
            let data = await response.json();
            if (response.ok) {
                console.log(`expense updated with id with ${data.id}`);
                closeEdit("edit-dialog");
                loadExpenses();
            } else {
                console.log(`expense updation failed`);
            }

        } catch (err) {
            console.log(err);
        }
    })
}

function closeEdit(dialog_name) {
    const backdrop = document.querySelector(`[data-dialog-backdrop="${dialog_name}"]`);
    const dialog = document.querySelector(`[data-dialog="${dialog_name}"]`);
    if (backdrop && dialog) {
        backdrop.classList.remove("pointer-events-auto", "opacity-100");
        backdrop.classList.add("pointer-events-none", "opacity-0");
        dialog.classList.remove("scale-100");
    }

}

function openNotes(id, notes) {
    document.getElementById("note-text").innerText = notes;
    const backdrop = document.querySelector('[data-dialog-backdrop="note-dialog"]');
    const dialog = document.querySelector('[data-dialog="note-dialog"]');
    if (backdrop && dialog) {
        backdrop.classList.remove("pointer-events-none", "opacity-0");
        backdrop.classList.add("pointer-events-auto", "opacity-100");
        dialog.classList.add("scale-100");
    }

}
let deleteId = null;
async function deleteExpense(id) {
    deleteId = id;
    let deleteBtn = document.querySelector("#delete");
    deleteBtn.onclick = async function (e) {
        e.preventDefault();
        try {
            let response = await fetch("api/expense_api.php", {
                method: "DELETE",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({ "id": deleteId })
            });
            let data = await response.json();
            console.log(response);
            console.log(data);
            if (response.ok) {
                console.log(`Deleted the expense with id :  ${id}`);
                loadExpenses();
                deleteId = null;
                document.getElementById("dialog").close();
            }
            else {
                console.log("Failed");

            }
        }
        catch (err) {
            console.log(err);

        }

    }
}
loadExpenses();
