<?php include('utils/login_check.php'); ?>
<?php

$error = false;
if (isset($_POST['loginpass'])) {	
	include('utils/passwd.php');
	$loginpass = $_POST['loginpass'];
	$new_password = $_POST['new_password'];
	$repeat_password = $_POST['repeat_password'];
	if (password_verify($loginpass, $passwd) && ($repeat_password == $new_password)) {
		$hash = password_hash($new_password, PASSWORD_DEFAULT);
		file_put_contents('utils/passwd.php', '<?php $passwd = \''.$hash.'\'; ?>');
		header('Location: logout.php');
	}
	$error = true;
}
?>
    
<?php include('utils/header.php'); ?>

    <main role="main" class="container">

        <h1>Change Password</h1>
        <hr>
        <p><strong>NOTE:</strong> You will need to relogin once password reset is successful.</p>
<form action="password.php" method="post" id="form">
 
<?php if ($error) { ?>
<p class="alert alert-danger">Error updating password</p>
<?php } ?>
 
  <div class="form-group">
    <label for="exampleInputEmail1">Current Password</label>
    <input type="password" name="loginpass" class="form-control" id="old_password" aria-describedby="emailHelp" placeholder="Enter current password">
    <small id="emailHelp" class="form-text text-muted">To change your password, enter current password</small>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">New Password</label>
    <input type="password" name="new_password" class="form-control" id="new_password" placeholder="Password">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Repeat Password</label>
    <input type="password" name="repeat_password" class="form-control" id="repeat_password" placeholder="Repeat password">
  </div>
  <button type="submit" id="submit-btn" disabled class="btn btn-primary">Submit</button>
</form>

    </main><!-- /.container -->
<script>
	$(document).ready(function(){
		
		$('#repeat_password').on('keyup', function(){
			if ($('#repeat_password').val() != $('#new_password').val()) {
				$('#new_password').removeClass('is-valid');
				$('#repeat_password').addClass('is-invalid');
				$('#submit-btn').prop('disabled','disabled');
			} else {
				$('#repeat_password').removeClass('is-invalid');
				$('#repeat_password').addClass('is-valid');
				$('#new_password').addClass('is-valid');
				$('#submit-btn').prop('disabled',false);
			}
		});
		
		$('#form').on('submit', function(){
			if ($('#repeat_password').val() != $('#new_password').val()) {
				return false;
			}
			return true;
		});
		
	});
</script>
<?php include('utils/footer.php'); ?>