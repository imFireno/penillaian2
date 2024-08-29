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
    <h2 class="mt-5 font-[Poppins]" style="font-weight: 900;">Data Siswa</h2>
    <div class="container mt-2">
        <div class="row">
            <div class="col">
                <div class="p-2 mb-3 max-w-xs rounded-md px-4 cursor-pointer bg-gray-700 text-white">
                    <i class="bi bi-search text-sm"></i>
                    <input type="text" name="" id="" placeholder="Cari Siswa" class="text-[15px] ml-4 w-auto     bg-transparent focus:outline-none">
                </div>
            </div>
            <div class="col">
                <button class="btn btn-success float-end" data-bs-toggle="modal" data-bs-target="#modalInput">
                    <i class="bi bi-person-fill-add"></i> Tambah Data
                </button>
            </div>
        </div>
    </div>
    <table class="table bg-gray-900 text-white rounded-lg table-stripped ">
        <thead>
            <tr>
                <th>No.</th>
                <th>Nis</th>
                <th>Nama</th>
                <th>Kelas</th>
                <th>Tanggal lahir</th>
                <th>Jenis Kelamin</th>
                <th>Alamat</th>
                <th>No telp</th>
                <th>Agama</th>
                <th>Jurusan</th>
                <th colspan="2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM kelas INNER JOIN tbl_siswa ON tbl_siswa.id_kelas=kelas.id_kelas";

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
                        <td><?php echo $row['nis']; ?></td>
                        <td><?php echo $row['nama_lengkap']; ?></td>
                        <td><?php echo $row['nama_kelas']; ?></td>
                        <td><?php echo $row['tgl_lahir']; ?></td>
                        <td><?php echo $row['jenis_kelamin'] ?></td>
                        <td><?php echo $row['alamat']; ?></td>
                        <td><?php echo $row['no_tlp']; ?></td>
                        <td><?php echo $row['agama']; ?></td>
                        <td><?php echo $row['jurusan']; ?></td>
                        <td><a href="siswa/hapus.php?nis=<?php echo $row['nis']; ?>" id="delete" class="btn btn-danger">Delete</a></td>
                        <td><a href="?menu=siswa&mod=edit&nis=<?php echo $row['nis']; ?>" class="btn btn-warning">Edit</a></td>
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
                        <span class="input-group-text" id="basic-addon1">Nis</span>
                        <input type="text" name="nis" class="form-control" placeholder="Masukan Nis" aria-label="Username" aria-describedby="basic-addon1">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Nama</span>
                        <input type="text" name="nama" class="form-control" placeholder="Masukan Nama Lengkap" aria-label="Username" aria-describedby="basic-addon1">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Tanggal Lahir</span>
                        <input type="date" name="tgl_lahir" class="form-control" placeholder="Masukan Tanggal Lahir" aria-label="Username" aria-describedby="basic-addon1">
                    </div>
                    <div>
                        <div class="input-group mb-3 mt-3">
                            <span class="input-group-text" id="basic-addon1">Jenis Kelamin</span>
                            <select name="jk" id="" class="form-control form-select" aria-label="Username" aria-describedby="basic-addon1">
                                <option value="" selected>Masukan Kelamin</option>
                                <option value="Laki laki">Laki laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Alamat</span>
                        <input type="text" name="alamat" class="form-control" placeholder="Masukan Alamat" aria-label="Username" aria-describedby="basic-addon1">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">No Telp</span>
                        <input type="text" name="no_tlp" class="form-control" placeholder="Masukan Telp" aria-label="Username" aria-describedby="basic-addon1">
                    </div>
                    <div class="input-group mb-3 mt-3">
                        <span class="input-group-text" id="basic-addon1">Jurusan</span>
                        <select name="agama" id="" class="form-control form-select" aria-label="Username" aria-describedby="basic-addon1">
                            <option value="" selected>Pilih Agama</option>
                            <option value="islam">Islam</option>
                            <option value="kristen">Kristen</option>
                        </select>
                    </div>
                    <div class="input-group mb-3 mt-3">
                        <span class="input-group-text" id="basic-addon1">Jurusan</span>
                        <select name="jurusan" id="" class="form-control form-select" aria-label="Username" aria-describedby="basic-addon1">
                            <option value="">Pilih Jurusan</option>
                            <option value="RPL">RPL</option>
                            <option value="TKR">TKR</option>
                            <option value="TITL">TITL</option>
                            <option value="TAV">TAV</option>
                        </select>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Nama Kelas</span>
                        <select name="namakelas" id="namaGuru" class="form-select rounded-pill">
                            <option value="1">Pilih Kelas...</option>
                            <?php
                            $query = $con->query("SELECT * FROM kelas");
                            foreach ($query as $data) {
                            ?>
                                <option value="<?= $data["id_kelas"] ?>"><?= $data["nama_kelas"] ?></option>
                            <?php } ?>
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