<?php
include 'db.php';

// SweetAlert Helper
function sweetAlert($title, $text, $icon) {
  echo "<script>
    Swal.fire({
      title: '$title',
      text: '$text',
      icon: '$icon',
      confirmButtonText: 'OK'
    }).then(() => {
      window.location.href = 'pricing_features.php';
    });
  </script>";
  exit();
}

// Handle delete
if (isset($_GET['delete'])) {
  $id = $_GET['delete'];
  $conn->query("DELETE FROM pricing_features WHERE id=$id");
  sweetAlert('Berhasil!', 'Fitur berhasil dihapus!', 'success');
}

// Handle form submit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $id = $_POST['id'];
  $feature_text = $_POST['feature_text'];

  if ($id) {
    $conn->query("UPDATE pricing_features SET feature_text='$feature_text' WHERE id=$id");
    sweetAlert('Berhasil!', 'Fitur berhasil diupdate!', 'success');
  } else {
    // Default plan_id, is_included, sort_order sementara diset static (bisa disesuaikan)
    $conn->query("INSERT INTO pricing_features (plan_id, feature_text, is_included, sort_order) VALUES (1, '$feature_text', 1, 0)");
    sweetAlert('Berhasil!', 'Fitur berhasil ditambahkan!', 'success');
  }
}

// Ambil data edit
$editData = null;
if (isset($_GET['edit'])) {
  $id = $_GET['edit'];
  $result = $conn->query("SELECT * FROM pricing_features WHERE id=$id");
  $editData = $result->fetch_assoc();
}

// Ambil semua data
$result = $conn->query("SELECT * FROM pricing_features ORDER BY sort_order ASC, id DESC");
?>

<!DOCTYPE html>
<html>
<head>
  <title>Pricing Features</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-gray-100 p-6">
  <div class="max-w-3xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-bold mb-4"><?= $editData ? 'Edit' : 'Tambah' ?> Fitur Pricing</h2>
    <form method="POST" class="space-y-4">
      <input type="hidden" name="id" value="<?= $editData['id'] ?? '' ?>">

      <div>
        <label class="block text-sm font-medium">Feature Text</label>
        <input type="text" name="feature_text" class="w-full border p-2 rounded" value="<?= $editData['feature_text'] ?? '' ?>" required>
      </div>

      <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
        <?= $editData ? 'Update' : 'Tambah' ?>
      </button>
    </form>
  </div>

  <div class="max-w-4xl mx-auto mt-10 bg-white p-6 rounded shadow">
    <h2 class="text-xl font-semibold mb-4">Daftar Fitur</h2>
    <table class="w-full border">
      <thead>
        <tr class="bg-gray-200">
          <th class="p-2 border">#</th>
          <th class="p-2 border">Feature</th>
          <th class="p-2 border">Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
          <td class="border p-2"><?= $row['id'] ?></td>
          <td class="border p-2"><?= htmlspecialchars($row['feature_text']) ?></td>
          <td class="border p-2 text-center">
            <a href="?edit=<?= $row['id'] ?>" class="text-blue-500 hover:underline mr-2">Edit</a>
            <a href="?delete=<?= $row['id'] ?>" class="text-red-500 hover:underline" onclick="return confirmDelete()">Hapus</a>
          </td>
        </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>

  <script>
    function confirmDelete() {
      event.preventDefault();
      const url = event.currentTarget.getAttribute('href');
      Swal.fire({
        title: 'Yakin ingin menghapus?',
        text: 'Fitur ini akan dihapus permanen!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal'
      }).then((result) => {
        if (result.isConfirmed) {
          window.location.href = url;
        }
      });
      return false;
    }
  </script>
</body>
</html>
