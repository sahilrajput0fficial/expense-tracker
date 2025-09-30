<?php
require "db.php"; 
session_start();
if(!isset($_SESSION["user_id"])){
  header("Location: login.php");
  exit();
}


?>








<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8"/>
<title>My Money Dashboard</title>
<script src="https://cdn.tailwindcss.com"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" crossorigin="anonymous"/>
<link rel ="stylesheet" href ="style.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>
<body class="bg-gray-50">
  <?php include 'header.php'?>

  <main class="flex-1 bg-gray-50/50 px-4 py-8 flex-col">
    <div class="max-w-7xl mx-auto">
      <h2 class="text-3xl font-bold text-gray-800 pl-6">Dashboard</h2>
      <div class="flex flex-wrap gap-6 p-6">
        <div class="flex-1 bg-white p-6 rounded-lg shadow-sm">
          <p class="text-gray-600 font-medium">Total Income</p>
          <p class="text-3xl font-bold text-gray-800">$12,500</p>
        </div>
        <div class="flex-1 bg-white p-6 rounded-lg shadow-sm">
          <p class="text-gray-600 font-medium">Total Expenses</p>
          <p class="text-3xl font-bold text-gray-800">$7,800</p>
        </div>
        <div class="flex-1 bg-white p-6 rounded-lg shadow-sm">
          <p class="text-gray-600 font-medium">Total Savings</p>
          <p class="text-3xl font-bold text-green-600">$4,700</p>
        </div>
      </div>
      <div class="p-6 border-b border-gray-200">
        <div class="flex flex-wrap gap-4">
          <a href="expense.php" 
            class="flex items-center gap-2 bg-red-500 hover:bg-red-600 text-white font-semibold px-4 py-2 rounded-md shadow-sm">
            <i class="fa-solid fa-wallet"></i>
            <span>Add Expense</span>
          </a>
          <a href="budget.php" 
            class="flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded-md shadow-sm">
            <i class="fa-solid fa-plus-circle"></i>
            <span>Add Budget</span>
          </a>
          <a href="income.php" 
            class="flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white font-semibold px-4 py-2 rounded-md shadow-sm">
            <i class="fa-solid fa-money-bill-trend-up"></i>
            <span>Add Income</span>
          </a>
        </div>
      </div>

      <h3 class="text-2xl font-bold px-6 pb-4 pt-6">Spending Overview</h3>
      <div class="flex flex-wrap gap-6 px-6">

        <div class="flex-1 min-w-[280px] bg-white p-6 rounded-lg shadow-sm">
          <div class="flex justify-between items-start mb-4">
            <div>
              <p class="text-gray-600 font-medium">Expenses by Category</p>
              <p class="text-3xl font-bold text-gray-800">$7,800</p>
            </div>
            <div class="flex items-center gap-1 text-green-600">
              <i class="fas fa-arrow-up"></i>
              <p class="text-base font-medium">+12%</p>
            </div>
          </div>
          <div class="bg-white p-6 rounded-lg border border-gray-200">
            <canvas id="expensesChart" height="200"></canvas>
          </div>
        </div>

        <div class="flex-1 min-w-[280px] bg-white p-6 rounded-lg shadow-sm">
          <div class="flex justify-between items-start mb-4">
            <div>
              <p class="text-gray-600 font-medium">Income vs Expenses</p>
              <p class="text-3xl font-bold text-gray-800">$12,500</p>
            </div>
            <div class="flex items-center gap-1 text-red-600">
              <i class="fas fa-arrow-down"></i>
              <p class="text-base font-medium">-5%</p>
            </div>
          </div>
          <div class="bg-white p-6 rounded-lg border border-gray-200">
            <canvas id="incomeChart" height="200"></canvas>
          </div>
        </div>
      </div>
      <h3 class="text-2xl font-bold px-6 pb-4 pt-6">Recent Transactions</h3>
      <div class="px-6 pb-6 overflow-x-auto">
        <table class="w-full min-w-max bg-white rounded-lg shadow-sm border border-gray-200">
          <thead class="bg-gray-50">
            <tr>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Description</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Category</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Amount</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Type</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-200">
            <tr>
              <td class="px-6 py-4 text-sm font-medium text-gray-800">2024-07-15</td>
              <td class="px-6 py-4 text-sm text-gray-600">Grocery shopping at Local Market</td>
              <td class="px-6 py-4"><span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-xs font-medium">Food</span></td>
              <td class="px-6 py-4 text-red-600 font-medium text-sm">-$150.00</td>
              <td class="px-6 py-4 text-sm text-gray-600">Expense</td>
            </tr>
            <tr>
              <td class="px-6 py-4 text-sm font-medium text-gray-800">2024-07-14</td>
              <td class="px-6 py-4 text-sm text-gray-600">Salary deposit</td>
              <td class="px-6 py-4"><span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-xs font-medium">Income</span></td>
              <td class="px-6 py-4 text-green-600 font-medium text-sm">+$5,000.00</td>
              <td class="px-6 py-4 text-sm text-gray-600">Income</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </main>
  <script>
  const ctx1 = document.getElementById('expensesChart').getContext('2d');
  new Chart(ctx1, {
    type: 'doughnut',
    data: {
      labels: ['Groceries', 'Dining Out', 'Entertainment', 'Transport', 'Shopping'],
      datasets: [{
        data: [750, 100, 550, 300, 50], 
        backgroundColor: [
          '#3b82f6', 
          '#f43f5e', 
          '#f59e0b', 
          '#10b981', 
          '#8b5cf6'  
        ],
        borderWidth: 1
      }]
    },
    options: {
      responsive: true,
      plugins: {
        legend: { position: 'bottom' },
      }
    }
  });
  const ctx2 = document.getElementById('incomeChart').getContext('2d');
  new Chart(ctx2, {
    type: 'bar',
    data: {
      labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
      datasets: [
        {
          label: 'Income',
          data: [3000, 3200, 2900, 3100, 3300, 3400],
          backgroundColor: '#10b981'
        },
        {
          label: 'Expenses',
          data: [2500, 2800, 2600, 2700, 3000, 3100],
          backgroundColor: '#ef4444'
        }
      ]
    },
    options: {
      responsive: true,
      plugins: {
        legend: { position: 'bottom' }
      },
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
</script>

</body>
</html>
