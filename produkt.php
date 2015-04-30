<?php

//Ta emot id för den produkt som skall visas
$produktid = $_GET["produktid"];
//Variabler för databaskoppling
$dbhost     = "localhost";
$dbname     = "clasimdb";
$dbuser     = "root";
$dbpass     = "";
//Koppla till databasen
$DBH = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
// Välj felhantering (här felsökningsläge)
$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );

// Förbered databasfråga med placeholders (markerade med : i början)
$STH = $DBH->prepare("SELECT * FROM tbl_produkter WHERE id = :id");

//koppla placeholdet med ett variabelvärde.
$STH->bindParam(":id", $produktid);

//utför datafrågan
$STH->execute();

//stäng sbkoppling
$DBH = null;

//hämta värden
$result = $STH->fetch()

?>

<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
    <h1><?php echo $result["titel"];?> <?php echo $result["pris"];?> kr</h1>

    <?php echo $result["beskrivning"];?>

   <h2>antal i lager <?php echo $result["lagersaldo"];?></h2>

    <img src="<?php echo $result["bildfil"];?>">
</body>
</html>