<!DOCTYPE html>
<html>
<head>
<title></title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>

<?php
if(!isset($_SESSION)){
    session_start();
}

if (isset($_SESSION['isCustomerLogin'])){
    echo "<header>";
    echo "<nav>";
    echo '<div class ="main-wrapper">';
    echo "<ul>";
    echo '<li><a href="customerLoggedin.php">Home</a> </li>';
    echo "</ul>";
    echo "</div>";
    echo "</nav>";
    echo "</header>";
  } 
  else if (isset($_SESSION['isSellerLogin'])){
    echo "<header>";
    echo "<nav>";
    echo '<div class ="main-wrapper">';
    echo "<ul>";
    echo '<li><a href="sellerLoggedin.php">Home</a> </li>';
    echo "</ul>";   
    echo "</div>";
    echo "</nav>";
    echo "</header>";
  }
  else if (isset($_SESSION['isEmployeeLogin'])){
    echo "<header>";
    echo "<nav>";
    echo '<div class ="main-wrapper">';
    echo "<ul>";
    echo '<li><a href="employeeLoggedin.php">Home</a> </li>';
    echo "</ul>";
    echo "</div>";
    echo "</nav>";
    echo "</header>";
  }
  else {
    echo "<header>";
    echo "<nav>";
    echo '<div class ="main-wrapper">';
    echo "<ul>";
    echo '<li><a href="homepage.php">Home</a> </li>';
    echo "</ul>";
    echo "</div>";
    echo "</nav>";
    echo "</header>";
  }

?>

</body>

</html>