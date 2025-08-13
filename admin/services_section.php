<?php
include("../includes/db.php");

$error = "";
$success = "";

// Ambil data dari database (karena hanya 1 baris)
$stmt = $conn->prepare("SELECT * FROM services_section LIMIT 1");
$stmt->execute();
$data = $stmt->get_result()->fetch_assoc();

// Kalau form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $big_title = $_POST['big_title'] ?? '';
    $description_1 = $_POST['description_1'] ?? '';
    $description_2 = $_POST['description_2'] ?? '';

    if ($data) {
        // Update jika sudah ada data
        $stmt = $conn->prepare("UPDATE services_section SET big_title = ?, description_1 = ?, description_2 = ? WHERE id = ?");
        $stmt->bind_param("sssi", $big_title, $description_1, $description_2, $data['id']);
    } else {
        // Insert jika belum ada data
        $stmt = $conn->prepare("INSERT INTO services_section (big_title, description_1, description_2) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $big_title, $description_1, $description_2);
    }

    if ($stmt->execute()) {
        $success = "Data berhasil disimpan!";
    } else {
        $error = "Gagal menyimpan data!";
    }

    // Refresh data setelah insert/update
    $stmt = $conn->prepare("SELECT * FROM services_section LIMIT 1");
    $stmt->execute();
    $data = $stmt->get_result()->fetch_assoc();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Services Section</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-gray-100 p-6">

<div class="max-w-3xl mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold mb-4">Edit Section: Services</h1>

    <?php if ($error): ?>
        <div class="bg-red-100 text-red-700 p-2 rounded mb-4"><?= $error ?></div>
    <?php endif; ?>

    <form action="" method="post" class="space-y-4">
        <div>
            <label class="block font-semibold">Big Title</label>
            <input type="text" name="big_title" class="w-full border rounded p-2"
                   value="<?= htmlspecialchars($data['big_title'] ?? '') ?>">
        </div>
        <div>
            <label class="block font-semibold">Deskripsi 1</label>
            <textarea name="description_1" rows="4" class="w-full border rounded p-2"><?= htmlspecialchars($data['description_1'] ?? '') ?></textarea>
        </div>
        <div>
            <label class="block font-semibold">Deskripsi 2</label>
            <textarea name="description_2" rows="4" class="w-full border rounded p-2"><?= htmlspecialchars($data['description_2'] ?? '') ?></textarea>
        </div>

        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Simpan</button>
    </form>
</div>

<?php if ($success): ?>
<script>
Swal.fire({
    icon: 'success',
    title: 'Berhasil!',
    text: '<?= $success ?>',
    confirmButtonText: 'OK'
}).then(() => {
    window.location.href = 'services_section.php';
});
</script>
<?php endif; ?>

</body>
</html>
