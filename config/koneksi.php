<?php
$host="localhost";
$user="root";
$password="";
$db="akademik";

$con = mysqli_connect($host,$user,$password);

$hasil = mysqli_select_db($con,$db);
error_reporting(0);
mysqli_report(MYSQLI_REPORT_OFF);

$con = new mysqli($host,$user,$password,$db);
if ($con->connect_errno) {
    die('Koneksi bermasalah : ' . $con->connect_error);
}

?>