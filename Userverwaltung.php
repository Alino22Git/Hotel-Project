<html>


<head>
    <title>Userverwaltung</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="stylesheet.css">
    <?php include "navbar.php" ?>
</head>

<body>

<?php if( (isset($_SESSION['username']))&&($_SESSION['username']=="admin@hotel"))  {
            ?>
    
        <h1>Userverwaltung</h1>
      
        <?php
    
     include "admin-userbearbeitung.php";?>
   
       <?php $x = 1;?>
        
        <fieldset>
            <table class="table">
  <thead>
    <tr>
    <th scope="col">#</th>
      <th scope="col">User-E-Mail</th>
      <th scope="col">Vorname</th>
      <th scope="col">Nachname</th>
      <th scope="col">Aktivität</th>
      <th scope="col">Bearbeiten</th>
    </tr>
  </thead>
        

     <?php
        require('dbaccess.php');
        $db_obj = new mysqli($host, $user, $password, $database);
        if ($db_obj->connect_error) {
            echo "Connection Error: " . $db_obj->connect_error;
            exit();
        }

        $sql = "SELECT * FROM `users`";
        $stmt = $db_obj->prepare($sql);
        $stmt->execute();
            $stmt->bind_result($useremail, $nname, $vname, $pw, $anred, $geb, $stadt, $plz, $land, $aktiv);
            $stmt->store_result();
        if ($stmt->num_rows > 0) {
            while ($stmt->fetch()) {
                
               
                ?>

  <tbody>
    <tr>
      <th scope="row"><?php echo "$x"; ?></th>
      <td><?php echo "$useremail"; ?></td>
      <td><?php echo "$vname"; ?></td>
      <td><?php echo "$nname"; ?></td>
      <td><?php echo "$aktiv"; ?></td>
      <td><form name="userverwaltung" method="post"
            action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
<button type="submit" name="button" value= "<?php echo $useremail; ?>" >Bearbeiten</button></td>
      


    </tr>
  </tbody>
  <?php $x++;?>

    
    <?php }
    ?>
    </table>
    <?php
        }  else {?>
            <fieldset>
            Keine Reservierungen vorhanden
        </fieldset>
                <?php
        }
        ?>
        

</body>

                    <?php } ?>