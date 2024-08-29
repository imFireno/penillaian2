<?php   
    require '../config/koneksi.php';

    $kd_guru = strip_tags($_POST['kd_guru']);
    $nm_guru = strip_tags($_POST['nama_guru']);
    $pendidikan = strip_tags($_POST['pendidikan']);
    $prodi = strip_tags($_POST['prodi']);
   

    // foreach($_POST as $item){
    //     if(empty($item) || $item =-1){
    //         die("Lengkapi Form! <a href='#' onclick='history.back()'>Kembali</a>");
    //     }
    // }
    
    $i = 0;
    $kode_error = array("KD MAPEL","NAMA MAPEL","JAM PELAJARAN");

    $tampung_error = array();

    foreach($_POST as $value) {
        if(empty($value) || $value ==-1){
            $tampung_error[] = $kode_error[$i];
        }
        $i++;
    }
    
    

    if(count($tampung_error)>0){
        session_start();

        $_SESSION['error'] = $tampung_error;
        header("Location:../index.php?menu=guru");
    }else {
        $sql = "INSERT INTO guru (kd_guru, nama_guru, pendidikan, prodi) values ('$kd_guru','$nm_guru','$pendidikan','$prodi')";

        $result = $con->query($sql);
    
        if(!$result){
            die('Proses input data bermasalah :' .$con->error);
        }
    
        header('Location:../index.php?menu=guru');
    }

    
    
?>