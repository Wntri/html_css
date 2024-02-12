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
$dbname   = 'wp_trtkm23a_5';
$username = 'trtkm23a_5';
$password = 'Qbarekix';

try {
  // Luo tietokantayhteys PDO:lla
  $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  // Aseta PDO:n virhemoodi, jotta saat ilmoitukset virheistä
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // Tarkista, että viestin ID on annettu GET-parametrina
  if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $message_id = $_GET['id']; // Viestin ID

    // Haetaan viestin tiedot tietokannasta käyttäen viestin ID:tä
    $stmt = $pdo->prepare("SELECT * FROM entries WHERE msgid = :id");
    $stmt->execute(['id' => $message_id]);
    $message = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$message) {
      echo "Viestiä ei löytynyt annetulla ID:llä.";
      exit;
    }
  } else {
    // Viestin ID:tä ei ole annettu
    echo "Viestin ID:tä ei ole annettu.";
  }
} catch (PDOException $e) {
  // Käsittele tietokantavirheet
  echo "Tietokantavirhe: " . $e->getMessage();
}

// Näytä lomake viestin muokkaamista varten
?>
<!DOCTYPE html>
<html lang="fi">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Muokkaa viestiä</title>
  <link rel="stylesheet" href="styles.css">
</head>

<body>
  <form method="post" action="update_message.php" class="edit-message-form">
    <h2>Muokkaa viestiä</h2>
    <input type="hidden" name="message_id" value="<?php echo $message_id; ?>">
    <label for="title">Aihe:</label><br>
    <input type="text" id="title" name="title" value="<?php echo $message['title']; ?>"><br><br>
    <label for="message">Viesti:</label><br>
    <textarea id="message" name="message" rows="4" cols="50"><?php echo $message['message']; ?></textarea><br><br>
    <input type="submit" value="Tallenna muutokset">
  </form>
</body>

</html>