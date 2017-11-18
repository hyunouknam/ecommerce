<?php
	
	if (strcmp($signuptype,"Seller")==0){
			$tableName="seller";
			$searchId="SellerId";
	}
	else if (strcmp($signuptype,"Customer")==0){
			$tableName="customer";
			$searchId="CustomerId";
	}
	if (strcmp($signuptype,"Employee")==0){
			$tableName="employee";
			$searchId="EmployeeId";
	}		
	if(isset($_POST['submit'])){ 
		echo "it is CLICKED";
		include_once "dbh.inc.php";
		$uid=mysqli_real_escape_string($conn,$_POST['uid']);
		if(!preg_match("/^[0-9]/",$uid)){
			header("Location: ../signup.php? signup=invalid");
			exit();
		}
		else{	
		$sql="INSERT INTO " .$tableName. " (".$searchId.") "."VALUES" ." (".$uid.");";
		echo $sql;		
		mysqli_query($conn,$sql);
		exit();
		}
	}			
	
?>