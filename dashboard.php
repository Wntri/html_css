<?php
session_start();

// Tarkista onko käyttäjä kirjautunut
if (!isset($_SESSION['loggedin'])) {
  header('Location: login.php');
  exit;
  $_SESSION['user_id'] = $kayttajan_id;
}

// Tarkista onko käyttäjä ylläpitäjä
if ($_SESSION["isAdmin"] == 0) {
  header('Location: index.html');
  exit;
}
?>

<!DOCTYPE html>
<html lang="fi">

<head>
  <!-- Set the character set to UTF-8 for proper encoding -->
  <meta charset="UTF-8">

  <!-- Define the viewport settings for responsive design -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Meta description about site content -->
  <meta name="description" content="Edullista digimarkkinointia Helsinki ja Uusimaa | Markkinointitoimisto Helsingissä pääkaupunkiseudulla | Mainostoimisto Helsingissä | Digimarkkinointi Uusimaa">

  <!-- Link to the external stylesheet -->
  <link rel="stylesheet" href="styles.css">

  <!-- Preconnect to external font resources -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

  <!-- Link to the Roboto font from Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400&display=swap" rel="stylesheet">

  <!-- Set the title of the HTML document -->
  <title>Edullista digimarkkinointia Helsinki ja Uusimaa</title>

  <link rel="apple-touch-icon" sizes="180x180" href="img/favicon_io/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="img/favicon_io/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="img/favicon_io/favicon-16x16.png">
  <link rel="manifest" href="/site.webmanifest">

  <meta property="og:title" content="Edullista digimarkkinointia Helsinki ja Uusimaa">
  <meta property="og:type" content="website">
  <meta property="og:url" content="https://nordma.fi">
  <meta property="og:image" content="">
  <meta property="og:description" content="Edullista digimarkkinointia Helsinki ja Uusimaa | Markkinointitoimisto Helsingissä pääkaupunkiseudulla | Mainostoimisto Helsingissä | Digimarkkinointi Uusimaa">

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>

<body>
  <!-- Header section containing navigation -->
  <header>
    <nav>
      <a href="index.html">
        <img class="logo" src="img/nordma-logo-transparent-bg.png" alt="Nordma Logo"> </a>
      <!-- Navigation links -->
      <ul class="nav-links">
        <li><a href="index.html">Etusivu</a></li>
        <li><a href="hakukoneoptimointi.html">Hakukoneoptimointi</a></li>
        <li><a href="somemarkkinointi.html">Somemarkkinointi</a></li>
        <li><a href="googlemarkkinointi.html">Google Ads</a></li>
        <li><a href="yhteydenotto.html">Yhteydenotto</a></li>
        <li><a href="vieraskirja.php">Vieraskirja</a></li>
      </ul>

      <!-- Mobile menu button -->
      <div class="menu-btn">&#9776; Menu</div>
    </nav>
  </header>

  <!-- Main content of the page -->
  <main>
    <div class="big-box">
      <img src="img/nordma-header-1980x480-transparent.webp" alt="Nordma Header">
    </div>

    <section>
      <div id="table-container">
        <h1>Dashboard</h1>
        <p>Tervetuloa hallintapaneeliin!</p>

        <table id="guestbook-table">
          <thead>
            <tr>
              <th>Lähettäjä</th>
              <th>Viesti</th>
              <th>Toiminnot</th>
            </tr>
          </thead>
          <tbody id="guestbook-entries">
            <!-- Guestbook entries will be loaded here dynamically -->
            <?php
            // hae tietokannasta viestit ja lähettäjän tiedot.
            $servername = 'localhost';
            $dbname   = 'wp_trtkm23a_5';
            $username = 'trtkm23a_5';
            $password = 'Qbarekix';

            try {
              $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
              $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

              $sql = "SELECT entries.*, nordma.etunimi AS sender_name FROM entries JOIN nordma ON entries.sender_id = nordma.id";
              $stmt = $pdo->query($sql);

              while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                echo "<td>{$row['sender_name']}</td>";
                echo "<td>{$row['message']}</td>";
                echo "<td><a href='edit_message.php?id={$row['msgid']}'>Muokkaa</a> <a href='delete_message.php?id={$row['msgid']}'>Poista</a></td>";

                echo "</tr>";
              }
            } catch (PDOException $e) {
              echo "Connection failed: " . $e->getMessage();
            }
            ?>
          </tbody>
        </table>
      </div>
    </section>

  </main>

  <!-- Footer section -->
  <footer>
    <!-- Left-aligned content in the footer -->
    <div class="footer-box left">+358 9 2316 7475<br>Sturenkatu 26,<br>00510, Helsinki<br>3371142-3</div>

    <!-- Center-aligned copyright information -->
    <div class="footer-box center">&copy; 2024 Nordma. Kaikki oikeudet pidätetään.</div>

    <!-- Right-aligned content in the footer -->
    <div class="footer-box right">
      <a href="https://www.instagram.com/nordicmarketingassistants/" target="_blank" title="Norman Instagram sivulle">
        <img src="img/instagram_2111463.png" alt="Instagramin logo jossa linkki Nordman Instagram sivulle">
      </a>
      <a href="https://www.facebook.com/profile.php?id=100092490196029" target="_blank" title="Nordman Facebook sivulle">
        <img src="img/facebook_5968764.png" alt="Facebookin logo jossa linkki Nordman Facebook sivulle">
      </a>
    </div>
  </footer>

  <!-- Mobile menu for small screens -->
  <div class="mobile-menu">
    <ul>
      <!-- Mobile navigation links -->
      <li><a href="index.html">Etusivu</a></li>
      <li><a href="hakukoneoptimointi.html">Hakukoneoptimointi</a></li>
      <li><a href="somemarkkinointi.html">Somemarkkinointi</a></li>
      <li><a href="googlemarkkinointi.html">Google Ads</a></li>
      <li><a href="yhteydenotto.html">Yhteydenotto</a></li>
      <li><a href="vieraskirja.php">Vieraskirja</a></li>
    </ul>
  </div>

  <!-- Include the JavaScript file at the end of the body for better performance -->
  <script src="script.js"></script>
</body>

</html>