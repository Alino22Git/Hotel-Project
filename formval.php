<?php
// define variables and set to empty values
$nnameErr = $vnameErr = $emailErr = $dateErr  = $passErr = $streetErr = $HsnErr =  $adress2Err = $plzErr = $landErr = $stadtErr = $pass2Err="";
$vname = $nname =$email = $adress = $date= $pass = $street =  $adress2 = $plz = $stadt = $land = $anrede=$pass2 ="";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $error=0;

if (!empty($_POST["anrede"])) {
    $anrede = test_input($_POST["anrede"]);
}
    
    

  if (empty($_POST["vorname"])) {
    $vnameErr = "Bitte geben Sie Ihren Vornamen ein";
    $error=1;
  } else {
    $vname = test_input($_POST["vorname"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z-' ]*$/",$vname)) {
      $vnameErr = "Nur Buchstaben erlaubt";
      $error=1;
    }
  }

  if (empty($_POST["nachname"])) {
    $nnameErr = "Bitte geben Sie Ihren Nachnamen ein";
    $error=1;
  } else {
    $nname = test_input($_POST["nachname"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z-' ]*$/",$nname)) {
      $nnameErr = "Nur Buchstaben erlaubt";
      $error=1;
    }
  }
  
  if (empty($_POST["email"])) {
    $emailErr = "Bitte geben Sie Ihre E-Mail Adresse ein!";
    $error=1;
  } else {
    $email = test_input($_POST["email"]);
    // check if e-mail address is well-formed
    //email schon vorhanden?
    require_once ('dbaccess.php'); //to retrieve connection details
    $db_obj = new mysqli($host, $user, $password, $database);
    if ($db_obj->connect_error) {
    echo "Connection Error: " . $db_obj->connect_error;
    exit();
    }
    $sql = "SELECT * FROM users where useremail='$email'" ;
    $result = $db_obj->query($sql);
  
      if ($result->num_rows > 0) {
          $emailErr = "Emailadresse existiert bereits";
      $error=1;}
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "ungültiges Format";
      $error=1;
    }
  }

 
  if (empty($_POST["date"])) {
    $dateErr = "Bitte geben Sie Ihr Geburtadatum an";
    $error=1;
    }
    else{$date = test_input($_POST["date"]);}


  if (empty($_POST["passwort"])) {
    $passErr = "Bitte geben Sie ein Passwort an";
    $error=1;
  } else {
    $pass = test_input($_POST["passwort"]);
    if (!preg_match("/^[a-zA-Z-'0-9]*$/",$pass)) {
        $passErr = "Nur Buchstaben und Zahlen erlaubt";
        $error=1;
      }
      $pass=password_hash(test_input($_POST["passwort"]), PASSWORD_DEFAULT);
  }

  if (empty($_POST["passwort2"])) {
    $pass2Err = "Bitte geben Sie ein Passwort an";
    $error=1;
  }
   else if (($_POST["passwort2"])!== ($_POST["passwort"])) { $pass2Err="Passwörter stimmen nicht überein";
    $error=1;}
    

    $street = test_input($_POST["adress"]);
    if (!preg_match("/^[a-zA-Z-'0-9]*$/",$street)) {
      $streetErr = "Nur Buchstaben und Zahlen erlaubt";
      $error=1;
    }

    $Hsn = test_input($_POST["hausnummer"]);
    if (!preg_match("/^[a-zA-Z-'0-9]*$/",$Hsn)) {
      $HsnErr = "Nur Buchstaben und Zahlen erlaubt";
      $error=1;
    }

    $adress2 = test_input($_POST["adress2"]);
    if (!preg_match("/^[a-zA-Z-'0-9]*$/",$adress2)) {
      $adress2Err = "Nur Buchstaben und Zahlen erlaubt";
      $error=1;
    }

  if (empty($_POST["plz"])) {
    $plzErr = "Bitte PLZ wählen";
    $error=1;
  } else {
    $plz = test_input($_POST["plz"]);
    if (!preg_match("/^[0-9]*$/",$plz)) {
        $plzErr = "Nur Zahlen erlaubt";
        $error=1;
      }
  }
  if (empty($_POST["stadt"])) {
    $stadtErr = "Bitte geben Sie eine Stadt an";
    $error=1;
  } else {
    $stadt = test_input($_POST["stadt"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z-' ]*$/",$stadt)) {
        $stadtErr = "Nur Buchstaben erlaubt";
        $error=1;
    }
  }
  if (empty($_POST["land"])) {
    $landErr = "wählen Sie ein Land";
    $error=1;
  } else {
    $land = test_input($_POST["land"]);
  }
  
}
else {
    $error=1;
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>