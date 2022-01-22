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
    <script src="https://cdn.ckeditor.com/4.17.1/standard/ckeditor.js"></script>

    <title>Tambah Produk</title>
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
                    <h1>Tambah Produk</h1>
                    <div class="box">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <select class="input-control" name="kategori" required>
                                <option value="">Pilih</option>
                                <?php 
                                    $kategori = mysqli_query($conn, "SELECT * FROM tb_category ORDER BY category_id DESC");
                                    while($r = mysqli_fetch_array($kategori)){
                                ?>
                                <option value="<?php echo $r['category_id'] ?>" ><?php echo $r['category_name'] ?></option>
                                <?php } ?>
                            </select>

                            <input type="text" name="nama" class="input-control" placeholder="Nama Produk" required><br>
                            <input type="text" name="harga" class="input-control" placeholder="Harga Produk" required><br>
                            <input type="file" name="gambar" class="input-control" placeholder="Gambar Produk" required><br>
                            <textarea name="deskripsi" cols="30" rows="10" class="input_control"></textarea><br>
                            <select name="status" class="input-control">
                                <option value="">Pilih</option>
                                <option value="1">Aktif</option>
                                <option value="0">Tidak Aktif</option>
                            </select>
                            <input type="submit" name="submit" value="Tambah Data" class="button-profil" >
                        </form>

                        <?php 
                            if(isset($_POST['submit'])){
                                // print_r($_FILES['gambar']);
                                // menamung inputan dari form
                                $kategori   = $_POST['kategori'];
                                $nama       = $_POST['nama'];
                                $harga      = $_POST['harga'];
                                $deskripsi  = $_POST['deskripsi'];
                                $status     = $_POST['status'];
                                // menampung data file yang di upload
                                $filename = $_FILES['gambar']['name'];
                                $tmp_name = $_FILES['gambar']['tmp_name'];

                                $type1 = explode('.', $filename);
                                $type2 = $type1[1];

                                $newname = 'produk'.time().'.'.$type2;

                                
                                // menampung data format file yang di izinkan
                                $type_diizinkan = array('jpg', 'jpeg', 'png', 'jfif', 'PNG','webp');
                                // validasi format file
                                if(!in_array($type2, $type_diizinkan)){
                                    echo '<script>alert("Format File tidak Diizinkan")</script>';
                                }else{
                                    move_uploaded_file($tmp_name, './produk/'.$newname);

                                    $insert = mysqli_query($conn, "INSERT INTO tb_product VALUES (
                                            null,
                                            '".$kategori."',
                                            '".$nama."',
                                            '".$harga."',
                                            '".$deskripsi."',
                                            '".$newname."',
                                            '".$status."',
                                            null
                                            
                                                ) ");

                                            if($insert){
                                                echo '<script>("simpan data berhasil"</script>';
                                                echo '<script>window.location="data-produk.php"</script>';
                                            }else{
                                                echo 'gagal menyimpan data' . mysqli_error($conn);
                                            }
                                   
                                }
                                // proses upload file sekaliguus insert ke dattabase
                                
                            }
                        ?>
                        
                    </div>
                </div>
            </div>
            <script>
                CKEDITOR.replace( 'deskripsi' );
            </script>
</body>
</html>

