<?php
	include_once 'header.php';	
	session_start();
	$CustomerId=$_SESSION['isCustomerLogin']['Id'];
	$dbServername="localhost";
	$dbUsername="root";
	$dbPassword="12345";
	$dbName="ecommence"; 
	
?>
<div class ="checkout">
	<form method='POST' action= 'checkout.php'>
	<input type='submit' name= 'ContinueCheckout' value='ContinueCheckout' >	
	</form>
</div>
<div class ="viewInfor">
	<form method='POST' action= 'checkoutOrKeepShopping.php'>
	<input type='submit' name= 'ViewAddressInfo' value='ViewAddressInfo' >
	<input type='submit' name= 'ViewPaymentInfo' value='ViewPaymentInfo' >	
	<input type='submit' name= 'ViewItemInShoppingCart' value='ViewItemInShoppingCart' >
	</form>
</div>
<?php
if (isset($_POST['keepsearch'])){
	echo "you want keep searching??";
	header( "refresh:2;url=searchresults.php" );
	exit();
}
else if (isset($_POST['checkout'])){
	$itemsInShoppingCart=$_SESSION['productsAdded'];
	echo "<p1> Items in shopping cart </p1>";
	echo "<table border=1><tr><th>SellerId</th><th>ItemId</th><th>ItemName</th><th>Price</th><th>Quantity</th></tr>";	
	for($i=0;$i<count($_SESSION['productsAdded']);$i++){
		echo "<form method='POST'>";
		echo "<tr>";
		echo "<td>" .$_SESSION['productsAdded'][$i][0]. " </td>"; 
		echo "<td>" .$_SESSION['productsAdded'][$i][1]. " </td>"; 
		echo "<td>" .$_SESSION['productsAdded'][$i][2]. " </td>";
		echo "<td>" .$_SESSION['productsAdded'][$i][4]. " </td>";
		echo "<td>" .$_SESSION['productsAdded'][$i][5]. " </td>";
		echo "</tr>";
		echo "</form>"; 
	}
	// Customer Address
		echo "<table border=1> <tr><th> FirstName </th> <th> LastName </th> <th> Address </th><th> Email </th><th> PhoneNumber </th></tr>";	
		$conn=mysqli_connect($dbServername,$dbUsername,$dbPassword,$dbName);
		$sql= "SELECT * FROM customer WHERE CustomerId = ".$CustomerId. ";";
		$result=mysqli_query($conn,$sql);
		if(mysqli_num_rows($result)!=0){
		$row=mysqli_fetch_array($result);	
		echo "<h1> Use this address? (Customer's address)</h1>";
		echo "<form  method='POST'>";
		echo "<tr>";
		echo "<td>" ."<input type=text name= FirstName value= ". $row['FirstName']. " </td>"; 
		echo "<td>" ."<input type=text name= LastName value= ". $row['LastName']. " </td>"; 
		echo "<td>" ."<input type=text name= Address value= ". $row['Address']. " </td>";
		echo "<td>" ."<input type=text name= Email value= ". $row['Email']. " </td>";
		echo "<td>" ."<input type=text name= PhoneNumber value= ". $row['PhoneNumber']. " </td>";
		echo "<td>" ."<input type=submit name= update_shippingAddress value= ChangeToThisAddress ". " </td>";
		echo "</tr>";
		echo "</form>"; 
	}	
	echo "<table border=1> <tr><th> CardType </th> <th> ExpirationDate </th> <th> CardNumber </th></tr>";	
	echo "<h2> You payment information</h2>";
		echo "<form action='checkoutOrKeepShopping.php' method='POST'>";
		echo "<tr>";
		echo "<td>" ."<input type=text name= CardType value= "." ". " ></td>"; 
		echo "<td>" ."<input type=text name= ExpirationDate value= "." ". " ></td>"; 
		echo "<td>" ."<input type=text name= CardNumber value= "." ". "> </td>";
		echo "<td>" ."<input type=submit name= update_payment value= useThisPayment ". " </td>";
		echo "</tr>";
		echo "</form>"; 
}
	if (isset($_POST['update_shippingAddress'])){
		$shippingAddress=array();
		array_push($shippingAddress,$_POST['FirstName']); 
		array_push($shippingAddress,$_POST['LastName']); 
		array_push($shippingAddress,$_POST['Address']); 
		array_push($shippingAddress,$_POST['Email']); 
		array_push($shippingAddress,$_POST['PhoneNumber']); 
		$_SESSION['addressInfor']=$shippingAddress;
	}
	if (isset($_POST['update_payment'])){
		echo "You clicked???";
		$paymentInfor=array();
		array_push($paymentInfor,$_POST['CardType']); 
		array_push($paymentInfor,$_POST['ExpirationDate']); 
		array_push($paymentInfor,$_POST['CardNumber']); 
		$_SESSION['paymentInfor']=$paymentInfor;
	}

?>


