<html>
<body>

<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

echo ("MySQL - PHP Connect Test <br/>");
$hostname = "localhost";
$username = "cse20151600";
$password = "cse20151600";
$dbname = "db_cse20151600";

//$result = mysql_select_db($dbname,$connect);
$connect = new mysqli($hostname, $username, $password, $dbname);
if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
}

$label = $score = $position  =  "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $label = test_input($_POST["LABEL"]);
  $score = test_input($_POST["scores"]);
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

echo "<h2>Your Input:</h2>";
echo "LABEL : "  ;
echo $label;
echo "<br>";
echo "score : "  ;
echo $score;

$Judge="";
//echo $Judge;

if(!($label==="")){
	$Judge=$Judge."CLASS"."='".$label."' AND ";
}
//echo $Judge."<br>";
if(!($score==="")){
    $Judge=$Judge."SCORE"."='".$score."' AND ";
}
//echo $Judge."<br>";
$Judge=substr($Judge,0,-4);

$sql="SELECT * FROM PIC where $Judge";
echo $sql."<br>";

$result = $connect->query($sql);
if(($result->num_rows) > "0") {
    // output data of each row
	echo "Order Number"."&nbsp &nbsp &nbsp &nbsp"."label"."&nbsp &nbsp &nbsp"."score"."&nbsp &nbsp &nbsp"."Position"."<br>";
    while($row = $result->fetch_assoc()) {
        echo "&nbsp".$row["ORDER_NUMBER"]."&nbsp &nbsp &nbsp".$row["CLASS"]."&nbsp &nbsp &nbsp".$row["SCORE"]."&nbsp &nbsp &nbsp".$row["POSITION"]."&nbsp &nbsp &nbsp"."<br>";
    }
} else {
    echo "0 results";
}

$connect->close();
?>
</body>
</html>
