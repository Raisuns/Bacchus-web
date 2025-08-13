<?php
$conn = new mysqli("localhost", "root", "", "bacchus_db");

// Tambah data
if (isset($_POST['submit'])) {
    $description = $_POST['description'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $hours = $_POST['hours'];
    $conn->query("INSERT INTO contact_info (description, address, phone, hours) VALUES ('$description', '$address', '$phone', '$hours')");
    echo "<script>
        Swal.fire('Sukses!', 'Data kontak berhasil ditambahkan!', 'success').then(() => {
            window.location.href = 'contact_info.php';
        });
    </script>";
}

// Update data
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $description = $_POST['description'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $hours = $_POST['hours'];
    $conn->query("UPDATE contact_info SET description='$description', address='$address', phone='$phone', hours='$hours' WHERE id=$id");
    echo "<script>
        Swal.fire('Berhasil!', 'Data kontak berhasil diupdate!', 'success').then(() => {
            window.location.href = 'contact_info.php';
        });
    </script>";
}

// Hapus data
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    echo "<script>
        Swal.fire({
            title: 'Yakin mau hapus?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, hapus'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'contact_info.php?confirm_delete=$id';
            }
        });
    </script>";
}

if (isset($_GET['confirm_delete'])) {
    $id = $_GET['confirm_delete'];
    $conn->query("DELETE FROM contact_info WHERE id=$id");
    echo "<script>
        Swal.fire('Dihapus!', 'Data kontak berhasil dihapus.', 'success').then(() => {
            window.location.href = 'contact_info.php';
        });
    </script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Manajemen Kontak</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-gray-100 text-sm">

<div class="max-w-5xl mx-auto py-10">
    <h1 class="text-2xl font-bold mb-6 text-center">Manajemen Info Kontak</h1>

    <!-- Form Tambah/Edit -->
    <form method="post" class="bg-white p-6 rounded shadow mb-6">
        <?php
        $edit = false;
        $description = '';
        $address = '';
        $phone = '';
        $hours = '';
        $id = '';

        if (isset($_GET['edit'])) {
            $edit = true;
            $id = $_GET['edit'];
            $res = $conn->query("SELECT * FROM contact_info WHERE id=$id");
            $row = $res->fetch_assoc();
            $description = $row['description'];
            $address = $row['address'];
            $phone = $row['phone'];
            $hours = $row['hours'];
        }
        ?>
        <input type="hidden" name="id" value="<?= $id ?>">
        <div class="grid grid-cols-2 gap-4 mb-4">
            <input type="text" name="address" value="<?= $address ?>" placeholder="Alamat"
                   class="border p-2 rounded w-full" required>
            <input type="text" name="phone" value="<?= $phone ?>" placeholder="No. Telepon"
                   class="border p-2 rounded w-full" required>
        </div>
        <div class="mb-4">
            <input type="text" name="hours" value="<?= $hours ?>" placeholder="Jam Operasional"
                   class="border p-2 rounded w-full" required>
        </div>
        <div class="mb-4">
            <textarea name="description" placeholder="Deskripsi"
                      class="border p-2 rounded w-full" rows="3" required><?= $description ?></textarea>
        </div>
        <button type="submit" name="<?= $edit ? 'update' : 'submit' ?>"
                class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
            <?= $edit ? 'Update' : 'Tambah' ?> Info Kontak
        </button>
    </form>

    <!-- Tabel Kontak -->
    <table class="w-full bg-white shadow rounded">
        <thead class="bg-gray-200">
        <tr>
            <th class="p-2 border">#</th>
            <th class="p-2 border">Deskripsi</th>
            <th class="p-2 border">Alamat</th>
            <th class="p-2 border">Telepon</th>
            <th class="p-2 border">Jam</th>
            <th class="p-2 border">Aksi</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $res = $conn->query("SELECT * FROM contact_info ORDER BY id DESC");
        $no = 1;
        while ($row = $res->fetch_assoc()) {
            echo "<tr>
                <td class='p-2 border text-center'>{$no}</td>
                <td class='p-2 border'>{$row['description']}</td>
                <td class='p-2 border'>{$row['address']}</td>
                <td class='p-2 border'>{$row['phone']}</td>
                <td class='p-2 border'>{$row['hours']}</td>
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
