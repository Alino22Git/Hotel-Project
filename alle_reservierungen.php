<html>

<head>
    <title>Rerservierungen</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="stylesheet.css">
    <?php include "navbar.php" ?>
</head>

<body>
    
        <h1>Alle Reservierungen</h1>
        <fieldset>
        <h2>Filter nach Status:</h1>
        
        
        <form action=""<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> method="post">
<button type="submit" name="status" value= "neu" >neu</button>
<button type="submit" name="status" value= "storniert" >storniert</button>
<button type="submit" name="status" value= "bestätigt" >bestätigt</button>
</form>
        </fieldset>
        <?php

        //include "res_bearbeitung.php";
        require('dbaccess.php');
        $db_obj = new mysqli($host, $user, $password, $database);
        if ($db_obj->connect_error) {
            echo "Connection Error: " . $db_obj->connect_error;
            exit();
        }

        $usermail = $_SESSION["username"];
       
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $status_pruf=$_POST["status"];
        }else{
            $status_pruf="";
        }
        if($status_pruf!=""){
        $sql = "SELECT * FROM `zimmerreservierung` WHERE status = '$status_pruf'";
        }else{
            $sql = "SELECT * FROM `zimmerreservierung`";  
        }
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
            </table>
            
        <form name="registrierung" method="post" action="detailansicht.php">
        
<button type="submit" name="detailID" value= "<?php echo $resid; ?>" >Anzeigen</button>
</form>
        </fieldset>
    
    <?php }
        } else {?>
            <fieldset>
            Keine Reservierungen vorhanden
        </fieldset>
                <?php
        }
        ?>
        

</body>