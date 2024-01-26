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
    <h2>Jadwal Service Motor</h2>
    <div class="uk-container">
        <div class="uk-margin">
            <form class="uk-form-stacked" action="#" method="POST" <?php if(isset($_POST['tanggal'])){ echo "hidden";}else{} ?>>
                <div class="uk-margin">
                    <label class="uk-form-label" for="form-stacked-text">Lihat Tanggal</label>
                    <div class="uk-form-controls">
                        <input class="uk-input" id="form-stacked-text" type="date" name="tanggal" min="<?php echo date('Y-m-d',strtotime('+1 day'));?>" max="<?php echo date('Y-m-d',strtotime('+7 day'));?>" required>
                    </div>
                </div>
                <?php
                if(isset($_POST['tanggal'])){
                }else{
                echo "<div class='uk-margin'>
                        <button class='uk-button uk-button-primary' type='submit' name='button'>Submit</button>
                        <a href='profil_motor.php' class='uk-button uk-button-danger'>Kembali</a>
                    </div>";}
                ?>
            </form>
            
            <form class="uk-form-stacked" action="action/act_pesan_jadwal.php" method="post" <?php if(isset($_POST['tanggal'])){}else{ echo "hidden";} ?>>
                <label class="uk-form-label" for="form-stacked-text">Status Reservasi</label>
                <table class="uk-table uk-table-divider uk-table-hover">
                    <thead>
                        <tr>
                            <th><center>09.00 WIT</center></th>
                            <th><center>11.00 WIT</center></th>
                            <th><center>13.00 WIT</center></th>
                            <th><center>15.00 WIT</center></th>
                        </tr>
                    </thead>
            
                    <tbody>
                        <?php
                            include 'action/koneksi.php';
                            $tanggal=$_POST['tanggal'];
                            
                            $data=mysqli_query($koneksi,"SELECT * FROM transaksi where tanggal='$tanggal'") or die(mysqli_error($koneksi));

                            $query1=mysqli_query($koneksi,"SELECT * FROM transaksi where tanggal='$tanggal' and kode_jadwal='kdjw001'");
                            $hasil1=mysqli_num_rows($query1);
                            
                            $query2=mysqli_query($koneksi,"SELECT * FROM transaksi where tanggal='$tanggal' and kode_jadwal='kdjw002'");
                            $hasil2=mysqli_num_rows($query2);
                            
                            $query3=mysqli_query($koneksi,"SELECT * FROM transaksi where tanggal='$tanggal' and kode_jadwal='kdjw003'");
                            $hasil3=mysqli_num_rows($query3);

                            $query4=mysqli_query($koneksi,"SELECT * FROM transaksi where tanggal='$tanggal' and kode_jadwal='kdjw004'");
                            $hasil4=mysqli_num_rows($query4);

                            
                            echo "<tr>
                                    <td><center>$hasil1</center></td>
                                    <td><center>$hasil2</center></td>
                                    <td><center>$hasil3</center></td>
                                    <td><center>$hasil4</center></td>
                                </tr>";
                        ?>
                    </tbody>
                </table>
                <label class="uk-form-label" for="form-stacked-text" style="color:grey">Keterangan :</label>
                <label class="uk-form-label" for="form-stacked-text" style="color:grey">0 - 5 (kosong - penuh)</label>

                <div class="uk-margin">
                    <label class="uk-form-label" for="form-stacked-text">Tanggal</label>
                    <div class="uk-form-controls">
                        <input class="uk-input" id="form-stacked-text" type="date" name="tanggal" min="<?php echo date('Y-m-d',strtotime('+1 day'));?>" max="<?php echo date('Y-m-d',strtotime('+7 day'));?>" value="<?php if(isset($_POST['tanggal'])){ echo $_POST['tanggal'];}else{ echo'';} ?>" readonly required>
                    </div>
                </div>

                <!-- Inside the form -->
                <div class="uk-margin">
                    <label class='uk-form-label' for='form-stacked-select'>Jenis Motor</label>
                    <div class='uk-form-controls'>
                        <select class='uk-select' id='form-stacked-select' name='jenis_motor' required>
                            <option></option>
                            <?php
                                include 'action/koneksi.php';
                                $username = $_SESSION['username'];

                                // Fetch distinct jenis_motor values from the database
                                $jenisMotorQuery = mysqli_query($koneksi, "SELECT DISTINCT jenis_motor FROM motor WHERE username='$username'");
                                
                                // Populate the dropdown with fetched values
                                while ($barisJenisMotor = mysqli_fetch_assoc($jenisMotorQuery)) {
                                    $jenisMotorValue = $barisJenisMotor['jenis_motor'];
                                    echo "<option>$jenisMotorValue</option>";
                                }
                            ?>
                        </select>
                    </div>
                </div>


                <div class="uk-margin">
                    <label class="uk-form-label" for="form-stacked-text">Nomor Polisi</label>
                    <div class='uk-form-controls'>
                        <select class='uk-select' id='form-stacked-select' name='no_polisi' required>
                            <option></option>
                            <?php
                                include 'action/koneksi.php';
                                $username=$_SESSION['username'];
                                $data=mysqli_query($koneksi,"SELECT * FROM motor where username='$username'") or die(mysqli_error($koneksi));
                                
                                foreach($data as $baris){ ?>
                                    <option><?php echo $baris['no_polisi'];?></option>
                                <?php } ?>
                        </select>
                    </div>
                </div>

                <div class="uk-margin">
                    <label class="uk-form-label" for="form-stacked-text">Pesan Pada Jam</label>
                    <div class='uk-form-controls'>
                        <select class='uk-select' id='form-stacked-select' name='waktu' required>
                            <option></option>
                            <option>09:00 WIB</option>
                            <option>11:00 WIB</option>
                            <option>13:00 WIB</option>
                            <option>15:00 WIB</option>
                        </select>
                    </div>
                <div class="uk-margin">
                    <button class="uk-button uk-button-primary" type="submit" name="button">Pesan Jadwal</button>
                    <a href='profil_motor.php' class='uk-button uk-button-danger'>Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>