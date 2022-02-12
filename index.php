<?php
include 'connection/connect.php';
session_start();
if(isset($_POST['login'])){
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

     if($email != '' && $password != ''){
           $password = md5($password); //descrypt password
           $query = "SELECT * FROM tb_admin WHERE ADMIN_EMAIL = '$email' AND ADMIN_PASSWORD = '$password'";
           $result = mysqli_query($conn, $query);
           if (mysqli_num_rows($result) == 1){
                $row = mysqli_fetch_assoc($result); //ROW ARRAY
                
                    $_SESSION['logged_in'] = true;
                    $_SESSION['email'] = $email;
                    $_SESSION['password'] = $password;

                    header('location: admin/admin.php');
           } else{      //incorrect username or password
                echo '<script type"text/javascript">';
                echo 'alert("Incorrect email or password")';
                header("Refresh:0;url=index.php");
                echo '</script>';
           }
   }else{  //empty input text box 
       echo '<script type"text/javascript">';
       echo 'alert("Please enter your email or password")';
       header("Refresh:0;url=index.php");
       echo '</script>';
   }
}

    //login page is not accessible if user already login
     if (! empty($_SESSION['logged_in'])){
               header('location: admin/dashboard.php');
     }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Semaphore | IT Solutions Provider</title>
        <link rel="stylesheet" href="css/index.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">


        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet"> 

        <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="css/util.css">

    </head>
    <body>
        
        <div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form class="login100-form validate-form" action="index.php" method="post">
					<span class="login100-form-title" id="login-header">
                    <h3>PAYROLL SYSTEM</h3>
						ADMIN LOGIN
					</span>

					<div class="wrap-input100 rs1-wrap-input100 validate-input m-b-20" data-validate="Type email">
						<input id="first-name" class="input100" type="text" name="email" placeholder="Email" requried>
						<span class="focus-input100"></span>
					</div>
					<div class="wrap-input100 rs2-wrap-input100 validate-input m-b-20" data-validate="Type password">
						<input class="input100" type="password" name="password" placeholder="Password">
						<span class="focus-input100"></span>
					</div>
					
					<div class="container-login100-form-btn">
						<button class="login100-form-btn" type="submit" name="login">
							Log in
						</button>
					</div>

					<div class="w-full text-center p-t-27 p-b-239">
						<span class="txt1">
							Forgot
						</span>

						<a href="#" class="txt2">
							User name / password?
						</a>
					</div>
				</form>
				<div class="login100-more" style="background-image: url('images/login/bg-01.jpg');"></div>
			</div>
		</div>
	</div>
    </body>
</html>