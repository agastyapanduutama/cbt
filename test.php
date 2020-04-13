<?php 
include "config/server.php"; 

	$user = 'admin';
	$xkodesoal = 'awseducation-0503200136';
	$xtokenujian = 'XFWZT';

$cek = mysqli_num_rows(mysqli_query($sqlconn, "SELECT * FROM cbt_jawaban where XKodeSoal = '$xkodesoal' and XUserJawab = '$user' and XTokenUjian = '$xtokenujian'"));
if($cek<1){  
$hit = 1;

	$a=array("1","2","3","4");

	$A1 = $a[0];
	$B1 = $a[1];
	$C1 = $a[2];
	$D1 = $a[3];

	$r2[XNomerSoal];
	$r2[XKunciJawaban];
	$tglbuat;
	$xkodekelasx;
	$xkodejurusx;
	$xkodeujianx;
	$xsetidx;
	$xkodemapel;
	$xsemester;


	$sql = mysqli_query($sqlconn, "
		INSERT INTO cbt_jawaban (Urut,XNomerSoal,XUserJawab,XKodeSoal,XTokenUjian,XKunciJawaban,XA,XB,XC,XD,XTglJawab,XJenisSoal,XKodeKelas,XKodeJurusan,XKodeUjian,XSetId,XKodeMapel,XSemester) 
		VALUES 	
		('$hit','$r2[XNomerSoal]','$user','$xkodesoal','$xtokenujian','$r2[XKunciJawaban]','$A1','$B1','$C1','$D1','$tglbuat','1','$xkodekelasx','$xkodejurusx','$xkodeujianx','$xsetidx','$xkodemapel','$xsemester')
		"); 
	$hit = $hit+1;

}

 ?>