<?php
session_start();
// Database connection, replace with your connection string
$servername = 'localhost';
$dbname   = 'test';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Aseta PDO:n virheenkäsittely tilaan heitto-tila
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $etunimi = $_POST['etunimi'];
    $sukunimi = $_POST['sukunimi'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO nordma (etunimi, sukunimi, email, salasana) VALUES (?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    if($stmt->execute([$etunimi, $sukunimi, $email, $hashed_password])) {
        echo 'Registration successful';
        exit();
    } else {
        echo 'Error: Virhe rekisteröinnissä, tarkista antamasi tiedot';
    }
} catch(PDOException $e) {
    echo "<h2><p style='color:red;'><b>Error: Virhe rekisteröinnissä, tarkista antamasi tiedot<br>Sähköposti mahdollisesti jo käytössä</p></h2>";
}
?>
