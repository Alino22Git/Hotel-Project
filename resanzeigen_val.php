<?php
// define variables and set to empty values
$exist = $date1 = $date2 = $betten = $fruhstuck = $parkplatz = $haustier = $preis="";
$date1Err = $date2Err = $bettenErr = $fruhstuckErr = $parkplatzErr = $haustierErr =  "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    

 if (isset($_POST['test'])) {
        $resid = $_POST['test'];
  
    $error = 0;


    if (empty($_POST["date1"])) {
        $date1Err = "Bitte geben Sie ein Anreisedatum an";
        $error = 1;
    } else {
        $date1 = test_input($_POST["date1"]);
        $_SESSION["ankDatum"] = $date1;
    }

    if (empty($_POST["date2"])) {
        $date2Err = "Bitte geben Sie ein Anreisedatum an!";
        $error = 1;
    } else {
        $date2 = test_input($_POST["date2"]);
        $_SESSION["abrDatum"] = $date2;
    }

    if (!(empty($_POST["date2"])) && (!empty($_POST["date1"]))) {
        if ($date1 >= $date2) {
            $date2Err = "Das Abreisedatum muss nach dem Anreisedatum liegen!";
            $error = 1;
        }else{
            require('dbaccess.php');
            $db_obj = new mysqli($host, $user, $password, $database);
            if ($db_obj->connect_error) {
                echo "Connection Error: " . $db_obj->connect_error;
                exit();
            }
    
            $usermail = $_SESSION["username"];
            
            $sql="SELECT * FROM `zimmerreservierung` WHERE
            `resid` != '$resid' AND (
            ('$date1' BETWEEN `date1` AND `date2`) OR 
            ('$date2' BETWEEN `date1` AND `date2`) OR
            ('$date1' <= `date1` AND '$date2' >= `date2`))";

            $stmt = $db_obj->prepare($sql);
            $stmt->execute();
                $stmt->store_result();
                if ($stmt->num_rows > 0) {
                    $date2Err = "Zimmer ist in diesem Zeitraum bereits reserviert!";
                    $error = 1;
                }
            
        }
        }


    if (empty($_POST["betten"])) {
        $bettenErr = "Bitte wählen Sie die Anzahl der Personen!";
        $error = 1;
    } else {
        $betten = test_input($_POST["betten"]);
        $_SESSION["anzPers"] = $betten;
    }

    if (empty($_POST["fruhstuck"])) {
        $fruhstuckErr = "Bitte wählen Sie ein Feld aus!";
        $error = 1;
    } else {
        $fruhstuck = test_input($_POST["fruhstuck"]);
        $_SESSION["fruhstuck"] = $fruhstuck;
    }

    if (empty($_POST["parkplatz"])) {
        $parkplatzErr = "Bitte wählen Sie ein Feld aus!";
        $error = 1;
    } else {
        $parkplatz = test_input($_POST["parkplatz"]);
        $_SESSION["parkplatz"] = $parkplatz;
    }

    if (empty($_POST["haustier"])) {
        $haustierErr = "Bitte wählen Sie ein Feld aus!";
        $error = 1;
    } else {
        $haustier = test_input($_POST["haustier"]);
        $_SESSION["haustier"] = $haustier;
    }
   
}
else {
    
    $error = 1;
}
}else {
    
    $error = 1;
}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>