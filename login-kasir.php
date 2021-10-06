<?php
	
		require 'koneksi.php';
		session_start();
		


?>


<!DOCTYPE html>
<html>
<head>
	<title>Home Kasir</title>
	<link rel="icon" type="image/png" href="img/mesincuci.png">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>


	<body class="container">
		<div class="text-center mt-5">
			<img src="img/kasir.png" width="200px" height="200px" border="4px">
			<h1 class="mt-3">Selamat Datang Kasir</h1>
			<form method="POST">
			<div class="row justify-content-center" >
					<input type="text" class="form-control mt-2" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" placeholder="Username" name="username">
					<input type="password" class="form-control mt-2" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" placeholder="Password" name="password">
					<p class="mt-3"> Login Sebagai : </p>

					<div class="col-auto">
					<button class="btn btn-success" name="admin">Admin</button>
					</div>
					
						<div class="col-auto">
						<button class="btn btn-warning">Bantuan</button>
						</div>
								<div class="col-auto">
									<button class="btn btn-primary" name="pemilik">Pemilik</button>
									</div>
			<p class= "mt-3"><i>"Kemudahan Transaksi adalah proses yang menguntungkan."</i></p>

			</div>		
		</form>
		
		<?php 
			if (isset($_POST['admin'])) {
				$username = $_POST['username'];
				$password = $_POST['password'];
				$role	= 2;
				$query	= mysqli_query($conn, "select * from user where username='$username' and password='$password' and id_role='$role' ");

				if ($query) {
				$data 	= mysqli_fetch_assoc($query);

				$session_name	= "Falgar";
				$session_value	= json_encode($data);	

				$_SESSION[$session_name]=$session_value;
				header("Location:barang.php");

				}else{
					echo "<script>alert('Maaf anda bukan lagi seorang staff');</script>";
				}

			}

		?>
		

		<?php 
			if (isset($_POST['pemilik'])) {
				$username = $_POST['username'];
				$password = $_POST['password'];
				$role	= 1;
				$query	= mysqli_query($conn, "select * from user where username='$username' and password='$password' and id_role='$role' ");

				if ($query) {
				$data 	= mysqli_fetch_assoc($query);

				$session_name	= "Falgar";
				$session_value	= json_encode($data);	

				$_SESSION[$session_name]=$session_value;
				header("Location:pemilik-cucian.php");

				}else{
					echo "<script>alert('Maaf anda bukan Pemilik');</script>";
				}

			}

		?>

		</div>	
	</body>


</html>