<?php
include '../koneksi.php';

session_start();
if (!isset($_SESSION['login'])) {
    header("Location: ../login/login.php");
    exit;
}

$cari = '';
if (isset($_GET['cari'])) {
    $cari = mysqli_real_escape_string($conn, $_GET['cari']);
    $query = "SELECT * FROM products WHERE nama_produk LIKE '%$cari%' OR jenis LIKE '%$cari%'";
} else {
    $query = "SELECT * FROM products";
}
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Produk - Frozen Find</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
            background-color: #f4f6f9;
        }
    </style>
</head>
<body class="bg-[#f4f6f9] min-h-screen text-slate-800 flex flex-col">
    <header class="bg-[#d0e3ff] border-b border-blue-200 px-6 py-3 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <div class="bg-white px-4 py-2 rounded-lg shadow-sm font-bold text-blue-600"> 
                  Frozen Find  
                </div>
                <div class="bg-white px-4 py-2 rounded-lg shadow-sm text-sm text-slate-600 hidden sm:block"> 
                    Cari Tau Produkmu Disini
                </div>
            </div>
            <div>
                <a href="../admin/itemlist.php" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">Kelola Produk</a>
            </div>
        </div>
    </header>
    <section class="bg-[#2b72d8] h-48 sm:h-56 w-full relative flex items-center justify-center">
        <h1 class="text-white text-3xl font-bold tracking-wide">Katalog Frozen Food</h1>
    </section>
    <div class="max-w-4xl mx-auto px-4 -mt-8 sm:-mt-10 relative z-20 w-full">
        <form action="" method="GET" class="bg-white rounded-xl shadow-md border border-slate-100 p-2 sm:p-3 flex items-center gap-3">
            <div class="w-10 h-10 sm:w-11 sm:h-11 rounded-full bg-[#d0d7de] shrink-0 flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>
            <input type="text" name="cari" value="<?php echo htmlspecialchars($cari); ?>" placeholder="Cari nama produk atau jenis (Contoh: Nugget, Sosis)..." class="w-full bg-transparent focus:outline-none text-slate-700 text-sm sm:text-base">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-lg text-sm font-medium transition-colors cursor-pointer">Cari</button>
        </form>
    </div>
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 flex-1 w-full">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 sm:gap-8">
            
            <?php if (mysqli_num_rows($result) > 0) { 
                while ($row = mysqli_fetch_assoc($result)) { 
            ?>
                <div class="bg-white rounded-2xl p-4 shadow-sm hover:shadow-md transition-shadow duration-200 border border-slate-100 flex flex-col justify-between">
                    <div>
                        <!-- Gambar Produk -->
                        <div class="w-full aspect-square bg-slate-100 rounded-xl mb-4 overflow-hidden flex items-center justify-center border border-slate-50">
                            <?php if (!empty($row['foto_produk']) && file_exists("../img/" . $row['foto_produk'])) { ?>
                                <img src="../img/<?php echo htmlspecialchars($row['foto_produk']); ?>" alt="<?php echo htmlspecialchars($row['nama_produk']); ?>" class="w-full h-full object-cover">
                            <?php } else { ?>
                                <span class="text-xs text-slate-400 font-medium">Tidak Ada Foto</span>
                            <?php } ?>
                        </div>

                        <!-- Kategori Jenis -->
                        <span class="inline-block px-2 py-0.5 text-[10px] font-semibold bg-blue-50 text-blue-600 rounded-md mb-1 uppercase">
                            <?php echo htmlspecialchars($row['jenis']); ?>
                        </span>

                        <!-- Nama Produk -->
                        <h3 class="font-bold text-slate-900 text-sm sm:text-base leading-tight mt-1">
                            <?php echo htmlspecialchars($row['nama_produk']); ?>
                        </h3>

                        <!-- Harga -->
                        <p class="text-sm font-semibold text-blue-600 mt-2">
                            Rp. <?php echo number_format($row['harga'], 3, ',', '.'); ?>
                        </p>
                    </div>

                    <!-- Status Ketersediaan -->
                    <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between">
                        <span class="text-[11px] px-2.5 py-1 rounded-full font-medium 
                            <?php 
                            if($row['status_ketersediaan'] == 'segar') echo 'bg-green-100 text-green-700';
                            elseif($row['status_ketersediaan'] == 'menipis') echo 'bg-amber-100 text-amber-700';
                            else echo 'bg-red-100 text-red-700';
                            ?>">
                            <?php 
                            if($row['status_ketersediaan'] == 'segar') echo 'Sedia';
                            elseif($row['status_ketersediaan'] == 'menipis') echo 'Terbatas';
                            else echo 'Habis';
                            ?>
                        </span>
                    </div>
                </div>
            <?php 
                } 
            } else { 
            ?>
                <div class="col-span-full text-center py-16 bg-white rounded-2xl border border-slate-100 shadow-sm">
                    <p class="text-slate-500 font-medium">Produk yang Anda cari tidak ditemukan.</p>
                    <a href="katalog.php" class="inline-block mt-3 text-sm text-blue-600 hover:underline">Reset Pencarian</a>
                </div>
            <?php } ?>

        </div>
    </main>

    <!-- Footer -->
    <footer class="py-6 text-center text-xs text-slate-400 bg-white border-t border-slate-200 mt-auto">
        <p>&copy; 2026 Frozen Find. All rights reserved.</p>
        <div class="flex justify-center m-4 p-2">
            <a href="../login/logout.php" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">Logout</a>
        </div>
    </footer>

</body>
</html>