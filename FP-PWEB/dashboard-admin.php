<?php 

session_start();
include 'db.php';
if($_SESSION['status_login'] != true){
    echo '<script>window.location="login.php"</script>';
}

$query = mysqli_query($conn, "SELECT * FROM tb_admin WHERE admin_id = '".$_SESSION['id']."'");
$d = mysqli_fetch_object($query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login.css">
    <title>Dashboard-Admin</title>
</head>
<body>
    <header>
        <div class="container">
        <h1><a href="dashboard-admin.php">Kontech</a></h1>
        <ul>
            <li><a href="dashboard-admin.php">Dashboard</a></li>
            <li><a href="data-kategori.php">Data Kategori</a></li>
            <li><a href="data-produk.php">Data Produk</a></li>
            <li><a href="log-out.php">Log Out</a></li>
        </ul>
        </div>
        
    </header>
    <div class="section">
        <div class="container">
            <h3>Profil Pribadi</h3>
            <div class="box">
                <h4><marquee >Selamat Datang <?php echo $_SESSION['admin_global']->admin_name  ?> pada website Kontech</marquee> </h4>
            </div>
        </div>
    </div>

            <div class="section">
                <div class="container">
                    <div class="box ubah1">
                        <h1 class="ubah">Biodata</h1>
                    </div>
                    <div class="box">
                        <form action="" method="POST">
                            <input type="text" name="nama" placeholder="Nama Lengkap" class="input-control" value="<?php echo $d->admin_name ?>" required>
                            <input type="text" name="user" placeholder="Username" class="input-control" value="<?php echo $d->username ?>" required>
                            <input type="text" name="hp" placeholder="Nomor Hp" class="input-control" value="<?php echo $d->no_hp ?>" required>
                            <input type="email" name="email" placeholder="Email" class="input-control" value="<?php echo $d->admin_email ?>" required>
                            <input type="text" name="alamat" placeholder="Alamat" class="input-control" value="<?php echo $d->address ?>" required><br>
                            <input type="submit" name="submit" value="Ubah Profil" class="button-profil" >
                        </form>
                        <?php 
                        if(isset($_POST['submit'])){

                            $nama   = ucwords($_POST['nama']);
                            $user   = $_POST['user'];
                            $hp     = $_POST['hp'];
                            $email  = $_POST['email'];
                            $alamat = ucwords($_POST['alamat']);

                            $update = mysqli_query($conn, "UPDATE tb_admin SET
                            admin_name  = '".$nama."',
                            username    = '".$user."',
                            no_hp       = '".$hp."',
                            admin_email = '".$email."',
                            address     = '".$alamat."'
                            WHERE admin_id = '".$d->admin_id."' ");

                            if($update){
                                echo '<script>alert("Ubah data berhasil")</script>';
                                echo '<script>window.location="dashboard-admin.php"</script>';
                            }else{
                                echo 'gagal' .mysqli_error($conn);
                            }

                        }
                        ?>
                    </div>

                    <div class="box ubah1">
                    <h1 class="ubah">Ubah Password</h1>
                    </div>

                    
                    <div class="box">
                        <form action="" method="POST">
                            <input type="password" name="pass1" placeholder="Password Baru" class="input-control" required>
                            <input type="password" name="pass2" placeholder="Konfirmasi Password" class="input-control" required><br>
                            <input type="submit" name="ubah_pass" value="Ubah password" class="button-profil" >
                        </form>
                        <?php 
                        if(isset($_POST['ubah_pass'])){

                            $pass1   = $_POST['pass1'];
                            $pass2     = $_POST['pass2'];
                           
                            if($pass2 != $pass1){
                                echo '<script>alert("Password tidak sesuai")</script>';
                            }else{
                                $u_pass = mysqli_query($conn, "UPDATE tb_admin SET
                                password     = '".MD5($pass1)."'
                                WHERE admin_id = '".$d->admin_id."' ");
                            if($u_pass){
                                echo '<script>alert("Ubah data berhasil")</script>';
                                echo '<script>window.location="dashboard-admin.php"</script>';
                            }else{
                                echo 'gagal' .mysqli_error($conn);
                            }
                            }

                        }
                        ?>
                    
                </div>
            </div>

    <footer class="container">
        <small>Copyright &copy; 2021 - Kontech.</small>
    </footer>
</body>
</html>