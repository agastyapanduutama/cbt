<?php
include "config/server.php";
if(isset($_COOKIE['PESERTA'])){
//echo "WAHA ";
}
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

$sqlselectna = mysqli_query($sqlconn, "SELECT * FROM cbt_peserta WHERE nrp_peserta = '$txtuser'");
$aws = mysqli_fetch_array($sqlselectna);
$kelasnana = $aws['kode_kelas'];

$awsnana =  $_POST['KodeToken'];

$sqlna = "SELECT u.*,m.XNamaMapel, l.nrp_peserta 
    FROM `cbt_ujian` u 
    LEFT JOIN cbt_paketsoal p ON p.XKodeKelas = u.XKodeKelas 
    AND p.XKodeMapel = u.XKodeMapel
    left join cbt_mapel m ON u.XKodeMapel = m.XKodeMapel 
    JOIN cbt_peserta l
    WHERE  
    (u.XKodeJurusan = '$xjurz' OR u.XKodeJurusan = 'ALL')   
    AND u.XTglUjian = '$tglujian' 
    AND u.XJamUjian <= '$xjam1'
    AND l.nrp_peserta = '$user' AND u.XStatusUjian = '1'
    AND XTokenUjian = '$awsnana'";

 $sqluser = mysqli_query($sqlconn, $sqlna);


// echo $sqlna;


  $s = mysqli_fetch_array($sqluser);
  $xkodesoal = $s['XKodeSoal'];
  session_start();
  $_SESSION['kode_kelas'] = $s['XKodeKelas'];
$upaws =   $_SESSION['kode_kelas'] = $s['XKodeKelas'];
// var_dump($xkodesoal);

  

    echo "<br>";
    $awd = $_SESSION['kodena'] = $xkodesoal;
    echo $awd;
    echo "<br>";


  $xkodekelas = $s['XKodeKelas'];
  echo "<br>";
  $xtglujian = $s['XTglUjian'];  
  $xkodemapel = $s['XKodeMapel'];
  $xjumlahsoal = $s['XJumSoal'];
  $xlamaujian= $s['XLamaUjian'];
  $xjamujian= $s['XJamUjian'];    
  $xbatasmasuk= $s['XBatasMasuk'];   
  $xnamamapel = $s['XNamaMapel'];
  $xkodejurusan = $s['XKodeJurusan'];
    
  $xtokenujian = $_REQUEST['KodeToken'];
  // $xtokenujian = $s['XTokenUjian'];

// echo $xjurz;
// echo $tglujian;
// echo $xjam1;

foreach ($sqluser as $upna) {
        if ($_REQUEST['KodeToken'] != $xtokenujian) {
            header('Location:konfirm_peserta.php?salah=1&nrp_peserta='.$nrp_peserta.'&nama_peserta='.$nama_peserta.'&kelas='.$kelas.'&kode='.$kode);
        }else{
            // include 'mulai.php';
            echo "";
        }
}


echo "<br>";
// echo $xtokenujian;
echo "<br>";

 if($_REQUEST['KodeToken']!==$xtokenujian){
// header('Location:konfirm.php?salah=1');
 echo "Token Salah";
 break;
 } 
}

