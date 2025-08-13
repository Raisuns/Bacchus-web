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
      window.location.href = 'news_section.php';
    });
  </script>";
  exit();
}

// Hapus data
if (isset($_GET['delete'])) {
  $id = $_GET['delete'];
  $conn->query("DELETE FROM news_section WHERE id=$id");
  sweetAlert('Berhasil!', 'Data berhasil dihapus!', 'success');
}

// Simpan data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $id = $_POST['id'];
  $category = $_POST['category'];
  $title = $_POST['title'];
  $excerpt = $_POST['excerpt'];
  $link = $_POST['link'];

  if ($id) {
    $conn->query("UPDATE news_section SET category='$category', title='$title', excerpt='$excerpt', link='$link' WHERE id=$id");
    sweetAlert('Berhasil!', 'Data berhasil diupdate!', 'success');
  } else {
    $conn->query("INSERT INTO news_section (category, title, excerpt, link) VALUES ('$category', '$title', '$excerpt', '$link')");
    sweetAlert('Berhasil!', 'Data berhasil ditambahkan!', 'success');
  }
}

// Ambil data untuk form edit
$editData = null;
if (isset($_GET['edit'])) {
  $id = $_GET['edit'];
  $result = $conn->query("SELECT * FROM news_section WHERE id=$id");
  $editData = $result->fetch_assoc();
}

// Ambil semua data
$result = $conn->query("SELECT * FROM news_section ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
  <title>News Section</title>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800 p-6">

<div class="max-w-3xl mx-auto bg-white p-6 rounded shadow">
  <h2 class="text-xl font-semibold mb-4"><?= $editData ? 'Edit Berita' : 'Tambah Berita' ?></h2>
  <form method="POST" class="space-y-4">
    <input type="hidden" name="id" value="<?= $editData['id'] ?? '' ?>">

    <div>
      <label class="block font-medium">Kategori:</label>
      <input type="text" name="category" class="w-full border rounded px-3 py-2" required value="<?= $editData['category'] ?? '' ?>">
    </div>

    <div>
      <label class="block font-medium">Judul:</label>
      <input type="text" name="title" class="w-full border rounded px-3 py-2" required value="<?= $editData['title'] ?? '' ?>">
    </div>

    <div>
      <label class="block font-medium">Excerpt:</label>
      <textarea name="excerpt" class="w-full border rounded px-3 py-2" required><?= $editData['excerpt'] ?? '' ?></textarea>
    </div>

    <div>
      <label class="block font-medium">Link:</label>
      <input type="url" name="link" class="w-full border rounded px-3 py-2" required value="<?= $editData['link'] ?? '' ?>">
    </div>

    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
      <?= $editData ? 'Update Berita' : 'Tambah Berita' ?>
    </button>
  </form>
</div>

<div class="max-w-5xl mx-auto mt-10">
  <h2 class="text-2xl font-semibold mb-4">Daftar Berita</h2>
  <table class="w-full bg-white shadow rounded table-auto border-collapse">
    <thead>
      <tr class="bg-gray-200">
        <th class="border px-4 py-2">#</th>
        <th class="border px-4 py-2">Kategori</th>
        <th class="border px-4 py-2">Judul</th>
        <th class="border px-4 py-2">Excerpt</th>
        <th class="border px-4 py-2">Link</th>
        <th class="border px-4 py-2">Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($row = $result->fetch_assoc()): ?>
        <tr class="hover:bg-gray-50">
          <td class="border px-4 py-2"><?= $row['id'] ?></td>
          <td class="border px-4 py-2"><?= htmlspecialchars($row['category']) ?></td>
          <td class="border px-4 py-2"><?= htmlspecialchars($row['title']) ?></td>
          <td class="border px-4 py-2"><?= htmlspecialchars($row['excerpt']) ?></td>
          <td class="border px-4 py-2"><a href="<?= $row['link'] ?>" target="_blank" class="text-blue-600 underline">Lihat</a></td>
          <td class="border px-4 py-2 space-x-2">
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
