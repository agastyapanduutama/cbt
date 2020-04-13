<?php
	if(!isset($_COOKIE['beeuser'])){
	header("Location: login.php");}

if(isset($_REQUEST['aksi'])&&$_REQUEST['aksi']=="simpan"){
$sss= str_replace("'","\'",$_REQUEST['tanyasoal']);
	$sql0 = mysqli_query($sqlconn, "update cbt_soal set XTanya = '$sss' where XKodeSoal = '$_REQUEST[soal]' and Urut = '$_REQUEST[nom]'");
	//echo "update cbt_soal set XTanya = '$sss' where XKodeSoal = '$_REQUEST[txt_soal]' and Urut = '$_REQUEST[txt_nom]'";
}
?>	

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Bootstrap Admin Theme</title>

    <!-- Bootstrap Core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="../vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="../vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<script type="text/javascript" src="jscripts/tiny_mce/plugins/asciimath/js/ASCIIMathMLwFallback.js"></script>
<script type="text/javascript">
var AMTcgiloc = "http://www.imathas.com/cgi-bin/mimetex.cgi";  		//change me
//var AMTcgiloc = "http://localhost:8090/cgi-bin/mimetex.cgi";  		//change me
</script>

<!-- TinyMCE -->
<script type="text/javascript" src="jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
tinyMCE.init({
    mode : "textareas",
    theme : "advanced",
    theme_advanced_buttons1 : "fontselect,fontsizeselect,formatselect,bold,italic,underline,strikethrough,separator,sub,sup,separator,cut,copy,paste,undo,redo",
    theme_advanced_buttons2 : "justifyleft,justifycenter,justifyright,justifyfull,separator,numlist,bullist,outdent,indent,separator,forecolor,backcolor,separator,hr,link,unlink,image,media,table,code,separator,asciimath,asciimathcharmap,asciisvg",
    theme_advanced_buttons3 : "",
    theme_advanced_fonts : "Arial=arial,helvetica,sans-serif,Courier New=courier new,courier,monospace,Georgia=georgia,times new roman,times,serif,Tahoma=tahoma,arial,helvetica,sans-serif,Times=times new roman,times,serif,Verdana=verdana,arial,helvetica,sans-serif",
    theme_advanced_toolbar_location : "top",
    theme_advanced_toolbar_align : "left",
    theme_advanced_statusbar_location : "bottom",
    plugins : 'asciimath,asciisvg,table,inlinepopups,media',
   
    AScgiloc : 'http://www.imathas.com/editordemo/php/svgimg.php',			      //change me  
    ASdloc : 'http://www.imathas.com/editordemo/jscripts/tiny_mce/plugins/asciisvg/js/d.svg',  //change me  	
        
    content_css : "./jscripts/tiny_mce/plugins/media/css/content.css"
});
</script>
<!-- /TinyMCE -->

<!-- TinyMCE 4.x -->
<!-- 
<script type="text/javascript" src="tinymce/tinymce.min.js"></script>
<script type="text/javascript">
 
tinymce.init({
  selector: "textarea",
  
  // ===========================================
  // INCLUDE THE PLUGIN
  // ===========================================
	
  plugins: [
    "eqneditor advlist lists charmap anchor",
    "code fullscreen",
    "table contextmenu paste jbimages"
  ],
	
  // ===========================================
  // PUT PLUGIN'S BUTTON on the toolbar
  // ===========================================
	
  toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image jbimages",
	
  // ===========================================
  // SET RELATIVE_URLS to FALSE (This is required for images to display properly)
  // ===========================================
	
  relative_urls: false,
 forced_root_block : "", 
    force_br_newlines : true,
    force_p_newlines : false,
});
 
</script>
<!-- /TinyMCE 4.x -->
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript" src="./js/jquery-1.4.js"></script>

<?php
if(isset($_REQUEST['jum'])&&$_REQUEST['jum']==5){
?>
<script>    
$(document).ready(function(){
 $("#kirim").click(function(){
	
 })
})
</script> 
<?php } else { ?>
<script>    
$(document).ready(function(){
 $("#kirim").click(function(){
 	var data = {
 		nama_audio: $("#audio-upload").val(),
		kode_bank: $("#kode_bank").val()	
 	}

	$.ajax({
	    type:"POST",
	    url:"simpan_mp3.php",    
	    data: data,
		success: function(data){
		alert("Simpan suksesss");
		window.location.href = "?modul=daftar_soal";
		}
	});
 })
})
</script> 

<?php } ?>
<script src="../vendor/jquery/jquery.min.js"></script>
<script src="js/lc_switch.js" type="text/javascript"></script>
<link rel="stylesheet" href="js/lc_switch.css">
<script type="text/javascript">
var $jnoc = jQuery.noConflict();
          
