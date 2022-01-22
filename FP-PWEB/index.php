<?php
    include 'db.php';
    $kontak = mysqli_query($conn, "SELECT no_hp, admin_email, address FROM tb_admin WHERE admin_id = 1");
    $a = mysqli_fetch_object($kontak);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login.css">
    <title>Dashboard</title>
</head>
<body>
    <header>
        <div class="container">
        <h1><a href="index.php">Kontech</a></h1>
        <ul>
            <li><a href="produk.php">Produk</a></li>
        </ul>
        </div>        
    </header>

    <div class="search">
        <div class="container cari">
            <form action="produk.php">
                <input type="text" name="search" placeholder="Cari Produk">
                <input type="submit" name="cari" value="Cari Produk" class="sub">
            </form>  
        </div>  
    </div>

    <div class="section">
        <div class="box">
            <h3 class="ktg">Kategori </h3>
        </div>

        
        <div class="c1">
            
            <div class="box_kategori">
                <?php
                    $kategori = mysqli_query($conn, "SELECT * FROM tb_category ORDER BY category_id DESC");
                    if(mysqli_num_rows($kategori) > 0){
                        while($k = mysqli_fetch_array($kategori)){
                ?>
                    <a href="produk.php?kat=<?php echo $k['category_id'] ?>">
                        <div class="col-5">
                            <img src="img/icon.png" width="35px" style="margin-bottom: 5px;">
                            <p><?php echo $k['category_name'] ?></p>
                        </div>
                    </a>
                <?php }}else{ ?>
                    <p>Kategori tidak ada</p>
                <?php } ?>
                </div>
            </div>
        </div>
    </div>

    <div class="section">
        <div class="container">
            <h3 class="ubah">Produk Terbaru</h3>
            <div class="box">
                <?php
                    $produk = mysqli_query($conn, "SELECT * FROM tb_product WHERE product_status = 1 ORDER BY product_id DESC LIMIT 8");
                    if(mysqli_num_rows($produk) > 0){
                        while($p = mysqli_fetch_array($produk)){
                ?>
                    <a href="detail-produk.php?id=<?php echo $p['product_id'] ?>">
                        <div class="col-4">
                            <img src="produk/<?php echo $p['product_image'] ?>">
                            <p class="nama"><?php echo $p['product_name'] ?></p>
                            <p class="harga">Rp.<?php echo number_format ($p['product_price'])  ?></p>
                        </div>
                    </a>
                <?php }}else{ ?>
                    <p>Produk tidak ada</p>
                <?php } ?>
            </div>
        </div>
    </div>

    <div class="footer">
        <div class="container">
            <h4>Alamat</h4>
            <p><?php echo $a->address ?></p>
            <h4>Email</h4>
            <p><?php echo $a->admin_email ?></p>
            <h4>No Hp</h4>
            <p><?php echo $a->no_hp ?></p>
            

            <small>copyright &copy; 2021 - Kontech.</small>
        </div>
    </div>
</body>
</html>