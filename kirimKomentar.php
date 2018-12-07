<?php
	require_once("koneksi.php");
	$idPost = $_POST['id_post'];
	$komentar = $_POST['comment'];
	$jenis = $_POST['jenis'];
	$user_id = 1;
	$created_at = date("Y/m/d h:i:s");
	$sql = "INSERT INTO comment VALUES('','$user_id','$idPost','$komentar','$jenis','$created_at')";
	$result = $koneksi->query($sql);
	if($result)
		echo "berhasil";
	else
		echo "gagal";
?>