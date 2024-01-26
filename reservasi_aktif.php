<!DOCTYPE html>
<?php
    session_start();
    include "action/act_cek.php";
    
?>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://unpkg.com/feather-icons"></script>
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

        // Check if the payment success session variable is set
        if(isset($_SESSION['payment_success']) && $_SESSION['payment_success'] == true) {
            echo "<p style='color:green;'>Terima kasih telah membayar uang muka!</p>";
            // Unset the session variable to prevent the message from being displayed on subsequent visits
            unset($_SESSION['payment_success']);
        }
    ?>
    <h2>Data Motor</h2>
        <div class="uk-container">
            <table class="uk-table uk-table-hover uk-table-divider">
            <thead>
                <tr>
                    <th>Kode Transaksi</th>
                    <th>Tanggal</th>
                    <th>Waktu</th>
                    <th>Nomor Polisi</th>
                    <th>Status</th>
                    <th>Mekanik</th>
                </tr>
            </thead>
            
            <tbody>
                <?php
                    include 'action/koneksi.php';
                    $username = $_SESSION['username'];
                    $data = mysqli_query($koneksi, "SELECT * FROM transaksi inner join jadwal on transaksi.kode_jadwal=jadwal.kode_jadwal where transaksi.username='$username' and transaksi.status!='Batal'") or die(mysqli_error($koneksi));

                    foreach ($data as $baris) { 
                        ?>
                        <tr>
                            <td><?php echo $baris['kode_transaksi'] ?></td>
                            <td><?php echo $baris['tanggal'] ?></td>
                            <td><?php echo $baris['waktu'] ?></td>
                            <td><?php echo $baris['no_polisi'] ?></td>
                            <td><?php echo $baris['status'] ?></td>
                            <td><?php echo $baris['mekanik'] ?></td>
                            <td>
                                <center>
                                    <input type="button" class="uk-button uk-button-danger" onclick="location.href='action/act_batal_transaksi.php?kode_transaksi=<?php echo $baris['kode_transaksi'] ?>'" <?php if ($baris['status'] != "Belum") {echo "hidden";} ?> value="Batal">
                                </center>
                            </td>
                            <!-- Update the "Bayar" and "Upload Bukti" buttons inside the foreach loop -->
                            <td>
                                <center>
                                    <?php if ($baris['status'] == "Belum") { ?>
                                        <button class="uk-button uk-button-default" onclick="openMidtrans('<?php echo $baris['kode_transaksi']; ?>')">
                                         Bayar
                                        </button>
                                    <?php } ?>
                                </center>
                            </td>

                            <td>
                                <center>
                                    <?php if ($baris['status'] == "Belum") { ?>
                                        <input type="button" class="uk-button uk-button-primary" 
                                            onclick="openUploadModal('<?php echo $baris['kode_transaksi'] ?>')" value="Upload Bukti">
                                    <?php } ?>
                                </center>
                            </td>
                            <td>
                                <center>
                                    <?php if ($baris['status'] != "Belum") { ?>
                                        <button class="uk-button uk-button-secondary" onclick="printInvoice('<?php echo $baris['kode_transaksi'] ?>')">
                                        <i data-feather="printer"></i> <!-- Menambahkan ikon cetak -->
                                        </button>
                                    <?php } ?>
                                </center>
                            </td>
                        </tr>
                    <?php   }
                ?>
            </tbody>
        </table>
        </div>
</div>
<br>

<!-- Add this modal at the end of your HTML body -->
<div id="uploadModal" uk-modal>
    <div class="uk-modal-dialog uk-modal-body">
        <button class="uk-modal-close-default" type="button" uk-close></button>
        <h2 class="uk-modal-title">Upload Bukti</h2>
        <!-- Form for image upload -->
        <form id="uploadForm" action="action/tambah_bukti.php" method="post" enctype="multipart/form-data">
            <div class="uk-margin">
                <label for="bukti">Pilih Gambar:</label>
                <input type="file" name="bukti" accept="image/*" required>
            </div>
            <input type="hidden" id="kode_transaksi_input" name="kode_transaksi" value="">
            <p class="uk-text-right">
                <button class="uk-button uk-button-primary" type="submit">Upload</button>
            </p>
        </form>
    </div>
</div>

<!-- Add this script at the end of your HTML body -->
<script>
    feather.replace();
    function openUploadModal(kode_transaksi) {
        // Set the kode_transaksi value in the hidden input field
        document.getElementById('kode_transaksi_input').value = kode_transaksi;
        
        // Open the modal
        UIkit.modal('#uploadModal').show();
    }

    function openMidtrans(id) {
        // Buat URL pembayaran Midtrans
        var url = "https://app.sandbox.midtrans.com/payment-links/UangMuka?id=" + id; 

        // Setting pop-up
        var win = window.open(url, "_blank", "width=700,height=600");
    }  

    function printInvoice(kode_transaksi) {
        // Use AJAX to load the bukti.php content
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'bukti.php?kode_transaksi=' + kode_transaksi, true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                // Open a new window and write the bukti.php content
                var printWindow = window.open('', '_blank', 'width=700,height=600');
                printWindow.document.write(xhr.responseText);
                printWindow.document.close();

                // Trigger the print function after the content is loaded
                printWindow.print();
            }
        };
        xhr.send();
    }
</script>


</body>
</html>