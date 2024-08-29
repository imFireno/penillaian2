<?php
if (!isset($_GET['kd_nilai'])) {
    die('Tidak ada Akses edit');
}
$kd_nilai = $_GET['kd_nilai'];
$sql = "SELECT * FROM nilai1 WHERE kd_nilai='$kd_nilai' ";
$result = $con->query($sql);

if ($result) {
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

?>
        <form action="nilai/prosesedit.php" method="post">
            <div class="container w-25 mt-5 ml-[700px]">
                <h1 class="border-bottom h-5 border-primary"> Edit Data</h1>
                <input type="hidden" name="kd" value="<?php echo $row['kd_nilai'] ?>">
                <div class="mb-3">
                    <label for="kehadiran">Kehadiran</label>
                    <input type="text" name="kehadiran" class="form-control" placeholder="Masukan Kehadiran" value="<?php echo $row['kehadiran'] ?>">
                </div>
                <div class=" mb-3">
                    <label for="kehadiran">Tugas</label>
                    <input type="text" name="tugas" class="form-control" placeholder="Masukan Nilai tugas" value="<?php echo $row['tugas'] ?>">
                </div>
                <div class="mb-3">
                    <label for="kehadiran">Formatif</label>
                    <input type="text" name="formatif" class="form-control" placeholder="Masukan Nilai Formatif" value="<?php echo $row['formatif'] ?>">
                </div>
                <div class=" mb-3">
                    <label for="kehadiran">UTS</label>
                    <input type="text" name="uts" class="form-control" placeholder="Masukan Nilai UTS" value="<?php echo $row['uts'] ?>">
                </div>
                <div class="mb-3">
                    <label for="kehadiran">UAS</label>
                    <input type="text" name="uas" class="form-control" placeholder="Masukan Nilai UAS" value="<?php echo $row['uas'] ?>">
                </div>
                <div class=" mb-3">
                    <label for="kehadiran">Nilai Akhir</label>
                    <input type="text" name="nilai_akhir" class="form-control" readonly value="<?php echo $row['nilai_akhir'] ?>">
                </div>
                <div class=" mb-3">
                    <label for="kehadiran">Grade</label>
                    <input type="text" name="grade" class="form-control" readonly value="<?php echo $row['grade'] ?>">
                </div>
                <div class="d-grid gap-2 d-md-flex justify-content-md-end btn-group">
                    <a href="index.php?menu=nilai" class="btn btn-outline-primary">Batal</a>
                    <button type="submit" class="btn btn-outline-primary">Update</button>
                </div>
            </div>
        </form>
<?php

    } else {
        echo "<div clas='alert-danger'>Data Tidak Ditemukan</div>";
    }
}

?>