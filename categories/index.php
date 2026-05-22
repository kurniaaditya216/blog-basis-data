<?php
include '../config/koneksi.php';
include '../layout/header.php';



if (isset($_POST['submit'])) {

    $name = $_POST['name'];

    // Membuat slug otomatis
    $slug = strtolower(str_replace(" ", "-", $name));

    $stmt = $conn->prepare("
        INSERT INTO categories (name, slug)
        VALUES (?, ?)
    ");

    $stmt->bind_param("ss", $name, $slug);
    $stmt->execute();

    header("Location: index.php");
    exit;
}


$query = mysqli_query($conn, "
    SELECT * FROM categories
    ORDER BY id DESC
");
?>

<div class="container mt-5">

    <div class="row">

        <!-- Form Tambah -->
        <div class="col-md-4">

            <div class="card shadow-sm">

                <div class="card-body">

                    <h4 class="mb-4">
                        Tambah Kategori
                    </h4>

                    <form method="POST">

                        <div class="mb-3">

                            <label class="form-label">
                                Nama Kategori
                            </label>

                            <input 
                                type="text"
                                name="name"
                                class="form-control"
                                placeholder="Masukkan kategori"
                                required
                            >

                        </div>

                        <button 
                            type="submit"
                            name="submit"
                            class="btn btn-primary"
                        >
                            Simpan
                        </button>

                    </form>

                </div>

            </div>

        </div>

        <!-- Tabel Kategori -->
        <div class="col-md-8">

            <div class="card shadow-sm">

                <div class="card-body">

                    <h4 class="mb-4">
                        Daftar Kategori
                    </h4>

                    <table class="table table-bordered table-striped">

                        <thead class="table-dark">

                            <tr>
                                <th width="80">No</th>
                                <th>Nama</th>
                                <th>Slug</th>
                                <th width="150">Aksi</th>
                            </tr>

                        </thead>

                        <tbody>

                            <?php
                            $no = 1;

                            while($category = mysqli_fetch_assoc($query)) :
                            ?>

                            <tr>

                                <td>
                                    <?= $no++; ?>
                                </td>

                                <td>
                                    <?= $category['name']; ?>
                                </td>

                                <td>
                                    <?= $category['slug']; ?>
                                </td>

                                <td>

                                    <a 
                                        href="delete.php?id=<?= $category['id']; ?>"
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Yakin ingin hapus kategori?')"
                                    >
                                        Hapus
                                    </a>

                                </td>

                            </tr>

                            <?php endwhile; ?>

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

</div>

<?php include '../layout/footer.php'; ?>