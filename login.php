<?php
// login.php
<?php
// Database connection, replace with your connection string
$host = 'localhost';
$db   = 'myDatabase';
$user = 'myUser';
$pass = 'myPassword';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$pdo = new PDO($dsn, $user, $pass);

$email = $_POST['email'];
$password = $_POST['password'];

$sql = "SELECT * FROM users WHERE email = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$email]);
$user = $stmt->fetch();

if ($user && password_verify($password, $user['password'])) {
    session_start();
    $_SESSION['email'] = $email;
    echo 'Logged in';
} else {
    echo 'Invalid email or password';
}
?>