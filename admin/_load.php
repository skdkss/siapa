<?php
	require("../config/config.default.php");
	require("../config/config.function.php");
	require("../config/functions.crud.php");
	$id_siswa = (isset($_SESSION['id_siswa'])) ? $_SESSION['id_siswa'] : 0;

	if(isset($_GET['pg'])) {
		$pg = $_GET['pg'];
		if($pg == 'waktu') {
			echo $waktu;
		}
		elseif($pg == 'log') {
			$logC = 0;
			echo "<div class='direct-chat-messages'>";
			
			$logQ = mysqli_query($conn, "SELECT * FROM log ORDER BY date DESC");
			while($log = mysqli_fetch_array($logQ)) {
				$logC++;
				
				// Check if $log has a valid 'id_siswa'
				if (isset($log['id_siswa'])) {
					$siswaQuery = mysqli_query($conn, "SELECT * FROM siswa WHERE id_siswa='$log[id_siswa]'");
					$siswa = mysqli_fetch_array($siswaQuery);

					// If $siswa is valid
					if ($siswa) {
						$fileO = "../foto/siswa_".$siswa['username'].".jpg";
						$file1 = "../foto/avatar.jpg";
						$file2 = (file_exists($fileO)) ? $fileO : $file1;
						
						// Check the type of log (login, logout, etc.)
						if ($log['type'] == 'login' || $log['type'] == 'logout') {
							$icon = ($log['type'] == 'login') ? 'fa-sign-in' : 'fa-sign-out';
							$color = ($log['type'] == 'login') ? 'text-green' : 'text-red';
							
							echo "
								<div class='direct-chat-msg'>
									<div class='direct-chat-info clearfix'>
										<span class='direct-chat-name pull-left'>".htmlspecialchars($siswa['nama'])."</span>
										<span class='direct-chat-timestamp pull-right'>".timeAgo($log['date'])."</span>
									</div><!-- /.direct-chat-info -->
									<img class='direct-chat-img' src='".htmlspecialchars($file2)."' alt='message user image'><!-- /.direct-chat-img -->
									<div class='direct-chat-text'>
										<span class='".htmlspecialchars($color)."'><i class='fa ".htmlspecialchars($icon)."'></i> ".ucfirst(htmlspecialchars($log['text']))."</span>
									</div><!-- /.direct-chat-text -->
								</div><!-- /.direct-chat-msg -->
							";
						} else {
							$icon = ($log['type'] == 'testongoing') ? 'fa-pencil-square-o' : 'fa-check-square-o';
							
							echo "
								<div class='direct-chat-msg right'>
									<div class='direct-chat-info clearfix'>
										<span class='direct-chat-name pull-right'>".htmlspecialchars($siswa['nama'])."</span>
										<span class='direct-chat-timestamp pull-left'>".timeAgo($log['date'])."</span>
									</div><!-- /.direct-chat-info -->
									<img class='direct-chat-img' src='".htmlspecialchars($file2)."' alt='message user image'><!-- /.direct-chat-img -->
									<div class='direct-chat-text'>
										<span><i class='fa ".htmlspecialchars($icon)."'></i> ".ucfirst(htmlspecialchars($log['text']))."...</span>
									</div><!-- /.direct-chat-text -->
								</div><!-- /.direct-chat-msg -->
							";
						}
					}
				}
			}
			
			// If no log entries exist
			if($logC == 0) { 
				echo "<p class='text-center'>Tidak ada aktifitas.</p>"; 
			}
			echo "</div>";
		}
	}
?>
