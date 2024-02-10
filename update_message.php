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

    // Tarkista, että tarvittavat tiedot on lähetetty POST-metodilla
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['message_id']) && isset($_POST['title']) && isset($_POST['message'])) {

        // Päivitä viestin tiedot tietokantaan
        $title = $_POST['title'];
        $message_content = $_POST['message'];
        $message_id = $_POST['message_id'];

        // Valmistele päivityskysely
        $update_stmt = $pdo->prepare("UPDATE entries SET 
        title = :title, 
        message = :message 
        WHERE msgid = :id");

        // Suorita päivityskysely
        $update_stmt->execute(['title' => $title, 'message' => $message_content, 'id' => $message_id]);

        // Ohjaa käyttäjä takaisin hallintapaneeliin
        header('Location: dashboard.php');
        exit;
    } else {
        // Tarvittavia tietoja ei ole lähetetty
        echo "Virhe: Tarvittavia tietoja ei ole lähetetty.";
        exit;
    }
} catch(PDOException $e) {
    // Käsittele tietokantavirheet
    echo "Tietokantavirhe: " . $e->getMessage();
}
?>
