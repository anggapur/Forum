<?php  
  
  session_start();
  $koneksi  = mysqli_connect("localhost","root","","db_forum");
  if (!$koneksi) {
    # code...
    echo "Gagal Koneksi ".mysqli_connect_error();
  }

  if (isset($_POST['masuk'])) {
    # code...
    $uname = $_POST['uname'];
    $password = $_POST['psw'];
    $cek = "SELECT username, password, id_user FROM user WHERE username='$uname' AND password = '$password'";
    $result = mysqli_query($koneksi, $cek);
    if(mysqli_num_rows($result)==1){
      echo "<script>alert('You Logged in successfully, Thanks! ')</script>";
      $row = mysqli_fetch_assoc($result);
      $_SESSION['username'] = $row['username'];
      $_SESSION['id_user'] = $row['id_user'];
      header('location:index.php');
    }
    else{
      $pesan="Gagal, Email dan password anda salah";
      echo $pesan;
    }
  }

?>



<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <title>Login</title>
  </head>
  <body>
    <form method="post">
      <div class="container">
        <div class="form-group">
          <label for="uname"><b>Username</b></label>
          <input type="text" class="form-control" placeholder="Enter Username" name="uname" required="">
        </div>
        <div class="form-group">
          <label for="psw"><b>Password</b></label>
          <input type="password" class="form-control" placeholder="Enter Password" name="psw" required="">
        </div>
        <input type="submit" name="masuk" value="Masuk">
      </div>
    </form>
  </body>
</html>
