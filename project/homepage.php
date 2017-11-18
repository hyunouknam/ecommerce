<?php
	include_once 'header.php'; // header.php has home 
	function get($name){
		return isset($_REQUEST[$name])? $_REQUEST[$name]:'';
	}
	function  is_valide_index($index,$array){
		return $index>=0 && $index < count($array);
	}
	function get_options($logintype){
		$options ='';
		for ($i=0;$i<count($logintype);$i++){
			$options .= '<option value="'. ($i+1).'">'.$logintype[$i]. '</option>';				
		}	
		return $options;
	}	
	
?>



<section class="main-container"> 
	<div class="main-wrapper">
		<h2 class="h2_class">Home</h2> 
	</div>
</section>
		<div class="login_class">login as customer or employee or seller?
		<form>
			<?php
			$logintype=array('Customer','Seller','Employee');
			echo '<select class="select-class", name="login-type">';
			echo get_options($logintype);
			echo '</select>';
			?>	
		<input type ='submit'>
		</form>
		<style>
			.select-class{	
				margin-top:30px;
				padding-right:20px;
				padding-left:20px;
			}
			.login_class{
			background-color: tomato;
			height:100px;
			color: white;
			margin:20px;
			padding: 20px;
			font-size:30px;
			
			text-align:center;
			vertical-align:middle;
			
			} 
	</style>
	<?php
			if (get('login-type')){
				$logintype_id=get('login-type');
				if (is_valide_index($logintype_id-1, $logintype)){
					echo "You have selected ". $logintype[$logintype_id-1]." type";
					$_SESSION['selected_login_type']='';
					if( strcmp ($logintype[$logintype_id-1],'Seller')==0){
						echo 'you selected  seller type ####';
						session_start();
						$_SESSION['selected_login_type']=$logintype[$logintype_id-1];
						header("Location:login.php");
					}
					else if( strcmp ($logintype[$logintype_id-1],'Customer')==0){
						echo 'you selected customer type ####';
						session_start();
						$_SESSION['selected_login_type']=$logintype[$logintype_id-1];
						header("Location:login.php");
					}
					else if( strcmp ($logintype[$logintype_id-1],'Employee')==0){
						echo 'you selected employee type ####';
						session_start();
						$_SESSION['selected_login_type']=$logintype[$logintype_id-1];
						header("Location:login.php");
					}		
					
				}
				else{
					echo '<span style = "color:red"> Invalid login type code </span>';
				}
			}				
			
	?>	
	</div>
		<div class="signupclass">sign up as customer or employee or seller?
			<form>
			<?php
			$signuptype=array('Customer','Seller','Employee');
			echo '<select class="select-class", name="signup-type">';
			echo get_options($signuptype);
			echo '</select>';
			?>	
			<input type ='submit'>
			</form>
		<style>
			.signuptype{	
				margin-top:30px;
				padding-right:20px;
				padding-left:20px;
			}
			.signupclass{
			background-color: tomato;
			height:100px;
			color: white;
			margin:20px;
			padding:20px;
			font-size:30px;			
			text-align:center;
			vertical-align:middle;
			
			} 			
	</style>
		<?php
			if (get('signup-type')){
				$signuptype_id=get('signup-type');
				if (is_valide_index($signuptype_id-1, $signuptype)){
					$_SESSION['selected_signup_type']='';
					echo "You have selected ". $signuptype[$signuptype_id-1]." type";
					if( strcmp ($signuptype[$signuptype_id-1],'Seller')==0){
						echo 'you selected  seller type ####';
						session_start();
						$_SESSION['selected_signup_type']=$signuptype[$signuptype_id-1];
						header("Location: signup.php");
					}
					else if( strcmp ($signuptype[$signuptype_id-1],'Customer')==0){
						echo 'you selected customer type ####';
						session_start();
						$_SESSION['selected_signup_type']=$signuptype[$signuptype_id-1];
						header("Location: signup.php");
					}
					else if( strcmp ($signuptype[$signuptype_id-1],'Employee')==0){
						echo 'you selected employee type ####';
						session_start();
						$_SESSION['selected_signup_type']=$signuptype[$signuptype_id-1];
						header("Location :signup.php");
					}		
					
				}
				else{
					echo '<span style = "color:red"> Invalid login type code </span>';
				}
			}				
			
	?>	
	
		</div>
  

<?php
	
	include_once 'footer.php';
?>