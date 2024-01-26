<!DOCTYPE html>
<?php
	session_start();
?>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
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
                                echo "<li class='uk-active'><a href='admin/index.php'>Masuk Sebagai Admin</a></li>";
                                echo "<li class='uk-active'><a href='daftar.php'>Daftar</a></li>";
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


		<?php
			include "action/act_alert.php";
		?>
		<div class="container">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <div class="login-container">
                        <img src="img/logo.png" alt="Logo" class="mx-auto d-block">
                            <form action="action/act_masuk.php" method="post">
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="form-stacked-text" name="username" placeholder="Enter your username" required>
                                        <i class="fa-regular fa-envelope"></i>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="password" class="form-control" id="form-stacked-text" name="password" placeholder="Enter your password" required>
                                        <div class="input-group-append"><i class="fas fa-lock"></i></div>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary btn-block" name="button" style="font-family:rockwell;">Sign in</button>
                            </form>
                            <div class="row1">     
                                <a href="daftar.php">Register a new membership</a>
                            </div>
                    </div>
                </div>
            </div>
        </div>
</body>

</html>


