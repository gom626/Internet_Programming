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

$idnumber = $name = $email = $phone = $topping =
   $paymethod  = $callfirst = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $idnumber = test_input($_POST["ID"]);
  $name = test_input($_POST["name"]);
  $email = test_input($_POST["email"]);
  $phone = test_input($_POST["phone"]);
  $topping = test_input($_POST["topping"]);
  $paymethod = test_input($_POST["paymethod"]);
  $callfirst = test_input($_POST["callfirst"]);
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

echo "<h2>Your Input:</h2>";
echo "ID Number : "  ;
echo $idnumber;
echo "<br>";
echo "Name : "  ;
echo $name;
echo "<br>";
echo "E-mail : "  ;
echo $email;
echo "<br>";
echo "Phone Number : "  ;
echo $phone;
echo "<br>";
echo "Topping : " ;
echo $topping ;
echo "<br>";
echo "Pay Method : "  ;
echo $paymethod;
echo "<br>";

$Judge="";
//echo $Judge;

if(!($idnumber==="")){
	$Judge=$Judge."ID_Number"."='".$idnumber."' AND ";
}
//echo $Judge."<br>";
if(!($name==="")){
    $Judge=$Judge."name"."='".$name."' AND ";
}
//echo $Judge."<br>";
if(!($email==="")){
    $Judge=$Judge."e_mail"."='".$emaili."' AND ";
}
//echo $Judge."<br>";
if(!($phone==="")){
    $Judge=$Judge."phone_Number"."='".$phone."' AND ";
}
//echo $Judge."<br>";
if(!($topping==="")){
    $Judge=$Judge."Topping"."='".$topping."' AND ";
}
//echo $Judge."<br>";
if(!($paymethod==="")){
    $Judge=$Judge."pay_Method"."='".$paymethod."' AND ";
}
//echo $Judge."<br>";
if(!($callfirst==="")){
	if($callfirst==="yes"){
		$Judge=$Judge."Call_first"."="."'1'"."AND ";
	}
	else{
		$Judge=$Judge."Call_first"."="."'0'"."AND ";
	}
}
//echo $Judge."<br>";
$Judge=substr($Judge,0,-4);

//echo $Judge."<br>";
$sql="SELECT * FROM MyGuests Where $Judge";
//echo $sql."<br>";

$result = $connect->query($sql);
if(($result->num_rows) > "0") {
    // output data of each row
	echo "Order Number"."&nbsp &nbsp &nbsp"."ID Number"."&nbsp &nbsp &nbsp"."name"."&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp"."E-mail"."&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp"."Phone Number"."&nbsp &nbsp &nbsp &nbsp &nbsp"."Topping"."&nbsp&nbsp&nbsp"."Pay_Method"."&nbsp&nbsp&nbsp"."call-first","&nbsp&nbsp&nbsp"."reg_date"."<br>";
    while($row = $result->fetch_assoc()) {
        echo "&nbsp &nbsp &nbsp &nbsp &nbsp".$row["Order_Number"]."&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp".$row["ID_Number"]."&nbsp &nbsp &nbsp".$row["name"]."&nbsp&nbsp&nbsp&nbsp".$row["e_mail"]."&nbsp&nbsp&nbsp".$row["Phone_Number"]."&nbsp&nbsp&nbsp".$row["Topping"]."&nbsp&nbsp&nbsp".$row["pay_Method"]."&nbsp&nbsp&nbsp".$row["call_first"]."&nbsp&nbsp&nbsp".$row["reg_date"]."<br>";
    }
} else {
    echo "0 results";
}

$connect->close();
?>
</body>
</html>
