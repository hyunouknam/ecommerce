<?php
	include_once'header.php';
	session_start();
	if (isset($_POST['PlaceOrder'])){		
		$dbServername="localhost";
		$dbUsername="root";
		$dbPassword="12345";
		$dbName="ecommence"; 	
		$conn=mysqli_connect($dbServername,$dbUsername,$dbPassword,$dbName);
		for($i=0;$i<count($_SESSION['productsAdded']);$i++){
			$sql_search="SELECT * FROM inventory WHERE ItemId = ". $_SESSION['productsAdded'][$i][1].";";
			$search_result=mysqli_query($conn,$sql_search); // thre should be only one such row;
			$row=mysqli_fetch_array($search_result);	
			$old_quantity=$row['Quantity'];			
			$new_quantity=$old_quantity-$_SESSION['productsAdded'][$i][5];
			$sql_update= "UPDATE inventory SET Quantity = ".$new_quantity." WHERE ItemId = ".$_SESSION['productsAdded'][$i][1]. ";";
			mysqli_query($conn,$sql_update);		
		}
		echo "you are all SET !!!!!";
	// insert payment
	// insert customerorders
	// insert orderitems
	// insert shipment
	}
	include_once 'footer.php';
?>
