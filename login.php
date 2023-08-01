<?php
// Start the session
session_start();
?>

<!DOCTYPE html>
<html lang="de">

<head>

    <title>Formular zur Anmeldung</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="stylesheet.css">

</head>

<body class="login_body">
    <?php include "navbar.php" ?>
    <h1>Anmeldung</h1>
    <fieldset class="login">
        <form class="row g-3" name="login" action="loginval.php" method="post">

            <div class="col-md-12">
                <label for="inputusername" class="form-label">email</label>
                <input type="email" class="form-control" id="usermail" name="usermail">
            </div>

            <div class="col-md-12">
                <label for="inputpasswort" class="form-label">Passwort</label>
                <input type="password" class="form-control" id="inputPassword" name="password">
            </div>

            <div class="col-12">
                <button type="submit" class="btn btn-primary">Sign in</button>
                <button type="reset" class="btn btn-primary">Reset</button>
            </div>
        </form>


    </fieldset>
</body>