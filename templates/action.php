
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "try";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
// check data submission

if  ( $_SERVER["REQUEST_METHOD"] == "POST"){
    $username = trim($_POST['username']);
    $email = trim ($_POST['email']);
    $password = ($_POST['password']);
    $confirmPassword = ($_POST['password1']);

    //check if password matches
    if ($password !== $confirmPassword){
        die("The password doesn't match."); 
}
// hashing password for security

$hashPassword = password_hash ($password, PASSWORD_DEFAULT);

//sql-injection preventation

$stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?,?,?)");
$stmt-> bind_param("sss", $username, $email, $hashPassword);
//excute query

if ($stmt->execute()) {
    echo "You have registered successfully";
}else{
    echo "Error: " . $stmt->error;

}
$stmt->close();

}
$conn->close();

?>
