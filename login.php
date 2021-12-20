<?php
session_start();
error_reporting(0);
        $user = array(
                        "user" => "admin",
                        "pass"=>"12345"            
                );
if (isset($_POST['login'])) {
    if ($_POST['username'] == $user['user'] && $_POST['password'] == $user['pass']){
        //Membuat Session
        $_SESSION["username"] = $_POST['username']; 
        // echo "Anda Berhasil Login $_POST[username] , Silahkan Logout disini <a href='logout.php'>Klik Logout</a>";

        /*Jika Ingin Pindah Ke Halaman Lain*/
        // header("Location: index.php"); //Pindahkan Kehalaman Admin
		header("Location: index.php");
        exit;
    } else {
        // Tampilkan Pesan Error
        display_login_form();
        echo '<p style="margin-left: 220px; margin-top: -70px;">Username Atau Password Tidak Benar</p>';
    }
}    
else { 
    display_login_form();
}
function display_login_form(){ ?>
	<html>
	<head>
	<title>Pelaporan</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">

	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
	</head>

	<body>
		<div class="container" style="min-height:500px;">
			<div class="container">
				<h2 style="font-weight: bold; margin-left: -20px; margin-top: 150px;">Welcome ! </h2>
				</br>
				<div class="row">
					<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method='post'>
					<div class="row">
						<div class="col-md-5">
							<label for="username">Username</label>
							<input type="text" name="username" id="username" class="form-control" autocomplete="off">
							<br>
							<label for="password">Password</label>
							<input type="password" name="password" id="password" class="form-control" autocomplete="off">
						</div>
					</div>
					<div class="row">
						<div class="col-md-5">
							<br>
							<input type="submit" name="login" value="Login" class="btn btn-primary" style="width: 100%;">
						</div>
					</div>						
					</form>    	
				</div>
				</br>
			</div>
		</div>
	</body>
	</html>

<?php } ?>

