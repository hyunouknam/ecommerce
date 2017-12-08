<?php
	session_start();
	$itemid = $_SESSION['itemid'];
	header("Location: detail.php?itemid=$itemid");

?>