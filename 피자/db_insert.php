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

$connect = new mysqli($hostname, $username, $password) 
     or die("DB Connection Failed");
//$result = mysql_select_db($dbname,$connect);
 
if($connect) {
 echo("MySQL Server Connect Success!");
}
else {
 echo("MySQL Server Connect Failed!");
}
 
//$connect->close() ; 
?>


<?php
// define variables and set to empty values
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
  //echo $data;
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

<?php

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
?>

<?php
$connect->close();

$connect = new mysqli($hostname, $username, $password, $dbname); 
if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
}

	$sql = "CREATE TABLE IF NOT EXISTS MyGuests (
	Order_Number INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	ID_Number VARCHAR(10) NOT NULL,
	name VARCHAR(30) NOT NULL,
	e_mail VARCHAR(30) NOT NULL,
	Phone_Number VARCHAR(50) NOT NULL,
	Topping VARCHAR(30) NOT NULL,
	pay_Method VARCHAR(30) NOT NULL,
	call_first tinyint(1) NOT NULL,
	reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

if ($connect->query($sql) === TRUE) {
    echo "Table MyGuests created successfully"."<br>";
} else {
    echo "Error creating table: " . $connect->error ."<br>";
}

//exec("db.insert.php" $idnumber,$name,$eamil,$phone,$topping,$paymethod,$callfirst);
$idnumber="'".$idnumber."'";
$name="'".$name."'";
$email="'".$email."'";
$phone="'".$phone."'";
$topping="'".$topping."'";
$paymethod="'".$paymethod."'";
if($callfirst==="yes"){
	$callfirst=1;
}
else{
	$callfirst=0;
}
$sql = "INSERT INTO MyGuests (ID_Number, name, e_mail,Phone_Number,Topping,pay_Method,Call_first)
VALUES ($idnumber, $name, $email,$phone,$topping,$paymethod,$callfirst)";
 
if ($connect->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $connect->error;
}

/*
//sql to create table
/*$sql="create Table MyGuest(
	Order_Number INT(6) NOT NULL,
	ID_Number INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	Name VARCHAR(30) NOT NULL,
	E-mail VARCHAR(50) NOT NULL,
	phone_Number VARCHAR(30) NOT NULL,
	Topping VARCHAR(30)	NOT NULL,
	pay_Method VARCHAR(30) NOT NULL,
	Call-first tinyint(1) NOT NULL,
	Order_Date TIMESTMP
)";
if($conn->query($sql)===TRUE)){
	echo "Table MyGuests created successfully";
}else{
	echo "Error creating table ". $conn->error;
}*/
$connect->close();

?>

</body>
</html>
