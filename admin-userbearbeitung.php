
    <?php $error = 1;
    include "val-admin-userbearbeitung.php";

 
        if ($error == 0) {
            ?>
            <fieldset>
                <?php
        
            require('dbaccess.php');
            $db_obj = new mysqli($host, $user, $password, $database);
            if ($db_obj->connect_error) {
                echo "Connection Error: " . $db_obj->connect_error;
                exit();
            }

            $sql = "UPDATE users SET vorname = '$vname' , nachname = '$nname', plz= $plz, land = '$land', stadt = '$stadt', anrede ='$anrede', aktiv='$aktiv' WHERE useremail = '$usermail';";
            $result = $db_obj->query($sql);

            if($pass!=NULL){
                $sql = "UPDATE users SET password ='$pass' WHERE useremail = '$usermail';";
                $result = $db_obj->query($sql);
    
            }


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
    <tr>
        <th>Aktivität: </th>
        <td><?php echo $aktiv; ?></td>
    </tr>
</table>
    <a href="userverwaltung.php"><button type="submit"  class="btn btn-primary">Back</button></a>
    <?php
        } else {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if (isset($_POST['button'])) {
                    $usermail = $_POST['button'];
       ?>
            <fieldset>
                <?php
            require('dbaccess.php'); //to retrieve connection details
            $db_obj = new mysqli($host, $user, $password, $database);
            if ($db_obj->connect_error) {
                echo "Connection Error: " . $db_obj->connect_error;
                exit();
            }


            $sql = "SELECT * FROM users WHERE useremail = '$usermail'";
            $stmt = $db_obj->prepare($sql);
            $stmt->execute();
            $stmt->bind_result($usermail, $nname, $vname, $pass, $anrede, $date, $stadt, $plz, $land, $aktiv);
            while ($stmt->fetch()) {
                ?>

        <html>
        
        <form class="row g-3" name="registrierung" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

            <div class="col-md-6">
                    <label class="form-label ">Anrede</label >
                    <select class="col-md-6 form-control" name="anrede"  >
                        <option selected value= "<?php echo $anrede ?>"><?php echo $anrede ?></option>
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
            </div>
            <div class="col-md-6">
                    <label class="form-label ">Aktivität</label >
                    <select class="col-md-6 form-control" name="aktiv"  >
                        <option selected value= "<?php echo $aktiv ?>"><?php echo $aktiv ?></option>
                        <option value="aktiv">aktiv</option>
                        <option value="inaktiv">inaktiv</option>
                        
                    </select>
                </div>
        
            <div class="col-12">
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary" id="submit" name="submit" value= "<?php echo $usermail; ?>">Change</button>
                </form>
                

        
        <?php
            }
            $db_obj->close();
        }
        }
    }
    ?>

    </fieldset>
</body>