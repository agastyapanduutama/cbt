<?php
  if(!isset($_COOKIE['beeuser'])){
  header("Location: login.php");}
?>
<!-- <h1>hello world</h1> -->
<html>
<head>
<title>Hasil Ujian</title>
<script type="text/javascript" src="./js/jquery.gdocsviewer.min.js"></script> 
<!--
<script type="text/javascript"> 
/*<![CDATA[*/
$(document).ready(function() {
  $('a.embed').gdocsViewer({width: 600, height: 750});
  $('#embedURL').gdocsViewer();
});
/*]]>*/
</script> -->
</head>
<body onmouseenter="myFunction()">
  <!-- <button class="btn btn-default btn-sm " onclick="myFunction()">Print this page</button> -->
<script>
function myFunction() {
  window.print();
}
</script>
<iframe src="<?php echo "cetaknilai.php?kelas=$_REQUEST[iki3]&jur=$_REQUEST[jur3]&mapz=$_REQUEST[map3]"; ?>" style="display:none;" name="frame"></iframe>

<?php

//koneksi database
include "../../config/server.php";
$sqlad = mysqli_query($sqlconn, "SELECT * from cbt_admin");
$ad = mysqli_fetch_array($sqlad);
$namsek = strtoupper($ad['XSekolah']);
$kepsek = $ad['XKepSek'];
$logsek = $ad['XLogo'];
$BatasAwal = 50;
if(isset($_REQUEST['iki3'])){ 
$cekQuery = mysqli_query($sqlconn, "
  SELECT * FROM cbt_peserta 
  WHERE kode_kelas = '$_REQUEST[iki3]' 
  -- AND  XKodeJurusan = '$_REQUEST[jur3]' 
  ");
}else{
$cekQuery = mysqli_query($sqlconn, "SELECT * FROM cbt_peserta ");
}

$jumlahData = mysqli_num_rows($cekQuery);
$jumlahn = 20;

$n = ceil($jumlahData/$jumlahn);
$nomz = 1;
for($i=1;$i<=$n;$i++){ ?>
  <div style="background:#999; width:100%; height:1275px;" ><br>
  <div style="background:#fff; width:90%; margin:0 auto; padding:30px; height:90%;">
    <table border="0" width="100%">
    <tr>
                  <?php 
                $sqk = mysqli_query($sqlconn, "SELECT * from cbt_tes where XKodeUjian = '$_REQUEST[tes3]'");
                $rs = mysqli_fetch_array($sqk);
                              $rs1 = strtoupper("$rs[XNamaUjian]");
                
                if($_REQUEST['tes3']=='ALL'){$namaujian = "DAFTAR NILAI UJIAN ";} else {$namaujian = "DAFTAR NILAI UJIAN $rs1";}
                ?>                           

    <td rowspan="4" width="150"><img src="../../images/<?php echo "$logsek"; ?>" width="100"></td>
    <td colspan="2"><font size="4"><b><?php echo "$namaujian $namsek"; ?></b></font></td>
    </tr>
    <tr>
  <?php 

  $sqk = mysqli_query($sqlconn, "
    SELECT * from cbt_mapel where XKodeMapel = '$_REQUEST[map3]'
    ");
  $rs = mysqli_fetch_array($sqk);
  $rs1 = strtoupper("$rs[XNamaMapel]");
  $NilaiKKM2 = $rs['XKKM'];
  ?>   
    <td width="20%">Mata Pelajaran</td><td>: <b><?php echo $rs1; ?> (Nilai KKM : <?php echo $NilaiKKM2; ?>)</b></td>
    </tr>
    <tr>
    <td>Tanggal </td><td>: <b><?php echo $_REQUEST['tanggal'] ?></b></td>
    </tr>
    <!-- <tr>
    <td>Kelas - <?php echo $rombel; ?></td><td>: <b><?php echo $_REQUEST['iki3']; ?> - <?php echo $_REQUEST['jur3']; ?></b></td>
    </tr>

  <tr>
    <td>Tahun Akademik </td><td>: <?php echo $_COOKIE['beetahun']; ?></td>
  </tr> -->
  <tr>
    <td></td>
  </tr>
  <tr>
    <td></td>
  </tr>
  </table><br>
  
  <table  border="1" width="100%" style="text-align:center">
  <tr bgcolor="#B9D4F7" height="30">
    <th width="5%"  style="text-align:center">No</th>
    <th width="15%" style="text-align:center">NRP Peserta</th>
    <th width="25%" style="text-align:center">Nama Siswa</th>
  <td width="5%">NILAI</td>
</tr>

 <?php 
$no=0;
// $sql = mysqli_query($sqlconn, "SELECT * from cbt_nilai order by Urut");
$sql = mysqli_query($sqlconn, "SELECT * from cbt_nilai WHERE XTgl = '$_REQUEST[tanggal]' order by Urut");
while($s = mysqli_fetch_array($sql)){ 
$no++
?>
    <tr class="">
        <td align="center"><?php echo $no; ?></td>
    <td align="center"><?php echo $s['XNomerUjian']; ?></td>
        <td align="center"><?php echo $s['XNamaPeserta']; ?></td>
        <td align="center"><?php echo $s['XNilai']; ?></td>
    </tr>
<?php } ?> 
      </table>
  </div>
  </div>
<?php } ?>            
</body>
</html>
