<?php
	require("../config/config.default.php");
	require("../config/config.function.php");
	require("../config/functions.crud.php");
	(isset($_SESSION['id_pengawas'])) ? $id_pengawas = $_SESSION['id_pengawas'] : $id_pengawas = 0;
	($id_pengawas==0) ? header('location:login.php'):null;
	$id_mapel = $_GET['m'];
	$id_kelas = $_GET['k'];
	$pengawas = fetch('pengawas',array('id_pengawas'=>$id_pengawas));
	$mapel = fetch('mapel',array('id_mapel'=>$id_mapel));
	$kelas = fetch('kelas',array('id_kelas'=>$id_kelas));
	if(date('m')>=7 AND date('m')<=12) {
		$ajaran = date('Y')."/".(date('Y')+1);
	}
	elseif(date('m')>=1 AND date('m')<=6) {
		$ajaran = (date('Y')-1)."/".date('Y');
	}
	echo "
		<!DOCTYPE html>
		<html>
			<head>
				<title>LAPORAN</title>
				<style>
					* { margin:auto; padding:0; line-height:100%; }
					body { max-width:793.700787402px; }
					td { padding:1px 3px 1px 3px; }
					.garis { border:1px solid #000; border-left:0px; border-right:0px; padding:1px; margin-top:5px; margin-bottom:5px; }
				</style>
			</head>
			<body>
				<table border='0' width='793.700787402px' align='center' cellspacing='0' cellpadding='0'>
					<tr>
						<td align='left'><img src='../dist/img/1447673357.png' width='90px'/></td>
						<td align='center' valign='top'>
							<b>$setting[header]</b><br/>
							<small>$setting[alamat]</small><br/>
							<small>Tlp. $setting[telp] &nbsp; Fax. $setting[fax]</small><br/>
							<small><i>Email: $setting[email] &nbsp; Web: $setting[web]</i></small><br/>
						</td>
						<td align='right'><img src='../dist/img/1447673365.png' width='90px'/></td>
					</tr>
				</table>
				<div class='garis'></div>
				<br/>
				<div align='center'>
					<b>NILAI UJIAN BERBASIS KOMPUTER</b><br/>
					<b>MATA PELAJARAN ".strtoupper($mapel['nama'])."</b><br/>
					<b>TAHUN AJARAN $ajaran</b><br/>
				</div>
				Kelas : $kelas[nama]
				<table border='1' width='793.700787402px' align='center' cellspacing='0' cellpadding='0'>
					<thead>
						<tr>
							<th width='5px'>No</th>
							<th>NIS</th>
							<th>No. Peserta</th>
							<th>Nama</th>
							<th>Paket Soal</th>
							<th>Jawaban</th>
							<th>Nilai</th>
						</tr>
					</thead>
					<tbody>";
					$siswaQ = select('siswa',array('id_kelas'=>$id_kelas));
					foreach($siswaQ as $siswa) {
						$no++;
						$ket = '';
						$lama = $jawaban = $skor = '--';
						$kelas = fetch('kelas',array('id_kelas'=>$siswa['id_kelas']));
						$nilaiQ = mysqli_query($conn, "SELECT * FROM nilai WHERE id_mapel='$id_mapel' AND id_siswa='$siswa[id_siswa]'");
						$nilaiC = mysqli_num_rows($nilaiQ);
						$nilai = mysqli_fetch_array($nilaiQ);
						if($nilaiC<>0) {
							if($nilai['ujian_mulai']<>'' AND $nilai['ujian_selesai']<>'') {
								$jawaban = "$nilai[jml_benar] benar / $nilai[jml_salah] salah";
								$skor = number_format($nilai['skor'],2,'.','');
							}
						}
						echo "
							<tr>
								<td align='center'>$no</td>
								<td align='center' width='100px'>$siswa[nis]</td>
								<td align='center' width='100px'>$siswa[username]</td>
								<td>$siswa[nama]</td>
								<td align='center'>$siswa[paket]</td>
								<td width='130px'>$jawaban</td>
								<td align='center'>$skor</td>
							</tr>
						";
					}
					echo "
					</tbody>
				</table>
				<br/>
				<table border='0' width='793.700787402px' align='center' cellspacing='0' cellpadding='0'>
					<tr>
						<td>
							Mengetahui, <br/>
							Kepala Sekolah <br/>
							<br/>
							<br/>
							<br/>
							<br/>
							<br/>
							<u>$setting[kepsek]</u><br/>
							$setting[nip]
						</td>
						<td width='230px'>
							".buat_tanggal('d M Y')."<br/>
							$pengawas[jabatan]<br/>
							<br/>
							<br/>
							<br/>
							<br/>
							<br/>
							<u>$pengawas[nama]</u><br/>
							$pengawas[nip]
						</td>
					</tr>
				</table>
			</body>
		</html>
	";
?>