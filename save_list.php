<?php
header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);
$listName = $data['name'];
$listItems = $data['items'];

$db = new SQLite3('lists.db');

$db->exec('CREATE TABLE IF NOT EXISTS lists (name TEXT PRIMARY KEY, items TEXT)');

$itemsJson = json_encode($listItems);
$stmt = $db->prepare('INSERT OR REPLACE INTO lists (name, items) VALUES (:name, :items)');
$stmt->bindValue(':name', $listName, SQLITE3_TEXT);
$stmt->bindValue(':items', $itemsJson, SQLITE3_TEXT);
$stmt->execute();

echo json_encode(['status' => 'success']);
?>
