<?php
include 'db.php';

function sweetAlert($title, $text, $icon) {
  echo "<script>
    Swal.fire({
      title: '$title',
      text: '$text',
      icon: '$icon',
      confirmButtonText: 'OK'
    }).then(() => {
      window.location.href = 'support_section.php';
    });
  </script>";
  exit();
}

// Hapus
if (isset($_GET['delete'])) {
  $id = $_GET['delete'];
  $conn->query("DELETE FROM support_section WHERE id=$id");
  sweetAlert('Berhasil!', 'Data berhasil dihapus!', 'success');
}

// Simpan (tambah atau edit)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $id = $_POST['id'];
  $quote_text = $_POST['quote_text'];
  $description = $_POST['description'];

  if ($id) {
    $conn->query("UPDATE support_section SET quote_text='$quote_text', description='$description' WHERE id=$id");
    sweetAlert('Berhasil!', 'Data berhasil diupdate!', 'success');
  } else {
    $conn->query("INSERT INTO support_section (quote_text, description) VALUES ('$quote_text', '$description')");
    sweetAlert('Berhasil!', 'Data berhasil ditambahkan!', 'success');
  }
}

// Data edit
$editData = null;
if (isset($_GET['edit'])) {
  $id = $_GET['edit'];
  $result = $conn->query("SELECT * FROM support_section WHERE id=$id");
  $editData = $result->fetch_assoc();
}

// Ambil semua data
$result = $conn->query("SELECT * FROM support_section ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
  <title>Support Section</title>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">

<div class="max-w-2xl mx-auto bg-white p-6 rounded shadow">
  <h2 class="text-xl font-bold mb-4"><?= $editData ? 'Edit Quote' : 'Tambah Quote' ?></h2>
  <form method="POST" class="space-y-4">
    <input type="hidden" name="id" value="<?= $editData['id'] ?? '' ?>">

    <div>
      <label class="block font-medium">Quote Text:</label>
      <input type="text" name="quote_text" class="w-full border rounded px-3 py-2" required value="<?= $editData['quote_text'] ?? '' ?>">
    </div>

    <div>
      <label class="block font-medium">Description:</label>
      <textarea name="description" class="w-full border rounded px-3 py-2" rows="4"><?= $editData['description'] ?? '' ?></textarea>
    </div>

    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
      <?= $editData ? 'Update' : 'Tambah' ?>
    </button>
  </form>
</div>

<div class="max-w-4xl mx-auto mt-10">
  <h2 class="text-2xl font-semibold mb-4">Daftar Quote</h2>
  <table class="w-full bg-white shadow rounded border border-gray-200">
    <thead>
      <tr class="bg-gray-100 text-left">
        <th class="px-4 py-2 border">#</th>
        <th class="px-4 py-2 border">Quote</th>
        <th class="px-4 py-2 border">Description</th>
        <th class="px-4 py-2 border">Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($row = $result->fetch_assoc()): ?>
        <tr class="hover:bg-gray-50">
          <td class="px-4 py-2 border"><?= $row['id'] ?></td>
          <td class="px-4 py-2 border"><?= htmlspecialchars($row['quote_text']) ?></td>
          <td class="px-4 py-2 border"><?= nl2br(htmlspecialchars($row['description'])) ?></td>
          <td class="px-4 py-2 border space-x-2">
            <a href="?edit=<?= $row['id'] ?>" class="text-yellow-500 hover:underline">Edit</a>
            <a href="?delete=<?= $row['id'] ?>" onclick="return confirmDelete(event)" class="text-red-600 hover:underline">Hapus</a>
          </td>
        </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
</div>

<script>
  function confirmDelete(e) {
    e.preventDefault();
    const href = e.target.href;

    Swal.fire({
      title: 'Yakin ingin menghapus?',
      text: 'Data yang dihapus tidak bisa dikembalikan!',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Ya, hapus!',
      cancelButtonText: 'Batal'
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = href;
      }
    });

    return false;
  }
</script>

</body>
</html>
