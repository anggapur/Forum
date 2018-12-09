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

/* Set a style for all buttons */
button {
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 100%;
}

button:hover {
    opacity: 0.8;
}

/* Extra styles for the cancel button */
.cancelbtn {
    width: auto;
    padding: 10px 18px;
    background-color: #f44336;
}

/* Center the image and position the close button */
.imgcontainer {
    text-align: center;
    margin: 24px 0 12px 0;
    position: relative;
}


span.psw {
    float: right;
    padding-top: 16px;
}
</style>
</head>
<body>

    <div class="alert"></div>
    <div class="success">Login Berhasil</div>
    <!-- <h2 class="imgcontainer">Login Form AJAX</h2>   -->
    <form id="form-login" action="" method="post">
        <div class="container">
          <label for="uname"><b>Username</b></label>
          <input type="text" placeholder="Enter Username" name="username">
          <label for="psw"><b>Password</b></label>
          <input type="password" placeholder="Enter Password" name="password">
          <button type="submit">Login</button>
          
        </div>
       
    </form>

    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript">
      $(document).ready(function(){
        $('#form-login').submit(function(e){
          //get data login
          dataLogin = $(this).serializeArray();
          console.log(dataLogin);
          //cek validasi kosong
          if($('input[name="username"]').val() == "")
          {

            $('.alert').html('<b>Kolom Username</b> tidak boleh kosong').fadeIn("fast").fadeOut(3000);;
            $('input[name="username"]').focus();
            return false;
          }
          else if($('input[name="password"]').val() == "")
          {
            $('.alert').html('<b>Kolom Password</b> tidak boleh kosong').fadeIn("fast").fadeOut(3000);;
            $('input[name="password"]').focus();
            return false;
          }
          //ajax
          $.ajax({
            type : 'POST',
            data : dataLogin,
            url : 'proses.php',
            success : function(data){
              if(data == "success")
              {
                $('.success').fadeIn("fast").fadeOut(5000);
                setTimeout(function(){
                  window.location.href = "welcome.php";
                },1234);
              }
              else if(data == "failed")
              {
                $('.alert').html('<b>Kombinasi Password & Username Salah</b> ').fadeIn("fast").fadeOut(3000);
              }

            }
          });

          e.preventDefault();
        });
      });
    </script>
</body>
>>>>>>> b24eb2ba311c04edfc71a948f96bb994e168e5d8
</html>
