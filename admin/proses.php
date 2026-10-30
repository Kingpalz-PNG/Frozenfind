<?php

    include "fungsi.php";

?>


<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Produk Berhasil Diproses - Frozen Find</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 flex items-center justify-center min-h-screen m-0 text-gray-800">
  <div class="max-w-md w-full mx-4 bg-white rounded-2xl shadow-sm border border-gray-200 p-8 text-center">
    <?php
    if(isset($_POST['aksi'])){
        if($_POST['aksi'] == "add"){ 
          $berhasil = tambah_data($_POST, $_FILES);
          if($berhasil){
        ?>
    <div class="w-16 h-16 bg-green-600 text-green-600 rounded-full flex items-center justify-center mx-auto mb-5 shadow-inner">
      <img src="../icon/check-mark.png">
    </div>
    <h1 class="text-2xl font-bold text-gray-900 mb-2">Produk Berhasil Ditambahkan!</h1>
    <p class="text-sm text-gray-500 mb-8 leading-relaxed">
      Data produk baru Anda telah sukses tersimpan di dalam sistem. Anda dapat melihatnya kembali pada halaman daftar produk.
    </p>
    <?php 
    }
    else{echo $berhasil;}
    } elseif($_POST['aksi']== "edit"){
      $berhasil = edit_data($_POST, $_FILES);
      if ($berhasil){
        ?>
        <div class="w-16 h-16 bg-green-600 text-green-600 rounded-full flex items-center justify-center mx-auto mb-5 shadow-inner">
      <img src="../icon/pencil.png">
    </div>
    <h1 class="text-2xl font-bold text-gray-900 mb-2">Produk Berhasil Diubah!</h1>
    <p class="text-sm text-gray-500 mb-8 leading-relaxed">
      Perubahan produk Anda telah sukses tersimpan di dalam sistem. Anda dapat melihatnya kembali pada halaman daftar produk.
    </p>
    <?php }else
    {echo $berhasil;}
          }
         }if(isset($_GET['hapus'])){
          $berhasil = hapus_data($_GET);
            if ($berhasil){
        ?>
        <div class="w-16 h-16 bg-red-600 text-green-600 rounded-full flex items-center justify-center mx-auto mb-5 shadow-inner">
      <img src="../icon/trash-can.png">
    </div>
    <h1 class="text-2xl font-bold text-gray-900 mb-2">Produk Berhasil Dihapus!</h1>
    <p class="text-sm text-gray-500 mb-8 leading-relaxed">
      Data produk baru Anda telah sukses terhapus di dalam sistem. Anda dapat melihatnya kembali pada halaman daftar produk.
    </p>
    <?php }else{echo $query;}} ?>
    <div class="space-y-3">
      <a href="itemlist.php" class="block w-full py-3 px-4 bg-blue-600 hover:bg-blue-700 text-white font-medium text-sm rounded-xl shadow-sm transition-colors text-center">
        Lihat Daftar Produk
      </a>
      <a href="../users/katalog.php" class="block w-full py-3 px-4 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium text-sm rounded-xl transition-colors text-center">
        Preview halaman katalog
      </a>
    </div>

  </div>
</body>
</html>