<?php
	if (isset($_POST['ViewAddressInfo'])){
		if (count($_SESSION['addressInfor'])==0){			
			echo "No address information available";
			echo "<h1> No address infor is available you can add it here</h1>";
			echo "<table border=1> <tr><th> FirstName </th> <th> LastName </th> <th> Address </th><th> Email </th><th> PhoneNumber </th></tr>";	
			echo "<form action='checkoutOrKeepShopping.php' method='POST'>";
			echo "<tr>";
			echo "<td>" ."<input type=text name= FirstName value= "." " . "> </td>"; 
			echo "<td>" ."<input type=text name= LastName value= "." ". " ></td>"; 
			echo "<td>" ."<input type=text name= Address value= "." ". " ></td>";
			echo "<td>" ."<input type=text name= Email value= ". " ". " ></td>";
			echo "<td>" ."<input type=text name= PhoneNumber value= ". " ". "> </td>";
			echo "<td>" ."<input type=submit name= update_shippingAddress value= ChangeToThisAddress ". " </td>";
			echo "</tr>";
			echo "</form>"; 
		}
		else {
			echo "<h1> Use this address? (Customer's address)</h1>";
			echo "<table border=1> <tr><th> FirstName </th> <th> LastName </th> <th> Address </th><th> Email </th><th> PhoneNumber </th></tr>";	
			echo "<form action='checkoutOrKeepShopping.php' method='POST'>";
			echo "<tr>";
			echo "<td>" ."<input type=text name= FirstName value= ".$_SESSION['addressInfor'][0] . " </td>"; 
			echo "<td>" ."<input type=text name= LastName value= ". $_SESSION['addressInfor'][1]. " </td>"; 
			echo "<td>" ."<input type=text name= Address value= ".$_SESSION['addressInfor'][2]. " </td>";
			echo "<td>" ."<input type=text name= Email value= ". $_SESSION['addressInfor'][3]. " </td>";
			echo "<td>" ."<input type=text name= PhoneNumber value= ". $_SESSION['addressInfor'][4]. " </td>";
			echo "<td>" ."<input type=submit name= update_shippingAddress value= ChangeToThisAddress ". " </td>";
			echo "</tr>";
			echo "</form>"; 
		}
	}
	if (isset($_POST['ViewPaymentInfo'])){
		if (count($_SESSION['paymentInfor'])==0){
			echo "No PaymentInfor available! You can update here!";
			echo "<table border=1> <tr><th> CardType </th> <th> ExpirationDate </th> <th> CardNumber </th></tr>";	
			echo "<h2> You payment information</h2>";
			echo "<form action='checkoutOrKeepShopping.php' method='POST'>";
			echo "<tr>";
			echo "<td>" ."<input type=text name= CardType value= "."". " ></td>"; 
			echo "<td>" ."<input type=text name= ExpirationDate value= "."". " ></td>"; 
			echo "<td>" ."<input type=text name= CardNumber value= "." ". "> </td>";
			echo "<td>" ."<input type=submit name= update_payment value= useThisPayment ". " </td>";
			echo "</tr>";
			echo "</form>"; 
		}
		else{
			echo "<table border=1> <tr><th> CardType </th> <th> ExpirationDate </th> <th> CardNumber </th></tr>";	
			echo "<h2> You payment information</h2>";
			echo "<form action='checkoutOrKeepShopping.php' method='POST'>";
			echo "<tr>";
			echo "<td>" ."<input type=text name= CardType value= ".$_SESSION['paymentInfor'][0]. " ></td>"; 
			echo "<td>" ."<input type=text name= ExpirationDate value= ".$_SESSION['paymentInfor'][1]. " ></td>"; 
			echo "<td>" ."<input type=text name= CardNumber value= ".$_SESSION['paymentInfor'][2]. "> </td>";
			echo "<td>" ."<input type=submit name= update_payment value= useThisPayment ". " </td>";
			echo "</tr>";
			echo "</form>"; 
		}		
	}
	if (isset($_POST['ViewItemInShoppingCart'])){
		$itemsInShoppingCart=$_SESSION['productsAdded'];
		echo "<p1> Items in shopping cart </p1>";
		echo "<table border=1><tr><th>SellerId</th><th>ItemId</th><th>ItemName</th><th>Price</th><th>Quantity</th></tr>";	
		for($i=0;$i<count($_SESSION['productsAdded']);$i++){
			echo "<form method='POST'>";
			echo "<tr>";
			echo "<td>" .$_SESSION['productsAdded'][$i][0]. " </td>"; 
			echo "<td>" .$_SESSION['productsAdded'][$i][1]. " </td>"; 
			echo "<td>" .$_SESSION['productsAdded'][$i][2]. " </td>";
			echo "<td>" .$_SESSION['productsAdded'][$i][4]. " </td>";
			echo "<td>" .$_SESSION['productsAdded'][$i][5]. " </td>";
			echo "</tr>";
			echo "</form>"; 
		}
	}
?>

<?php
	include_once 'footer.php'
?>



