<?php
// Datei und Faktor der Größenänderung


// Typ der Ausgabe


// Neue Größe berechnen hier nicht notwenig
$thumbfile = "thumbs/" . "$newname." . $imageFileType;
copy($target_file,$thumbfile);
list($width, $height) = getimagesize($thumbfile);

// schwarzen bild wird erstellt mit werten
$thumb = imagecreatetruecolor(720, 480);


// Bild laden
$source = imagecreatefromjpeg($thumbfile);


// kopieren von einem ausschnit in ein bild
imagecopyresized($thumb, $source, 0, 0, 0, 0, 720, 480, $width, $height);
imagejpeg($thumb, $thumbfile);
    
// Free up memory
imagedestroy($thumb);


// Ausgabe

?>