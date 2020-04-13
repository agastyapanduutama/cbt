<?php 

include "config/server.php";

// var_dump($_REQUEST['KodeNik']);
// var_dump($_REQUEST['NamaPeserta']);
// var_dump($_REQUEST);

$nrp_peserta            = $_REQUEST['KodeNik'];
// $nama_peserta           = $_REQUEST['nama_peserta'];
$kelas           		= "Bahasa Inggris";
$kode           		= "ALL";
$no_ujian         		= "123";



if(isset($_REQUEST['KodeNik'])){
 $txtuser = str_replace(" ","",$_REQUEST['KodeNik']);
 
	$sqllogin = mysqli_query($sqlconn, "SELECT * FROM  `cbt_peserta` WHERE nrp_peserta = '$txtuser'");
	$sis = mysqli_fetch_array($sqllogin);
	$val_siswa = $sis['nama_peserta'];
	$xkelz = $sis['kode_kelas'];
	$xnamkel = $sis['nama_kelas']; 
	$xjurz = 'ALL';
	 
	$tglujian = date("Y-m-d");
	$xjam1 = date("H:i:s");
	$user = "$_COOKIE[PESERTA]";

	$sqluser = mysqli_query($sqlconn, "
    SELECT u.*,m.XNamaMapel FROM `cbt_ujian` u 
    LEFT JOIN cbt_paketsoal p ON p.XKodeKelas = u.XKodeKelas 
    AND p.XKodeMapel = u.XKodeMapel
    left join cbt_mapel m ON u.XKodeMapel = m.XKodeMapel 
    WHERE (u.XKodeKelas = '$xkelz' OR u.XKodeKelas = 'ALL') 
    AND (u.XKodeJurusan = '$xjurz' OR u.XKodeJurusan = 'ALL')   
    AND u.XTglUjian = '$tglujian' 
    AND u.XJamUjian <= '$xjam1'
    AND u.XStatusUjian = '1'
    ");

$s = mysqli_fetch_array($sqluser);

$xtokenujian = $s['XTokenUjian'];  

if($_REQUEST['KodeToken']!==$xtokenujian){

$nrp_peserta            = $_REQUEST['KodeNik'];
$nama_peserta           = $val_siswa;
$kelas           		= "ALL";
$kode           		= "ALL";
$no_ujian         		= "123";

header('Location:konfirm_peserta.php?salah=1&nrp_peserta='.$nrp_peserta.'&nama_peserta='.$nama_peserta.'&kelas='.$kelas.'&kode='.$kode);


 echo "Token Salah";
 break;
 }else{

// $tglujian = date("Y-m-d");
// $xjam1 = date("H:i:s");

// $nana = mysqli_query($sqlconn, "	
// 	SELECT u.*,m.XNamaMapel FROM `cbt_ujian` u 
// 	LEFT JOIN cbt_paketsoal p ON p.XKodeKelas = u.XKodeKelas 
// 	AND p.XKodeMapel = u.XKodeMapel	
// 	LEFT JOIN cbt_mapel m ON u.XKodeMapel = m.XKodeMapel 
// 	WHERE (u.XKodeKelas = '$xkelz' OR u.XKodeKelas = 'ALL') 
// 	AND (u.XKodeJurusan = '$xjurz' OR u.XKodeJurusan = 'ALL') 
// 	AND u.XTglUjian = '$tglujian' AND u.XJamUjian <= '$xjam1'	
// 	AND u.XStatusUjian = '1'
// 	");

// $s = mysqli_fetch_array($nana);
// $xkodesoal = $s['XNamaMapel'];

// $updatesiswa = mysqli_query($sqlconn, "UPDATE `cbt-dianglobal-tech`.`cbt_peserta` SET `kode_kelas`='$xkodesoal' WHERE  `nrp_peserta`=$nrp_peserta");

 	include "mulai.php";
 }
}
?>
