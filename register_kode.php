<!--
Here, we write code for registration.
-->
<?php
require_once('koneksi.php');
$name = $username = $email = $password = $pwd = '';

$name = $_POST['name'];
$username = $_POST['username'];
$email = $_POST['email'];
$pwd = $_POST['password'];
$password = MD5($pwd);

$sql = "INSERT INTO user (nama, username, email, password) VALUES ('$name','$username','$email','$password')";
$result = mysqli_query($koneksi, $sql);
if($result)
{
	header("Location: login.php");
}
else
{
	echo "Error :".$sql;
}
?>