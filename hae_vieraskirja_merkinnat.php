<?php
session_start();

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

$conn = new mysqli($servername, $username, $password, $dbname);

// Tarkista yhteys
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Hae vieraskirjan merkinnät ja lähettäjän tiedot tietokannasta
$sql = "SELECT entries.*, nordma.id AS sender_id, nordma.etunimi AS sender_name FROM entries JOIN nordma ON entries.sender_id = nordma.id";
$result = $conn->query($sql);

// Tulosta merkinnät HTML-muodossa
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<div><strong>" . $row['title'] . "</strong><br>" . $row['message'] . "<br> Lähettäjän id: " . $row['sender_id'] . "<br> Lähettäjän etunimi: " . $row['sender_name'] . "</div>";
    }
} else {
    echo "Ei merkintöjä.";
}


// Sulje yhteys
$conn->close();
?>