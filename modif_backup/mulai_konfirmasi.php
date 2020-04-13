<?php 

include "config/server.php";

// var_dump($_REQUEST['KodeNik']);
// var_dump($_REQUEST['NamaPeserta']);
// var_dump($_REQUEST);
error_reporting(0);
$nrp_peserta            = $_REQUEST['KodeNik'];
// $nama_peserta           = $_REQUEST['nama_peserta'];
$kelas           		= "Bahasa Inggris";
$kode           		= "ALL";
$no_ujian         		= "123";

// echo $_REQUEST['KodeToken'];
echo "<br>";

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
    WHERE 
    -- (u.XKodeKelas = '$xkelz' OR u.XKodeKelas = 'ALL') AND 
    (u.XKodeJurusan = '$xjurz' OR u.XKodeJurusan = 'ALL')   
    AND u.XTglUjian = '$tglujian' 
    AND u.XJamUjian <= '$xjam1'
    AND u.XStatusUjian = '1'
    ");

$s = mysqli_fetch_array($sqluser);

$xtokenujian = $s['XTokenUjian'];  

	$sql = "SELECT u.*,m.XNamaMapel FROM `cbt_ujian` u 
		    LEFT JOIN cbt_paketsoal p ON p.XKodeKelas = u.XKodeKelas 
		    AND p.XKodeMapel = u.XKodeMapel
		    left join cbt_mapel m ON u.XKodeMapel = m.XKodeMapel 
		    WHERE (u.XKodeJurusan = '$xjurz' OR u.XKodeJurusan = 'ALL')   
		    AND u.XStatusUjian = '1'";
	$result = $sqlconn->query($sql);
	$row = $result->fetch_assoc();

	if ($result->num_rows > 0) {
	    while($row = $result->fetch_assoc()) {
	        // echo $row['XTokenUjian']; echo "  ";
	    }
	}

	$tglna = date("Y-m-d");

	$awsna = mysqli_query($sqlconn, "
		SELECT XTokenUjian FROM cbt_ujian 
		WHERE XTglUjian = '$tglna'
		");
	$cek_token = mysqli_fetch_array($awsna);

	$token = $_POST['KodeToken'];

	// echo $up['XTokenUjian'];


		
	// print_r($awsna);
	session_start();
	$_SESSION['token'] = $token;
	// print_r($_SESSION);

	if (isset($token)) {

		foreach ($awsna as $tokenna) {
			 $tokennya = $tokenna['XTokenUjian'];

			 if ($tokennya == $token ) {
			 	
			 	include 'mulai.php';

			 }elseif ($tokennya != $token){

				header('Location:konfirm_peserta.php?salah=1&nrp_peserta='.$nrp_peserta.'&nama_peserta='.$_SESSION['nama_peserta'].'&kelas='.$kelas.'&kode='.$kode);

			 }

		}

	}

}
?>
