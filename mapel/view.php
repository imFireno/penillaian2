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
                    echo "<li>ISI DULU " . $value . " NYA!! </li>";
                }
                ?>
            </ul>
        </div>
    <?php
        session_destroy();
    }
    ?>
    <h2 class="mt-5 font-[poppins]">Mata Pelajaran
        <button class="btn btn-success float-end" data-bs-toggle="modal" data-bs-target="#modalInput">
            <i class="bi bi-person-fill-add"></i> Tambah Data
        </button>
    </h2>
    <table class="table bg-gray-900 text-white rounded-lg table-stripped ">
        <thead>
            <tr>
                <th>No.</th>
                <th>Kd mapel</th>
                <th>Nama Mapel</th>
                <th>Nama Guru</th>
                <th>Jam Pelajaran</th>
                <th colspan="2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM guru INNER JOIN mapel ON mapel.kd_guru=guru.kd_guru";

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
                        <td><?php echo $row['kd_mapel']; ?></td>
                        <td><?php echo $row['nama_mapel']; ?></td>
                        <td><?php echo $row['nama_guru']; ?></td>
                        <td><?php echo $row['jp']; ?></td>
                        <td>
                            <a href="mapel/hapus.php?kd_mapel=<?php echo $row['kd_mapel']; ?>" class="btn btn-danger" id="delete">Delete</a>
                            <a href="?menu=mapel&mod=edit&kd_mapel=<?php echo $row['kd_mapel']; ?>" class="btn btn-warning text-light" id="edit">Edit</a>

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
<form action="mapel/store.php" method="post">
    <div class="modal" id="modalInput" tabindex="-1" aria-hidden="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Form Input Murid</h4>
                </div>
                <div class="modal-body">
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Kode Mapel</span>
                        <input type="text" name="kode_mapel" class="form-control" placeholder="Masukan Kode Mapel" aria-label="Username" aria-describedby="basic-addon1">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Nama Mapel</span>
                        <input type="text" name="nama_mapel" class="form-control" placeholder="Masukan Nama Mapel" aria-label="Username" aria-describedby="basic-addon1">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Nama Guru</span>
                        <select name="namaGuru" id="namaGuru" class="form-select rounded-pill">
                            <option value="1">Pilih Nama Guru...</option>
                            <?php
                            $query = $con->query("SELECT * FROM guru");
                            foreach ($query as $data) {
                            ?>
                                <option value="<?= $data["kd_guru"] ?>"><?= $data["nama_guru"] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Jam Pelajaran</span>
                        <input type="text" name="jp" class="form-control" placeholder="Masukan Jam Pelajaran" aria-label="Username" aria-describedby="basic-addon1">
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-warning" data-bs-dismiss="modal">
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