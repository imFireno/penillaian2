<?php
if (!isset($_GET['kd_guru'])) {
    die('Tidak ada Akses edit');
}
$kd_guru = $_GET['kd_guru'];
$sql = "SELECT * FROM guru WHERE kd_guru='$kd_guru' ";
$result = $con->query($sql);

if ($result) {
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();




?>
        <form action="guru/prosesedit.php" method="post">
        <div class="container w-25 mt-5 ">
            <h1 class="border-bottom h-5 border-primary"> Edit Data</h1>
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">Kode Guru</span>
                <input type="text" name="kd_guru" class="form-control" value="<?php echo $row['kd_guru']?>" aria-describedby="basic-addon1" readonly> 
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">Nama Guru</span>
                <input type="text" name="nama_guru" class="form-control" value="<?php echo $row['nama_guru']?>" aria-describedby="basic-addon1">
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">Pendidikan</span>
                <select name="pendidikan" id="pendidikan" class="form-control form-select">
                    <option value="<?= $row['pendidikan']?>"><?= $row['pendidikan']?></option>
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
                <input type="text" name="prodi" class="form-control" value="<?php echo $row['prodi']?>" aria-label="Username" aria-describedby="basic-addon1">
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