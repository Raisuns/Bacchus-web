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
      window.location.href = 'focus_section.php';
    });
  </script>";
  exit();
}

// Handle delete
if (isset($_GET['delete'])) {
  $id = $_GET['delete'];
  $conn->query("DELETE FROM focus_section WHERE id=$id");
  sweetAlert('Berhasil!', 'Data berhasil dihapus!', 'success');
}

// Handle submit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $id = $_POST['id'];
  $image_path = $_POST['image_path'];
  $title = $_POST['title'];
  $paragraph1 = $_POST['paragraph1'];
  $paragraph2 = $_POST['paragraph2'];

  if ($id) {
    $conn->query("UPDATE focus_section SET image_path='$image_path', title='$title', paragraph1='$paragraph1', paragraph2='$paragraph2' WHERE id=$id");
    sweetAlert('Berhasil!', 'Data berhasil diupdate!', 'success');
  } else {
    $conn->query("INSERT INTO focus_section (image_path, title, paragraph1, paragraph2) VALUES ('$image_path', '$title', '$paragraph1', '$paragraph2')");
    sweetAlert('Berhasil!', 'Data berhasil ditambahkan!', 'success');
  }
}

// Ambil data edit
$editData = null;
if (isset($_GET['edit'])) {
  $id = $_GET['edit'];
  $result = $conn->query("SELECT * FROM focus_section WHERE id=$id");
  $editData = $result->fetch_assoc();
}

// Ambil semua data
$result = $conn->query("SELECT * FROM focus_section ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
  <title>Focus Section</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-gray-100 p-6">
  <div class="max-w-4xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-bold mb-4"><?= $editData ? 'Edit' : 'Tambah' ?> Focus Section</h2>
    <form method="POST" class="space-y-4">
      <input type="hidden" name="id" value="<?= $editData['id'] ?? '' ?>">

      <div>
        <label class="block text-sm font-medium">Image Path</label>
        <input type="text" name="image_path" class="w-full border p-2 rounded" value="<?= $editData['image_path'] ?? '' ?>" required>
      </div>

      <div>
        <label class="block text-sm font-medium">Title</label>
        <input type="text" name="title" class="w-full border p-2 rounded" value="<?= $editData['title'] ?? '' ?>" required>
      </div>

      <div>
        <label class="block text-sm font-medium">Paragraph 1</label>
        <textarea name="paragraph1" class="w-full border p-2 rounded" rows="3" required><?= $editData['paragraph1'] ?? '' ?></textarea>
      </div>

      <div>
        <label class="block text-sm font-medium">Paragraph 2</label>
        <textarea name="paragraph2" class="w-full border p-2 rounded" rows="3" required><?= $editData['paragraph2'] ?? '' ?></textarea>
      </div>

      <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
        <?= $editData ? 'Update' : 'Tambah' ?>
      </button>
    </form>
  </div>

  <div class="max-w-6xl mx-auto mt-10 bg-white p-6 rounded shadow">
    <h2 class="text-xl font-semibold mb-4">Daftar Focus Section</h2>
    <table class="w-full border">
      <thead>
        <tr class="bg-gray-200">
          <th class="p-2 border">#</th>
          <th class="p-2 border">Image</th>
          <th class="p-2 border">Title</th>
          <th class="p-2 border">Paragraph 1</th>
          <th class="p-2 border">Paragraph 2</th>
          <th class="p-2 border">Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
          <td class="border p-2"><?= $row['id'] ?></td>
          <td class="border p-2">
            <img src="../<?= htmlspecialchars($row['image_path']) ?>" alt="Image" class="h-16 mx-auto rounded">
          </td>
          <td class="border p-2"><?= htmlspecialchars($row['title']) ?></td>
          <td class="border p-2"><?= htmlspecialchars($row['paragraph1']) ?></td>
          <td class="border p-2"><?= htmlspecialchars($row['paragraph2']) ?></td>
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
        text: 'Data yang dihapus tidak dapat dikembalikan!',
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