$jnoc(document).ready(function(e) {

	$jnoc ('input').lc_switch();

	// triggered each time a field changes status
	$jnoc('body').delegate('.lcs_check', 'lcs-statuschange', function() {
		var status = ($(this).is(':checked')) ? 'checked' : 'unchecked';
		console.log('field changed status: '+ status );
	});
	
	
	// triggered each time a field is checked
	$jnoc('body').delegate('.lcs_check', 'lcs-on', function() {
		console.log('field is checked');
	});
	
	
	// triggered each time a is unchecked
	$jnoc('body').delegate('.lcs_check', 'lcs-off', function() {
		console.log('field is unchecked');
		
	});
});
</script>

<body><form action="#" method="post">
<?php	
$sqltanya = mysqli_query($sqlconn, "select * from cbt_paketsoal where XKodeSoal= '$_REQUEST[soal]' and XGuru = '$_COOKIE[beeuser]'");
	$so=mysqli_fetch_array($sqltanya); ?>

<div class="panel panel-info">
	<div class="panel-heading">
    Data Bank Soal  &nbsp; &nbsp; | &nbsp; &nbsp; 
	<?php echo "<a href=?modul=daftar_soal><button type='button' class='btn btn-info'><i class='fa fa-arrow-left'></i> Kembali ke Bank Soal</button></a>"; ?>	
          

    </div>
	
    <div class="panel-body">
<?php    $sqlsoal = mysqli_query($sqlconn, "SELECT MAX(XNomerSoal) as maksi FROM `cbt_soal` WHERE XKodeSoal = '$_REQUEST[soal]'");
$sm = mysqli_fetch_array($sqlsoal);
$maks = $sm['maksi']+1; ?>

<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
<tr><td colspan="2"  style="font-size:18px">&nbsp;  </td>

<td align="right">
<button type="button" class="btn btn-success btn-small" id="kirim" onclick=""><i class='fa fa-save'></i> Simpan Soal</button>     
    <input type="hidden" id="soal" name="soal" value="<?php echo $_REQUEST['soal']; ?>" />
    <input type="hidden" id="map" name="map" value="<?php echo $so['XKodeMapel']; ?>" />
<input type="hidden" id="nomax" name="nomax" value="<?php echo $maks ; ?>" />
    </strong></td>
  </tr>
<tr><td colspan="3">
<input type="text" id="txt_kate" name="txt_kate" value="2" hidden readonly size="1" style="margin-bottom:5px" >
 
<!-- <div class="col-sm-12"><label style="width:100px; font-style:normal; font-weight:normal">Mapel Agama</label> -->
<select id="txt_ag" hidden="" name="txt_ag" class="input-sm"  style="margin-bottom:5px" />
<option value="" selected="">Mapel Umum</option>
<option value="ISLAM">Agama ISLAM</option>
<option value="KRISTEN">Agama KRISTEN</option>
<option value="HINDU">Agama HINDU</option>
<option value="BUDA">Agama BUDA</option>
<option value="KONGHUCU">Agama KONGHUCU</option>
<?php
$sqlpil = mysqli_query($sqlconn, "select * from cbt_siswa group by XPilihan");
while($xpil = mysqli_fetch_array($sqlpil)){ 
$p=$xpil['XPilihan'];?>	
<option value=<?php echo $p; ?>> Pilihan <?php echo $p. "</option>";
}?>
</select> 
 </div>

<?php 

$audio = mysqli_fetch_assoc(mysqli_query($sqlconn, "SELECT * FROM cbt_audio WHERE kode_bank = '" . $_GET['soal'] . "'"));

 ?>


<div class="col-sm-12">
	<label style="width:100px; font-style:normal; font-weight:normal">Kode Bank Soal</label>
	<input type="text" class="form-control" id="kode_bank" value="<?= $_GET['soal'] ?>" readonly>
</div>
<div class="col-sm-12">
	<label style="width:100px; font-style:normal; font-weight:normal">Nama file Audio</label>
	<input type="text" class="form-control" id="kode_bank" value="<?= $audio['nama_audio'] ?>" readonly>
</div>

<!-- <div class="col-sm-12"><label style="width:100px; font-style:normal; font-weight:normal">Tk. Kesulitan</label>
<select id="txt_kes" name="txt_kes" class="input-sm"  style="margin-bottom:5px" />
<option value="1">Mudah</option>
<option value="2">Sedang</option>
<option value="3">Sulit</option>
</select> -->
 </div>
