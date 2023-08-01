<?php
session_start();?>
<!DOCTYPE html>
<html lang="de">

<head>

    <title>Logout</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="stylesheet.css">

</head>

<body class="login_body">
    <?php include "navbar.php" ?>
    <h1>Logout</h1>
    <fieldset>
        <?php
if( isset($_SESSION["username"]))  
{


// remove all session variables
session_unset();

// destroy the session
session_destroy();


header("Refresh:0");
}

else echo"Sie sind jetzt ausgeloggt!";

?>

    </fieldset>
</body>