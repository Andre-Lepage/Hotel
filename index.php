<DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf8">
    <link rel="stylesheet" href="css/main.css">
    <title>Hotel</title>
</head>

<body>
    
    <form action="includes/formhandler.inc.php" method="post">
        <h1>Ajouter une chaine d'hotel</h1>
        <label for="nom_de_chaine">Nom de chaine</label>
        <input type="text" id="nom_de_chaine" name="nom_de_chaine">
        <br>
        <label for="adresse_bureaux">Adresse bureaux</label>
        <input type="text" id="adresse_bureaux" name="adresse_bureaux">
        <br>
        <label for="nombre_hotel">Nombre d'hotel</label>
        <input type="number" id="nombre_hotel" name="nombre_hotel">
        <br>
        <label for="emails">Emails</label>
        <input type="text" id="emails" name="emails">
        <br>
        <label for="numeros_de_telephone">Numeros de telephone</label>
        <input type="text" id="numeros_de_telephone" name="numeros_de_telephone">
        <br>
        <input type="submit" value="Submit">
    </form>

    <form action="HomeClient" method="get">
        <input type="submit" value="Go to HotelPage">
    </form>
</body>
</html>