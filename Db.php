<?php
// db.php - central DB connection using Railway env vars
$host = getenv('MYSQLHOST') ?: getenv('DB_HOST') ?: '127.0.0.1';
$user = getenv('MYSQLUSER') ?: getenv('DB_USER') ?: 'root';
$pass = getenv('MYSQLPASSWORD') ?: getenv('DB_PASS') ?: '';
$db   = getenv('MYSQLDATABASE') ?: getenv('DB_NAME') ?: 'login_system';
$port = getenv('MYSQLPORT') ?: 3306;

$mysqli = new mysqli($host, $user, $pass, $db, (int)$port);
if ($mysqli->connect_error) {
    http_response_code(500);
    die("DB_CONN_ERROR");
}
$mysqli->set_charset('utf8mb4');
