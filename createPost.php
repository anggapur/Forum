<?php
  session_start();
  $koneksi  = mysqli_connect("localhost","root","","db_forum");
  if (!$koneksi) {
    echo "Gagal Koneksi ".mysqli_connect_error();
  }
?>
<?php 
  $user_id = $_SESSION['id_user'];
  
  if (isset($_POST['kirim'])) {
    $judul = $_POST['judulPost'];
    $deskripsi = $_POST['descPost'];
    #echo "<script>alert('You make a new post!')</script>";
    
    $sql= "INSERT INTO post(user_id, judul, deskripsi) VALUES ('$user_id', '$judul', '$deskripsi')";
    mysqli_query($koneksi,$sql);
    echo "<script>alert('You make a new post!')</script>";
    header('location: allPost.php');
  }


?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Create Post</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  </head>
  <body>
    <div class="container">
      <h3>Create a New Post</h3>
      <form action="createPost.php" method="post">
        <div class="form-group">
          <label>Judul Post:</label>
          <input type="text" required="" class="form-control" name="judulPost" placeholder="Masukkan judul Post disini">
        </div>
        <div class="form-group">
          <label>Deksripsi Post</label>
          <textarea required="" class="form-control" name="descPost" rows="3" placeholder="Tulis deskripsi Post..."></textarea>
        </div>
        <button type="submit" name="kirim" class="btn btn-primary">Post</button>
      </form>
    </div>

  </body>
</html>
