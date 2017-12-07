<?php
	include_once 'header.php'; 
	session_start();	
	$CustomerId=$_SESSION['isCustomerLogin']['Id'];
	$addressInfor=$_SESSION['addressInfor'];
	echo $addressInfor[1];
	$paymentInfor=$_SESSION['paymentInfor'];
	$itemsInShoppingCart=$_SESSION['productsAdded'];
	if(isset($_POST['ContinueCheckout'])){	
		echo "<p1> Items in shopping cart </p1>";
		echo "<table border=1><tr><th>SellerId</th><th>ItemId</th><th>ItemName</th><th>Price</th><th>Quantity</th></tr>";	
		for($i=0;$i<count($_SESSION['productsAdded']);$i++){
			echo "<form method='POST'>";
			echo "<tr>";
			echo "<td>" .$itemsInShoppingCart[$i][0]. " </td>"; 
			echo "<td>" .$itemsInShoppingCart[$i][1]. " </td>"; 
			echo "<td>" .$itemsInShoppingCart[$i][2]. " </td>";
			echo "<td>" .$itemsInShoppingCart[$i][4]. " </td>";
			echo "<td>" .$itemsInShoppingCart[$i][5]. " </td>";
			echo "</tr>";
			echo "</form>"; 
	}
	echo "<p2> Address Infor </p2>";
		echo "<table border=1><tr><th>SellerId</th><th>ItemId</th><th>ItemName</th><th>Price</th><th>Quantity</th></tr>";	
		echo "<form method='POST'>";
		echo "<tr>";
		for($i=0;$i<count($addressInfor);$i++){			
			echo "<td>" .$addressInfor[$i]. " </td>"; 
		}
		echo "</tr>";
		echo "</form>";	
	}
	
?>



	
<div class ="checkout">
	<form method='POST' action= 'checkout.php'>
	<input type='submit' name= 'PlaceOrder' value='PlaceOrder' >
	</form>
</div>
<?php	
	include_once 'footer.php';

?>