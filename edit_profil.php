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
  <link rel="stylesheet" type="text/css" href="style.css">
</head>


<div>
  <form class="modal-content" action="edit_berhasil.php" method="POST">
    <div class="container">
      <h1>Edit Profil</h1>
      <p>Masukkan data baru anda.</p>
      <hr>
      <label for="name"><b>Nama</b></label>
      <input type="text" placeholder="<?= $nama_session?>" name="name" id="name" class="form-control" required>

      <label for="username"><b>Username</b></label>
      <input type="text" placeholder="<?= $login_session?>" name="username" class="form-control" id="username" required>

      <label for="email"><b>Email</b></label>
      <input type="text" placeholder="<?= $email_session?>" name="email" class="form-control" id="email" required>

      <label for="psw"><b>Password</b></label>
      <input type="password" placeholder="*****" name="password" class="form-control" id="pwd" required> 

      <div class="clearfix">
        <button type="button" onclick="redirek()" class="cancelbtn">Cancel</button>
        <button type="submit" class="signupbtn">Simpan Perubahan</button>
      </div>
    </div>
  </form>
</div>

<script>
function redirek() {
    location.replace("profil.php")
}
</script>

</body>
</html>
