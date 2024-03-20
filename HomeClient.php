<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $zone = $_POST["zone"];

    try{
        require_once "includes/dbh.include.php";
        $query = "SELECT * From hotel where zone = ? ";

        $stmt = $pdo->prepare($query);

        //$stmt ->bindParam(":zone", $zone);

        $stmt->execute([$zone]);

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        $pdo = null;
        $stmt = null;

        //header("Location: ../index.php");


    } catch (PDOException $e){
        die("Query failed: " . $e->getMessage());
    }
} else{
    try{
        require_once "includes/dbh.include.php";
        $query = "SELECT * From hotel";

        $stmt = $pdo->prepare($query);
        
        $stmt->execute();

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        $pdo = null;
        $stmt = null;

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

    <?php
        if(empty($results)){
            echo "<div>";
            echo "<p> No Hotels in that zone </p>";
            echo "</div>";
        } else{

            echo "<table style='width:100%>'";
            echo "<tr>";
            echo "<th>Chaine hotel</th>";
            echo "<th>adresse</th>";
            echo "<th>nombre de chambre</th>";
            echo "<th>Zone</th>";
            echo "<th>classe</th>";
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
            }

            echo "</table>'";
        }
        
    ?>
    
    
</body>
</html>