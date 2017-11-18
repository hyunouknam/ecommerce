<?php
	include_once'header.php';
	session_start();
	$signuptype = $_SESSION['selected_signup_type'];
	echo "<h1 class='h1class'> This is" ." $signuptype ". "signup </h1>";	
?>
<section class="main-container"> 
	<div class="main-wrapper">
		<h2>Sign up</h2>
		<form class="signup-form"  method="POST">
			<input type="text" name="uid" placeholder="UserID has to be in int" required>
			<input type="submit" value="submit" name="submit" >
		</form>
	</div>
</section>

<?php
	include_once "includes/signup.inc.php";
	include_once 'footer.php';
?>

