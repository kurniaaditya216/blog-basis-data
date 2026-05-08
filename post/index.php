<?php
include '../config/koneksi.php';
include '../layout/header.php';

$query = mysqli_query($conn, "
    SELECT posts.*, categories.name AS category_name
    FROM posts
    LEFT JOIN categories ON posts.category_id = categories.id
    ORDER BY posts.id DESC
");

$no = 1;
?>

<div class="container mt-4">

    <div class="d-flex justify-content-between mb-3">
        <h2>Dashboard Artikel</h2>

        <a href="create.php" class="btn btn-primary">
            + Tambah Artikel
        </a>
    </div>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Judul</th>
                <th>Kategori</th>
                <th width="200">Aksi</th>
            </tr>
</thead>

    <tbody>
         <?php while($post = mysqli_fetch_assoc($query)) : ?>
                <tr>
                    <td><?= $no++; ?></td>

                    <td><?= $post['title']; ?></td>

                    <td>
                        <span class="badge bg-primary">
                            <?= $post['category_name']; ?>
                        </span>
                    </td>

                    <td>
                        <a href="edit.php?id=<?= $post['id']; ?>" 
                           class="btn btn-warning btn-sm">
                           Edit
                        </a>

                        <a href="delete.php?id=<?= $post['id']; ?>" 
                           class="btn btn-danger btn-sm"
                           onclick="return confirm('Yakin ingin hapus?')">
                           Hapus
                        </a>
                    </td>
                </tr>
        <?php endwhile; ?>
    </tbody>
</table>

</div>

<?php include '../layout/footer.php'; ?>