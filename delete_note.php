<?php
require 'includes/auth.php';
require 'includes/db.php';

$id = $_GET['id'] ?? 0;
$userId = $_SESSION['user_id'];

$stmt = $db->prepare(
    "DELETE FROM notes WHERE id = ? AND user_id = ?"
);

$stmt->execute([$id, $userId]);

header("Location: dashboard.php");
exit();
?>