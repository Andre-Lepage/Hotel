<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $zone = $_POST["zone"];

    try{
        require_once "includes/dbh.include.php";
        $query = "SELECT * From hotel where zone = ? ";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$zone]);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $choicesQuery = "SELECT Unique zone From hotel";
        $stmt = $pdo->prepare($choicesQuery);
        $stmt->execute();
        $choicesResults = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $roomsAvailableQuery = "SELECT count(*) From chambre where zone = ? ";
        $stmt = $pdo->prepare($roomsAvailableQuery);
        $stmt->execute([$zone]);
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

    
    <h1> Chambres disponible par zone</h1>

    <p>
    <?php
    if($results == null ){
            
    } else{
        foreach($choicesResults as $row){
            echo "Nombre de chambre disponible dans $zone: ";
            echo $row["count"];
        }
    }
    
        
    ?>
    </p>

    <form action="HomeClient.php" method="post">
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

    <?php
        if($results == null ){
            
        } elseif(empty($results)){
            echo "<div>'";
            echo "<p> no hotels in this zone</p>";
            echo "</div";
        }else{

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
                echo "<form action='processupload.php?adresse=";
                echo htmlspecialchars($row['adresse']);
                echo "?nom_de_chaine=";
                echo htmlspecialchars($row['nom_de_chaine']);
                echo  "' method='post' enctype='multipart/form-data' id='MyUploadForm'>";
                echo htmlspecialchars($row['classe']);
                echo "</td>";
            }

            echo "</table>'";
        }
        
    ?>
    
    
</body>
</html>