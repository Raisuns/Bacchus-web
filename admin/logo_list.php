<?php
include("../includes/db.php");

$result = $conn->query("SELECT * FROM site_settings ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Logo List</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">

<div class="max-w-4xl mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold mb-4">Manajemen Logo</h1>

    <table class="table-auto w-full mt-4 border">
        <thead class="bg-gray-200">
            <tr>
                <th class="p-2 border">ID</th>
                <th class="p-2 border">Logo</th>
                <th class="p-2 border">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td class="p-2 border text-center"><?= $row['id'] ?></td>
                <td class="p-2 border text-center">
                    <?php if (!empty($row['logo_path']) && file_exists("../" . $row['logo_path'])): ?>
                        <img src="../<?= htmlspecialchars($row['logo_path']) ?>" alt="Logo" class="h-16 mx-auto">
                    <?php else: ?>
                        <span class="text-gray-500 italic">Belum ada logo</span>
                    <?php endif; ?>
                </td>
                <td class="p-2 border text-center">
                    <a href="logo_edit.php?id=<?= $row['id'] ?>" class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded">Edit</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

</body>
</html>
