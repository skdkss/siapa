<?php
	require("../config/config.default.php");
	require("../config/config.function.php");
	(isset($_SESSION['id_guru'])) ? $id_guru = $_SESSION['id_guru'] : $id_guru = 0;
	($id_guru<>0) ? header('location:login.php'):null;
	if(isset($_POST['submit'])) {
		$username = $_POST['username'];
		$password = $_POST['password'];
		$query = mysqli_query($conn, "SELECT * FROM guru WHERE username='$username'");
		$cek = mysqli_num_rows($query);
		if($cek==0) {
			$info = info("Pengguna tidak terdaftar!","NO");
		} else {
			$user = mysqli_fetch_array($query);
			if(!password_verify($password,$user['password'])) {
				$info = info("Password salah!","NO");
			} else {
				$_SESSION['id_guru'] = $user['id_guru'];
				mysqli_query($conn, "INSERT INTO log1 (id_guru,type,text,date) VALUES ('$user[id_guru]','login','masuk','$tanggal $waktu')");
				header('location:index.php');
			}
		}
	}
	echo "
		<!DOCTYPE html>
		<html>
			<head>
				<meta charset='utf-8'/>
				<meta http-equiv='X-UA-Compatible' content='IE=edge'/>
				<title>Login | $setting[aplikasi]</title>
				<meta name='viewport' content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no'/>
				<link rel='stylesheet' href='$homeurl/dist/css/bootstrap.min.css'/>
				<link rel='stylesheet' href='$homeurl/plugins/font-awesome-4.4.0/css/font-awesome.min.css'/>
				<link rel='stylesheet' href='$homeurl/dist/css/AdminLTE.min.css'/>
				<link rel='stylesheet' href='$homeurl/dist/css/skins/skin-blue.min.css'/>
				<!--[if lt IE 9]>
				<script src='//oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js'></script>
				<script src='//oss.maxcdn.com/respond/1.4.2/respond.min.js'></script>
				<![endif]-->
			</head>
			<body class='hold-transition login-page'>
				<div class='login-box'>
					<div class='login-logo'>
						<a href='$homeurl'><b>Guru</b></a>
					</div><!-- /.login-logo -->
					<div class='login-box-body'>
						<form action='' method='post'>
							<div class='form-group has-feedback'>
								<input type='text' name='username' class='form-control' placeholder='Username' required='true' autofocus/>
								<i class='fa fa-user form-control-feedback'></i>
							</div>
							<div class='form-group has-feedback'>
								<input type='password' name='password' class='form-control' placeholder='Password' required='true'/>
								<i class='fa fa-unlock-alt form-control-feedback'></i>
							</div>
							<div class='row'>
								<div class='col-xs-7'>
									$info
								</div><!-- /.col -->
								<div class='col-xs-5'>
									<button type='submit' name='submit' class='btn btn-primary btn-block btn-flat'><i class='fa fa-sign-in margin-r-5'></i> Masuk</button>
								</div><!-- /.col -->
							</div>
						</form>

					</div><!-- /.login-box-body -->
				</div><!-- /.login-box -->

				<script src='$homeurl/plugins/jQuery/jQuery-2.1.4.min.js'></script>
				<script src='$homeurl/dist/js/bootstrap.min.js'></script>
			</body>
		</html>
	";
?>
