<?php
include("../includes/db.php");

$error = "";
$success = "";

// Proses hapus jika ada parameter delete
if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];

    $stmt = $conn->prepare("SELECT * FROM services_items WHERE id = ?");
    $stmt->bind_param("i", $delete_id);
    $stmt->execute();
    $cek = $stmt->get_result()->fetch_assoc();

    if ($cek) {
        $stmt = $conn->prepare("DELETE FROM services_items WHERE id = ?");
        $stmt->bind_param("i", $delete_id);
        if ($stmt->execute()) {
            echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil Dihapus',
                    text: 'Data berhasil dihapus!',
                }).then(() => {
                    window.location.href = 'services_items.php';
                });
            </script>";
            exit;
        }
    }
}

// Ambil ID dari parameter GET jika ada
$id = $_GET['id'] ?? null;
$data = null;

if ($id) {
    $stmt = $conn->prepare("SELECT * FROM services_items WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $data = $stmt->get_result()->fetch_assoc();
}

// Handle form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? null;
    $icon_path = $_POST['icon_path'] ?? '';
    $title = $_POST['title'] ?? '';
    $description = $_POST['description'] ?? '';

    if ($id) {
        $stmt = $conn->prepare("UPDATE services_items SET icon_path = ?, title = ?, description = ? WHERE id = ?");
        $stmt->bind_param("sssi", $icon_path, $title, $description, $id);
    } else {
        $stmt = $conn->prepare("INSERT INTO services_items (icon_path, title, description) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $icon_path, $title, $description);
    }

    if ($stmt->execute()) {
        $success = "Data berhasil disimpan!";
    } else {
        $error = "Gagal menyimpan data!";
    }

    if ($id) {
        $stmt = $conn->prepare("SELECT * FROM services_items WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $data = $stmt->get_result()->fetch_assoc();
    }
}

$all = $conn->query("SELECT * FROM services_items");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Services Items</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-gray-100 p-6">

<div class="max-w-4xl mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold mb-4"><?= $id ? "Edit" : "Tambah" ?> Services Item</h1>

    <form action="" method="post" class="space-y-4">
        <?php if ($id): ?>
            <input type="hidden" name="id" value="<?= $id ?>">
        <?php endif; ?>
        <div>
            <label class="block font-semibold">Icon Path (URL / path gambar)</label>
            <input type="text" name="icon_path" class="w-full border rounded p-2"
                   value="<?= htmlspecialchars($data['icon_path'] ?? '') ?>">
        </div>
        <div>
            <label class="block font-semibold">Title</label>
            <input type="text" name="title" class="w-full border rounded p-2"
                   value="<?= htmlspecialchars($data['title'] ?? '') ?>">
        </div>
        <div>
            <label class="block font-semibold">Deskripsi</label>
            <textarea name="description" rows="4" class="w-full border rounded p-2"><?= htmlspecialchars($data['description'] ?? '') ?></textarea>
        </div>

        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Simpan</button>
    </form>

    <hr class="my-6">

    <h2 class="text-xl font-bold mb-4">Daftar Semua Services Items</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <?php while ($item = $all->fetch_assoc()): ?>
            <div class="bg-gray-50 p-4 rounded shadow-sm hover:shadow-md transition">
                <img src="../<?= htmlspecialchars($item['icon_path']) ?>" alt="Icon" class="w-12 h-12 object-contain mb-2">
                <h3 class="font-semibold"><?= htmlspecialchars($item['title']) ?></h3>
                <p class="text-sm text-gray-700"><?= htmlspecialchars($item['description']) ?></p>
                <div class="mt-2 space-x-4">
                    <a href="?id=<?= $item['id'] ?>" class="text-blue-600 hover:underline text-sm">Edit</a>
                    <button onclick="hapusData(<?= $item['id'] ?>)" class="text-red-600 hover:underline text-sm">Hapus</button>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</div>

<?php if ($success): ?>
<script>
Swal.fire({
    icon: 'success',
    title: 'Berhasil!',
    text: '<?= $success ?>',
    confirmButtonText: 'OK'
}).then(() => {
    window.location.href = 'services_items.php<?= $id ? "?id=$id" : "" ?>';
});
</script>
<?php endif; ?>

<script>
function hapusData(id) {
    Swal.fire({
        title: 'Yakin ingin menghapus?',
        text: "Data yang dihapus tidak bisa dikembalikan!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = 'services_items.php?delete=' + id;
        }
    });
}
</script>

</body>
</html>
