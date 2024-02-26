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
    <title>Halaman Foto</title>
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
        <h1 class="mt-5">Halaman Foto</h1>
        <p>Selamat datang <b><?=$_SESSION['namalengkap']?></b></p>
        
        <ul class="nav">
            <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
            <li class="nav-item"><a class="nav-link" href="album.php">Album</a></li>
            <li class="nav-item"><a class="nav-link" href="foto.php">Foto</a></li>
            <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
        </ul>

        <form action="tambah_foto.php" method="post" enctype="multipart/form-data" class="mt-4">
            <div class="mb-3 row">
                <label for="judulfoto" class="col-sm-2 col-form-label">Judul</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="judulfoto" name="judulfoto">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="deskripsifoto" class="col-sm-2 col-form-label">Deskripsi</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="deskripsifoto" name="deskripsifoto">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="lokasifile" class="col-sm-2 col-form-label">Lokasi File</label>
                <div class="col-sm-10">
                    <input type="file" class="form-control" id="lokasifile" name="lokasifile">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="albumid" class="col-sm-2 col-form-label">Album</label>
                <div class="col-sm-10">
                    <select class="form-select" id="albumid" name="albumid">
                    <?php
                        include "koneksi.php";
                        $userid=$_SESSION['userid'];
                        $sql=mysqli_query($conn,"select * from album where userid='$userid'");
                        while($data=mysqli_fetch_array($sql)){
                    ?>
                            <option value="<?=$data['albumid']?>"><?=$data['namaalbum']?></option>
                    <?php
                        }
                    ?>
                    </select>
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
                    <th>Judul</th>
                    <th>Deskripsi</th>
                    <th>Tanggal Unggah</th>
                    <th>Lokasi File</th>
                    <th>Album</th>
                    <th>Disukai</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    include "koneksi.php";
                    $userid=$_SESSION['userid'];
                    $sql=mysqli_query($conn,"select * from foto,album where foto.userid='$userid' and foto.albumid=album.albumid");
                    while($data=mysqli_fetch_array($sql)){
                ?>
                        <tr>
                            <td><?=$data['fotoid']?></td>
                            <td><?=$data['judulfoto']?></td>
                            <td><?=$data['deskripsifoto']?></td>
                            <td><?=$data['tanggalunggah']?></td>
                            <td>
                                <img src="gambar/<?=$data['lokasifile']?>" width="200px">
                            </td>
                            <td><?=$data['namaalbum']?></td>
                            <td>
                                <?php
                                    $fotoid=$data['fotoid'];
                                    $sql2=mysqli_query($conn,"select * from likefoto where fotoid='$fotoid'");
                                    echo mysqli_num_rows($sql2);
                                ?>
                            </td>
                            <td>
                                <a href="hapus_foto.php?fotoid=<?=$data['fotoid']?>" class="btn btn-danger">Hapus</a>
                                <a href="edit_foto.php?fotoid=<?=$data['fotoid']?>" class="btn btn-warning">Edit</a>
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
