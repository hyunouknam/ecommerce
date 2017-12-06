<?php
	if (isset($_SESSION['isCustomerLogin'])){
		if(isset($_POST['submit'])){ 
			include_once "dbh.inc.php";
			$password= mysqli_real_escape_string($conn,$_POST['password']);
			$firstname=mysqli_real_escape_string($conn,$_POST['firstname']);
			$lastname=mysqli_real_escape_string($conn,$_POST['lastname']);
			$address=mysqli_real_escape_string($conn,$_POST['address']);
			$email=mysqli_real_escape_string($conn,$_POST['email']);
			$phone=mysqli_real_escape_string($conn,$_POST['phone']); 	
			
			$customerId=$_SESSION['isCustomerLogin']['Id'];
			$sql = "UPDATE Customer 
					SET Password = '$password', FirstName = '$firstname', LastName = '$lastname', Address = '$address', Email = $email, PhoneNumber = $phone
					WHERE CustomerId = $customerId;";
			mysqli_query($conn,$sql);
			echo "successfully updated your profile";
			exit();
		}	
	}


	if (isset($_SESSION['isSellerLogin'])){
		if(isset($_POST['submit'])){
			include_once "dbh.inc.php";
			$password= mysqli_real_escape_string($conn,$_POST['password']);
			$firstname=mysqli_real_escape_string($conn,$_POST['firstname']);
			$lastname=mysqli_real_escape_string($conn,$_POST['lastname']);
			$address=mysqli_real_escape_string($conn,$_POST['address']);
			$email=mysqli_real_escape_string($conn,$_POST['email']);
			$phone=mysqli_real_escape_string($conn,$_POST['phone']); 	
			
			$sellerId=$_SESSION['isSellerLogin']['Id'];
			$sql = "UPDATE Seller 
					SET Password = '$password', FirstName = '$firstname', LastName = '$lastname', Address = '$address', Email = $email, PhoneNumber = $phone
					WHERE SellerId = $sellerId;";
			mysqli_query($conn,$sql);
			echo "successfully updated your profile";
			exit();
		}	
	}

	if (isset($_SESSION['isEmployeeLogin'])){
		$tableName="Employee";
		$searchId="EmployeeId";
		if(isset($_POST['submit'])){
			include_once "dbh.inc.php";
			$password=mysqli_real_escape_string($conn,$_POST['password']);
			$firstname=mysqli_real_escape_string($conn,$_POST['firstname']);
			$lastname=mysqli_real_escape_string($conn,$_POST['lastname']);
			$address=mysqli_real_escape_string($conn,$_POST['address']);
			$email=mysqli_real_escape_string($conn,$_POST['email']);
			$phone=mysqli_real_escape_string($conn,$_POST['phone']); 
			$role=mysqli_real_escape_string($conn,$_POST['role']);

			$employeeId=$_SESSION['isSellerLogin']['Id'];
			$sql = "UPDATE Employee 
					SET Password = '$password', FirstName = '$firstname', LastName = '$lastname', Address = '$address', Email = $email, PhoneNumber = $phone, Role = $role
					WHERE EmployeeId = $employeeId;";
			mysqli_query($conn,$sql);
			echo "successfully updated your profile";
			exit();
		}	
	}		
		
	
?>