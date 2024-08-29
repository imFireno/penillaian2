<?php   
    require '../config/koneksi.php';

    $kd = strip_tags($_POST['kode_mapel']);
    $nm = strip_tags($_POST['nama_mapel']);
    $nmg = strip_tags($_POST['kd_guru']);
    $jp = strip_tags($_POST['jp']);
    
    $i = 0;
    $code_error = array("KODE MAPEL", "NAMA MAPEL", "JAM PELAJARAN");
    $tampung_error = array();

    foreach($_POST as $value){
        if(empty($value) || $value==-1 ){
            $tampung_error[] = "Kolom".$code_error[$i]. "Kosong";
        }
        $i++;
    }
    if(strlen($nm)<3){
        $tampung_error[] = "Nama MAPEL tidak boleh kosong";
    }
    if(count($tampung_error)>0){
        session_start();

        $_SESSION["error"] = $tampung_error;
        header("Location:../index.php?menu=mapel");

    }else{
        $sql = "UPDATE mapel SET nama_mapel='$nm', jp='$jp', kd_guru='$nmg' where kd_mapel='$kd'";

        $result = $con->query($sql);
    
        if(!$result){
            die('Proses input data bermasalah :' .$con->error);
        }else {
            echo "<h3>Data Berhasil Di Update</h3>";
           
        }
    
        header('Location:../index.php?menu=mapel');
    }

?>