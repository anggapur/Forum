<?php

include('koneksi.php');

session_start();

$message = '';

//membuat user tetap masuk saat mengakses login bila belum logout
if(isset($_SESSION['id_user']))
{
 header('location:welcome.php');
}

if(isset($_POST["login"]))
{
  $username = $_POST['username'];
  $password = $_POST['password'];

  $sql = "SELECT * FROM user WHERE username = '$username'";
    $result = mysqli_query($koneksi,$sql) or die(mysqli_error($koneksi));      
    $count = mysqli_num_rows($result);
    //mengambil data untuk satu baris pada database
    $data = mysqli_fetch_assoc($result);
    $pass = md5($_POST["password"]);
  if($count > 0)
 {

  #mengecek password
    if($pass == $data["password"])
    {
        $_SESSION['id_user'] = $data["id_user"];
        $_SESSION['username'] = $username;
        header("location:welcome.php");
    }
    else
    {
      $message = "<label>Password Salah</label>";          
    }
}
 else
 {
  $message = "<label>Username Salah</label>";
 }
}

?>

<html>  
    <head>  
        <title>Aplikasi Komentar</title>  
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    </head>  
    <body>  
        <div class="container">
   <br />
   
   <h3 align="center">Aplikasi Komentar</a></h3><br />
   <br />
   <div class="panel panel-default">
      <div class="panel-heading">Login Aplikasi Komentar</div>
    <div class="panel-body">
     <form method="post">
      <p class="text-danger"><?php echo $message; ?></p>
      <div class="form-group">
       <label>Masukkan Username</label>
       <input type="text" name="username" class="form-control" required />
      </div>
      <div class="form-group">
       <label>Masukkan Password</label>
       <input type="password" name="password" class="form-control" required />
      </div>
      <div class="form-group">
       <input type="submit" name="login" class="btn btn-info" value="Login" />
      </div>
     </form>
    </div>
   </div>
  </div>
    </body>  
</html>