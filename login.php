<?php
session_start();

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

<!-- Login form -->
<form class="form-container" method="post" action="checklogin.php">
    <h2>Kirjaudu sisään</h2>
    <label class="form-label" for="email">Sähköposti:</label>
    <input class="form-input" type="email" name="email" id="email" required>
    <label class="form-label" for="password">Salasana:</label>
    <input class="form-input" type="password" name="password" id="password" required>
    <input class="form-submit" type="submit" value="Kirjaudu">
    <?php
        if(isset($_SESSION['error'])) {
            $error = $_SESSION['error'];
            echo "<span class='form-error'>$error</span>";
        }
    ?>
    <input class="form-button" type="button" onclick="location.href='register.html';" value="Rekisteröidy" />
</form>

<div id="errorMessages"></div>

<script>
document.getElementById("loginForm").addEventListener("submit", function(event) {
    event.preventDefault(); // Estä lomakkeen oletustoiminto

    // Hae lomakkeen tiedot
    var email = document.getElementById("email").value;
    var password = document.getElementById("password").value;

    // Tarkista, että sähköposti ja salasana on syötetty
    if (email.trim() === "" || password.trim() === "") {
        document.getElementById("errorMessages").innerHTML = "<p style='color:red;'>Sähköposti ja salasana ovat pakollisia.</p>";
        return;
    }

    // Jos kaikki on kunnossa, lähetä lomakkeen tiedot PHP-skriptille
    this.submit();
});
</script>
        
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
            </ul>
        </div>
    
        <!-- Include the JavaScript file at the end of the body for better performance -->
        <script src="script.js"></script>
    </body>
    </html>

    <?php
    unset($_SESSION['error']);
    ?>