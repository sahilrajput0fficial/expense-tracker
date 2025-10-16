<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
header("Content-Type: application/json");
require '../db.php';

function sendResponse($status, $data) {
    http_response_code($status);
    echo json_encode($data);
    exit;
}

$method = $_SERVER["REQUEST_METHOD"];

if ($method == 'GET') {
    $result = $conn->query("SELECT * FROM incomes ORDER BY created_at DESC");
    $incomes = [];
    while($row = $result->fetch_assoc()) {
        $incomes[] = $row;
    }
    sendResponse(200, $incomes);

} elseif ($method == 'POST') {
    $source = $_POST['source'] ?? '';
    $income = $_POST['income'] ?? 0;
    $frequency = $_POST['frequency'] ?? 'One-time';
    $user_id = $_POST['user_id'] ?? 0;

    $insert = $conn->prepare("INSERT INTO incomes (income, source, frequency, user_id) VALUES (?, ?, ?, ?)");
    $insert->bind_param("issi", $income, $source, $frequency, $user_id);

    if ($insert->execute()) {
        $income_id = $conn->insert_id;

        // Insert into recenttransactions table
        $recent = $conn->prepare("
            INSERT INTO recenttransactions (type, category, amount, date_only, description)
            VALUES ('income', ?, ?, NOW(), ?)
        ");
        $recent->bind_param("sds", $source, $income, $source);
        $recent->execute();
        $recent->close();

        sendResponse(200, ["id" => $income_id]);
    } else {
        sendResponse(500, ['message' => 'Insert failed']);
    }

    $insert->close();

} elseif ($method == 'PUT') {
    $input = json_decode(file_get_contents("php://input"), true);
    $id = $input['id'] ?? null;
    if (!$id) sendResponse(400, ['message' => 'Missing ID']);

    $income = $input['income'] ?? 0;
    $source = $input['source'] ?? '';
    $frequency = $input['frequency'] ?? 'One-time';

    $update = $conn->prepare("UPDATE incomes SET income=?, source=?, frequency=? WHERE id=?");
    $update->bind_param("issi", $income, $source, $frequency, $id);

    if ($update->execute()) {
        sendResponse(200, ["id" => $id]);
    } else {
        sendResponse(500, ['message' => 'Update failed']);
    }

    $update->close();

} elseif ($method == 'DELETE') {
    $input = json_decode(file_get_contents("php://input"), true);
    $id = $input['id'] ?? null;
    if (!$id) sendResponse(400, ['message' => 'Missing ID']);

    $delete = $conn->prepare("DELETE FROM incomes WHERE id=?");
    $delete->bind_param("i", $id);

    if ($delete->execute()) {
        sendResponse(200, ["message" => "Deletion successful", "id" => $id]);
    } else {
        sendResponse(500, ['message' => 'Delete failed']);
    }

    $delete->close();

} else {
    sendResponse(405, ['message' => 'Method Not Allowed']);
}
?>
