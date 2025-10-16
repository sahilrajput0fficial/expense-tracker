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
    $result = $conn->query("SELECT * FROM expenses ORDER BY created_at DESC");
    if(!$result) {
        sendResponse(500, ['message'=>'Database query failed']);
    }

    $expenses = [];
    while($row = $result->fetch_assoc()) {
        $expenses[] = $row;
    }
    sendResponse(200, $expenses);

} elseif ($method == 'POST') {
    $expense_name = $_POST['expense_name'] ?? '';
    $amount= $_POST['amount'] ?? 0;
    $currency='INR';
    $category= $_POST['category'] ?? '';
    $notes= $_POST['notes'] ?? '';
    $frequency = $_POST['frequency'] ?? 'One-time';
    $user_id = $_POST['user_id'] ?? 0;
    $payment_method= $_POST['payment_method'] ?? 'In Cash';

    $insert = $conn->prepare("INSERT INTO expenses (expense_name, amount, currency, category, frequency, user_id, payment_method, notes) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $insert->bind_param("sisssiss", $expense_name, $amount, $currency, $category, $frequency, $user_id, $payment_method, $notes);

    if($insert->execute()){
        $id = $conn->insert_id;

        // insert into recenttransactions
        $recent = $conn->prepare("INSERT INTO recenttransactions (type, category, amount, date_only, description) VALUES ('expense', ?, ?, NOW(), ?)");
        $recent->bind_param("sds", $category, $amount, $notes);
        $recent->execute();
        $recent->close();

        sendResponse(200, ["id"=>$id]);
    } else {
        sendResponse(500, ['message'=>'Insert failed']);
    }
    $insert->close();

} elseif($method == 'PUT'){
    $input = json_decode(file_get_contents("php://input"), true);
    if(!$input) sendResponse(400, ['message'=>'Invalid JSON']);

    $id = $input['id'] ?? null;
    if(!$id) sendResponse(400, ['message'=>'Missing ID']);

    $expense_name = $input['expense_name'] ?? '';
    $amount= $input['amount'] ?? 0;
    $category= $input['category'] ?? '';
    $notes= $input['notes'] ?? '';
    $payment_method= $input['payment_method'] ?? 'In Cash';

    $update = $conn->prepare("UPDATE expenses SET expense_name=COALESCE(?,expense_name), amount=COALESCE(?,amount), category=COALESCE(?,category), notes=COALESCE(?,notes), payment_method=COALESCE(?,payment_method) WHERE id=?");
    $update->bind_param("sisssi", $expense_name, $amount, $category, $notes, $payment_method, $id);

    if($update->execute()){
        sendResponse(200, ["id"=>$id]);
    } else {
        sendResponse(500, ['message'=>'Update failed']);
    }
    $update->close();

} elseif($method=="DELETE"){
    $input = json_decode(file_get_contents("php://input"), true);
    $id = $input['id'] ?? null;
    if(!$id) sendResponse(400, ['message'=>'Missing ID']);

    $delete = $conn->prepare("DELETE FROM expenses WHERE id=?");
    $delete->bind_param("i",$id);

    if($delete->execute()){
        sendResponse(200, ["message"=>"Deletion successful","id"=>$id]);
    } else {
        sendResponse(500, ['message'=>'Delete failed']);
    }
    $delete->close();

} else {
    sendResponse(405, ['message'=>'Method Not Allowed']);
}
?>
