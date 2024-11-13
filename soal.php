<?php
	require("config/config.default.php");
	require("config/config.function.php");
	require("config/functions.crud.php");
	$id_siswa = (isset($_SESSION['id_siswa'])) ? $_SESSION['id_siswa'] : 0;
	$siswa = fetch('siswa',array('id_siswa'=>$id_siswa));
	
	$pg = @$_POST['pg'];
	$ac = @$_POST['ac'];
	$id = @$_POST['id'];
	
	if($pg=='soal') {
		$no_soal = $_POST['no_soal'];
		$no_prev = $no_soal-1;
		$no_next = $no_soal+1;
		$id_mapel = $_POST['id_mapel'];
		$id_siswa = $_POST['id_siswa'];
		
		$where = array(
			'id_siswa' => $id_siswa,
			'id_mapel' => $id_mapel
		);
		
		$pengacak = fetch('pengacak',$where);
		$pengacak = explode(',',$pengacak['id_soal']);
		$mapel = fetch('mapel',array('id_mapel'=>$id_mapel));
		$soal = fetch('soal',array('id_mapel'=>$id_mapel,'paket'=>$siswa['paket'],'id_soal'=>$pengacak[$no_soal]));
		$jawab = fetch('jawaban',array('id_siswa'=>$id_siswa,'id_mapel'=>$id_mapel,'id_soal'=>$soal['id_soal']));
		
		update('nilai',array('ujian_berlangsung'=>$datetime),$where);
		echo "
			<div class='box-body'>
				<p>$soal[soal]</p><br/>
				<div class='row'>
					<div class='col-md-7'>";
					$jawab = isset($jawab) ? $jawab : []; 
					$a = (isset($jawab['jawaban']) && $jawab['jawaban'] == 'A') ? 'checked' : '';
					$b = (isset($jawab['jawaban']) && $jawab['jawaban'] == 'B') ? 'checked' : '';
					$c = (isset($jawab['jawaban']) && $jawab['jawaban'] == 'C') ? 'checked' : '';
					$d = (isset($jawab['jawaban']) && $jawab['jawaban'] == 'D') ? 'checked' : '';
					$e = (isset($jawab['jawaban']) && $jawab['jawaban'] == 'E') ? 'checked' : '';
					$ragu = (isset($jawab['ragu']) && $jawab['ragu'] == 1) ? 'checked' : '';
						echo "
						<div class='row'>
							<div class='col-md-2 text-right'>
								<input type='radio' name='jawab' class='flat-check' onclick=jawabsoal($id_mapel,$id_siswa,$soal[id_soal],'A') $a/> &nbsp; <b>A.</b>
							</div>
							<div class='col-md-10'>
								<p>$soal[pilA]</p>
							</div>
						</div>
						<div class='row'>
							<div class='col-md-2 text-right'>
								<input type='radio' name='jawab' class='flat-check' onclick=jawabsoal($id_mapel,$id_siswa,$soal[id_soal],'B') $b/> &nbsp; <b>B.</b>
							</div>
							<div class='col-md-10'>
								<p>$soal[pilB]</p>
							</div>
						</div>
						<div class='row'>
							<div class='col-md-2 text-right'>
								<input type='radio' name='jawab' class='flat-check' onclick=jawabsoal($id_mapel,$id_siswa,$soal[id_soal],'C') $c/> &nbsp; <b>C.</b>
							</div>
							<div class='col-md-10'>
								<p>$soal[pilC]</p>
							</div>
						</div>
						<div class='row'>
							<div class='col-md-2 text-right'>
								<input type='radio' name='jawab' class='flat-check' onclick=jawabsoal($id_mapel,$id_siswa,$soal[id_soal],'D') $d/> &nbsp; <b>D.</b>
							</div>
							<div class='col-md-10'>
								<p>$soal[pilD]</p>
							</div>
						</div>
						<div class='row'>
							<div class='col-md-2 text-right'>
								<input type='radio' name='jawab' class='flat-check' onclick=jawabsoal($id_mapel,$id_siswa,$soal[id_soal],'E') $e/> &nbsp; <b>E.</b>
							</div>
							<div class='col-md-10'>
								<p>$soal[pilE]</p>
							</div>
						</div>
					</div>
					<div class='col-md-5'>";
						if($soal['file']<>'') {
							$audio = array('mp3','wav','ogg','MP3','WAV','OGG');
							$image = array('jpg','jpeg','png','gif','bmp','JPG','JPEG','PNG','GIF','BMP');
							$ext = explode(".",$soal['file']);
							$ext = end($ext);
							if(in_array($ext,$image)) {
								echo "<img src='$homeurl/$soal[file]' class='img-responsive'/>";
							}
							elseif(in_array($ext,$audio)) {
								echo "<audio controls='controls' autoplay='autoplay'><source src='$homeurl/$soal[file]' type='audio/$ext' style='width:100%;'/>Your browser does not support the audio tag.</audio>";
							} else {
								echo "File tidak didukung!";
							}
						}
						if($soal['file1']<>'') {
							$audio = array('mp3','wav','ogg','MP3','WAV','OGG');
							$image = array('jpg','jpeg','png','gif','bmp','JPG','JPEG','PNG','GIF','BMP');
							$ext = explode(".",$soal['file1']);
							$ext = end($ext);
							if(in_array($ext,$image)) {
								echo "<img src='$homeurl/$soal[file1]' class='img-responsive'/>";
							}
							elseif(in_array($ext,$audio)) {
								echo "<audio controls='controls' autoplay='autoplay'><source src='$homeurl/$soal[file1]' type='audio/$ext' style='width:100%;'/>Your browser does not support the audio tag.</audio>";
							} else {
								echo "File tidak didukung!";
							}
						}
						echo "
					</div>
				</div>
			</div>
			<div class='box-footer'>
				<div class='row'>
					<div class='col-md-4 text-left'>
						<button id='move-prev' class='btn btn-flat btn-default' onclick=loadsoal($id_mapel,$id_siswa,$no_prev)><i class='fa fa-chevron-left'></i> SOAL SEBELUMNYA</button>
						<i class='fa fa-spin fa-spinner' id='spin-prev' style='display:none;'></i>
					</div>
					<div class='col-md-4 text-center'>
						<div id='load-ragu'>
							<a href='#' class='btn btn-flat btn-warning'><input type='checkbox' onclick=radaragu($id_mapel,$id_siswa,$soal[id_soal]) $ragu/> RAGU-RAGU</a>
						</div>
					</div>
					<div class='col-md-4 text-right'>
						<i class='fa fa-spin fa-spinner' id='spin-next' style='display:none;'></i>
						<button id='move-next' class='btn btn-flat btn-primary' onclick=loadsoal($id_mapel,$id_siswa,$no_next)>SOAL SELANJUTNYA <i class='fa fa-chevron-right'></i></button>
					</div>
				</div>
			</div>
		";
	}
	elseif($pg=='jawab') {
		$data = array(
			'id_mapel' => $_POST['id_mapel'],
			'id_siswa' => $_POST['id_siswa'],
			'id_soal' => $_POST['id_soal'],
			'jawaban' => $_POST['jawaban']
		);
		$where = array(
			'id_mapel' => $_POST['id_mapel'],
			'id_siswa' => $_POST['id_siswa'],
			'id_soal' => $_POST['id_soal']
		);
		$cekjawaban = rowcount('jawaban',$where);
		if($cekjawaban==0) {
			$exec = insert('jawaban',$data);
		} else {
			$exec = update('jawaban',$data,$where);
		}
		echo $exec;
	}
	elseif($pg=='ragu') {
		$where = array(
			'id_mapel' => $_POST['id_mapel'],
			'id_siswa' => $_POST['id_siswa'],
			'id_soal' => $_POST['id_soal']
		);
		$cekragu = fetch('jawaban',$where);
		if($cekragu['ragu']==0) {
			$exec = update('jawaban',array('ragu'=>1),$where);
		} else {
			$exec = update('jawaban',array('ragu'=>0),$where);
		}
		echo $exec;
	}
?>