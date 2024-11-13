<?php
	require("../config/config.default.php");
	session_destroy();
	header('location:'.$homeurl);
?>