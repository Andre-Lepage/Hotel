<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $zone = $_POST["zone"];

    try{
        require_once "include/dbh.include.php";
        $query = "Select * From hotel where zone = ?";

        $stmt = $pdo->prepare($query);

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
        require_once "include/dbh.include.php";
        $query = "Select * From hotel";

        $stmt = $pdo->prepare($query);

        $stmt->execute([]);

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        $pdo = null;
        $stmt = null;

        //header("Location: ../index.php");


    } catch (PDOException $e){
        die("Query failed: " . $e->getMessage());
    };
}
?>


<DOCTYPE html>
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
                echo "<td>" + $row["nom_de_chaine"] +"</td>";
                echo "<td>" + $row["adresse"] +"</td>";
                echo "<td>" + $row["nombre_de_chambre"] +"</td>";
                echo "<td>" + $row["zone"] +"</td>";
                echo "<td>" + $row["classe"] +"</td>";
                echo "</tr>";
            }

            echo "</table>'";
        }
        
    ?>
    
    
</body>
</html>