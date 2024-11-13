<?php
	function picture($id,$w=100,$h=100) {
		$url = "//graph.facebook.com/$id/picture?width=$w&height=$h";
		return $url;
	}
	function jump($page) {
		echo "<script>location=('$page');</script>";
	}
	function info($string,$type=null) {
		if($type=='OK') {
			$class = "success";
			$icon = "fa-check";
		}
		elseif($type=='NO') {
			$class = "danger";
			$icon = "fa-warning";
		} else {
			$class = "warning";
			$icon = "fa-info-circle";
		}
		return "<p class='text-$class'><i class='fa $icon'></i> $string</p>";
	}
	function timeAgo($tanggal) {
		$ayeuna = date('Y-m-d H:i:s');
		$detik = strtotime($ayeuna)-strtotime($tanggal);
		if($detik<=0) {
			return "Baru saja";
		} else {
			if($detik<60) {
				return $detik." detik yang lalu";
			} else {
				$menit = $detik/60;
				if($menit<60) {
					return number_format($menit,0)." menit yang lalu";
				} else {
					$jam = $menit/60;
					if($jam<24) {
						return number_format($jam,0)." jam yang lalu";
					} else {
						$hari = $jam/24;
						if($hari<2) {
							return "Kemarin";
						}
						elseif($hari<3) {
							return number_format($hari,0)." hari yang lalu";
						} else {
							return $tanggal;
						}
					}
				}
			}
		}
	}
	function size($bytes=0) {
		$size = $bytes;
		$b = "B";
		if($size>1024) {
			$size = number_format($bytes/1024,2,'.','');
			$b = "KB";
			if($size>1024) {
				$size = number_format($bytes/1024/1024,2,'.','');
				$b = "MB";
				if($size>1024) {
					$size = number_format($bytes/1024/1024/1024,2,'.','');
					$b = "GB";
					if($size>1024) {
						$size = number_format($bytes/1024/1024/1024/1024,2,'.','');
						$b = "TB";
					}
				}
			}
		}
		$size = str_replace('.00','',$size);
		return $size.' '.$b;
	}
	function buat_tanggal($format,$time=null) {
		$time = ($time==null) ? time(): strtotime($time);
		$str = date($format,$time);
		for($t=1;$t<=9;$t++) {
			$str = str_replace("0$t ","$t ",$str);
		}
		$str = str_replace("Jan","Januari",$str);
		$str = str_replace("Feb","Februari",$str);
		$str = str_replace("Mar","Maret",$str);
		$str = str_replace("Apr","April",$str);
		$str = str_replace("May","Mei",$str);
		$str = str_replace("Jun","Juni",$str);
		$str = str_replace("Jul","Juli",$str);
		$str = str_replace("Aug","Agustus",$str);
		$str = str_replace("Sep","September",$str);
		$str = str_replace("Oct","Oktober",$str);
		$str = str_replace("Nov","Nopember",$str);
		$str = str_replace("Dec","Desember",$str);
		$str = str_replace("Mon","Senin",$str);
		$str = str_replace("Tue","Selasa",$str);
		$str = str_replace("Wed","Rabu",$str);
		$str = str_replace("Thu","Kamis",$str);
		$str = str_replace("Fri","Jum&#39;at",$str);
		$str = str_replace("Sat","Sabtu",$str);
		$str = str_replace("Sun","Minggu",$str);
		return $str;
	}
	function enum($bool) {
		$bool = ($bool==1) ? 'Ya' : 'Tidak';
		return $bool;
	}
	function html2str($str) {
		$str = str_replace('"',"”",$str);
		$str = str_replace("'","’",$str);
		$str = str_replace("<","&lt;",$str);
		$str = str_replace(">","&gt;",$str);
		return $str;
	}
?>