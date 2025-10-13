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
    $expenses = [];
    while($row = $result->fetch_assoc()) {
        $expenses[] = $row;
    }
    sendResponse(200, $expenses);
    exit();
} elseif ($method == 'POST') {
    $expense_name = $_POST['expense_name'] ?? '';
    $amount= $_POST['amount'] ?? 0;
    $currency='INR';
    $category= $_POST['category'] ?? '';
    $notes= $_POST['notes'] ?? '';
    $frequency = $_POST['frequency'] ?? 'One-time';
    $user_id = $_POST['user_id'] ?? 0;
    $payment_method= $_POST['payment_method'] ?? 'In Cash';
    // if (!$expense_name || !$amount || !$category || !$payment_method || !$user_id) {
    //     http_response_code(400);
    //     echo json_encode(['message' => 'Please fill in all required fields.']);
    //     exit();
    // }
    $insert = $conn->prepare("INSERT INTO expenses (expense_name, amount, currency, category, frequency, user_id, payment_method,notes) 
     VALUES (?, ?, ?,?,?,?,?,?)");
    $insert->bind_param("sisssiss",$expense_name,$amount,$currency,$category,$frequency,$user_id,$payment_method,$notes);
    if($insert->execute()){
        sendResponse(200, ["id" => $conn->insert_id,"frequency"=>$frequency]);
        exit();
    }
    else {
        http_response_code(500);
        echo json_encode(['message' => 'Insert failed']);
    }    
} elseif($method == 'PUT'){
    $input = json_decode(file_get_contents("php://input"), true);
    $id = $input['id'] ?? 1;
    $expense_name = $input['expense_name'] ?? '';
    $amount= $input['amount'] ?? 0;
    $category= $input['category'] ?? '';
    $notes= $input['notes'] ?? '';
    $frequency = $input['frequency'] ?? 'One-time';
    $user_id = $input['user_id'] ?? 0;
    $payment_method= $input['payment_method'] ?? 'In Cash';

    $update = $conn->prepare("UPDATE expenses set expense_name=COALESCE(?,expense_name), amount=COALESCE(?,amount), category=COALESCE(?,category), notes=COALESCE(?,notes), payment_method=COALESCE(?,payment_method) where id=?");
    $update->bind_param("sisssi",$expense_name,$amount,$category,$notes,$payment_method,$id);
    if($update->execute()){
        sendResponse(200, ["id" => $id]);
        exit();
    }
    else {
        sendResponse(500,['message' => 'Insert failed']);
    }
}elseif($method=="DELETE"){
    $input = json_decode(file_get_contents("php://input"), true);
    $id = $input['id'] ?? 1;
    $delete = $conn -> prepare("DELETE from expenses where id=?");
    $delete->bind_param("i",$id);
    if($delete->execute()){
        sendResponse(200,["message"=>"Deletion successful","id"=>$id]);
    }
    else{
        sendResponse(500,['message' => 'Delete failed']);
    }

    

    
}





?>
