<?php 

include "config/server.php";

$nrp_peserta            = $_REQUEST['nrp_peserta'];
$nama_peserta           = $_POST['nama_peserta'];
$kelas           		= "Bahasa Inggris";
$kode           		= "ALL";
$no_ujian         		= "123";

$queryna = mysqli_query($sqlconn,"SELECT * FROM cbt_peserta WHERE nrp_peserta='$nrp_peserta',XNomerUjian='$no_ujian',XSesi='1'");

$a = $nrp_peserta;
$b = $queryna;

$coba = mysqli_fetch_array($b);
$aa = $coba['nrp_peserta'];

if ($aa == $nrp_peserta) {
	echo "bener ";
	header('Location:login.php?salah=3');
	break;
}else{
	$query="INSERT INTO cbt_peserta SET nrp_peserta='$nrp_peserta',nama_peserta='$nama_peserta',nama_kelas='$kelas',kode_kelas='$kode'";
	mysqli_query($sqlconn, $query);

header('Location:konfirm_peserta.php?nrp_peserta='.$nrp_peserta.
									 '&nama_peserta='.$nama_peserta.
									 '&kelas='.$kelas.
									 '&kode='.$kode);

}

?>
