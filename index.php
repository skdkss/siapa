<?php
	require("config/config.default.php");
	require("config/config.function.php");
	require("config/functions.crud.php");
	(isset($_SESSION['id_siswa'])) ? $id_siswa = $_SESSION['id_siswa'] : $id_siswa = 0;
	($id_siswa==0) ? jump("$homeurl/home.php"):null;
	$siswa = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM siswa WHERE id_siswa='$id_siswa'"));
	echo "
		<!DOCTYPE html>
		<html>
			<head>
				<meta charset='utf-8'/>
				<meta http-equiv='X-UA-Compatible' content='IE=edge'/>
				<title>$setting[aplikasi]</title>
				<meta name='viewport' content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no'/>
				<link rel='shortcut icon' href='$homeurl/favicon.ico'/>
				<link rel='stylesheet' href='$homeurl/dist/css/bootstrap.min.css'/>
				<link rel='stylesheet' href='$homeurl/plugins/font-awesome-4.4.0/css/font-awesome.min.css'/>
				<link rel='stylesheet' href='$homeurl/dist/css/AdminLTE.min.css'/>
				<link rel='stylesheet' href='$homeurl/plugins/iCheck/all.css'/>
				<link rel='stylesheet' href='$homeurl/dist/css/skins/skin-blue.min.css'/>
				<link rel='stylesheet' href='$homeurl/dist/css/customized.css'/>
			</head>
			<body class='hold-transition skin-blue layout-top-nav fixed'>
				<span id='livetime'></span>
				<div class='wrapper'>
					<header class='main-header'><div class='sekolah-user'>
						<img class='img-logo' src='$homeurl/$setting[logo]' />
					
					<b>$setting[sekolah]</b>
					</div>
						<div class='panel-user'>
							<img src='$homeurl/foto/siswa_$siswa[username].jpg'/>
							Selamat Datang <br/>
							$siswa[nama] <br/>
							<a href='$homeurl/logout.php'>Keluar <i class='fa fa-play'></i></a>
						</div>
					</header>
					<div class='content-wrapper'>
						<div class='container'>
							<section class='content'>";
								if($pg=='') {
									$mapelQ = mysqli_query($conn, "SELECT * FROM mapel WHERE tgl_ujian<='$datetime' ORDER BY tgl_ujian DESC LIMIT 1");
									$mapelC = mysqli_num_rows($mapelQ);
									if($mapelC<>0) {
										$mapel = mysqli_fetch_array($mapelQ);
										$tgltest = explode(' ',$mapel['tgl_ujian']);
										$pelajaran = explode(' ',$mapel['nama']);
										$kelas = fetch('kelas',array('id_kelas'=>$siswa['id_kelas']));
										$jurusan = explode(' ',$kelas['nama']);
										
										if($pelajaran[0]=='Produktif') {
											$mapel = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM mapel WHERE tgl_ujian<='$datetime' AND nama LIKE '%$jurusan[1]%' ORDER BY tgl_ujian DESC LIMIT 1"));
										}
										
							     		$where = array('id_mapel'=>$mapel['id_mapel'],'id_siswa'=>$id_siswa);
										$nilai = fetch('nilai',$where);
										$ceknilai = rowcount('nilai',$where);
										if($ceknilai==0) {
											$status = 'Tersedia';
											$btntest = "
												<div class='alert alert-warning'>
													<i class='icon fa fa-warning'></i> Tombol MULAI hanya akan aktif apabila waktu sekarang sudah melewati waktu mulai tes. Tekan tombol F5 untuk merefresh halaman.
												</div>
												<a href='$homeurl/rules/$mapel[id_mapel]/$id_siswa' class='btn btn-block btn-primary'><i class='fa fa-pencil'></i> MULAI</a>
											";
										} else {
											if($nilai['ujian_mulai']<>'' AND $nilai['ujian_berlangsung']<>'' AND $nilai['ujian_selesai']=='') {
												$status = 'Berlangsung';
												$btntest = "
													<div class='alert alert-warning'>
														<i class='icon fa fa-warning'></i> Ujian belum selesai. Silahkan LANJUTKAN dengan mengklik tombol dibawah ini.
													</div>
													<a href='$homeurl/testongoing/$mapel[id_mapel]/$id_siswa/?n=0' class='btn btn-block btn-success'><i class='fa fa-pencil'></i> LANJUTKAN</a>
												";
											} else {
												if($nilai['ujian_mulai']<>'' AND $nilai['ujian_berlangsung']<>'' AND $nilai['ujian_selesai']<>'') {
													$status = 'Selesai';
													$btntest = '';
												}
											}
										}
										echo "
											<div class='row'>
												<div class='col-md-9'>
													<div class='box box-solid'>
														<div class='box-header'>
															<h3 class='box-title'>Konfirmasi Tes</h3>
														</div><!-- /.box-header -->
														<div class='box-body'>
															<div class='table-responsive'>
																<table class='table no-margin'>
																	<tbody>
																		<tr>
																			<td>
																				<b>Nama Tes</b><br/>
																				$mapel[nama]
																			</td>
																		</tr>
																		<tr>
																			<td>
																				<b>Status Tes</b><br/>
																				<span class='text-red'>$status</span>
																			</td>
																		</tr>
																		<tr>
																			<td>
																				<b>Jumlah Soal</b><br/>
																				$mapel[jml_soal] soal
																			</td>
																		</tr>
																		<tr>
																			<td>
																				<b>Tanggal Tes</b><br/>
																				". buat_tanggal('D, d M Y',$tgltest[0]) ."
																			</td>
																		</tr>
																		<tr>
																			<td>
																				<b>Waktu Tes</b><br/>
																				$tgltest[1]
																			</td>
																		</tr>
																		<tr>
																			<td>
																				<b>Alokasi Waktu Tes</b><br/>
																				$mapel[lama_ujian] menit
																			</td>
																		</tr>
																	</tbody>
																</table>
															</div>
														</div>
													</div>
												</div>
												<div class='col-md-3'>";
													echo "$btntest
												</div>
											</div>
										";
									} else {
										echo "
											<div class='row'>
												<div class='col-md-8'>
													<div class='box box-solid'>
														<div class='box-header'>
															<h3 class='box-title'>Konfirmasi Tes</h3>
														</div><!-- /.box-header -->
														<div class='box-body'>
															<p class='text-red text-center'><i class='fa fa-warning'></i> Tidak ada tes untuk hari ini!</p>
														</div>
													</div>
												</div>
											</div>
										";
									}
								}
								elseif($pg=='rules') {
									$order = array(
										"nomor ASC",
										"nomor DESC",
										"soal ASC",
										"soal DESC",
										"pilA ASC",
										"pilA DESC",
										"pilB ASC",
										"pilB DESC",
										"pilC ASC",
										"pilC DESC",
										"pilD ASC",
										"pilD DESC",
										"pilE ASC",
										"pilE DESC",
										"jawaban ASC",
										"jawaban DESC",
										"file ASC",
										"file DESC"
									);
									$where = array(
										'id_mapel' => $ac,
										'paket' => $siswa['paket']
									);
									$mapel = fetch('mapel',array('id_mapel'=>$ac));
									$r = ($mapel['acak']==1) ? rand(0,17) : 0;
									$soal = select('soal',$where,$order[$r]);
									$id_soal = '';
									foreach($soal as $s) { $id_soal .= $s['id_soal'].','; }
									$acakdata = array(
										'id_siswa' => $id_siswa,
										'id_mapel' => $ac,
										'id_soal' => $id_soal
									);
									$logdata = array(
										'id_siswa' => $id_siswa,
										'type' => 'testongoing',
										'text' => 'sedang ujian',
										'date' => $datetime
									);
									$nilaidata = array(
										'id_mapel' => $ac,
										'id_siswa' => $id_siswa,
										'ujian_mulai' => $datetime
									);
									$pelajaran = explode(' ',$mapel['nama']);
									if(isset($pelajaran[1])) {
										if($pelajaran[1]=='Inggris') {
											$ref = "ref";
										} else {
											$ref = "";
										}
									} else {
										$ref = "";
									}
									insert('pengacak',$acakdata);
									insert('log',$logdata);
									insert('nilai',$nilaidata);
									jump("$homeurl/testongoing/$ac/$id_siswa/?$ref");
								}
								elseif($pg=='testongoing') {
									$no_soal = 0;
									$no_prev = $no_soal-1;
									$no_next = $no_soal+1;
									$id_mapel = $ac;
									$id_siswa = $id;
									
									$where = array(
										'id_siswa' => $id_siswa,
										'id_mapel' => $id_mapel
									);
									
									$pengacak = fetch('pengacak',$where);
									$pengacak = explode(',',$pengacak['id_soal']);
									$mapel = fetch('mapel',array('id_mapel'=>$id_mapel));
									$soal = fetch('soal',array('id_mapel'=>$id_mapel,'paket'=>$siswa['paket'],'id_soal'=>$pengacak[$no_soal]));
									$jawab = fetch('jawaban',array('id_siswa'=>$id_siswa,'id_mapel'=>$id_mapel,'id_soal'=>$soal['id_soal']));
									
									if(isset($_POST['done'])) {
										$_SESSION['id_siswa'] = $id_siswa;
										$benar = $salah = 0;
										$ceksoal = select('soal',array('id_mapel'=>$id_mapel,'paket'=>$siswa['paket']));
										foreach($ceksoal as $getsoal) {
											$jika = array(
												'id_siswa' => $id_siswa,
												'id_mapel' => $id_mapel,
												'id_soal' => $getsoal['id_soal']
											);
											$getjwb = fetch('jawaban',$jika);
											if($getjwb) {
												($getjwb['jawaban']==$getsoal['jawaban']) ? $benar++ : $salah++;
											} else {
												$salah++;
											}
										}
										$bagi = $mapel['jml_soal']/100;
										$skor = $benar/$bagi;
										$data = array(
											'ujian_selesai' => $datetime,
											'jml_benar' => $benar,
											'jml_salah' => $salah,
											'skor' => $skor
										);
										update('nilai',$data,$where);
										delete('pengacak',$where);
										jump("$homeurl");
									}
									
									update('nilai',array('ujian_berlangsung'=>$datetime),$where);
									$nilai = fetch('nilai',$where);
									$habis = strtotime($nilai['ujian_berlangsung'])-strtotime($nilai['ujian_mulai']);
									$detik = ($mapel['lama_ujian']*60)-$habis;
									$dtk = $detik%60;
									$mnt = floor(($detik%3600)/60);
									$jam = floor(($detik%86400)/3600);
									echo "
										<div class='row'>
											<div class='col-md-9'>
												<div class='box box-solid'>
													<div class='box-header'>
														<h3 class='box-title'>SOAL NO &nbsp; <span class='label label-primary' id='displaynum'>$no_next</span></h3>
														<div class='box-title pull-right'>
															<div class='btn-group'>
																<span class='btn btn-sm btn-flat btn-default active'>SISA WAKTU</span>
																<span class='btn btn-sm btn-flat btn-info'><b id='countdown'><span id='htmljam'>$jam</span>:<span id='htmlmnt'>$mnt</span>:<span id='htmldtk'>$dtk</span></b></span>
															</div>
														</div>
													</div><!-- /.box-header -->
													<div id='loadsoal'>
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
													</div>
												</div>
											</div>
											<div class='col-md-3'>
												<form action='' method='post'>
													<div class='box box-solid'>
														<div class='box-header'>
															<h3 class='box-title'>NOMOR SOAL</h3>
															<div class='box-title pull-right'>
																<div class='btn-group'>
                                                                    <input type='submit' name='done' id='done-submit' style='display:none;'/>
																	<button type='button' id='done-btn' class='btn btn-sm btn-flat btn-primary'>Selesai</button>
																	<!-- /.<button type='button' id='done-btn' class='btn btn-sm btn-flat btn-primary' disabled='disabled'>Selesai</button> -->
																</div>
															</div>
														</div><!-- /.box-header -->
														<div class='box-body'>
															<div class='row' id='nomorsoal'>";
																for($n=0;$n<$mapel['jml_soal'];$n++) {
																	$id_soal = $pengacak[$n];
																	$cekjwb = rowcount('jawaban',array('id_siswa'=>$id_siswa,'id_mapel'=>$id_mapel,'id_soal'=>$id_soal));
																	$ragu = fetch('jawaban',array('id_siswa'=>$id_siswa,'id_mapel'=>$id_mapel,'id_soal'=>$id_soal));
																	$color = ($cekjwb<>0) ? 'green':'gray';
																	// Initialize $ragu if not already set
																	$ragu = isset($ragu) ? $ragu : [];
																	// Initialize $color with a default value
																	$color = '';
																	// Set $color based on the value of $ragu['ragu'] if it exists
																	$color = (isset($ragu['ragu']) && $ragu['ragu'] == 1) ? 'yellow' : $color;
																	$nomor = $n+1;
																	$nomor = ($nomor<10) ? "0$nomor":$nomor;
																	echo "
																		<div class='col-xs-3 text-center'><a class='badge bg-$color' id='badge$id_soal' onclick=loadsoal($id_mapel,$id_siswa,$n)> $nomor </a></div>
																	";
																}
																echo "
															</div>
														</div>
													</div>
												</form>
											</div>
										</div>
									";
								}
								else {
									jump($homeurl);
								}
								echo "
							</section><!-- /.content -->
						</div><!-- /.container -->
					</div><!-- /.content-wrapper -->
					<!--footer class='main-footer'>
						<div class='container'>
							<div class='pull-right hidden-xs'>
								<strong>
									<span id='end-sidebar'>
										CBT v2 &copy; PJM @ ".date('Y')."
									</span>
								</strong>
							</div>
						</div><!-- /.container -->
					</footer-->
				</div><!-- ./wrapper -->

				<script src='$homeurl/plugins/jQuery/jQuery-2.1.4.min.js'></script>
				<script src='$homeurl/dist/js/bootstrap.min.js'></script>
				<script src='$homeurl/plugins/iCheck/icheck.min.js'></script>
				<script src='$homeurl/dist/js/app.min.js'></script>
				
				<script>";
				if($pg=='testongoing') {
					echo "
						var homeurl;
						homeurl = '$homeurl';
						$(document).ready(function() {
							//iCheckform();
                            $('#done-btn').click(function(){
                                var taros = confirm('Apakah anda benar-benar telah selesai ujian?');
                                if(taros==true) {
                                    window.onbeforeunload = null;
									$('#done-submit').click();
                                } else {
									return false;
								}
                            });
                            $('body').keydown(function(event){ 
                                if(event.which) {
                                    return false;
                                }
                            });
                            $('body').mousedown(function(event){  
                                if(event.which==3) {
                                    alert('Klik kanan tidak berfungsi!');
                                }
                            });
                            
							var jam = $('#htmljam').html();
							var menit = $('#htmlmnt').html();
							var detik = $('#htmldtk').html();
							function hitung() {
								setTimeout(hitung,1000);
								$('#countdown').html(jam + ':' + menit + ':' + detik);
								if(jam==0 && menit<=10) {
									$('#done-btn').removeAttr('disabled');
								}
								detik --;
								if(detik < 0) {
									detik = 59;
									menit --;
									if(menit < 0) {
										menit = 59;
										jam --;
										if(jam < 0) {
											jam = 0;
											menit = 0;
											detik = 0;
											waktuhabis();
										}
									}
								}
							}
							hitung();
						});
						
                        function waktuhabis() {
                            window.onbeforeunload = null;
                            alert('Waktu ujian telah habis!');
                            $('#done-submit').click();
                        }
						
						function iCheckform() {
							$('input[type=checkbox].flat-check, input[type=radio].flat-check').iCheck({
								checkboxClass: 'icheckbox_flat-green',
								radioClass: 'iradio_flat-green'
							});
						}
						
						function loadsoal(idmapel,idsiswa,nosoal) {
							if(nosoal>=0 && nosoal<$mapel[jml_soal]) {
								curnum = $('#displaynum').html();
								if(nosoal==curnum) {
									$('#spin-next').show();
								}
								if(nosoal>curnum) {
									$('#spin-next').show();
								}
								if(nosoal<curnum) {
									$('#spin-prev').show();
								}
								$.ajax({
									type:'POST',
									url:homeurl+'/soal.php',
									data:{pg:'soal',id_mapel:idmapel,id_siswa:idsiswa,no_soal:nosoal},
									success:function(response) {
										num = nosoal+1;
										$('#displaynum').html(num);
										$('#loadsoal').html(response);
										$('.fa-spin').hide();
										//iCheckform();
									}
								});
							}
						}
						
						function jawabsoal(idmapel,idsiswa,idsoal,jawab) {
							$.ajax({
								type:'POST',
								url:homeurl+'/soal.php',
								data:{pg:'jawab',id_mapel:idmapel,id_siswa:idsiswa,id_soal:idsoal,jawaban:jawab},
								success:function(response) {
									if(response=='OK') {
										$('#nomorsoal #badge'+idsoal).removeClass('bg-gray');
										$('#nomorsoal #badge'+idsoal).removeClass('bg-yellow');
										$('#nomorsoal #badge'+idsoal).addClass('bg-green');
									}
								}
							});
						}
						
						function radaragu(idmapel,idsiswa,idsoal) {
							cekclass = $('#nomorsoal #badge'+idsoal).attr('class');
							if(cekclass!='badge bg-gray') {
								$.ajax({
									type:'POST',
									url:homeurl+'/soal.php',
									data:{pg:'ragu',id_mapel:idmapel,id_siswa:idsiswa,id_soal:idsoal},
									success:function(response) {
										if(response=='OK') {
											if(cekclass=='badge bg-green') {
												$('#nomorsoal #badge'+idsoal).removeClass('bg-gray');
												$('#nomorsoal #badge'+idsoal).removeClass('bg-green');
												$('#nomorsoal #badge'+idsoal).addClass('bg-yellow');
											}
											if(cekclass=='badge bg-yellow') {
												$('#nomorsoal #badge'+idsoal).removeClass('bg-gray');
												$('#nomorsoal #badge'+idsoal).removeClass('bg-yellow');
												$('#nomorsoal #badge'+idsoal).addClass('bg-green');
											}
										}
									}
								});
							} else {
								$('#load-ragu input').removeAttr('checked');
							}
						}
					";
				}
				echo "
				</script>
			</body>
		</html>
	";
?>