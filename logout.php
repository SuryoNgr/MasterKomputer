<?php
session_start();
include 'koneksi.php';


// Proses logout
if (isset($_SESSION['user_id'])) {
    // Simpan data keranjang ke database
    $userId = $_SESSION['user_id'];
    $shoppingCart = isset($_SESSION['shopping_cart']) ? $_SESSION['shopping_cart'] : [];

    foreach ($shoppingCart as $productId => $quantity) {
        // Insert atau update data keranjang di database
        $query = "INSERT INTO keranjang (id_user, id_produk, quantity) VALUES ($userId, $productId, $quantity)
                  ON DUPLICATE KEY UPDATE quantity = $quantity";
        // Eksekusi query untuk menyimpan data keranjang
        mysqli_query($koneksi, $query);
    }
}

// Hapus data keranjang dari sesi
unset($_SESSION['shopping_cart']);
$_SESSION['cart_count'] = 0;

// Melakukan proses logout
session_destroy();

// Redirect ke halaman login atau halaman lain setelah logout
header("Location: login.php");
exit();
?>