<!-- <div class="col-sm-12"><label style="width:100px; font-style:normal; font-weight:normal">Acak Soal</label>
<select id="txt_aca" name="txt_aca" class="input-sm"/>
<option value="A">Acak</option>
<option value="T">Tidak</option>
</select>
 --> </div>


</td>
  </tr>  
  <tr>
<tr><td colspan="3">&nbsp;</td></tr>    
    <td colspan="3" align="right">
    	<!-- <textarea name="tanyasoal"  id="tanyasoal" style="font-size:18px; width:100%; height:300px"></textarea> -->
        <div>
		<!-- Some integration calls: the first two seem to be having issues with asciimath plugin
		<a href="javascript:;" onmousedown="tinyMCE.get('elm1').show();">[Show]</a>
		<a href="javascript:;" onmousedown="tinyMCE.get('elm1').hide();">[Hide]</a>  -->
		<!-- <a href="javascript:;" onMouseDown="alert(tinyMCE.get('elm1').getContent());">[Get contents]</a>
		<a href="javascript:;" onMouseDown="alert(tinyMCE.get('elm1').selection.getContent());">[Get selected HTML]</a>
		<a href="javascript:;" onMouseDown="alert(tinyMCE.get('elm1').selection.getContent({format : 'text'}));">[Get selected text]</a> -->
	</div>

    </td>
  </tr>
  
  
<tr><td colspan="3"><hr></td></tr>
<tr bgcolor="#507db3"><td colspan="3" style="padding:10px"><font color="#FFFFFF" size="5"><b>&nbsp;File Pendukung Soal</b></font></td></tr>
<tr><td colspan="3"><hr></td></tr> 
  
<tr><td colspan="3" ><br>
<script type="text/javascript" src="js/jquery-1.3.2.js" ></script>
<script type="text/javascript" src="js/ajaxupload.3.5.js" ></script>
<!-- <link rel="stylesheet" type="text/css" href="./styles.css" /> -->
<script type="text/javascript" >
	$(function(){
		var btnUpload=$('#upload');
		var status=$('#status');
		new AjaxUpload(btnUpload, {
			action: 'upload_gambar.php',
			name: 'uploadfile',
			onSubmit: function(file, ext){
				 if (! (ext && /^(jpg|png|jpeg|gif)$/.test(ext))){ 
                    // extension is not allowed 
					status.text('Only JPG, PNG or GIF files are allowed');
					return false;
				}
				status.text('Uploading...');
			},
			onComplete: function(file, response){
				//On completion clear the status
				status.text('');
				//Add uploaded file to list
				
				if(response==="success"){
				$('#upload').html('<img src="../../pictures/'+file+'"  width="130" alt="" />').addClass('success');
				document.getElementById("image-upload").value = file;				
//					$('<li></li>').appendTo('#files').html('<img src="./uploads/'+file+'" alt="" /><br />'+file).addClass('success');
				} else{
					$('<li></li>').appendTo('#files').text(file).addClass('error');
				}
			}
		});
		
	});
</script>

<script type="text/javascript" >
	$(function(){
		var btnUpload2=$('#upload2');
		var status2=$('#status2');
		new AjaxUpload(btnUpload2, {
			action: 'upload_audio.php',
			name: 'uploadfile2',
			onSubmit: function(file2, ext2){
				 if (! (ext2 && /^(mp3|wav|mpeg)$/.test(ext2))){ 
                    // extension is not allowed 
					status2.text('Only MP3, WAV  files are allowed');
					return false;
				}
				status2.text('Uploading...');
			},
			onComplete: function(file2, response2){
				//On completion clear the status
				status2.text('');
				//Add uploaded file to list
				
				if(response2==="success"){
				$('#upload2').html('<img src="images/mp3.png"  width="130" alt="" />').addClass('success');
		 		document.getElementById("audio-upload").value = file2;				
//					$('<li></li>').appendTo('#files').html('<img src="./uploads/'+file+'" alt="" /><br />'+file).addClass('success');
				} else{
					$('<li></li>').appendTo('#files2').text(file2).addClass('error');
				}
			}
		});
		
	});
</script>

