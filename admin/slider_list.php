<?php
include("../includes/db.php");

$result = $conn->query("SELECT * FROM sliders ORDER BY sort_order ASC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Manajemen Slider</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">

<div class="max-w-5xl mx-auto bg-white p-6 rounded shadow">
  <h1 class="text-2xl font-bold mb-4">Manajemen Slider</h1>

  <table class="table-auto w-full mt-4 border">
    <thead class="bg-gray-200">
      <tr>
        <th class="p-2 border">ID</th>
        <th class="p-2 border">Gambar</th>
        <th class="p-2 border">Status</th>
        <th class="p-2 border">Urutan</th>
        <th class="p-2 border">Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($row = $result->fetch_assoc()): ?>
        <tr class="text-center">
          <td class="p-2 border"><?= $row['id'] ?></td>
          <td class="p-2 border">
            <img src="../<?= htmlspecialchars($row['image_url']) ?>" alt="Slider" class="h-20 mx-auto rounded">
          </td>
          <td class="p-2 border">
            <?= $row['is_active'] ? '<span class="text-green-600 font-semibold">Aktif</span>' : '<span class="text-red-600 font-semibold">Nonaktif</span>' ?>
          </td>
          <td class="p-2 border"><?= $row['sort_order'] ?></td>
          <td class="p-2 border">
            <a href="slider_edit.php?id=<?= $row['id'] ?>" class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded">Edit</a>
          </td>
        </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
</div>

</body>
</html>
