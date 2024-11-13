<?php
	require("config/config.default.php");
	(isset($_SESSION['id_siswa'])) ? $id_siswa = $_SESSION['id_siswa'] : $id_siswa = 0;
	($id_siswa<>0) ? mysqli_query($conn, "INSERT INTO log (id_siswa,type,text,date) VALUES ('$id_siswa','logout','keluar','$tanggal $waktu')"):null;
	session_destroy();
	header('Location: '.$homeurl.'/login.php');

?>