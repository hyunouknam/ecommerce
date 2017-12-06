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
	

?>