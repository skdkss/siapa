<?php
	require("../config/config.default.php");
	(isset($_SESSION['id_guru'])) ? $id_guru = $_SESSION['id_guru'] : $id_guru = 0;
	($id_guru<>0) ? mysql_query("INSERT INTO log1 (id_guru,type,text,date) VALUES ('$id_guru','logout','keluar','$tanggal $waktu')"):null;
	session_destroy();
	header('location:'.$homeurl);
?>