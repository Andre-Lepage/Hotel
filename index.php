<DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf8">
    <link rel="stylesheet" href="css/main.css">
    <title>Hotel</title>
</head>

<body>
    <form action="includes/formhandler.inc.php" method="post">
        <label for="nom_de_chaine">Nom de chaine</label><br>
        <input type="text" id="nom_de_chaine" name="nom_de_chaine"><br>

        <label for="adresse_bureaux">Adresse bureaux</label><br>
        <input type="text" id="adresse_bureaux" name="adresse_bureaux">

        <label for="nombre_hotel">Nombre d'hotel</label><br>
        <input type="number" id="nombre_hotel" name="nombre_hotel">

        <label for="emails">Emails</label><br>
        <input type="text" id="emails" name="emails">

        <label for="numeros_de_telephone">Numeros de telephone</label><br>
        <input type="text" id="numeros_de_telephone" name="numeros_de_telephone">
        
        <input type="submit" value="Submit">
    </form>
</body>
</html>