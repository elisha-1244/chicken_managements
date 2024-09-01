<?php
include 'config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $pdo->prepare("DELETE FROM chickens WHERE id = :id");
    $stmt->execute(['id' => $id]);

    header('Location: view_chickens.php');
    exit;
}
?>
