<?php
require_once 'db.php';

// Get POST data
$username = isset($_POST['username']) ? trim($_POST['username']) : '';
$password = isset($_POST['password']) ? trim($_POST['password']) : '';

if($username === '' || $password === ''){
    echo "Please provide username and password.";
    exit;
}

// Check if username already exists
$stmt = $mysqli->prepare("SELECT id FROM users WHERE username=? LIMIT 1");
$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->store_result();

if($stmt->num_rows > 0){
    echo "Username already taken.";
    $stmt->close();
    exit;
}
$stmt->close();

// Insert new user (plain password for now; later use hashing)
$stmt = $mysqli->prepare("INSERT INTO users (username,password) VALUES (?,?)");
$stmt->bind_param("ss", $username, $password);
if($stmt->execute()){
    echo "success";
}else{
    echo "Error registering user.";
}
$stmt->close();
$mysqli->close();
?>
