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
		echo "payment already exist, no need to update!";
	}
	if(mysqli_num_rows($exist_result)==0){
		$sql_update_payment= "INSERT INTO payment (CustomerId, CardType, ExpirationDate, CardNumber ) VALUES ( ".$CustomerId. " , " ."'".$paymentInfor[0]."' , ". "'".$paymentInfor[1]."' , "."'". $paymentInfor[2]."'" ." );";
		echo $sql_update_payment;
		mysqli_query($conn,$sql_update_payment);	
		$sql_payment_exits="SELECT * FROM payment WHERE CustomerId = ". $CustomerId. " AND CardType = '".$paymentInfor[0]."' AND ExpirationDate = ". "'".$paymentInfor[1]."' AND CardNumber = ". "'".$paymentInfor[2]."';";
		echo $sql_payment_exits;
		$exist_result=mysqli_query($conn,$sql_payment_exits);	
		$row=mysqli_fetch_array($exist_result);
		$paymentId=$row['PaymentId'];	
		echo $paymentId;
	}
	// now search and find whta't the payment idate
	
	
	// insert orderitems
		
	// insert shipment
	}
	include_once 'footer.php';
?>
