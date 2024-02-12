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

  $etunimi = filter_var($_POST['etunimi'], FILTER_SANITIZE_STRING);
  $sukunimi = filter_var($_POST['sukunimi'], FILTER_SANITIZE_STRING);
  $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
  $password = $_POST['password'];
  $hashed_password = password_hash($password, PASSWORD_DEFAULT);

  // Validoi syötetyt tiedot

  // validoi sähköposti
  $errors = [];
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'Invalid email format';
  }

  // validoi että etunimi ja sukunimi sisältävät vain kirjaimia ja välilyöntejä
  if (!preg_match("/^[a-zA-Z ]*$/", $etunimi)) {
    $errors[] = "Vain kirjaimia ja välilyöntejä sallittu etunimessä";
  }

  if (!preg_match("/^[a-zA-Z ]*$/", $sukunimi)) {
    $errors[] = "Vain kirjaimia ja välilyöntejä sallittu sukunimessä";
  }

  if (count($errors) > 0) {
    // Jos on erroreita niin tulosta ne
    echo '<h2><p style="color:red;"><b>Error: Virhe rekisteröinnissä, tarkista antamasi tiedot</b></p></h2>';
    foreach ($errors as $error) {
      echo "<p style='color:red;'>$error</p>";
    }
    exit();
  }

  $sql = "INSERT INTO nordma (etunimi, sukunimi, email, salasana) VALUES (?, ?, ?, ?)";
  $stmt = $pdo->prepare($sql);
  if ($stmt->execute([$etunimi, $sukunimi, $email, $hashed_password])) {
    echo 'Registration successful';
    exit();
  } else {
    echo 'Error: Virhe rekisteröinnissä, tarkista antamasi tiedot';
  }
} catch (PDOException $e) {
  echo "<h2><p style='color:red;'><b>Error: Virhe rekisteröinnissä, tarkista antamasi tiedot<br>Sähköposti mahdollisesti jo käytössä</p></h2>";
}
