<?php
// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "bacchus_db");

// Tambah data
if (isset($_POST['submit'])) {
    $value = $_POST['value'];
    $title = $_POST['title'];
    $conn->query("INSERT INTO counters (value, title) VALUES ('$value', '$title')");
    echo "<script>
        Swal.fire('Sukses!', 'Counter berhasil ditambahkan!', 'success').then(() => {
            window.location.href = 'counters.php';
        });
    </script>";
}

// Update data
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $value = $_POST['value'];
    $title = $_POST['title'];
    $conn->query("UPDATE counters SET value='$value', title='$title' WHERE id=$id");
    echo "<script>
        Swal.fire('Berhasil!', 'Counter berhasil diupdate!', 'success').then(() => {
            window.location.href = 'counters.php';
        });
    </script>";
}

// Hapus data
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    echo "<script>
        Swal.fire({
            title: 'Yakin hapus data ini?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, hapus',
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'counters.php?confirm_delete=$id';
            }
        });
    </script>";
}

if (isset($_GET['confirm_delete'])) {
    $id = $_GET['confirm_delete'];
    $conn->query("DELETE FROM counters WHERE id=$id");
    echo "<script>
        Swal.fire('Dihapus!', 'Counter berhasil dihapus.', 'success').then(() => {
            window.location.href = 'counters.php';
        });
    </script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Manajemen Counter</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-gray-100 text-sm">

<div class="max-w-4xl mx-auto py-10">
    <h1 class="text-2xl font-bold mb-6 text-center">Manajemen Counter</h1>

    <!-- Form Tambah / Edit -->
    <form method="post" class="bg-white p-6 rounded shadow mb-6">
        <?php
        $edit = false;
        $value = '';
        $title = '';
        $id = '';
        if (isset($_GET['edit'])) {
            $edit = true;
            $id = $_GET['edit'];
            $res = $conn->query("SELECT * FROM counters WHERE id=$id");
            $row = $res->fetch_assoc();
            $value = $row['value'];
            $title = $row['title'];
        }
        ?>
        <input type="hidden" name="id" value="<?= $id ?>">
        <div class="grid grid-cols-2 gap-4 mb-4">
            <input type="number" name="value" value="<?= $value ?>" placeholder="Angka Counter"
                   class="border p-2 rounded w-full" required>
            <input type="text" name="title" value="<?= $title ?>" placeholder="Judul"
                   class="border p-2 rounded w-full" required>
        </div>
        <button type="submit" name="<?= $edit ? 'update' : 'submit' ?>"
                class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
            <?= $edit ? 'Update' : 'Tambah' ?> Counter
        </button>
    </form>

    <!-- Tabel Counter -->
    <table class="w-full bg-white shadow rounded">
        <thead class="bg-gray-200">
        <tr>
            <th class="p-2 border">#</th>
            <th class="p-2 border">Angka</th>
            <th class="p-2 border">Judul</th>
            <th class="p-2 border">Aksi</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $res = $conn->query("SELECT * FROM counters ORDER BY id DESC");
        $no = 1;
        while ($row = $res->fetch_assoc()) {
            echo "<tr>
                <td class='p-2 border text-center'>{$no}</td>
                <td class='p-2 border text-center'>{$row['value']}</td>
                <td class='p-2 border'>{$row['title']}</td>
                <td class='p-2 border text-center'>
                    <a href='?edit={$row['id']}' class='bg-yellow-400 text-white px-2 py-1 rounded text-xs'>Edit</a>
                    <a href='?delete={$row['id']}' class='bg-red-500 text-white px-2 py-1 rounded text-xs ml-2'>Hapus</a>
                </td>
            </tr>";
            $no++;
        }
        ?>
        </tbody>
    </table>
</div>

</body>
</html>
