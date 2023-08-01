<!DOCTYPE html>
<html lang="de">

<head>

    <title>Profil-Bearbeitung</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="stylesheet.css">
    <?php include "navbar.php";?>
</head>

<body>
    <h1>Profil</h1>
    
    <?php
  include "valprofil_bearbeitung.php" ?>
    <fieldset>
        <?php
  if ($error == 0) {

    require ('dbaccess.php');
    $db_obj = new mysqli($host, $user, $password, $database);
    if ($db_obj->connect_error) {
    echo "Connection Error: " . $db_obj->connect_error;
    exit();
    }

    $usermail = $_SESSION["username"];
    $sql = "UPDATE users SET vorname = '$vname' , nachname = '$nname', plz= $plz, password = '$pass', land = '$land', stadt = '$stadt', anrede ='$anrede' WHERE useremail = '$usermail';";
    $result = $db_obj->query($sql);
              

    $db_obj->close();

    

    

    echo "<h2> Ihre Informationen wurden erfolgreich geändert!</h2>";
    echo "Ihre Daten lauten: ";
    ?>
    <table class = "table">
    <tr>
        <th>Anrede: </th>
        <td>
            <?php echo $anrede; ?>
        </td>
    </tr>
    <tr>
        <th>Vorname </th>
        <td>
            <?php echo $vname; ?>
        </td>
    </tr>
    <tr>
        <th>Nachname: </th>
        <td>
            <?php echo $nname; ?>
        </td>
    </tr>
    <tr>
        <th>E-Mail: </th>
        <td><?php echo $usermail; ?></td>
    </tr>
    <tr>
        <th>Stadt: </th>
        <td>
            <?php echo $stadt; ?>
        </td>
    </tr>
    <tr>
        <th>Land: </th>
        <td><?php echo $land; ?></td>
    </tr>
    <tr>
        <th>PLZ: </th>
        <td>
            <?php echo $plz; ?>
        </td>
        </td>
    </tr>
</table>
    <a href="profil.php"><button type="submit"  class="btn btn-primary">Back</button></a>
    <?php
        } else {
            
            require ('dbaccess.php'); //to retrieve connection details
            $db_obj = new mysqli($host, $user, $password, $database);
            if ($db_obj->connect_error) {
            echo "Connection Error: " . $db_obj->connect_error;
            exit();
            }
        
            $usermail = $_SESSION["username"];

            $sql = "SELECT * FROM users WHERE useremail = '$usermail'";
            $stmt = $db_obj->prepare($sql);
            $stmt->execute();
            $stmt->bind_result($usermail, $nname, $vname, $pass, $anrede, $date, $stadt, $plz, $land, $aktiv);
            while ($stmt->fetch()) {
                ?>

        <html>
        
        <form class="row g-3" name="registrierung" method="post"
            action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

            <div class="col-md-12">
                    <label class="form-label ">Anrede</label >
                    <select class="col-md-6 form-control" name="anrede"  >
                        <option selected value= "<?php echo $anrede?>"><?php echo $anrede?></option>
                        <option value="herr">Herr</option>
                        <option value="frau">Frau</option>
                        <option value="divers">Divers</option>
                    </select>
                </div>
            
            <div class="col-md-6">
                <label class="form-label" for="vorname">Vorname</label><span class="error"></span>
                <input class="form-control" type="text" name="vorname" id="vorname" value="<?php echo $vname ?>">
                <span class="error">
                    <?php echo $vnameErr; ?>
            </div>
            <div class="col-md-6">
                <label class="form-label" for="nname">Nachname</label><span class="error"></span>
                <input class="form-control" type="text" name="nachname" id="nname" value="<?php echo $nname ?>">
                <span class="error">
                    <?php echo $nnameErr; ?>
            </div>
            <!-- <div class="col-md-6">
                <label for="inputEmail4" class="form-label">Email</label><span class="error"></span>
                <input type="email" class="form-control" id="inputEmail4" name="email" value="<?php echo $usermail ?>">
                <span class="error">
                    <?php echo $emailErr; ?>  
            </div> -->
            <div class="col-md-6">
                <label class="form-label" for="stadt">Stadt</label><span class="error"></span>
                <input class="form-control" type="text" name="stadt" id="stadt" value="<?php echo $stadt ?>">
                <span class="error">
                    <?php echo $stadtErr; ?>
            </div>
            <div class="col-md-6">
                <label class="form-label" for="stadt">PLZ</label><span class="error"></span>
                <input class="form-control" type="text" name="plz" id="plz" value="<?php echo $plz ?>">
                <span class="error">
                    <?php echo $plzErr; ?>
            </div>
            <div class="col-md-6">
                <label class="form-label" for="land">Land</label><span class="error"></span>
                <input class="form-control" type="text" name="land" id="land" value="<?php echo $land ?>">
                <span class="error">
                    <?php echo $landErr; ?>
            </div>
            
            <div class="col-md-6">
                <label for="ippasswort1" class="form-label">Altes Passwort</label><span class="error"></span>
                <input type="password" class="form-control" name="alt_passwort" id="inputPassword">
                <span class="error">
                    <?php echo $altpassErr; ?>
            </div> 
            <div class="col-md-6">
                <label for="ippasswort1" class="form-label">Neues Passwort</label><span class="error"></span>
                <input type="password" class="form-control" name="passwort" id="inputPassword">
                <span class="error">
                    <?php echo $passErr; ?>
            </div>
            <div class="col-md-6">
                <label for="ippasswort2" class="form-label">Wiederholen des Passwortes</label><span class="error"></span>
                <input type="password" class="form-control" name="passwort2" id="inputPassword2">
                <span class="error">
                    <?php echo $pass2Err; ?>
            </div>
            
            <div class="col-12">
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary" name="submit">Change</button>
                </form>
                
            </div>
        
        
        <?php
            }
            $db_obj->close();
        }
    ?>

    </fieldset>
</body>