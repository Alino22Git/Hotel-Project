<?php


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['delete'])) {
        require('dbaccess.php'); //to retrieve connection details
        $db_obj = new mysqli($host, $user, $password, $database);
        if ($db_obj->connect_error) {
            echo "Connection Error: " . $db_obj->connect_error;
            exit();
        }

        $sql = "DELETE FROM zimmerreservierung WHERE resid=$_POST[delete]";

if ($db_obj->query($sql) === TRUE) {
    ?><fieldset><?php
  echo "Reservierung erfolgreich gelöscht!";
  ?></fieldset><?php
} else {
    ?><fieldset><?php
  echo "Error deleting record: " . $db_obj->error;
  ?></fieldset><?php
}

$db_obj->close();

    } else {

        if (isset($_POST['button'])) {

            $resid = $_POST['button'];
        }
        include("resanzeigen_val.php");



        ?>
    <fieldset>
        
    <?php
            if ($error == 0) {

                if($haustier=='ja'){
                    $preis=11.99;
                }else{
                    $preis=0;
                }
        
                if($parkplatz=='ja'){
                    $preis=$preis+7.99;
                }            
                if($fruhstuck=='ja'){
                  $preis=$preis+15.99;
                }
               
                $preis= (($preis+44.50)*round(abs(strtotime($date2) - strtotime($date1)) / (60*60*24)))*$betten;
        

                require('dbaccess.php');
                $db_obj = new mysqli($host, $user, $password, $database);
                if ($db_obj->connect_error) {
                    echo "Connection Error: " . $db_obj->connect_error;
                    exit();
                }

                $sql = "UPDATE zimmerreservierung 
                SET date1 = '$date1', date2 = '$date2', personen = '$betten', fruehstueck = '$fruhstuck', parkplatz = '$parkplatz', haustiere = '$haustier', Preis='$preis'
                WHERE resid = '$resid';";
                $result = $db_obj->query($sql);


                $db_obj->close();





                echo "<h2> Ihre Informationen wurden erfolgreich geändert!</h2>";

                ?>

<?php
            } else {

                require('dbaccess.php'); //to retrieve connection details
                $db_obj = new mysqli($host, $user, $password, $database);
                if ($db_obj->connect_error) {
                    echo "Connection Error: " . $db_obj->connect_error;
                    exit();
                }

                $sql = "SELECT * FROM zimmerreservierung WHERE resid = '$resid'";
                $stmt = $db_obj->prepare($sql);
                $stmt->execute();
                $stmt->bind_result($resid, $date1, $date2, $personen, $haustier, $fruestueck, $parkplatz, $usermail, $preis,$status);
                while ($stmt->fetch()) {
                    ?>

    <html>
    <form class="row g-3 form-horizontal" name="reservierung" method="post"
            action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="col-md-12 form-group">
            
                <label class="col-md-6 form-label" for="date1">Ankunftsdatum: </label>
                <input class=" col-md-6 form-control  " type="date" name="date1" min="<?= date('Y-m-d'); ?>"  value="<?php echo $date1 ?>">
                <br>
                <span class="error">
                    <?php echo $date1Err; ?>

            </div>
            <div class="col-md-12">
                <label class="form-label col-md-6" for="date2">Abreisedatum: </label>
                <br/>
                <input class="col-md-6 form-control " type="date" name="date2" min="<?= date('Y-m-d'); ?>" value="<?php echo $date2 ?>">
                <br>
                <span class="error">
                    <?php echo $date2Err; ?>
            </div>
            <div class="col-md-12">
                <input class="col-md-6 form-control " type="number" min="1" step="1" max="7" class="form-control" name="betten"
                    id="betten" placeholder="Anzahl der Personen: "  value="<?php echo $personen ?>">
                    <br>
                <span class="error">
                    <?php echo $bettenErr; ?>
            </div>
            <div class="col-md-12">
                <lable class="form-label col-md-6">Inkl. Frühstück: *</lable>
                    <input type="radio" name="fruhstuck" value="ja">Ja
                    <input type="radio" name="fruhstuck" value="nein">Nein
                    <br>
                    <span class="error"> 
                        <?php echo $fruhstuckErr; ?></span>
            </div>
            <div class="col-md-12">
                <lable class="form-label col-md-6">Inkl. Parkplatz: *</lable>
                    <input type="radio" name="parkplatz" value="ja"> Ja
                    <input type="radio" name="parkplatz" value="nein"> Nein
                    <br>
                    <span class="error"> 
                        <?php echo $parkplatzErr; ?></span></td>
            </div>
            <div class="col-md-12">
                <lable class="form-label col-md-6">Inkl. Haustier: *</lable></th>
                    <input type="radio" name="haustier" value="ja">Ja
                    <input type="radio" name="haustier" value="nein">Nein
                    <br>
                    <span class="error"> 
                        <?php echo $haustierErr; ?></span>
            </div>
            <div class="col-12">
                
                <br>
                <button type="submit" class="btn btn-primary" id="test" name="test" value= "<?php echo $resid; ?>">Reservierung ändern</button>
                <button type="reset" class="btn btn-primary">Reset</button>
            </div>
        </form>
   
            
        </div>
    
    
    <?php
                }
                $db_obj->close();
            }

            ?>

</fieldset>
        
<?php }
}
?>