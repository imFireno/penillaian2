<?php

require "../config/koneksi.php";

if(isset($_GET['kd_nilai'])) {
    $kd = $_GET['kd_nilai'];
    $query = "DELETE FROM nilai1 WHERE kd_nilai ='$kd'";
    $result = mysqli_query($con, $query);
    
    if($result){
        header("Location: ../index.php?menu=nilai");
    }else {
        echo '<div class="alert alert-danger" role="alert">Gagal menghapus</div>';
    }

}else{
    echo '<div class="alert alert-danger" role="alert">Data tidak di berikan</div>';
}

?>