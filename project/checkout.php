<?php
	include_once 'header.php'; 
	session_start();
	$dbServername="localhost";
	$dbUsername="root";
	$dbPassword="12345";
	$dbName="ecommence";	
	$conn=mysqli_connect($dbServername,$dbUsername,$dbPassword,$dbName);
	$CustomerId=$_SESSION['isCustomerLogin']['Id'];	
	$itemsInShoppingCart=$_SESSION['productsAdded'];
	$sql= "SELECT * FROM customerorders WHERE CustomerId = " .$CustomerId. ";";
	$result_orders=mysqli_query($conn,$sql);
	$resultCheck_orders=mysqli_num_rows($result_orders);
	if ($resultCheck_orders==0){
		echo "No previous order history found, not sure about your possible address and payment";
		echo "<section class='main-container'> ";
		echo "<div class='main-wrapper'>";
		echo "<h2>payment information </h2>";
		echo "<form class='signup-form'  method='POST'>";
		echo "<input type='text' name='uid' placeholder='customer 5XX seller 3XX' required>";
		echo "<input type='text' name='password' placeholder='6 characters' required>";
		echo "<input type='text' name='firstname' placeholder='first name in char' required>";
		echo "<input type='text' name='lastname' placeholder='last name in char' required>";
		echo "<input type='text' name ='address' placeholder='address in char' required>";
		echo "<input type='text' name='email' placeholder='email address with @' required>";
		echo "<input type='text' name='phone' placeholder='phone in int' required>";
		echo "<input type='submit' value='submit' name='submit' >";
		echo "</form>";
		echo "</div>";
		echo "</section>";
		}
	
	
	else if (resultCheck_orders>0){
		//  here echo an address checkbox for the user to choose from
		// also the payment checkbox for the user to choose from 
		
	}
	
	for($i=0;$i<count($itemsInShoppingCart);$i++){
			//echo implode("   ",$itemsInShoppingCart[$i]);
			//echo "<br>";
			//echo $itemsInShoppingCart[$i][0]; //SellerId
			//echo "<br>";
			//echo $itemsInShoppingCart[$i][1]; //ItemId
			//echo "<br>";
			//echo $itemsInShoppingCart[$i][2]; //ItemName
			//echo "<br>";
			//echo $itemsInShoppingCart[$i][3]; //TotalQuantity in inventory
			//echo "<br>";
			//echo $itemsInShoppingCart[$i][4]; //price
			//echo "<br>";
	}	
	include_once 'footer.php';

?>