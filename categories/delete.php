<?php
include '../config/koneksi.php';


if (!isset($_GET['id'])) {
    die("ID kategori tidak ditemukan");
}

$id = $_GET['id'];



$stmt = $conn->prepare("
    DELETE FROM categories
    WHERE id = ?
");

$stmt->bind_param("i", $id);
$stmt->execute();



header("Location: index.php");
exit;
?>