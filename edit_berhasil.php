<?php
require_once('koneksi.php');
session_start();
$name = $username = $email = $password = $pwd = '';

$name = $_POST['name'];
$username = $_POST['username'];
$email = $_POST['email'];
$pwd = $_POST['password'];
$password = MD5($pwd);

$user_check=$_SESSION['id_user'];

$sql = "UPDATE user SET nama = '$name', username = '$username', email = '$email', password = '$password' WHERE id_user= '$user_check'";
$result = mysqli_query($koneksi, $sql);
if($result)
{
	echo "Data Berhasil Diedit. Tunggu sampai anda dialihkan...";
	header('Refresh: 3; URL=profil.php');
	//header("Location: profil.php");
}
else
{
	echo "Error :".$sql;
}
?>