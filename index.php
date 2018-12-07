<?php
	//include koneksi
	require_once("koneksi.php");
	require_once("function.php");
	$result = $koneksi->query("SELECT * FROM post");
	$totalData = mysqli_num_rows($result);
	$perPage = 10;
	//paging
	$nowPage = (!isset($_GET['page'])) ? 1 : $_GET['page'];
	$pass = ($nowPage-1)*$perPage;
	$sql = "SELECT * FROM post 
			LEFT JOIN USER ON post.user_id = user.id_user
			ORDER BY post.id_post DESC
			LIMIT $pass,$perPage";
	$resultPerPage = $koneksi->query($sql);
	$totalPage = ceil($totalData/$perPage);

	$limitedPage = false;
	if($totalPage > 6)
	{
		$limitedPage = true;
	}

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
					<a href="detailPost.php?id_post='.$data['id_post'].'">
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
					<hr style="margin:30px 0px">
				</div>

				';
			}
		?>	
		
		<div class="pagination">
			<ul>
				<a href="?page=1"> <li>First Page </li></a>
				<a href="?page=<?= ($nowPage-1 == 0 ) ? '1' : ($nowPage-1);?>"><li class="<?= ($nowPage-1 == 0 ) ? 'disabled' : '';?>"> Previous Page</li></a>
				<?php
					//Kalo data page nya kurang dari 4 pakai pagination yang ini
					if($totalPage <= 4)
					{
						for($i = 1; $i <= $totalPage; $i++)
						{
							echo '<a href="?page='.$i.'"><li>'.$i.'</li></a>';
						}
					}
					//Kalo data page nya lebih dari 4 pakai pagination yang ini
					else
					{
						//Kalau halaman sekarang kurang dari samadengan 3 alias lagi dihalamn 1,2,3 ini yang dipakai
						if($nowPage <= 3)
						{
							for($i = 1; $i <= 4; $i++)
							{
								$active="";
								if($nowPage == $i)
									$active=" active ";
								echo '<a href="?page='.$i.'"><li class="'.$active.'">'.$i.'</li></a>';
							}
							echo '<li class="doters">...';
							echo '<ul class="inside">';
								for($i = 5; $i <= $totalPage;$i++)
								{
									echo '<a href="?page='.$i.'"><li >'.$i.'</li></a>';
								}
								echo '</ul>';
							echo '</li>';
						}
						//Kalau halaman sekarang berada di 3 terakhir, ini yang dieksekusi
						else if($nowPage >= $totalPage-2)
						{
							echo '<li class="doters">...';
							echo '<ul class="inside">';
								for($i = 1; $i < $totalPage-3;$i++)
								{
									echo '<a href="?page='.$i.'"><li >'.$i.'</li></a>';
								}
								echo '</ul>';
							echo '</li>';
							for($i = $totalPage-3; $i <= $totalPage; $i++)
							{
								$active="";
								if($nowPage == $i)
									$active=" active ";
								echo '<a href="?page='.$i.'"><li class="'.$active.'">'.$i.'</li></a>';
							}
						}
						//Kalau kamu lagi ditengah - tengah , contoh adsa 10 halaman , kamu lagi dihalaman 5, maka ini yan dipakai, nanti dia nampilinnya kayak gini, ... 4 5 6 ...
						else
						{
							echo '<li class="doters">...';
							echo '<ul class="inside">';
								for($i = 1; $i < $nowPage-1;$i++)
								{
									echo '<a href="?page='.$i.'"><li >'.$i.'</li></a>';
								}
								echo '</ul>';
							echo '</li>';
							for($i = $nowPage-1; $i <= $nowPage+1;$i++)
							{
								$active="";
								if($nowPage == $i)
									$active=" active ";
								echo '<a href="?page='.$i.'"><li class="'.$active.'">'.$i.'</li></a>';
							}
							echo '<li class="doters">...';
							echo '<ul class="inside">';
								for($i = $nowPage+2; $i <= $totalPage;$i++)
								{
									echo '<a href="?page='.$i.'"><li >'.$i.'</li></a>';
								}
								echo '</ul>';
							echo '</li>';
						}
					}

				?>
				<a href="?page=<?= ($nowPage == $totalPage ) ? $totalPage : ($nowPage+1);?>"><li class="<?= ($nowPage == $totalPage ) ? 'disabled' : '';?>"> Next Page</li></a>
				<a href="?page=<?= $totalPage?>"> <li>Last Page </li></a>
			</ul>
		</div>
	</body>
	<script type="text/javascript" src="scriptKomentar.js">
	</script>
</html>