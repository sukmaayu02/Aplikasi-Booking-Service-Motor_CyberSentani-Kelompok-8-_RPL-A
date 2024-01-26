<?php
session_start();

include 'koneksi.php'; // Adjust the path accordingly

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $kode_transaksi = $_POST['kode_transaksi'];

    // File upload handling
    $target_dir = "../admin/uploads/"; // Specify your target directory
    $original_filename = basename($_FILES["bukti"]["name"]);
    $imageFileType = strtolower(pathinfo($original_filename, PATHINFO_EXTENSION));

    // Generate a unique filename with timestamp
    $timestamp = time();
    $filename = $timestamp . '_' . $original_filename;
    $target_file = $target_dir . $filename;

    $uploadOk = 1;

    // Check if the file is an image
    $check = getimagesize($_FILES["bukti"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        $uploadOk = 0;
    }

    // Check file size (you can adjust the limit)
    if ($_FILES["bukti"]["size"] > 500000) {
        $uploadOk = 0;
    }

    // Allow only certain file formats (you can add more if needed)
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        // Display JavaScript alert for file upload error and redirect to 'reservasi_aktif' page
        echo "<script>alert('Sorry, your file was not uploaded.'); window.location.href = '../reservasi_aktif.php';</script>";
    } else {
        // If everything is ok, try to upload file
        if (move_uploaded_file($_FILES["bukti"]["tmp_name"], $target_file)) {
            // Update the 'gambar' column in the 'transaksi' table with the unique filename
            $query = "UPDATE transaksi SET gambar = '$filename' WHERE kode_transaksi = '$kode_transaksi'";
            $result = mysqli_query($koneksi, $query);

            if ($result) {
                // Set session variable for payment success
                $_SESSION['payment_success'] = true;

                // Redirect back to the page where the upload was initiated
                header("Location: ".$_SERVER['HTTP_REFERER']);
                exit();
            } else {
                // Display JavaScript alert for database update error
                echo "<script>alert('Error updating database.'); window.location.href = '../reservasi_aktif.php';</script>";
            }
        } else {
            // Display JavaScript alert for file upload error and redirect to 'reservasi_aktif' page
            echo "<script>alert('Sorry, there was an error uploading your file.'); window.location.href = '../reservasi_aktif.php';</script>";
        }
    }
}
?>
