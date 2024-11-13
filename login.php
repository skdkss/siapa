<?php
	require("config/config.default.php");
	require("config/config.function.php");
	require("config/functions.crud.php");
	(isset($_SESSION['id_siswa'])) ? $id_siswa = $_SESSION['id_siswa'] : $id_siswa = 0;
	($id_siswa<>0) ? jump("$homeurl/index.php"):null;
	$siswa = mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM siswa WHERE id_siswa='$id_siswa'"));
	if(isset($_POST['submit'])) {
		$username = $_POST['username'];
		$password = $_POST['password'];
		$siswaQ = mysqli_query($conn,"SELECT * FROM siswa WHERE username='$username'");
		if(mysqli_num_rows($siswaQ)==0) {
			$info = info('Siswa tidak terdaftar!','NO');
		} else {
			$siswa = mysqli_fetch_array($siswaQ);
			if($password<>$siswa['password']) {
				$info = info('Password salah!','NO');
			} else {
				$_SESSION['id_siswa'] = $siswa['id_siswa'];
				mysqli_query($conn, "INSERT INTO log (id_siswa,type,text,date) VALUES ('$siswa[id_siswa]','login','masuk','$tanggal $waktu')");
				jump($homeurl);
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
				<link rel='stylesheet' href='$homeurl/dist/css/customized.css'/>
			</head>
			<body class='hold-transition login-page skin-blue layout-top-nav'>
				<header class='main-header'><div class='sekolah-user'>
					<img class='img-logo' src='$homeurl/$setting[logo]' />
					
					<b>$setting[sekolah]</b>
					</div>
					<div class='panel-user'>
						<img src='$homeurl/dist/img/avatar-1.jpg'/>
						Selamat Datang <br/>
					</div>
				</header>
				<div class='login-box'>
					<div class='box box-solid'>
						<div class='box-header'>
							<h3 class='box-title'>Login Siswa</h3>
						</div><!-- /.box-header -->
						<div class='box-body'>
							<form action='' method='post'>
								<br/><br/>
								<div class='row'>
									<div class='col-md-3 text-right'><b>Username</b></div>
									<div class='col-md-9'>
										<div class='form-group has-feedback'>
											<input type='text' name='username' class='form-control' placeholder='Username' required='true' autofocus/>
											<i class='fa fa-user form-control-feedback'></i>
										</div>
									</div>
								</div>
								<div class='row'>
									<div class='col-md-3 text-right'><b>Password</b></div>
									<div class='col-md-9'>
										<div class='form-group has-feedback'>
											<input type='password' name='password' class='form-control' placeholder='Password' required='true'/>
											<i class='fa fa-unlock-alt form-control-feedback'></i>
										</div>
									</div>
								</div>
								<div class='row'>
									<div class='col-xs-7'>
										$info
									</div><!-- /.col -->
									<div class='col-xs-5'>
										<button type='submit' name='submit' class='btn btn-success btn-block btn-flat'>LOGIN</button>
									</div><!-- /.col -->
								</div>
								<br/><br/>
							</form>
						</div>
					</div><!-- /.login-box-body -->
				</div><!-- /.login-box -->

				<script src='$homeurl/plugins/jQuery/jQuery-2.1.4.min.js'></script>
				<script src='$homeurl/dist/js/bootstrap.min.js'></script>
			</body>
		</html>
	";
?>
