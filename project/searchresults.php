<?php
	include_once"header.php";
	session_start();
	$dbServername="localhost";
	$dbUsername="root";
	$dbPassword="12345";
	$dbName="ecommence"; 	
	echo "<div class ='wrapper'>";
	echo "<div class='topclass'>";
	echo "<p class='searchresults'>Search results </p>";
	echo "<style>";
	echo ".topclass{background-color:tomato;height:30px;margin:10px;padding:10px;};";
	echo "</style>";
	echo "</div>";
	echo "<div class='resultsdive'>";
	
	if(isset($_POST['search'])){		
		$conn=mysqli_connect($dbServername,$dbUsername,$dbPassword,$dbName);
		$ItemName= $_POST['search'];
		$sql= "SELECT * FROM inventory WHERE ItemName LIKE  '%$ItemName%';";
		$result=mysqli_query($conn,$sql);
		if(mysqli_num_rows($result)!=0){
			echo "<form method='POST' action= 'addShoppingCart.php'>";
			$count=0;
			$row=mysqli_fetch_array($result);			
			$myData=array();			
			do{					
				$dataElement=array(
					$row['SellerId'],
					$row['ItemId'],
					$row['ItemName'],
					$row['Quantity'],
					$row['ReviewId'],
					$row['Price']
				);
				array_push($myData, $dataElement);
				echo "<input type = 'checkbox' method='POST' name ='checkbox[]'.$count. value=$count />".$row['ItemName'].'   ' .$row['Price']."</br>";
				$count=$count+1;		
			 }while($row=mysqli_fetch_array($result));
			echo "<input type='submit' name= 'addToCart' value='add to cart' >";	
			$_SESSION['searchResults']=$myData;
					
		}
		else{
			echo "No results found";
		}
	}
echo "<style>";
echo ".resultsdive{display:block; background-color: #92a8d1; height:300px; color: white; margin:10px; padding:10px; font-size:20px; text-align:center vertical-align:middle;autoscroll:true;}";			
echo "</styple>";
echo "</form>";
echo "</div>";
echo "<div>";
include_once 'footer.php'; ?>