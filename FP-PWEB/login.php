<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@1,200&display=swap" rel="stylesheet">
    <title>login</title>
</head>
<body id="bg-login">
    <div class="box-login">
        <h2>Login</h2>
        <form action="" method="POST">
            <input type="text" name="user" placeholder="Username" class="admin-login">
            <input type="password" name="pass" placeholder="Password" class="admin-login">
            <input type="submit" name="submit" value = "Login" class="btn">
        </form>
        <?php 
            if(isset($_POST['submit'])){
                session_start();
                include 'db.php';

                $user=mysqli_real_escape_string($conn,$_POST['user']);
                $pass=mysqli_real_escape_string($conn,$_POST['pass']);

                $cek = mysqli_query($conn, "SELECT * FROM tb_admin WHERE admin_name = '".$user."' AND password = '".MD5($pass)."'");
                if(mysqli_num_rows($cek) > 0){
                    
                    $d = mysqli_fetch_object($cek);
                    $_SESSION['status_login'] = true;
                    $_SESSION['admin_global'] = $d;
                    $_SESSION['id'] = $d->admin_id;

                    echo '<script>window.location="dashboard-admin.php"</script>';
                }else{
                    echo '<script>alert("Username dan password anda salah")</script>';
                }
            }
        ?>
    </div>
</body>
</html>