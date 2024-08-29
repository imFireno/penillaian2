<?php   
    require '../config/koneksi.php';

    $kd_guru = strip_tags($_POST['kd_guru']);
    $nama_guru = strip_tags($_POST['nama_guru']);
    $pendidikan = strip_tags($_POST['pendidikan']);
    $prodi = strip_tags($_POST['prodi']);
   
    $tampung_error = array();

    if(count($tampung_error)>0){
        session_start();
        
        $_SESSION["error"] = $tampung_error;
        header("Location:../index.php?menu=guru");
        
    }else{
        $sql = "UPDATE guru SET nama_guru='$nama_guru', pendidikan='$pendidikan', prodi='$prodi' where kd_guru='$kd_guru'";
        $result = $con->query($sql);
        
        if(!$result){
            die('Proses input data bermasalah :' .$con->error);
        }else {
            echo "<h3>Data Berhasil Di Update</h3>";
           
        }
    
        header('Location:../index.php?menu=guru');
    }

?>