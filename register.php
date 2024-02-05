// register.php
<?php
// Database connection, replace with your connection string
$host = 'localhost';
$db   = 'myDatabase';
$user = 'myUser';
$pass = 'myPassword';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$pdo = new PDO($dsn, $user, $pass);

$etunimi = $_POST['etunimi'];
$sukunimi = $_POST['sukunimi'];
$email = $_POST['email'];
$password = $_POST['password'];
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

$sql = "INSERT INTO users (etunimi, sukunimi, email, password) VALUES (?, ?, ?, ?)";
$stmt = $pdo->prepare($sql);
$stmt->execute([$etunimi, $sukunimi, $email, $hashed_password]);

echo 'Registration successful';