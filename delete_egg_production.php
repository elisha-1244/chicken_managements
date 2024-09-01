<?php
include 'config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $pdo->prepare("DELETE FROM egg_production WHERE id = :id");
    $stmt->execute(['id' => $id]);

    header('Location: view_egg_production.php');
    exit;
}
?>
