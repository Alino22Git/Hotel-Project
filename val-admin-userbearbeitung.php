<?php
// define variables and set to empty values

$altpassErr = $nnameErr = $vnameErr = $emailErr = $dateErr = $passErr = $streetErr = $HsnErr = $adress2Err = $plzErr = $landErr = $stadtErr = $pass2Err = "";

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
 
    if (isset($_POST['submit'])) {
        $usermail = $_POST['submit'];

       
        $error = 0;

        $vname = $nname = $email = $adress = $date = $pass = $street = $adress2 = $plz = $stadt = $land = $anrede = $pass2 = "";



        if (empty($_POST["vorname"])) {
            $vnameErr = "Bitte geben Sie Ihren Benutzernamen ein";
            $error = 1;
        } else {
            $vname = test_input($_POST["vorname"]);
            // check if name only contains letters and whitespace
            if (!preg_match("/^[a-zA-Z-' ]*$/", $vname)) {
                $vnameErr = "Nur Buchstaben erlaubt";
                $error = 1;
            }
        }

        if (empty($_POST["nachname"])) {
            $nnameErr = "Bitte geben Sie Ihren Nachnamen ein";
            $error = 1;
        } else {
            $nname = test_input($_POST["nachname"]);
            // check if name only contains letters and whitespace
            if (!preg_match("/^[a-zA-Z-' ]*$/", $nname)) {
                $nnameErr = "Nur Buchstaben erlaubt";
                $error = 1;
            }
        }

        if (!empty($_POST["anrede"])) {
            $anrede = test_input($_POST["anrede"]);
        }

        if (!empty($_POST["aktiv"])) {
            $aktiv = test_input($_POST["aktiv"]);
        }
        if (empty($_POST["plz"])) {
            $plzErr = "Bitte PLZ wählen";
            $error = 1;
        } else {
            $plz = test_input($_POST["plz"]);
            if (!preg_match("/^[0-9]*$/", $plz)) {
                $plzErr = "Nur Zahlen erlaubt";
                $error = 1;
            }
        }
        if (empty($_POST["stadt"])) {
            $stadtErr = "Bitte geben Sie eine Stadt an";
            $error = 1;
        } else {
            $stadt = test_input($_POST["stadt"]);
            // check if name only contains letters and whitespace
            if (!preg_match("/^[a-zA-Z-' ]*$/", $stadt)) {
                $stadtErr = "Nur Buchstaben erlaubt";
                $error = 1;
            }
        }
        if (empty($_POST["land"])) {
            $landErr = "wählen Sie ein Land";
            $error = 1;
        } else {
            $land = test_input($_POST["land"]);
        }
        /*
        if (empty($_POST["date"])) {
        $dateErr = "Bitte geben Sie Ihr Geburtadatum an";
        $error=1;
        }
        */

        //wenn beide nivht leer    $sql = "UPDATE users SET vorname = '$vname' , nachname = '$nname', plz= $plz, land = '$land', stadt = '$stadt', anrede ='$anrede' WHERE useremail = '$usermail';";
        $pass = NULL;
        if ((!empty($_POST["passwort"])) && !(empty($_POST["passwort2"]))) {
            

            $pass1 = test_input($_POST["passwort"]);
            $pass2 = test_input($_POST["passwort"]);
            //wenn nicht nur buchstaben und zahlen
            if ((!preg_match("/^[a-zA-Z-'0-9]*$/", $pass1)) || (!preg_match("/^[a-zA-Z-'0-9]*$/", $pass2))) {
                $passErr = "Nur Buchstaben und Zahlen erlaubt";
                $error = 1;
            }
            //wenn in neuen felden etwas steht das nur buchstaben und zahlen enthält
            else {
                if (($_POST["passwort"]) != ($_POST["passwort2"])) {
                    $passErr = "Passwörter stimmen nicht überein";
                    $error = 1;

                } else { //wenn neue passwörter übereinstimmen
                    $pass=password_hash(test_input($pass1), PASSWORD_DEFAULT);
                    
                }


            }
            
        }
 
   
    } else {
        $error = 1;}

    }

 
    

?>