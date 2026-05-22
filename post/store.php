<?php
include '../config/koneksi.php';

$title = $_POST['title'];
$category_id = $_POST['category_id'];
$content = $_POST['content'];

$stmt = $conn->prepare("
    INSERT INTO posts
    (category_id, title, content)
    VALUES (?, ?, ?)
");

$stmt->bind_param(
    "iss",
    $category_id,
    $title,
    $content
);

$stmt->execute();

header("Location: index.php");
exit;
?>