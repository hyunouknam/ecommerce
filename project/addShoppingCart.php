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
		$myData=$_SESSION['searchResults'];
		for ($i=0; $i<count($myData);$i++){
			//echo "the stuff that's on the search results are:";
			//echo implode(" ", $myData[$i]);
			//echo "</br>";
		}	
	}	
	//echo "  STUFF THAT'S SELECTED   ";
	$myselection=$_SESSION['productsAdded'];
	if (isset($_POST['checkbox'])){
		$checkbox=$_POST['checkbox'];
		for($i=0;$i<count($checkbox);$i++){
			$check1=$checkbox[$i];// the item I selected;
			//echo $myData[$check1][1];
			//echo "dddddd";
			//echo "<br>";
			$check_index=-1;
			for ($k=0;$k<count($myselection);$k++){
				//echo "item ID??";
				//echo "<br>";				
				if ($myselection[$k][1]==$myData[$check1][1]){
					$myselection[$k][5]=$myselection[$k][5]+1;
					$check_index=$k;
				}
			}
			if ($check_index==-1){	
			 array_push($myData[$check1],1); 
			 array_push($myselection, $myData[$check1]);
			 echo "</br>";
			}
		}	
		$_SESSION['productsAdded']=$myselection;
		// this make sure you can keep shpping
		//for($i=0;$i<count($_SESSION['productsAdded']);$i++){
			//echo implode("   ",$_SESSION['productsAdded'][$i]);
			//echo "<br>";
			//echo $_SESSION['productsAdded'][$i][1];
			//echo "</br>";
		//}	
	

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
	else {
		echo "Please select an item to shoppingcart!";
		header( "refresh:2;url=searchresults.php" );
		exit();
	}
	
	
?>


 


<div class ="checkout">
	<form method='POST' action= 'checkoutOrKeepShopping.php'>;
	<input type='submit' name= 'keepsearch' value='KEEPshoping' >
	<input type='submit' name= 'checkout' value='CHECKOUT' >
	</form>
</div>

<?php	
	include_once 'footer.php';
?>


