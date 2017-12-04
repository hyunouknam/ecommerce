<?php
	include_once 'header.php'; 
	session_start();
	$dbServername="localhost";
	$dbUsername="root";
	$dbPassword="12345";
	$dbName="ecommence";	
	$conn=mysqli_connect($dbServername,$dbUsername,$dbPassword,$dbName);
	echo "In the checkout page the customer Id is :";
	echo $_SESSION['isCustomerLogin']['Id'];
	
	$itemsInShoppingCart=$_SESSION['productsAdded'];	
	for($i=0;$i<count($itemsInShoppingCart);$i++){
			//echo implode("   ",$itemsInShoppingCart[$i]);
			echo "<br>";
			echo $itemsInShoppingCart[$i][0];
			echo "<br>";
			echo $itemsInShoppingCart[$i][1];
			echo "<br>";
			echo $itemsInShoppingCart[$i][2];
			echo "<br>";
			echo $itemsInShoppingCart[$i][3];
			echo "<br>";
			echo $itemsInShoppingCart[$i][4];
			echo "<br>";
	}
	
	
	
	include_once 'footer.php';

?>