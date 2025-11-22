<?php
// login.php
header('Content-Type: text/plain; charset=utf-8');

// basic checks
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo 'error';
    exit;
}

require_once 'db.php';

// get POST safely
$username = isset($_POST['username']) ? trim($_POST['username']) : '';
$password = isset($_POST['password']) ? trim($_POST['password']) : '';

if ($username === '' || $password === '') {
    echo 'error';
    exit;
}

// NOTE: For initial simple setup we compare plaintext (only for testing).
// Later we'll switch to hashed passwords (recommended).
$stmt = $mysqli->prepare('SELECT id FROM users WHERE username = ? AND password = ? LIMIT 1');
$stmt->bind_param('ss', $username, $password);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    echo 'success';
} else {
    echo 'error';
}
$stmt->close();
$mysqli->close();
