<?php 

// $nrp_peserta            = '90001';
// $nama_peserta           = 'Atang Komar';
$nrp_peserta            = $_REQUEST['nrp_peserta'];
$nama_peserta           = $_REQUEST['nama_peserta'];
$kelas           		= "Bahasa Inggris";
$kode           		= "ALL";

session_start($nrp_peserta, $nama_peserta);
// session_start($nama_peserta);

include "ip.php";
$tglbuat = date("Y-m-d");
$sqlcekdb = mysqli_query($sqlconn, "SELECT * FROM `cbt_peserta` limit 1");
if (!$sqlcekdb){
	header('Location:login.php?salah=2');
	// echo "HELLO WORLD";
	// break;
}
 
if(isset($_COOKIE['PESERTA'])&&isset($_COOKIE['KUNCI'])){
	$user = "$_COOKIE[PESERTA]"; 
	$pass = "$_COOKIE[KUNCI]";
	$txtuser = $nrp_peserta;
	$txtpass = $nama_peserta; 
} 
else {	
	$txtuser = str_replace(" ","",$nrp_peserta);
	$txtpass = str_replace(" ","",$nama_peserta);
	setcookie('PESERTA',$txtuser);
	setcookie('KUNCI',$txtpass);
	$user = "$txtuser";
	$pass = "$txtpass";}

$sqllogin = mysqli_query($sqlconn, "SELECT * FROM  `cbt_peserta` WHERE nrp_peserta = '$txtuser' ");
$sis = mysqli_fetch_array($sqllogin);
$val_siswa = $sis['nama_peserta'];
$xkelz = $sis['kode_kelas'];
$xnamkel = $sis['nama_kelas'];  
$xjurz = 'ALL';
$xsesi = '1'; 

$jmlsqllogin = mysqli_num_rows($sqllogin);
if($jmlsqllogin<1){ 
	header('Location:login.php?salah=1&jumlah='.$jmlsqllogin); 
}


$tglujian = date("Y-m-d");
$xjam1 = date("H:i:s");

