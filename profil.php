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
	<title>Profil</title>
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
    <h2>Profil Akun</h2>
    <?php
        include 'action/koneksi.php';
        $username=$_SESSION['username'];
        $data=mysqli_query($koneksi,"SELECT * FROM user WHERE username='$username' ") or die(mysqli_error($koneksi));
        $baris=mysqli_fetch_array($data);
    ?>
        <div class="uk-container">
            <form class="uk-form-stacked" action="action/act_update.php" method="post">
                <div class="uk-margin">
                    <label class="uk-form-label" for="form-stacked-text">Username</label>
                    <div class="uk-form-controls">
                        <input class="uk-input" id="form-stacked-text" type="text" name="username" value="<?php echo $baris['username']?>" maxlength="15" readonly>
                        <!--pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{5,}" title="Hanya huruf dan angka, dan harus terdiri dari 6 atau lebih karakter"-->
                    </div>
                </div>

                <div class="uk-margin">
                    <label class="uk-form-label" for="form-stacked-text">Password</label>
                    <div class="uk-form-controls">
                        <input class="uk-input" id="form-stacked-text" type="password" name="password" placeholder="Masukkan Password" maxlength="15" autocomplete="off" required>
                        <!--pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters"-->
                    </div>
                </div>
            
                <div class="uk-margin">
                    <label class="uk-form-label" for="form-stacked-text">Nama Lengkap</label>
                    <div class="uk-form-controls">
                        <input class="uk-input" id="form-stacked-text" type="text" name="nama" value="<?php echo $baris['nama']?>" placeholder="Masukkan Nama Lengkap" maxlength="30" required>
                    </div>
                </div>

                <div class="uk-margin">
                    <label class="uk-form-label" for="form-stacked-text">Tanggal Lahir</label>
                    <div class="uk-form-controls">
                        <input class="uk-input" id="form-stacked-text" type="date" name="tgl_lahir" value="<?php echo $baris['tgl_lahir']?>" min='1910-01-01' max="<?php echo date('Y-m-d');?>" required>
                    </div>
                </div>

                <div class="uk-margin">
                    <label class="uk-form-label" for="form-stacked-select">Jenis Kelamin</label>
                    <div class="uk-form-controls">
                        <select class="uk-select" id="form-stacked-select" name="jk" required>
                            <option></option>
                            <option <?php if($baris['jk']=='Pria') echo 'selected="selected"';?>>Pria</option>
                            <option <?php if($baris['jk']=='Wanita') echo 'selected="selected"';?>>Wanita</option>
                        </select>
                    </div>
                </div>

                <div class="uk-margin">
                    <label class="uk-form-label" for="form-stacked-text">Nomor Telepon</label>
                    <div class="uk-form-controls">
                        <input class="uk-input" id="form-stacked-text" type="number" name="no_telp" value="<?php echo $baris['no_telp']?>" maxlength="15" placeholder="Masukkan Nomor Telepon" required>
                    </div>
                </div>
                
                <div class="uk-margin">
                    <label class="uk-form-label" for="form-stacked-select">Alamat</label>
                    <textarea class="uk-textarea" rows="3" name="alamat" maxlength="50" placeholder="Masukkan Alamat" required><?php echo $baris['alamat']?></textarea>
                </div>
                
                <button class="uk-button uk-button-primary" type="submit" name="button">Ubah</button>

                <a href="profil_motor.php" style="padding-left:20px;">Kembali</a>

            </form>
        </div>
</div>
<br>


</body>
</html>