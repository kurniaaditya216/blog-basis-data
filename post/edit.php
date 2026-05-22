<?php
include '../config/koneksi.php';
include '../layout/header.php';

if (!isset($_GET['id'])) {
    die("ID artikel tidak ditemukan");
}

$id = $_GET['id'];

$stmt = $conn->prepare("
    SELECT * FROM posts
    WHERE id = ?
");

$stmt->bind_param("i", $id);
$stmt->execute();

$result = $stmt->get_result();
$post = $result->fetch_assoc();

$categories = mysqli_query($conn, "
    SELECT * FROM categories
");
?>

<div class="container mt-5">

    <div class="card shadow-sm">

        <div class="card-body">

            <h2 class="mb-4">
                Edit Artikel
            </h2>

            <form action="update.php" method="POST">

                <input
                    type="hidden"
                    name="id"
                    value="<?= $post['id']; ?>"
                >

                <div class="mb-3">

                    <label class="form-label">
                        Judul Artikel
                    </label>

                    <input
                        type="text"
                        name="title"
                        class="form-control"
                        value="<?= $post['title']; ?>"
                        required
                    >

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Kategori
                    </label>

                    <select
                        name="category_id"
                        class="form-control"
                        required
                    >

                        <?php while($category = mysqli_fetch_assoc($categories)) : ?>

                        <option
                            value="<?= $category['id']; ?>"
                            <?= $category['id'] == $post['category_id'] ? 'selected' : ''; ?>
                        >
                            <?= $category['name']; ?>
                        </option>

                        <?php endwhile; ?>

                    </select>

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Isi Artikel
                    </label>

                    <textarea
                        name="content"
                        rows="7"
                        class="form-control"
                        required
                    ><?= $post['content']; ?></textarea>

                </div>

                <button class="btn btn-success">
                    Update Artikel
                </button>


    <a href="index.php" class="btn btn-secondary">
        Kembali
    </a>

</div>
            </form>

        </div>

    </div>

</div>

<?php include '../layout/footer.php'; ?>