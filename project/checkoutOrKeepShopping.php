<?php
	include_once 'header.php'; 
	




if (isset($_POST['keepsearch'])){
	echo "you want keep searching??";
	header( "refresh:2;url=searchresults.php" );
	exit();
}
else if (isset($_POST['checkout'])){
	echo "you want checkout???";
	
}


	include_once 'footer.php'
?>