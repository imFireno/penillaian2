<?php   
    require '../config/koneksi.php';

    $id = strip_tags($_POST['id_kelas']);
    $nmk = strip_tags($_POST['nama_kelas']);
    $kp = strip_tags($_POST['kapasitas']); 
    $wl = strip_tags($_POST['kd_guru']);
    
        $sql = "UPDATE kelas SET nama_kelas='$nmk', kapasitas='$kp', kd_guru='$wl' WHERE id_kelas='$id'";

        $result = $con->query($sql);
    
        if(!$result){
            die('Proses input data bermasalah :' .$con->error);
        }else {
            echo "<h3>Data Berhasil Di Update</h3>";
           
        }
    
        header('Location:../index.php?menu=kelas');
    

?>