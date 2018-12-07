<?php
	require_once("koneksi.php");
	function simpleDate($datetime)
	{
		$date=date_create($datetime);
		return date_format($date,"d M Y");
	}
	function isFileExist($file)
	{
		if(file_exists($file))
			return $file;
		else 
			return "asset/default.png";
	}
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
			//echo $i."<br>";
			$i = rekursiKomentar($data['id_comment'],$i);
		}		
		return $i;
	}
	function rekursiKomentar($idComment,$i)
	{
		$sql = "SELECT * FROM comment WHERE jenis='comment' AND post_or_comment_id='$idComment'";
		$result = $GLOBALS['koneksi']->query($sql);
		$count = mysqli_num_rows($result);
		if($count != 0)
		{
			while($data = mysqli_fetch_assoc($result))
			{
				$i++;
				// $datas.=$data['id_comment']." ";
				//echo $i." b<br>";
				$i = rekursiKomentar($data['id_comment'],$i);
			}
		}
		else
		{
			//echo $i." a<br>";
			return $i;
		}

		return $i;
	}
	function getAllComment($idPost,$class)
	{
		$sql = "SELECT * FROM comment 
		LEFT JOIN user ON comment.user_id_comment = user.id_user
		WHERE jenis='post' AND post_or_comment_id='$idPost'";
		$result = $GLOBALS['koneksi']->query($sql);		
		$datas = "";
		$level = 0;
		$comment = "<ul class='daftarKomentar' data-level='".($level++)."' style='padding-left:20px'>";
		while($data = mysqli_fetch_assoc($result))
		{	
			$jmlKomentar = rekursiKomentar($data['id_comment'],0);
			$comment.= "<li>";		
			$comment.="<div class='detComment' data-state='up' data-id='".$data['id_comment']."' > 
			<div class='headerComment'>
				<div class='wrap-ava'><img src='".isFileExist('asset/'.$data['foto_profil'])."'></div>
				<span class='namaComment'>".$data['username']."</span>				
				<div class='datetimes'>".simpledate($data['created_at'])."</div>
				<div class='komentarHitung'>".$jmlKomentar." Komentar</div>
			</div>
			<p>".$data['comment']."</p>	
			<span class='giveCom' onclick='detCommentClick(".$data['id_comment'].")'>Berikan Komentar</span>";
			
			if($jmlKomentar !== 0)	
			$comment.=" <span class='seeCom' onclick='detLihatKomentar(".$data['id_comment'].")'>Lihat/Tutup Komentar</span>";		

			$comment.="</div>
			<div class='giveComments' data-id='".$data['id_comment']."'>
				<form onsubmit='kirimKomentar(`".$data['id_comment']."`,`comment`,`".$idPost."`); return false;' class='formKomentar' data-jenis='comment' data-id-post='".$data['id_comment']."' data-post='".$idPost."'>
						<textarea name='komentar' placeholder='Ketikkan Komentar Disini..' required='required'></textarea>									
						<button type='submit'>Kirim</button>
					</form>
			</div>";
			$comment = rekursiAllComment($data['id_comment'],$comment,$level,$idPost,$class);
			$comment.="</li>";
		}		
		$comment.="</ul>";
		return $comment;
	}
	function rekursiAllComment($idComment,$comment,$level,$idPost,$class)
	{
		$sql = "SELECT * FROM comment 
		LEFT JOIN user ON comment.user_id_comment = user.id_user
		WHERE jenis='comment' AND post_or_comment_id='$idComment'";
		$result = $GLOBALS['koneksi']->query($sql);
		$count = mysqli_num_rows($result);
		if($count != 0)
		{
			$comment.= "<ul class='listComment ".$class."' data-level='".($level++)."' style='padding-left:20px'>";
			while($data = mysqli_fetch_assoc($result))
			{	
				$jmlKomentar = rekursiKomentar($data['id_comment'],0);			
				$comment.= "<li>";		
				$comment.="<div class='detComment' data-state='up' data-id='".$data['id_comment']."' > 
				<div class='headerComment'>
					<div class='wrap-ava'><img src='".isFileExist('asset/'.$data['foto_profil'])."'></div>
					<span class='namaComment'>".$data['username']."</span>
					<div class='datetimes'>".simpledate($data['created_at'])."</div>
					<div class='komentarHitung'>".$jmlKomentar." Komentar</div>
				</div>
				<p>".$data['comment']."</p>	
				<span class='giveCom' onclick='detCommentClick(".$data['id_comment'].")'>Berikan Komentar</span>";
			
			if($jmlKomentar !== 0)	
			$comment.=" <span class='seeCom' onclick='detLihatKomentar(".$data['id_comment'].")'>Lihat/Tutup Komentar</span>";			

								
				$comment.="</div>
				<div class='giveComments' data-id='".$data['id_comment']."'>
					<form onsubmit='kirimKomentar(`".$data['id_comment']."`,`comment`,`".$idPost."`); return false;' class='formKomentar' data-jenis='comment' data-id-post='".$data['id_comment']."' data-post='".$idPost."'>
						<textarea name='komentar' placeholder='Ketikkan Komentar Disini..' required='required'></textarea>									
						<button type='submit'>Kirim</button>
					</form>
				</div>";
				$comment = rekursiAllComment($data['id_comment'],$comment,$level,$idPost,$class);
				$comment.="</li>";
			}
			$comment.="</ul>";
		}
		else
		{
			//echo $i." a<br>";
			return $comment;
		}

		return $comment;
	}
?>