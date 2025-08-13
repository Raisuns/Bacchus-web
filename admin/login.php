<?php
session_start();
require_once "db.php";


if (isset($_POST['login'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $result = $conn->query("SELECT * FROM users WHERE username='$username'");
    if ($result && $result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user'] = $user;
            header("Location: dashboard.php");
            exit;
        } else {
            $error = "Password salah!";
        }
    } else {
        $error = "Username tidak ditemukan!";
    }
}

if (isset($_POST['register'])) {
    $username = trim($_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $cekUser = $conn->query("SELECT * FROM users WHERE username='$username'");
    if ($cekUser && $cekUser->num_rows > 0) {
        $error = "Username sudah digunakan!";
    } else {
        $conn->query("INSERT INTO users (username,password) VALUES ('$username','$password')");
        $success = "Pendaftaran berhasil, silakan login.";
    }
}
?>
<!DOCTYPE html>
<html lang="id" data-theme="dark">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login & Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css" rel="stylesheet" />
    <style>
        body {
            overflow: hidden;
        }
        .bg-video {
            position: fixed;
            top: 0; left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            filter: blur(8px) brightness(0.6);
            z-index: -1;
        }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen">

    <!-- Background Video -->
    <video autoplay muted loop class="bg-video">
        <source src="https://res.cloudinary.com/dm1dyk0c6/video/upload/v1754984416/aurora-over-the-lake-moewalls-com_t2dpcg.mp4" type="video/mp4">
    </video>

    <!-- Container Form -->
    <div class="w-full max-w-md bg-base-200 bg-opacity-80 backdrop-blur-md rounded-xl shadow-lg p-8">
        
        <?php if (!empty($error)): ?>
            <div class="alert alert-error mb-4"><?= $error ?></div>
        <?php endif; ?>
        <?php if (!empty($success)): ?>
            <div class="alert alert-success mb-4"><?= $success ?></div>
        <?php endif; ?>

        <!-- LOGIN FORM -->
        <form id="loginForm" method="POST">
            <h2 class="text-2xl font-bold mb-4 text-center">Sign In</h2>
            <input type="text" name="username" placeholder="Username" class="input input-bordered w-full mb-3" required>
            <input type="password" name="password" placeholder="Password" class="input input-bordered w-full mb-3" required>
            <button type="submit" name="login" class="btn btn-primary w-full">Sign In</button>
            <p class="mt-4 text-center text-sm">Belum punya akun? <a href="#" onclick="toggleForm()" class="link link-primary">Sign Up</a></p>
        </form>

        <!-- REGISTER FORM -->
        <form id="registerForm" method="POST" class="hidden">
            <h2 class="text-2xl font-bold mb-4 text-center">Sign Up</h2>
            <input type="text" name="username" placeholder="Username" class="input input-bordered w-full mb-3" required>
            <input type="password" name="password" placeholder="Password" class="input input-bordered w-full mb-3" required>
            <button type="submit" name="register" class="btn btn-success w-full">Sign Up</button>
            <p class="mt-4 text-center text-sm">Sudah punya akun? <a href="#" onclick="toggleForm()" class="link link-primary">Sign In</a></p>
        </form>

    </div>

    <script>
        function toggleForm() {
            document.getElementById('loginForm').classList.toggle('hidden');
            document.getElementById('registerForm').classList.toggle('hidden');
        }
    </script>

</body>
</html>
