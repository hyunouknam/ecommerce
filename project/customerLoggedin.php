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
			echo "YOU OUT";
		}		
	}	
	else{
		header("Location: login.php?statust=error&msg=No session found. Please login!");
	}
?>
<section class="main-container"> 
	<div class="main-wrapper">
		<h2 class="h2_class">Home</h2> 
	</div>
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
</section>





<?php	
	include_once 'footer.php';
?>