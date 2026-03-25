<?php
// includes/db.php
// Database Configuration

// Simple .env Loader
function loadEnv($path) {
    if (!file_exists($path)) return;
    $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0) continue;
        list($name, $value) = explode('=', $line, 2);
        putenv(trim($name) . "=" . trim($value));
    }
}
loadEnv(dirname(__DIR__) . '/.env');

$db_host = getenv('DB_HOST') ?: 'localhost';
$db_user = getenv('DB_USER') ?: 'root';
$db_pass = getenv('DB_PASS') ?: '';
$db_name = getenv('DB_NAME') ?: 'shwastik_school';

// Create connection
try {
    $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

    if ($conn->connect_error) {
        error_log("Connection failed: " . $conn->connect_error);
    }
} catch (Exception $e) {
    $conn = null;
}


// Function to sanitize inputs
function sanitize($data) {
    global $conn;
    if (!$conn) return htmlspecialchars(trim($data));
    return mysqli_real_escape_string($conn, htmlspecialchars(trim($data)));
}

// Function to get departments from DB
function get_departments() {
    global $conn;
    if (!$conn) return [];
    $sql = "SELECT * FROM departments";
    $result = $conn->query($sql);
    $deps = [];
    if ($result && $result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $deps[] = $row;
        }
    }
    return $deps;
}

// CSRF Protection (Basic)
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
?>
