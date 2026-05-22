<?php
include 'config/koneksi.php';
include 'layout/header.php';



if (!isset($_GET['id'])) {
    die("ID artikel tidak ditemukan");
}

$id = $_GET['id'];


$stmt = $conn->prepare("
    SELECT 
        posts.*, 
        categories.name AS category_name
    FROM posts
    LEFT JOIN categories
        ON posts.category_id = categories.id
    WHERE posts.id = ?
");


$stmt->bind_param("i", $id);



$stmt->execute();

$result = $stmt->get_result();
$post = $result->fetch_assoc();



if (!$post) {
    echo "
        <div class='container mt-5'>
            <div class='alert alert-danger'>
                Artikel tidak ditemukan.
            </div>
        </div>
    ";

    include 'layout/footer.php';
    exit;
}
?>

<div class="container mt-5">

    <div class="row justify-content-center">

        <div class="col-lg-8">

            <!-- Badge Kategori -->
            <span class="badge bg-primary mb-3">
                <?= htmlspecialchars($post['category_name']); ?>
            </span>

            <!-- Judul Artikel -->
            <h1 class="mb-3">
                <?= htmlspecialchars($post['title']); ?>
            </h1>

            <!-- Tanggal -->
            <p class="text-muted">
                Diposting pada:
                <?= date('d F Y H:i', strtotime($post['created_at'])); ?>
            </p>

            <hr>

            <!-- Isi Artikel -->
            <div class="mt-4">
                <p style="line-height: 1.8;">
                    <?= nl2br(htmlspecialchars($post['content'])); ?>
                </p>
            </div>

            <!-- Tombol Kembali -->
            <a href="index.php" class="btn btn-dark mt-4">
                ← Kembali ke Beranda
            </a>

        </div>

    </div>

</div>

<?php include 'layout/footer.php'; ?>