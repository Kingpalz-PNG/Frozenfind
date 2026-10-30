<?php
session_start();
include '../koneksi.php';

if (isset($_SESSION['login'])) {
    if ($_SESSION['role'] == 'admin') {
        header("Location: ../admin/itemlist.php");
    } else {
        header("Location: ../users/katalog.php");
    }
    exit;
}

$error = '';
$sukses = '';

if (isset($_POST['register'])) {
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $username = mysqli_real_escape_string($conn, strtolower(trim($_POST['username'])));
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    if ($password !== $confirm_password) {
        $error = "Konfirmasi password tidak cocok!";
    } else {
        // Cek apakah username sudah ada
        $check_user = mysqli_query($conn, "SELECT username FROM users WHERE username = '$username'");
        if (mysqli_num_rows($check_user) > 0) {
            $error = "Username sudah terdaftar, silakan gunakan username lain!";
        } else {
            $password_hashed = password_hash($password, PASSWORD_DEFAULT);
            $role = 'user';

            $query = "INSERT INTO users (nama, username, password, role) VALUES ('$nama', '$username', '$password_hashed', '$role')";
            if (mysqli_query($conn, $query)) {
                $sukses = "Registrasi berhasil! Silakan login.";
            } else {
                $error = "Gagal mendaftar: " . mysqli_error($conn);
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun - Frozen Find</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Inter', sans-serif; }</style>
</head>
<body class="bg-gray-50 flex items-center justify-center min-h-screen p-4">

    <div class="max-w-md w-full bg-white rounded-2xl shadow-sm border border-gray-200 p-8">
        <div class="text-center mb-8">
            <h1 class="text-2xl font-bold text-gray-900">Buat Akun Baru</h1>
            <p class="text-sm text-gray-500 mt-1">Bergabunglah dengan Frozen Find</p>
        </div>

        <?php if ($error) : ?>
            <div class="bg-red-50 text-red-600 text-sm p-3.5 rounded-lg mb-5 border border-red-200">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>

        <?php if ($sukses) : ?>
            <div class="bg-green-50 text-green-600 text-sm p-3.5 rounded-lg mb-5 border border-green-200">
                <?php echo $sukses; ?> <a href="login.php" class="underline font-semibold">Login sekarang</a>
            </div>
        <?php endif; ?>

        <form action="" method="POST" class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                <input type="text" name="nama" required placeholder="Contoh: Ahmad Farid" class="w-full px-3.5 py-2.5 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Username</label>
                <input type="text" name="username" required placeholder="username123" class="w-full px-3.5 py-2.5 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                <input type="password" name="password" required placeholder="••••••••" class="w-full px-3.5 py-2.5 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password</label>
                <input type="password" name="confirm_password" required placeholder="••••••••" class="w-full px-3.5 py-2.5 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <button type="submit" name="register" class="w-full py-2.5 px-4 bg-blue-600 hover:bg-blue-700 text-white font-medium text-sm rounded-lg shadow-sm transition-colors mt-2">
                Daftar Sekarang
            </button>
        </form>

        <p class="text-center text-xs text-gray-500 mt-6">
            Sudah punya akun? <a href="login.php" class="text-blue-600 font-medium hover:underline">Masuk di sini</a>
        </p>
    </div>

</body>
</html>