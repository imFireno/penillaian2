<?php   
    require '../config/koneksi.php';

    $nis = strip_tags($_REQUEST['nis']);
    $nama = strip_tags($_POST['nama']);
    $tgl = strip_tags($_POST['tgl_lahir']);
    $jk = strip_tags($_POST['jk']);
    $alamat = strip_tags($_POST['alamat']);
    $telp = strip_tags($_POST['no_tlp']);
    $agama = strip_tags($_POST['agama']);
    $jurusan = strip_tags($_POST['jurusan']);
    $nmk = strip_tags($_POST['namakelas']);

    // var_dump($_POST);
    // exit();

    // foreach($_POST as $item){
    //     if(empty($item) || $item =-1){
    //         die("Lengkapi Form! <a href='#' onclick='history.back()'>Kembali</a>");
    //     }
    // }

    $i = 0;
    $kode_error = array("NIS,","NAMA","TTL","JK","ALAMAT","TLP","AGAMA","JURUSAN");

    $tampung_error = array();

    foreach($_POST as $value) {
        if(empty($value) || $value ==-1){
            $tampung_error[] = $kode_error[$i];
        }
        $i++;
    }
    
    if(strlen($nis)!=9){
        $tampung_error[] = "Panjang NIS tidak sesuai!";
    }
    if(strlen($nama)<3){
        $tampung_error[] = "Namanya pendek amat mas!";
    }
    
    if(count($tampung_error)>0){
        session_start();

        $_SESSION['error'] = $tampung_error;
        header("Location:../index.php?menu=siswa");
    }else {
        $sql = "INSERT INTO tbl_siswa(nis, nama_lengkap, tgl_lahir, jenis_kelamin, alamat, no_tlp, agama, jurusan, id_kelas) values('$nis','$nama','$tgl','$jk','$alamat','$telp','$agama','$jurusan','$nmk' )";

        $result = $con->query($sql);
    
        if(!$result){
            die('Proses input data bermasalah :' .$con->error);
        }
    
        header('Location:../index.php?menu=siswa');
    }
    
   
?>