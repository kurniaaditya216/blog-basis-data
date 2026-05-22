<?php
include '../config/koneksi.php';
include '../layout/header.php';

$categories = mysqli_query($conn, "SELECT * FROM categories");
?>

<div class="container mt-4">

    <h2 class="mb-4">Tambah Artikel</h2>

    <form action="store.php" method="POST">

        <div class="mb-3">
            <label class="form-label">Judul Artikel</label>

            <input 
                type="text" 
                name="title"
                class="form-control"
                placeholder="Masukkan judul artikel"
                required
            >
        </div>

        <div class="mb-3">
            <label class="form-label">Kategori</label>

            <select 
                name="category_id" 
                class="form-control"
                required
            >
                <option value="">-- Pilih Kategori --</option>

                <?php while($category = mysqli_fetch_assoc($categories)) : ?>
                    <option value="<?= $category['id']; ?>">
                        <?= $category['name']; ?>
                    </option>
                <?php endwhile; ?>

            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Isi Artikel</label>

            <textarea 
                name="content"
                rows="7"
                class="form-control"
                placeholder="Tulis isi artikel..."
                required
            ></textarea>
  <div class="d-flex gap-2">

    <button type="submit" class="btn btn-primary">
        Simpan Artikel
    </button>

    <a href="index.php" class="btn btn-secondary">
        Kembali
    </a>

</div>
<?php include '../layout/footer.php'; ?>