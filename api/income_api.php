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
    $expenses = [];
    while($row = $result->fetch_assoc()) {
        $expenses[] = $row;
    }
    sendResponse(200, $expenses);
    exit();
} elseif ($method == 'POST') {
    $source = $_POST['source'] ?? '';
    $income = $_POST['income'] ?? 0;
    $frequency = $_POST['frequency'] ?? 'One-time';
    $user_id = $_POST['user_id'] ?? 0;
    // if (!$income || !$source || !$frequency||!$user_id) {
    //     http_response_code(400);
    //     echo json_encode(['message' => 'Please fill in all required fields.']);
    //     exit();
    // }
    $insert = $conn->prepare("INSERT INTO incomes (income, source, frequency, user_id) 
     VALUES (?, ?, ?,?)");
    $insert->bind_param("issi",$income,$source,$frequency,$user_id);
    if($insert->execute()){
        sendResponse(200, ["id" => $conn->insert_id]);
        exit();
    }
    else {
        http_response_code(500);
        echo json_encode(['message' => 'Insert failed']);
    }    
} elseif($method == 'PUT'){
    $input = json_decode(file_get_contents("php://input"), true);
    $id = $input['id'] ?? 1;
    $income= $input['income'] ?? 0;
    $source= $input['source'] ?? '';
    $frequency = $input['frequency'] ?? 'One-time';
    $user_id = $input['user_id'] ?? 0;

    $update = $conn->prepare("UPDATE incomes set income=COALESCE(?,income), source=COALESCE(?,source), frequency=COALESCE(?,frequency) where id=?");
    $update->bind_param("issi",$income,$source,$frequency,$id);
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
    $delete = $conn -> prepare("DELETE from incomes where id=?");
    $delete->bind_param("i",$id);
    if($delete->execute()){
        sendResponse(200,["message"=>"Deletion successful","id"=>$id]);
    }
    else{
        sendResponse(500,['message' => 'Delete failed']);
    }
}





?>
