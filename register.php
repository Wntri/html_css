<?php
// Database connection, replace with your connection string
$servername = 'localhost';
$dbname   = 'test';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // aseta PDO-errotila heitto-tilaan
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Yhteys onnistui" . "<br>";
} catch(PDOException $e) {
    echo "Yhteys epäonnistui: " . "<br>" . $e->getMessage();
}

$etunimi = $_POST['etunimi'];
$sukunimi = $_POST['sukunimi'];
$email = $_POST['email'];
$password = $_POST['password'];
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

$sql = "INSERT INTO nordma (etunimi, sukunimi, email, salasana) VALUES (?, ?, ?, ?)";
$stmt = $pdo->prepare($sql);
$stmt->execute([$etunimi, $sukunimi, $email, $hashed_password]);

// Ohjaa käyttäjä login.php-sivulle
header('Location: login.php');
exit();

echo 'Registration successful';
?>
