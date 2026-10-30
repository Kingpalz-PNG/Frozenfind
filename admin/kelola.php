<!DOCTYPE html>
    <?php 

    include '../koneksi.php';

        $nama_produk = '';
        $jenis = '';
        $status_ketersediaan = '';
        $harga = '';

    if(isset($_GET['edit'])){
        $nomer_produk = $_GET['edit'];

        $query = "SELECT * FROM products WHERE nomer_produk = '$nomer_produk';";
        $sql = mysqli_query($conn, $query);

        $result = mysqli_fetch_assoc($sql);
        $nama_produk = $result['nama_produk'] ?? '';
        $jenis = $result['jenis'] ?? '';
        $status_ketersediaan = $result['status_ketersediaan'] ?? '';
        $harga = $result['harga'] ?? '';

        $query = "UPDATE products SET nama_produk='$nama_produk', jenis='$jenis', status_ketersediaan='$status_ketersediaan', harga='$harga' WHERE nomer_produk='$nomer_produk';";
        $sql = mysqli_query($conn, $query);

        //var_dump($result);

        //die();
    }
            
            
    ?>
    <html>
        <head>
        <meta charset="UTF-8">
            <script src="https://cdn.tailwindcss.com"></script>
            <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
            <title>"List - produk"</title>
        </head>
        <body>
            <nav class="bg-[#d0e3ff] border-b border-blue-200 px-8 py-6 top-0 z-50">
            <div class="max-w-7xl mx-auto flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="h-auto w-auto bg-white rounded-lg shadow-sm"> 
                        <h1 class="mx-8 text-2xl"> Frozen Find </h1>  
                    </div>
                    <div class="h-auto w-auto bg-sky-600 rounded-lg shadow-sm"> 
                        <p class="mx-8 text-lg text-amber-50"> Kelola - produk </p>
                    </div>
                    <div class="h-auto w-auto rounded-lg shadow-sm"> 
                         <a href="itemlist.php"><button type="button" class="bg-red-600 w-auto h-auto p-2 m-3 rounded-md text-white">Kembali</button></a>
                    </div>
                </div>
            </div>
            </nav>
            <div class="max-w-xl mx-auto my-8 bg-white rounded-xl shadow-sm border border-gray-200 p-8">
                <?php if(isset($_GET['edit'])) { ?>
                <div class="mb-6">
                    <h2 class="text-2xl font-bold text-gray-900">Edit Produk Kamu</h2>
                    <p class="text-sm text-gray-500 mt-1">Silakan isi formulir di bawah ini dengan Perubahan yang valid.</p>
                </div>
                <?php } else { ?>
                <div class="mb-6">
                    <h2 class="text-2xl font-bold text-gray-900">Tambah Produk Baru</h2>
                    <p class="text-sm text-gray-500 mt-1">Silakan isi formulir di bawah ini dengan data produk yang valid.</p>
                </div>
                <?php } ?>

                <form action="proses.php" method="POST" enctype="multipart/form-data" class="space-y-5">
                    <input type="hidden" name="nomer_produk" value="<?php echo htmlspecialchars($nomer_produk); ?>">
                    <div>
                    <label for="nama_produk" class="block text-sm font-medium text-gray-700 mb-1.5">Nama Produk</label>
                    <input value="<?php echo $nama_produk; ?>" required type="text" id="nama_produk" name="nama_produk" placeholder="Contoh: Nugget Bellfood Stick" class="w-full px-3.5 py-2.5 text-sm text-gray-900 bg-white border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                    <label for="foto_produk" class="block text-sm font-medium text-gray-700 mb-1.5">Foto Produk</label>
                    <input <?php if(!isset($_GET['edit'])){echo "required";}?> type="file" id="foto_produk" name="foto_produk" accept="image/*"
                            class="w-full text-sm text-gray-500 border border-gray-300 rounded-lg shadow-sm cursor-pointer bg-white file:mr-4 file:py-2.5 file:px-4 file:rounded-l-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                    </div>
                    <div>
                    <label for="jenis" class="block text-sm font-medium text-gray-700 mb-1.5">Jenis</label>
                    <select <?php if(!isset($_GET['edit'])){echo "required";}?> required id="jenis" name="jenis" 
                            class="w-full px-3.5 py-2.5 text-sm text-gray-900 bg-white border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Pilih Jenis Produk...</option>
                        <option <?php if($jenis == 'nugget'){ echo "selected"; } ?> value="nugget">Nugget</option>
                        <option <?php if($jenis == 'sosis'){ echo "selected"; } ?> value="sosis">Sosis</option>
                        <option <?php if($jenis == 'daging_slice'){ echo "selected"; } ?> value="daging_slice">Daging slice</option>
                        <option <?php if($jenis == 'sotong'){ echo "selected"; } ?> value="sotong">Sotong</option>
                        <option <?php if($jenis == 'kebab'){ echo "selected"; } ?> value="kebab">Kebab</option>
                        <option <?php if($jenis == 'bakso'){ echo "selected"; } ?> value="bakso">Bakso</option>
                        <option <?php if($jenis == 'sayur_beku'){ echo "selected"; } ?> value="sayur">Sayur Beku</option>
                        <option <?php if($jenis == 'bumbu_rujak'){ echo "selected"; } ?> value="bumbu_rujak">Bumbu_rujak</option>
                        <option <?php if($jenis == 'seafood'){ echo "selected"; } ?> value="seafood">Seafood</option>
                        <option <?php if($jenis == 'bahan_masak'){ echo "selected"; } ?> value="bahan_masak">Lain-lain</option>
                    </select>
                    </div>
                    <div>
                    <label for="status_ketersediaan" class="block text-sm font-medium text-gray-700 mb-1.5">Status Ketersediaan</label>
                    <select <?php if(!isset($_GET['edit'])){echo "required";}?> required id="status_ketersediaan" name="status_ketersediaan"
                            class="w-full px-3.5 py-2.5 text-sm text-gray-900 bg-white border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Pilih Status...</option>
                        <option <?php if($status_ketersediaan == 'segar'){ echo "selected"; } ?> value="segar">Sedia</option>
                        <option <?php if($status_ketersediaan == 'menipis'){ echo "selected"; } ?> value="menipis">Terbatas</option>
                        <option <?php if($status_ketersediaan == 'habis'){ echo "selected"; } ?> value="habis">Habis</option>
                    </select>
                    </div>
                    <div>
                    <label for="harga" class="block text-sm font-medium text-gray-700 mb-1.5">Harga Produk</label>
                    <input value="<?php echo $harga; ?>" required type="text" id="harga" name="harga" placeholder="Contoh: 20.0000"
                            class="w-full px-3.5 py-2.5 text-sm text-gray-900 bg-white border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div class="pt-2">
                        <?php if(isset($_GET['edit'])) { ?>
                    <button type="submit" name="aksi" value="edit" class="w-full py-2.5 px-4 bg-blue-600 hover:bg-blue-700 text-white font-medium text-sm rounded-lg shadow-sm transition-colors cursor-pointer focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        Ubah Produk
                    </button>
                        <?php } else { ?>
                    <button type="submit" name="aksi" value="add" class="w-full py-2.5 px-4 bg-blue-600 hover:bg-blue-700 text-white font-medium text-sm rounded-lg shadow-sm transition-colors cursor-pointer focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        Tambah Produk
                    </button>
                        <?php } ?>
                    </div>
                </form>
            </div>
        </body>
    </html>