<?php
session_start();

// Tarkista, onko käyttäjä kirjautunut sisään
if (!isset($_SESSION['user_id'])) {
    echo "Käyttäjä ei ole kirjautunut sisään.";
    exit();
}

// Otetaan käyttäjän id istunnosta
$user_id = $_SESSION['user_id'];

// Tietokantayhteys
$servername = 'localhost';
$dbname   = 'test';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit();
}

// Hanki lomakkeen tiedot
$title = $_POST['title'];
$message = $_POST['message'];

try {
    // Luo SQL-lause tallentamiseksi tietokantaan
    $sql = "INSERT INTO entries (title, message, sender_id) VALUES (:title, :message, :user_id)";
    
    // Valmistele SQL-lause
    $stmt = $pdo->prepare($sql);
    
    // Aseta parametrit
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':message', $message);
    $stmt->bindParam(':user_id', $user_id);
    
    // Suorita SQL-lause
    $stmt->execute();

    echo "Merkintä tallennettu onnistuneesti.";
} catch(PDOException $e) {
    echo "Virhe tallennettaessa merkintää: " . $e->getMessage();
}

// Sulje yhteys
$pdo = null;
?>
