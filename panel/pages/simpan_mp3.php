<?php
include "../../config/function.php";
//if($_REQUEST['anu']==0){
// $sql = mysqli_query($sqlconn, "INSERT INTO cbt_audio");
//} else {
//$sql = mysqli_query($sqlconn, "update cbt_audio set XMulai = '$_REQUEST[anu]'");
//}

// $data = array(
// 	'kode_bank' => , 
// );

$cek = query_get_row("SELECT * FROM cbt_audio WHERE kode_bank = '". $_POST['kode_bank'] . "'");

if ($cek) {
	db_update("cbt_audio", $_POST, array('kode_bank' => $_POST['kode_bank']));
} else {
	db_insert("cbt_audio", $_POST);
}

?>
