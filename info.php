<!DOCTYPE html>
<html>
<body>

<h1>My first PHP page</h1>

<?php
echo "<h2> My second header! </h2>";
echo "Hello World! <br>";
echo "what The Hell!<br>";
echo "This ", "string", "was ", "made " ,"with ", "multiple parameters <br>";
$text1 = "Learn PHP";
$text2= "W3Schools.com";
$x=5;
$y=4;
echo "<h3>" . $text1 . "</h3>";
echo "Study PHP at " .$text2 . "<br>";
echo $x+$y;
echo "<br>";
echo "so this also means, you  can have more than 1 variables share the same name <br>";
$x = 5 /* + 15 */ + 5;
echo $x;
print "<br>";
print "<h4> Let's play with print </h4>";
print "PHP is Fun <br>";
print "Hello world!<br>";
print "I am about to learn PHP!<br>";

$text1="Learn PHP";
$text2="W3Schools.com";
$x=5;
$y=4;
print "<h2>" .$text1. "</h2>";

$servername = "localhost";
$username = "root";
$password = "12345";
$dbname = "myDB";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "INSERT INTO MyGuests (firstname, lastname, email)
VALUES ('John', 'Doe', 'john@example.com')";

if (mysqli_query($conn, $sql)) {
    $last_id = mysqli_insert_id($conn);
    echo "New record created successfully. Last inserted ID is: " . $last_id;
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
?>


</body>
</html>