$sqluser = mysqli_query($sqlconn, "	
	SELECT u.*,m.XNamaMapel FROM `cbt_ujian` u 
	LEFT JOIN cbt_paketsoal p ON p.XKodeKelas = u.XKodeKelas 
	AND p.XKodeMapel = u.XKodeMapel	
	LEFT JOIN cbt_mapel m ON u.XKodeMapel = m.XKodeMapel 
	WHERE (u.XKodeKelas = '$xkelz' OR u.XKodeKelas = 'ALL') 
	AND (u.XKodeJurusan = '$xjurz' OR u.XKodeJurusan = 'ALL') 
	AND u.XTglUjian = '$tglujian' AND u.XJamUjian <= '$xjam1'	
	AND u.XStatusUjian = '1'
	");

	$s = mysqli_fetch_array($sqluser);
	$xkodesoal = $s['XKodeSoal'];
	$xkodekelas = $s['XKodeKelas'];
	$xkodejurusan = $s['XKodeJurusan'];
	$xtglujian = $s['XTglUjian'];  
	$xkodemapel = $s['XKodeMapel'];
	$xjumlahsoal = $s['XJumSoal'];
	$xtokenujian = $s['XTokenUjian'];  
	$xlamaujian= $s['XLamaUjian'];
	$xjamujian= $s['XJamUjian'];    
	$xbatasmasuk= $s['XBatasMasuk'];   
	$xnamamapel = $s['XNamaMapel'];
	$xstatustoken = $s['XStatusToken'];
  
  
$sqlada0 = mysqli_query($sqlconn, "SELECT * FROM  `cbt_siswa_ujian` WHERE XNomerUjian = '$txtuser' and XTokenUjian = '$xtokenujian'");
	$ad0 = mysqli_fetch_array($sqlada0);
	$user_ip2 = str_replace(" ","",$ad0['XGetIP']);
	$user_ip1 = $user_ip;
 
if($user_ip1<>$user_ip2&&!$user_ip2==""){
	// header('Location:login.php?salah=3');
	echo "hello world";
}
  

?>
<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title><?php echo $skull;?>  | UJIAN BERBASIS KOMPUTER</title>
	<script language="JavaScript">
		var txt="<?php echo $skull;?>  | UJIAN BERBASIS KOMPUTER......";
		var kecepatan=100;var segarkan=null;function bergerak() { document.title=txt;
		txt=txt.substring(1,txt.length)+txt.charAt(0);
		segarkan=setTimeout("bergerak()",kecepatan);}bergerak();
	</script>
	<link href='images/icon.png' rel='icon' type='image/png'/>
	<meta name="description" content="">    
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script>
		function disableBackButton() {window.history.forward();}
		setTimeout("disableBackButton()", 0);
	</script>
	<style>
    .no-close .ui-dialog-titlebar-close {display: none;}
	</style>
	<style>
		.left {float: left; width: 65%;}
		.right {float: right; width: 30%; background-color: #333333; height:101px; color:#FFFFFF;	
			font-size: 13px; font-style:normal; font-weight:normal;}
		.user {color:#FFFFFF; font-size: 15px; font-style:normal; font-weight:bold;	top:-20px;}
		.log {color:#3799c2; font-size: 11px; font-style:normal; font-weight:bold; top:-20px;}
		.group:after {content:""; display: table; clear: both;}
		/*	img {max-width: 100%; height: auto;}	*/
		.visible{display: block !important;}
		.hidden{display: none !important;}
		.foto{height:80px;}	
		@media screen and (max-width: 780px) { /* jika screen maks. 780 right turun */
		/*    .left, */
		.left,
		.right {float: none; width: auto; margin-top:0px; height:91px; color:#FFFFFF; display:block;}
		.foto{height:65px;}}
		@media screen and (max-width: 400px) { /* jika screen maks. 780 right turun */
		/*    .left, */
		.left{width: auto; height: 91px;}
		.right {float: none; width: auto; margin-top:0px; height:60px; color:#FFFFFF;}
		.foto{height:40px;}	}
	</style>
	<link href="mesin/css/klien.css" rel="stylesheet">
	<link rel="stylesheet" href="mesin/css/bootstrap2.min.css">
    <script src="mesin/js/inline.js"></script>
	<?php 	include "config/server.php";
			$sql = mysqli_query($sqlconn, "select * from cbt_admin");
			$r = mysqli_fetch_array($sql);
	?>

<body class="font-medium" style="background-color:#c9c9c9">
<header style="background-color:<?php echo "$r[XWarna]"; ?> ; ">
<div class="group">
    <div class="left" style="background-color:<?php echo "$r[XWarna]"; ?>"><img src="images/<?php echo "$r[XBanner]"; ?>" style=" margin-left:0px;"></div>
    	<div class="right">
			<table width="100%" border="0" cellspacing="5px;" style="margin-top:10px">   
				<tr><td rowspan="3" width="100px" align="center"></td></tr>
				<tr><td><span class="user"><?php echo "$val_siswa <br>"; ?></span></td></tr>
				<!-- <tr><td><span class="user"><?php echo "$val_siswa <br>($xnamkel)"; ?></span></td></tr> -->
				<tr><td><span class="log"><a href="logout.php">Logout</a><span></td></tr>
			</table>
        </div>
           
</div>
</div> 
</div>         
</header>

<ul>
  	<div id="myerror" class="alert alert-danger" role="alert" style=" font-size: 13px; font-style:normal; font-weight:normal; margin-left:-40px; padding-left:30px;">
		<?php 	if(isset($_REQUEST['salah'])){if($_REQUEST['salah']==1)
				{echo "<b><ul><li>Kode TOKEN Tidak sesuai</li></ul></b>";} } 
		?>
	</div>
</ul>
    
<div  class="col-md-6 col-md-offset-3 login-wrapper" style="float:inherit">
<div class="panel panel-default">

<form action="mulai_konfirmasi.php" method="post">    

                <div class="list-group-item top-heading">
                    <h1 class="list-group-item-heading page-label">Konfirmasi Data Peserta</h1>
                </div>
                <div class="list-group-item">
                    <label class="list-group-item-heading">NRP Peserta</label>
                    <p class="list-group-item-text"><?php echo "$user"; ?></p>
                    <!--<input id="KodeNik" name="KodeNik" type="hidden" value="<?php echo "$user"; ?>">!-->
                    <input id="KodeNik" name="KodeNik" type="hidden" value="<?php echo "$user"; ?>">
                </div>
                <div class="list-group-item">
                    <label class="list-group-item-heading">Nama Peserta</label>
                    <p class="list-group-item-text"><?php echo "$val_siswa "; ?></p>
                    <input id="NamaPeserta" name="NamaPeserta" type="hidden" value="glyphicon-warning-sign">
                </div>
                  <div class="list-group-item">
                    <label class="list-group-item-heading">Status Peserta</label>
                    <p class="list-group-item-text"><?php echo "($xkelz | $xnamkel)"; ?></p>
                    <!-- <p class="list-group-item-text"><?php echo "($xkelz | $xnamkel)"; ?></p> -->
                    <input id="NamaPeserta" name="NamaPeserta" type="hidden" value="glyphicon-warning-sign">
                </div>
                 <div class="list-group-item">
                    <label class="list-group-item-heading">Mata Pelajaran</label>
                    <p class="list-group-item-text"> Bahasa Inggris</p>
                    <input id="NamaPeserta" name="NamaPeserta" type="hidden" value="glyphicon-warning-sign">
                </div>
               
<?php 	$sqlada = mysqli_query($sqlconn, "SELECT * FROM  `cbt_siswa_ujian` WHERE XNomerUjian = '$txtuser' and XTokenUjian = '$xtokenujian'");
		$ad = mysqli_fetch_array($sqlada);
		$jumsis = $ad['XStatusUjian'];
		$ada = mysqli_num_rows($sqlada);
 
		$sqlt = mysqli_query($sqlconn, "
			SELECT * FROM  `cbt_ujian`
			WHERE XKodeSoal ='$xkodesoal'
			AND (XKodeKelas = '$xkelz' OR XKodeKelas = 'ALL') 
			AND (XKodeJurusan = '$xjurz' OR XKodeJurusan = 'ALL') 
			AND XStatusUjian = '1' AND (XSesi =  '$xsesi' OR XSesi = 'ALL') 
			AND XTglUjian = '$tglbuat'
			 ") ;
		$ttt = mysqli_fetch_array($sqlt);
		$xbatasmasuk = $ttt['XBatasMasuk'];
		$xtokuj = $ttt['XTokenUjian'];
?>
<?php	$sqlcekujian = mysqli_num_rows(mysqli_query($sqlconn, "
	SELECT * FROM cbt_ujian 
	WHERE(XKodeKelas = '$xkelz' OR XKodeKelas = 'ALL') 
	AND (XKodeJurusan = '$xjurz' OR XKodeJurusan = 'ALL') 
	AND XStatusUjian = '1' 
	AND (XSesi =  '$xsesi' OR XSesi = 'ALL')
	"));

		if($sqlcekujian>0){ ?><!-- 
                <div class="list-group-item">
                    <label class="list-group-item-heading">Mata Pelajaran </label>
                    <p class="list-group-item-text"><?php echo "$xnamamapel"; ?></p>
                    <input id="KodePaket" name="KodePaket" type="hidden" value="IPA - SMP">
                </div> -->
                
		<?php if(($xjam1<=$xbatasmasuk&&$xjam1>=$xjamujian)&&($tglujian==$xtglujian)&&($jumsis!=='9')){	?>                
                <div class="list-group-item">
                    <label class="list-group-item-heading">Masukkan TOKEN <?php // echo "$jumsis = $ada"; ?> </label>
                    <div class="list-group-item-text">
                    <input autocomplete="off" class="input-upper input-token form-control field-xs" data-val="true" data-val-required="Kode token wajib diisi" id="KodeToken" maxlength="20" name="KodeToken" placeholder="masukan token" type="text" value=""></div>
					<div class="list"><br>TOKEN Anda: --oO[<span style="color: #ff0000;"><b>
						<?php 	if($xstatustoken==1) {
									echo "$xtokuj";
								}else{
									echo "Minta dari Proktor";
								}
						?></b></span>]Oo--</div>

						<?php var_dump($xstatustoken); ?>
                </div>
                <div class="list-group-item">
                    <div class="row">
                        <div class="col-xs-push-7 col-xs-5"><br>
                            <button type="submit" class="btn btn-success btn-block doblockui">SUBMIT</button>
                        </div>
                    </div>
                </div>
 
		 <?php } else { ?>
         		<div class="list-group-item">
                    <label class="list-group-item-heading">Status Ujian <?php // echo "$jumsis = $ada"; ?></label>
                    <div class="list-group-item-text">
                    <?php if($jumsis=='9'){ ?>
                    <p class="list-group-item-text">Status Tes sudah SELESAI</p>
                    <?php } elseif($xjam1<$xjamujian||$tglujian!==$xtglujian){ ?>
                    <p class="list-group-item-text">Tidak Ada Jadwal Ujian</p>
                    <?php } elseif($xjam1>=$xjamujian&&$xjam1>$xbatasmasuk){ ?>
                    <p class="list-group-item-text">Terlambat Untuk Mengikuti Ujian</p>
                    <?php } ?>
                    </div>
                </div>
  		<?php } ?> 
               
		<?php } else { ?>
         		<div class="list-group-item">
                    <label class="list-group-item-heading">Status Ujian<?php // echo "$jumsis / $ada"; ?> </label>
                    <div class="list-group-item-text">
                    <p class="list-group-item-text">Tidak ada Mata Uji AKTIF</p>
                    </div>
                </div>

<?php } ?>

    </div>
</form>     
<script>
  // ketika document sudah siap (termasuk jquery sudah terload)
  $(document).ready(function() {
    // tunggu jika ada input di element yang punya class 'input-upper'
    $('.input-upper').bind('input', function() {
      // ubah nilainya menjadi kapital
      $(this).val($(this).val().toUpperCase())
    })
  })
</script>  
</div>
</div>
<div id="buntut"  >
<div style="margin-top:00px; bottom:50px; background-color:#dcdcdc; padding:7px; font-size:12px">
    <div class="content">
       DIANGLOBAL-TECH-CBT : <strong> v3_Rev3</strong><br>
        Modified @2017 by MBA
    </div>
</div>

                <!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="panel-default">
                <div class="panel-heading">
                    <h1 class="panel-title page-label">Konfirmasi Tes</h1>
                </div>
                <div class="panel-body">
                    <div class="inner-content">
                        <div class="wysiwyg-content">
                            <p>
                                Terimakasi telah berpartisipasi dalam tes ini.<br>
                                Silahkan klik tombol LOGOUT untuk mengakhiri test.                            </p>
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                    <div class="row">
                        <div class="col-xs-offset-3 col-xs-6">
                            <button type="submit" class="btn btn-success btn-block" data-dismiss="modal">LOGOUT</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<footer>
    <div  style=" background-color:<?php echo "$r[XWarna]"; ?>; padding:7px; font-size:12px"">
        <p><b><span style="color: #ff0000;"><?php echo strtoupper("$r[XSekolah]"); ?> </b><br> <span style="color: #1B06CF;">Supported by DIANGLOBAL-TECH</span></p>
    </div>
</footer>
    <script src="mesin/js/jquery.cookie.js"></script>
<script src="mesin/js/common.js"></script>
<script src="mesin/js/main.js"></script>
<script src="mesin/js/cookieList.js"></script>
<script src="mesin/js/backend.js"></script>

    


