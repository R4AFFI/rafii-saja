<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Landing</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Halaman Landing</h1>
        <?php
            session_start();
            if(!isset($_SESSION['userid'])){
        ?>
                <ul class="nav">
                    <li class="nav-item"><a class="nav-link" href="register.php">Register</a></li>
                    <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
                </ul>
        <?php
            } else {
        ?>   
            <p>Selamat datang <b><?=$_SESSION['namalengkap']?></b></p>
            <ul class="nav">
                <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="album.php">Album</a></li>
                <li class="nav-item"><a class="nav-link" href="foto.php">Foto</a></li>
                <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
            </ul>
        <?php
            }
        ?>

        <table class="table table-bordered table-striped mt-5">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Judul</th>
                    <th>Deskripsi</th>
                    <th>Foto</th>
                    <th>Uploader</th>
                    <th>Jumlah Like</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    include "koneksi.php";
                    $sql=mysqli_query($conn,"select * from foto,user where foto.userid=user.userid");
                    while($data=mysqli_fetch_array($sql)){
                ?>
                    <tr>
                        <td><?=$data['fotoid']?></td>
                        <td><?=$data['judulfoto']?></td>
                        <td><?=$data['deskripsifoto']?></td>
                        <td>
                            <img src="gambar/<?=$data['lokasifile']?>" width="200px" class="img-fluid">
                        </td>
                        <td><?=$data['namalengkap']?></td>
                        <td>
                            <?php
                                $fotoid=$data['fotoid'];
                                $sql2=mysqli_query($conn,"select * from likefoto where fotoid='$fotoid'");
                                echo mysqli_num_rows($sql2);
                            ?>
                        </td>
                        <td>
                            <a href="like.php?fotoid=<?=$data['fotoid']?>" class="btn btn-primary">Like</a>
                            <a href="komentar.php?fotoid=<?=$data['fotoid']?>" class="btn btn-secondary">Komentar</a>
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
