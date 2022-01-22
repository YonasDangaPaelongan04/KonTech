<?php 
    $hostname = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'db_kontech';

    $conn = mysqli_connect($hostname, $username, $password, $dbname) or die ('Gagal Terhubung');
?>