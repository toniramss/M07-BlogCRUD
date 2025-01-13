<?php
session_start();
require_once('../config/Database.php');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (!isset($_SESSION['idUser'])) {
    http_response_code(403);
    echo json_encode(['error' => 'Unauthorized']);
    exit;
}

$data = json_decode(file_get_contents('php://input'), true);

$sender_id = $data['sender_id'];
$recipient_id = $data['recipient_id'];
$message = $data['message'];

if (!empty($sender_id) && !empty($recipient_id) && !empty($message)) {
    $db = (new Database())->getConnection();
    $stmt = $db->prepare("INSERT INTO messages (sender_id, recipient_id, message) VALUES (?, ?, ?)");
    $stmt->execute([$sender_id, $recipient_id, $message]);

    echo json_encode(['status' => 'success', 'message' => 'Mensaje enviado!']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Todos los campos son requeridos.']);
}
?>
