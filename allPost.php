<?php 
	session_start();
	$koneksi  = mysqli_connect("localhost","root","","db_forum");
	if (!$koneksi) {
    	echo "Gagal Koneksi ".mysqli_connect_error();
  	}

  	$query = "SELECT post.id_post,user.id_user, user.username,post.judul, post.deskripsi FROM post INNER JOIN user ON post.user_id=user.id_user";
  	$result = mysqli_query($koneksi, $query);

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<title>All Post</title>
</head>
<body>
	<table class="table table-striped">
		<thead>
			<tr>
				<th>No</th>
				<th>Username</th>
				<th>Post Title</th>
				<th>Description</th>
				<th>Actions</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<?php  
					$i = 1;
				    while($row = mysqli_fetch_assoc($result)) {
				    	echo "<tr>";
				    	echo "<td>".$i."</td>";
				        echo "<td>".$row['username']."</td>";
				        echo "<td>".$row['judul']."</td>";
				        echo "<td>".$row['deskripsi']."</td>";
				        echo "<td><a href='editPost.php?id=$row[id_post]'>Update</a> | <a href='deletePost.php?id=$row[id_post]'>Delete</a></td>";
				        $i++;
				    }
			    ?>
			</tr>
		</tbody>
	</table>
	<a href="createPost.php" class="btn btn-info">Add new Post</a>
</body>
</html>