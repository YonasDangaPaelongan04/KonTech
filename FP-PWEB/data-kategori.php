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
    <title>Data-Kategori</title>
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
            <div class="box head">
            <h3>Data Kategori</h3>
            </div>
            <div class="box">
                <p class="button-ktg"><a href="Tambah-kategori.php">Tambah Data</a></p>
                <table border="1" cellspacing="0" class="table">
                    <thead>
                        <tr>
                            <th width="1px">No</th>
                            <th width="200px">Kategori</th>
                            <th width="30px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $no = 1;
                        $kategori = mysqli_query($conn, "SELECT * FROM tb_category ORDER BY category_id DESC");
                        while($row = mysqli_fetch_array($kategori)) {
                            
                       ?>
                    <tr>
                        <td><?php echo $no++ ?></td>
                        <td><?php echo $row['category_name'] ?></td>
                        <td class="edithapus">
                            <button class="edit1"><a class="edit" href="edit-kategori.php?id=<?php echo $row['category_id'] ?>">Edit</a></button>
                             || 
                             <button class="hapus1"><a class="hapus" href="proses-hapus.php?idk=<?php echo $row['category_id']?>" onclick="return confirm('Anda yakin ingin menghapus ?')">Hapus</a></button>
                            </td>
                    </tr>
                    <?php } ?>
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