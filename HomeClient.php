<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $zone = $_POST["zone"];

    try{
        require_once "includes/dbh.include.php";
        $query = "SELECT * From hotel where zone = ? ";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$zone]);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $choicesQuery = "SELECT Distinct zone From hotel";
        $stmt = $pdo->prepare($choicesQuery);
        $stmt->execute();
        $choicesResults = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $roomsAvailableQuery = "SELECT zone, sum(nombre_de_chambre) From hotel Group by zone";
        $stmt = $pdo->prepare($roomsAvailableQuery);
        $stmt->execute();
        $roomsAvailableresults = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        $pdo = null;
        $stmt = null;

        //header("Location: ../index.php");


    } catch (PDOException $e){
        die("Query failed: " . $e->getMessage());
    }
} else{
    try{
        require_once "includes/dbh.include.php";
        //$query = "SELECT * From hotel";

        //$stmt = $pdo->prepare($query);
        
       // $stmt->execute();

        //$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $choicesQuery = "SELECT Distinct zone From hotel";

        $stmt = $pdo->prepare($choicesQuery);
        
        $stmt->execute();

        $choicesResults = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $roomsAvailableQuery = "SELECT zone, sum(nombre_de_chambre) From hotel Group by zone";
        $stmt = $pdo->prepare($roomsAvailableQuery);
        $stmt->execute();
        $roomsAvailableresults = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        $pdo = null;
        $stmt = null;
        $results = null;

        

        //header("Location: ../index.php");


    } catch (PDOException $e){
        die("Query failed: " . $e->getMessage());
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf8">
    <link rel="stylesheet" href="css/main.css">
    <title>Hotel</title>
</head>

<body>

    
    <h1>Chercher les Hotels par zone</h1>

    <h3>chambres disponible par zone</h3>
    <p>
    <?php
    echo "<table style='width:100%'>";
    echo "<tr>";
    foreach($roomsAvailableresults as $row){
        echo "<th>";
        echo $row["zone"];
        echo "</th>";
    }
    echo "<tr>";

    echo "<tr>";
    foreach($roomsAvailableresults as $row){
        echo "<td>";
        echo $row["sum(nombre_de_chambre)"];
        echo "</td>";
    }
    echo "<tr>";
    echo "</table>'";
        
    
    
    
    ?>
    </p>

    <form action="HomeClient.php" method="post">
    <label for="zone">Choisis la zone où vous voulez rester</label>
    <select name="zone" id="zone">
    <?php
    foreach($choicesResults as $row){
        echo "<option value='";
        echo $row["zone"];
        echo "'>";
        echo $row["zone"];
        echo "</option>";
    }

    ?>
    </select>
    <input type="submit" value="Submit">
    </form>
    <br>
    <br>
    <?php
        if($results == null ){
            
        } elseif(empty($results)){
            echo "<div>'";
            echo "<p> aucun hotel disponible dans cette zone</p>";
            echo "</div";
        }else{
            echo "<p> Hotels disponible à: $zone </p> <br>";

            echo "<table style='width:100%'>";
            echo "<tr>";
            echo "<th>Chaine hotel</th>";
            echo "<th>adresse</th>";
            echo "<th>nombre de chambre</th>";
            echo "<th>Zone</th>";
            echo "<th>classe</th>";
            echo "<th>View rooms</th>";
            echo "</tr>";

            foreach($results as $row){
                echo "</tr>";
                echo "<td>"; 
                echo htmlspecialchars($row['nom_de_chaine']);
                echo "</td>";
                echo "<td>"; 
                echo htmlspecialchars($row['adresse']);
                echo "</td>";
                echo "<td>"; 
                echo htmlspecialchars($row['nombre_de_chambre']);
                echo "</td>";
                echo "<td>"; 
                echo htmlspecialchars($row['zone']);
                echo "</td>";
                echo "<td>"; 
                echo htmlspecialchars($row['classe']);
                echo "</td>";
                echo "<td>"; 
                echo "<form action='HotelPageClient.php' method='post'>";
                echo "<input type='hidden' id='adresse' name='adresse' value='" . htmlspecialchars($row['adresse']) . "'>";
                echo "<input type='hidden' id='nom_de_chaine' name='nom_de_chaine' value='" . htmlspecialchars($row['nom_de_chaine']) . "'>";
                echo "<input type='submit' value='view rooms'>";
                echo "</form>"; 
                echo "</td>";
            }

            echo "</table>'";
        }
        
    ?>
    
    
</body>
</html>