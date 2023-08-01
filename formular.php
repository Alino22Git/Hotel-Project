<!DOCTYPE html>
<html lang="de">

<head>

    <title>Formular zur Registrierung</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="stylesheet.css">
    <?php include "navbar.php" ?>
</head>

<body>
    <h1>Registrierung</h1>
    <?php
  include "formval.php" ?>
    <fieldset>
        <?php
  if ($error == 0) {
    
      require_once ('dbaccess.php'); //to retrieve connection details
      $db_obj = new mysqli($host, $user, $password, $database);
      if ($db_obj->connect_error) {
      echo "Connection Error: " . $db_obj->connect_error;
      exit();
      }
      



      $sql = "INSERT INTO `users` (`vorname`, `nachname`, `password`, `useremail`, `anrede`, `geb`, `land`, `stadt`, `plz`)
      VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
      //sql-statement vorbereiten
      $stmt = $db_obj->prepare($sql);
      //anzahl der buchstaben=anzahlder daten s= string i=integer
      $stmt-> bind_param("ssssssssi", $vname, $nname, $pass, $email, $anrede, $date, $land, $stadt, $plz );
      //variablen mit werten versehen
      $stmt->execute();

    $_SESSION["benutzername"] = $email;



    if ($anrede == "frau") {
      echo "<h2> Liebe Frau $nname ,</h2>";
    } else if ($anrede == "herr") {
      echo "<h2> Lieber Herr $nname ,</h2>";
    } else {
      echo "<h2>$nname ,</h2>";
    }

    echo "<h2> vielen Dank für Ihre Registrierung!</h2>";
    echo "Ihre Daten lauten: ";
    echo "<br>";
    echo "$vname";
    echo "<br>";
    echo $nname;
    echo "<br>";
    echo "$email";
    echo "<br>";
    echo $date;
    echo "<br>";

  } else {
  ?>
        <html>
        <p><span class="error">* required field</span></p>
        <form class="row g-3" name="registrierung" method="post"
            action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="col-md-2">
                <label class="form-label">Anrede</label>
                <select class="col-md-6 form-control" name="anrede">
                    <option selected value="" disabled selected>Bitte wählen</option>
                    <option value="herr">Herr</option>
                    <option value="frau">Frau</option>
                    <option value="divers">Divers</option>
                </select>
            </div>
            <div class="col-md-5">
                <label class="form-label" for="vorname">Vorame</label><span class="error"> * </span>
                <input class="form-control" type="text" name="vorname" id="vorname" value="<?php echo $vname ?>">
                <span class="error">
                    <?php echo $vnameErr; ?>
            </div>
            <div class="col-md-5">
                <label class="form-label" for="nname">Nachname</label><span class="error"> * </span>
                <input class="form-control" type="text" name="nachname" id="nname" value="<?php echo $nname ?>">
                <span class="error">
                    <?php echo $nnameErr; ?>
            </div>
            <div class="col-md-8">
                <label for="inputEmail4" class="form-label">Email</label><span class="error"> * </span>
                <input type="email" class="form-control" id="inputEmail4" name="email" value="<?php echo $email ?>">
                <span class="error">
                    <?php echo $emailErr; ?>
            </div>
            <div class="col-md-4">
                <label class="form-label" for="date">Geburtsdatum</label><span class="error"> * </span>
                <input class="form-control" type="date" name="date" id="date" value="<?php echo $date ?>">
                <span class="error">
                    <?php echo $dateErr; ?>
            </div>
            <div class="col-md-6">
                <label for="ippasswort1" class="form-label">Passwort</label><span class="error"> * </span>
                <input type="password" class="form-control" name="passwort" id="inputPassword">
                <span class="error">
                    <?php echo $passErr; ?>
            </div>
            <div class="col-md-6">
                <label for="ippasswort2" class="form-label">Passwort</label><span class="error"> * </span>
                <input type="password" class="form-control" name="passwort2" id="inputPassword2">
                <span class="error">
                    <?php echo $pass2Err; ?>
            </div>
            <div class="col-9">
                <label for="inputAddress" class="form-label">Addresse</label>
                <input type="text" class="form-control" name="adress" id="inputAddress" value="<?php echo $street ?>">
                <span class="error">
                    <?php echo $streetErr; ?>
            </div>
            <div class="col-3">
                <label for="inputHsn" class="form-label">Hausnummer</label>
                <input type="number" min="1" step="1" class="form-control" name="hausnummer" id="inputAddress"
                    value="<?php echo $Hsn ?>">
                <span class="error">
                    <?php echo $HsnErr; ?>
            </div>
            <div class="col-12">
                <label for="inputAddress2" class="form-label">Adresszusatz, Türnummer etc.</label>
                <input type="text" class="form-control" name="adress2" id="inputAddress2"
                    value="<?php echo $adress2 ?>">
                <span class="error">
                    <?php echo $adress2Err; ?>
            </div>
            <div class="col-md-2">
                <label for="inputZip" class="form-label">Postleitzahl</label><span class="error"> * </span>
                <input type="number" min="00001" max="99999" step="1" class="form-control" name="plz" id="inputZip"
                    value="<?php echo $plz ?>">
                <span class="error">
                    <?php echo $plzErr; ?>
            </div>
            <div class="col-md-6">
                <label for="inputCity" class="form-label">Stadt</label><span class="error"> * </span>
                <input type="text" class="form-control" name="stadt" id="inputCity" value="<?php echo $stadt ?>">
                <span class="error">
                    <?php echo $stadtErr; ?>
            </div>
            <div class="col-md-4">
                <label for="inputState" class="form-label">Land</label><span class="error"> * </span>
                <select id="inputState" class="form-select" name="land">
                    <option selected value="" disabled selected>Bitte wählen</option>
                    <option>Österreich</option>
                    <option>Deutschand</option>
                </select>
                <span class="error">
                    <?php echo $landErr; ?>
            </div>
            <div class="col-12">
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary" name="submit">Sign in</button>
                <button type="reset" class="btn btn-primary">Reset</button>
            </div>
        </form>


        <?php
  }
    ?>

    </fieldset>
</body>
