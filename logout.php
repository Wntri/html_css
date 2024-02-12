<?php
// Aloita istunto
session_start();

// Tyhjennä istunto
$_SESSION = array();

// Tuhotaan istunto
session_destroy();

// Ohjaa käyttäjä uloskirjautumisen jälkeen haluamallesi sivulle
header("Location: login.php");
exit();
?>
