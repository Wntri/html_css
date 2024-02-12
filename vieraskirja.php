<?php
session_start();

// Tarkista, onko käyttäjä kirjautunut
if (!isset($_SESSION['loggedin'])) {
  header('Location: login.php');
  exit;

  $_SESSION['user_id'] = $kayttajan_id;
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
    <!-- Big box section with content -->
    <div class="big-box">
      <img src="img/nordma-header-1980x480-transparent.webp" alt="Nordma Header">
    </div>

    <section class="content-box">
      <!-- Lisää logout-nappi tähän -->
      <form action="logout.php" method="post">
        <input class="form-submit" type="submit" value="Kirjaudu ulos">
        <?php // Näytä hallinoi viestejä -nappi vain, jos käyttäjä on admin
        if ($_SESSION['isAdmin'] == 1) {
          echo '<input class="form-button" type="button" onclick="location.href=\'dashboard.php\';" value="Hallinoi viestejä" />';
        }
        ?>

      </form>

      <form class="guestbook-form" id="guestbook-form">
        <label for="title">Otsikko:</label><br>
        <input class="" type="text" id="title" name="title" required><br>
        <label for="message">Viesti:</label><br>
        <textarea id="message" name="message" required></textarea><br>
        <input type="submit" value="Lähetä"><br><br><br>
      </form>
      <div id="guestbook-entries">
        <!-- Guestbook entries will be loaded here -->
      </div>
    </section>

    <script src="vieraskirja.js"></script>

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