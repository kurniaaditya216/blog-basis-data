<?php
include '../config/koneksi.php';

$id = $_POST['id'];
$title = $_POST['title'];
$category_id = $_POST['category_id'];
$content = $_POST['content'];

$stmt = $conn->prepare("
    UPDATE posts
    SET
        category_id = ?,
        title = ?,
        content = ?
    WHERE id = ?
");

$stmt->bind_param(
    "issi",
    $category_id,
    $title,
    $content,
    $id
);

$stmt->execute();

header("Location: index.php");
exit;
?>