<?php
header('Content-Type: application/json');

$listName = $_GET['name'];

$db = new SQLite3('lists.db');

$stmt = $db->prepare('SELECT items FROM lists WHERE name = :name');
$stmt->bindValue(':name', $listName, SQLITE3_TEXT);
$result = $stmt->execute();
$row = $result->fetchArray(SQLITE3_ASSOC);

echo json_encode(['items' => json_decode($row['items'])]);
?>
