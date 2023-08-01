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
    <h1>News Beiträge</h1>
    <fieldset>
        <form class="row g-3" method="post" enctype="multipart/form-data">
        <div class="col-md-12 col-sm-12 form-group">
        <label for="title">Titel*</label>
        <input class="form-control"  type="text" name="title" required ></input>
      </div>
            <div class="col-md-12">
                <label  class="form-label" for="myfile">Wähle ein Bild aus, das du mit uns teilen willst.</label>
                <input class="form-control"  type="file" name="fileToUpload" id="fileToUpload">
            </div>
            <div class="col-md-12">
            <label class="form-label"  for="Comment">News Beitrag</label>
            <textarea class="form-control"  name="comment" rows="5" cols="40"></textarea>
            </div>
            <div class="col-md-12">
                <input  class="form-control"  type="submit" value="Newsbeitrag abschicken" name="submit" accept=".jpeg, .JPEG">
            </div>
        
            <div class="col-md-12">

<?php include "upload.php" ?>
    </div>
        </form>

    </fieldset>
</body>

</html>