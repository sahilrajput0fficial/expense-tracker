<?php
require "db.php"; 
session_start();
if(!isset($_SESSION["user_id"])){
  header("Location: login.php");
  exit();
}
$recentSql = "SELECT * FROM recenttransactions LIMIT 20";
$recentResult = $conn->query($recentSql);

$incomeSql = "SELECT * FROM income_sum";
$income = $conn->query($incomeSql);
$incomeResult = $income->fetch_assoc();
$Tincome = intval(($incomeResult["sum_income"]));

$expSql = "SELECT * FROM expense_sum";
$exp = $conn->query($expSql);
$expResult = $exp->fetch_assoc();
$Texpense = intval(($expResult["sum_exp"]));
$Tsaving = $Tincome - $Texpense;
$colors = ['blue', 'green', 'red', 'yellow', 'purple', 'indigo', 'pink', 'orange', 'teal', 'cyan'];
$text_color = $Tsaving>0?"green":"red" ;
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
      <p class="mt-1 text-sm text-gray-500 pl-6">This Month</p>
      <div class="flex flex-wrap gap-6 p-6">
        <div class="flex-1 bg-white p-6 rounded-lg shadow-sm">
          <p class="text-gray-600 font-medium">Total Income</p>
          <p class="text-3xl font-bold text-gray-800">₹<?php echo $Tincome ?></p>
        </div>
        <div class="flex-1 bg-white p-6 rounded-lg shadow-sm">
          <p class="text-gray-600 font-medium">Total Expenses</p>
          <p class="text-3xl font-bold text-gray-800">₹<?php echo $Texpense?></p>
        </div>

        <div class="flex-1 bg-white p-6 rounded-lg shadow-sm">
          <p class="text-gray-600 font-medium">Total Savings</p>
          <p class="text-3xl font-bold text-<?php echo $text_color?>-600">₹<?php echo $Tsaving?></p>
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
      <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 m-6">
        <h3 class="text-xl font-bold text-gray-800 flex items-center gap-2">
          <i class="fa-solid fa-robot text-indigo-600"></i> Smart AI Suggestion
        </h3>
        <p id="aiSuggestion" class="text-gray-700 mt-3 italic">Analyzing your finances...</p>
      </div>
      <h3 class="text-2xl font-bold px-6 pb-4 pt-6">Spending Overview</h3>
      <div class="flex flex-wrap gap-6 px-6">

        <div class="flex-1 min-w-[280px] bg-white p-6 rounded-lg shadow-sm">
          <div class="flex justify-between items-start mb-4">
            <div>
              <p class="text-gray-600 font-medium">Expenses by Category</p>
              <p class="text-3xl font-bold text-gray-800">₹7,800</p>
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
              <p class="text-3xl font-bold text-gray-800">₹12,500</p>
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
          <?php
          if ($recentResult && $recentResult->num_rows > 0) {
              while ($row = $recentResult->fetch_assoc()) {
                  $color = $colors[array_rand($colors)];
                  $type = ucfirst($row['type']); 
                  $amountSign = $type === 'Expense' ? '-' : '+';
                  $amountColor = $type === 'Expense' ? 'text-red-600' : 'text-green-600';
                  echo "<tr>
                      <td class='px-6 py-4 text-sm font-medium text-gray-800'>" . htmlspecialchars($row['date_only']) . "</td>
                      <td class='px-6 py-4 text-sm text-gray-600'>" . htmlspecialchars($row['description']) . "</td>
                      <td class='px-6 py-4'><span class='px-3 py-1 rounded-full text-xs font-medium bg-{$color}-100 text-{$color}-800'>" . htmlspecialchars($row['category']) . "</span></td>
                      <td class='px-6 py-4 $amountColor font-medium text-sm'>{$amountSign}₹" . number_format($row['amount'], 2) . "</td>
                      <td class='px-6 py-4 text-sm text-gray-600'>$type</td>
                  </tr>";
              }
          } else {
              echo "<tr><td colspan='5' class='px-6 py-4 text-sm text-gray-500 text-center'>No recent transactions found.</td></tr>";
          }
          ?>
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
<script>

async function loadAISuggestion() {
  const response = await fetch('ai_suggestion.php', {
    method: 'POST',
    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
    body: new URLSearchParams({
      income: <?= $Tincome ?>,
      expense: <?= $Texpense ?>
    })
  });
  const text = await response.text();
  document.getElementById('aiSuggestion').innerHTML = text;
}
loadAISuggestion();
</script>

</body>
</html>
