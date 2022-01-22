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
    <link rel="stylesheet" href="css/login.css">
    <title>Data-Produk</title>
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
            <h3 class="box head">Data Produk</h3>
            <div class="box">
                <p class="button-ktg"><a  href="Tambah-produk.php">Tambah Data</a></p>
                <table border="1" cellspacing="0" class="table">
                    <thead>
                        <tr>
                            <th width="60px">No</th>
                            <th width="120px">Kategori</th>
                            <th width="150px">Nama Produk</th>
                            <th width="150px">Harga</th>
                            <th width="200px">Deskripsi</th>
                            <th width="150px">Gambar</th>
                            <th width="100px">Status</th>
                            <th width="400px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $no = 1;
                        $produk = mysqli_query($conn, "SELECT * FROM tb_product LEFT JOIN tb_category USING (category_id) ORDER BY product_id DESC");
                        if(mysqli_num_rows($produk) > 0){

                        while($row = mysqli_fetch_array($produk)){
                          
                       ?>
                    <tr>
                        <td><?php echo $no++ ?></td>
                        <td><?php echo $row['category_name'] ?></td>
                        <td><?php echo $row['product_name'] ?></td>
                        <td> Rp.<?php echo number_format($row['product_price'])  ?></td>
                        <td><?php echo $row['product_description'] ?></td>
                        <td><img src="produk/<?php echo $row['product_image'] ?>" width="90px"></td>
                        <td><?php echo ($row['product_status'] == 0)? 'Tidak Aktif':'Aktif' ?></td>
                        
                        <td class="edithapus">
                        <button class="edit1"><a class="edit" href="edit-produk.php?id=<?php echo $row['product_id'] ?>">Edit</a></button> || 
                        <button class="hapus1"><a class="hapus" href="proses-hapus.php?idp=<?php echo $row['product_id']?>" onclick="return confirm('Anda yakin ingin menghapus ?')">Hapus</a></button>
                        </td>
                    </tr>
                    <?php } }else{ ?>
                        <tr>
                            <td colspan="8"> Tidak ada data</td>
                        </tr>
                        <?php  } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <footer class="container">
        <small>Copyright &copy; 2021 - Kontech.</small>
    </footer>
</body>
</html>