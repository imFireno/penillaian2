<?php

require "../config/koneksi.php";

if(isset($_GET['kd_mapel'])) {
    $kd = $_GET['kd_mapel'];
    $query = "DELETE FROM mapel WHERE kd_mapel ='$kd'";
    $result = mysqli_query($con, $query);
    
    if($result){
        header("Location: ../index.php?menu=mapel");
    }else {
        echo '<div class="alert alert-danger" role="alert">Gagal menghapus</div>';
    }

}else{
    echo '<div class="alert alert-danger" role="alert">Data tidak di berikan</div>';
}

?>