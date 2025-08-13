<?php
include("../includes/db.php");

$error = "";
$success = "";

// Lokasi penyimpanan gambar
define('UPLOAD_DIR', 'images/');

// Ambil ID jika ada untuk edit
$id = $_GET['id'] ?? null;
$data = null;

if ($id) {
    $stmt = $conn->prepare("SELECT * FROM portfolio_items WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $data = $stmt->get_result()->fetch_assoc();
}

// Proses simpan data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? null;
    $text_label = $_POST['text_label'] ?? '';
    $full_url = $_POST['full_url'] ?? '';

    $thumb_image = $data['thumb_image'] ?? '';
    if (!empty($_FILES['thumb_image']['name'])) {
        $thumb_image = UPLOAD_DIR . basename($_FILES['thumb_image']['name']);
        move_uploaded_file($_FILES['thumb_image']['tmp_name'], $thumb_image);
    }

    $icon_image = $data['icon_image'] ?? '';
    if (!empty($_FILES['icon_image']['name'])) {
        $icon_image = UPLOAD_DIR . basename($_FILES['icon_image']['name']);
        move_uploaded_file($_FILES['icon_image']['tmp_name'], $icon_image);
    }

    if ($id) {
        $stmt = $conn->prepare("UPDATE portfolio_items SET thumb_image = ?, full_url = ?, icon_image = ?, text_label = ? WHERE id = ?");
        $stmt->bind_param("ssssi", $thumb_image, $full_url, $icon_image, $text_label, $id);
    } else {
        $stmt = $conn->prepare("INSERT INTO portfolio_items (thumb_image, full_url, icon_image, text_label) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $thumb_image, $full_url, $icon_image, $text_label);
    }

    if ($stmt->execute()) {
        $success = "Data berhasil disimpan!";
    } else {
        $error = "Gagal menyimpan data!";
    }

    if ($id) {
        $stmt = $conn->prepare("SELECT * FROM portfolio_items WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $data = $stmt->get_result()->fetch_assoc();
    }
}

// Proses hapus
if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    $stmt = $conn->prepare("DELETE FROM portfolio_items WHERE id = ?");
    $stmt->bind_param("i", $delete_id);
    if ($stmt->execute()) {
        echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Dihapus!',
                text: 'Data berhasil dihapus!'
            }).then(() => {
                window.location.href = 'portfolio_items.php';
            });
        </script>";
        exit;
    }
}

// Ambil semua data
$all = $conn->query("SELECT * FROM portfolio_items");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Portfolio Items</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-gray-100 p-6">
<div class="max-w-4xl mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold mb-4"><?= $id ? 'Edit' : 'Tambah' ?> Portfolio Item</h1>

    <form action="" method="post" enctype="multipart/form-data" class="space-y-4">
        <?php if ($id): ?>
            <input type="hidden" name="id" value="<?= $id ?>">
        <?php endif; ?>

        <div>
            <label class="block font-semibold">Thumb Image</label>
            <input type="file" name="thumb_image" class="w-full">
            <?php if (!empty($data['thumb_image'])): ?>
                <img src="<?= $data['thumb_image'] ?>" alt="thumb" class="w-16 mt-2">
            <?php endif; ?>
        </div>

        <div>
            <label class="block font-semibold">Icon Image</label>
            <input type="file" name="icon_image" class="w-full">
            <?php if (!empty($data['icon_image'])): ?>
                <img src="<?= $data['icon_image'] ?>" alt="icon" class="w-8 mt-2">
            <?php endif; ?>
        </div>

        <div>
            <label class="block font-semibold">Full URL</label>
            <input type="text" name="full_url" class="w-full border p-2 rounded" value="<?= htmlspecialchars($data['full_url'] ?? '') ?>">
        </div>

        <div>
            <label class="block font-semibold">Text Label</label>
            <input type="text" name="text_label" class="w-full border p-2 rounded" value="<?= htmlspecialchars($data['text_label'] ?? '') ?>">
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
    </form>

    <hr class="my-6">

    <h2 class="text-xl font-bold mb-4">Daftar Portfolio</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <?php while ($item = $all->fetch_assoc()): ?>
            <div class="bg-gray-50 p-4 rounded shadow hover:shadow-md">
                <img src="../<?= $item['thumb_image'] ?>" class="w-full h-32 object-cover mb-2" alt="Thumb">
                <div class="flex items-center gap-2">
                    <img src="../<?= $item['icon_image'] ?>" class="w-5 h-5" alt="Icon">
                    <span class="font-semibold"><?= htmlspecialchars($item['text_label']) ?></span>
                </div>
                <p class="text-xs text-blue-600 break-all mt-1">URL: <?= htmlspecialchars($item['full_url']) ?></p>
                <div class="mt-2 flex justify-between">
                    <a href="?id=<?= $item['id'] ?>" class="text-blue-500 hover:underline text-sm">Edit</a>
                    <button onclick="hapusData(<?= $item['id'] ?>)" class="text-red-500 hover:underline text-sm">Hapus</button>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</div>

<?php if ($success): ?>
<script>
Swal.fire({
    icon: 'success',
    title: 'Sukses',
    text: '<?= $success ?>'
}).then(() => {
    window.location.href = 'portfolio_items.php<?= $id ? '?id=' . $id : '' ?>';
});
</script>
<?php endif; ?>

<script>
function hapusData(id) {
    Swal.fire({
        title: 'Yakin ingin menghapus?',
        text: 'Data akan dihapus secara permanen!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, hapus!'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = 'portfolio_items.php?delete=' + id;
        }
    });
}
</script>
</body>
</html>
