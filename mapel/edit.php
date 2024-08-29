<?php
if (!isset($_GET['kd_mapel'])) {
    die('Tidak ada Akses edit');
}
$kd_mapel = $_GET['kd_mapel'];
$sql = "SELECT * FROM guru INNER JOIN mapel ON mapel.kd_guru=guru.kd_guru WHERE kd_mapel='$kd_mapel' ";
$result = $con->query($sql);

if ($result) {
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
?>
        <form action="mapel/prosesedit.php" method="post">
            <div class="container w-25 mt-5 ">
                <h1 class="border-bottom h-5 border-primary"> Edit Data</h1>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Kode Mapel</span>
                    <input type="text" name="kode_mapel" class="form-control" value="<?php echo $row['kd_mapel'] ?>" aria-label="Username" aria-describedby="basic-addon1" readonly>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Nama Mapel</span>
                    <input type="text" name="nama_mapel" class="form-control" value="<?php echo $row['nama_mapel'] ?>" aria-label="Username" aria-describedby="basic-addon1">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Nama Guru</span>
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
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Jam Pelajaran</span>
                    <select name="jp" id="jp" class="form-control form-select">
                        <option value="">Pilih Jam</option>
                        <?php
                        $noval = 1;
                        while ($noval <= 8) {
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