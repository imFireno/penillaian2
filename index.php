<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="dist/css/bootstrap.css">
    <link rel="stylesheet" href="dist/icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="dist/swal/sweetalert2.css">
    <script src="dist/swal/sweetalert2.js"></script>
    <title>Aplikasi Penilaian</title>
    <?php
    require 'config/koneksi.php';
    ?>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Poppins:ital,wght@0,700;0,800;1,800&display=swap');
    </style>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <!-- <nav class="navbar navbar-expand-lg " data-bs-theme="dark" style="background-color: #e3f2fd; font-weight: 500;">
        <div class="container-fluid">
            <a class="navbar-brand" href="#" style="font-weight: 900;"><strong>My</strong><img src="img/logow-removebg-preview.png" width="30">ebsite</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                    <a class="nav-link" href="?menu=siswa">Siswa</a>
                    <a class="nav-link" href="?menu=mapel">Mapel</a>
                    <a class="nav-link" href="?menu=nilai">Nilai</a>
                </div>
            </div>
        </div>
    </nav> -->
    <div class="sidebar fixed top-0 bottom-0 lg:left-0 p-2 w-[250px] overflow-y-auto text-center bg-gray-900 font-[Poppins]">
        <div class="text-gray-100 text-xl mt-2">
            <div class="p-2.5 mt-1 flex items-center">
                <h2 class="font-bold text-gray-200 ml-3 text-[20px]">Admin</h2>
                <i class="bi bi-x ml-[100px] cursor-pointer lg-hidden text-[25px]"></i>
            </div>
            <hr class="text-gray-100 my-2">
        </div>
        <!-- <div class="p-2.5 mt-5 flex items-center rounded-md px-4 duration-300 cursor-pointer bg-gray-700 text-white">
            <i class="bi bi-search text-sm"></i>
            <input type="text" name="" id="" placeholder="Search" class="text-[15px] ml-4 w-full bg-transparent focus:outline-none">
        </div> -->

        <a href="index.php" class="hover:text-gray-700">
            <div class="p-2.5 mt-10 flex items-center rounded-md px-4 duration-300 cursor-pointer text-gray-100 hover:bg-white hover:text-gray-900">
                <i class="bi bi-house-fill text-sm mr-[15px]"></i>
                <span>Home</span>
            </div>
        </a>
        <a href="?menu=siswa">
            <div class="p-2.5 mt-10 flex items-center rounded-md px-4 duration-300 cursor-pointer text-gray-100 hover:bg-white hover:text-gray-900">
                <i class="bi bi-person-circle text-sm mr-[15px]"></i>
                <span>Siswa</span>
            </div>
        </a>
        <a href="?menu=mapel">
            <div class="p-2.5 mt-10 flex items-center rounded-md px-4 duration-300 cursor-pointer text-gray-100 hover:bg-white hover:text-gray-900">
                <i class="bi bi-exclamation-circle text-sm mr-[15px]"></i>
                <span>Mapel</span>
            </div>
        </a>
        <a href="?menu=nilai">
            <div class="p-2.5 mt-10 flex items-center rounded-md px-4 duration-300 cursor-pointer text-gray-100 hover:bg-white hover:text-gray-900">
                <i class="bi bi-clock-history text-sm mr-[15px]"></i>
                <span>Nilai</span>
            </div>
        </a>
        <a href="?menu=guru">
            <div class="p-2.5 mt-10 flex items-center rounded-md px-4 duration-300 cursor-pointer text-gray-100 hover:bg-white hover:text-gray-900">
                <i class="bi bi-clock-history text-sm mr-[15px]"></i>
                <span>Guru</span>
            </div>
        </a>
        <a href="?menu=kelas">
            <div class="p-2.5 mt-10 flex items-center rounded-md px-4 duration-300 cursor-pointer text-gray-100 hover:bg-white hover:text-gray-900">
                <i class="bi bi-clock-history text-sm mr-[15px]"></i>
                <span>Kelas</span>
            </div>
        </a>
        <div class="p-2.5 mt-10 flex items-center rounded-md px-4 duration-300 cursor-pointer text-gray-100 hover:bg-white hover:text-gray-900" onclick="dropdown()">
            <i class="bi bi-clock-history text-sm mr-[15px]"></i>
            <span>Laporan</span>
            <span class="text-sm rotate-180 ml-[50px]" id="arrow">
                <i class="bi bi-chevron-down text-sm"></i>
            </span>
        </div>
        <div class="text-left text-sm font-thin mt-2 w-4/5 mx-auto text-gray-200 flex flex-col" id="submenu">
            <a href="?menu=raport" class="cursor-pointer p-2 hover:bg-gray-200 hover:text-gray-900 rounded-md mt-1">Raport</a>
            <a href="" class="cursor-pointer p-2 hover:bg-gray-200 hover:text-gray-900 rounded-md mt-1">List</a>
            <a href="" class="cursor-pointer p-2 hover:bg-gray-200 hover:text-gray-900 rounded-md mt-1">Raport</a>
        </div>
        <hr class="text-gray-100 my-2">
        <div class="p-2.5 mt-10 flex items-center rounded-md px-4 duration-300 cursor-pointer text-white hover:bg-white hover:text-gray-900">
            <i class="bi bi-box-arrow-right text-sm mr-[15px]"></i>
            <span class="text-[15px] ml-4">Log Out</span>
        </div>
    </div>
    <div class="container-fluid ml-[150px]">
        <?php
        if (!isset($_GET['menu']) || empty($_GET['menu'])) {
            echo "<span class='h4'>Selamat datang admin!!</span>
                    <br>
                    <p>Ini adalah aplikasi project buatan dafa fireno dan ini adalah sebuah project hehe</p>
            ";
        } else if ($_GET['menu'] == 'siswa') {
            if (isset($_GET['mod']) && $_GET['mod'] = 'edit') {
                include "siswa/edit.php";
            } else {
                include "siswa/view.php";
            }
        } else if ($_GET['menu'] == 'mapel') {
            if (isset($_GET['mod']) && $_GET['mod'] = 'edit') {
                include "mapel/edit.php";
            } else {
                include "mapel/view.php";
            }
        } else if ($_GET['menu'] == 'nilai') {
            if (isset($_GET['mod']) && $_GET['mod'] = 'edit') {
                include "nilai/edit.php";
            } else {
                include "nilai/view.php";
            }
        } else if ($_GET['menu'] == 'guru') {
            if (isset($_GET['mod']) && $_GET['mod'] = 'edit') {
                include "guru/edit.php";
            } else {
                include "guru/view.php";
            }
        } else if ($_GET['menu'] == 'kelas') {
            if (isset($_GET['mod']) && $_GET['mod'] = 'edit') {
                include "kelas/edit.php";
            } else {
                include "kelas/view.php";
            }
        } else if ($_GET['menu'] == 'raport') {
            if (isset($_GET['mod']) && $_GET['mod'] = 'lihat') {
                include "laporan/raport/view-raport.php";
            } else {
                include "laporan/raport/raport.php";
            }
        }

        ?>
    </div>
    <script type="text/javascript">
        function dropdown() {
            document.querySelector('#submenu').classList.toggle('hidden');
            document.querySelector('#arrow').classList.toggle('rotate-0');
        }
        dropdown()
    </script>
</body>
<script src="dist/js/bootstrap.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>
    $('#delete').on('click', function() {
        let getLink = $(this).attr('href');
        Swal.fire({
            title: "Confirm for delete thid data?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            confirmButtonText: 'Delete',
            cancelButtonColor: '#3085d6',
            cancelButtonText: "Cancel"

        }).then(result => {
            if (result.isConfirmed) {
                window.location.href = getLink;
            }
        })
        return false;
    });
</script>

</html>