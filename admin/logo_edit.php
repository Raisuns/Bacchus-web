<?php
include("../includes/db.php");

$id = $_GET['id'] ?? 1; // default ke id 1
$stmt = $conn->prepare("SELECT * FROM site_settings WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$logo = $stmt->get_result()->fetch_assoc();

if (!$logo) {
    die("Logo tidak ditemukan");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_FILES['logo']['name'])) {
        $file_name = $_FILES['logo']['name'];
        $tmp_name = $_FILES['logo']['tmp_name'];
        $upload_dir = "../images/";
        $target_path = $upload_dir . basename($file_name);
        $db_path = "images/" . basename($file_name);

        if (move_uploaded_file($tmp_name, $target_path)) {
            if (!empty($logo['logo_path']) && file_exists("../" . $logo['logo_path'])) {
                unlink("../" . $logo['logo_path']);
            }

            // Update ke database
            $stmt = $conn->prepare("UPDATE site_settings SET logo_path = ?, updated_at = NOW() WHERE id = ?");
            $stmt->bind_param("si", $db_path, $id);
            $stmt->execute();

            header("Location: logo_list.php");
            exit;
        } else {
            $error = "Gagal upload logo baru!";
        }
    } else {
        header("Location: logo_list.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Edit Logo</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">

<div class="max-w-lg mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-xl font-bold mb-4">Edit Logo</h1>

    <?php if (!empty($error)): ?>
        <div class="bg-red-100 text-red-700 p-2 rounded mb-3"><?= $error ?></div>
    <?php endif; ?>

    <p class="mb-4">Logo saat ini:</p>
    <img src="../<?= htmlspecialchars($logo['logo_path']) ?>" alt="Logo" class="h-16 mb-4">

    <form action="" method="post" enctype="multipart/form-data">
        <label class="block mb-2 font-semibold">Pilih Logo Baru</label>
        <input type="file" name="logo" class="mb-4 block w-full border rounded p-2" required>
        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Update</button>
        <a href="logo_list.php" class="ml-2 text-gray-600">Batal</a>
    </form>
</div>

</body>
</html>
