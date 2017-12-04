<?php
	include_once 'header.php'; 
	session_start();
	$dbServername="localhost";
	$dbUsername="root";
	$dbPassword="12345";
	$dbName="ecommence"; 

if (isset($_POST['keepsearch'])){
	echo "you want keep searching??";
	header( "refresh:2;url=searchresults.php" );
	exit();
}
else if (isset($_POST['checkout'])){
	header( "refresh:2;url=checkout.php" );
	exit();	
	$conn=mysqli_connect($dbServername,$dbUsername,$dbPassword,$dbName);
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
	$updateQuantity=$itemsInShoppingCart[$i][3]-1;
	echo "<br>";
	$sql= "UPDATE inventory SET TotalQuantity =  ".$updateQuantity." WHERE SellerId = " .$itemsInShoppingCart[$i][0]. " AND ItemId=". $itemsInShoppingCart[$i][1]. ";";
	$result=mysqli_query($conn,$sql);
	
	}	
}


	include_once 'footer.php'
?>