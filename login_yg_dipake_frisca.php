<<<<<<< HEAD:login.php
<?php
=======
<<<<<<< HEAD
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
=======
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {font-family: Arial, Helvetica, sans-serif;}
.container {
    width: 500px;
    margin: 0 auto;
    border-radius: 2px;
    padding: 25px;
    box-shadow: 0px 0px 3px 0px #b9b6b6;
    margin-top: 40px;
    margin-top: 15%;
}
.alert {
    padding: 20px;
    text-align: center;
    /* width: fit-content; */
    border-radius: 5px;
    background: #dc3030f0;
    color: white;
    margin: 0 auto;
    display: none;
}
.success {
    padding: 20px;
    text-align: center;
    /* width: fit-content; */
    border-radius: 5px;
    background: #39ab3d;
    color: white;
    margin: 0 auto;
    display: none;
    font-weight: bold;
}
/* Full-width input fields */
input[type=text], input[type=password] {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    box-sizing: border-box;
}
>>>>>>> b29d755363829e8fa467c612e94ba4739fad5db3:login_yg_dipake_frisca.php

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
    $data = $result->fetch_array(MYSQLI_NUM);
  if($count > 0)
 {
  #mengecek password
    if($_POST["password"] == $data[3])
    {
        $_SESSION['id_user'] = $data[0];
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

<<<<<<< HEAD:login.php
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
=======
          e.preventDefault();
        });
      });
    </script>
</body>
>>>>>>> b24eb2ba311c04edfc71a948f96bb994e168e5d8
</html>
>>>>>>> b29d755363829e8fa467c612e94ba4739fad5db3:login_yg_dipake_frisca.php
