
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
      window.location.href = 'testimonials.php';
    });
  </script>";
  exit();
}

// Handle delete
if (isset($_GET['delete'])) {
  $id = $_GET['delete'];
  $conn->query("DELETE FROM testimonials WHERE id=$id");
  sweetAlert('Berhasil!', 'Data berhasil dihapus!', 'success');
}

// Handle form submit (tambah/update)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $id = $_POST['id'];
  $author_name = $_POST['author_name'];
  $author_text = $_POST['author_text'];
  $author_img = $_POST['author_img'];

  if ($id) {
    $conn->query("UPDATE testimonials SET author_name='$author_name', author_text='$author_text', author_img='$author_img' WHERE id=$id");
    sweetAlert('Berhasil!', 'Data berhasil diupdate!', 'success');
  } else {
    $conn->query("INSERT INTO testimonials (author_name, author_text, author_img) VALUES ('$author_name', '$author_text', '$author_img')");
    sweetAlert('Berhasil!', 'Data berhasil ditambahkan!', 'success');
  }
}

// Ambil data untuk edit
$editData = null;
if (isset($_GET['edit'])) {
  $id = $_GET['edit'];
  $result = $conn->query("SELECT * FROM testimonials WHERE id=$id");
  $editData = $result->fetch_assoc();
}

// Ambil semua data
$result = $conn->query("SELECT * FROM testimonials ORDER BY sort_order ASC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Testimonials CRUD</title>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">

  <div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow">
    <h2 class="text-xl font-bold mb-4"><?= $editData ? 'Edit Testimonial' : 'Tambah Testimonial' ?></h2>
    <form method="POST" class="space-y-4">
      <input type="hidden" name="id" value="<?= $editData['id'] ?? '' ?>">
      <div>
        <label class="block font-medium">Author Name:</label>
        <input type="text" name="author_name" value="<?= $editData['author_name'] ?? '' ?>" required class="w-full p-2 border rounded">
      </div>
      <div>
        <label class="block font-medium">Author Text:</label>
        <textarea name="author_text" required class="w-full p-2 border rounded"><?= $editData['author_text'] ?? '' ?></textarea>
      </div>
      <div>
        <label class="block font-medium">Author Image (URL):</label>
        <input type="text" name="author_img" value="<?= $editData['author_img'] ?? '' ?>" required class="w-full p-2 border rounded">
      </div>
      <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600"><?= $editData ? 'Update' : 'Tambah' ?></button>
    </form>
  </div>

  <div class="max-w-5xl mx-auto mt-10 bg-white p-6 rounded-lg shadow">
    <h2 class="text-xl font-bold mb-4">Daftar Testimonials</h2>
    <table class="w-full table-auto border border-collapse border-gray-300">
      <thead class="bg-gray-200">
        <tr>
          <th class="border p-2">ID</th>
          <th class="border p-2">Author</th>
          <th class="border p-2">Text</th>
          <th class="border p-2">Image</th>
          <th class="border p-2">Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($row = $result->fetch_assoc()): ?>
          <tr class="text-center">
            <td class="border p-2"><?= $row['id'] ?></td>
            <td class="border p-2"><?= $row['author_name'] ?></td>
            <td class="border p-2"><?= $row['author_text'] ?></td>
            <td class="border p-2"><img src="../<?= htmlspecialchars($row['author_img']) ?>" alt="Author" class="h-12 mx-auto rounded-full"></td>
            <td class="border p-2 space-x-2">
              <a href="?edit=<?= $row['id'] ?>" class="text-blue-600 hover:underline">Edit</a>
              <a href="?delete=<?= $row['id'] ?>" onclick="return confirmDelete()" class="text-red-600 hover:underline">Hapus</a>
            </td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>

  <script>
    function confirmDelete() {
      return confirm('Yakin ingin menghapus testimonial ini?');
    }
  </script>
</body>
</html>
