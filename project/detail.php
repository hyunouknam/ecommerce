<?php
	include_once"header.php";
	session_start();
	$dbServername="localhost";
	$dbUsername="root";
	$dbPassword="12345";
	$dbName="ecommence"; 
?>	

<?php
	$itemid = $_GET['itemid'];
	echo $itemid;
?>