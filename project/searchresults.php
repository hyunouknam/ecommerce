<?php
	function get(){
		echo "now I am in this function";
	}

	include_once"header.php";
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
	echo "<form action='demo.php?func_name=print_stuff()'>";
	if(isset($_POST['search'])){
		
		$conn=mysqli_connect($dbServername,$dbUsername,$dbPassword,$dbName);
		$ItemName= $_POST['search'];
		$sql= "SELECT * FROM inventory WHERE ItemName LIKE  '%$ItemName%';";
		$result=mysqli_query($conn,$sql);
		if(mysqli_num_rows($result)!=0){
			$count=0;
			session_start();
			$_SESSION['results_array']=$results_array;
			$row=mysqli_fetch_array($result);
			do{			
				
				echo "<input type = 'checkbox' method = 'POST' name ='checkbox'.$count. value=$count />".$row['ItemName'].'   ' .$row['Price']."</br>";
				$count=$count+1;		
			 }while($row=mysqli_fetch_array($result));
			 echo "<input type='submit' name= 'submit' >";	
		}
		else{
			echo "No results found";
		}
	}
echo "<style>";
echo ".resultsdive{display:block; background-color: #92a8d1; height:100px; color: white; margin:10px; padding:10px; font-size:20px; text-align:center vertical-align:middle;autoscroll:true;}";			
echo "</styple>";
echo "</form>";
echo "</div>";
echo "<div>";
?>
<?php include_once 'footer.php'; ?>