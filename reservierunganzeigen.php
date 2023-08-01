<html>

<head>
    <title>Rerservierungen</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="stylesheet.css">
    <?php include "navbar.php" ?>
</head>

<body>
    
        <h1>Ihre Reservierungen</h1>
        
        <?php

        include "res_bearbeitung.php";
        require('dbaccess.php');
        $db_obj = new mysqli($host, $user, $password, $database);
        if ($db_obj->connect_error) {
            echo "Connection Error: " . $db_obj->connect_error;
            exit();
        }

        $usermail = $_SESSION["username"];
        $sql = "SELECT * FROM `zimmerreservierung` WHERE useremail = '$usermail'";
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
        <form name="registrierung" method="post"
            action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <form action=""<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> method="post">
<button type="submit" name="button" value= "<?php echo $resid; ?>" >Bearbeiten</button>
<button type="submit" name="delete" value= "<?php echo $resid; ?>" >Löschen</button>
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