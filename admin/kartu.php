<?php
	require("../config/config.default.php");
	require("../config/config.function.php");
	require("../config/functions.crud.php");
	(isset($_SESSION['id_pengawas'])) ? $id_pengawas = $_SESSION['id_pengawas'] : $id_pengawas = 0;
	
	$id_kelas = @$_GET['id_kelas'];
	if(date('m')>=7 AND date('m')<=12) {
		$ajaran = date('Y')."/".(date('Y')+1);
	}
	elseif(date('m')>=1 AND date('m')<=6) {
		$ajaran = (date('Y')-1)."/".date('Y');
	}
	$kelas = mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM kelas WHERE id_kelas='$id_kelas'"));
	echo "
		<style>
			* { font-size:x-small; }
			.box { border:1px solid #000; width:100%; height:200px; }
		</style>
		<table border='0' width='100%' align='center' cellpadding='2'>
			<tr>";
				$siswaQ = mysqli_query($conn,"SELECT * FROM siswa WHERE id_kelas='$id_kelas' ORDER BY nis ASC");
				while($siswa = mysqli_fetch_array($siswaQ)) {
					$no++;
					$fileO = "../foto/siswa_".$siswa['username'].".jpg";
					$file1 = "../foto/avatar.jpg";
					echo "
						<td width='50%'>
							<div class='box'>
								<table border='0' width='100%' align='center'>
									<tr>
										<td align='left' valign='top'>
											<img src='$homeurl/$setting[logo]'/ height=35>
										</td>
										<td align='center'>
											<b>
												KARTU PESERTA UJIAN<br/>
												".strtoupper($setting['sekolah'])."<br/>
												TAHUN AJARAN $ajaran
											</b>
										</td>
										<td align='right' valign='top'>
											
										</td>
									</tr>
								</table>
								<hr/>
								<table border='0' width='100%' align='center'>
									<tr>
										<td width='100px' align='center' rowspan='6'>";
										
											
																if (file_exists($fileO)) {
																	echo "<img src='$fileO' class='img-circle' width='40' height='40'>";
																} else {
																	echo "<img src='$file1' class='img-circle' width='40' height='40'>";
																}
										 echo 
										"</td>
										<td width='60px' valign='top'>No. Peserta</td>
										<td valign='top'>: $siswa[no_peserta]</td>
									</tr>
									<tr>
										<td valign='top'>NIS</td>
										<td valign='top'>: $siswa[nis]</td>
									</tr>
									<tr>
										<td valign='top'>Nama</td>
										<td valign='top'>: $siswa[nama]</td>
									</tr>
									<tr>
										<td valign='top'>Kelas</td>
										<td valign='top'>: $kelas[nama]</td>
									</tr>
									<tr>
										<td valign='top'>Username</td>
										<td valign='top'>: $siswa[username]</td>
									</tr>
									<tr>
										<td valign='top'>Password</td>
										<td valign='top'>: $siswa[password]</td>
									</tr>
								</table>
							</div>
						</td>
					";
					if(($no%2)==0) { echo "</tr><tr>"; }
				}
				echo "
			</tr>
		</table>
	";
?>