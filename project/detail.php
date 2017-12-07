<?php
	include_once"header.php";
	session_start();
	$dbServername="localhost";
	$dbUsername="root";
	$dbPassword="12345";
	$dbName="ecommence"; 
?>	

<?php
	$itemid = $_GET['itemid'];

		// show item information
		$conn=mysqli_connect($dbServername,$dbUsername,$dbPassword,$dbName);
		$sql= "SELECT * FROM inventory WHERE ItemId = $itemid;";
		$result=mysqli_query($conn,$sql);
		if(mysqli_num_rows($result)!=0){
			
			$row=mysqli_fetch_array($result);			
			$myData=array();			
				
			$dataElement=array(
				$row['SellerId'],
				$row['ItemId'],
				$row['ItemName'],
				$row['Quantity'],
				$row['Price']
			);

			array_push($myData, $dataElement);

			echo "<br>".$row['ItemName']. ' ' .$row['Price']. '  '.$row['Quantity']."</br>";
		}

		// show item reviews
		$sql="SELECT * FROM review WHERE ItemID = $itemid;";
		$result=mysqli_query($conn,$sql);
		if(mysqli_num_rows($result)!=0){
			$count=0;
			$row=mysqli_fetch_array($result);			
			$myData=array();			
			do{	
				$dataElement=array(
					$row['ReviewId'],
					$row['ItemId'],
					$row['Rating'],
					$row['DetailedReview'],
					$row['DatePosted']
				);

				array_push($myData, $dataElement);

				echo "<br>".$row['ReviewId']. ' ' .$row['ItemId']. '  '.$row['Rating'].' '.$row['DetailedReview']. ' ' .$row['DatePosted']. "</br>";

				$count=$count+1;		
			}while($row=mysqli_fetch_array($result));
		}

?>



<?php

	if (isset($_SESSION['isCustomerLogin'])){
		echo '<section class="main-container">';
		echo '<div class="main-wrapper">';
		echo "<h2>Write Review</h2>";
		echo '<form class="signup-form"  method="POST">';
		echo '<input type="text" name="rating" placeholder="Rate from 1 - 5" required>';
		echo '<input type="text" name="detailedreview" placeholder="Write your thoughts on the item..." required>';
		echo '<input type="submit" value="submit" name="submit" >';

		echo "</form>";
		echo "</div>";
		echo "</section>";
	}

	if(isset($_POST['submit'])){ 

			$rating=mysqli_real_escape_string($conn,$_POST['rating']);
			$detailedreview=mysqli_real_escape_string($conn,$_POST['detailedreview']);

			$tableName = "Review";
			$zero = 0;

			$sql="INSERT INTO  $tableName (ReviewId, ItemId, Rating, DetailedReview) VALUES ($zero, $itemid, $rating, '$detailedreview');";
			mysqli_query($conn,$sql);
			header("Refresh:0");
	}

?>