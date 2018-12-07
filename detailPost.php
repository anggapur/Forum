<?php
	//include koneksi
	require_once("koneksi.php");
	require_once("function.php");

	//paging
	$sql = "SELECT * FROM post 
			LEFT JOIN USER ON post.user_id = user.id_user
			WHERE post.id_post='".$_GET['id_post']."'";
	$resultPerPage = $koneksi->query($sql);
	

?>
<!DOCTYPE html>
<html>
	<head>
		<title></title>
		<link rel="stylesheet" type="text/css" href="indexStyle.css">
		<script type="text/javascript" src="jquery.js"></script>
	</head>
	<body>	
		<?php
		while($data = mysqli_fetch_assoc($resultPerPage))
			{

			echo '
				<div class="box" data-id-post="'.$data['id_post'].'">
					<a href="detailPost?id_post='.$data['id_post'].'">
					<div class="boxPost">
						<div class="headerPost">
							<div class="identitasPost">
								<div class="wrap-avatar">
									<img src="'.isFileExist("asset/".$data['foto_profil']).'">
								</div>
								<h3>'.$data['username'].'</h3>
							</div>
							<div class="infoPost">
								<div class="datetime">'.simpledate($data['created_at']).'</div>
								<div class="infoComment"><span class="jumlahKomentar">'.countKomentar($data['id_post']).'</span> Komentar</div>
							</div>
						</div>
						<div class="bodyPost">
							<h2>'.$data['judul'].'</h2>
							<p>'.$data['deskripsi'].'</p>
						</div>						
					</div>
					</a>
					<div class="boxComment">
						<div class="giveCommented" data-post="'.$data['id_post'].'">
							'.getAllComment($data['id_post'],"").'
						</div>						
					</div>
					<div class="giveCommentDetail">
						<form class="formKomentarUp"  onsubmit="kirimKomentar(`'.$data['id_post'].'`,`post`,`'.$data['id_post'].'`); return false;" data-jenis="post" data-id-post="'.$data['id_post'].'" data-post="'.$data['id_post'].'">
							<textarea name="komentar" placeholder="Ketikkan Komentar Disini.." required="required"></textarea>									
							<button type="submit">Kirim</button>
						</form>
					</div>
					<div class="clear"></div>
					
				</div>

				';
			}
		?>	
		
		
	</body>
	<script type="text/javascript" src="scriptKomentar.js">
	</script>
</html>