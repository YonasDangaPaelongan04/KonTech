<?php 
    session_start();
    include 'db.php';
    if($_SESSION['status_login'] != true){
        echo '<script>window.location="login.php"</script>';


    } 

    $produk = mysqli_query($conn, "SELECT * FROM tb_product WHERE product_id = '".$_GET['id']."'");
    $p = mysqli_fetch_object($produk);
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
                    <h1>Edit Produk</h1>
                    <div class="box">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <select class="input-control" name="kategori" required>
                                <option value="">Pilih</option>
                                <?php 
                                    $kategori = mysqli_query($conn, "SELECT * FROM tb_category ORDER BY category_id DESC");
                                    while($r = mysqli_fetch_array($kategori)){
                                ?>
                                <option value="<?php echo $r['category_id'] ?>" <?php echo ($r['category_id'] == $p->category_id)?'selected':''?>><?php echo $r['category_name'] ?></option>
                                <?php } ?>
                            </select>

                            <input type="text" name="nama" class="input-control" placeholder="Nama Produk" value="<?php echo $p->product_name ?>" required><br>
                            <input type="text" name="harga" class="input-control" placeholder="Harga Produk" value="<?php echo $p->product_price ?>" required><br>

                            <img src="produk/<?php echo $p->product_image ?>" width="100px">
                            <input type="hidden" name="foto" value="<?php echo $p->product_image ?>">
                            <input type="file" name="gambar" class="input-control" placeholder="Gambar Produk" ><br>
                            <textarea name="deskripsi" cols="30" rows="10" class="input_control"><?php echo $p->product_description ?></textarea><br>
                            <select name="status" class="input-control">
                                <option value="">Pilih</option>
                                <option value="1"<?php echo ($p->product_status == 1)? 'selected':'' ?>>Aktif</option>
                                <option value="0"<?php echo ($p->product_status == 0)? 'selected':''?>>Tidak Aktif</option>
                            </select>
                            <input type="submit" name="submit" value="Tambah Data" class="button-profil" >
                        </form>

                        <?php 
                            if(isset($_POST['submit'])){
                                
                                // Data inputan dari form
                                $kategori   = $_POST['kategori'];
                                $nama       = $_POST['nama'];
                                $harga      = $_POST['harga'];
                                $deskripsi  = $_POST['deskripsi'];
                                $status     = $_POST['status'];
                                $foto       = $_POST['foto'];
                                // data gambar yang baru
                                $filename = $_FILES['gambar']['name'];
                                $tmp_name = $_FILES['gambar']['tmp_name'];

                               
                                // jika admin ganti gambar
                                if($filename != ''){    
                                    $type1 = explode('.', $filename);
                                    $type2 = $type1[1];
    
                                    $newname = 'produk'.time().'.'.$type2;
                                    $type_diizinkan = array('jpg', 'jpeg', 'png', 'jfif', 'PNG');

                                    if(!in_array($type2, $type_diizinkan)){
                                        echo '<script>alert("Format File tidak Diizinkan")</script>';
                                    }else{
                                        unlink('./produk/'.$foto);
                                        move_uploaded_file($tmp_name, './produk/'.$newname);
                                        $namagambar = $newname;
                                    }
                                }else{
                                    // jika admin tidak ganti gambar
                                    $namagambar = $foto;

                                }

                                // query update data produk
                                $update = mysqli_query($conn, "UPDATE tb_product SET
                                        category_id         = '".$kategori."',
                                        product_name        = '".$nama."',
                                        product_price       = '".$harga."',
                                        product_description = '".$deskripsi."',
                                        product_image       = '".$namagambar."',
                                        product_status      = '".$status."'
                                        WHERE product_id    = '".$p->product_id."' ");

                            if($update){
                                echo '<script>alert("Ubah Data Berhasil")</script>';
                                echo '<script>window.location="data-produk.php"</script>';

                            }else{
                                echo 'gagal' .mysqli_error($conn);
                            }

                                
                                
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

