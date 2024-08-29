<?php
if (!isset($_GET['nis'])) {
    die('Tidak ada Akses edit');
}
$nis = $_GET['nis'];
$sql = "SELECT * FROM kelas INNER JOIN tbl_siswa ON tbl_siswa.id_kelas=kelas.id_kelas WHERE nis='$nis' ";
$result = $con->query($sql);

if ($result) {
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

?>
        <form action="siswa/prosesedit.php" method="post">
            <div class="container">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4>Edit Murid</h4>
                    </div>
                    <div class="modal-body">
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Nis</span>
                            <input type="text" name="nis" class="form-control" value="<?php echo $row['nis'] ?>">
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Nama</span>
                            <input type="text" name="nama" class="form-control" value="<?php echo $row['nama_lengkap'] ?>">
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Kelas</span>
                            <select name="kelas" id="id_kelas" class="form-select rounded-pill">
                                <option value="<?php echo $row['id_kelas'] ?>"><?php echo $row['nama_kelas'] ?></option>
                                <?php
                                $query = $con->query("SELECT * FROM kelas");
                                foreach ($query as $data) {
                                ?>
                                    <option value="<?= $data["id_kelas"] ?>"><?= $data["nama_kelas"] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Tanggal Lahir</span>
                            <input type="date" name="tgl_lahir" class="form-control" value="<?php echo $row['tgl_lahir'] ?>">
                        </div>
                        <div>
                            <div class="input-group mb-3 mt-3">
                                <span class="input-group-text" id="basic-addon1">Jenis Kelamin</span>
                                <select name="jk" id="" class="form-control form-select" aria-label="Username">
                                    <option value="" disabled><?php echo $row['jenis_kelamin'] ?></option>
                                    <option value="Laki laki">Laki laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Alamat</span>
                            <input type="text" name="alamat" class="form-control" value="<?php echo $row['alamat'] ?>" aria-label="Username" aria-describedby="basic-addon1">
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">No Telp</span>
                            <input type="text" name="no_tlp" class="form-control" value="<?php echo $row['no_tlp'] ?>" aria-label="Username" aria-describedby="basic-addon1">
                        </div>
                        <div class="input-group mb-3 mt-3">
                            <span class="input-group-text" id="basic-addon1">Jurusan</span>
                            <select name="agama" id="" class="form-control form-select" aria-label="Username" aria-describedby="basic-addon1">
                                <option value="" disabled><?php echo $row['agama'] ?></option>
                                <option value="islam">Islam</option>
                                <option value="kristen">Kristen</option>
                            </select>
                        </div>
                        <div class="input-group mb-3 mt-3">
                            <span class="input-group-text" id="basic-addon1">Jurusan</span>
                            <select name="jurusan" id="" class="form-control form-select" aria-label="Username" aria-describedby="basic-addon1">
                                <option value="" disabled> <?php echo $row['jurusan'] ?> </option>
                                <option value="RPL">RPL</option>
                                <option value="TKR">TKR</option>
                                <option value="TITL">TITL</option>
                                <option value="TAV">TAV</option>
                            </select>
                        </div>
                    </div>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end btn-group">
                        <button type="button" class="btn btn-primary me-md-2">Batal</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </div>
            </div>
        </form>
<?php

    } else {
        echo "<div clas='alert-danger'>Data Tidak Ditemukan</div>";
    }
}

?>