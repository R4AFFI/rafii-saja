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
    <title>Halaman Edit Foto</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Halaman Edit Foto</h1>
        <p>Selamat datang <b><?=$_SESSION['namalengkap']?></b></p>
        
        <ul class="nav">
            <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
            <li class="nav-item"><a class="nav-link" href="album.php">Album</a></li>
            <li class="nav-item"><a class="nav-link" href="foto.php">Foto</a></li>
            <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
        </ul>

        <form action="update_foto.php" method="post" enctype="multipart/form-data" class="mt-4">
            <?php
                include "koneksi.php";
                $fotoid=$_GET['fotoid'];
                $sql=mysqli_query($conn,"select * from foto where fotoid='$fotoid'");
                while($data=mysqli_fetch_array($sql)){
            ?>
            <input type="text" name="fotoid" value="<?=$data['fotoid']?>" hidden>
            <div class="mb-3 row">
                <label for="judulfoto" class="col-sm-2 col-form-label">Judul</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="judulfoto" name="judulfoto" value="<?=$data['judulfoto']?>">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="deskripsifoto" class="col-sm-2 col-form-label">Deskripsi</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="deskripsifoto" name="deskripsifoto" value="<?=$data['deskripsifoto']?>">
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
                            $userid=$_SESSION['userid'];
                            $sql2=mysqli_query($conn,"select * from album where userid='$userid'");
                            while($data2=mysqli_fetch_array($sql2)){
                        ?>
                        <option value="<?=$data2['albumid']?>" <?php if($data2['albumid']==$data['albumid']){echo 'selected';}?>><?=$data2['namaalbum']?></option>
                        <?php
                            }
                        ?>
                    </select>
                </div>
            </div>
            <div class="mb-3 row">
                <div class="col-sm-2"></div>
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary">Ubah</button>
                </div>
            </div>
            <?php
                }
            ?>
        </form>
    </div>

    <!-- Bootstrap JS (optional, if you need Bootstrap JavaScript features) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
