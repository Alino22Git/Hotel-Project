<?php
  if(!isset($_SESSION))
  {
    session_start();
  }
 
?>
<!DOCTYPE html>
<html lang="de">
<link rel="stylesheet" href="stylesheet.css">
<!--ANFANG Navigationsbar-->
<nav class="navbar navbar-expand-lg bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="Index.php">Overlook Hotel</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="Index.php">Home</a>
                </li>
                <li class="nav-item ">
                    <?php if( !isset($_SESSION['username']))  {
            ?>
                    <a class="nav-link" href="formular.php">Registrierung</a>
                    
                    <?php } ?>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="FAQ.php">FAQ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="Impressum.php">Impressum</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="newsanzeigen.php">News</a>
                </li>
                <li class="nav-item">
                <?php if( (isset($_SESSION['username']))&&($_SESSION['username']=="admin@hotel"))  {
            ?>
                    <a class="nav-link" href="newsschreiben.php">Beitrag schreiben</a>
                    <?php } ?>
                </li>
                <?php if( (isset($_SESSION['username']))&&($_SESSION['username']=="admin@hotel"))  {
            ?>
                    <a class="nav-link" href="userverwaltung.php">Userverwaltung</a>
                    <?php } ?>
                </li>
                <li class="nav-item">
                <?php if( (isset($_SESSION['username']))&&($_SESSION['username']=="admin@hotel"))  {
            ?>
                    <a class="nav-link" href="alle_reservierungen.php">Alle Reservierungen</a>
                    <?php } ?>
                </li>
                <li class="nav-item ">
                    <?php if( isset($_SESSION['username'])&&($_SESSION['username']!=="admin@hotel"))  {
            ?>
                    <a class="nav-link" href="reservierunganzeigen.php">Ihre Reservierungen</a>
                    
                    <?php } ?>
                </li>
                <li class="nav-item ">
                    <?php if( isset($_SESSION['username'])&&($_SESSION['username']!=="admin@hotel"))  {
            ?>
                    <a class="nav-link" href="reservierung.php">Neue Reservierung</a>
                    
                    <?php } ?>
                </li>
                <li class="nav-item ">
                    <?php if( isset($_SESSION['username'])&&($_SESSION['username']!="admin@hotel"))  {
            ?>
                    <a class="nav-link" href="profil.php">Profil</a>
                    
                    <?php } ?>
                </li>
                
            </ul>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item ">
                    <?php if( isset($_SESSION['username']))  
                    {?>
                    <a class="nav-link" href="logout.php">Logout</a>
                    <?php }else{ ?>
                    <a class="nav-link" href="login.php">Login</a>
                    <?php } ?>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!--ENDE Navigationsbar-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
</script>