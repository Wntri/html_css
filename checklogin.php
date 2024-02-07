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

// Tarkista, onko lomakkeen tiedot lähetetty ja tarkista sähköposti ja salasana tietokannasta
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(empty($_POST['email']) || empty($_POST['salasana'])) {
        echo 'Sähköposti ja salasana ovat pakollisia.';
        exit();
    }

    $email = $_POST['email'];
    $salasana = $_POST['salasana'];

    $sql = "SELECT * FROM nordma WHERE email = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    $error = "<p style='color:red;'>Virheellinen käyttäjätunnus tai salasana</p>";

    if ($user && password_verify($salasana, $user['salasana'])) {
        // Kirjautuminen onnistui
        $_SESSION['email'] = $email;
        $_SESSION['loggedin'] = true;
        echo 'Logged in';
        header('Location: vieraskirja.php');
        exit();
    } else {
        // Salasana väärin
        $_SESSION['error'] = $error;
        header('Location: login.php');
        //echo "<p style='color:red;'>Virheellinen käyttäjätunnus tai salasana</p>";
        exit();   
    }
}
?>