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
    <h2 class="mt-5 font-[poppins]">Guru
        <button class="btn btn-success float-end" data-bs-toggle="modal" data-bs-target="#modalInput">
            <i class="bi bi-person-fill-add"></i> Tambah Data
        </button>
    </h2>
    <table class="table bg-gray-900 text-white rounded-lg table-stripped ">
        <thead>
            <tr>
                <th>No.</th>
                <th>Kd Guru</th>
                <th>Nama Guru</th>
                <th>Pendidikan</th>
                <th>Prodi Guru</th>
                <th colspan="2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM guru";

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
                        <td><?php echo $row['kd_guru']; ?></td>
                        <td><?php echo $row['nama_guru']; ?></td>
                        <td><?php echo $row['pendidikan']; ?></td>
                        <td><?php echo $row['prodi']; ?></td>
                        <td>
                            <a href="guru/hapus.php?kd_guru=<?php echo $row['kd_guru']; ?>" class="btn btn-danger" id="delete">Delete</a>
                            <a href="?menu=guru&mod=edit&kd_guru=<?php echo $row['kd_guru']; ?>" class="btn btn-warning text-light" id="edit">Edit</a>

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
<form action="guru/store.php" method="post">
    <div class="modal" id="modalInput" tabindex="-1" aria-hidden="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Tambah Data Guru</h4>
                </div>
                <div class="modal-body">
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Kode Guru</span>
                        <input type="text" name="kd_guru" class="form-control" placeholder="Masukan Kode Guru" aria-label="Username" aria-describedby="basic-addon1">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Nama Guru</span>
                        <input type="text" name="nama_guru" class="form-control" placeholder="Masukan Nama Guru" aria-label="Username" aria-describedby="basic-addon1">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Pendidikan</span>
                        <select name="pendidikan" id="pendidikan" class="form-control form-select">
                            <option value="">--Pilih Pendidikan--</option>
                            <option value="D1">D1</option>
                            <option value="D2">D2</option>
                            <option value="D3">D3</option>
                            <option value="S1">S1</option>
                            <option value="S2">S2</option>
                            <option value="S3">S3</option>
                        </select>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Program Studi</span>
                        <input type="text" name="prodi" class="form-control" placeholder="Program Studi" aria-label="Username" aria-describedby="basic-addon1">
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