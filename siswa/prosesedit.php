<?php   
    require '../config/koneksi.php';

    $nis = strip_tags($_POST['nis']);
    $nama = strip_tags($_POST['nama']);
    $kelas = strip_tags($_POST['kelas']);
    $tgl = strip_tags($_POST['tgl_lahir']);
    $jk = strip_tags($_POST['jk']);
    $alamat = strip_tags($_POST['alamat']);
    $telp = strip_tags($_POST['no_tlp']);
    $agama = strip_tags($_POST['agama']);
    $jurusan = strip_tags($_POST['jurusan']);

    $i = 0;
    $code_error = array("KODE MAPEL", "NAMA MAPEL", "JAM PELAJARAN");
    $tampung_error = array();

    foreach($_POST as $value){
        if(empty($value) || $value==-1 ){
            $tampung_error[] = "Kolom ".$code_error[$i]. " Kosong";
        }
        $i++;
    }
    if(strlen($nama)<3){
        $tampung_error[] = "Nama Terlalu Pendek";
    }
    if(count($tampung_error)>0){
        session_start();

        $_SESSION["error"] = $tampung_error;
        header("Location:../index.php?menu=siswa");

    }else {
        $sql = "UPDATE tbl_siswa SET nama_lengkap='$nama', id_kelas='$kelas', tgl_lahir='$tgl', jenis_kelamin='$jk', alamat='$alamat', no_tlp='$telp', agama='$agama', jurusan='$jurusan' WHERE nis='$nis'";

        $result = $con->query($sql);
    
        if(!$result){
            die('Proses input data bermasalah :' .$con->error);
        }else {
            echo "<h3>Data Berhasil Di Update</h3>";
            header('Location:../index.php?menu=siswa');
        }
    }
    
   
?>