<?php
    error_reporting(0);
    include 'db.php';
    $kontak = mysqli_query($conn, "SELECT no_hp, admin_email, address FROM tb_admin WHERE admin_id = 1");
    $a = mysqli_fetch_object($kontak);

    $produk = mysqli_query($conn, "SELECT * FROM tb_product WHERE product_id = '".$_GET['id']."' ");
    $p = mysqli_fetch_object($produk);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login.css">
    <title>Detail Produk</title>
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
        <div class="container">
            <form action="produk.php">
                <input type="text" name="search" placeholder="Cari Produk" value="<?php echo $_GET['search'] ?>">
                <input type="hidden" name="kat" value="<?php echo $_GET['kat'] ?>">
                <input type="submit" name="cari" value="Cari Produk">
            </form>  
        </div>  
    </div>

<div class="section">
    <div class="container">
        <h3>Detail Produk</h3>
        <div class="box">
            <div class="col-2">
               <img src="produk/<?php echo $p->product_image ?>" width="100%">
            </div>
            <div class="col-2">
               <h3><?php echo $p->product_name ?></h3>
               <h4>Rp <?php echo number_format($p->product_price) ?></h4>
               <p>Deskripsi :<br>
                    <?php echo $p->product_description ?>
               </p>
                <button class="whatsapp">            
                   <p><a href="https://api.whatsapp.com/send?phone=<?php echo $a->no_hp ?>&text=Hallo, saya tertarik dengan produk anda." target="_blank">Hubungi Via Whatsapp</a></p>
                </button>
            </div>
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
        </div>
    </div>
</body>
</html>