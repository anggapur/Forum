<?php

include('koneksi.php');

session_start();

//membuat user tetap masuk sebelum di logout
if(!isset($_SESSION['id_user']))
{
 header('location:login.php');
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
   
   <div class="table-responsive">
    <h4 align="center">Online User</h4>
    <p align="right">Hi - <?php echo $_SESSION['username']; ?> - <a href="logout.php">Logout</a></p>
    
   </div>
  </div>
    </body>  
</html>  