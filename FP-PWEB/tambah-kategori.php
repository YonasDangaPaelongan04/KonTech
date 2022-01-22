<?php 
    session_start();
    include 'db.php';
    if($_SESSION['status_login'] != true){
        echo '<script>window.location="login.php"</script>';
    } 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="script.js"></script>
    <link rel="stylesheet" href="css/login.css">
    <title>Tambah Kategori</title>
</head>
<body>
<header>
        <div class="container">
        <h1><a href="dashboard-admin.php">Kontech</a></h1>
        <ul>
            <li><a href="dashboard-admin.php">Dashboard</a></li>
            <li><a href="profil.php">Profil</a></li>
            <li><a href="data-kategori.php">Data Kategori</a></li>
            <li><a href="data-produk.php">Data Produk</a></li>
            <li><a href="log-out.php">Log Out</a></li>
        </ul>
        </div>
        
    </header>
            <div class="section">
                <div class="container">
                    <h1>Tambah Data</h1>
                    <div class="box">
                        <form action="" method="POST">
                            <input type="text" name="nama" placeholder="Nama Kategori" class="input-control"  required>
                            <input type="submit" name="submit" value="Tambah Data" class="button-profil" >
                        </form>

                        <?php 
                            if(isset($_POST['submit'])){

                                $nama = ucwords($_POST['nama']);

                                $insert = mysqli_query($conn, "INSERT INTO tb_category VALUES (
                                    null,
                                    '".$nama."') " );
                                if($insert){
                                    echo '<script>alert("Tambah Data Berhasil")</script>';
                                    echo '<script>window.location="data-kategori.php"</script>';
                                }else{
                                    echo 'gagal '.mysqli_error($conn);
                                }
                            }
                        ?>
                        
                    </div>
                </div>
            </div>
</body>
</html>

