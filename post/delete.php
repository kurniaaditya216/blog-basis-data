<?php
include '../config/koneksi.php';

if (!isset($_GET['id'])) {
    die("ID artikel tidak ditemukan");
}

$id = $_GET['id'];

$stmt = $conn->prepare("
    DELETE FROM posts
    WHERE id = ?
");

$stmt->bind_param("i", $id);
$stmt->execute();

header("Location: index.php");
exit;
?>