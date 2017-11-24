<?php
	include_once 'header.php'; 
/*session will stay alive for 10 seconds if user remains idle */
	session_start();
	$duration=60; /*60 seconds */
	$dbServername="localhost";
	$dbUsername="root";
	$dbPassword="12345";
	$dbName="ecommence"; 
	if(isset($_POST['submit'])){
		$conn=mysqli_connect($dbServername,$dbUsername,$dbPassword,$dbName);			
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}
		$uid=mysqli_real_escape_string($conn,$_POST["uid"]);
		$sql_customer= "SELECT * FROM customer WHERE CustomerId". " = ".$uid;
		$sql_seller= "SELECT * FROM seller WHERE SellerId". " = ".$uid;
		$sql_employee= "SELECT * FROM employee WHERE EmployeeId". " = ".$uid;
		
		$result_customer=mysqli_query($conn,$sql_customer);
		$resultCheck_customer=mysqli_num_rows($result_customer);
		
		$result_seller=mysqli_query($conn,$sql_seller);
		$resultCheck_seller=mysqli_num_rows($result_seller);
		
		$result_employee=mysqli_query($conn,$sql_employee);
		$resultCheck_employee=mysqli_num_rows($result_employee);
		
		if($resultCheck_customer==1){
				echo "<P> customer Login successfully!!! </p>";
				echo "<P>now directing you to search page!!! </p>";
				$_SESSION['isCustomerLogin']=array(
					"start"=>time(),
					"duration"=>$duration,
					"logintype"=>"CustomerLogin",
					"Id"=>$resultCheck_customer['CustomerId'],
				);
				header( "refresh:5;url=customerLoggedin.php" );				
				exit();
		}
		else if($resultCheck_seller==1){
			
		}
		else if ($resultCheck_employee==1){
				
		}
		else{			
			echo "NO account exists!";
			header("login.php");
			exit();
		} 
	}
	else{
		header("Location: login.php?status=error&msg=Please login");
	}
	
	include_once 'footer.php';
?>