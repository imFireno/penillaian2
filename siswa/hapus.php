<?php

require "../config/koneksi.php";

if(isset($_GET['nis'])) {
    $nis = $_GET['nis'];
    $query = "DELETE FROM tbl_siswa WHERE nis ='$nis'";
    $result = mysqli_query($con, $query);
    
    if($result){
        header("Location: ../index.php?menu=siswa");
    }else {
        echo '<div class="alert alert-danger" role="alert">Gagal menghapus</div>';
    }

}else{
    echo '<div class="alert alert-danger" role="alert">Data tidak di berikan</div>';
}

?>