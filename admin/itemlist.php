<?php
    include '../koneksi.php';
    $querry = "SELECT * FROM products";
    $sql = mysqli_query($conn, $querry);
    $no = 0;

    session_start();
    if (!isset($_SESSION['login']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../pages/401.php");
    exit;
    }

    include '../koneksi.php';

?>

<!DOCTYPE html>
    <html>
        <head>
            <meta charset="UTF-8">
            <script src="https://cdn.tailwindcss.com"></script>
            <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
            <title>"List - produk"</title>
        </head>
        <body class="bg-gray-50 m-0 p-0 overflow-x-hidden min-h-screen">
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
                        <a href="../users/katalog.php" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">Katalog Produk</a>
                    </div>
                </div>
            </header>

            <div class="container ml-32">
                <h1 class="mt-8 font-bold text-4xl">DATA PRODUK</h1>
                <p class="mt-4">Berisi produk yang sudah ditambahkan</p>
                <a href="kelola.php"><button type="button" class="bg-sky-800 w-auto h-12 m-4 p-2 rounded-lg text-white">Tambah Produk</button></a>
            </div>
            <div class="max-w-4xl mx-auto my-8 overflow-x-auto rounded-lg border border-gray-200 shadow-sm">
                <table class="w-full text-left border-collapse bg-white text-sm text-gray-700">
                    <thead class="bg-gray-50 border-b border-gray-200 text-xs font-semibold uppercase tracking-wider text-gray-500">
                    <tr>
                        <th scope="col" class="px-6 py-3.5 text-left">No.</th>
                        <th scope="col" class="px-6 py-3.5 text-left">Nama</th>
                        <th scope="col" class="px-6 py-3.5 text-left">Nomor unik produk</th>
                        <th scope="col" class="px-6 py-3.5 text-left">Jenis</th>
                        <th scope="col" class="px-6 py-3.5 text-left">Foto</th>
                        <th scope="col" class="px-6 py-3.5 text-left">Status Ketersediaan</th>
                        <th scope="col" class="px-6 py-3.5 text-left">Aksi</th>
                        <th scope="col" class="px-6 py-3.5 text-left">Harga</th>
                    </tr>
                    </thead>
                    <?php 
                        while($result = mysqli_fetch_assoc($sql)) {
                    ?>
                    <tbody class="divide-y divide-gray-200">
                    <tr class="hover:bg-gray-50/50 transition-colors">
                        <td class="px-6 py-4 font-medium text-gray-900">
                            <?php echo ++$no; ?>
                        </td>
                        <td class="px-6 py-4 font-medium text-gray-900">
                            <?php echo $result['nama_produk']; ?>
                        </td>
                        <td class="px-6 py-4 font-medium text-gray-900">
                            <?php echo $result['nomor_unik_produk']; ?>
                        </td>
                        <td class="px-6 py-4 font-medium text-gray-900">
                            <?php echo $result['jenis']; ?>
                        </td>
                        <td class="px-6 py-4">
                            <?php if(!empty($result['foto_produk'])): ?>
                                <img src="../img/<?php echo htmlspecialchars($result['foto_produk']); ?>" alt="Foto Produk" class="w-120 h-120 object-cover rounded-md border border-gray-200">
                            <?php else: ?>
                                <span class="text-xs text-gray-400">Tidak ada foto</span>
                            <?php endif; ?>
                        </td>
                        <td class="px-6 py-4 font-medium text-gray-900">
                            <?php echo $result['status_ketersediaan']; ?>
                        </td>
                        <td>
                            <div class="flex items-center justify-center gap-2 mr-4">
                            <a href="kelola.php?edit=<?php echo $result['nomer_produk'] ?? ''; ?>"><button type="button" class="bg-green-600 w-12 h-9 rounded-md text-white">Edit</button></a>
                            <a href="proses.php?hapus=<?php echo $result['nomer_produk'] ?? ''; ?> "onclick="return confirm('Yakin ingin menghapus data ini?')"><button type="button" class="bg-red-600 w-12 h-9 rounded-md text-white">Hapus</button></a>
                            </div>
                        </td>
                        <td class="px-6 py-4 font-medium text-gray-900">
                            <?php echo number_format($result['harga'], 3, ',', '.'); ?>
                        </td>
                    </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </body>
    </html>