<!DOCTYPE html>
<html lang="de">

<head>

    <title>Formular zur Reservierung</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="stylesheet.css">
    <?php include "navbar.php" ?>
</head>

<body>
    <h1>Zimmerreservierung</h1>
    <fieldset class="login">
    <?php if (isset($_SESSION['username'])) {
      include "resval.php";
      

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

        require ('dbaccess.php'); //to retrieve connection details
        $db_obj = new mysqli($host, $user, $password, $database);
        if ($db_obj->connect_error) {
        echo "Connection Error: " . $db_obj->connect_error;
        exit();
        }

        $userid = $_SESSION["username"];
        $status="neu";
        $sql = "INSERT INTO `zimmerreservierung` ( `date1`, `date2`, `personen`, `haustiere`, `fruehstueck`, `parkplatz`, `useremail`,`Preis`,`Status`) 
        VALUES ('$date1', '$date2', '$betten', '$haustier', '$fruhstuck', '$parkplatz', '$userid','$preis', '$status');";
        $result = $db_obj->query($sql);
    
    
        echo "<h2> Vielen Dank für Ihre Reservierung!</h2>";
        echo " ";
        echo "<br>";
        echo "<p>Um ihre Reservierungen einsehen zu können, klicken Sie <a href='reservierunganzeigen.php'>hier</a></p>";
    
      } else {
      ?>
    
        <form class="row g-3" name="reservierung" method="post"
            action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="col-md-12">
                <label class="form-label col-md-6" for="date1">Ankunftsdatum: </label>
                <br/>
                <input class="col-md-6" type="date" name="date1" min="<?= date('Y-m-d'); ?>">
                <br>
                <span class="error">
                    <?php echo $date1Err; ?>
            </div>
            <div class="col-md-12">
                <label class="form-label col-md-6" for="date2">Abreisedatum: </label>
                <br/>
                <input class="col-md-6" type="date" name="date2" min="<?= date('Y-m-d'); ?>">
                <br>
                <span class="error">
                    <?php echo $date2Err; ?>
            </div>
            <div class="col-md-12">
                <input class="col-md-6" type="number" min="1" step="1" max="7" class="form-control" name="betten"
                    id="betten" placeholder="Anzahl der Personen: ">
                    <br>
                <span class="error">
                    <?php echo $bettenErr; ?>
            </div>
            <div class="col-md-12">
                <lable>Inkl. Frühstück: *</lable>
                    <input type="radio" name="fruhstuck" value="ja">Ja
                    <input type="radio" name="fruhstuck" value="nein">Nein
                    <br>
                    <span class="error"> 
                        <?php echo $fruhstuckErr;?></span>
            </div>
            <div class="col-md-12">
                <lable>Inkl. Parkplatz: *</lable>
                    <input type="radio" name="parkplatz" value="ja"> Ja
                    <input type="radio" name="parkplatz" value="nein"> Nein
                    <br>
                    <span class="error"> 
                        <?php echo $parkplatzErr;?></span></td>
            </div>
            <div class="col-md-12">
                <lable>Inkl. Haustier: *</lable></th>
                    <input type="radio" name="haustier" value="ja">Ja
                    <input type="radio" name="haustier" value="nein">Nein
                    <br>
                    <span class="error"> 
                        <?php echo $haustierErr;?></span>
            </div>
            <div class="col-12">
                
                <br>
                <button type="submit" class="btn btn-primary" name="submit">Reservieren</button>
                <button type="reset" class="btn btn-primary">Reset</button>
            </div>
        </form>
      
        <?php 
       }
    }else{  ?>
      <div> Bitte loggen Sie sich ein </div>
      <?php } ?>
        <fieldset>
            



</body>