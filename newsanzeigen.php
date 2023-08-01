<!DOCTYPE html>
<html lang="de">

<head>

    <title>News Beiträge</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="stylesheet.css">
    <?php include "navbar.php" ?>
</head>

<body>
    <h1> News Beiträge</h1>
    <?php
    require('dbaccess.php');
    $db_obj = new mysqli($host, $user, $password, $database);
    $sql = "SELECT * FROM news ORDER BY newsid DESC";
    $stmt = $db_obj->prepare($sql);
    $stmt->execute();
    $stmt->bind_result($newsid, $path, $paththumb, $title, $comment, $date);
    //...//
    while ($stmt->fetch()) { ?>




        <div class="beitrag row">


            <div class="newstitle float-left col-md-6 ">
                
                <?php
                echo "<td>" . $title . "</td>";
                ?>

            </div>
   
            <div class="float-right ">
                
                
                <?php
                echo "<td>" . $date . "</td>";
                ?>

            </div>   
            <?php
            echo "<img src=" . $paththumb . " class='rounded float-left col-md-6' 'border-radius: 12px' alt=''>";
            ?>

            <div class="float-left col-md-6 ">
                <?php

                echo "<td>" . $comment . "</td>";
                ?>
            </div>
        </div>
    <?php
    }
    $stmt->close();
    $db_obj->close();
    ?>

</body>