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
    <h2 class="mt-5 font-[poppins]">Data Kelas
        <button class="btn btn-success float-end" data-bs-toggle="modal" data-bs-target="#modalInput">
            <i class="bi bi-person-fill-add"></i> Tambah Data
        </button>
    </h2>
    <table class="table bg-gray-900 text-white rounded-lg table-stripped ">
        <thead>
            <tr>
                <th>No.</th>
                <th>Kd Kelas</th>
                <th>Nama Kelas</th>
                <th>Kapasitas</th>
                <th>Wali Kelas</th>
                <th colspan="2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM guru INNER JOIN kelas ON kelas.kd_guru=guru.kd_guru";

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
                        <td><?php echo $row['id_kelas']; ?></td>
                        <td><?php echo $row['nama_kelas']; ?></td>
                        <td><?php echo $row['kapasitas']; ?></td>
                        <td><?php echo $row['nama_guru']; ?></td>
                        <td>
                            <a href="kelas/hapus.php?kd_kelas=<?php echo $row['id_kelas']; ?>" class="btn btn-danger" id="delete">Delete</a>
                            <a href="?menu=kelas&mod=edit&id_kelas=<?php echo $row['id_kelas']; ?>" class="btn btn-warning text-light" id="edit">Edit</a>

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
<form action="kelas/store.php" method="post">
    <div class="modal" id="modalInput" tabindex="-1" aria-hidden="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Form Input Kelas</h4>
                </div>
                <div class="modal-body">
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Id Kelas</span>
                        <input type="text" name="id_kelas" class="form-control" placeholder="Masukan Kode Kelas" aria-label="Username" aria-describedby="basic-addon1">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Nama Kelas</span>
                        <input type="text" name="nama_kelas" class="form-control" placeholder="Masukan Nama Mapel" aria-label="Username" aria-describedby="basic-addon1">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Kapasitas</span>
                        <input type="text" name="kapasitas" class="form-control" placeholder="Masukan Nama Mapel" aria-label="Username" aria-describedby="basic-addon1">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Walikelas</span>
                        <select name="walas" id="walas" class="form-select rounded-pill">
                            <option value="1">Pilih Walikelas</option>
                            <?php
                            $query = $con->query("SELECT * FROM guru");
                            foreach ($query as $data) {
                            ?>
                                <option value="<?= $data["kd_guru"] ?>"><?= $data["nama_guru"] ?></option>
                            <?php } ?>
                        </select>
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