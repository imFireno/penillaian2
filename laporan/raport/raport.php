<div class="container">
    <?php
    session_start();

    if (isset($_SESSION['error'])) {
        $error = $_SESSION['error'];

    ?>
    <?php
        session_destroy();
    }
    ?>
    <h2 class="mt-5 font-[poppins]">Raport Kelas
    </h2>
    <table class="table bg-gray-900 text-white rounded-lg table-stripped ">
        <thead>
            <tr>
                <th>No.</th>
                <th>Nis</th>
                <th>Nama Murid</th>
                <th>Kelas</th>
                <th colspan="3">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM tbl_siswa INNER JOIN kelas ON kelas.id_kelas=tbl_siswa.id_kelas";

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
                        <td>
                          <a href="laporan/raport/cetak.php?nis=<?php echo $row['nis']; ?>" class="btn btn-warning text-light" id="edit">Lihat Raport</a>
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
