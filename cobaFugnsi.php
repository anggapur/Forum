<?php
require_once("koneksi.php");

	function countKomentar($idPost)
	{
		$sql = "SELECT * FROM comment WHERE jenis='post' AND post_or_comment_id='$idPost'";
		$result = $GLOBALS['koneksi']->query($sql);
		$i = 0;
		$datas = "";
		while($data = mysqli_fetch_assoc($result))
		{
			$i++;
			$datas.=$data['id_comment']." ";
			echo $i."<br>";
			$i = rekursiKomentar($data['id_comment'],$i,$datas);
		}
		echo $i." pp";
		return $datas;
	}
	function rekursiKomentar($idComment,$i,$datas)
	{
		$sql = "SELECT * FROM comment WHERE jenis='comment' AND post_or_comment_id='$idComment'";
		$result = $GLOBALS['koneksi']->query($sql);
		$count = mysqli_num_rows($result);
		if($count != 0)
		{
			while($data = mysqli_fetch_assoc($result))
			{
				$i++;
				$datas.=$data['id_comment']." ";
				echo $i." b<br>";
				$i = rekursiKomentar($data['id_comment'],$i,$datas);
			}
		}
		else
		{
			echo $i." a<br>";
			return $i;
		}

		return $i;
	}
?>