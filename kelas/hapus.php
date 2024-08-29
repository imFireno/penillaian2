<?php

require "../config/koneksi.php";

if(isset($_GET['kd_kelas'])) {
    $kd = $_GET['kd_kelas'];
    $query = "DELETE FROM kelas WHERE id_kelas ='$kd'";
    $result = mysqli_query($con, $query);
    
    if($result){
        header("Location: ../index.php?menu=kelas");
    }else {
        echo '<div class="alert alert-danger" role="alert">Kelas Sudah Terdaftar</div>';
    }

}else{
    echo '<div class="alert alert-danger" role="alert">Data tidak di berikan</div>';
}

?>