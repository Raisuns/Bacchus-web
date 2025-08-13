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
      window.location.href = 'pricing_plans.php';
    });
  </script>";
  exit();
}

// Handle delete
if (isset($_GET['delete'])) {
  $id = $_GET['delete'];
  $conn->query("DELETE FROM pricing_plans WHERE id=$id");
  sweetAlert('Berhasil!', 'Data plan berhasil dihapus!', 'success');
}

// Handle form submit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $id = $_POST['id'];
  $title = $_POST['title'];
  $price = $_POST['price'];
  $currency = $_POST['currency'];

  if ($id) {
    $conn->query("UPDATE pricing_plans SET title='$title', price='$price', currency='$currency' WHERE id=$id");
    sweetAlert('Berhasil!', 'Data plan berhasil diupdate!', 'success');
  } else {
    $conn->query("INSERT INTO pricing_plans (title, price, currency) VALUES ('$title', '$price', '$currency')");
    sweetAlert('Berhasil!', 'Data plan berhasil ditambahkan!', 'success');
  }
}

// Ambil data edit
$editData = null;
if (isset($_GET['edit'])) {
  $id = $_GET['edit'];
  $result = $conn->query("SELECT * FROM pricing_plans WHERE id=$id");
  $editData = $result->fetch_assoc();
}

// Ambil semua data
$result = $conn->query("SELECT * FROM pricing_plans ORDER BY sort_order ASC, id DESC");
?>

<!DOCTYPE html>
<html>
<head>
  <title>Pricing Plans</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-gray-100 p-6">
  <div class="max-w-3xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-bold mb-4"><?= $editData ? 'Edit' : 'Tambah' ?> Pricing Plan</h2>
    <form method="POST" class="space-y-4">
      <input type="hidden" name="id" value="<?= $editData['id'] ?? '' ?>">

      <div>
        <label class="block text-sm font-medium">Judul Plan</label>
        <input type="text" name="title" class="w-full border p-2 rounded" value="<?= $editData['title'] ?? '' ?>" required>
      </div>

      <div>
        <label class="block text-sm font-medium">Harga</label>
        <input type="number" step="0.01" name="price" class="w-full border p-2 rounded" value="<?= $editData['price'] ?? '' ?>" required>
      </div>

      <div>
        <label class="block text-sm font-medium">Mata Uang</label>
        <input type="text" name="currency" class="w-full border p-2 rounded" value="<?= $editData['currency'] ?? '$' ?>" required>
      </div>

      <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
        <?= $editData ? 'Update' : 'Tambah' ?>
      </button>
    </form>
  </div>

  <div class="max-w-4xl mx-auto mt-10 bg-white p-6 rounded shadow">
    <h2 class="text-xl font-semibold mb-4">Daftar Pricing Plan</h2>
    <table class="w-full border">
      <thead>
        <tr class="bg-gray-200">
          <th class="p-2 border">#</th>
          <th class="p-2 border">Judul</th>
          <th class="p-2 border">Harga</th>
          <th class="p-2 border">Mata Uang</th>
          <th class="p-2 border">Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
          <td class="border p-2"><?= $row['id'] ?></td>
          <td class="border p-2"><?= htmlspecialchars($row['title']) ?></td>
          <td class="border p-2"><?= number_format($row['price'], 2) ?></td>
          <td class="border p-2"><?= htmlspecialchars($row['currency']) ?></td>
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
        text: 'Data ini akan dihapus permanen!',
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
