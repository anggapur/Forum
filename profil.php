<?php
include('koneksi.php');
session_start();

$user_check=$_SESSION['id_user'];
$sql2="select * from user where id_user='$user_check'";
$ses_sql=mysqli_query($koneksi, $sql2);
// Ambil data user dengan mysql_fetch_assoc
$row = mysqli_fetch_assoc($ses_sql);
$login_session =$row['username'];
$nama_session =$row['nama'];
$foto_session =$row['foto_profil'];
$email_session =$row['email'];
?>

<!DOCTYPE html>
<html>
    <head>
      <title>Data Profil</title>
      <link href="style.css" rel="stylesheet" type="text/css">
    </head>
<body>
  
    <div class="modal-content">
      <div class="container">
        <a href="welcome.php">Kembali ke Halaman Awal</a>
        <h1 id="welcome">Data Profil </h1></p>
        <p>Username : <?php echo $login_session; ?></p>
        <p>Nama : <?php echo $nama_session; ?></p>
        <p>Email : <?php echo $email_session; ?></p>
        <div class="clearfix">
          <button type="button" onclick="redirek()" class="cancelbtn">Log Out</button>
          <button type="button" onclick="redirek1()" class="signupbtn">Edit Profil</button>
        </div>
      </div>      
    </div>
</body>

<script>
function redirek() {
    location.replace("logout.php")
}
function redirek1() {
    location.replace("edit_profil.php")
}
</script>

</html>