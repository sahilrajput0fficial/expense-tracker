<?php
include 'db.php';

$incomeData = [];
$incomeQuery = $conn->query("SELECT source, income, created_at FROM incomes ORDER BY created_at DESC LIMIT 50");
while ($row = $incomeQuery->fetch_assoc()) {
    $incomeData[] = $row;
}
$expenseData = [];
$expenseQuery = $conn->query("SELECT category, amount, created_at FROM expenses ORDER BY created_at DESC LIMIT 50");
while ($row = $expenseQuery->fetch_assoc()) {
    $expenseData[] = $row;
}
$incomeText = "";
foreach ($incomeData as $i) {
    $incomeText .= "{$i['source']} - ₹{$i['income']} on {$i['created_at']}\n";
}

$expenseText = "";
foreach ($expenseData as $e) {
    $expenseText .= "{$e['category']} - ₹{$e['amount']} on {$e['created_at']}\n";
}
$apiKey = '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';

$totalIncome = $_POST['income'] ?? 0;
$totalExpense = $_POST['expense'] ?? 0;
$savings = $totalIncome - $totalExpense;
$prompt = "💰 Here's a snapshot of my finances:\n\nINCOME:\n$incomeText\n\nEXPENSES:\n$expenseText\n\n"
    . "Analyze my spending habits and savings potential. Give me the top 3 actionable tips to improve my 
    financial health in 60 words or less. Make it clear, practical, and easy to follow!";
$data = [
    "model" => "gpt-4o-mini",
    "messages" => [
        ["role" => "system", "content" => "You are a friendly financial advisor."],
        ["role" => "user", "content" => $prompt]
    ]
];

$ch = curl_init("https://openrouter.ai/api/v1/chat/completions");

curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Authorization: Bearer $apiKey",
    "Content-Type: application/json", 
    "X-Title: Income Tracker AI"
]);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

$response = curl_exec($ch);

if (curl_errno($ch)) {
    echo "cURL Error: " . curl_error($ch);
} else {
    $result = json_decode($response, true);
    $responseText=$result['choices'][0]['message']['content'] ?? "No response received.";
    $responseText = nl2br($responseText);
    $responseText = preg_replace('/\*\*(.*?)\*\*/', '<strong>$1</strong>', $responseText);
    $responseText = preg_replace('/### (.*)/', '<h3 class="font-semibold mt-2">$1</h3>', $responseText);
    $responseText = preg_replace('/^-\s(.*)/m', '<li>$1</li>', $responseText);
    $responseText = str_replace('<br><li>', '<ul class="list-disc pl-5 mt-1"><li>', $responseText);
    $responseText = str_replace('</li><br>', '</li></ul><br>', $responseText);
    curl_close($ch);
    echo (htmlspecialchars_decode($responseText));

    }
var_dump($response);
?>
