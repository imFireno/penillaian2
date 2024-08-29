<?php
require '../config/koneksi.php';

$kd = $_POST['kd'];
$kehadiran1 = strip_tags($_POST['kehadiran']);
$tugas1 = strip_tags($_POST['tugas']);
$formatif1 = strip_tags($_POST['formatif']);
$uts1 = strip_tags($_POST['uts']);
$uas1 = strip_tags($_POST['uas']);

$kehadiran = ($kehadiran / 14) * 5;
$tugas = $tugas1 * 0.1;
$formatif =  $formatif1 * 0.15;
$uts = $uts1 * 0.3;
$uas = $uas1 * 0.4;

$hasilAkhir = $kehadiran + $tugas + $formatif + $uts + $uas;

$grade = "F";
if ($hasilAkhir >= 50) {
    $grade = "D";
    }
    if ($hasilAkhir >= 75) {
        $grade = "C";
    }
    if ($hasilAkhir >= 85) {
        $grade = "B";
    }
    if ($hasilAkhir >= 90) {
        $grade = "A";
    }
    

$sql = "UPDATE nilai1 SET kehadiran='$kehadiran', tugas='$tugas', formatif='$formatif', uts='$uts', uas='$uas', nilai_akhir='$hasilAkhir', grade='$grade' WHERE kd_nilai='$kd'";

$hasil = $con->query($sql);

if (!$hasil) {
    die("<div><center>Data Tidak Berhasil Di Input</center></div> " . $con->error);
} else {
    echo "<h5>Selamat Data Berhasil Disimpan</h5>";
}

header('Location:../index.php?menu=nilai');
