<?php 
$awal  = '10:00:25';
$akhir = '10:30:33';

$time_in = new DateTime($awal);
$time_out = new DateTime($akhir);
$interval = $time_in->diff($time_out);
$hrs = $interval->format('%h');
$mins = $interval->format('%i');
$mins = $mins/60;
$int = $hrs + $mins;

if($int > 4){
	$int = $int - 1;
}

echo 'Waktu tinggal: ' . $int;
?>