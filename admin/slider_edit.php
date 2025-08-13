<?php
include("../includes/db.php");

$id = $_GET['id'] ?? 0;

$stmt = $conn->prepare("SELECT * FROM sliders WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$slider = $stmt->get_result()->fetch_assoc();

if (!$slider) {
    die("Data slider tidak ditemukan");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_FILES['image']['name'])) {
        $file_name = $_FILES['image']['name'];
        $tmp_name = $_FILES['image']['tmp_name'];
        $upload_dir = "../images/";
        $target_path = $upload_dir . basename($file_name);
        $db_path = "images/" . basename($file_name);

        if (move_uploaded_file($tmp_name, $target_path)) {
            // Hapus file lama jika ada
            if (!empty($slider['image_url']) && file_exists("../" . $slider['image_url'])) {
                unlink("../" . $slider['image_url']);
            }

            // Update image_url di DB
            $stmt = $conn->prepare("UPDATE site_slider SET image_url = ? WHERE id = ?");
            $stmt->bind_param("si", $db_path, $id);
            $stmt->execute();

            header("Location: slider_list.php");
            exit;
        } else {
            $error = "Upload gagal.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit Slider</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">
  <div class="max-w-lg mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-xl font-bold mb-4">Edit Slider</h1>

    <?php if (!empty($error)): ?>
      <div class="bg-red-100 text-red-700 p-2 rounded mb-3"><?= $error ?></div>
    <?php endif; ?>

    <img src="../<?= htmlspecialchars($slider['image_url']) ?>" class="h-40 mb-4 rounded border">
    <form method="post" enctype="multipart/form-data">
      <label class="block mb-2 font-semibold">Gambar Baru</label>
      <input type="file" name="image" required class="mb-4 block w-full border p-2 rounded">
      <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Update</button>
      <a href="slider_list.php" class="ml-3 text-gray-600">Batal</a>
    </form>
  </div>
</body>
</html>
