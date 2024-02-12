<?php
session_start();

// Tarkista, että käyttäjä on kirjautunut sisään
if (!isset($_SESSION['loggedin'])) {
    header('Location: login.php');
    exit;
}

// Tarkista, että käyttäjä on ylläpitäjä
if ($_SESSION["isAdmin"] == 0) {
    header('Location: index.html');
    exit;
}

// Tietokantayhteys
$servername = 'localhost';
$dbname   = 'test';
$username = 'root';
$password = '';

try {

    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Tarkista, että viestin id
    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
        $message_id = $_GET['id']; // Viestin ID

        // Poista viesti tietokannasta
        $stmt = $pdo->prepare("DELETE FROM entries WHERE msgid = :id");
        
        $stmt->execute(['id' => $message_id]);

        // Ohjaa käyttäjä takaisin hallintapaneeeliin
        header('Location: dashboard.php');
        exit;
    } else {
        // Viestin ID:tä ei ole annettu
        echo "Viestin ID:tä ei ole annettu.";
    }
} catch(PDOException $e) {
    // Käsittele tietokantavirheet
    echo "Tietokantavirhe: " . $e->getMessage();
}
?>
