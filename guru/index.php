<?php
	require("../config/config.default.php");
	require("../config/config.function.php");
	require("../config/functions.crud.php");
	require("../config/class.excelReader.php");
	(isset($_SESSION['id_guru'])) ? $id_guru = $_SESSION['id_guru'] : $id_guru = 0;
	($id_guru==0) ? header('location:login.php'):null;
	$guru = mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM guru WHERE id_guru='$id_guru'"));
	(isset($_GET['pg'])) ? $pg = $_GET['pg'] : $pg = '';
	(isset($_GET['ac'])) ? $ac = $_GET['ac'] : $ac = '';
	($pg=='soal' && $ac=='input') ? $sidebar = 'sidebar-collapse' : $sidebar = '';
	echo "
		<!DOCTYPE html>
		<html>
			<head>
				<meta charset='utf-8'/>
				<meta http-equiv='X-UA-Compatible' content='IE=edge'/>
				<title>Guru | $setting[aplikasi]</title>
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
											<img src='$homeurl/foto/guru_$guru[username].jpg' class='user-image' alt='+'>
											<span class='hidden-xs'>$guru[nama] &nbsp; <i class='fa fa-caret-down'></i></span>
										</a>
										<ul class='dropdown-menu'>
											<li class='user-header'>
												<img src='$homeurl/foto/guru_$guru[username].jpg' class='img-circle' alt='User Image'>
												<p>
													$guru[nama]
													<small>NIP. $guru[nip]</small>
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
									<img src='$homeurl/foto/guru_$guru[username].jpg' class='img-circle' alt='+'>
								</div>
								<div class='pull-left info'>
									<p>$guru[nama]</p>
									<a href='#'><i class='fa fa-circle text-green'></i> $guru[level]</a>
								</div>
							</div>
							<ul class='sidebar-menu'>
								<li class='header'></li>
								<li><a href='?'><i class='fa fa-fw fa-dashboard'></i> <span>Dashboard</span></a></li>";
								if($guru['level']=='guruku') {
									echo "
                                        <li><a href='?pg=nilai'><i class='fa fa-fw fa-tags'></i> <span>Nilai</span></a></li>
                                        <li><a href='?pg=soal'><i class='fa fa-fw fa-file-text'></i> <span>Soal</span></a></li>
										<li><a href='?pg=kelas'><i class='fa fa-fw fa-building-o'></i> <span>Kelas</span></a></li>
										
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
							$testongoing = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM nilai WHERE ujian_mulai!='' AND ujian_selesai=''"));
							$testdone = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM nilai WHERE ujian_mulai!='' AND ujian_selesai!=''"));
							$nilai = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM nilai"));
							$soal = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM soal"));
							$siswa = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM siswa"));
							$guru = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM guru WHERE level!='guruku'"));
							$kelas = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM kelas"));
							$mapel = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM mapel"));
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
									<div class='col-md-4'>
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
									<div class='col-md-4'>
										<div class='box box-success box-solid direct-chat direct-chat-warning'>
											<div class='box-header with-border'>
												<h3 class='box-title'><i class='fa fa-history'></i> Log Aktifitas</h3>
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
									<div class='col-md-4'>
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
																$mapelQ = mysqli_query ($conn,"SELECT * FROM mapel ORDER BY nama ASC");
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
																	<td width='90px'>
																		<div class='btn-group'>
																			<a href='?pg=$pg&ac=ulang&idm=$id_mapel&idk=$id_kelas&ids=$siswa[id_siswa]&ns=$siswa[nama]' class='btn btn-xs btn-warning'>Ulang</a>";
																			
																			if($ket<>'') {
																				echo "
																					<a href='?pg=$pg&ac=selesai&idm=$id_mapel&idk=$id_kelas&ids=$siswa[id_siswa]&ns=$siswa[nama]' class='btn btn-xs btn-primary'>Selesai</a>
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
									'id_siswa' => $_GET['ids'],
									'ns' => $_GET['ns']
								);
								
								
								delete('nilai',$where);
								delete('jawaban',$where);
								delete('pengacak',$where);
								mysqli_query($conn,"INSERT INTO log1 (id_guru,type,text,date) VALUES ('$_SESSION[id_guru]','testongoing','test ulang $_GET[ns]','$tanggal $waktu')");
								
																
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
								mysqli_query($conn,"INSERT INTO log1 (id_guru,type,text,date) VALUES ('$_SESSION[id_guru]','testongoing','Hentikan test $_GET[ns]','$tanggal $waktu')");
								
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
								mysqli_query("UPDATE soal SET $file='' WHERE id_soal='$id'");
								jump("?pg=$pg&ac=input&paket=$soal[paket]&id=$soal[id_mapel]&no=$soal[nomor]");
							}
						}
						elseif($pg=='guru') {
							echo "
								<div class='row'>
									<div class='col-md-8'>
										<div class='box box-primary'>
											<div class='box-header with-border'>
												<h3 class='box-title'>Guru</h3>
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
													$guruQ = mysqli_query($conn,"SELECT * FROM guru WHERE level='guru' ORDER BY nama ASC");
													while($guru = mysqli_fetch_array($guruQ)) {
														$no++;
														echo "
															<tr>
																<td>$no</td>
																<td>$guru[nip]</td>
																<td>$guru[nama]</td>
																<td>$guru[username]</td>
																<td align='center'>
																	<div class='btn-group'>
																		<button type='button' class='btn btn-xs btn-default dropdown-toggle' data-toggle='dropdown'>
																			<span class='caret'></span>
																			<span class='sr-only'>Toggle Dropdown</span>
																		</button>
																		<ul class='dropdown-menu' role='menu'>
																			<li><a href='?pg=$pg&ac=edit&id=$guru[id_guru]'>Edit</a></li>
																			<li><a href='?pg=$pg&ac=hapus&id=$guru[id_guru]'>Hapus</a></li>
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
												$cekuser = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM guru WHERE username='$username'"));
												if($cekuser>0) {
													$info = info("Username $username sudah ada!","NO");
												} else {
													if($pass1<>$pass2) {
														$info = info("Password tidak cocok!","NO");
													} else {
														$password = password_hash($pass1,PASSWORD_BCRYPT);
														$exec = mysqli_query("INSERT INTO guru (nip,nama,username,password,level) VALUES ('$nip','$nama','$username','$password','guru')");
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
											$value = mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM guru WHERE id_guru='$id'"));
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
														$exec = mysqli_query("UPDATE guru SET nip='$nip',nama='$nama',username='$username',password='$password' WHERE id_guru='$id'");
													}
												} else {
													$exec = mysqli_query("UPDATE guru SET nip='$nip',nama='$nama',username='$username' WHERE id_guru='$id'");
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
															
														</tr>
													</thead>
													<tbody>";
													$gurukuQ = mysqli_query($conn,"SELECT * FROM kelas ORDER BY nama ASC");
													while($adm = mysqli_fetch_array($gurukuQ)) {
														$no++;
														echo "
															<tr>
																<td>$no</td>
																<td>$adm[nama]</td>
																
															</tr>
														";
													}
													echo "
													</tbody>
												</table>
											</div><!-- /.box-body -->
										</div><!-- /.box -->
									</div>

								</div>
							";
						}
						elseif($pg=='pengaturan') {
							$info1 = $info2 = $info3 = $info4 = '';
							if(isset($_POST['submit1'])) {
								$alamat = nl2br($_POST['alamat']);
								$header = nl2br($_POST['header']);
								$exec = mysqli_query($conn,"UPDATE setting SET aplikasi='$_POST[aplikasi]',sekolah='$_POST[sekolah]',kepsek='$_POST[kepsek]',nip='$_POST[nip]',alamat='$alamat',telp='$_POST[telp]',fax='$_POST[fax]',web='$_POST[web]',email='$_POST[email]',header='$header' WHERE id_setting='1'");
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
											$exec = mysqli_query($conn,"UPDATE setting SET logo='$dest' WHERE id_setting='1'");
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
										$exec = mysqli_query($conn,"UPDATE guru SET nip='$nip',nama='$nama',jabatan='$jabatan',username='$username',password='$password' WHERE level='guruku'");
										(!$exec) ? $info2 = info('Gagal menyimpan pengaturan!','NO') : $info2 = info('Pengaturan disimpan!','OK');
									}
								} else {
									$exec = mysqli_query($conn,"UPDATE guru SET nip='$nip',nama='$nama',jabatan='$jabatan',username='$username' WHERE level='guruku'");
									(!$exec) ? $info2 = info('Gagal menyimpan pengaturan!','NO') : $info2 = info('Pengaturan disimpan!','OK');
								}
							}
							if(isset($_POST['submit3'])) {
								$password = $_POST['password'];
                                if(!password_verify($password,$guru['password'])) {
                                    $info4 = info('Password salah!','NO');
                                } else {
                                    if(!empty($_POST['data'])) {
                                        $data = $_POST['data'];
                                        if($data<>'') {
                                            foreach($data as $table) {
                                                if($table<>'guru') {
                                                    mysqli_query("TRUNCATE $table");
                                                } else {
                                                    mysqli_query($conn,"DELETE FROM $table WHERE level!='guruku'");
                                                }
                                            }
                                            $info4 = info('Data terpilih telah dikosongkan!','OK');
                                        }
                                    }
                                }
							}
							$guruku = mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM guru WHERE level='guruku' AND nip=$guru[nip]"));
							$setting = mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM setting WHERE id_setting='1'"));
							$setting['alamat'] = str_replace('<br />','',$setting['alamat']);
							$setting['header'] = str_replace('<br />','',$setting['header']);
							echo "
								<div class='row'>
									
									<div class='col-md-6'>
										<form action='' method='post'>
											<div class='box box-primary'>
												<div class='box-header with-border'>
													<h3 class='box-title'>Pengaturan Guru</h3>
													<div class='box-tools pull-right btn-group'>
														<button type='submit' name='submit2' class='btn btn-sm btn-primary'><i class='fa fa-check'></i> Simpan</button>
													</div>
												</div><!-- /.box-header -->
												<div class='box-body'>
													$info2
													<div class='form-group'>
														<label>NIP</label>
														<input type='text' name='nip' value='$guruku[nip]' class='form-control' required='true' disabled='disabled'/>
													</div>
													<div class='form-group'>
														<label>Nama</label>
														<input type='text' name='nama' value='$guruku[nama]' class='form-control' required='true' disabled='disabled'/>
													</div>
													<div class='form-group'>
														<label>Jabatan</label>
														<input type='text' name='jabatan' value='$guruku[jabatan]' class='form-control' required='true' disabled='disabled'/>
													</div>
													<div class='form-group'>
														<label>Username</label>
														<input type='text' name='username' value='$guruku[username]' class='form-control' required='true' disabled='disabled'/>
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
							$('#waktu').load('$homeurl/guru/_load.php?pg=waktu');
							$('#log-list').load('$homeurl/guru/_load.php?pg=log');
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
