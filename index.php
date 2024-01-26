<!DOCTYPE html>
<?php
	session_start();
?>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/bengkel.css">
    <link rel="stylesheet" href="css/tes.css">
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
                        echo "<a href='#'' class='uk-icon-link uk-margin-small-left' uk-icon='user' style='color:black; padding-right:80px;'>Akun</a>";
                    }elseif(isset($_SESSION["username"])){
                        $akun = $_SESSION["username"];
                        echo "<a href='#' class='uk-icon-link uk-margin-small-left' uk-icon='user' style='color:black; padding-right:80px;'>Hai, $akun</a>";
                    }
                ?>
                <div class="uk-navbar-dropdown">
                    <ul class="uk-nav uk-navbar-dropdown-nav">
                        <?php
                            if(empty($_SESSION["username"])){
                                echo "<li class='uk-active'><a href='login.php'>Masuk</a></li>";
						        echo "<li class='uk-active'><a href='daftar.php'>Daftar</a></li>";
                                echo "<li class='uk-active'><a href='admin/index.php'>Masuk Sebagai Admin</a></li>";
                            }elseif(isset($_SESSION["username"])){
                                echo "<li class='uk-active'><a href='profil.php'>Profil Akun</a></li>";
                                echo "<li class='uk-active'><a href='profil_motor.php'>Data Motor</a></li>";
                                echo "<li><hr></li>";
                                echo "<li class='uk-active'><a href='action/act_logout.php'>Keluar</a></li>";

                            }
                        ?>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</nav>

<center>
<div class="uk-container" style="padding-top:30px">

    <div class="uk-tile" style="background-color:#ffd700;">
            <p class="uk-h1" style="font-family:rockwell;">Selamat Datang di<br>booking service motor</p>
    </div>

    <div class="uk-tile uk-tile-muted">
            <p class="uk-h5" style="font-family:rockwell;">Booking service motor merupakan sistem reservasi jadwal service motor berbasis web.<br></p>
    
            <p align=left class="uk-h5" style="font-family:rockwell; padding-left:80px;">Cara melakukan reservasi jadwal service cukup mudah :
                <br>&emsp;1. Daftar dan Login Akun
                <br>&emsp;2. Isi Data Motor
                <br>&emsp;3. Pilih Jadwal yang Tersedia
                <br>&emsp;4. Reservasi Berhasil
                <br>&emsp;5. Datanglah ke Bengkel dengan Motor yang Direservasikan Sebelumnya
            </p>
    </div>
</div>
</center>

</body>
</html>