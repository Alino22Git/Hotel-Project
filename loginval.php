<?php
session_start();
?>
<!DOCTYPE html>
<html lang="de">

<head>

  <title>Loginval</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  <link rel="stylesheet" href="stylesheet.css">

</head>

<body class="login_body">

  <?php include "navbar.php" ?>
  <h1>Login</h1>

  <fieldset>
    <?php
$error=0;
if (isset($_POST["usermail"]) ){
  require_once ('dbaccess.php'); //to retrieve connection details
$db_obj = new mysqli($host, $user, $password, $database);
if ($db_obj->connect_error) {
echo "Connection Error: " . $db_obj->connect_error;
exit();
}

  $password=$_POST["password"];
  $usermail = $_POST["usermail"];


  $sql = "SELECT useremail, vorname, aktiv, password FROM users WHERE useremail = '$usermail' ";
  $result = $db_obj->query($sql);

      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          $usermail = $row["useremail"];
          $vorname = $row["vorname"];
          $aktiv = $row["aktiv"];

          if (password_verify($password, $row['password'])) {
                    if ($aktiv == 'aktiv') {
                        $_SESSION["username"] = $usermail;
                        $_SESSION["vorname"] = $vorname;
                        $error = 1;
                        header("Refresh:0");
                    }
                    else{echo"Ihr Userprofil ist leider nicht mehr aktiv, bitte kontaktieren Sie den/die Administrator*in!";}

        }else{
          echo" E-Mailadresse und Passwort stimmen nicht überein.";

        }
      }
    }

else{
  echo" E-Mailadresse und Passwort stimmen nicht überein.";
}
}

if( isset($_SESSION['username']))  {
 
  echo"Hallo ". $_SESSION["vorname"]; 
  echo", Sie sind jetzt eingeloggt!";
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>
  </fieldset>
</body>