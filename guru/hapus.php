<?php

require "../config/koneksi.php";

if(isset($_GET['kd_guru'])) {
    $kd = $_GET['kd_guru'];
    $query = "DELETE FROM guru WHERE kd_guru ='$kd'";
    $result = mysqli_query($con, $query);
    
    if($result){
        header("Location: ../index.php?menu=guru");
    }else {
        echo '<div class="alert alert-danger" role="alert">Guru Sudah Terdaftar</div>';
    }

}else{
    echo '<div class="alert alert-danger" role="alert">Data tidak di berikan</div>';
}

?>