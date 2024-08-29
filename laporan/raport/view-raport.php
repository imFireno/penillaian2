<?php
if (!isset($_GET['nis'])) {
    die('Tidak ada Akses edit');
}
$nis = $_GET['nis'];
$sql = "SELECT tbl_siswa.nis, tbl_siswa.nama_lengkap, kelas.nama_kelas, tbl_siswa.jurusan, (SELECT nama_guru FROM guru WHERE kd_guru=kelas.kd_guru) as nama_walas, mapel.nama_mapel, guru.nama_guru, nilai1.nilai_akhir, nilai1.grade FROM tbl_siswa JOIN kelas ON tbl_siswa.id_kelas = kelas.id_kelas
                            JOIN nilai1 ON nilai1.nis=tbl_siswa.nis
                            join mapel on mapel.kd_mapel=nilai1.kd_mapel
                            JOIN guru on mapel.kd_guru=guru.kd_guru
                            WHERE tbl_siswa.nis='$nis'";
$hasil = $con->query($sql);

if ($hasil) {
    if ($hasil->num_rows > 0) {
        $row = $hasil->fetch_assoc();
?>
        <center>
            <div class="container mt-10 max-w-5xl">
                <div class="">
                    <h1><b>LAPORAN PENCAPAIAN <br> SMK TARUNA BANGSA</b></h1>
                </div>
                <table class="float-start mt-2 mb-3">
                    <tr>
                        <td>Nama</td>
                        <td>:</td>
                        <td><?php echo $row['nama_lengkap']; ?></td>
                    </tr>
                    <tr>
                        <td>Nis</td>
                        <td>:</td>
                        <td><?php echo $row['nis']; ?></td>
                    </tr>
                    <tr>
                        <td>Kelas</td>
                        <td>:</td>
                        <td><?php echo $row['nama_kelas']; ?></td>
                    </tr>
                </table>
                <div>
                    <table class="table table-bordered border-dark text-center">
                        <thead>
                            <th>NO.</th>
                            <th>MATA PELAJARAN</th>
                            <th>NILAI</th>
                            <th>GRADE</th>
                        </thead>
                        <tbody>
                            <?php
                            $hasil = $con->query($sql);
                            $jumlah = 0;

                            if (!$hasil) {
                                die("Ada masalah Query : " . $con->error);
                            }
                            if ($hasil->num_rows > 0) {
                                $no = 1;
                                while ($row = $hasil->fetch_assoc()) {

                            ?>
                                    <tr>
                                        <td><?php echo $no; ?></td>
                                        <td>
                                            <?php echo $row['nama_mapel']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['nilai_akhir'];
                                            $jumlah += $row['nilai_akhir']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['grade']; ?>
                                        </td>

                                    </tr>
                            <?php
                                    $no++;
                                    $walas = $row['nama_walas'];
                                }
                            } 
                            ?>
                        </tbody>
                        <tr>
                            <td colspan="2">
                                Jumlah <br> Rata Rata
                            </td>
                            <td>
                                <?php
                                echo $jumlah . '<br>';
                                echo $jumlah / $hasil->num_rows;
                                ?>
                            </td>
                            <td>

                            </td>
                        </tr>
                    </table>
                </div>
                <div class="mt-5">
                    <div class="col float-start">
                        <h6>Orang Tua/ Wali Murid</h6>
                        <h6</h6>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <h6>.........................................</h6>
                    </div>
                    <div class="col float-end">
                        <h6>Bekasi, <?php echo date('Y M d') ?></h6>
                        <h6 style="text-align: center;">Wali Kelas</h6>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <h6 style="text-align: center;"><?php echo $walas ?></h6>
                    </div>
                </div>
            </div>
        </center>
<?php

    } else {
        echo "<div clas='alert-danger'>Data Tidak Ditemukan</div>";
    }
}

?>