<?php
	include_once'header.php';
	session_start();
	$CustomerId=$_SESSION['isCustomerLogin']['Id'];
	$addressInfor=$_SESSION['addressInfor'];
	$paymentInfor=$_SESSION['paymentInfor'];
	$shipmentInfor=$_SESSION['shipInfor'];
	$itemsInShoppingCart=$_SESSION['productsAdded'];
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
	// insert payment;
	// first search if it exist alreay!
	$sql_payment_exits="SELECT * FROM payment WHERE CustomerId = ". $CustomerId. " AND CardType = '".$paymentInfor[0]."' AND ExpirationDate = ". "'".$paymentInfor[1]."' AND CardNumber = ". "'".$paymentInfor[2]."';";
	echo $sql_payment_exits;
	$exist_result=mysqli_query($conn,$sql_payment_exits);	
	$row=mysqli_fetch_array($exist_result);	
	if(mysqli_num_rows($exist_result)!=0){
		//echo "payment already exist, no need to update!";
		$paymentId=$row['PaymentId'];
	}
	if(mysqli_num_rows($exist_result)==0){
		$sql_update_payment= "INSERT INTO payment (CustomerId, CardType, ExpirationDate, CardNumber ) VALUES ( ".$CustomerId. " , " ."'".$paymentInfor[0]."' , ". "'".$paymentInfor[1]."' , "."'". $paymentInfor[2]."'" ." );";
		echo $sql_update_payment;
		mysqli_query($conn,$sql_update_payment);	
		$sql_payment_exits="SELECT * FROM payment WHERE CustomerId = ". $CustomerId. " AND CardType = '".$paymentInfor[0]."' AND ExpirationDate = ". "'".$paymentInfor[1]."' AND CardNumber = ". "'".$paymentInfor[2]."';";
		//echo $sql_payment_exits;
		$exist_result=mysqli_query($conn,$sql_payment_exits);	
		$row=mysqli_fetch_array($exist_result);
		$paymentId=$row['PaymentId'];		
	}
	// UPDATE customerorders TABLE
	$sql_customerorders = "INSERT INTO customerorders (CustomerId, PaymentId, ShipmentId ) VALUES (". $CustomerId.",".$paymentId.",".$shipmentInfor[3].");";
	mysqli_query($conn,$sql_customerorders);
	// insert orderitems
	// find the orderId you just added, 
	$sql_search_orderId="SELECT * FROM customerorders WHERE CustomerId = ". $CustomerId. " AND PaymentId = ". $paymentId. " AND ShipmentId = ". $shipmentInfor[3].";";
	echo $sql_search_orderId;
	$search_orderId=mysqli_query($conn,$sql_search_orderId);
	$row=mysqli_fetch_array($search_orderId);
	$OrderId=$row['OrderId'];	
	echo $OrderId;
	// for this $OrderId, insert stuff into the orderitems 
	//$row['SellerId'], 0
	//$row['ItemId'], 1
	//$row['ItemName'], 2
	//$row['Quantity'], 3
	//$row['Price'] 4
	// index 5 is the quantity in shopping cart
	echo "<br>";
	for($i=0;$i<count($_SESSION['productsAdded']);$i++){
		$SellerId=$_SESSION['productsAdded'][$i][0];
		$ItemId=$_SESSION['productsAdded'][$i][1];
		$ItemName=$_SESSION['productsAdded'][$i][2];
		$totalQuantity=$_SESSION['productsAdded'][$i][3];
		$Price=$_SESSION['productsAdded'][$i][4];
		$quantityInOrder= $_SESSION['productsAdded'][$i][5];
		$sql_insert = "INSERT INTO orderitems (OrderId, ItemId, SellerId, Quantity ) VALUES ( ".$OrderId.", ".$ItemId.", ".$SellerId.", ".$quantityInOrder.");";
		mysqli_query($conn,$sql_insert);
		}
	}
	include_once 'footer.php';
?>
