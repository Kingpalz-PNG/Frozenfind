<?php
    include '../koneksi.php';

            function tambah_data($data, $files){

            $random_number = rand(1, 9999999);
            $nama_produk = $_POST['nama_produk'];
            $nomor_unik_produk = $random_number;
            $jenis = $_POST['jenis'];
            $foto_produk = $_FILES['foto_produk']['name'];
            $status_ketersediaan = $_POST['status_ketersediaan'];
            $harga = $_POST['harga'];

            $dir = "../img/";
            $tmpFile = $_FILES['foto_produk']['tmp_name'];
            move_uploaded_file($tmpFile, $dir . $foto_produk);

            $query = "INSERT INTO products (nama_produk, nomor_unik_produk, jenis, foto_produk, status_ketersediaan, harga) 
                      VALUES ('$nama_produk', '$nomor_unik_produk', '$jenis', '$foto_produk', '$status_ketersediaan', '$harga')";
            
            $sql = mysqli_query($GLOBALS['conn'], $query);

                if(!$sql) {
                    die("Query gagal: " . mysqli_error($conn));
                }
            return true;
            }


            function edit_data($data, $files){
            $nomer_produk = $data['nomer_produk'];
            $nama_produk = $data['nama_produk'];
            $jenis = $data['jenis'];
            $status_ketersediaan = $data['status_ketersediaan'];
            $harga = $data['harga'];

            $queryshow = "SELECT * FROM products WHERE nomer_produk = '$nomer_produk';";
            $sqlshow = mysqli_query($GLOBALS['conn'], $queryshow);
            $result = mysqli_fetch_assoc($sqlshow);


            if($files['foto_produk']['name'] == ""){
            $foto_produk = $result['foto_produk'];
            } else {
            $foto_produk = $files['foto_produk']['name'];
            unlink("../img/".$result['foto_produk']);
            move_uploaded_file($files['foto_produk']['tmp_name'], '../img/'.$_FILES['foto_produk']['name']);
            }

            $query = "UPDATE products SET nama_produk='$nama_produk', jenis='$jenis', status_ketersediaan='$status_ketersediaan', harga='$harga', foto_produk='$foto_produk' WHERE nomer_produk='$nomer_produk';";
            $sql = mysqli_query($GLOBALS['conn'], $query);
            return true;
            }

            function hapus_data($data){
            $nomer_produk = $data['hapus'];

            $queryshow = "SELECT * FROM products WHERE nomer_produk = '$nomer_produk';";
            $sqlshow = mysqli_query($GLOBALS['conn'], $queryshow);
            $result = mysqli_fetch_assoc($sqlshow);
            unlink("../img/". $result['foto_produk']);
            $query = "DELETE FROM products WHERE nomer_produk = '$nomer_produk';";
            $sql = mysqli_query($GLOBALS['conn'], $query);
            return true;
            }
?>