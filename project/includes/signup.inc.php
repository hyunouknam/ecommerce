<?php
	
	if (strcmp($signuptype,"Seller")==0){
		$tableName="Seller";
		$searchId="SellerId";
		if(isset($_POST['submit'])){ 
		echo "it is CLICKED";
		include_once "dbh.inc.php";
		$uid=mysqli_real_escape_string($conn,$_POST['uid']);
		$firstname=mysqli_real_escape_string($conn,$_POST['firstname']);
		$lastname=mysqli_real_escape_string($conn,$_POST['lastname']);
		$address=mysqli_real_escape_string($conn,$_POST['address']);
		$email=mysqli_real_escape_string($conn,$_POST['email']);
		$phone=mysqli_real_escape_string($conn,$_POST['phone']); 
		if(!preg_match("/^[0-9]/",$uid)){
			header("Location: ../signup.php? signup=invalid");
			exit();
		}
		else{
			$sql="INSERT INTO  $tableName (SellerId, FirstName, LastName,  Address, Email, PhoneNumber) VALUES ($uid, '$firstname', '$lastname', '$address', '$email', '$phone');";
			mysqli_query($conn,$sql);
			exit();
			}
		}	
	}
	else if (strcmp($signuptype,"Customer")==0){
		$tableName="Customer";
		$searchId="CustomerId";
		if(isset($_POST['submit'])){ 
			echo "it is CLICKED";
			include_once "dbh.inc.php";
			$uid=mysqli_real_escape_string($conn,$_POST['uid']);
			$firstname=mysqli_real_escape_string($conn,$_POST['firstname']);
			$lastname=mysqli_real_escape_string($conn,$_POST['lastname']);
			$address=mysqli_real_escape_string($conn,$_POST['address']);
			$email=mysqli_real_escape_string($conn,$_POST['email']);
			$phone=mysqli_real_escape_string($conn,$_POST['phone']); 
			if(!preg_match("/^[0-9]/",$uid)){
				header("Location: ../signup.php? signup=invalid");
			exit();
			}
			else{
				$sql="INSERT INTO  $tableName (CustomerId, FirstName, LastName,  Address, Email, PhoneNumber) VALUES ($uid, '$firstname', '$lastname', '$address', '$email', '$phone');";
				mysqli_query($conn,$sql);
				exit();
			}
		}	
	}
	if (strcmp($signuptype,"Employee")==0){
		$tableName="Employee";
		$searchId="EmployeeId";
		if(isset($_POST['submit'])){ 
			echo "it is CLICKED";
			include_once "dbh.inc.php";
			$uid=mysqli_real_escape_string($conn,$_POST['uid']);
			$firstname=mysqli_real_escape_string($conn,$_POST['firstname']);
			$lastname=mysqli_real_escape_string($conn,$_POST['lastname']);
			$address=mysqli_real_escape_string($conn,$_POST['address']);
			$email=mysqli_real_escape_string($conn,$_POST['email']);
			$phone=mysqli_real_escape_string($conn,$_POST['phone']); 
			$role=mysqli_real_escape_string($conn,$_POST['role']); 
			$datejoined= date("Y-m-d H:i:s"); 
			if(!preg_match("/^[0-9]/",$uid)){
			header("Location: ../signup.php? signup=invalid");
			exit();
		}
		else{
			$sql="INSERT INTO  $tableName (EmployeeId, FirstName, LastName,  Address, Email, PhoneNumber, role,datejoined) VALUES ($uid, '$firstname', '$lastname', '$address', '$email', '$phone', '$role', '$datejoined');";
			mysqli_query($conn,$sql);
			exit();
			}
		}	
	}		
		
	
?>