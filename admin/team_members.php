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
      window.location.href = 'team_members.php';
    });
  </script>";
  exit();
}

// Handle delete
if (isset($_GET['delete'])) {
  $id = $_GET['delete'];
  $conn->query("DELETE FROM team_members WHERE id=$id");
  sweetAlert('Berhasil!', 'Data anggota tim berhasil dihapus!', 'success');
}

// Handle form submit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $id = $_POST['id'];
  $name = $_POST['name'];
  $position = $_POST['position'];
  $image_url = $_POST['image_url'];
  $bio = $_POST['bio'];
  $featured = isset($_POST['featured']) ? 1 : 0;

  if ($id) {
    $conn->query("UPDATE team_members SET name='$name', position='$position', image_url='$image_url', bio='$bio', featured='$featured' WHERE id=$id");
    sweetAlert('Berhasil!', 'Data anggota tim berhasil diupdate!', 'success');
  } else {
    $conn->query("INSERT INTO team_members (name, position, image_url, bio, featured) VALUES ('$name', '$position', '$image_url', '$bio', '$featured')");
    sweetAlert('Berhasil!', 'Data anggota tim berhasil ditambahkan!', 'success');
  }
}

// Ambil data edit
$editData = null;
if (isset($_GET['edit'])) {
  $id = $_GET['edit'];
  $result = $conn->query("SELECT * FROM team_members WHERE id=$id");
  $editData = $result->fetch_assoc();
}

// Ambil semua data
$result = $conn->query("SELECT * FROM team_members ORDER BY sort_order ASC, id DESC");
?>

<!DOCTYPE html>
<html>
<head>
  <title>Team Members</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-gray-100 p-6">
  <div class="max-w-4xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-bold mb-4"><?= $editData ? 'Edit' : 'Tambah' ?> Anggota Tim</h2>
    <form method="POST" class="space-y-4">
      <input type="hidden" name="id" value="<?= $editData['id'] ?? '' ?>">

      <div>
        <label class="block text-sm font-medium">Nama</label>
        <input type="text" name="name" class="w-full border p-2 rounded" value="<?= $editData['name'] ?? '' ?>" required>
      </div>

      <div>
        <label class="block text-sm font-medium">Posisi</label>
        <input type="text" name="position" class="w-full border p-2 rounded" value="<?= $editData['position'] ?? '' ?>" required>
      </div>

      <div>
        <label class="block text-sm font-medium">URL Gambar</label>
        <input type="text" name="image_url" class="w-full border p-2 rounded" value="<?= $editData['image_url'] ?? '' ?>">
      </div>

      <div>
        <label class="block text-sm font-medium">Bio</label>
        <textarea name="bio" class="w-full border p-2 rounded"><?= $editData['bio'] ?? '' ?></textarea>
      </div>

      <div class="flex items-center">
        <input type="checkbox" name="featured" class="mr-2" <?= isset($editData['featured']) && $editData['featured'] ? 'checked' : '' ?>>
        <label class="text-sm font-medium">Featured</label>
      </div>

      <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
        <?= $editData ? 'Update' : 'Tambah' ?>
      </button>
    </form>
  </div>

  <div class="max-w-6xl mx-auto mt-10 bg-white p-6 rounded shadow">
    <h2 class="text-xl font-semibold mb-4">Daftar Anggota Tim</h2>
    <table class="w-full border">
      <thead>
        <tr class="bg-gray-200">
          <th class="p-2 border">#</th>
          <th class="p-2 border">Nama</th>
          <th class="p-2 border">Posisi</th>
          <th class="p-2 border">Gambar</th>
          <th class="p-2 border">Featured</th>
          <th class="p-2 border">Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
          <td class="border p-2"><?= $row['id'] ?></td>
          <td class="border p-2"><?= htmlspecialchars($row['name']) ?></td>
          <td class="border p-2"><?= htmlspecialchars($row['position']) ?></td>
          <td class="border p-2">
            <?php if ($row['image_url']): ?>
              <img src="../<?= $row['image_url'] ?>" class="w-16 h-16 object-cover rounded-full">
            <?php else: ?>
              <span class="text-gray-400 italic">Tidak ada</span>
            <?php endif; ?>
          </td>
          <td class="border p-2 text-center">
            <?= $row['featured'] ? '✅' : '❌' ?>
          </td>
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
