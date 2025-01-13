<?php
session_start();
require_once('../config/Database.php');

if (!isset($_SESSION['idUser'])) {
    http_response_code(403);
    echo json_encode(['error' => 'Unauthorized']);
    exit;
}

$idUser = $_SESSION['idUser'];
$recipient_id = $_GET['recipient_id'] ?? null;

if (!$recipient_id) {
    echo json_encode(['error' => 'No recipient selected']);
    exit;
}

$db = (new Database())->getConnection();
$stmt = $db->prepare("SELECT m.*, u.userName AS sender_name 
                      FROM messages m
                      JOIN users u ON m.sender_id = u.idUser
                      WHERE (sender_id = ? AND recipient_id = ?) 
                      OR (sender_id = ? AND recipient_id = ?) 
                      ORDER BY m.timestamp ASC");
$stmt->execute([$idUser, $recipient_id, $recipient_id, $idUser]);
$messages = $stmt->fetchAll(PDO::FETCH_ASSOC);

header('Content-Type: application/json');
echo json_encode($messages);
?>
