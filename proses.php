<?php
	include("koneksi.php");

	$username = $_POST['username'];
	$password = $_POST['password'];

	$sql = "SELECT * FROM user WHERE username = '$username' and password = '$password'";
    $result = mysqli_query($koneksi,$sql) or die(mysqli_error($koneksi));      
    $count = mysqli_num_rows($result);

    if($count == 1) {
        echo "success";
    }else {
        echo "failed";
    }
?>