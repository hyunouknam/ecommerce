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
		<h2>add items to shop</h2>
		<form class="sellerupdate-form"  method="POST">
			<input type='text' name='itemname' placeholder='itemname' required>
			<input type='text' name='price' placeholder='price in $' required>
			<input type='text' name='quantity' placeholder='quantity' required>
			<input type='submit' value='add' name='submit' >
		</form>
	</div>
	<style>
	.sellerupdate-form{
	width:400px;
	margin:0 auto;
	padding-top:30px;	
	}
	.sellerupdate-form input{
		float:left;
		width:90%;
		height:40px;
		padding:0px 5%;
		margin-right:10px;
		margin-bottom:4px;
		border:none;
		background-color:#fff;
		font-family:arial;
		font-size:16px;
		color: #111;
		line-height:40px;	
}
	</style>
</section>
<?php
	$dbServername="localhost";
	$dbUsername="root";
	$dbPassword="12345";
	$dbName="ecommence"; 
	if(isset($_POST['submit'])){
		$ItemName=$_POST['itemname'];
		$price=$_POST['price'];
		$quantity=$_POST['quantity'];
		$conn=mysqli_connect($dbServername,$dbUsername,$dbPassword,$dbName);
		$sql= "SELECT * FROM inventory WHERE SellerId = ". $SellerId ." AND ItemName = "."'".$ItemName."'".";"; 
		$result=mysqli_query($conn,$sql);
		$resultCheck=mysqli_num_rows($result);		
		if($resultCheck>=1){
			echo "there is this item in shop, will not update the price just update the quantity is fine!";
			$row=mysqli_fetch_array($result);
			$oldQuantity=$row['Quantity'];
			$newQuantity= $quantity+$oldQuantity;
			$sql= "UPDATE inventory set Quantity = ".$newQuantity. " WHERE SellerId =  ". $SellerId ." AND ItemName = "."'".$ItemName."'".";";
			echo $sql;
			mysqli_query($conn,$sql);
			echo "<br>";
			echo "Just updated";
			exit();
		}
		else if ($resultCheck==0){
			echo "there is no such stuff in shop, now adding the stuff!";
			$sql= "INSERT INTO inventory (SellerId, ItemName, Quantity, Price ) VALUES (" .$SellerId .","."' " .$ItemName." '". " , ". $quantity. " , ". $price. ");";
			echo $sql;
			mysqli_query($conn,$sql);
		}
	}
	include_once 'footer.php';
?>