
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('#income_form');
    form.onsubmit = async function(event) {
        event.preventDefault();

    const valuefromForm = new FormData(form);
    valuefromForm.append("user_id", 1);
    try {
      let response = await fetch("api/income_api.php", {
        method: 'POST',
        body: valuefromForm
      });
      let data = await response.json();
      console.log(data);
      if (response.ok) {
        console.log('Income added successfully');
        form.reset();
        loadIncome();
      } else {
        alert('Failed to add income: ' + data.message);
      }
    } catch(err) {
      console.error(err);
      alert('Error adding income.');
    }
  };
});
async function loadIncome() {
    try {
        let response = await fetch("api/income_api.php", {
            method: 'GET'
        });
        console.log(response);
        let income = await response.json();
        console.log(income);
        let data = document.querySelector("#income tbody");
        if(data!=null){
            data.innerHTML = '';
        }
        income.forEach(inc => {
            data.innerHTML +=
        `<tr data_row=${inc.id}>
            <td class="px-6 py-4 text-sm font-medium text-gray-900">${inc.source}</td>
            <td class="px-6 py-4 text-sm text-gray-500">₹${inc.income}</td>
            <td class="px-6 py-4 text-sm text-gray-500">${inc.frequency}</td>
            <td>
                <div class=" relative inline-block text-left dropdown-container">
                <button onclick="toggleDropdown(event)" class="inline-flex  w-full justify-center gap-x-1.5 rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-xs inset-ring-1 inset-ring-gray-300 border hover:bg-gray-50">
                    Options
                    <svg viewBox="0 0 20 20" fill="currentColor" data-slot="icon" aria-hidden="true" class="-mr-1 size-5 text-gray-400">
                    <path d="M5.22 8.22a.75.75 0 0 1 1.06 0L10 11.94l3.72-3.72a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.22 9.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" fill-rule="evenodd" />
                    </svg>
                </button>
                <div class="dropdown hidden absolute right-0 mt-2 w-36 bg-white rounded-md shadow-lg ring-1 ring-black ring-opacity-5 z-50">
                    <button data-modal-target="crud-modal" data-modal-toggle="crud-modal" onclick="openEdit(${inc.id},'${inc.source}',${inc.income},'${inc.frequency}')"
                    class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                        <i class="fa-solid fa-pen text-sm"></i> Edit
                    </button>
                    <button command="show-modal" commandfor="dialog" onclick="deleteIncome('${inc.id}')"
                    class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50">
                    <i class="fa-solid fa-trash"></i>
                    Delete
                    </button>
                </div>
                </div>
            </td>
            </tr>`
        });
        initFlowbite();
    } catch (err) {
        console.log(err);
    }
}

async function openEdit(id, source, income, frequency) {
    document.getElementById("edit-id").value = id;
    document.getElementById("edit-source").value = source;
    document.getElementById("edit-income").value = income;
    document.getElementById("edit-frequency").value = frequency;
    const edit_form = document.getElementById("edit-form");
    edit_form.onsubmit = async function (event) {
        event.preventDefault();
        const valuefromForm = new FormData(edit_form);
        valuefromForm.append("user_id", 1);
        const payload = {};
        valuefromForm.forEach((value, key) => {
            payload[key] = value;
        });
        try {
            let response = await fetch("api/income_api.php", {
                method: 'PUT',
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify(payload)
            });
            let data = await response.json();
            if (response.ok) {
                console.log(`Income updated with id ${data.id}`);
                const modal = new Modal(document.getElementById('crud-modal'));
                modal.hide();
                loadIncome();
            } else {
                console.log("Income update failed");
            }
        } catch (err) {
            console.error(err);
        }
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
let deleteId = null;
async function deleteIncome(id) {
    deleteId = id;
    console.log(deleteId);
    let deleteBtn = document.querySelector("#delete");
    deleteBtn.onclick = async function (e) {
        e.preventDefault();
        try {
            let response = await fetch("api/income_api.php", {
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
                console.log(`Deleted the income with id :  ${id}`);
                loadIncome();
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
loadIncome();
