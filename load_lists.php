<?php
header('Content-Type: application/json');

$db = new SQLite3('lists.db');

$result = $db->query('SELECT name FROM lists');
$lists = [];
while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
    $lists[] = $row['name'];
}

echo json_encode(['lists' => $lists]);
?>
