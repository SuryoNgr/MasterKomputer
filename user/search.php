<?php
include '../koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["keyword"])) {
        $keyword = $_POST["keyword"];
        
        // Sanitasi input keyword
        $keyword = mysqli_real_escape_string($koneksi, $keyword);

        // Query pencarian berdasarkan nama produk
        $query = "SELECT * FROM produk WHERE nama LIKE '%$keyword%'";
        $result = mysqli_query($koneksi, $query);

        if (mysqli_num_rows($result)) {
            while ($data = mysqli_fetch_assoc($result)) {
                // Tampilkan hasil pencarian
                echo '
                <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                    <form style="height: 390px" method="post" class="box" action="cart.php?action=add&id='.$data["id_produk"].'">
                        <div class="card h-100">
                            <div class="card-img-container">
                                <img src="'.$data['gambar'].'" class="card-img" alt="'.$data['nama'].'">
                            </div>
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <div class="title">
                                        <h5>'.$data['nama'].'</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <div>
                                    <h6>Rp.'.number_format($data['harga']).'</h6>
                                </div>
                                <input type="hidden" name="product_image" value="'.$data['gambar'].'">
                                <input type="hidden" name="product_name" value="'.$data['nama'].'">
                                <input type="hidden" name="product_price" value="'.$data['harga'].'">
                                <div style="padding-bottom: 10px">
                                    <button type="submit" class="btn btn-outline-primary" name="add_to_cart"><i class="fas fa-shopping-cart"></i> Masukan Keranjang</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>';
            }
        } else {
            // Tampilkan pesan jika tidak ada hasil pencarian
            echo '<div class="col-12">Produk tidak ditemukan.</div>';
        }
    }
}
?>
