<?php
session_start();

if (isset($_SESSION['loggedin']) && ($_SESSION['loggedin'] === true)) {
	header('Location: index.php');
} 

$error = false;
if (isset($_POST['loginpass'])) {
	
	// default passwd.php -- admin
	if (!file_exists('utils/passwd.php')) {
		file_put_contents('utils/passwd.php', '<?php $passwd = \'$2y$10$5Q5nyP1oc6qqaSFY71rqo.fA3CrwRRv8mAOZEZZhdvObYF6.vQkgO\'; ?>');
	}
	
	include('utils/passwd.php');
	$loginpass = $_POST['loginpass'];
	if (password_verify($loginpass, $passwd)) {
		$_SESSION['loggedin'] = true;
		header('Location: index.php');
	} else {
		$error = true;
	}
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>NODBCMS Admin</title>

    <!-- Bootstrap core CSS -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <style>
.container {
    padding: 25px;
    position: fixed;
}

.form-login {
    background-color: #EDEDED;
    padding-top: 10px;
    padding-bottom: 20px;
    padding-left: 20px;
    padding-right: 20px;
    border-color:#d2d2d2;
    border-width: 5px;
    box-shadow:0 1px 0 #cfcfcf;
}

h4 { 
 border:0 solid #fff; 
 border-bottom-width:1px;
 padding-bottom:10px;
 text-align: center;
}

.wrapper {
    text-align: center;
}
	</style>
  </head>
  <body>

<div class="container">
    <div class="row">
        <div class="offset-md-5 col-md-3">
            <div class="form-login">
            
				<form action="login.php" method="post">
					<h4>Welcome back.</h4>
					
<?php if ($error) { ?>
<p class="alert alert-danger">Invalid password</p>
<?php } ?>
					
					<input type="password" name="loginpass" id="userPassword" class="form-control input-sm chat-input" placeholder="password" />
					<br />
					<div class="wrapper">
						<span class="group-btn">     
							<button type="submit" class="btn btn-primary btn-md">login <i class="fa fa-sign-in"></i></button>
						</span>
					</div><!-- /wrapper -->
				</form>        
			</div><!-- /form-login -->
		</div><!-- /offset -->
	</div><!-- /row --> 
</div><!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/js/popper.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
  </body>
</html>
