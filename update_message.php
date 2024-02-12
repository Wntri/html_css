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
    $message_id = filter_var($_POST['message_id'], FILTER_SANITIZE_NUMBER_INT);
    $title = filter_var($_POST['title'], FILTER_SANITIZE_STRING);
    $message_content = filter_var($_POST['message'], FILTER_SANITIZE_STRING);

    // Validoi käyttäjän syöte
    $errors = [];
    if (empty($title)) {
      $errors[] = "Aihe on pakollinen.";
    }
    if (empty($message_content)) {
      $errors[] = "Viesti on pakollinen.";
    }

    if (!empty($errors)) {
      foreach ($errors as $error) {
        echo "<p>$error</p>";
      }
      exit;
    }

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
} catch (PDOException $e) {
  // Käsittele tietokantavirheet
  echo "Tietokantavirhe: " . $e->getMessage();
}
