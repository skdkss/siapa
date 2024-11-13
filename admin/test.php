<?php
	require("../config/config.default.php");
	require("../config/config.function.php");
	require("../config/functions.crud.php");
	
	$result = mysqli_query($conn,"SHOW TABLE STATUS");
	$dbsize = 0;
	while($row = mysqli_fetch_array($result)) {
		$dbsize += $row["Data_length"] + $row["Index_length"];
	}
	
	echo "The size of the database is " . size($dbsize);
?>