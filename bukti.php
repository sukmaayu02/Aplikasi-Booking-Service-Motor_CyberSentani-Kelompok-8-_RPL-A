<!DOCTYPE html>
<?php
	session_start();
    include "action/act_cek.php";
?>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Bukti Pembayaran</title>
 
  <style>
@media print {
    .page-break { display: block; page-break-before: always; }
}
      #invoice-POS {
  box-shadow: 0 0 1in -0.25in rgba(0, 0, 0, 0.5);
  padding: 2mm;
  margin: 0 auto;
  width: 100mm;
  background: #FFF;
}
#invoice-POS ::selection {
  background: #f31544;
  color: #FFF;
}
#invoice-POS ::moz-selection {
  background: #f31544;
  color: #FFF;
}
#invoice-POS h1 {
  font-size: 1.5em;
  color: #222;
}
#invoice-POS h2 {
  font-size: 20px;
}
#invoice-POS h3 {
  font-size: 1.2em;
  font-weight: 300;
  line-height: 2em;
}
#invoice-POS p {
  font-size: 25px;
  color: #666;
  line-height: 1.2em;
}
#invoice-POS #top, #invoice-POS #mid, #invoice-POS #bot {
  /* Targets all id with 'col-' */
  border-bottom: 1px solid #EEE;
}
#invoice-POS #top {
  min-height: 100px;
}
#invoice-POS #mid {
  min-height: 80px;
}
#invoice-POS #bot {
  min-height: 50px;
}
#invoice-POS #top .logo {
  height: 90px;
  width: 150px;
  background: url(img/logo.png) no-repeat;
  background-size: 150px 80px;
}
#invoice-POS .clientlogo {
  float: left;
  height: 90px;
  width: 80px;
  background: url(img/logo.png) no-repeat;
  background-size: 60px 80px;
  border-radius: 50px;
}
#invoice-POS .info {
  display: block;
  margin-left: 0;
}
#invoice-POS .title {
  float: right;
}
#invoice-POS .title p {
  text-align: right;
}
#invoice-POS table {
  width: 100%;
  border-collapse: collapse;
}
#invoice-POS .tabletitle {
  font-size: .5em;
  background: #EEE;
}
#invoice-POS .service {
  border-bottom: 1px solid #EEE;
}
#invoice-POS .item {
  width: 24mm;
}
#invoice-POS .itemtext {
  font-size: 25px;
}
#invoice-POS #legalcopy {
  margin-top: 5mm;
}
 
    </style>
 
  <script>
  window.console = window.console || function(t) {};
</script>
 
 
 
  <script>
  if (document.location.search.match(/type=embed/gi)) {
    window.parent.postMessage("resize", "*");
  }
</script>
 
 
</head>
 
<body translate="no" >
 
 
  <div id="invoice-POS">
 
    <center id="top">
      <div class="logo"></div>
      <div class="info"> 
        <h2>Booking Online Service</h2>
      </div><!--End Info-->
    </center><!--End InvoiceTop-->
    <?php
        include 'action/koneksi.php';
        $username = $_SESSION['username'];
        $data = mysqli_query($koneksi, "SELECT * FROM transaksi inner join jadwal on transaksi.kode_jadwal=jadwal.kode_jadwal where transaksi.username='$username' and transaksi.status!='Batal'") or die(mysqli_error($koneksi));
        foreach ($data as $baris) { 
    ?>
            <div id="mid">
                <div class="info">
                    <h2>Info Kontak</h2>
                    <p>
                    Nama: <?php echo $baris['username'] ?></br>
                    Tanggal: <?php echo $baris['tanggal'] ?></br>
                    Waktu: <?php echo $baris['waktu'] ?><br>
                    Kode Transaksi: <?php echo $baris['kode_transaksi'] ?><br>
                    Nomor Polisi: <?php echo $baris['no_polisi'] ?><br>
                    Mekanik: <?php echo $baris['mekanik'] ?>
                    </p>
                </div>
            </div><!--End Invoice Mid-->
 
            <div id="bot">
                <div id="table">
                    <table>
                        <tr class="tabletitle">
                            <td class="item"><h2>Item</h2></td>
                            <td class="item"><h2></h2></td>
                            <td class="Hours"><h2>Qty</h2></td>
                            <td class="Rate"><h2>Sub Total</h2></td>
                        </tr>
        
                        <tr class="service">
                            <td class="tableitem"><p class="itemtext">Uang Muka</p></td>
                            <td class="tableitem"><p class="itemtext"></p></td>
                            <td class="tableitem"><p class="itemtext">1</p></td>
                            <td class="tableitem"><p class="itemtext">Rp30.000,-</p></td>
                        </tr>
                        <tr class="service">
                            <td class="tableitem"><p class="itemtext"></p></td>
                            <td class="tableitem"><p class="itemtext"></p></td>
                            <td class="tableitem"><p class="itemtext"></p></td>
                        </tr>
        
                        <tr class="tabletitle">
                        <td></td>
                        <td></td>
                                        <td class="Rate"><h2>Total</h2></td>
                                        <td class="payment"><h2>Rp30.000,-</h2></td>
                                    </tr>
        
                                </table>
                            </div><!--End Table-->
        
                            <div id="legalcopy">
                                <p class="legal"><strong>Terimakasih Telah Membayar Uang Muka!</strong> Tolong Perlihatkan ke kasir saat mengantar motor
                                </p>
                            </div>
        
                        </div><!--End InvoiceBot-->
        </div><!--End Invoice-->
    <?php   }?>
</body>
 
</html>