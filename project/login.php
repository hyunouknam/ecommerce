<!DOCTYPE html>
<html>
<head>
<title></title>
	
</head>
<body>
<header>   
</header>

 <nav>
      <div class ="main-wrapper">
		<?php
			include_once 'header.php';
			session_start();
			$logintype = $_SESSION['selected_login_type'];
			echo "<h1 class='h1class'> This is" ." $logintype ". "login </h1>";	
				
		?>	
		<style>
			.h2class{
				margin:30px;
				padding:30px;
			}
		</style>
	
	
	<form class ="signin-form"  method ="POST">
		<div class="container">
		<label><b>ID</b></label>
		<input type="text" placeholder="Enter ID in int" name="uid" required>
		<input type="submit" value="submit" name="submit" >
		</div>
	</form>		
	<?php
		
		$dbServername="localhost";
		$dbUsername="root";
		$dbPassword="12345";
		$dbName="ecommence"; 
		if(isset($_POST['submit'])){
			$conn=mysqli_connect($dbServername,$dbUsername,$dbPassword,$dbName);
			
			if ($conn->connect_error) {
				die("Connection failed: " . $conn->connect_error);
			}
			else{
				echo "connect database successfully\n";
				echo "\r\n";
			}
		
		$uid=mysqli_real_escape_string($conn,$_POST["uid"]);
		//error handlers
		//check if inputs are empty my code checks
		$tableName='';
		$searchId='';
		if (strcmp($logintype,"Seller")==0){
			$tableName="seller";
			$searchId="SellerId";
		}
		else if (strcmp($logintype,"Customer")==0){
			$tableName="customer";
			$searchId="CustomerId";
		}
		if (strcmp($logintype,"Employee")==0){
			$tableName="employee";
			$searchId="EmployeeId";
		}		
		$sql="SELECT  *  FROM  " ." $tableName ". " WHERE " .$searchId. "=".$uid;
		$result=mysqli_query($conn,$sql);
		$resultCheck=mysqli_num_rows($result);
		if($resultCheck<1){	
			echo "no user is found under this name";
			header("login.php");
			exit();
			}
		else if($resultCheck>=1){
			echo "Login successfully!!!";
			}
		}
	?>
    </div>
    </nav>
	<style>
		.container{
			margin:40px;
		}
	</style>
	
	
	
</body>
</html>