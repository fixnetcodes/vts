<?php
session_start();
require_once __DIR__ . '/../database/DBConfig.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);
$db = new DB();
$data = $db->connect();
$username = $_SESSION['username'];
echo $username;

?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>
    <h1>Welcome, <?php echo $username; ?></h1>
    <!-- Your dashboard content here -->
</body>
</html>
