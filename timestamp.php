<?php
include("admin/dist/function/format_tanggal.php");
date_default_timezone_set('Asia/Jakarta');//Menyesuaikan waktu dengan tempat kita tinggal
$timestamp = date('H:i:s');
$date = date('d-m-Y');
echo format_tanggal($date).'  <br/>  '.$timestamp;//Menampilkan Jam Sekarang
?>