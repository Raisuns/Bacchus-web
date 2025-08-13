<?php
// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "bacchus_db");

// Tambah data
if (isset($_POST['submit'])) {
    $skill_name = $_POST['skill_name'];
    $percent = $_POST['percent'];
    $conn->query("INSERT INTO team_skills (skill_name, percent) VALUES ('$skill_name', '$percent')");
    echo "<script>
        Swal.fire('Sukses!', 'Skill berhasil ditambahkan!', 'success').then(() => {
            window.location.href = 'team_skills.php';
        });
    </script>";
}

// Update data
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $skill_name = $_POST['skill_name'];
    $percent = $_POST['percent'];
    $conn->query("UPDATE team_skills SET skill_name='$skill_name', percent='$percent' WHERE id=$id");
    echo "<script>
        Swal.fire('Berhasil!', 'Skill berhasil diupdate!', 'success').then(() => {
            window.location.href = 'team_skills.php';
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
                window.location.href = 'team_skills.php?confirm_delete=$id';
            }
        });
    </script>";
}

if (isset($_GET['confirm_delete'])) {
    $id = $_GET['confirm_delete'];
    $conn->query("DELETE FROM team_skills WHERE id=$id");
    echo "<script>
        Swal.fire('Dihapus!', 'Skill berhasil dihapus.', 'success').then(() => {
            window.location.href = 'team_skills.php';
        });
    </script>";
}
?>

<!-- HTML -->
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Team Skills CRUD</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-gray-100 text-sm">

<div class="max-w-4xl mx-auto py-10">
    <h1 class="text-2xl font-bold mb-6 text-center">Manajemen Skill Tim</h1>

    <!-- Form Tambah / Edit -->
    <form method="post" class="bg-white p-6 rounded shadow mb-6">
        <?php
        $edit = false;
        $skill_name = '';
        $percent = '';
        $id = '';
        if (isset($_GET['edit'])) {
            $edit = true;
            $id = $_GET['edit'];
            $res = $conn->query("SELECT * FROM team_skills WHERE id=$id");
            $row = $res->fetch_assoc();
            $skill_name = $row['skill_name'];
            $percent = $row['percent'];
        }
        ?>
        <input type="hidden" name="id" value="<?= $id ?>">
        <div class="grid grid-cols-2 gap-4 mb-4">
            <input type="text" name="skill_name" value="<?= $skill_name ?>" placeholder="Nama Skill"
                   class="border p-2 rounded w-full" required>
            <input type="number" name="percent" value="<?= $percent ?>" placeholder="Persentase (%)"
                   class="border p-2 rounded w-full" required>
        </div>
        <button type="submit" name="<?= $edit ? 'update' : 'submit' ?>"
                class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
            <?= $edit ? 'Update' : 'Tambah' ?> Skill
        </button>
    </form>

    <!-- Tabel Skill -->
    <table class="w-full bg-white shadow rounded">
        <thead class="bg-gray-200">
        <tr>
            <th class="p-2 border">#</th>
            <th class="p-2 border">Nama Skill</th>
            <th class="p-2 border">Persentase</th>
            <th class="p-2 border">Aksi</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $res = $conn->query("SELECT * FROM team_skills ORDER BY id DESC");
        $no = 1;
        while ($row = $res->fetch_assoc()) {
            echo "<tr>
                <td class='p-2 border text-center'>{$no}</td>
                <td class='p-2 border'>{$row['skill_name']}</td>
                <td class='p-2 border text-center'>{$row['percent']}%</td>
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
