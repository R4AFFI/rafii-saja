<?php
    session_start();
    if(!isset($_SESSION['userid'])){
        header("location:login.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Album</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Custom CSS */
        table {
            width: 100%;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Halaman Album</h1>
        <p>Selamat datang <b><?=$_SESSION['namalengkap']?></b></p>
        
        <ul class="nav">
            <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
            <li class="nav-item"><a class="nav-link" href="album.php">Album</a></li>
            <li class="nav-item"><a class="nav-link" href="foto.php">Foto</a></li>
            <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
        </ul>

        <form action="tambah_album.php" method="post" class="mt-4">
            <div class="mb-3 row">
                <label for="namaalbum" class="col-sm-2 col-form-label">Nama Album</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="namaalbum" name="namaalbum">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="deskripsi" class="col-sm-2 col-form-label">Deskripsi</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="deskripsi" name="deskripsi">
                </div>
            </div>
            <div class="mb-3 row">
                <div class="col-sm-2"></div>
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </div>
        </form>

        <table class="table table-bordered table-striped mt-5">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Deskripsi</th>
                    <th>Tanggal dibuat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    include "koneksi.php";
                    $userid=$_SESSION['userid'];
                    $sql=mysqli_query($conn,"select * from album where userid='$userid'");
                    while($data=mysqli_fetch_array($sql)){
                ?>
                        <tr>
                            <td><?=$data['albumid']?></td>
                            <td><?=$data['namaalbum']?></td>
                            <td><?=$data['deskripsi']?></td>
                            <td><?=$data['tanggaldibuat']?></td>
                            <td>
                                <a href="hapus_album.php?albumid=<?=$data['albumid']?>" class="btn btn-danger">Hapus</a>
                                <a href="edit_album.php?albumid=<?=$data['albumid']?>" class="btn btn-warning">Edit</a>
                            </td>
                        </tr>
                <?php
                    }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS (optional, if you need Bootstrap JavaScript features) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
