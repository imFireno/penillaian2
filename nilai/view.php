<div class="container">
    <?php
    session_start();
    
    if (isset($_SESSION['error'])) {
        $error = $_SESSION['error'];

    ?>
        <div class="alert alert-warning">
            <ul>
                <?php
                foreach ($error as $value) {
                    echo "<li> " . $value . " </li>";
                }
                ?>
            </ul>
        </div>
    <?php
        session_destroy();
    }
    ?>
    <?php
    $seleksimapel = 1;
    if (isset($_POST['mapel']) && $_POST['mapel'] != 1) {
        $sql = "SELECT * FROM tbl_siswa LEFT JOIN nilai1 ON tbl_siswa.nis=nilai1.nis LEFT JOIN mapel ON mapel.kd_mapel=nilai1.kd_mapel WHERE nilai1.kd_mapel='" . $_POST['mapel'] . "'";
        $seleksimapel = $_POST['mapel'];
    } else {
        $sql = "SELECT * FROM tbl_siswa LEFT JOIN nilai1 ON nilai1.nis=tbl_siswa.nis LEFT JOIN mapel ON mapel.kd_mapel=nilai1.kd_mapel INNER JOIN kelas ON kelas.id_kelas=tbl_siswa.id_kelas";
    }
    ?>
    <?php 
    if(isset($_POST['inmapel']) && $_POST['insiswa']) {
        $kd_mapel = $_POST['inmapel'];
        $nis = $_POST['insiswa'];

        $cari = "SELECT * FROM nilai1 WHERE nis='$nis' AND kd_mapel='$kd_mapel'";

        $hasil = $con->query($cari);

        if($hasil->num_rows > 0) {
            echo "<div class='alert alert-danger'>Data Sudah ada</div>";
        }

        $simpan = "INSERT INTO nilai1(kd_mapel,nis) VALUES ('$kd_mapel','$nis')";
        
        $result = $con->query($simpan);
        
        if($result) {
            if(!$con->affected_rows>0) {
                echo "<div class='alert'>Data Gagal Di Input</div>";
            }
        }
    }
    
    ?>
    <div class="h3 mt-5">Data Nilai</div>
    <div class="row">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>?menu=nilai" method="POST" class="col">
            <div class="col-xl-5">
                <div class="input-group mb-3 mt-3">
                    <select name="mapel" id="" class="form-control form-select rounded-pill" aria-label="Username" aria-describedby="basic-addon1">
                        <option value="1" selected>--Pilih Mapel--</option>
                        <?php
                        $query = $con->query("SELECT * FROM mapel");
                        foreach ($query as $data) {
                        ?>
                            <option value="<?= $data["kd_mapel"] ?>"><?= $data["nama_mapel"] ?></option>
                        <?php } ?>
                    </select><input type="submit" value="search" class="btn btn-outline-primary rounded-pill">
                </div>
            </div>
        </form>

        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>?menu=nilai" method="POST" class="col">
            <div class="col d-flex justify-content-end">
                <div class="p-3 rounded-pill row align-items-start">
                    <div class="col">
                        <select name="inmapel" id="inmapel" class="form-select rounded-pill">
                            <option value="1">Pilih Mapel...</option>
                            <?php 
                            $query = $con->query("SELECT * FROM mapel");
                            foreach ($query as $data) {
                            ?>
                            <option value="<?= $data["kd_mapel"] ?>"><?= $data["nama_mapel"]?></option>
                            <?php }?>
                        </select>
                    </div>
                    <div class="col">
                        <select name="insiswa" id="insiswa" class="form-select rounded-pill">
                        <option value="1">Pilih Siswa...</option>
                            <?php 
                            $query = $con->query("SELECT * FROM kelas INNER JOIN tbl_siswa ON tbl_siswa.id_kelas=kelas.id_kelas");
                            foreach ($query as $data) {
                            ?>
                            <option value="<?= $data["nis"] ?>"><?= $data["nama_lengkap"]?></option>
                            <?php }?>
                        </select>
                    </div>
                    <div class="col d-flex justify-content-end rounded-pill">
                        <button class="btn btn-outline-success rounded-pill" type="submit">Simpan</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <table class="table bg-gray-900 text-white rounded-lg table-stripped  ">
        <thead>
            <tr>
                <th>No.</th>
                <th>Kd nilai</th>
                <th>Nama Siswa</th>
                <th>Kelas</th>
                <th>Mapel</th>
                <th>Kehadiran</th>
                <th>Tugas</th>
                <th>Formatif</th>
                <th>UTS</th>
                <th>UAS</th>
                <th>Nilai akhir</th>
                <th>Grade</th>
                <th colspan="2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $hasil = $con->query($sql);
            if (!$hasil) {
                die("Ada masalah Query : " . $con->error);
            }
            if ($hasil->num_rows > 0) {
                $no = 1;
                while ($row = $hasil->fetch_assoc()) {

            ?>
                    <tr>
                        <td><?php echo $no; ?></td>
                        <td><?php echo $row['kd_nilai']; ?></td>
                        <td><?php echo $row['nama_lengkap']; ?></td>
                        <td><?php echo $row['nama_kelas']; ?></td>
                        <td><?php echo $row['nama_mapel']; ?></td>
                        <td><?php echo $row['kehadiran']; ?></td>
                        <td><?php echo $row['tugas']; ?></td>
                        <td><?php echo $row['formatif']; ?></td>
                        <td><?php echo $row['uts']; ?></td>
                        <td><?php echo $row['uas']; ?></td>
                        <td><?php echo $row['nilai_akhir']; ?></td>
                        <td><?php echo $row['grade']; ?></td>
                        <td><a href="nilai/hapus.php?kd_nilai=<?php echo $row['kd_nilai']; ?>" id="delete" class="btn btn-danger">Delete</a></td>
                        <td><a href="?menu=nilai&mod=edit&kd_nilai=<?php echo $row['kd_nilai']; ?>" class="btn btn-warning">Input</a></td>
                    </tr>
            <?php
                    $no++;
                }
            } else {
                echo "<tr>
                        <td colspan='10'>Tidak ada data...</td>
                    </tr>";
            }
            ?>
        </tbody>
    </table>

