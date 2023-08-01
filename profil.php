<html>

<head>
    <title>Profil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="stylesheet.css">
    <?php include "navbar.php" ?>
</head>

<body>

<h1>Profil</h1>
        <fieldset>
        <?php
        require_once('dbaccess.php');
        $db_obj = new mysqli($host, $user, $password, $database);
        if ($db_obj->connect_error) {
            echo "Connection Error: " . $db_obj->connect_error;
            exit();
        }

        $usermail = $_SESSION["username"];

        $sql = "SELECT * FROM users WHERE useremail = '$usermail'";
        $stmt = $db_obj->prepare($sql);
        $stmt->execute();
        $stmt->bind_result($usermail, $vname, $nname, $pass, $anrede, $date, $stadt, $plz, $land, $aktiv);
        while ($stmt->fetch()) {
            ?>
            <table class ="table">
                <tr>
                    <th>Anrede: </th>
                    <td>
                        <?php echo $anrede; ?>
                    </td>
                </tr>
                <tr>
                    <th>Vorname </th>
                    <td>
                        <?php echo $vname; ?>
                    </td>
                </tr>
                <tr>
                    <th>Nachname: </th>
                    <td>
                        <?php echo $nname; ?>
                    </td>
                </tr>
                <tr>
                    <th>E-Mail: </th>
                    <td><?php echo $usermail; ?></td>
                </tr>
                <tr>
                    <th>Stadt: </th>
                    <td>
                        <?php echo $stadt; ?>
                    </td>
                </tr>
                <tr>
                    <th>Land: </th>
                    <td><?php echo $land; ?></td>
                </tr>
                <tr>
                    <th>PLZ: </th>
                    <td>
                        <?php echo $plz; ?>
                    </td>
                </tr>
            </table>
            <?php } ?>
        <br>
        <a href="profil_bearbeitung.php"><button type="submit">Bearbeiten</button></a>

    <fieldset>
</body>