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
	<script src="js/uikit.min.js"></script>
	<script src="js/uikit-icons.min.js"></script>
	<title>Booking Service Motor</title>
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
    <h2>Tambah Data Motor</h2>
        <div class="uk-container">
            <form class="uk-form-stacked" action="action/act_tambah_motor.php" method="post">
                <div class="uk-margin">
                    <label class="uk-form-label" for="form-stacked-text">Nomor Polisi</label>
                    <div class="uk-form-controls">
                        <input class="uk-input" id="form-stacked-text" type="text" name="no_polisi" placeholder="Masukkan Nomor Polisi" maxlength="10" required>
                        <!--pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{5,}" title="Hanya huruf dan angka, dan harus terdiri dari 6 atau lebih karakter"-->
                    </div>
                </div>

                <div class="uk-margin">
                    <label class='uk-form-label' for='form-stacked-select'>Jenis Motor</label>
                    <div class='uk-form-controls'>
                        <select class='uk-select' id='form-stacked-select' name='jenis_motor' required>
                            <option></option>
                            <option>Cub</option>
                            <option>Matic</option>
                            <option>Sport</option>
                        </select>
                    </div>
                </div>
            
                <div class="uk-margin">
                    <label class='uk-form-label' for='form-stacked-select'>Merk Motor</label>
                    <div class='uk-form-controls'>
                        <select class='uk-select' id='form-stacked-select' name='merk_motor' required>
                            <option></option>
                            <option>Honda</option>
                            <option>Yamaha</option>
                            <option>Suzuki</option>
                            <option>Kawasaki</option>
                            <option>Lainnya</option>
                        </select>
                    </div>
                </div>

                <div class="uk-margin">
                    <label class='uk-form-label' for='form-stacked-text'>Nama Motor</label>
                    <div class='uk-form-controls'>
                    <input class='uk-input' id='form-stacked-text' type='text' name='nama_motor' placeholder='Masukkan Nama Motor' maxlength='20' required>
                    </div>
                </div>
                
                <button class="uk-button uk-button-primary" type="submit" name="button">TAMBAH MOTOR</button>

            </form>
        </div>
</div>
<br>


</body>
</html>