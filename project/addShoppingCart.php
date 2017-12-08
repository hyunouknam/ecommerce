<?php
	include_once 'header.php'; 
	session_start();
	if (isset($_SESSION['isCustomerLogin'])){
		$duration=$_SESSION['isCustomerLogin']['duration'];
		$start =$_SESSION['isCustomerLogin']['start'];
		$customerId=$_SESSION['isCustomerLogin']['Id'];
		if ((time()-$start)>$duration){
			echo "<p> time is OUT, you are automatically LOG OUT </p>";
			unset($_SESSION['isCustomerLogin']['duration']);
			unset($_SESSION['isCustomerLogin']['start']);
			unset($_SESSION['isCustomerLogin']['logintype']);
			unset($_SESSION['isCustomerLogin']['Id']);
			unset($_SESSION['isCustomerLogin']);	
			unset($_SESSION['productsAdded']);
			session_destroy();
			echo "</br>";
			echo "Now I am redirecting you to the Login page";		
			header( "refresh:3;url=login.php?statust=error&msg=No session found. Please login!" );	
			exit();
		}
		else {
			echo "you are all set!!!";
			echo "</br>";
			echo "and you are NOT time out!";
		}
	}	
	else{
		echo "You are not log in as Customer, you can't add to shopping cart!";
		echo "</br>";
		echo "Now I am redirecting you to the Login page";		
		header( "refresh:3;url=login.php?statust=error&msg=No session found. Please login!" );
		exit();
	}	
	$myData=array(array());
	if (isset($_SESSION['searchResults'])){
		$myData=$_SESSION['searchResults']; // array in search results	
	}	
	$myselection=$_SESSION['productsAdded']; // stuff that's selected
	if (isset($_POST['checkbox'])){
		$checkbox=$_POST['checkbox'];
		for($i=0;$i<count($checkbox);$i++){
			$check1=$checkbox[$i];
			$check_index=-1;
			for ($k=0;$k<count($myselection);$k++){ // if item was previously selected 
				if ($myselection[$k][1]==$myData[$check1][1]){
					$myselection[$k][5]=$myselection[$k][5]+1; // update quantity only
					$check_index=$k;
				}
			}
			if ($check_index==-1){	// if item is not in list, new item is selected 
			  array_push($myData[$check1],1); 
			  array_push($myselection, $myData[$check1]);
			}
		}	
		$_SESSION['productsAdded']=$myselection;
	echo "<table border=1> <tr>     <th>                  SellerId               </th><th>ItemId</th> <th>ItemName</th>                    <th>Item Price</th>    <th>Quantity</th>  </tr>";	
	for($i=0;$i<count($_SESSION['productsAdded']);$i++){
		echo "<form action='addShoppingCart.php' method='POST'>";
		echo "<tr>";
		echo "<td>" .$_SESSION['productsAdded'][$i][0]. " </td>"; 
		echo "<td>" .$_SESSION['productsAdded'][$i][1]. " </td>"; 
		echo "<td>" .$_SESSION['productsAdded'][$i][2]. " </td>";
		echo "<td>" .$_SESSION['productsAdded'][$i][4]. " </td>";
		echo "<td>" ."<input type=text name= Quantity value= ". $_SESSION['productsAdded'][$i][5]. " </td>";
		echo "<td>" ."<input type=hidden name= hidden_ItemId value= ".$_SESSION['productsAdded'][$i][1]. " </td>";
		echo "<td>" ."<input type=submit name= update_shoppingcart value= update_quantity ". " </td>";
		echo "</tr>";
		echo "</form>"; 
		}
	}
	if (isset($_POST['update_shoppingcart'])){
		$myData=$_SESSION['searchResults'];
		$myselection=$_SESSION['productsAdded'];
		$itemId=$_POST['hidden_ItemId'];
		for ($i=0; $i<count($myselection);$i++){
			if ($myselection[$i][1]==$itemId){
				$myselection[$i][5]=$_POST['Quantity'];
			}
		}
		$_SESSION['productsAdded']=$myselection;
	}
?>
<div class ="seewhat's in shopping cart">
	<form method='POST' action= 'addShoppingCart.php'>
	<input type='submit' name= 'ShoppingCart' value='ShoppingCart' >
	<input type='submit' name= 'submit_logout' value='Logout' >
	</form>
</div>


<div class ="checkout">
	<form method='POST' action= 'checkoutOrKeepShopping.php'>
	<input type='submit' name= 'keepsearch' value='KEEPshoping' >
	<input type='submit' name= 'checkout' value='CHECKOUT' >
	</form>
</div>

<?php	
	if (isset($_POST['ShoppingCart'])){
		for($i=0;$i<count($_SESSION['productsAdded']);$i++){
		echo "<form action='addShoppingCart.php' method='POST'>";
		echo "<tr>";
		echo "<td>" .$_SESSION['productsAdded'][$i][0]. " </td>"; 
		echo "<td>" .$_SESSION['productsAdded'][$i][1]. " </td>"; 
		echo "<td>" .$_SESSION['productsAdded'][$i][2]. " </td>";
		echo "<td>" .$_SESSION['productsAdded'][$i][4]. " </td>";
		echo "<td>" ."<input type=text name= Quantity value= ". $_SESSION['productsAdded'][$i][5]. " </td>";
		echo "<td>" ."<input type=hidden name= hidden_ItemId value= ".$_SESSION['productsAdded'][$i][1]. " </td>";
		echo "<td>" ."<input type=submit name= update_shoppingcart value= update_quantity ". " </td>";
		echo "</tr>";
		echo "</form>"; 
		}
	}
	else if(isset($_POST['submit_logout'])){
		echo "you logout! Now redirecting you to the homepage!";
		unset($_SESSION['isCustomerLogin']['duration']);
		unset($_SESSION['isCustomerLogin']['start']);
		unset($_SESSION['isCustomerLogin']['logintype']);
		unset($_SESSION['isCustomerLogin']['Id']);
		unset($_SESSION['isCustomerLogin']);
		session_destroy();
		header( "refresh:3;url=homepage.php" );
	}
	include_once 'footer.php';
?>


