<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include 'db.php'; // koneksi database

    $name    = $_POST['your-name'] ?? '';
    $email   = $_POST['your-email'] ?? '';
    $subject = $_POST['your-subject'] ?? '';
    $message = $_POST['your-message'] ?? '';

    if (!empty($name) && !empty($email) && !empty($message)) {
        $stmt = $conn->prepare("INSERT INTO contact_messages (name, email, subject, message) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $name, $email, $subject, $message);
        $stmt->execute();
        $stmt->close();

        echo "<script>alert('Pesan berhasil dikirim!');</script>";
    } else {
        echo "<script>alert('Harap isi semua field yang wajib!');</script>";
    }
}
?>
