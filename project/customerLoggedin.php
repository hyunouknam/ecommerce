<?php
	include_once 'header.php'; 
	session_start();
	if (isset($_SESSION['isCustomerLogin'])){
		$duration=$_SESSION['isCustomerLogin']['duration'];
		$start =$_SESSION['isCustomerLogin']['start'];
		if ((time()-$start)>$duration){
			echo "<p> YOU OUT </p>";
			unset($_SESSION['isCustomerLogin']['duration']);
			unset($_SESSION['isCustomerLogin']['start']);
			unset($_SESSION['isCustomerLogin']['logintype']);
			unset($_SESSION['isCustomerLogin']['Id']);
			unset($_SESSION['isCustomerLogin']);
			session_destroy();
			
		}		
	}	
	else{
		header("Location: login.php?statust=error&msg=No session found. Please login!");
	}
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
	<div class ="search_class">Search the products you want to buy 
	<form name ='form1' method ='POST'	action='searchresults.php'>
	<input name = 'search' type='text' size='40' maxlength='50'/>
	<input type = 'submit' name ='submit' value='search' />
	</form>	
	</div>
	<style>
	.search_class{
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
	<div class="customerAccount">Now you are Login as customer, here's what you can do:
			<form>
			<?php
			$customerChoice=array('Logout','Your Orders','Your Account');
			echo '<select class="customerChoice-class", name="customerChoice">';
			echo get_options($customerChoice);
			echo '</select>';
			?>	
			<input type ='submit' name='submit' value='submit'/>
			</form>
		<style>
			.customerAccount{
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
	</div>	
</section>
<?php
			if (get('customerChoice')){
				$customerChoice_id=get('customerChoice');
				if (is_valide_index($customerChoice_id-1, $customerChoice)){
					if( strcmp ($customerChoice[$customerChoice_id-1],'Logout')==0){						
						if (isset($_SESSION['isCustomerLogin'])){
							unset($_SESSION['isCustomerLogin']['duration']);
							unset($_SESSION['isCustomerLogin']['start']);
							unset($_SESSION['isCustomerLogin']['logintype']);
							unset($_SESSION['isCustomerLogin']['Id']);
							unset($_SESSION['isCustomerLogin']);	
							session_destroy();
							echo "<h class='logoutClass'>logging out now ...... </h>";
							echo "</br>";
							echo "Now I am redirecting you to the homepage";		
							header( "refresh:5;url=homepage.php?statust=error&msg=you clicked logout!" );	
							exit();
					}
					else {
						echo "you are not login";
					}
				}
					else if( strcmp ($customerChoice[$customerChoice_id-1],'Your Orders')==0){
						echo "you selected Your Orders";
						if (isset($_SESSION['isCustomerLogin'])){
							echo "you are not login";
							echo "</br>";
							echo "redirecting you back to the homepage now";
						}
						
					}
					else if(strcmp($customerChoice[$customerChoice_id-1],'Your Account')==0){
						echo "you selected Your Account";
					}		
					
				}
				else{
					echo '<span style = "color:red"> Invalid login type code </span>';
				}
			}				
			
	?>	
	




<?php	
	include_once 'footer.php';
?>