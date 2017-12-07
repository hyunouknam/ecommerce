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
	$itemsInShoppingCart=$_SESSION['productsAdded'];
	echo "<p1> Items in shopping cart </p1>";
	echo "<table border=1><tr><th>SellerId</th><th>ItemId</th><th>ItemName</th><th>Item Price</th><th>Quantity</th></tr>";	
	for($i=0;$i<count($_SESSION['productsAdded']);$i++){
		echo "<form action='addShoppingCart.php' method='POST'>";
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
	echo "<table border=1> <tr><th> Password </th> <th> FirstName </th> <th> LastName </th> <th> Address </th><th> Email </th><th> PhoneNumber </th></tr>";	
		$dbServername="localhost";
		$dbUsername="root";
		$dbPassword="12345";
		$dbName="ecommence";		
		$conn=mysqli_connect($dbServername,$dbUsername,$dbPassword,$dbName);
		$sql= "SELECT * FROM customer WHERE CustomerId = ".$CustomerId. ";";
		$result=mysqli_query($conn,$sql);
		if(mysqli_num_rows($result)!=0){
		$row=mysqli_fetch_array($result);	
		echo "<h1> Use this address? (Customer's address)</h1>";
		echo "<form action='checkoutOrKeepShopping.php' method='POST'>";
		echo "<tr>";
		echo "<td>" ."<input type=text name= FirstName value= ". $row['FirstName']. " </td>"; 
		echo "<td>" ."<input type=text name= LastName value= ". $row['LastName']. " </td>"; 
		echo "<td>" ."<input type=text name= Address value= ". $row['Address']. " </td>";
		echo "<td>" ."<input type=text name= Email value= ". $row['Email']. " </td>";
		echo "<td>" ."<input type=text name= PhoneNumber value= ". $row['PhoneNumber']. " </td>";
		echo "<td>" ."<input type=hidden name= hidden_CustomerId value= ". $row['CustomerId']. " </td>";
		echo "<td>" ."<input type=submit name= update_CustomerInfor value= update ". " </td>";
		echo "</tr>";
		echo "</form>"; 
			
	
	
	
	
	
	
	
	
	
	
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