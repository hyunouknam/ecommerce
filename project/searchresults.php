<?php
	include_once"header.php";
	$dbServername="localhost";
	$dbUsername="root";
	$dbPassword="12345";
	$dbName="ecommence"; 
	
	if(isset($_POST['search'])){
		$conn=mysqli_connect($dbServername,$dbUsername,$dbPassword,$dbName);
		$ItemName= $_POST['search'];
		$sql= "SELECT * FROM inventory WHERE ItemName LIKE  '%$ItemName%';";
		$search_query=mysqli_query($conn,$sql);
		if(mysqli_num_rows($result)!=0){
			$serch_results=mysqli_fetch_assoc($result);
		}
	}
?>
<p>Search results </p>
<?php
if(mysqli_num_rows($result)!=0){
	do{
		echo $search_results['ItemName'];
	}while($search_results=mysqli_fetch_assoc($result));
}
else{
	echo "No results found";
}
?>

<?php	
	include_once 'footer.php';
?>