</div>
<form action="siswa/store.php" method="post">
    <div class="modal" id="modalInput" tabindex="-1" aria-hidden="false">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Form Input Murid</h4>
                </div>
                <div class="modal-body">
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Kd Nilai</span>
                        <input type="text" name="kd_nilai" class="form-control" placeholder="Masukan Kode Nilai" aria-label="Username" aria-describedby="basic-addon1">
                    </div>

                    <div class="input-group mb-3 mt-3">
                        <span class="input-group-text" id="basic-addon1">Nama</span>
                        <select name="nama" id="" class="form-control form-select" aria-label="Username" aria-describedby="basic-addon1">
                            <option value="" selected>--Pilih Nama--</option>

                            <?php
                            $query = $con->query("SELECT * FROM tbl_siswa");
                            foreach ($query as $data) {
                            ?>
                                <option value="<?= $data["nama_lengkap"] ?>"><?= $data["nama_lengkap"] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="input-group mb-3 mt-3">
                        <span class="input-group-text" id="basic-addon1">Kelas</span>
                        <select name="kelas" id="" class="form-control form-select" aria-label="Username" aria-describedby="basic-addon1">
                            <option value="">--Pilih Kelas--</option>
                            <?php
                            $query = $con->query("SELECT * FROM tbl_siswa");
                            foreach ($query as $data) {
                            ?>
                                <option value="TAV">TAV</option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Mapel</span>
                        <select name="mapel" id="" class="form-control form-select" aria-label="Username" aria-describedby="basic-addon1">
                            <option value="">Pilih Mapel</option>
                            <option value="IPA">IPA</option>
                            <option value="IPS">IPS</option>
                            <option value="MTK">MTK</option>
                            <option value="B Indo">B Indo</option>
                        </select>
                    </div>

                </div>
                <div class="modal-footer">
                    <button class="btn btn-warning" data-bs-dismiss="modalInput">
                        Close
                    </button>
                    <button class="btn btn-success" type="submit" value="Proccess">
                        Save
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
<form action="">

</form>