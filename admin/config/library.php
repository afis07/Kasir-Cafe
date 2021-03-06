<?php
defined("BASEPATH") or exit(header("location: ../../media.php?module=home")); 
?>
<?php      
// konversi menjadi nama hari bahasa indonesia
date_default_timezone_set('Asia/Jakarta');
$seminggu = array("Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu");
$hari     = date("w");
$hari_ini = $seminggu[$hari]; // konversi menjadi hari bahasa indonesia

$tgl_sekarang = date("Ymd");
$thn_sekarang = date("Y");
$bln_sekarang = date("M");
$jam_sekarang = date("H:i:s");

// format penanggalan di database MySQL
$tanggal=date("Y-m-d"); 

// fungsi untuk mengubah tanggal menjadi format bahasa indonesia, contoh: 14 Maret 2014 
function tgl_indo($tgl){
	$tanggal = substr($tgl,8,2);
	$bulan   = ambilbulan(substr($tgl,5,2)); // konversi menjadi nama bulan bahasa indonesia
	$tahun   = substr($tgl,0,4);
	return $tanggal.' '.$bulan.' '.$tahun;		 
}	

// fungsi untuk mengubah angka bulan menjadi nama bulan
function ambilbulan($bln){
  if ($bln=="01") return "Januari";
  elseif ($bln=="02") return "Februari";
  elseif ($bln=="03") return "Maret";
  elseif ($bln=="04") return "April";
  elseif ($bln=="05") return "Mei";
  elseif ($bln=="06") return "Juni";
  elseif ($bln=="07") return "Juli";
  elseif ($bln=="08") return "Agustus";
  elseif ($bln=="09") return "September";
  elseif ($bln=="10") return "Oktober";
  elseif ($bln=="11") return "November";
  elseif ($bln=="12") return "Desember";
} 

// fungsi untuk mengubah susunan format tanggal
function ubah_tgl($tanggal) { 
   $pisah   = explode('/',$tanggal);
   $larik   = array($pisah[2],$pisah[1],$pisah[0]);
   $satukan = implode('-',$larik);
   return $satukan;
}

function ubah_tgl2($tanggal) { 
   $pisah   = explode('-',$tanggal);
   $larik   = array($pisah[2],$pisah[1],$pisah[0]);
   $satukan = implode('/',$larik);
   return $satukan;
}

function anti_injection($data,$link){
  $d = stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES)));
  $filter = mysqli_real_escape_string($link,$d);
  return $filter;
}

function filcar($data=""){
	$d = stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES)));
	return $d;
}

function rupiah($angka){
	
	$hasil_rupiah = number_format($angka,0,',','.');
	return $hasil_rupiah;
}

?>
