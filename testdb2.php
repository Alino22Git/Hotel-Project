<?php require_once ('dbaccess.php');
    $db_obj = new mysqli($host, $user, $password, $database);
    if ($db_obj->connect_error) {
    echo "Connection Error: " . $db_obj->connect_error;
    exit();
    }



            $sql = "INSERT INTO test (`test`)
     VALUES (89);";
     $result = $db_obj->query($sql);
    

    //$sql = "UPDATE users SET vorname = '$vname' WHERE useremail = '$usermail'";
    $db_obj->close();
    ?>