<?php
if (!isset($_GET['id_kelas'])) {
    die('Tidak ada Akses edit');
}
$id_kelas = $_GET['id_kelas'];
$sql = "SELECT * FROM guru INNER JOIN kelas ON kelas.kd_guru=guru.kd_guru WHERE id_kelas='$id_kelas' ";
$result = $con->query($sql);

if ($result) {
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
?>
        <form action="kelas/prosesedit.php" method="post">
            <div class="container w-25 mt-5 ">
                <h1 class="border-bottom h-5 border-primary"> Edit Data Kelas</h1>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">ID Kelas</span>
                    <input type="text" name="id_kelas" class="form-control" value="<?php echo $row['id_kelas'] ?>" aria-label="Username" aria-describedby="basic-addon1" readonly>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Nama Kelas</span>
                    <input type="text" name="nama_kelas" class="form-control" value="<?php echo $row['nama_kelas'] ?>" aria-label="Username" aria-describedby="basic-addon1">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Kapasitas Kelas</span>
                    <select name="kapasitas" id="kapasitas" class="form-control form-select">
                        <option value="<?php echo $row['kapasitas'] ?>">Pilih Kapasitas</option>
                        <?php
                        $noval = 1;
                        while ($noval <= 32) {
                            if ($row['jp'] = $noval) {
                                echo "<option selected value='$noval'>$noval</option>";
                            } else {
                                echo "<option value='$noval'>$noval</option>";
                            }
                            $noval++;
                        }

                        ?>
                    </select>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Walikelas</span>
                    <select name="kd_guru" id="kd_guru" class="form-select rounded-pill">
                        <option value="<?php echo $row['kd_guru'] ?>"><?php echo $row['nama_guru'] ?></option>
                        <?php
                        $query = $con->query("SELECT * FROM guru");
                        foreach ($query as $data) {
                        ?>
                            <option value="<?= $data["kd_guru"] ?>"><?= $data["nama_guru"] ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="d-grid gap-2 d-md-flex justify-content-md-end btn-group">
                    <button type="button" class="btn btn-primary me-md-2">Batal</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
        </form>
<?php

    } else {
        echo "<div clas='alert-danger'>Data Tidak Ditemukan</div>";
    }
}

?>