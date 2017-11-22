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
		<?php
			if(strcmp($signuptype,"Customer")==0 ||strcmp($signuptype,"Seller")==0 ){
				echo "<input type='text' name='uid' placeholder='UserID has to be in int' required>";
				echo "<input type='text' name='firstname' placeholder='first name in char' required>";
				echo "<input type='text' name='lastname' placeholder='last name in char' required>";
				echo "<input type='text' name ='address' placeholder='address in char' required>";
				echo "<input type='text' name='email' placeholder='email address with @' required>";
				echo "<input type='text' name='phone' placeholder='phone in int' required>";
				echo "<input type='submit' value='submit' name='submit' >";
			}
			else if (strcmp($signuptype,"Employee")==0){
				echo "<input type='text' name='uid' placeholder='UserID has to be in int' required>";
				echo "<input type='text' name='firstname' placeholder='first name in char' required>";
				echo "<input type='text' name='lastname' placeholder='last name in char' required>";
				echo "<input type='text' name ='address' placeholder='address in char' required>";
				echo "<input type='text' name='email' placeholder='email address with @' required>";
				echo "<input type='text' name='phone' placeholder='phone in int' required>";
				echo "<input type='text' name='role' placeholder='role char' required>";
				echo "<input type='submit' value='submit' name='submit' >";
			}
		?>
			
		</form>
	</div>
</section>

<?php
	include_once "includes/signup.inc.php";
	include_once 'footer.php';
?>

