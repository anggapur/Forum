<?php
  session_start();
  $koneksi  = mysqli_connect("localhost","root","","db_forum");
  if (!$koneksi) {
    echo "Gagal Koneksi ".mysqli_connect_error();
  }
  $user_id = $_SESSION['id_user'];
  $id = $_GET['id'];

  if (isset($_POST['update'])) {
		echo "<script>alert('You updated the post!')</script>";
		$judul = $_POST['judulPost'];
	    $deskripsi = $_POST['descPost'];
	    $sql= "UPDATE post SET judul='$judul', deskripsi='$deskripsi' WHERE id_post=$id";
	    mysqli_query($koneksi,$sql);
	    header('location: allPost.php');
	}
	$query = "SELECT * FROM post WHERE id_post = '$id'";
	$result = mysqli_query($koneksi, $query);
	while ($row = mysqli_fetch_assoc($result)) {
		# code...
		$judul = $row['judul'];
    	$deskripsi = $row['deskripsi'];
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
      <h3>Update Post</h3>
      <form method="post">
        <div class="form-group">
          <label>Judul Post:</label>
          <input type="text" required="" class="form-control" name="judulPost" value="<?php echo $judul; ?>"/>
        </div>
        <div class="form-group">
          <label>Deksripsi Post</label>
          <textarea required="" class="form-control" name="descPost" rows="3"><?php echo $deskripsi; ?></textarea>
        </div>
        <button type="submit" name="update" class="btn btn-primary" value="input">Update</button>
      </form>
    </div>

  </body>
</html>