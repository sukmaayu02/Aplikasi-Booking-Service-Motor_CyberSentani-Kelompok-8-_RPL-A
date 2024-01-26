<!DOCTYPE html>
<?php
    session_start();
    include "action/act_cek.php";
?>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/bengkel.css">
    <link rel="stylesheet" href="css/tes.css">
	<script src="js/uikit.min.js"></script>
	<script src="js/uikit-icons.min.js"></script>
	<title>Booking service motor</title>
</head>

<body>

<nav class="uk-navbar-container" style="background-color:#ffd700;" uk-navbar>
    <div class="uk-navbar-left">
        <ul class="uk-navbar-nav">
            <li class="uk-active" style="font-size: 35px;font-family:rockwell;"><img src="img/logo.png" style="width:100px; margin:10px" alt="">Booking service Motor</li>
        </ul>
    </div>
    
    <div class="uk-navbar-right">
        <ul class="uk-navbar-nav">
            <li>
                <?php 
                    if(empty($_SESSION["username"])){
                        echo "<a href='jadwal_service.php' style='color:white'>Lihat Jadwal Service</a>";
                    } elseif(isset($_SESSION["username"])){
                        echo "<a href='reservasi_aktif.php' style='color:black;'>Reservasi Service Aktif</a>";
                    }
                ?>
            </li>

            <li>
                <?php 
                    if(isset($_SESSION["username"])){
                        echo "<a href='pesan_jadwal_service.php' style='color:black;'>Reservasi Jadwal Service</a>";
                    }
                ?>
            </li>

            <li>
                <?php 
                    if(empty($_SESSION["username"])){
                        echo "<a href='#'' class='uk-icon-link uk-margin-small-left' uk-icon='user' style='color:black; padding-right:80px;'>Akun</a>";
                    } elseif(isset($_SESSION["username"])){
                        $akun = $_SESSION["username"];
                        echo "<a href='#' class='uk-icon-link uk-margin-small-left' uk-icon='user' style='color:black; padding-right:80px;'>Hai, $akun </a>";
                        echo "<div class='uk-navbar-dropdown'>";
                        echo "<ul class='uk-nav uk-navbar-dropdown-nav'>";
                        echo "<li class='uk-active'><a href='profil.php'>Profil Akun</a></li>";
                        echo "<li class='uk-active'><a href='profil_motor.php'>Data Motor</a></li>";
                        echo "<li><hr></li>";
                        echo "<li class='uk-active'><a href='action/act_logout.php'>&#x1F6AA; Keluar</a></li>";
                        echo "</ul>";
                        echo "</div>";
                    }
                ?>
            </li>
        </ul>
    </div>
</nav>

<div class="uk-container" style="padding-top:25px;">
    <?php
        include "action/act_alert.php";
    ?>
    <h2>Data Motor</h2>
        <div class="uk-container">
            <table class="uk-table uk-table-hover uk-table-divider">
            <thead>
                <tr>
                    <th>Nomor Polisi</th>
                    <th>Jenis Motor</th>
                    <th>Merk Motor</th>
                    <th>Nama Motor</th>
                    <th><center>
                        <button class="uk-button uk-button-primary" type="submit" onclick="location.href='tambah_motor.php'" 
                        <?php 
                            include 'action/koneksi.php';
                            $username=$_SESSION['username'];
                            $data=mysqli_query($koneksi,"SELECT * FROM motor where username='$username'") or die(mysqli_error($koneksi));
                            if(mysqli_num_rows($data)==3){echo "disabled";}
                        ?>>Tambah Data Motor</button></center>
                    </th>
                </tr>
            </thead>
            
            <tbody>
                <?php
                    include 'action/koneksi.php';
                    $username=$_SESSION['username'];
                    $data=mysqli_query($koneksi,"SELECT * FROM motor where username='$username'") or die(mysqli_error($koneksi));

                    foreach($data as $baris){ ?>
                        <tr>
                            <td><?php echo $baris['no_polisi']?></td>
                            <td><?php echo $baris['jenis_motor']?></td>
                            <td><?php echo $baris['merk_motor']?></td>
                            <td><?php echo $baris['nama_motor']?></td>
                            <td><center>
                                <a class="uk-button uk-button-danger" href="action/act_hapus_motor.php?no_polisi=<?php echo $baris['no_polisi']?>">Hapus</a></center>
                            </td>
                        </tr>
                    <?php   }
                ?>
            </tbody>
        </table>
        </div>
</div>
<br>


</body>
</html>