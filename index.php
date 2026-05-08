<?php
include 'config/koneksi.php';
include 'layout/header.php';

$query = mysqli_query($conn, "
    SELECT posts.*, categories.name AS category_name
    FROM posts
    LEFT JOIN categories 
    ON posts.category_id = categories.id
    ORDER BY posts.id DESC
");
?>

<div class="container mt-4">
    <h2 class="mb-4">Artikel Terbaru</h2>

    <div class="row">
        <?php while($post = mysqli_fetch_assoc($query)) : ?>
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        
                        <span class="badge bg-primary mb-2">
                            <?= $post['category_name']; ?>
                        </span>

                        <h5 class="card-title">
                            <?= $post['title']; ?>
                        </h5>

                        <a href="post.php?id=<?= $post['id']; ?>" 
                           class="btn btn-dark btn-sm mt-3">
                            Baca Selengkapnya
                        </a>

                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</div>

<?php include 'layout/footer.php'; ?>