<script type="text/javascript" >
	$(function(){
		var btnUpload3=$('#upload3');
		var status3=$('#status3');
		new AjaxUpload(btnUpload3, {
			action: 'upload_video.php',
			name: 'uploadfile3',
			onSubmit: function(file3, ext3){
				 if (! (ext3 && /^(mp4|avi)$/.test(ext3))){ 
                    // extension is not allowed 
					status3.text('Upload file dengan format mp4');
					return false;
				}
				status3.text('Uploading...');
			},
			onComplete: function(file3, response3){
				//On completion clear the status
				status3.text('');
				//Add uploaded file to list
				
				if(response3==="success"){
				$('#upload3').html('<img src="images/vid.png"  width="130" alt="" />').addClass('success');
		 		document.getElementById("video-upload").value = file3;				
//					$('<li></li>').appendTo('#files').html('<img src="./uploads/'+file+'" alt="" /><br />'+file).addClass('success');
				} else{
					$('<li></li>').appendTo('#files3').text(file3).addClass('error');
				}
			}
		});
		
	});
</script>

<!-- Upload Button, use any id you wish-->
         <table cellpadding="10" width="70%" align="center" cellspacing="10">
         <tr height="40">
         	<td align="center"></td>
         	<td align="center">Audio Soal</td>
         	<td align="center"></td></tr>
         <tr><td align="center"><br>               
        <div id="upload" style="text-align:center; padding-right:10;">
        	<!-- <img src="images/no_pic.png" width="130" style="margin-top:10"/></div><span id="status" ></span> -->
        <ul id="files"></ul>
		</div><input type="text" hidden id="image-upload" name="image-upload" readonly>
         </td><td align="center">   <br>            
            <div id="upload2" style="text-align:center"><img src="images/no_aud.png" width="130"/></div><span id="status2" ></span>
            <ul id="files2"></ul>
			</div><input type="text" id="audio-upload" name="audio-upload" readonly>
         </td>
         
         <td align="center">  <br>             
                        <!-- <div id="upload3" style="text-align:center"><img src="images/no_vid.png" width="130"/></div><span id="status3" ></span> -->
                     <ul id="files3"></ul>
				</div><input type="text" hidden="" id="video-upload" name="video-upload" readonly>
         </td>
         </tr></table>
</td>
</tr>
  
<tr><td colspan="2">&nbsp;</td></tr>
 </table>
</div></div> 
</form>
                        
<script>    
$(document).ready(function(){

});

function confirmDialog(message, onConfirm){
    var fClose = function(){
        modal.modal("hide");
    };
    var modal = $("#confirmModal");
    modal.modal("show");
    $("#confirmMessage").empty().append(message);
    $("#confirmOk").one('click', onConfirm);
    $("#confirmOk").one('click', fClose);
    $("#confirmCancel").one("click", fClose);
}
});
</script>
                                                     
  <!-- Modal confirm -->
<div class="modal" id="confirmModal" style="display: none; z-index: 1050;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body" id="confirmMessage">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" id="confirmOk">Ok</button>
                <button type="button" class="btn btn-default" id="confirmCancel">Cancel</button>
            </div>
        </div>
    </div>
</div>
                            <!-- /.table-responsive -->
                            <div class="well">
                            <p></p>
                                
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
           
    <script src="../vendor/jquery/jquery-1.12.3.js"></script>
    <script src="../vendor/jquery/jquery.dataTables.min.js"></script>
    <!-- jQuery -->
    <script src="../vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>

    <!-- DataTables JavaScript -->
    <script src="../vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="../vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="../vendor/datatables-responsive/dataTables.responsive.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->

    <script type="text/javascript">
    	function nyimpen() {
			alert("Hallo")
			var data = {
		 		nama_audio: $("#audio-upload").val(),
				kode_bank: $("#kode_bank").val()	
		 	}

			$.ajax({
			    type:"POST",
			    url:"simpan_mp3.php",    
			    data: data
				success: function(data){
				alert("Simpan suksesss");
				}
			});
		}
    </script>

    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
            responsive: true
        });
    
	
	
	});
    </script>
    <script>$(document).ready(function() {
    var table = $('#example').DataTable();
 
    $('#example tbody').on( 'click', 'tr', function () {
        if ( $(this).hasClass('selected') ) {
            $(this).removeClass('selected');
        }
        else {
            table.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
    } );
 
    $('#button').click( function () {
        table.row('.selected').remove().draw( false );
    } );
} );</script>
    
 
<!-- Modal -->

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Buat Bank Soal Baru</h4>
      </div>
      <div class="modal-body">
        <?php include "buat_banksoalbaru.php";?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
</div>
</div>
<!--
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
!-->
<script>
	$('#myModal').on('shown.bs.modal', function () {
	  $('#myInput').focus()
	})
	$('#myModal').on('hidden.bs.modal', function () {
	  document.location.reload();
	 // alert("tes");
	})
	
	$('#confirmModal').on('hidden.bs.modal', function () {
	  document.location.reload();
	  //alert("hapus");
	})
</script>


</body>

</html>