if(isset($xkodesoalz)){ echo "
    SELECT *,s.XKodeKelas AS kelassiswa,u.XKodeSoal as kelsoal 
    FROM  `cbt_peserta` s 
    LEFT JOIN cbt_ujian u ON s.XKodeKelas = u.XKodeKelas
    LEFT JOIN cbt_mapel m ON  m.XKodeMapel = u.XKodeMapel
    WHERE XNomerUjian = '$user' AND u.XStatusUjian = '1'
    "; }


?>

<!DOCTYPE html>
<html class="no-js" lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title><?php echo $skull;?> | UJIAN BERBASIS KOMPUTER</title>
    <script language="JavaScript">
	var txt="<?php echo $skull;?>  | UJIAN BERBASIS KOMPUTER......";
	var kecepatan=100;var segarkan=null;function bergerak() { document.title=txt;
	txt=txt.substring(1,txt.length)+txt.charAt(0);
	segarkan=setTimeout("bergerak()",kecepatan);}bergerak();
	</script>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link href='images/icon.png' rel='icon' type='image/png'/>
	
    <script>
        function disableBackButton() {
            window.history.forward();
        }
        setTimeout("disableBackButton()", 0);
    </script>
    
<style>
    .no-close .ui-dialog-titlebar-close {
        display: none;
    }
</style>
<script src="mesin/js/inline.js"></script>
<main>
        
<style>
.left {
    float: left;
    width: 70%;
}
.right {
    float: right;
    width: 30%;
	background-color: #333333;
			height:101px;	
		color:#FFFFFF;	
		font-size: 13px; font-style:normal; font-weight:normal;
}
.user {
		color:#FFFFFF;	
		font-size: 15px; font-style:normal; font-weight:bold;
		top:-20px;
}
.log {
		color:#3799c2;	
		font-size: 11px; font-style:normal; font-weight:bold;
		top:-20px;
}
.group:after {
    content:"";
    display: table;
    clear: both;
	
}
/*
img {
    max-width: 100%;
    height: auto;
}
*/

.visible{
    display: block !important;
}

.hidden{
    display: none !important;
}
.foto{height:80px;}	
@media screen and (max-width: 780px) { /* jika screen maks. 780 right turun */
/*    .left, */
    .left,
    .right {
        float: none;
        width: auto;
		margin-top:0px;
		height:91px;
		color:#FFFFFF;
		display:block;	
    }
.foto{height:65px;}		
}
@media screen and (max-width: 400px) { /* jika screen maks. 780 right turun */
/*    .left, */
    .left{width: auto;    height: 91px;}
    .right {
        float: none;
        width: auto;
		margin-top:0px;
		height:60px;
		color:#FFFFFF;
    }
.foto{height:40px;}	
}
</style>

<style>
.kiri {
    float: left;
    width: 59%;
}
.kanan {
    float: right;
    width: 40%;
		font-size: 13px; font-style:normal; font-weight:normal;
}
.grup:after {
    content:"";
    display: table;
    clear: both;
	
	
}
@media screen and (max-width: 780px) { /* jika screen maks. 780 right turun */
    .kiri,
    .kanan {
		margin-top:10px;
        float: none;
        width: auto;
		display:block;	
    }
}
@media screen and (max-width: 400px) { /* jika screen maks. 780 right turun */
    .kiri{width: auto;}
    .kanan {
        float: none;
		margin-top:10px;
        width: auto;
    }
}
</style>


<link href="mesin/css/klien.css" rel="stylesheet">
<link rel="stylesheet" href="mesin/css/bootstrap2.min.css">

    <script src="mesin/js/inline.js"></script>
<?php 
include "config/server.php";
$sql = mysqli_query($sqlconn, "select * from cbt_admin");
$r = mysqli_fetch_array($sql);
?>
<body class="font-medium" style="background-color:#c9c9c9">
<header style="background-color:<?php echo "$r[XWarna]"?> ;">
<div class="group">
    <div class="left" style="background-color:<?php echo "$r[XWarna]"; ?>"><img src="images/<?php echo "$r[XBanner]"; ?>" style=" margin-left:0px;"></a></div>

	<div class="right">	<table width="100%" border="0" cellspacing="5px;" style="margin-top:10px">   
							<tr><td rowspan="5" width="100px" align="center"><img src="./fotosiswa/<?php echo "$gambar"; ?>" style=" margin-left:0px; margin-top:5px" class="foto"></td></tr>
							
							<tr><td><span class="user"><?php echo "$val_siswa <br> ($xkodekelas-$xjurz)"; ?></span></td></tr>
							<tr><td><span class="log"><a href="logout.php">Logout</a><span></td></tr>
							</tr>
						</table>
                        </div>
           
      	</div>
	</div> 
</div>         
</header>
<ul>
  	
	<div id="myerror" class="alert alert-danger" role="alert" style=" font-size: 13px; font-style:normal; font-weight:normal; margin-left:-40px; padding-left:30px;">
    
	</div>
</ul>
<div class="grup" style="width:70%; margin:0 auto; margin-top:50px">
<div class="kiri">
            <form action="puspendik.php" method="post">    
                            <div class="list-group-item top-heading">
                                <h1 class="list-group-item-heading page-label">Konfirmasi Data Tes </h1>
                            </div>
            
                            <div class="list-group-item">
                                <label class="list-group-item-heading">Kode Tes</label>
                                <p class="list-group-item-text">
                                <?php if(isset($xkodesoal)){ echo "$xkodesoal"; } ?>



                                </p>
                                <!--<input id="KodeNik" name="KodeNik" type="hidden" value="21605111610018">!-->
                                <input id="KodeNik" name="KodeNik" type="hidden" value="<?php echo "$user"; ?>">
                            </div>
            
                            <div class="list-group-item">
                                <label class="list-group-item-heading">Status Peserta</label>
                                <p class="list-group-item-text">
                                    NRP Peserta : <?php echo "$txtuser"; ?> <br>
                                    Nama Peserta : <?php echo "$val_siswa"; ?><br><br>
                                    <!-- <?php echo "($xkodekelas-$xjurz | $xnamkel)"; ?> -->
                                </p>
                                <input id="NamaPeserta" name="NamaPeserta" type="hidden" value="">
                            </div>
                            <div class="list-group-item">
                                <label class="list-group-item-heading">Mata Uji Tes  -  Token</label>
                                    <p class="list-group-item-text">
                                        <?php echo "$kelasnana"; ?>
                                        <?php echo "- [ $xtokenujian ]"; ?>
                                    </p>
                                <input id="Gender" name="Gender" type="hidden" value="Pria">
                            </div>
            
            <?php 
            $sqlcekujian = mysqli_num_rows(mysqli_query($sqlconn, "SELECT * FROM cbt_ujian where XKodeKelas = '$xkodekelas' and XStatusUjian = '1'"));
            if($sqlcekujian>0){ 
            $xtglujian0 = strtotime($xtglujian);
            $xtglujian1 = date('d/m/Y', $xtglujian0);
            $xtglujian2 = date('d/M/Y', $xtglujian0);
            $j1 = substr($xlamaujian,0,2)*60;
            $m1 = substr($xlamaujian,3,2);
            $jumtotwaktu = $j1+$m1;
			
            ?>
            
                            <div class="list-group-item">
                                <label class="list-group-item-heading">Tanggal Tes </label>
                                <p class="list-group-item-text"><?php echo "$xtglujian2"; ?></p>
                                <input id="KodePaket" name="KodePaket" type="hidden" value="IPA - SMP">
                            </div>
                              <div class="list-group-item">
                                <label class="list-group-item-heading">Waktu Tes Dibuka </label>
                                <p class="list-group-item-text"><?php echo "$xjamujian - $xbatasmasuk"; ?></p>
                            </div>
                             <div class="list-group-item">
                                <label class="list-group-item-heading">Alokasi Waktu Tes </label>
                                <p class="list-group-item-text"><?php echo "$jumtotwaktu menit"; ?></p>
                            </div>
            <?php } ?>
            
            </form>
</div>

<div class="kanan">

	<div id="myerror" class="alert alert-warning" role="alert" style="font-size: 13px; font-style:normal; font-weight:normal">
    <i class="glyphicon glyphicon-warning-sign"></i>  
    <font size="3px">Tombol MULAI hanya akan aktif apabila waktu sekarang sudah melewati waktu mulai tes. Tekan tombol F5 untuk merefresh halaman</font>
    </div>

    <?php 

    include "config/function.php";

    $audio = query_get_row("SELECT * FROM cbt_audio WHERE kode_bank = '$xkodesoal'"); 

    $val_audio =  $audio['nama_audio'];

     ?>

    <?php if ($val_audio != "" ) {?>

    <script type="text/javascript">
    // Popup window code
    function newPopup(url) {
        popupWindow = window.open(
            url,'popUpWindow','height=170,width=440,left=10,top=10,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no,status=yes')
    }

    </script>
    <!-- <a href="ujian.php" href="JavaScript:newPopup('audio.php');"></a> -->

    <a href="ujian.php" onclick="JavaScript:newPopup('audio.php');"> 
        <button type="submit" class="btn btn-danger btn-block doblockui">MULAI</button>
    </a>

    <?php }else{ ?>
        <a href="ujian.php"> 
            <button type="submit" class="btn btn-danger btn-block doblockui">MULAI</button>
        </a>
    <?php } ?>
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
                                Silahkan klik tombol LOGOUT untuk mengakhiri test.
                            </p>
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
<br>
<br>
<!--
<div id="buntut"  ><div><br></div>
<br>
<footer>
    <div  style=" background-color:<?php echo "$r[XWarna]"; ?>; padding:7px; font-size:12px"">
        <p><b><span style="color: #ff0000;"><?php echo strtoupper("$r[XSekolah]"); ?> </b>| <span style="color: #1B06CF;">Supported by DIANGLOBAL-TECH</span></p>
    </div>
</footer>
-->
<footer style=" width:100%;bottom:0px; background-color:<?php echo "$r[XWarna]"; ?>; position:absolute; margin-top:50px">
    <div class="container" style=" font-size:12px">
        <p><b><span style="color: #ff0000;"><?php echo strtoupper("$r[XSekolah]"); ?> </b><br> <span style="color: #1B06CF;">Supported by DIANGLOBAL-TECH</span></p>
    </div>
</footer>
<script src="mesin/js/jquery.cookie.js"></script>
<script src="mesin/js/common.js"></script>
<script src="mesin/js/main.js"></script>
<script src="mesin/js/cookieList.js"></script>
<script src="mesin/js/backend.js"></script>