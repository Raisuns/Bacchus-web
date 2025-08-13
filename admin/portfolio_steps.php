<?php
include 'db.php';

// Fungsi SweetAlert
function sweetAlert($title, $text, $icon) {
  echo "<script>
    Swal.fire({
      title: '$title',
      text: '$text',
      icon: '$icon',
      confirmButtonText: 'OK'
    }).then(() => {
      window.location.href = 'portfolio_steps.php';
    });
  </script>";
  exit();
}

// Handle delete
if (isset($_GET['delete'])) {
  $id = $_GET['delete'];
  $conn->query("DELETE FROM portfolio_steps WHERE id=$id");
  sweetAlert('Berhasil!', 'Data berhasil dihapus!', 'success');
}

// Handle form submit (tambah/update)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $id = $_POST['id'];
  $step_number = $_POST['step_number'];
  $step_total = $_POST['step_total'];
  $text = $_POST['text'];

  if ($id) {
    $conn->query("UPDATE portfolio_steps SET step_number='$step_number', step_total='$step_total', text='$text' WHERE id=$id");
    sweetAlert('Berhasil!', 'Data berhasil diupdate!', 'success');
  } else {
    $conn->query("INSERT INTO portfolio_steps (step_number, step_total, text) VALUES ('$step_number', '$step_total', '$text')");
    sweetAlert('Berhasil!', 'Data berhasil ditambahkan!', 'success');
  }
}

// Ambil data untuk edit
$editData = null;
if (isset($_GET['edit'])) {
  $id = $_GET['edit'];
  $result = $conn->query("SELECT * FROM portfolio_steps WHERE id=$id");
  $editData = $result->fetch_assoc();
}

// Ambil semua data untuk ditampilkan
$result = $conn->query("SELECT * FROM portfolio_steps ORDER BY sort_order ASC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Portfolio Steps - CRUD</title>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen p-8">

  <div class="max-w-3xl mx-auto bg-white shadow-md rounded-lg p-6">
    <h2 class="text-2xl font-bold mb-6 text-center"><?= $editData ? 'Edit Step' : 'Tambah' ?></h2>

    <form method="POST" class="space-y-4">
      <input type="hidden" name="id" value="<?= $editData['id'] ?? '' ?>">

      <div>
        <label class="block font-medium mb-1">Step Number:</label>
        <input type="number" name="step_number" value="<?= $editData['step_number'] ?? '' ?>" required class="w-full border rounded px-3 py-2">
      </div>

      <div>
        <label class="block font-medium mb-1">Step Total:</label>
        <input type="number" name="step_total" value="<?= $editData['step_total'] ?? 3 ?>" required class="w-full border rounded px-3 py-2">
      </div>

      <div>
        <label class="block font-medium mb-1">Text:</label>
        <input type="text" name="text" value="<?= $editData['text'] ?? '' ?>" required class="w-full border rounded px-3 py-2">
      </div>

      <div class="text-right">
        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded">
          <?= $editData ? 'Update' : 'Tambah' ?>
        </button>
      </div>
    </form>
  </div>

  <div class="max-w-5xl mx-auto mt-10">
    <h2 class="text-xl font-semibold mb-4">Daftar Portfolio Steps</h2>
    <div class="overflow-x-auto">
      <table class="w-full bg-white shadow-md rounded-lg table-auto">
        <thead>
          <tr class="bg-gray-200 text-gray-700 text-left">
            <th class="p-3">ID</th>
            <th class="p-3">Step Number</th>
            <th class="p-3">Step Total</th>
            <th class="p-3">Text</th>
            <th class="p-3">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($row = $result->fetch_assoc()): ?>
            <tr class="border-t">
              <td class="p-3"><?= $row['id'] ?></td>
              <td class="p-3"><?= $row['step_number'] ?></td>
              <td class="p-3"><?= $row['step_total'] ?></td>
              <td class="p-3"><?= $row['text'] ?></td>
              <td class="p-3 space-x-2">
                <a href="?edit=<?= $row['id'] ?>" class="text-blue-600 hover:underline">Edit</a>
                <a href="?delete=<?= $row['id'] ?>" onclick="return confirmDelete(event)" class="text-red-600 hover:underline">Hapus</a>
              </td>
            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>
  </div>

  <script>
    function confirmDelete(event) {
      event.preventDefault();
      const url = event.currentTarget.getAttribute('href');
      Swal.fire({
        title: 'Yakin ingin menghapus?',
        text: "Data tidak bisa dikembalikan setelah dihapus!",
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
