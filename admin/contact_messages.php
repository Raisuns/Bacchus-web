<?php
$conn = new mysqli("localhost", "root", "", "bacchus_db");

// Hapus pesan
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    echo "<script>
        Swal.fire({
            title: 'Yakin ingin hapus pesan ini?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, Hapus!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'contact_messages.php?confirm_delete=$id';
            }
        });
    </script>";
}

if (isset($_GET['confirm_delete'])) {
    $id = $_GET['confirm_delete'];
    $conn->query("DELETE FROM contact_messages WHERE id=$id");
    echo "<script>
        Swal.fire('Dihapus!', 'Pesan berhasil dihapus.', 'success').then(() => {
            window.location.href = 'contact_messages.php';
        });
    </script>";
}

// Export ke CSV
if (isset($_GET['export'])) {
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment;filename=contact_messages.csv');
    $output = fopen("php://output", "w");
    fputcsv($output, ['No', 'Nama', 'Email', 'Subjek', 'Pesan', 'Dibuat']);

    $res = $conn->query("SELECT * FROM contact_messages ORDER BY created_at DESC");
    $no = 1;
    while ($row = $res->fetch_assoc()) {
        fputcsv($output, [$no++, $row['name'], $row['email'], $row['subject'], $row['message'], $row['created_at']]);
    }
    fclose($output);
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Pesan Kontak Masuk</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-gray-100 text-sm">

<div class="max-w-6xl mx-auto py-10">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Pesan dari Kontak</h1>
        <a href="?export=true" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
            Export ke Spreadsheet
        </a>
    </div>

    <table class="w-full bg-white shadow rounded">
        <thead class="bg-gray-200">
        <tr>
            <th class="p-2 border">#</th>
            <th class="p-2 border">Nama</th>
            <th class="p-2 border">Email</th>
            <th class="p-2 border">Subjek</th>
            <th class="p-2 border">Pesan</th>
            <th class="p-2 border">Waktu</th>
            <th class="p-2 border">Aksi</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $res = $conn->query("SELECT * FROM contact_messages ORDER BY created_at DESC");
        $no = 1;
        while ($row = $res->fetch_assoc()) {
            echo "<tr>
                <td class='p-2 border text-center'>{$no}</td>
                <td class='p-2 border'>{$row['name']}</td>
                <td class='p-2 border'>{$row['email']}</td>
                <td class='p-2 border'>{$row['subject']}</td>
                <td class='p-2 border'>" . nl2br(htmlspecialchars($row['message'])) . "</td>
                <td class='p-2 border text-nowrap'>{$row['created_at']}</td>
                <td class='p-2 border text-center'>
                    <a href='?delete={$row['id']}' class='bg-red-500 text-white px-2 py-1 rounded text-xs'>Hapus</a>
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
