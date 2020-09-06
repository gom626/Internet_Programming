<?php
exec("python request.py", $out, $status);

$cnt=count($out);

for($i=0;$i<$cnt;$i=$i+3){
	echo "class: ".$out[$i]."<br>";
	echo "score: ".$out[$i+1]."<br>";
	echo "position: ".$out[$i+2]."<br>";
}
//echo "class: ".$out[0]."<br>";
//echo "score: ".$out[1]."<br>";
//echo "position: ".$out[2];
//echo $cnt;

$servername = "localhost";
$username = "cse20151600";
$password = "cse20151600";
$dbname = "db_cse20151600";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// sql to create table
$sql = "CREATE TABLE IF NOT EXISTS PIC (
ORDER_NUMBER INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
CLASS VARCHAR(30) NOT NULL,
SCORE VARCHAR(30) NOT NULL,
POSITION VARCHAR(200) NOT NULL
)";

if ($conn->query($sql) === TRUE) {
    echo "Table MyGuests created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}
for($i=0;$i<$cnt;$i=$i+3){
	$class="'".$out[$i]."'";
	$score="'".$out[$i+1]."'";
	$position="'".$out[$i+2]."'";
	$sql = "INSERT INTO PIC (CLASS,SCORE,POSITION) VALUES ($class,$score,$position)";
	if ($conn->query($sql) === TRUE) {
		echo "New record created successfully";
	} else {
		echo "Error: " . $sql . "<br>" . $connect->error;
	}
	echo "$sql"."<br>";
}

$conn->close();

?>

