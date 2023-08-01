<html>

<head>
    <title>Rerservierungen</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="stylesheet.css">
    <?php include "navbar.php" ?>
</head>

<body>
    
        <h1>Detailansicht der Reservierung</h1>
        
        <?php

        //include "res_bearbeitung.php";
        require('dbaccess.php');
        $db_obj = new mysqli($host, $user, $password, $database);
        if ($db_obj->connect_error) {
            echo "Connection Error: " . $db_obj->connect_error;
            exit();
        }
        if (!empty($_POST["ändern"])) {
            $status_aendern=$_POST["ändern"];

            $sql = "UPDATE `zimmerreservierung`
                    SET Status = '$status_aendern'
                    WHERE resid = '$_POST[id]';";
             $stmt = $db_obj->prepare($sql);
             $stmt->execute();
             ?>
             <fieldset>
             <?php
             if($status_aendern=="neu"){
                echo "<h3> Der Status wurde auf neu zurückgesetzt!</h3>";
             }else{
                echo "<h3> Die Reservierung wurde $status_aendern!</h3>";
             }
             ?>
            
             </fieldset>
             <?php
        }else{
          
        $usermail = $_SESSION["username"];
    
        $sql = "SELECT * FROM `zimmerreservierung` WHERE resid = '$_POST[detailID]'";
        $stmt = $db_obj->prepare($sql);
        $stmt->execute();
            $stmt->bind_result($resid, $date1, $date2, $personen, $haustier, $fruestueck, $parkplatz, $usermail,$preis,$status);
            $stmt->store_result();
        if ($stmt->num_rows > 0) {
            while ($stmt->fetch()) {
               
                ?>
            <fieldset>
            <table class = "table">
            <tr>
                <th>Reservierungs-ID: </th>
                <td><?php echo "$resid"; ?></td>
            </tr>
            <tr>
                <th>Usermail: </th>
                <td><?php echo $usermail; ?></td>
            </tr>
            <tr>
                <th>Ankunftsdatum: </th>
                <td><?php echo "$date1"; ?></td>
            </tr>
            <tr>
                <th>Abreisedatum: </th>
                <td><?php echo $date2; ?></td>
            </tr>
            <tr>
                <th>Anzahl Tage: </th>
                <td><?php echo round(abs(strtotime($date2) - strtotime($date1)) / (60*60*24)); ?></td>
            </tr>
           
            <tr>
                <th>Anzahl der Personen: </th>
                <td><?php echo $personen ?></td>
            </tr>
            <tr>
                <th>Frühstück: </th>
                <td><?php echo $fruestueck; ?></td>
            </tr>
            <tr>
                <th>Parkplätze: </th>
                <td><?php echo $parkplatz; ?></td>
            </tr>  
            <tr>
                <th>Haustiere: </th>
                <td><?php echo $haustier; ?></td>
            </tr>
            <tr>
                <th>Preis: </th>
                <td><?php echo $preis; ?></td>
            </tr> 
            <tr>
                <th>Status: </th>
                <td><?php echo $status; ?></td>
            </tr> 
            </table>
            
        <br>
        </fieldset>
        <fieldset>
        <h2>Status ändern:</h1>
        
        
        <form action=""<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> method="post">
<button type="submit" name="ändern" value= "neu" >neu</button>
<button type="submit" name="ändern" value= "storniert" >storniert</button>
<button type="submit" name="ändern" value= "bestätigt" >bestätigt</button>
<input name="id" type="hidden" value="<?= $resid ?>">
</form>
        </fieldset>
        
    
    <?php }
        } else {?>
            <fieldset>
            Keine Reservierungen vorhanden
        </fieldset>
                <?php
        }
        
    }
        ?>
        

</body>