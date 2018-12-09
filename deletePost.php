<?php
  session_start();
  $koneksi  = mysqli_connect("localhost","root","","db_forum");
  if (!$koneksi) {
    echo "Gagal Koneksi ".mysqli_connect_error();
  }
  $id = $_GET['id'];
  $sql= "DELETE FROM post WHERE id_post=$id";
  mysqli_query($koneksi,$sql);
  echo "<script>alert('You deleted the post!')</script>";
  header('location: allPost.php');
?>