<?php
	require("../config/config.default.php");
	require("../config/config.function.php");
	require("../config/functions.crud.php");
	require("../config/class.excelReader.php");
	(isset($_SESSION['id_pengawas'])) ? $id_pengawas = $_SESSION['id_pengawas'] : $id_pengawas = 0;
	($id_pengawas==0) ? header('location:login.php'):null;
	$pengawas = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM pengawas WHERE id_pengawas='$id_pengawas'"));
	(isset($_GET['pg'])) ? $pg = $_GET['pg'] : $pg = '';
	(isset($_GET['ac'])) ? $ac = $_GET['ac'] : $ac = '';
	($pg=='soal' && $ac=='input') ? $sidebar = 'sidebar-collapse' : $sidebar = '';
	echo "
		<!DOCTYPE html>
		<html>
			<head>
				<meta charset='utf-8'/>
				<meta http-equiv='X-UA-Compatible' content='IE=edge'/>
				<title>Administrator | $setting[aplikasi]</title>
				<meta name='viewport' content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no'/>
				<link rel='shortcut icon' href='$homeurl/favicon.ico'/>
				<link rel='stylesheet' href='$homeurl/dist/css/bootstrap.min.css'/>
				<link rel='stylesheet' href='$homeurl/plugins/font-awesome-4.4.0/css/font-awesome.min.css'/>
				<link rel='stylesheet' href='$homeurl/dist/css/AdminLTE.min.css'/>
				<link rel='stylesheet' href='$homeurl/dist/css/skins/skin-blue.min.css'/>
				<link rel='stylesheet' href='$homeurl/plugins/datatables/dataTables.bootstrap.css'/>
				<link rel='stylesheet' href='$homeurl/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css'/>
				<!--[if lt IE 9]>
				<script src='//oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js'></script>
				<script src='//oss.maxcdn.com/respond/1.4.2/respond.min.js'></script>
				<![endif]-->
				<style>
					#log-list { height:533px; overflow-y:auto; }
					#log1-list { height:533px; overflow-y:auto; }
				</style>
			</head>
			<body class='hold-transition skin-blue sidebar-mini fixed $sidebar'>
				<div class='wrapper'>
					<header class='main-header'>
						<a href='?' class='logo'>
							<span class='logo-mini'><b>C</b>BT</span>
							<span class='logo-lg'>$setting[sekolah]</span>
						</a>
						<nav class='navbar navbar-static-top' role='navigation'>
							<a href='#' class='sidebar-toggle' data-toggle='offcanvas' role='button'>
								<span class='sr-only'>Toggle navigation</span>
							</a>
							<div class='navbar-custom-menu'>
								<ul class='nav navbar-nav'>
									<li class='dropdown user user-menu'>
										<a href='#' class='dropdown-toggle' data-toggle='dropdown'>
											<img src='$homeurl/foto/admin.jpg' class='user-image' alt='+'>
											<span class='hidden-xs'>$pengawas[nama] &nbsp; <i class='fa fa-caret-down'></i></span>
										</a>
										<ul class='dropdown-menu'>
											<li class='user-header'>
												<img src='$homeurl/foto/admin.jpg' class='img-circle' alt='User Image'>
												<p>
													$pengawas[nama]
													<small>NIP. $pengawas[nip]</small>
												</p>
											</li>
											<li class='user-footer'>
												<div class='pull-left'>
													<a href='?pg=pengaturan' class='btn btn-sm btn-default btn-flat'><i class='fa fa-gear'></i> Pengaturan</a>
												</div>
												<div class='pull-right'>
													<a href='logout.php' class='btn btn-sm btn-default btn-flat'><i class='fa fa-sign-out'></i> Keluar</a>
												</div>
											</li>
										</ul>
									</li>
								</ul>
							</div>
						</nav>
					</header>
					
					<aside class='main-sidebar'>
						<section class='sidebar'>
							<div class='user-panel'>
								<div class='pull-left image'>
									<img src='$homeurl/foto/admin.jpg' class='img-circle' alt='+'>
								</div>
								<div class='pull-left info'>
									<p>$pengawas[nama]</p>
									<a href='#'><i class='fa fa-circle text-green'></i> $pengawas[level]</a>
								</div>
							</div>
							<ul class='sidebar-menu'>
								<li class='header'></li>
								<li><a href='?'><i class='fa fa-fw fa-dashboard'></i> <span>Dashboard</span></a></li>";
								if($pengawas['level']=='admin') {
									echo "
                                        <li><a href='?pg=nilai'><i class='fa fa-fw fa-tags'></i> <span>Nilai</span></a></li>
                                        <li><a href='?pg=soal'><i class='fa fa-fw fa-file-text'></i> <span>Soal</span></a></li>
										<li><a href='?pg=kartu'><i class='fa fa-fw fa-ticket'></i> <span>Kartu Ujian</span></a></li>
										<li><a href='?pg=guru'><i class='fa fa-fw fa-user'></i> <span>Guru</span></a></li>
										<li><a href='?pg=siswa'><i class='fa fa-fw fa-users'></i> <span>Siswa</span></a></li>
										<li><a href='?pg=kelas'><i class='fa fa-fw fa-building-o'></i> <span>Kelas</span></a></li>
										<li><a href='?pg=mapel'><i class='fa fa-fw fa-book'></i> <span>Mata Pelajaran</span></a></li>
										<li><a href='?pg=pengaturan'><i class='fa fa-fw fa-gear'></i> <span>Pengaturan</span></a></li>
									";
								}
								echo "
								<li class='header text-center' id='end-sidebar'></li>
								<li><center><img src='$homeurl/dist/img/logo5.png' alt='+'></center></li>
							</ul><!-- /.sidebar-menu -->
						</section>
					</aside>
					
					<div class='content-wrapper'>
						<section class='content'>";
						if($pg=='') {
							$testongoing = mysqli_num_rows(mysqli_query($conn,  "SELECT * FROM nilai WHERE ujian_mulai!='' AND ujian_selesai=''"));
							$testdone = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM nilai WHERE ujian_mulai!='' AND ujian_selesai!=''"));
							$nilai = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM nilai"));
							$soal = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM soal"));
							$siswa = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM siswa"));
							$guru = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM guru"));
							$pengawas = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM pengawas WHERE level!='admin'"));
							$kelas = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM kelas"));
							$mapel = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM mapel"));
                            if($siswa<>0) {
                                $testongoing_per = (100/$siswa)*$testongoing;
                                $testongoing_per = number_format($testongoing_per,2,'.','');
                                $testongoing_per = str_replace('.00','',$testongoing_per);
                                $testdone_per = (100/$siswa)*$testdone;
                                $testdone_per = number_format($testdone_per,2,'.','');
                                $testdone_per = str_replace('.00','',$testdone_per);
                            } else {
                                $testongoing_per = $testdone_per = 0;
                            }
							echo "
								<div class='row'>
									<div class='col-md-3'>
										<div class='info-box'>
											<span class='info-box-icon bg-yellow'><i class='fa fa-pencil-square-o'></i></span>
											<div class='info-box-content'>
												<span class='info-box-text'>NILAI</span>
												<span class='info-box-number'>$nilai</span>
											</div><!-- /.info-box-content -->
										</div><!-- /.info-box -->
										<div class='info-box'>
											<span class='info-box-icon bg-aqua'><i class='fa fa-file-text'></i></span>
											<div class='info-box-content'>
												<span class='info-box-text'>SOAL</span>
												<span class='info-box-number'>$soal</span>
											</div><!-- /.info-box-content -->
										</div><!-- /.info-box -->
										<div class='info-box'>
											<span class='info-box-icon bg-black'><i class='fa fa-user'></i></span>
											<div class='info-box-content'>
												<span class='info-box-text'>GURU</span>
												<span class='info-box-number'>$guru</span>
											</div><!-- /.info-box-content -->
										</div><!-- /.info-box -->
										<div class='info-box'>
											<span class='info-box-icon bg-green'><i class='fa fa-users'></i></span>
											<div class='info-box-content'>
												<span class='info-box-text'>SISWA</span>
												<span class='info-box-number'>$siswa</span>
											</div><!-- /.info-box-content -->
										</div><!-- /.info-box -->
										<div class='info-box'>
											<span class='info-box-icon bg-red'><i class='fa fa-building-o'></i></span>
											<div class='info-box-content'>
												<span class='info-box-text'>KELAS</span>
												<span class='info-box-number'>$kelas</span>
											</div><!-- /.info-box-content -->
										</div><!-- /.info-box -->
										<div class='info-box'>
											<span class='info-box-icon bg-purple'><i class='fa fa-book'></i></span>
											<div class='info-box-content'>
												<span class='info-box-text'>MATA PELAJARAN</span>
												<span class='info-box-number'>$mapel</span>
											</div><!-- /.info-box-content -->
										</div><!-- /.info-box -->
									</div>
									<div class='col-md-3'>
										<div class='box box-success box-solid direct-chat direct-chat-warning'>
											<div class='box-header with-border'>
												<h3 class='box-title'><i class='fa fa-history'></i> Log Aktifitas Siswa</h3>
												<div class='box-tools pull-right'>
													<a href='?pg=$pg&ac=clearlog' class='btn btn-sm btn-danger' title='Bersihkan Log'><i class='fa fa-trash-o'></i></a>
												</div>
											</div><!-- /.box-header -->
											<div class='box-body'>
												<div id='log-list'>
													<p class='text-center'>
														<br/><i class='fa fa-spin fa-circle-o-notch'></i> Loading....
													</p>
												</div>
											</div><!-- /.box-body -->
										</div><!-- /.box -->
									</div>
									<div class='col-md-3'>
									
										<div class='box box-info box-solid direct-chat direct-chat-warning'>
											<div class='box-header with-border'>
												<h3 class='box-title'><i class='fa fa-history'></i> Log Aktifitas Guru</h3>
												<div class='box-tools pull-right'>
													<a href='?pg=$pg&ac=clearlog1' class='btn btn-sm btn-danger' title='Bersihkan Log'><i class='fa fa-trash-o'></i></a>
												</div>
											</div><!-- /.box-header -->
											<div class='box-body'>
												<div id='log1-list'>
													<p class='text-center'>
														<br/><i class='fa fa-spin fa-circle-o-notch'></i> Loading....
													</p>
												</div>
											</div><!-- /.box-body -->
										</div><!-- /.box -->
									</div>
									<div class='col-md-3'>
										<div class='box box-danger box-solid'>
											<div class='box-header with-border'>
										  <h3 class='box-title'><i class='fa fa-star'></i> Selamat Datang</h3>
											</div><!-- /.box-header -->
											<div class='box-body'>
												<h1 class='text-center'><i class='fa fa-clock-o'></i> <span id='waktu'>$waktu</span></h1>
											</div><!-- /.box-body -->
											<div class='box-footer text-center'>
												<i class='fa fa-calendar'></i> ".buat_tanggal('D, d M Y')."
											</div>
										</div><!-- /.box -->
										<div class='box box-warning box-solid'>
											<div class='box-header with-border'>
												<h3 class='box-title'><i class='fa fa-info-circle'></i> Informasi</h3>
											</div><!-- /.box-header -->
											<div class='box-body'>
												<strong><i class='fa fa-building-o'></i> $setting[sekolah]</strong><br/>
												$setting[alamat]<br/><br/>
												<strong><i class='fa fa-phone'></i> Telepon</strong><br/>
												$setting[telp]<br/><br/>
												<strong><i class='fa fa-fax'></i> Fax</strong><br/>
												$setting[fax]<br/><br/>
												<strong><i class='fa fa-globe'></i> Wesite</strong><br/>
												$setting[web]<br/><br/>
												<strong><i class='fa fa-at'></i> E-mail</strong><br/>
												$setting[email]<br/><br/>
											</div><!-- /.box-body -->
										</div><!-- /.box -->
									</div>
								</div>
							";
							if($ac=='clearlog') {
								mysqli_query($conn,"TRUNCATE log");
								jump('?');
							}
							if($ac=='clearlog1') {
								mysqli_query($conn,"TRUNCATE log1");
								jump('?');
							}
						}
						elseif($pg=='nilai') {
							if($ac=='') {
								echo "
									<div class='row'>
										<div class='col-md-3'></div>
										<div class='col-md-6'>
											<form action='' method='get'>
												<input type='hidden' name='pg' value='$pg'/>
												<input type='hidden' name='ac' value='lihat'/>
												<div class='box box-primary'>
													<div class='box-header with-border'>
														<h3 class='box-title'>Nilai</h3>
														<div class='box-tools pull-right btn-group'>
															<button type='submit' name='submit' class='btn btn-sm btn-primary'>Lanjutkan <i class='fa fa-chevron-right'></i></button>
														</div>
													</div><!-- /.box-header -->
													<div class='box-body'>
														$info
														<div class='form-group'>
															<label>Mata Pelajaran</label>
															<select name='idm' class='form-control' required='true'>
																<option value=''></option>";
																$mapelQ = mysqli_query($conn,"SELECT * FROM mapel ORDER BY nama ASC");
																while($mapel = mysqli_fetch_array($mapelQ)) {
																	echo "<option value='$mapel[id_mapel]'>$mapel[nama]</option>";
																}
																echo"
															</select>
														</div>
														<div class='form-group'>
															<label>Kelas</label>
															<div class='row'>
																<div class='col-xs-4'>";
                                                                    $total = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM kelas"));
                                                                    $limit = number_format($total/3,0,'','');
                                                                    $limit2 = number_format($limit*2,0,'','');
																	$sql_kelas = mysqli_query($conn,"SELECT * FROM kelas ORDER BY nama ASC LIMIT 0,$limit");
																	while($kelas = mysqli_fetch_array($sql_kelas)) {
																		echo "
																			<div class='radio'>
																				<label><input type='radio' name='idk' value='$kelas[id_kelas]'/> $kelas[nama]</label>
																			</div>
																		";
																	}
																	echo "
																</div>
																<div class='col-xs-4'>";
																	$sql_kelas = mysqli_query($conn,"SELECT * FROM kelas ORDER BY nama ASC LIMIT $limit,$limit");
																	while($kelas = mysqli_fetch_array($sql_kelas)) {
																		echo "
																			<div class='radio'>
																				<label><input type='radio' name='idk' value='$kelas[id_kelas]'/> $kelas[nama]</label>
																			</div>
																		";
																	}
																	echo "
																</div>
																<div class='col-xs-4'>";
																	$sql_kelas = mysqli_query($conn,"SELECT * FROM kelas ORDER BY nama ASC LIMIT $limit2,$total");
																	while($kelas = mysqli_fetch_array($sql_kelas)) {
																		echo "
																			<div class='radio'>
																				<label><input type='radio' name='idk' value='$kelas[id_kelas]'/> $kelas[nama]</label>
																			</div>
																		";
																	}
																	echo "
																</div>
															</div>
														</div>
													</div><!-- /.box-body -->
												</div><!-- /.box -->
											</form>
										</div>
									</div>
								";
							}
							elseif($ac=='lihat') {
								$id_mapel = $_GET['idm'];
								$id_kelas = $_GET['idk'];
                                $mapel = mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM mapel WHERE id_mapel='$id_mapel'"));
								echo "
									<div class='row'>
										<div class='col-md-12'>
											<div class='box box-primary'>
												<div class='box-header with-border'>
													<h3 class='box-title'>Nilai $mapel[nama]</h3>
													<div class='box-tools pull-right btn-group'>
														<button class='btn btn-sm btn-default' onclick=frames['frameresult'].print()><i class='fa fa-print'></i> Print</button>
														<a class='btn btn-sm btn-default' href='report_excel.php?m=$id_mapel&k=$id_kelas'><i class='fa fa-file-excel-o'></i> Download Excel</a>
														<a class='btn btn-sm btn-default' href='?pg=nilai'><i class='fa fa-times'></i> Keluar</a>
													</div>
												</div><!-- /.box-header -->
												<div class='box-body'>
													<table id='example1' class='table table-bordered table-striped'>
														<thead>
															<tr>
																<th width='5px'>#</th>
																<th>NIS</th>
																<th>Nama</th>
																<th>Kelas</th>
																<th>Paket</th>
																<th>Lama Ujian</th>
																<th>Jawaban</th>
																<th>Nilai</th>
																<th width='5px'>Ket</th>
																<th width='5px'>&nbsp;</th>
															</tr>
														</thead>
														<tbody>";
														$siswaQ = mysqli_query($conn,"SELECT * FROM siswa WHERE id_kelas='$id_kelas' ORDER BY nama ASC");
														while($siswa = mysqli_fetch_array($siswaQ)) {
															$no++;
															$ket = '';
															$lama = $jawaban = $skor = '--';
															$kelas = mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM kelas WHERE id_kelas='$siswa[id_kelas]'"));
															$nilaiQ = mysqli_query($conn,"SELECT * FROM nilai WHERE id_mapel='$id_mapel' AND id_siswa='$siswa[id_siswa]'");
															$nilaiC = mysqli_num_rows($nilaiQ);
															$nilai = mysqli_fetch_array($nilaiQ);
															if($nilaiC<>0) {
																$lama = '';
																if($nilai['ujian_mulai']<>'' AND $nilai['ujian_selesai']<>'') {
																	$selisih = strtotime($nilai['ujian_selesai'])-strtotime($nilai['ujian_mulai']);
																	$jam = round((($selisih%604800)%86400)/3600);
																	$mnt = round((($selisih%604800)%3600)/60);
																	$dtk = round((($selisih%604800)%60));
																	($jam<>0) ? $lama .= "$jam jam ":null;
																	($mnt<>0) ? $lama .= "$mnt menit ":null;
																	($dtk<>0) ? $lama .= "$dtk detik ":null;
																	$jawaban = "$nilai[jml_benar] benar / $nilai[jml_salah] salah";
																	$skor = number_format($nilai['skor'],2,'.','');
																}
																elseif($nilai['ujian_mulai']<>'' AND $nilai['ujian_selesai']=='') {
																	$selisih = strtotime($nilai['ujian_berlangsung'])-strtotime($nilai['ujian_mulai']);
																	$jam = round((($selisih%604800)%86400)/3600);
																	$mnt = round((($selisih%604800)%3600)/60);
																	$dtk = round((($selisih%604800)%60));
																	($jam<>0) ? $lama .= "$jam jam ":null;
																	($mnt<>0) ? $lama .= "$mnt menit ":null;
																	($dtk<>0) ? $lama .= "$dtk detik ":null;
																	$ket = "<i class='fa fa-spin fa-spinner' title='Sedang ujian'></i>";
																}
															}
															echo "
																<tr>
																	<td>$no</td>
																	<td>$siswa[nis]</td>
																	<td>$siswa[nama]</td>
																	<td>$kelas[nama]</td>
																	<td>$siswa[paket]</td>
																	<td>$lama</td>
																	<td>$jawaban</td>
																	<td>$skor</td>
																	<td>$ket</td>
																	<td width='100px'>
																		<div class='btn-group'>
																			<a href='?pg=$pg&ac=ulang&idm=$id_mapel&idk=$id_kelas&ids=$siswa[id_siswa]' class='btn btn-xs btn-warning'>Ulang</a>";
																			if($ket<>'') {
																				echo "
																					<a href='?pg=$pg&ac=selesai&idm=$id_mapel&idk=$id_kelas&ids=$siswa[id_siswa]' class='btn btn-xs btn-primary'>Selesai</a>
																				";
																			}
																			echo "
																		</div>
																	</td>
																</tr>
															";
														}
														echo "
														</tbody>
													</table>
													<iframe name='frameresult' src='report.php?m=$id_mapel&k=$id_kelas' style='border:none;width:1px;height:1px;'></iframe>
												</div><!-- /.box-body -->
											</div><!-- /.box -->
										</div>
									</div>
								";
							}
							elseif($ac=='ulang') {
								$where = array(
									'id_mapel' => $_GET['idm'],
									'id_siswa' => $_GET['ids']
								);
								delete('nilai',$where);
								delete('jawaban',$where);
								delete('pengacak',$where);
								jump("?pg=$pg&ac=lihat&idm=$_GET[idm]&idk=$_GET[idk]");
							}
							elseif($ac=='selesai') {
								$idm = $_GET['idm'];
								$ids = $_GET['ids'];
								$idk = $_GET['idk'];
								$where = array(
									'id_mapel' => $idm,
									'id_siswa' => $ids
								);
								$benar = $salah = 0;
								$mapel = fetch('mapel',array('id_mapel'=>$idm));
								$siswa = fetch('siswa',array('id_siswa'=>$ids));
								$ceksoal = select('soal',array('id_mapel'=>$idm,'paket'=>$siswa['paket']));
								foreach($ceksoal as $getsoal) {
									$w = array(
										'id_siswa' => $ids,
										'id_mapel' => $idm,
										'id_soal' => $getsoal['id_soal']
									);
									$cekjwb = rowcount('jawaban',$w);
									if($cekjwb<>0) {
										$getjwb = fetch('jawaban',$w);
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
								jump("?pg=$pg&ac=lihat&idm=$idm&idk=$idk");
							}
						}
						elseif($pg=='soal') {
							if($ac=='') {
								(isset($_POST['submit'])) ? jump("?pg=$pg&ac=input&paket=$_POST[paket]&id=$_POST[id_mapel]&no=1"):null;
								echo "
									<div class='row'>
										<div class='col-md-3'></div>
										<div class='col-md-6'>
											<form action='' method='post'>
												<div class='box box-primary'>
													<div class='box-header with-border'>
														<h3 class='box-title'>Soal</h3>
														
														<div class='box-tools pull-right btn-group'>
															<a href='?pg=importsoal' class='btn btn-sm btn-primary'><i class='fa fa-sign-in'></i> Import</a>
															<button type='submit' name='submit' class='btn btn-sm btn-primary'>Lanjutkan <i class='fa fa-chevron-right'></i></button>
														</div>
													</div><!-- /.box-header -->
													<div class='box-body'>
														$info
														<div class='form-group'>
															<label>Mata Pelajaran</label>
															<select name='id_mapel' class='form-control' required='true'>
																<option value=''></option>";
																$mapelQ = mysqli_query($conn,"SELECT * FROM mapel ORDER BY nama ASC");
																while($mapel = mysqli_fetch_array($mapelQ)) {
																	echo "<option value='$mapel[id_mapel]'>$mapel[nama]</option>";
																}
																echo"
															</select>
														</div>
                                                        <div class='form-group'>
                                                            <label>Paket Soal</label>
                                                            <div class='radio'>
                                                                <label><input type='radio' name='paket' value='A' required='true'/>A</label> &nbsp;&nbsp;&nbsp;&nbsp;
                                                                <label><input type='radio' name='paket' value='B' required='true'/>B</label>
                                                            </div>
                                                        </div>
													</div><!-- /.box-body -->
												</div><!-- /.box -->
											</form>
										</div>
									</div>
								";
							}
							elseif($ac=='input') {
								$nomor = $_GET['no'];
                                $paket = $_GET['paket'];
								$id_mapel = $_GET['id'];
								$mapel = mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM mapel WHERE id_mapel='$id_mapel'"));
                                $soalQ = mysqli_query($conn,"SELECT * FROM soal WHERE id_mapel='$id_mapel' AND paket='$paket' AND nomor='$nomor'");
								$soalC = mysqli_num_rows($soalQ);
								$soal = mysqli_fetch_array($soalQ);
								if(isset($_POST['submit'])) {
									$isi_soal = $_POST['isi_soal'];
									$pilA = html2str($_POST['pilA']);
									$pilB = html2str($_POST['pilB']);
									$pilC = html2str($_POST['pilC']);
									$pilD = html2str($_POST['pilD']);
									$pilE = html2str($_POST['pilE']);
									$jawaban = $_POST['jawaban'];
									if(isset($_FILES['file']['name']) && $_FILES['file']['name']<>'') {
										$file = $_FILES['file']['name'];
										$temp = $_FILES['file']['tmp_name'];
										$size = $_FILES['file']['size'];
										$ext = explode('.',$file);
										$ext = end($ext);
										$url = 'files/'.$id_mapel.'_'.$nomor.'_1.'.$ext;
										$upload = move_uploaded_file($temp,'../'.$url);
										(!$upload) ? $url = $soal['file']:null;
									} else {
										$url = $soal['file'];
									}
									if(isset($_FILES['file1']['name']) && $_FILES['file1']['name']<>'') {
										$file1 = $_FILES['file1']['name'];
										$temp = $_FILES['file1']['tmp_name'];
										$size = $_FILES['file1']['size'];
										$ext = explode('.',$file1);
										$ext = end($ext);
										$file1 = 'files/'.$id_mapel.'_'.$nomor.'_2.'.$ext;
										$upload = move_uploaded_file($temp,'../'.$file1);
										(!$upload) ? $file1 = $soal['file1']:null;
									} else {
										$file1 = $soal['file1'];
									}
									if($soalC==0) {
										$exec = mysqli_query($conn,"INSERT INTO soal (id_mapel,paket,nomor,soal,pilA,pilB,pilC,pilD,pilE,jawaban,file,file1) VALUES ('$id_mapel','$paket','$nomor','$isi_soal','$pilA','$pilB','$pilC','$pilD','$pilE','$jawaban','$url','$file1')");
									} else {
										$exec = mysqli_query($conn,"UPDATE soal SET soal='$isi_soal',pilA='$pilA',pilB='$pilB',pilC='$pilC',pilD='$pilD',pilE='$pilE',jawaban='$jawaban',file='$url',file1='$file1' WHERE id_mapel='$id_mapel' AND paket='$paket' AND nomor='$nomor'");
									}
									(!$exec) ? $info = info('Gagal menyimpan soal!','NO') : $info = info('Berhasil menyimpan soal!','OK');
								}
								$soal = mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM soal WHERE id_mapel='$id_mapel' AND paket='$paket' AND nomor='$nomor'"));
								($soal['jawaban']=='A') ? $jwbA='checked':$jwbA='';
								($soal['jawaban']=='B') ? $jwbB='checked':$jwbB='';
								($soal['jawaban']=='C') ? $jwbC='checked':$jwbC='';
								($soal['jawaban']=='D') ? $jwbD='checked':$jwbD='';
								($soal['jawaban']=='E') ? $jwbE='checked':$jwbE='';
								echo "
									<div class='row'>
										<div class='col-md-12'>
											<form action='' method='post' enctype='multipart/form-data'>
												<div class='box box-primary'>
													<div class='box-header with-border'>
														<h3 class='box-title'>Soal</h3>
														<div class='box-tools pull-right btn-group'>
															<a href='?pg=soal' class='btn btn-sm btn-default'><i class='fa fa-times'></i> Keluar</a>
															<button type='submit' name='submit' class='btn btn-sm btn-primary'><i class='fa fa-check'></i> Simpan</button>
														</div>
													</div><!-- /.box-header -->
													<div class='box-body'>
														$info
														<div class='form-group'>
															<div class='row'>
																<div class='col-md-3'>
																	<label>Mata Pelajaran</label>
																	<input type='text' value='$mapel[nama]' class='form-control input-lg' disabled/>
																</div>
																<div class='col-md-2'>
																	<label>Paket Soal</label>
																	<input type='text' value='$paket' class='form-control input-lg' disabled/>
																</div>
																<div class='col-md-2'>
																	<label>Jumlah Soal</label>
																	<input type='text' value='$mapel[jml_soal] soal' class='form-control input-lg' disabled/>
																</div>
																<div class='col-md-2'>
																	<label>Lama Ujian</label>
																	<input type='text' value='$mapel[lama_ujian] menit' class='form-control input-lg' disabled/>
																</div>
																<div class='col-md-3'>
																	<label>Tanggal Ujian</label>
																	<input type='text' value='".buat_tanggal('D, d M Y',$mapel['tgl_ujian'])."' class='form-control input-lg' disabled/>
																</div>
															</div>
														</div>
													</div><!-- /.box-body -->
												</div><!-- /.box -->
												<div class='box'>
													<div class='box-body'>
														<div class='form-group'>
															<label>Nomor Soal</label><br/>
															<div class='btn-group'>";
																for($i=1;$i<=$mapel['jml_soal'];$i++) {
																	$ceksoal = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM soal WHERE id_mapel='$id_mapel' AND paket='$paket' AND nomor='$i'"));
																	($ceksoal<>0) ? $a='success':$a='default';
																	($i==$nomor) ? $a='danger':null;
																	echo "<a href='?pg=$pg&ac=$ac&paket=$paket&id=$id_mapel&no=$i' class='btn btn-xs btn-$a'>$i</a>";
																}
																echo "
															</div>
														</div>
														<div class='row'>
															<div class='col-md-6'>
																<div class='form-group'>
																	<label>Soal</label>
																	<textarea name='isi_soal' class='form-control textarea' rows='10' required='true' style='width:100%;'>$soal[soal]</textarea>
																</div>
																<div class='form-group'>";
																	if($soal['file']<>'') {
																		$audio = array('mp3','wav','ogg','MP3','WAV','OGG');
																		$image = array('jpg','jpeg','png','gif','bmp','JPG','JPEG','PNG','GIF','BMP');
																		$ext = explode(".",$soal['file']);
																		$ext = end($ext);
																		if(in_array($ext,$image)) {
																			echo "
																				<label>Gambar</label><br/>
																				<img src='$homeurl/$soal[file]' style='max-width:300px;'/>
																			";
																		}
																		elseif(in_array($ext,$audio)) {
																			echo "
																				<label>Audio</label><br/>
																				<audio controls><source src='$homeurl/$soal[file]' type='audio/$ext'>Your browser does not support the audio tag.</audio>
																			";
																		} else {
																			echo "File tidak didukung!";
																		}
																		echo "<br/><a href='?pg=$pg&ac=hapusfile&id=$soal[id_soal]&file=file' class='text-red'><i class='fa fa-times'></i> Hapus</a>";
																	} else {
																		echo "
																			<label>Gambar / Audio</label>
																			<input type='file' name='file' class='form-control'/>
																		";
																	}
																	echo "
																</div>
																<div class='form-group'>";
																	if($soal['file1']<>'') {
																		$audio = array('mp3','wav','ogg','MP3','WAV','OGG');
																		$image = array('jpg','jpeg','png','gif','bmp','JPG','JPEG','PNG','GIF','BMP');
																		$ext = explode(".",$soal['file1']);
																		$ext = end($ext);
																		if(in_array($ext,$image)) {
																			echo "
																				<label>Gambar</label><br/>
																				<img src='$homeurl/$soal[file1]' style='max-width:300px;'/>
																			";
																		}
																		elseif(in_array($ext,$audio)) {
																			echo "
																				<label>Audio</label><br/>
																				<audio controls><source src='$homeurl/$soal[file1]' type='audio/$ext'>Your browser does not support the audio tag.</audio>
																			";
																		} else {
																			echo "File tidak didukung!";
																		}
																		echo "<br/><a href='?pg=$pg&ac=hapusfile&id=$soal[id_soal]&file=file1' class='text-red'><i class='fa fa-times'></i> Hapus</a>";
																	} else {
																		echo "
																			<label>Gambar / Audio</label>
																			<input type='file' name='file1' class='form-control'/>
																		";
																	}
																	echo "
																</div>
															</div>
															<div class='col-md-4'>
																<div class='form-group'>
																	<label>Pilihan A</label>
																	<textarea name='pilA' class='form-control' required='true'>$soal[pilA]</textarea>
																</div>
																<div class='form-group'>
																	<label>Pilihan B</label>
																	<textarea name='pilB' class='form-control' required='true'>$soal[pilB]</textarea>
																</div>
																<div class='form-group'>
																	<label>Pilihan C</label>
																	<textarea name='pilC' class='form-control' required='true'>$soal[pilC]</textarea>
																</div>
																<div class='form-group'>
																	<label>Pilihan D</label>
																	<textarea name='pilD' class='form-control' required='true'>$soal[pilD]</textarea>
																</div>
																<div class='form-group'>
																	<label>Pilihan E</label>
																	<textarea name='pilE' class='form-control' required='true'>$soal[pilE]</textarea>
																</div>
															</div>
															<div class='col-md-2'>
																<label>Jawaban</label>
																<div class='radio'>
																	<label><input type='radio' name='jawaban' value='A' required='true' $jwbA/> A</label><br/>
																	<label><input type='radio' name='jawaban' value='B' required='true' $jwbB/> B</label><br/>
																	<label><input type='radio' name='jawaban' value='C' required='true' $jwbC/> C</label><br/>
																	<label><input type='radio' name='jawaban' value='D' required='true' $jwbD/> D</label><br/>
																	<label><input type='radio' name='jawaban' value='E' required='true' $jwbE/> E</label><br/>
																</div>
															</div>
														</div>
													</div><!-- /.box-body -->
												</div><!-- /.box -->
											</form>
										</div>
									</div>
								";
							}
							elseif($ac=='hapusfile') {
								$id = $_GET['id'];
								$file = $_GET['file'];
								$soal = mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM soal WHERE id_soal='$id'"));
								(file_exists('../'.$soal[$file])) ? unlink('../'.$soal[$file]):null;
								mysqli_query($conn,"UPDATE soal SET $file='' WHERE id_soal='$id'");
								jump("?pg=$pg&ac=input&paket=$soal[paket]&id=$soal[id_mapel]&no=$soal[nomor]");
							}
						}
						elseif($pg=='kartu') {
							if($ac=='') {
								echo "
									<div class='row'>
										<div class='col-md-3'></div>
										<div class='col-md-6'>
											<div class='box box-primary'>
												<div class='box-header with-border'>
													<h3 class='box-title'>Kartu Peserta Ujian</h3>
													<div class='box-tools pull-right btn-group'>
														<button class='btn btn-sm btn-primary' onclick=frames['frameresult'].print()><i class='fa fa-print'></i> Print</button>
													</div>
												</div><!-- /.box-header -->
												<div class='box-body'>
													$info
													<div class='form-group'>
														<label>Kelas</label>
														<div class='row'>
															<div class='col-xs-4'>";
																$total = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM kelas"));
																$limit = number_format($total/3,0,'','');
																$limit2 = number_format($limit*2,0,'','');
																$sql_kelas = mysqli_query($conn, "SELECT * FROM kelas ORDER BY nama ASC LIMIT 0,$limit");
																while($kelas = mysqli_fetch_array($sql_kelas)) {
																	echo "
																		<div class='radio'>
																			<label><input type='radio' name='idk' value='$kelas[id_kelas]' onclick=printkartu('$kelas[0]') /> $kelas[nama]</label>
																		</div>
																	";
																}
																echo "
															</div>
															<div class='col-xs-4'>";
																$sql_kelas = mysqli_query($conn, "SELECT * FROM kelas ORDER BY nama ASC LIMIT $limit,$limit");
																while($kelas = mysqli_fetch_array($sql_kelas)) {
																	echo "
																		<div class='radio'>
																			<label><input type='radio' name='idk' value='$kelas[id_kelas]' onclick=printkartu('$kelas[0]') /> $kelas[nama]</label>
																		</div>
																	";
																}
																echo "
															</div>
															<div class='col-xs-4'>";
																$sql_kelas = mysqli_query($conn, "SELECT * FROM kelas ORDER BY nama ASC LIMIT $limit2,$total");
																while($kelas = mysqli_fetch_array($sql_kelas)) {
																	echo "
																		<div class='radio'>
																			<label><input type='radio' name='idk' value='$kelas[id_kelas]' onclick=printkartu('$kelas[0]') /> $kelas[nama]</label>
																		</div>
																	";
																}
																echo "
															</div>
														</div>
													</div>
												</div><!-- /.box-body -->
											</div><!-- /.box -->
										</div>
									</div>
									<iframe id='loadframe' name='frameresult' src='kartu.php' style='border:none;width:1px;height:1px;'></iframe>
								";
							}
						}
						elseif($pg=='guru') {
							echo "
								<div class='row'>
									<div class='col-md-8'>
										<div class='box box-primary'>
											<div class='box-header with-border'>
												<h3 class='box-title'>Guru</h3>
                                                <div class='box-tools btn-group'>
                                                    <a href='?pg=importguru' class='btn btn-sm btn-primary'><i class='fa fa-sign-in'></i> Import</a>
                                                </div>
											</div><!-- /.box-header -->
											<div class='box-body'>
												<table id='example1' class='table table-bordered table-striped'>
													<thead>
														<tr>
															<th width='5px'>#</th>
															<th width='30px'>Foto</th>
															<th>NIP</th>
															<th>Nama</th>
															<th>Jabatan</th>
															<th>Username</th>
															<th width='60px'><center>Aksi</center></th>
														</tr>
													</thead>
													<tbody>";
													$guruQ = mysqli_query($conn, "SELECT * FROM guru");
													while($guru = mysqli_fetch_array($guruQ)) {
														$no++;
													
														echo "
															<tr>
																<td>$no</td>
																<td>";
																$fileO = "../foto/guru_".$guru['username'].".jpg";
																$file1 = "../foto/avatar.jpg";
																if (file_exists($fileO)) {
																	echo "<img src='$fileO' class='img-circle' width='40' height='40'></td>";
																} else {
																	echo "<img src='$file1' class='img-circle' width='40' height='40'></td>";
																}
														echo "
																<td>$guru[nip]</td>
																<td>$guru[nama]</td>
																<td>$guru[jabatan]</td>
																<td>$guru[username]</td>
																<td align='center'>
																	<a href='?pg=$pg&ac=edit&id=$guru[id_guru]' class='btn btn-sm btn-info' title='Edit'><i class='fa fa-edit'></i></a>
																	<a href='?pg=$pg&ac=hapus&id=$guru[id_guru]' class='btn btn-sm btn-warning' title='Hapus'><i class='fa fa-trash'></i></a>
																</td>
															</tr>
														";
													}
													echo "
													</tbody>
												</table>
											</div><!-- /.box-body -->
										</div><!-- /.box -->
									</div>
									<div class='col-md-4'>";
										if($ac=='') {
											if(isset($_POST['submit'])) {
												$nip = $_POST['nip'];
												$nama = $_POST['nama'];
												$nama = str_replace("'","&#39;",$nama);
												$username = $_POST['username'];
												$jabatan = $_POST['jabatan'];
												$pass1 = $_POST['pass1'];
												$pass2 = $_POST['pass2'];
												$cekuser = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM guru WHERE username='$username'"));
												$level = "guruku";
												$password = password_hash($pass1,PASSWORD_BCRYPT);
												$fileO = "../foto/guru_".$username.".jpg";
												if($cekuser>0) {
													$info = info("Username $username sudah ada!","NO");
												} else {
													if($pass1<>$pass2) {
														$info = info("Password tidak cocok!","NO");
													} else {
														if (!file_exists($fileO)){
$target_dir = "../foto/";
///$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$target_file = $target_dir . "guru_" . $username . ".jpg";
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
if(isset($_POST["submit"])) {
    // Check if file was uploaded
    if(isset($_FILES["fileToUpload"]) && $_FILES["fileToUpload"]["tmp_name"] !== "") {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false) {
            $info = info("File is an image - " . $check["mime"] . ".");
            $uploadOk = 1;
        } else {
            $info = info("File is not an image.");
            $uploadOk = 0;
        }
    } else {
        $info = info("No file uploaded.");
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    $info = info("Sorry, file already exists.");
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    $info = info("Sorry, your file is too large.");
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg") {
    $info = info("Sorry, only JPG files are allowed.");
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    $info = info("Sorry, your file was not uploaded.");
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        $info = info("The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.");
    } else {
        $info = info("Sorry, there was an error uploading your file.");
    }
}
														}
														$exec = mysqli_query($conn, "INSERT INTO guru (nip,nama,jabatan,username,password,level) VALUES ('$nip','$nama','$jabatan','$username','$password','$level')");
														(!$exec) ? $info = info("Gagal menyimpan!","NO") : jump("?pg=$pg");
													}
												}
												

											}
											echo "
												<form action='' method='post' enctype='multipart/form-data'>
													<div class='box box-primary'>
														<div class='box-header with-border'>
															<h3 class='box-title'>Tambah</h3>
															<div class='box-tools pull-right btn-group'>
																<button type='submit' name='submit' class='btn btn-sm btn-primary'><i class='fa fa-check'></i> Simpan</button>
															</div>
														</div><!-- /.box-header -->
														<div class='box-body'>
															$info
															<div class='form-group'>
																<label>NIP</label>
																<input type='text' name='nip' class='form-control' required='true'/>
															</div>
															<div class='form-group'>
																<label>Nama</label>
																<input type='text' name='nama' class='form-control' required='true'/>
															</div>
															<div class='form-group'>
																<label>Jabatan</label>
																<input type='text' name='jabatan' class='form-control' required='true'/>
															</div>
															<div class='form-group'>
																<label>Username</label>
																<input type='text' name='username' class='form-control' required='true'/>
															</div>
															<div class='form-group'>
																<div class='row'>
																	<div class='col-md-6'>
																		<label>Password</label>
																		<input type='password' name='pass1' class='form-control' required='true'/>
																	</div>
																	<div class='col-md-6'>
																		<label>Ulang Password</label>
																		<input type='password' name='pass2' class='form-control' required='true'/>
																	</div>
																</div>
															</div>
															
															<div class='form-group'>";
																
																		echo "
																			<label>Foto *.jpg</label>
																			
																			<input type='file' name='fileToUpload' id='fileToUpload' class='form-control'/>
																		";
																	
																
																
																	echo "
															</div>
															
														</div><!-- /.box-body -->
													</div><!-- /.box -->
												</form>
											";
										}
										if($ac=='edit') {
											$id = $_GET['id'];
											$value = mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM guru WHERE id_guru='$id'"));
											if(isset($_POST['submit'])) {
												$nip = $_POST['nip'];
												$nama = $_POST['nama'];
												$nama = str_replace("'","&#39;",$nama);
												$username = $_POST['username'];
												$jabatan = $_POST['jabatan'];
												$pass1 = $_POST['pass1'];
												$pass2 = $_POST['pass2'];
												$fileO = "../foto/guru_".$username.".jpg";
												if($pass1<>'' AND $pass2<>'') {
														if($pass1<>$pass2) {
															$info = info('Password tidak cocok!','NO');
														} else {
															if (!file_exists($fileO)){
$target_dir = "../foto/";
///$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$target_file = $target_dir . "guru_" . $username . ".jpg";
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        $info = info("File is an image - " . $check["mime"] . ".");
        $uploadOk = 1;
    } else {
        $info = info("File is not an image.");
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    $info = info("Sorry, file already exists.");
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    $info = info("Sorry, your file is too large.");
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg") {
    $info = info("Sorry, only JPG files are allowed.");
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    $info = info("Sorry, your file was not uploaded.");
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        $info = info("The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.");
    } else {
        $info = info("Sorry, there was an error uploading your file.");
    }
}																
															}
														$password = password_hash($pass1,PASSWORD_BCRYPT);
															$exec = mysqli_query($conn,"UPDATE guru SET nip='$nip',nama='$nama',jabatan='$jabatan',username='$username',password='$password' WHERE id_guru='$id'");
															(!$exec) ? $info = info('Gagal menyimpan!','NO') : jump("?pg=$pg");
														}
													} else {
															
															if (!file_exists($fileO)){
$target_dir = "../foto/";
///$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$target_file = $target_dir . "guru_" . $username . ".jpg";
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        $info = info("File is an image - " . $check["mime"] . ".");
        $uploadOk = 1;
    } else {
        $info = info("File is not an image.");
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    $info = info("Sorry, file already exists.");
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    $info = info("Sorry, your file is too large.");
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg") {
    $info = info("Sorry, only JPG files are allowed.");
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    $info = info("Sorry, your file was not uploaded.");
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        $info = info("The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.");
    } else {
        $info = info("Sorry, there was an error uploading your file.");
    }
}															
															}
														$exec = mysqli_query($conn,"UPDATE guru SET nip='$nip',nama='$nama',jabatan='$jabatan',username='$username' WHERE id_guru='$id'");
															(!$exec) ? $info = info('Gagal menyimpan!','NO') : jump("?pg=$pg");
												}
												
												
												
												
												
												
												
											}
											echo "
												<form action='' method='post' enctype='multipart/form-data'>
													<div class='box box-success'>
														<div class='box-header with-border'>
															<h3 class='box-title'>Edit</h3>
															<div class='box-tools pull-right btn-group'>
																<button type='submit' name='submit' class='btn btn-sm btn-success'><i class='fa fa-check'></i> Simpan</button>
																<a href='?pg=$pg' class='btn btn-sm btn-danger' title='Batal'><i class='fa fa-times'></i></a>
															</div>
														</div><!-- /.box-header -->
														<div class='box-body'>
															$info
															<div class='form-group'>
																<label>NIP</label>
																<input type='text' name='nip' value='$value[nip]' class='form-control' required='true'/>
															</div>
															<div class='form-group'>
																<label>Nama</label>
																<input type='text' name='nama' value='$value[nama]' class='form-control' required='true'/>
															</div>
															<div class='form-group'>
																<label>Jabatan</label>
                                                                <input type='text' name='jabatan' value='$value[jabatan]' class='form-control' required='true'/>
															</div>
															<div class='form-group'>
																<label>Username</label>
																<input type='text' name='username' value='$value[username]' class='form-control' required='true'/>
															</div>
															<div class='form-group'>
																<div class='row'>
																	<div class='col-md-6'>
																		<label>Password</label>
																		<input type='password' name='pass1' value='' class='form-control'/>
																	</div>
																	<div class='col-md-6'>
																		<label>Ulang Password</label>
																		<input type='password' name='pass2' value='' class='form-control'/>
																	</div>
																</div>
																<p class='help-block'>Kosongkan password jika tidak akan diubah.</p>
															</div>
															<div class='form-group'>";
																$fileO = "../foto/guru_".$value['username'].".jpg";
																
																	if (file_exists($fileO)) {
																		
																		
																			echo "<center>
																				<label>Foto</label><br/>
																				<img src='$fileO' style='max-width:300px;'/>
																			";
																		
																		
																		echo "<br/><a href='?pg=$pg&ac=hapusfile&id=$_GET[id]&foto=$value[username]' class='text-red'><i class='fa fa-times'></i> Hapus</a></center>";
																	} else {
																		echo "
																			<label>Foto *.jpg</label>
																			<input type='file' name='fileToUpload' id='fileToUpload' class='form-control'/>
																		";
																	}	
																
																
																	echo "
															</div>
															
														
														</div><!-- /.box-body -->
													</div><!-- /.box -->
												</form>
											";
										}
										if($ac=='hapusfile') {
											$id = $_GET['id'];
											$foto = $_GET['foto'];
											(file_exists('../foto/guru_'.$foto.'.jpg')) ? unlink('../foto/guru_'.$foto.'.jpg'):null;
											
											jump("?pg=$pg&ac=edit&id=$id");

										}
										if($ac=='hapus') {
											$id = $_GET['id'];
											$info = info("Anda yakin akan menghapus guru ini?");
											if(isset($_POST['submit'])) {
												$exec = mysqli_query($conn,"DELETE FROM guru WHERE id_guru='$id'");
												(!$exec) ? $info = info("Gagal menghapus!","NO") : jump("?pg=$pg");
											}
											echo "
												<form action='' method='post'>
													<div class='box box-danger'>
														<div class='box-header with-border'>
															<h3 class='box-title'>Hapus</h3>
															<div class='box-tools pull-right btn-group'>
																<button type='submit' name='submit' class='btn btn-sm btn-danger'><i class='fa fa-trash-o'></i> Hapus</button>
																<a href='?pg=$pg' class='btn btn-sm btn-default' title='Batal'><i class='fa fa-times'></i></a>
															</div>
														</div><!-- /.box-header -->
														<div class='box-body'>
															$info
														</div><!-- /.box-body -->
													</div><!-- /.box -->
												</form>
											";
										}
										echo "
									</div>
								</div>
							";
						}
						elseif($pg=='importguru') {
                            if(isset($_POST['submit'])) {
                                $file = $_FILES['file']['name'];
                                $temp = $_FILES['file']['tmp_name'];
                                $ext = explode('.',$file);
                                $ext = end($ext);
                                if($ext<>'xls') {
                                    $info = info('Gunakan file Ms. Excel 93-2007 Workbook (.xls)','NO');
                                } else {
                                    $data = new Spreadsheet_Excel_Reader($temp);
                                    $hasildata = $data->rowcount($sheet_index=0);
                                    $sukses = $gagal = 0;
                                    for ($i=2; $i<=$hasildata; $i++) {
                                        $id_guru = $data->val($i,1);
                                        $nip = $data->val($i,2); 
                                        $jabatan = $data->val($i,3); 
                                        $nama = $data->val($i,4);
                                        $nama = str_replace("'","&#39;",$nama);
                                        $username = $data->val($i,5);
                                        $username = str_replace("'","",$username);
										
                                        $password = $data->val($i,6);
                                        $password = password_hash($password,PASSWORD_BCRYPT);
                                        $level = "guruku";
                                        $exec = mysqli_query($conn,"INSERT INTO guru (id_guru,nip,nama,jabatan,level,username,password) VALUES ('$id_guru','$nip','$nama','$jabatan','$level','$username','$password')");
                                        ($exec) ? $sukses++ : $gagal++; 
                                    }
                                    $total = $hasildata-1;
                                    $info = info("Berhasil: $sukses | Gagal: $gagal | Dari: $total",'OK');
                                }
                            }
							echo "
								<div class='row'>
									<div class='col-md-3'></div>
									<div class='col-md-6'>
                                        <form action='' method='post' enctype='multipart/form-data'>
                                            <div class='box box-primary'>
                                                <div class='box-header with-border'>
                                                    <h3 class='box-title'>Import Guru</h3>
                                                    <div class='box-tools pull-right btn-group'>
                                                        <button type='submit' name='submit' class='btn btn-sm btn-primary'><i class='fa fa-check'></i> Import</button>
                                                    </div>
                                                </div><!-- /.box-header -->
                                                <div class='box-body'>
                                                    $info
                                                    <div class='form-group'>
                                                        <label>Pilih File</label>
                                                        <input type='file' name='file' class='form-control' required='true'/>
                                                    </div>
                                                    <p>
                                                        Sebelum meng-import pastikan file yang akan anda import sudah dalam bentuk Ms. Excel 97-2003 Workbook (.xls) dan format penulisan harus sesuai dengan yang telah ditentukan. <br/>
                                                    </p>
                                                </div><!-- /.box-body -->
                                                <div class='box-footer'>
                                                    <a href='importdataguru.xls'><i class='fa fa-file-excel-o'></i> Download Format</a>
                                                </div>
                                            </div><!-- /.box -->
                                        </form>
                                    </div>
                                </div>
                            ";
                        }
						elseif($pg=='importsoal') {
                            if(isset($_POST['submit'])) {
                                $file = $_FILES['file']['name'];
                                $temp = $_FILES['file']['tmp_name'];
                                $ext = explode('.',$file);
                                $ext = end($ext);
                                if($ext<>'xls') {
                                    $info = info('Gunakan file Ms. Excel 93-2007 Workbook (.xls)','NO');
                                } else {
                                    $data = new Spreadsheet_Excel_Reader($temp);
                                    $hasildata = $data->rowcount($sheet_index=0);
                                    $sukses = $gagal = 0;
                                    for ($i=2; $i<=$hasildata; $i++) {
										$no = $data->val($i,1);
                                        $soal = $data->val($i,2);
                                        $pilA = $data->val($i,3); 
                                        $pilB = $data->val($i,4); 
                                        $pilC = $data->val($i,5);
                                        $pilD = $data->val($i,6);
                                        $pilE = $data->val($i,7);
                                        $jawaban = $data->val($i,8);
                                        $id_mapel = $_POST['id_mapel'];
                                        $paket = $_POST['paket'];
										$exec = mysqli_query($conn, "INSERT INTO soal (id_mapel,paket,nomor,soal,pilA,pilB,pilC,pilD,pilE,jawaban) VALUES ('$id_mapel','$paket','$no','$soal','$pilA','$pilB','$pilC','$pilD','$pilE','$jawaban')");                                        
										($exec) ? $sukses++ : $gagal++; 
                                    }
                                    $total = $hasildata-1;
                                    $info = info("Berhasil: $sukses | Gagal: $gagal | Dari: $total",'OK');
                                }
                            }
							echo "
								<div class='row'>
									<div class='col-md-3'></div>
									<div class='col-md-6'>
                                        <form action='' method='post' enctype='multipart/form-data'>
                                            <div class='box box-primary'>
                                                <div class='box-header with-border'>
                                                    <h3 class='box-title'>Import Soal</h3>
                                                    <div class='box-tools pull-right btn-group'>
                                                        <button type='submit' name='submit' class='btn btn-sm btn-primary'><i class='fa fa-check'></i> Import</button>
                                                    </div>
                                                </div><!-- /.box-header -->
                                                <div class='box-body'>												
														$info
														<div class='form-group'>
															<label>Mata Pelajaran</label>
															<select name='id_mapel' class='form-control' required='true'>
																<option value=''></option>";
																$mapelQ = mysqli_query($conn, "SELECT * FROM mapel ORDER BY nama ASC");
																while($mapel = mysqli_fetch_array($mapelQ)) {
																	echo "<option value='$mapel[id_mapel]'>$mapel[nama]</option>";
																}
																echo"
															</select>
														</div>
                                                        <div class='form-group'>
                                                            <label>Paket Soal</label>
                                                            <div class='radio'>
                                                                <label><input type='radio' name='paket' value='A' required='true'/>A</label> &nbsp;&nbsp;&nbsp;&nbsp;
                                                                <label><input type='radio' name='paket' value='B' required='true'/>B</label>
                                                            </div>
                                                        </div>
													
                                                    <div class='form-group'>
                                                        <label>Pilih File</label>
                                                        <input type='file' name='file' class='form-control' required='true'/>
                                                    </div>
                                                    <p>
                                                        Sebelum meng-import pastikan file yang akan anda import sudah dalam bentuk Ms. Excel 97-2003 Workbook (.xls) dan format penulisan harus sesuai dengan yang telah ditentukan. <br/>
                                                    </p>
                                                </div><!-- /.box-body -->
                                                <div class='box-footer'>
                                                    <a href='importdatasoal.xls'><i class='fa fa-file-excel-o'></i> Download Format</a>
                                                </div>
                                            </div><!-- /.box -->
                                        </form>
                                    </div>
                                </div>
                            ";
                        }
						elseif($pg=='siswa') {
							echo "
								<div class='row'>
									<div class='col-md-8'>
										<div class='box box-primary'>
											<div class='box-header with-border'>
												<h3 class='box-title'>Siswa</h3>
                                                <div class='box-tools btn-group'>
                                                    <a href='?pg=importsiswa' class='btn btn-sm btn-primary'><i class='fa fa-sign-in'></i> Import</a>
                                                </div>
											</div><!-- /.box-header -->
											<div class='box-body'>
												<table id='example1' class='table table-bordered table-striped'>
													<thead>
														<tr>
															<th width='5px'>#</th>
															<th width='30px'>Foto</th>
															<th>NIS</th>
															<th>Nomor</th>
															<th>Nama</th>
															<th>Kelas</th>
															<th>Pkt</th>
															<th>Username</th>
															<th width='60px'>Aksi</th>
														</tr>
													</thead>
													<tbody>";
													$siswaQ = mysqli_query($conn, "SELECT * FROM siswa");
													while($siswa = mysqli_fetch_array($siswaQ)) {
														$no++;
														$kelas = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM kelas WHERE id_kelas='$siswa[id_kelas]'"));
														echo "
															<tr>
																<td>$no</td>
																<td>";
																$fileO = "../foto/siswa_".$siswa['username'].".jpg";
																$file1 = "../foto/avatar.jpg";
																if (file_exists($fileO)) {
																	echo "<img src='$fileO' class='img-circle' width='40' height='40'></td>";
																} else {
																	echo "<img src='$file1' class='img-circle' width='40' height='40'></td>";
																}
														echo "
																
																<td>$siswa[nis]</td>
																<td>$siswa[no_peserta]</td>
																<td>$siswa[nama]</td>
																<td>$kelas[nama]</td>
																<td>$siswa[paket]</td>
																<td>$siswa[username]</td>
																<td align='center'>
																	<a href='?pg=$pg&ac=edit&id=$siswa[id_siswa]' class='btn btn-sm btn-info' title='Edit'><i class='fa fa-edit'></i></a>
																	<a href='?pg=$pg&ac=hapus&id=$siswa[id_siswa]' class='btn btn-sm btn-warning' title='Hapus'><i class='fa fa-trash'></i></a>

																</td>
															</tr>
														";
													}
													echo "
													</tbody>
												</table>
											</div><!-- /.box-body -->
										</div><!-- /.box -->
									</div>
									<div class='col-md-4'>";
										if($ac=='') {
											if(isset($_POST['submit'])) {
												$nis = $_POST['nis'];
												$no_peserta = $_POST['no_peserta'];
												$nama = $_POST['nama'];
												$nama = str_replace("'","&#39;",$nama);
												$username = $_POST['username'];
												$id_kelas = $_POST['id_kelas'];
												$paket = $_POST['paket'];
												$pass1 = $_POST['pass1'];
												$pass2 = $_POST['pass2'];
												$cekuser = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM siswa WHERE username='$username'"));
												if($cekuser>0) {
													$info = info("Username $username sudah ada!","NO");
												} else {
													if($pass1<>$pass2) {
														$info = info("Password tidak cocok!","NO");
													} else {
														$target_dir = "../foto/";
														$target_file = $target_dir . "siswa_" . $username . ".jpg";
														$uploadOk = 1;
														$imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
														
														if (isset($_POST["submit"])) {
															// Check if a file is uploaded
															if (isset($_FILES["fileToUpload"]) && $_FILES["fileToUpload"]["error"] == 0) {
																$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
																if ($check !== false) {
																	$info = "File is an image - " . $check["mime"] . ".";
																	$uploadOk = 1;
																} else {
																	$info = "File is not an image.";
																	$uploadOk = 0;
																}
															} else {
																$info = "No file was uploaded or there was an upload error.";
																$uploadOk = 0;
															}
														}
														
// Check if file already exists
if (file_exists($target_file)) {
    $info = info("Sorry, file already exists.");
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    $info = info("Sorry, your file is too large.");
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg") {
    $info = info("Sorry, only JPG files are allowed.");
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    $info = info("Sorry, your file was not uploaded.");
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        $info = info("The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.");
    } else {
        $info = info("Sorry, there was an error uploading your file.");
    }
}
														$exec = mysqli_query($conn, "INSERT INTO siswa (id_kelas,nis,no_peserta,nama,paket,username,password) VALUES ('$id_kelas','$nis','$no_peserta','$nama','$paket','$username','$pass1')");
														(!$exec) ? $info = info("Gagal menyimpan!","NO") : jump("?pg=$pg");
													}
												}
											}
											echo "
												<form action='' method='post' enctype='multipart/form-data'>
													<div class='box box-primary'>
														<div class='box-header with-border'>
															<h3 class='box-title'>Tambah</h3>
															<div class='box-tools pull-right btn-group'>
																<button type='submit' name='submit' class='btn btn-sm btn-primary'><i class='fa fa-check'></i> Simpan</button>
															</div>
														</div><!-- /.box-header -->
														<div class='box-body'>
															$info
															<div class='form-group'>
																<label>NIS</label>
																<input type='text' name='nis' class='form-control' required='true'/>
															</div>
															<div class='form-group'>
																<label>Nomor Peserta</label>
																<input type='text' name='no_peserta' class='form-control' required='true'/>
															</div>
															<div class='form-group'>
																<label>Nama</label>
																<input type='text' name='nama' class='form-control' required='true'/>
															</div>
															<div class='form-group'>
																<label>Kelas</label>
																<select name='id_kelas' class='form-control' required='true'>
																	<option value=''></option>";
																	$kelasQ = mysqli_query($conn, "SELECT * FROM kelas ORDER BY nama ASC");
																	while($kelas = mysqli_fetch_array($kelasQ)) {
																		echo "<option value='$kelas[id_kelas]'>$kelas[nama]</option>";
																	}
																	echo"
																</select>
															</div>
															<div class='form-group'>
																<label>Paket Soal</label>
                                                                <div class='radio'>
                                                                    <label><input type='radio' name='paket' value='A' required='true'/>A</label> &nbsp;&nbsp;&nbsp;&nbsp;
                                                                    <label><input type='radio' name='paket' value='B' required='true'/>B</label>
                                                                </div>
															</div>
															<div class='form-group'>
																<label>Username</label>
																<input type='text' name='username' class='form-control' required='true'/>
															</div>
															<div class='form-group'>
																<div class='row'>
																	<div class='col-md-6'>
																		<label>Password</label>
																		<input type='password' name='pass1' class='form-control' required='true'/>
																	</div>
																	<div class='col-md-6'>
																		<label>Ulang Password</label>
																		<input type='password' name='pass2' class='form-control' required='true'/>
																	</div>
																</div>
															</div>
															<div class='form-group'>";
																
																		echo "
																			<label>Foto *.jpg</label>
																			
																			<input type='file' name='fileToUpload' id='fileToUpload' class='form-control'/>
																		";
																	
																
																
																	echo "
															</div>
															
														</div><!-- /.box-body -->
													</div><!-- /.box -->
												</form>
											";
										}
										if($ac=='edit') {
											$id = $_GET['id'];
											$value = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM siswa WHERE id_siswa='$id'"));
											if(isset($_POST['submit'])) {
												$nis = $_POST['nis'];
												$no_peserta = $_POST['no_peserta'];
												$nama = $_POST['nama'];
												$nama = str_replace("'","&#39;",$nama);
												$username = $_POST['username'];
												$id_kelas = $_POST['id_kelas'];
												$paket = $_POST['paket'];
												$pass1 = $_POST['pass1'];
												$pass2 = $_POST['pass2'];
												$fileO = "../foto/siswa_".$username.".jpg";
												if($pass1<>'' AND $pass2<>'') {
													if($pass1<>$pass2) {
														$info = info("Password tidak cocok!","NO");
													} else {
														$exec = mysqli_query($conn, "UPDATE siswa SET id_kelas='$id_kelas',nis='$nis',no_peserta='$no_peserta',nama='$nama',paket='$paket',username='$username',password='$pass1' WHERE id_siswa='$id'");
													}
												} else {
													$exec = mysqli_query($conn, "UPDATE siswa SET id_kelas='$id_kelas',nis='$nis',no_peserta='$no_peserta',nama='$nama',paket='$paket',username='$username' WHERE id_siswa='$id'");
												}
if (!file_exists($fileO)){
$target_dir = "../foto/";
///$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$target_file = $target_dir . "siswa_" . $username . ".jpg";
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $uploadOk = 0; // Initialize $uploadOk to 0 by default
    if(isset($_FILES["fileToUpload"]["tmp_name"]) && !empty($_FILES["fileToUpload"]["tmp_name"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
        }
    } else {
        echo "No file was uploaded.";
    }
}

// Check if file already exists
if (file_exists($target_file)) {
    $info = info("Sorry, file already exists.");
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    $info = info("Sorry, your file is too large.");
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg") {
    $info = info("Sorry, only JPG files are allowed.");
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    $info = info("Sorry, your file was not uploaded.");
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        $info = info("The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.");
    } else {
        $info = info("Sorry, there was an error uploading your file.");
    }
}															
															}
												(!$exec) ? $info = info("Gagal menyimpan!","NO") : jump("?pg=$pg");
											}
											echo "
												<form action='' method='post' enctype='multipart/form-data'>
													<div class='box box-success'>
														<div class='box-header with-border'>
															<h3 class='box-title'>Edit</h3>
															<div class='box-tools pull-right btn-group'>
																<button type='submit' name='submit' class='btn btn-sm btn-success'><i class='fa fa-check'></i> Simpan</button>
																<a href='?pg=$pg' class='btn btn-sm btn-danger' title='Batal'><i class='fa fa-times'></i></a>
															</div>
														</div><!-- /.box-header -->
														<div class='box-body'>
															$info
															<div class='form-group'>
																<label>NIS</label>
																<input type='text' name='nis' value='$value[nis]' class='form-control' required='true'/>
															</div>
															<div class='form-group'>
																<label>Nomor Peserta</label>
																<input type='text' name='no_peserta' value='$value[no_peserta]' class='form-control' required='true'/>
															</div>
															<div class='form-group'>
																<label>Nama</label>
																<input type='text' name='nama' value='$value[nama]' class='form-control' required='true'/>
															</div>
															<div class='form-group'>
																<label>Kelas</label>
																<select name='id_kelas' class='form-control' required='true'>
																	<option value=''></option>";
																	$kelasQ = mysqli_query($conn, "SELECT * FROM kelas ORDER BY nama ASC");
																	while($kelas = mysqli_fetch_array($kelasQ)) {
																		($kelas['id_kelas']==$value['id_kelas']) ? $s='selected':$s='';
																		echo "<option value='$kelas[id_kelas]' $s>$kelas[nama]</option>";
																	}
																	echo"
																</select>
															</div>
															<div class='form-group'>
																<label>Paket Soal</label>
                                                                <div class='radio'>";
                                                                    ($value['paket']=='A') ? $a='checked':$a='';
                                                                    ($value['paket']=='B') ? $b='checked':$b='';
                                                                    echo "
                                                                    <label><input type='radio' name='paket' value='A' required='true' $a/>A</label> &nbsp;&nbsp;&nbsp;&nbsp;
                                                                    <label><input type='radio' name='paket' value='B' required='true' $b/>B</label>
                                                                </div>
															</div>
															<div class='form-group'>
																<label>Username</label>
																<input type='text' name='username' value='$value[username]' class='form-control' required='true'/>
															</div>
															<div class='form-group'>
																<div class='row'>
																	<div class='col-md-6'>
																		<label>Password</label>
																		<input type='password' name='pass1' value='$value[password]' class='form-control'/>
																	</div>
																	<div class='col-md-6'>
																		<label>Ulang Password</label>
																		<input type='password' name='pass2' value='$value[password]' class='form-control'/>
																	</div>
																</div>
															</div>
															<div class='form-group'>";
																$fileO = "../foto/siswa_".$value['username'].".jpg";
																
																	if (file_exists($fileO)) {
																		
																		
																			echo "<center>
																				<label>Foto</label><br/>
																				<img src='$fileO' style='max-width:300px;'/>
																			";
																		
																		
																		echo "<br/><a href='?pg=$pg&ac=hapusfile&id=$_GET[id]&foto=$value[username]' class='text-red'><i class='fa fa-times'></i> Hapus</a></center>";
																	} else {
																		echo "
																			<label>Foto *.jpg</label>
																			<input type='file' name='fileToUpload' id='fileToUpload' class='form-control'/>
																		";
																	}	
																
																
																	echo "
															</div>
														</div><!-- /.box-body -->
													</div><!-- /.box -->
												</form>
											";
										}
										if($ac=='hapusfile') {
											$id = $_GET['id'];
											$foto = $_GET['foto'];
											(file_exists('../foto/siswa_'.$foto.'.jpg')) ? unlink('../foto/siswa_'.$foto.'.jpg'):null;
											
											jump("?pg=$pg&ac=edit&id=$id");

										}
										if($ac=='hapus') {
											$id = $_GET['id'];
											$info = info("Anda yakin akan menghapus siswa ini?");
											if(isset($_POST['submit'])) {
												$exec = mysqli_query($conn, "DELETE FROM siswa WHERE id_siswa='$id'");
												(!$exec) ? $info = info("Gagal menghapus!","NO") : jump("?pg=$pg");
											}
											echo "
												<form action='' method='post'>
													<div class='box box-danger'>
														<div class='box-header with-border'>
															<h3 class='box-title'>Hapus</h3>
															<div class='box-tools pull-right btn-group'>
																<button type='submit' name='submit' class='btn btn-sm btn-danger'><i class='fa fa-trash-o'></i> Hapus</button>
																<a href='?pg=$pg' class='btn btn-sm btn-default' title='Batal'><i class='fa fa-times'></i></a>
															</div>
														</div><!-- /.box-header -->
														<div class='box-body'>
															$info
														</div><!-- /.box-body -->
													</div><!-- /.box -->
												</form>
											";
										}
										echo "
									</div>
								</div>
							";
						}
						elseif($pg=='importsiswa') {
                            if(isset($_POST['submit'])) {
                                $file = $_FILES['file']['name'];
                                $temp = $_FILES['file']['tmp_name'];
                                $ext = explode('.',$file);
                                $ext = end($ext);
                                if($ext<>'xls') {
                                    $info = info('Gunakan file Ms. Excel 93-2007 Workbook (.xls)','NO');
                                } else {
                                    $data = new Spreadsheet_Excel_Reader($temp);
                                    $hasildata = $data->rowcount($sheet_index=0);
                                    $sukses = $gagal = 0;
                                    for ($i=2; $i<=$hasildata; $i++) {
                                        $id_siswa = $data->val($i,1);
                                        $nis = $data->val($i,2); 
                                        $no_peserta = $data->val($i,3); 
                                        $nama = $data->val($i,4);
                                        $nama = str_replace("'","&#39;",$nama);
                                        $kelas = $data->val($i,5);
                                        $paket = $data->val($i,6);
                                        $username = $data->val($i,7);
                                        $username = str_replace("'","",$username);
                                        $password = $data->val($i,8);
                                        
                                        $kelas = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM kelas WHERE nama='$kelas'"));
                                        $exec = mysqli_query($conn, "INSERT INTO siswa (id_siswa,id_kelas,nis,no_peserta,nama,paket,username,password) VALUES ('$id_siswa','$kelas[id_kelas]','$nis','$no_peserta','$nama','$paket','$username','$password')");
                                        ($exec) ? $sukses++ : $gagal++; 
                                    }
                                    $total = $hasildata-1;
                                    $info = info("Berhasil: $sukses | Gagal: $gagal | Dari: $total",'OK');
                                }
                            }
							echo "
								<div class='row'>
									<div class='col-md-3'></div>
									<div class='col-md-6'>
                                        <form action='' method='post' enctype='multipart/form-data'>
                                            <div class='box box-primary'>
                                                <div class='box-header with-border'>
                                                    <h3 class='box-title'>Import Siswa</h3>
                                                    <div class='box-tools pull-right btn-group'>
                                                        <button type='submit' name='submit' class='btn btn-sm btn-primary'><i class='fa fa-check'></i> Import</button>
                                                    </div>
                                                </div><!-- /.box-header -->
                                                <div class='box-body'>
                                                    $info
                                                    <div class='form-group'>
                                                        <label>Pilih File</label>
                                                        <input type='file' name='file' class='form-control' required='true'/>
                                                    </div>
                                                    <p>
                                                        Sebelum meng-import pastikan file yang akan anda import sudah dalam bentuk Ms. Excel 97-2003 Workbook (.xls) dan format penulisan harus sesuai dengan yang telah ditentukan. <br/>
                                                    </p>
                                                </div><!-- /.box-body -->
                                                <div class='box-footer'>
                                                    <a href='importdatasiswa.xls'><i class='fa fa-file-excel-o'></i> Download Format</a>
                                                </div>
                                            </div><!-- /.box -->
                                        </form>
                                    </div>
                                </div>
                            ";
                        }
						elseif($pg=='pengawas') {
							echo "
								<div class='row'>
									<div class='col-md-8'>
										<div class='box box-primary'>
											<div class='box-header with-border'>
												<h3 class='box-title'>Pengawas</h3>
											</div><!-- /.box-header -->
											<div class='box-body'>
												<table id='example1' class='table table-bordered table-striped'>
													<thead>
														<tr>
															<th width='5px'>#</th>
															<th>NIP</th>
															<th>Nama</th>
															<th>Username</th>
															<th width='5px'></th>
														</tr>
													</thead>
													<tbody>";
													$pengawasQ = mysqli_query($conn, "SELECT * FROM pengawas WHERE level='pengawas' ORDER BY nama ASC");
													while($pengawas = mysqli_fetch_array($pengawasQ)) {
														$no++;
														echo "
															<tr>
																<td>$no</td>
																<td>$pengawas[nip]</td>
																<td>$pengawas[nama]</td>
																<td>$pengawas[username]</td>
																<td align='center'>
																	<div class='btn-group'>
																		<button type='button' class='btn btn-xs btn-default dropdown-toggle' data-toggle='dropdown'>
																			<span class='caret'></span>
																			<span class='sr-only'>Toggle Dropdown</span>
																		</button>
																		<ul class='dropdown-menu' role='menu'>
																			<li><a href='?pg=$pg&ac=edit&id=$pengawas[id_pengawas]'>Edit</a></li>
																			<li><a href='?pg=$pg&ac=hapus&id=$pengawas[id_pengawas]'>Hapus</a></li>
																		</ul>
																	</div>
																</td>
															</tr>
														";
													}
													echo "
													</tbody>
												</table>
											</div><!-- /.box-body -->
										</div><!-- /.box -->
									</div>
									<div class='col-md-4'>";
										if($ac=='') {
											if(isset($_POST['submit'])) {
												$nip = $_POST['nip'];
												$nama = $_POST['nama'];
												$nama = str_replace("'","&#39;",$nama);
												$username = $_POST['username'];
												$pass1 = $_POST['pass1'];
												$pass2 = $_POST['pass2'];
												$cekuser = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM pengawas WHERE username='$username'"));
												if($cekuser>0) {
													$info = info("Username $username sudah ada!","NO");
												} else {
													if($pass1<>$pass2) {
														$info = info("Password tidak cocok!","NO");
													} else {
														$password = password_hash($pass1,PASSWORD_BCRYPT);
														$exec = mysqli_query($conn, "INSERT INTO pengawas (nip,nama,username,password,level) VALUES ('$nip','$nama','$username','$password','pengawas')");
														(!$exec) ? $info = info("Gagal menyimpan!","NO") : jump("?pg=$pg");
													}
												}
											}
											echo "
												<form action='' method='post'>
													<div class='box box-primary'>
														<div class='box-header with-border'>
															<h3 class='box-title'>Tambah</h3>
															<div class='box-tools pull-right btn-group'>
																<button type='submit' name='submit' class='btn btn-sm btn-primary'><i class='fa fa-check'></i> Simpan</button>
															</div>
														</div><!-- /.box-header -->
														<div class='box-body'>
															$info
															<div class='form-group'>
																<label>NIP</label>
																<input type='text' name='nip' class='form-control' required='true'/>
															</div>
															<div class='form-group'>
																<label>Nama</label>
																<input type='text' name='nama' class='form-control' required='true'/>
															</div>
															<div class='form-group'>
																<label>Username</label>
																<input type='text' name='username' class='form-control' required='true'/>
															</div>
															<div class='form-group'>
																<div class='row'>
																	<div class='col-md-6'>
																		<label>Password</label>
																		<input type='password' name='pass1' class='form-control' required='true'/>
																	</div>
																	<div class='col-md-6'>
																		<label>Ulang Password</label>
																		<input type='password' name='pass2' class='form-control' required='true'/>
																	</div>
																</div>
															</div>
														</div><!-- /.box-body -->
													</div><!-- /.box -->
												</form>
											";
										}
										if($ac=='edit') {
											$id = $_GET['id'];
											$value = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM pengawas WHERE id_pengawas='$id'"));
											if(isset($_POST['submit'])) {
												$nip = $_POST['nip'];
												$nama = $_POST['nama'];
												$nama = str_replace("'","&#39;",$nama);
												$username = $_POST['username'];
												$pass1 = $_POST['pass1'];
												$pass2 = $_POST['pass2'];
												if($pass1<>'' AND $pass2<>'') {
													if($pass1<>$pass2) {
														$info = info("Password tidak cocok!","NO");
													} else {
														$password = password_hash($pass1,PASSWORD_BCRYPT);
														$exec = mysqli_query($conn, "UPDATE pengawas SET nip='$nip',nama='$nama',username='$username',password='$password' WHERE id_pengawas='$id'");
													}
												} else {
													$exec = mysqli_query($conn, "UPDATE pengawas SET nip='$nip',nama='$nama',username='$username' WHERE id_pengawas='$id'");
												}
												(!$exec) ? $info = info("Gagal menyimpan!","NO") : jump("?pg=$pg");
											}
											echo "
												<form action='' method='post'>
													<div class='box box-success'>
														<div class='box-header with-border'>
															<h3 class='box-title'>Edit</h3>
															<div class='box-tools pull-right btn-group'>
																<button type='submit' name='submit' class='btn btn-sm btn-success'><i class='fa fa-check'></i> Simpan</button>
																<a href='?pg=$pg' class='btn btn-sm btn-danger' title='Batal'><i class='fa fa-times'></i></a>
															</div>
														</div><!-- /.box-header -->
														<div class='box-body'>
															$info
															<div class='form-group'>
																<label>NIP</label>
																<input type='text' name='nip' value='$value[nip]' class='form-control' required='true'/>
															</div>
															<div class='form-group'>
																<label>Nama</label>
																<input type='text' name='nama' value='$value[nama]' class='form-control' required='true'/>
															</div>
															<div class='form-group'>
																<label>Username</label>
																<input type='text' name='username' value='$value[username]' class='form-control' required='true'/>
															</div>
															<div class='form-group'>
																<div class='row'>
																	<div class='col-md-6'>
																		<label>Password</label>
																		<input type='password' name='pass1' class='form-control'/>
																	</div>
																	<div class='col-md-6'>
																		<label>Ulang Password</label>
																		<input type='password' name='pass2' class='form-control'/>
																	</div>
																</div>
															</div>
														</div><!-- /.box-body -->
													</div><!-- /.box -->
												</form>
											";
										}
										if($ac=='hapus') {
											$id = $_GET['id'];
											$info = info("Anda yakin akan menghapus pengawas ini?");
											if(isset($_POST['submit'])) {
												$exec = mysqli_query($conn, "DELETE FROM pengawas WHERE id_pengawas='$id'");
												(!$exec) ? $info = info("Gagal menghapus!","NO") : jump("?pg=$pg");
											}
											echo "
												<form action='' method='post'>
													<div class='box box-danger'>
														<div class='box-header with-border'>
															<h3 class='box-title'>Hapus</h3>
															<div class='box-tools pull-right btn-group'>
																<button type='submit' name='submit' class='btn btn-sm btn-danger'><i class='fa fa-trash-o'></i> Hapus</button>
																<a href='?pg=$pg' class='btn btn-sm btn-default' title='Batal'><i class='fa fa-times'></i></a>
															</div>
														</div><!-- /.box-header -->
														<div class='box-body'>
															$info
														</div><!-- /.box-body -->
													</div><!-- /.box -->
												</form>
											";
										}
										echo "
									</div>
								</div>
							";
						}
						elseif($pg=='kelas') {
							echo "
								<div class='row'>
									<div class='col-md-8'>
										<div class='box box-primary'>
											<div class='box-header with-border'>
												<h3 class='box-title'>Kelas</h3>
											</div><!-- /.box-header -->
											<div class='box-body'>
												<table id='example1' class='table table-bordered table-striped'>
													<thead>
														<tr>
															<th width='5px'>#</th>
															<th>Kelas</th>
															<th width='5px'></th>
														</tr>
													</thead>
													<tbody>";
													$adminQ = mysqli_query($conn,"SELECT * FROM kelas ORDER BY nama ASC");
													while($adm = mysqli_fetch_array($adminQ)) {
														$no++;
														echo "
															<tr>
																<td>$no</td>
																<td>$adm[nama]</td>
																<td align='center'>
																	<div class='btn-group'>
																		<button type='button' class='btn btn-xs btn-default dropdown-toggle' data-toggle='dropdown'>
																			<span class='caret'></span>
																			<span class='sr-only'>Toggle Dropdown</span>
																		</button>
																		<ul class='dropdown-menu' role='menu'>
																			<li><a href='?pg=$pg&ac=edit&id=$adm[id_kelas]'>Edit</a></li>
																			<li><a href='?pg=$pg&ac=hapus&id=$adm[id_kelas]'>Hapus</a></li>
																		</ul>
																	</div>
																</td>
															</tr>
														";
													}
													echo "
													</tbody>
												</table>
											</div><!-- /.box-body -->
										</div><!-- /.box -->
									</div>
									<div class='col-md-4'>";
										if($ac=='') {
											if(isset($_POST['submit'])) {
												$nama = $_POST['nama'];
												$cek = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM kelas WHERE nama='$nama'"));
												if($cek>0) {
													$info = info("Kelas $nama sudah ada!","NO");
												} else {
													$exec = mysqli_query($conn,"INSERT INTO kelas (nama) VALUES ('$nama')");
													if(!$exec) {
														$info = info("Gagal menyimpan!","NO");
													} else {
														jump("?pg=$pg");
													}
												}
											}
											echo "
												<form action='' method='post'>
													<div class='box box-primary'>
														<div class='box-header with-border'>
															<h3 class='box-title'>Tambah</h3>
															<div class='box-tools pull-right btn-group'>
																<button type='submit' name='submit' class='btn btn-sm btn-primary'><i class='fa fa-check'></i> Simpan</button>
															</div>
														</div><!-- /.box-header -->
														<div class='box-body'>
															$info
															<div class='form-group'>
																<label>Kelas</label>
																<input type='text' name='nama' class='form-control' required='true'/>
															</div>
														</div><!-- /.box-body -->
													</div><!-- /.box -->
												</form>
											";
										}
										if($ac=='edit') {
											$id = $_GET['id'];
											$value = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM kelas WHERE id_kelas='$id'"));
											if(isset($_POST['submit'])) {
												$nama = $_POST['nama'];
												$exec = mysqli_query($conn, "UPDATE kelas SET nama='$nama' WHERE id_kelas='$id'");
												if(!$exec) {
													$info = info("Gagal menyimpan!","NO");
												} else {
													jump("?pg=$pg");
												}
											}
											echo "
												<form action='' method='post'>
													<div class='box box-success'>
														<div class='box-header with-border'>
															<h3 class='box-title'>Edit</h3>
															<div class='box-tools pull-right btn-group'>
																<button type='submit' name='submit' class='btn btn-sm btn-success'><i class='fa fa-check'></i> Simpan</button>
																<a href='?pg=$pg' class='btn btn-sm btn-danger' title='Batal'><i class='fa fa-times'></i></a>
															</div>
														</div><!-- /.box-header -->
														<div class='box-body'>
															$info
															<div class='form-group'>
																<label>Kelas</label>
																<input type='text' name='nama' value='$value[nama]' class='form-control' required='true'/>
															</div>
														</div><!-- /.box-body -->
													</div><!-- /.box -->
												</form>
											";
										}
										if($ac=='hapus') {
											$id = $_GET['id'];
											$info = info("Anda yakin akan menghapus kelas ini?");
											if(isset($_POST['submit'])) {
												$exec = mysqli_query($conn, "DELETE FROM kelas WHERE id_kelas='$id'");
												if(!$exec) {
													$info = info("Gagal menghapus!","NO");
												} else {
													jump("?pg=$pg");
												}
											}
											echo "
												<form action='' method='post'>
													<div class='box box-danger'>
														<div class='box-header with-border'>
															<h3 class='box-title'>Hapus</h3>
															<div class='box-tools pull-right btn-group'>
																<button type='submit' name='submit' class='btn btn-sm btn-danger'><i class='fa fa-trash-o'></i> Hapus</button>
																<a href='?pg=$pg' class='btn btn-sm btn-default' title='Batal'><i class='fa fa-times'></i></a>
															</div>
														</div><!-- /.box-header -->
														<div class='box-body'>
															$info
														</div><!-- /.box-body -->
													</div><!-- /.box -->
												</form>
											";
										}
										echo "
									</div>
								</div>
							";
						}
						elseif($pg=='mapel') {
							echo "
								<div class='row'>
									<div class='col-md-8'>
										<div class='box box-primary'>
											<div class='box-header with-border'>
												<h3 class='box-title'>Mata Pelajaran</h3>
											</div><!-- /.box-header -->
											<div class='box-body'>
												<table id='example1' class='table table-bordered table-striped'>
													<thead>
														<tr>
															<th width='5px'>#</th>
															<th>Mata Pelajaran</th>
															<th>Soal</th>
															<th>Tanggal Ujian</th>
															<th>Lama Ujian</th>
															<th>Acak Soal</th>
															<th width='5px'></th>
														</tr>
													</thead>
													<tbody>";
													$mapelQ = mysqli_query($conn, "SELECT * FROM mapel ORDER BY tgl_ujian ASC");
													while($mapel = mysqli_fetch_array($mapelQ)) {
														$no++;
														echo "
															<tr>
																<td>$no</td>
																<td>$mapel[nama]</td>
																<td>$mapel[jml_soal]</td>
																<td>".buat_tanggal('d M Y - H:i',$mapel['tgl_ujian'])."</td>
																<td>$mapel[lama_ujian] menit</td>
																<td>". enum($mapel['acak']) ."</td>
																<td align='center'>
																	<div class='btn-group'>
																		<button type='button' class='btn btn-xs btn-default dropdown-toggle' data-toggle='dropdown'>
																			<span class='caret'></span>
																			<span class='sr-only'>Toggle Dropdown</span>
																		</button>
																		<ul class='dropdown-menu' role='menu'>
																			<li><a href='?pg=$pg&ac=edit&id=$mapel[id_mapel]'>Edit</a></li>
																			<li><a href='?pg=$pg&ac=hapus&id=$mapel[id_mapel]'>Hapus</a></li>
																		</ul>
																	</div>
																</td>
															</tr>
														";
													}
													echo "
													</tbody>
												</table>
											</div><!-- /.box-body -->
										</div><!-- /.box -->
									</div>
									<div class='col-md-4'>";
										if($ac=='') {
											if(isset($_POST['submit'])) {
												$nama = $_POST['nama'];
												$nama = str_replace("'","&#39;",$nama);
												$jml_soal = $_POST['jml_soal'];
												$tgl_ujian = $_POST['tgl_ujian'];
												$wkt_ujian = $_POST['wkt_ujian'].':00';
												$lama_ujian = $_POST['lama_ujian'];
												$acak = (isset($_POST['acak'])) ? 1 : 0;
												$cek = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM mapel WHERE nama='$nama'"));
												if($cek>0) {
													$info = info("Mata pelajaran $nama sudah ada!","NO");
												} else {
													$exec = mysqli_query($conn, "INSERT INTO mapel (nama,jml_soal,tgl_ujian,lama_ujian,acak) VALUES ('$nama','$jml_soal','$tgl_ujian $wkt_ujian','$lama_ujian','$acak')");
													(!$exec) ? $info = info("Gagal menyimpan!","NO") : jump("?pg=$pg");
												}
											}
											echo "
												<form action='' method='post'>
													<div class='box box-primary'>
														<div class='box-header with-border'>
															<h3 class='box-title'>Tambah</h3>
															<div class='box-tools pull-right btn-group'>
																<button type='submit' name='submit' class='btn btn-sm btn-primary'><i class='fa fa-check'></i> Simpan</button>
															</div>
														</div><!-- /.box-header -->
														<div class='box-body'>
															$info
															<div class='form-group'>
																<label>Mata Pelajaran</label>
																<input type='text' name='nama' class='form-control' required='true'/>
															</div>
															<div class='form-group'>
																<label>Jumlah Soal</label>
																<input type='number' name='jml_soal' class='form-control' required='true'/>
															</div>
															<div class='form-group'>
																<label>Tanggal Ujian</label>
																<input type='date' name='tgl_ujian' class='form-control' required='true'/>
															</div>
															<div class='form-group'>
																<label>Waktu Ujian</label>
																<input type='text' name='wkt_ujian' class='form-control' placeholder='00:00' required='true'/>
															</div>
															<div class='form-group'>
																<label>Lama ujian</label>
																<input type='number' name='lama_ujian' class='form-control' required='true'/>
																<p class='help-block'>Lama ujian dalam menit.</p>
															</div>
															<div class='form-group'>
																<div class='checkbox'>
																	<label>
																		<input type='checkbox' name='acak' value='1'/> Acak Soal
																	</label>
																</div>
															</div>
														</div><!-- /.box-body -->
													</div><!-- /.box -->
												</form>
											";
										}
										if($ac=='edit') {
											$id = $_GET['id'];
											$value = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM mapel WHERE id_mapel='$id'"));
											$tgl_ujian = explode(' ',$value['tgl_ujian']);
											$acak = ($value['acak']==1) ? 'checked' : '';
											if(isset($_POST['submit'])) {
												$nama = $_POST['nama'];
												$nama = str_replace("'","&#39;",$nama);
												$jml_soal = $_POST['jml_soal'];
												$tgl_ujian = $_POST['tgl_ujian'];
												$wkt_ujian = $_POST['wkt_ujian'].':00';
												$lama_ujian = $_POST['lama_ujian'];
												$acak = (isset($_POST['acak'])) ? 1 : 0;
												$exec = mysqli_query($conn, "UPDATE mapel SET nama='$nama',jml_soal='$jml_soal',tgl_ujian='$tgl_ujian $wkt_ujian',lama_ujian='$lama_ujian',acak='$acak' WHERE id_mapel='$id'");
												(!$exec) ? $info = info("Gagal menyimpan!","NO") : jump("?pg=$pg");
											}
											echo "
												<form action='' method='post'>
													<div class='box box-success'>
														<div class='box-header with-border'>
															<h3 class='box-title'>Edit</h3>
															<div class='box-tools pull-right btn-group'>
																<button type='submit' name='submit' class='btn btn-sm btn-success'><i class='fa fa-check'></i> Simpan</button>
																<a href='?pg=$pg' class='btn btn-sm btn-danger' title='Batal'><i class='fa fa-times'></i></a>
															</div>
														</div><!-- /.box-header -->
														<div class='box-body'>
															$info
															<div class='form-group'>
																<label>Mata Pelajaran</label>
																<input type='text' name='nama' value='$value[nama]' class='form-control' required='true'/>
															</div>
															<div class='form-group'>
																<label>Jumlah Soal</label>
																<input type='number' name='jml_soal' value='$value[jml_soal]' class='form-control' required='true'/>
															</div>
															<div class='form-group'>
																<label>Tanggal Ujian</label>
																<input type='date' name='tgl_ujian' value='$tgl_ujian[0]' class='form-control' required='true'/>
															</div>
															<div class='form-group'>
																<label>Waktu Ujian</label>
																<input type='text' name='wkt_ujian' value='".substr($tgl_ujian[1],0,5)."' class='form-control' placeholder='00:00' required='true'/>
															</div>
															<div class='form-group'>
																<label>Lama ujian</label>
																<input type='number' name='lama_ujian' value='$value[lama_ujian]' class='form-control' required='true'/>
																<p class='help-block'>Lama ujian dalam menit.</p>
															</div>
															<div class='form-group'>
																<div class='checkbox'>
																	<label>
																		<input type='checkbox' name='acak' value='1' $acak/> Acak Soal
																	</label>
																</div>
															</div>
														</div><!-- /.box-body -->
													</div><!-- /.box -->
												</form>
											";
										}
										if($ac=='hapus') {
											$id = $_GET['id'];
											$info = info("Anda yakin akan menghapus mata pelajaran ini?");
											if(isset($_POST['submit'])) {
												$exec = mysqli_query($conn, "DELETE FROM mapel WHERE id_mapel='$id'");
												(!$exec) ? $info = info("Gagal menghapus!","NO") : jump("?pg=$pg");
											}
											echo "
												<form action='' method='post'>
													<div class='box box-danger'>
														<div class='box-header with-border'>
															<h3 class='box-title'>Hapus</h3>
															<div class='box-tools pull-right btn-group'>
																<button type='submit' name='submit' class='btn btn-sm btn-danger'><i class='fa fa-trash-o'></i> Hapus</button>
																<a href='?pg=$pg' class='btn btn-sm btn-default' title='Batal'><i class='fa fa-times'></i></a>
															</div>
														</div><!-- /.box-header -->
														<div class='box-body'>
															$info
														</div><!-- /.box-body -->
													</div><!-- /.box -->
												</form>
											";
										}
										echo "
									</div>
								</div>
							";
						}
						elseif($pg=='pengaturan') {
							$info1 = $info2 = $info3 = $info4 = '';
							if(isset($_POST['submit1'])) {
								$alamat = nl2br($_POST['alamat']);
								$header = nl2br($_POST['header']);
								$exec = mysqli_query($conn, "UPDATE setting SET aplikasi='$_POST[aplikasi]',sekolah='$_POST[sekolah]',kepsek='$_POST[kepsek]',nip='$_POST[nip]',alamat='$alamat',telp='$_POST[telp]',fax='$_POST[fax]',web='$_POST[web]',email='$_POST[email]',header='$header' WHERE id_setting='1'");
								if($exec) {
									$info1 = info('Berhasil menyimpan pengaturan!','OK');
									if($_FILES['logo']['name']<>'') {
										$logo = $_FILES['logo']['name'];
										$temp = $_FILES['logo']['tmp_name'];
										$ext = explode('.',$logo);
										$ext = end($ext);
										$dest = 'dist/img/logoaplikasi.'.$ext;
										$upload = move_uploaded_file($temp,'../'.$dest);
										if($upload) {
											$exec = mysqli_query($conn, "UPDATE setting SET logo='$dest' WHERE id_setting='1'");
											$info1 = info('Berhasil menyimpan pengaturan!','OK');
										} else {
											$info1 = info('Gagal menyimpan pengaturan!','NO');
										}
									}
									if($_FILES['logo1']['name']<>'') {
										$logo = $_FILES['logo1']['name'];
										$temp = $_FILES['logo1']['tmp_name'];
										$ext = explode('.',$logo);
										$ext = end($ext);
										$dest = 'foto/admin.jpg';
										$upload = move_uploaded_file($temp,'../'.$dest);
										if($upload) {
											$info1 = info('Berhasil menyimpan pengaturan!','OK');
										} else {
											$info1 = info('Gagal menyimpan pengaturan!','NO');
										}
									}
								} else {
									$info1 = info('Gagal menyimpan pengaturan!','NO');
								}
							}
							if(isset($_POST['submit2'])) {
								$nip = $_POST['nip'];
								$nama = $_POST['nama'];
								$nama = str_replace("'","&#39;",$nama);
								$jabatan = $_POST['jabatan'];
								$username = $_POST['username'];
								$pass1 = $_POST['pass1'];
								$pass2 = $_POST['pass2'];
								if($pass1<>'' AND $pass2<>'') {
									if($pass1<>$pass2) {
										$info2 = info('Password tidak cocok!','NO');
									} else {
										$password = password_hash($pass1,PASSWORD_BCRYPT);
										$exec = mysqli_query($conn,"UPDATE pengawas SET nip='$nip',nama='$nama',jabatan='$jabatan',username='$username',password='$password' WHERE level='admin'");
										(!$exec) ? $info2 = info('Gagal menyimpan pengaturan!','NO') : $info2 = info('Pengaturan disimpan!','OK');
									}
								} else {
									$exec = mysqli_query($conn,"UPDATE pengawas SET nip='$nip',nama='$nama',jabatan='$jabatan',username='$username' WHERE level='admin'");
									(!$exec) ? $info2 = info('Gagal menyimpan pengaturan!','NO') : $info2 = info('Pengaturan disimpan!','OK');
								}
							}
							if(isset($_POST['submit3'])) {
								$password = $_POST['password'];
                                if(!password_verify($password,$pengawas['password'])) {
                                    $info4 = info('Password salah!','NO');
                                } else {
                                    if(!empty($_POST['data'])) {
                                        $data = $_POST['data'];
                                        if($data<>'') {
                                            foreach($data as $table) {
                                                if($table<>'pengawas') {
                                                    mysqli_query("TRUNCATE $table");
                                                } else {
                                                    mysqli_query($conn,"DELETE FROM $table WHERE level!='admin'");
                                                }
                                            }
                                            $info4 = info('Data terpilih telah dikosongkan!','OK');
                                        }
                                    }
                                }
							}
							$admin = mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM pengawas WHERE level='admin' AND id_pengawas='1'"));
							$setting = mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM setting WHERE id_setting='1'"));
							$setting['alamat'] = str_replace('<br />','',$setting['alamat']);
							$setting['header'] = str_replace('<br />','',$setting['header']);
							echo "
								<div class='row'>
									<div class='col-md-6'>
										<form action='' method='post' enctype='multipart/form-data'>
											<div class='box box-primary'>
												<div class='box-header with-border'>
													<h3 class='box-title'>Pengaturan Aplikasi</h3>
													<div class='box-tools pull-right btn-group'>
														<button type='submit' name='submit1' class='btn btn-sm btn-primary'><i class='fa fa-check'></i> Simpan</button>
													</div>
												</div><!-- /.box-header -->
												<div class='box-body'>
													$info1
													<div class='form-group'>
														<label>Nama Aplikasi</label>
														<input type='text' name='aplikasi' value='$setting[aplikasi]' class='form-control' required='true'/>
													</div>
													<div class='form-group'>
														<label>Nama Sekolah</label>
														<input type='text' name='sekolah' value='$setting[sekolah]' class='form-control' required='true'/>
													</div>
													<div class='form-group'>
														<label>Kepala Sekolah</label>
														<input type='text' name='kepsek' value='$setting[kepsek]' class='form-control'/>
													</div>
													<div class='form-group'>
														<label>NIP Kepala Sekolah</label>
														<input type='text' name='nip' value='$setting[nip]' class='form-control'/>
													</div>
													<div class='form-group'>
														<label>Alamat</label>
														<textarea name='alamat' class='form-control' rows='3'>$setting[alamat]</textarea>
													</div>
													<div class='form-group'>
														<div class='row'>
															<div class='col-md-6'>
																<label>Telepon</label>
																<input type='text' name='telp' value='$setting[telp]' class='form-control'/>
															</div>
															<div class='col-md-6'>
																<label>Fax</label>
																<input type='text' name='fax' value='$setting[fax]' class='form-control'/>
															</div>
														</div>
													</div>
													<div class='form-group'>
														<div class='row'>
															<div class='col-md-6'>
																<label>Website</label>
																<input type='text' name='web' value='$setting[web]' class='form-control'/>
															</div>
															<div class='col-md-6'>
																<label>E-mail</label>
																<input type='text' name='email' value='$setting[email]' class='form-control'/>
															</div>
														</div>
													</div>
													<div class='form-group'>
														<div class='row'>
															<div class='col-md-6'>
																<label>Logo</label>
																<input type='file' name='logo' class='form-control'/>
															</div>
															<div class='col-md-6'>
																&nbsp;<br/>
																<img src='$homeurl/$setting[logo]'/ height=70 weidth=70>
															</div>
														</div>
													</div>
													<div class='form-group'>
														<div class='row'>
															<div class='col-md-6'>
																<label>Foto *.jpg</label>
																<input type='file' name='logo1' class='form-control'/>
															</div>
															<div class='col-md-6'>
																&nbsp;<br/>
																<img src='../foto/admin.jpg'/>
															</div>
														</div>
													</div>
													<div class='form-group'>
														<label>Header Laporan</label>
														<textarea name='header' class='form-control' rows='3'>$setting[header]</textarea>
													</div>
												</div><!-- /.box-body -->
											</div><!-- /.box -->
										</form>
									</div>
									<div class='col-md-6'>
										<form action='' method='post'>
											<div class='box box-primary'>
												<div class='box-header with-border'>
													<h3 class='box-title'>Pengaturan Admin</h3>
													<div class='box-tools pull-right btn-group'>
														<button type='submit' name='submit2' class='btn btn-sm btn-primary'><i class='fa fa-check'></i> Simpan</button>
													</div>
												</div><!-- /.box-header -->
												<div class='box-body'>
													$info2
													<div class='form-group'>
														<label>NIP</label>
														<input type='text' name='nip' value='$admin[nip]' class='form-control' required='true'/>
													</div>
													<div class='form-group'>
														<label>Nama</label>
														<input type='text' name='nama' value='$admin[nama]' class='form-control' required='true'/>
													</div>
													<div class='form-group'>
														<label>Jabatan</label>
														<input type='text' name='jabatan' value='$admin[jabatan]' class='form-control' required='true'/>
													</div>
													<div class='form-group'>
														<label>Username</label>
														<input type='text' name='username' value='$admin[username]' class='form-control' required='true'/>
													</div>
													<div class='form-group'>
														<div class='row'>
															<div class='col-md-6'>
																<label>Password</label>
																<input type='password' name='pass1' class='form-control'/>
															</div>
															<div class='col-md-6'>
																<label>Ulang Password</label>
																<input type='password' name='pass2' class='form-control'/>
															</div>
														</div>
														<p class='help-block'>Kosongkan password jika tidak akan diubah.</p>
													</div>
												</div><!-- /.box-body -->
											</div><!-- /.box -->
										</form>
										<form action='' method='post'>
											<div class='box box-danger'>
												<div class='box-header with-border'>
													<h3 class='box-title'>Kosongkan Data</h3>
													<div class='box-tools pull-right btn-group'>
														<button type='submit' name='submit3' class='btn btn-sm btn-danger'><i class='fa fa-trash-o'></i> Kosongkan</button>
													</div>
												</div><!-- /.box-header -->
												<div class='box-body'>
													$info4
													<div class='form-group'>
														<label>Pilih Data</label>
                                                        <div class='row'>
                                                            <div class='col-md-5'>
                                                                <div class='checkbox'>
                                                                    <label><input type='checkbox' name='data[]' value='nilai'/> Data Nilai</label><br/>
                                                                    <label><input type='checkbox' name='data[]' value='soal'/> Data Soal</label><br/>
                                                                    <label><input type='checkbox' name='data[]' value='siswa'/> Data Siswa</label><br/>
                                                                    <label><input type='checkbox' name='data[]' value='guru'/> Data Guru</label><br/>
                                                                    <label><input type='checkbox' name='data[]' value='kelas'/> Data Kelas</label><br/>
                                                                    <label><input type='checkbox' name='data[]' value='mapel'/> Data Mata Pelajaran</label><br/>
                                                                    <label><input type='checkbox' name='data[]' value='log'/> Log Aktifitas Siswa</label><br/>
                                                                    <label><input type='checkbox' name='data[]' value='log1'/> Log Aktifitas Guru</label><br/>
                                                                </div>
                                                            </div>
                                                            <div class='col-md-7'>
                                                                <p class='text-danger'><i class='fa fa-warning'></i> <strong>Mohon diingat!</strong> Data yang telah dikosongkan tidak dapat dikembalikan.</p>
                                                            </div>
                                                        </div>
													</div>
													<div class='form-group'>
														<label>Password Admin</label>
														<input type='password' name='password' class='form-control' required='true'/>
													</div>
                                                    
												</div><!-- /.box-body -->
											</div><!-- /.box -->
										</form>
									</div>
								</div>
							";
						} else {
							echo "
								<div class='error-page'>
									<h2 class='headline text-yellow'> 404</h2>
									<div class='error-content'>
										<br/>
										<h3><i class='fa fa-warning text-yellow'></i> Upss! Halaman tidak ditemukan.</h3>
										<p>
											Halaman yang anda inginkan saat ini tidak tersedia.<br/>
											Silahkan kembali ke <a href='?'><strong>dashboard</strong></a> dan coba lagi.<br/>
											Hubungi seorang <strong><i>Developer</i></strong> jika ini adalah sebuah masalah.
										</p>
									</div><!-- /.error-content -->
								</div><!-- /.error-page -->
							";
						}
						echo "
						</section><!-- /.content -->
					</div><!-- /.content-wrapper -->
				</div><!-- ./wrapper -->

				<!-- REQUIRED JS SCRIPTS -->

				<script src='$homeurl/plugins/jQuery/jQuery-2.1.4.min.js'></script>
				<script src='$homeurl/dist/js/bootstrap.min.js'></script>
				<script src='$homeurl/dist/js/app.min.js'></script>
				<script src='$homeurl/dist/js/clear-elements.js'></script>
				<script src='$homeurl/plugins/slimScroll/jquery.slimscroll.min.js'></script>
				<script src='$homeurl/plugins/datatables/jquery.dataTables.min.js'></script>
				<script src='$homeurl/plugins/datatables/dataTables.bootstrap.min.js'></script>
				<script src='$homeurl/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js'></script>
				<script>
					$('.textarea').wysihtml5();
					$('#example1').DataTable();
					var autoRefresh = setInterval(
						function () {
							$('#waktu').load('$homeurl/admin/_load.php?pg=waktu');
							$('#log-list').load('$homeurl/admin/_load.php?pg=log');
							$('#log1-list').load('$homeurl/admin/_load1.php?pg=log');
						}, 1000
					);
					
					function printkartu(idkelas) {
						$('#loadframe').attr('src','kartu.php?id_kelas='+idkelas);
					}
				</script>
			</body>
		</html>
	";
?>
