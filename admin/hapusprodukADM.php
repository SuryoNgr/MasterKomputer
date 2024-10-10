<?php 
// koneksi database
include '../koneksi.php';
 
// menangkap data id yang di kirim dari url

 
 
// menghapus data dari database
mysqli_query($koneksi,"delete from produk where id_produk='$_GET[id]'");
 
// mengalihkan halaman kembali ke index.php
header("location:halaman_admin.php");
 
?>