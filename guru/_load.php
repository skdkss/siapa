<?php
	require("../config/config.default.php");
	require("../config/config.function.php");
	require("../config/functions.crud.php");
	$id_siswa = (isset($_SESSION['id_siswa'])) ? $_SESSION['id_siswa'] : 0;
	if(isset($_GET['pg'])) {
		$pg = $_GET['pg'];
		if($pg=='waktu') {
			echo $waktu;
		}
		elseif($pg=='log') {
            $logC = 0;
			echo "<div class='direct-chat-messages'>";
			$logQ = mysqli_query($conn, "SELECT * FROM log ORDER BY date DESC");
			while($log = mysqli_fetch_array($logQ)) {
                $logC++;
				$siswa = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM siswa WHERE id_siswa='$log[id_siswa]'"));
				$fileO = "../foto/siswa_".$siswa['username'].".jpg";
				$file1 = "../foto/avatar.jpg";
				if (file_exists($fileO)) {
																	$file2=$fileO;
																} else {
																	$file2=$file1;
																}
				if($log['type']=='login' || $log['type']=='logout') {
					($log['type']=='login') ? $icon = 'fa-sign-in' : $icon = 'fa-sign-out';
					($log['type']=='login') ? $color = 'text-green' : $color = 'text-red';
					echo "
						<div class='direct-chat-msg'>
							<div class='direct-chat-info clearfix'>
								<span class='direct-chat-name pull-left'>$siswa[nama]</span>
								<span class='direct-chat-timestamp pull-right'>".timeAgo($log['date'])."</span>
							</div><!-- /.direct-chat-info -->
							<img class='direct-chat-img' src='$file2' alt='message user image'><!-- /.direct-chat-img -->
							<div class='direct-chat-text'>
								<span class='$color'><i class='fa $icon'></i> ".ucfirst($log['text'])."</span>
							</div><!-- /.direct-chat-text -->
						</div><!-- /.direct-chat-msg -->
					";
				} else {
					($log['type']=='testongoing') ? $icon = 'fa-pencil-square-o' : $icon = 'fa-check-square-o';
					echo "
						<div class='direct-chat-msg right'>
							<div class='direct-chat-info clearfix'>
								<span class='direct-chat-name pull-right'>$siswa[nama]</span>
								<span class='direct-chat-timestamp pull-left'>".timeAgo($log['date'])."</span>
							</div><!-- /.direct-chat-info -->
							<img class='direct-chat-img' src='$file2' alt='message user image'><!-- /.direct-chat-img -->
							<div class='direct-chat-text'>
								<span><i class='fa $icon'></i> ".ucfirst($log['text'])."...</span>
							</div><!-- /.direct-chat-text -->
						</div><!-- /.direct-chat-msg -->
					";
				}
			}
            if($logC==0) { echo "<p class='text-center'>Tidak ada aktifitas.</p>"; }
			echo "</div>";
		}
	}
?>