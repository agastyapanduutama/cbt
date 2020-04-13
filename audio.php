
<title>Audio - Harap tidak tutup/close </title>

<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
<script src="bootstrap/js/bootstrap.min.js"></script>
<?php 


session_start();


include "config/server.php";
include "config/function.php";
include "config/fungsi_jam.php";
include "ip.php";

  $user = $_COOKIE['PESERTA'];


  $sqluser = mysqli_query($sqlconn, "
  
    SELECT * , u.XKodeKelas AS kelaz, s.kode_kelas AS kelasx, 
  -- s.XKodeJurusan AS jurusx, 
  u.XKodeSoal AS soalz, u.XKodeUjian AS ujianz,s.XSesi as sesiz,
  s.XSetId as setidx,u.XKodeMapel as mapelx,u.XSemester as semex FROM cbt_peserta s 
  LEFT JOIN cbt_ujian u ON u.XKodeKelas = 'ALL' 
  -- and (s.XKodeJurusan = u.XKodeJurusan or u.XKodeJurusan = 'ALL')
   LEFT JOIN cbt_mapel m on m.XKodeMapel = u.XKodeMapel 
  WHERE s.nrp_peserta = '$user' and u.XStatusUjian = '1'

  -- SELECT * , u.XKodeKelas AS kelaz, s.kode_kelas AS kelasx, u.XKodeSoal AS soalz, u.XKodeUjian AS ujianz 
  -- FROM cbt_peserta s 
  -- LEFT JOIN cbt_ujian u  ON u.XKodeKelas = 'ALL' 
  -- -- AND (s.XKodeJurusan = u.XKodeJurusan OR u.XKodeJurusan = 'ALL')  LEFT JOIN cbt_mapel m  ON m.XKodeMapel = u.XKodeMapel --
  -- -- WHERE s.XNomerUjian = '$_COOKIE[PESERTA]' 
  -- WHERE s.nrp_peserta = '$user' 
  -- AND u.XStatusUjian = '1'
  ");

// hello wolrd

  $s = mysqli_fetch_array($sqluser);
  $val_siswa = $s['nama_peserta'];
  $xnamakelas = $s['nama_kelas'];
  $xsesi = $s['XSesi'];

  $xkodesoal = $s['soalz'];
  $xkodemapel = $s['XKodeMapel'];
  $xsemester = '1';  
  $xkodekelas = $s['kelaz'];
  $xkodekelasx = $s['kelasx'];
  $xkodejurusx = 'SEMUA'; 
  $xkodeujianx = $s['ujianz']; 
  $xsetidx = $s['setidx'];

// var_dump($xsetidx);


  // var_dump($user);
  // var_dump($val_siswa);

  $xjumlahsoal = $s['XJumSoal'];
  $xtokenujian = $s['XTokenUjian'];  
  $xbatasmasuk= $s['XBatasMasuk'];   
  $xnamamapel = $s['XNamaMapel'];
  $xjamujian = $s['XJamUjian']; 
  $xjumpilg = $s['XPilGanda'];   
  $xjumesai = $s['XEsai'];     
  $xacaksoal = $s['XAcakSoal'];  
  $xjumlahpilihan = $s['XJumPilihan'];
  $xtglujian = $s['XTglUjian'];
  $xmaxlambat = $s['XLambat'];
  // $xagama = $s['XAgama']; 
  $xmapelagama = $s['XMapelAgama']; 
  $xpilih = $s['XPilihan'];     
  $xpilih = '';     


// var_dump($xnamamapel);
// var_dump($xmaxlambat);
// var_dump($xagama);
// var_dump($xmapelagama);

  $xjumlahpilganda = $s['XPilGanda'];
  $xjumlahesai = $s['XEsai'];  

 ?>

Soal Audio

<button hidden="" type="button" id="tombolaudio" onclick="playAudio()">Play</button>
<button hidden="" type="button" id="tombolaudio1" onclick="pauseAudio()" >Pause</button>

<!-- <a href="#"><div onclick="self.close()">Close Tab Browser</div></a> -->
<!-- <input type="button" value="Close Tab" onclick="self.close()"> -->

  <?php 

$cekna = "SELECT * FROM cbt_audio WHERE kode_bank = '$_SESSION[kodena]'";



$audio = query_get_row($cekna); 

// echo "<audio id='audionya' src='audio/$audio[nama_audio]' autoplay='autoplay' control></audio>"

// if ($xkodesoal == $ambildata['kode_bank']) {
//   echo "<audio src='audio/bahasa/inggris.mp3' autoplay='autoplay'></audio>";
// }
?>


<audio id="syukurcover" >  
<!-- <audio id="audionya" >   -->
<source src="audio/<?= $audio['nama_audio'] ?>"  type="audio/mpeg">  
</audio>
<div id="audionya">
  <div class="alert alert-primary" role="alert">
  <div id="kotak" style="border: 1px solid black; height: 10px; width: 150px; margin-bottom: 10px">
            <div id="progres" class="" style="background: lightblue; height: 10px; width: 0px"></div>
        </div>
        <!--tambahkan element audio-->
        <!-- <audio id="syukurcover" src="syukurcover.mp3"></audio> -->
        <!--tambahkan tombol-->
        <button id="tombol_play" class="btn btn-primary" onclick="play()">Play</button>
        <button id="tombol_pause" onclick="pause()" class="btn btn-danger">Pause</button>
        <button hidden="" id="tombol_stop" onclick="stop()"></button>
</div>
</div>

        <!-- <p><a href="https://soundcloud.com/muhammad-faza-938291781/hindia-evaluasi"></a></p> -->
        <!--buat progress bar-->
       
        <script>
//            definisikan masing masing id
            var lagu = document.getElementById('syukurcover');
            var tombol_play = document.getElementById('tombol_play');
            var tombol_pause = document.getElementById('tombol_pause');
            var tombol_stop = document.getElementById('tombol_stop');
            var progres = document.getElementById('progres');
//            set tombol
            tombol_play.disabled = false;
            tombol_pause.disabled = true;
            tombol_stop.disabled = true;
            function play() {
//                harviacode.com
                lagu.play();
                tombol_play.disabled = true;
                tombol_pause.disabled = false;
                tombol_stop.disabled = false;
                update();
            }
            function pause() {
//                harviacode.com
                lagu.pause();
                tombol_play.disabled = false;
                tombol_pause.disabled = true;
                tombol_stop.disabled = false;
                update();
            }
            function stop() {
//                harviacode.com
                lagu.pause();
                lagu.currentTime = 0;
                tombol_play.disabled = false;
                tombol_pause.disabled = true;
                tombol_stop.disabled = true;
                update();
            }
            function update() {
//                update progress tiap 200 milidetik
                setInterval(function () {
//                harviacode.com
                    // cari posisi lagu dan durasi
                    var saatini = lagu.currentTime;
                    var durasi = lagu.duration;
//                    hitung persentase progress
                    var persen = (saatini / durasi) * 150;
                    // update progress bar
                    progres.style.width = parseInt(persen) + 'px';
                }, 200);
            }

            document.getElementById("syukurcover").onended = function() {demoDisplay()};

            function demoDisplay() {
            document.getElementById("tombolaudio").style.display = "none";
            document.getElementById("tombolaudio1").style.display = "none";
            document.write("Audio Sudah Selesai");
            self.close()
            }
        </script>
    </body>
</html>

<?php 
$val_audio =  $audio['nama_audio'];
?>
<!-- 
<script type="text/javascript">
var audionya = document.getElementById("audionya");

function playAudio(){
audionya.play();
}

function pauseAudio(){
audionya.pause();
}

document.getElementById("audionya").onended = function() {demoDisplay()};

function demoDisplay() {
document.getElementById("tombolaudio").style.display = "none";
document.getElementById("tombolaudio1").style.display = "none";
document.write("Audio Sudah Selesai");
}

</script> -->
