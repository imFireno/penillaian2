<?php   
    require '../config/koneksi.php';

    $kd = strip_tags($_REQUEST['id_kelas']);
    $nm = strip_tags($_POST['nama_kelas']);
    $kp = strip_tags($_POST['kapasitas']);
    $wl = strip_tags($_POST['walas']);

   

    // var_dump($_POST);
    // exit();

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
        header("Location:../index.php?menu=kelas");
    }else {
        $sql = "INSERT INTO kelas(id_kelas, nama_kelas, kapasitas, kd_guru) values('$kd','$nm','$kp','$wl')";

        $result = $con->query($sql);
    
        if(!$result){
            die('Proses input data bermasalah :' .$con->error);
        }
    
        header('Location:../index.php?menu=kelas');
    }

    
   
?>