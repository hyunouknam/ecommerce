<?php
	include_once 'header.php'; 
	session_start();	
	$start=$_SESSION['isSellerLogin']['duration'];
	$duration=$_SESSION['isSellerLogin']['start'];
	$logintype=$_SESSION['isSellerLogin']['logintype'];
	$SellerId=$_SESSION['isSellerLogin']['Id'];
	
?>
<section class="main-container"> 
	<div class="main-wrapper">
		<form class="sellerfunction"  method="POST" >
			<input type='submit' value='see what is in shop' name='submit_seeitems' >
			<input type='submit' value='add items to shop' name='submit_additems' >
		</form>
	</div>
</section>



<?php
	
	if (isset($_POST['submit_seeitems'])){
		echo "<div class ='wrapper'>";
		echo "<div class='topclass'>";
		echo "<p class='searchresults'>Items in your shop </p>";
		echo "<table style='width:100%'>";
		echo "<tr>";
		echo "<th>itemname</th>";
		echo "<th>price</th>"; 
		echo "<th>quantity</th>";
		echo "</tr>";
		echo "</table>";
		echo "<style>";
		echo ".topclass{background-color:tomato;color:white;height:50px;margin:10px;padding:10px;font-size:20px;text-align:center;vertical-align:middle;};";
		echo "</style>";
		echo "</div>";
		echo "<div class='resultsdive'>";
		$dbServername="localhost";
		$dbUsername="root";
		$dbPassword="12345";
		$dbName="ecommence"; 
		$conn=mysqli_connect($dbServername,$dbUsername,$dbPassword,$dbName);
		$sql= "SELECT * FROM inventory WHERE SellerId = ".$SellerId. ";";
		$result=mysqli_query($conn,$sql);
		if(mysqli_num_rows($result)==0){
			echo "you don't have any item in your shop!";
		}
		else if (mysqli_num_rows($result)!=0){
			echo "<form method='POST' action= 'addShoppingCart.php'>";
			$row=mysqli_fetch_array($result);
			$count=0;
			do{					
				$dataElement=array(
					$row['SellerId'],
					$row['ItemId'],
					$row['ItemName'],
					$row['Quantity'],
					$row['Price']
				);
			echo "<input type = 'checkbox' method='POST' name ='checkbox[]'.$count. value=$count />".$row['ItemName'].' ' .$row['Price']. '  '.$row['Quantity']."</br>";
			//echo "<tr>";
			//echo "<td> itemname</td>";
			//echo "<td> item id</td>";
			//echo "<td><input type='text' value='shya' name='updatequantity'></td>";
			//echo "</tr>";
			//echo "<tr>";
			//echo "<td> DELETE</td>";
			//echo "<td> what </td>";
			//echo "<td><input type='text' value='shya'></td>";
			//echo "</tr>";
			
			$count=$count+1;
		 }while($row=mysqli_fetch_array($result));
		}	
	echo "<input type='submit' value='delete selected item' name='submit_deleteitem' >";
	echo "<style>";
	echo ".resultsdive{display:block; background-color: tomato; height:300px; color: white; margin:10px; padding:10px; font-size:20px; text-align:center vertical-align:middle;autoscroll:true;}";			
	echo "</styple>";
	echo "</form>";
	echo "</div>";
	echo "<div>";
	}
		else if (isset($_POST['submit_additems'])){
		header( "refresh:2;url=selleradditem.php" );
		exit();	
	}







	include_once 'footer.php';
?>