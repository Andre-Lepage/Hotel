<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $adresse = $_POST["adresse"];
    $nom_de_chaine = $_POST["nom_de_chaine"];

    try{
        require_once "includes/dbh.include.php";
        $query = "SELECT * From chambre where adresse = ? and nom_de_chaine = ? ";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$adresse, $nom_de_chaine]);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $working = true;
        $pdo = null;
        $stmt = null;

        //header("Location: ../index.php");


    } catch (PDOException $e){
        die("Query failed: " . $e->getMessage());
    }
} else{
    try{
        //("Location: HomeClient.php");


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
<?php ?>

<?php
        echo "<h1>Chambres de $nom_de_chaine à $adresse</h1>";
        if($results == null ){
            
        } elseif(empty($results)){
            echo "<div>'";
            echo "<p>Aucun chambre dans cette hotel</p>";
            echo "</div";
        }else{

            echo "<table style='width:100%'>";
            echo "<tr>";
            echo "<th>numero de chambre</th>";
            echo "<th>prix</th>";
            echo "<th>commodites</th>";
            echo "<th>capacite</th>";
            echo "<th>vue</th>";
            echo "<th>etendue</th>";
            echo "<th>problemes</th>";
            echo "</tr>";

            foreach($results as $row){
                echo "</tr>";
                echo "<td>"; 
                echo htmlspecialchars($row['numero_de_chambre']);
                echo "</td>";
                echo "<td>"; 
                echo htmlspecialchars($row['prix']);
                echo "</td>";
                echo "<td>"; 
                echo htmlspecialchars($row['commodites']);
                echo "</td>";
                echo "<td>"; 
                echo htmlspecialchars($row['capacite']);
                echo "</td>";
                echo "<td>"; 
                echo htmlspecialchars($row['vue']);
                echo "</td>";
                echo "<td>"; 
                echo htmlspecialchars($row['etendue']);
                echo "</td>";
                echo "<td>"; 
                if ($row['problemes'] == null){
                    echo htmlspecialchars($row['problemes']);
                } else{
                    echo 'aucun probleme';
                }
                echo "</td>";
                echo "<td>"; 
                echo "<form action='HotelPageClient.php' method='post'>";
                echo "<input type='hidden' id='adresse' name='adresse' value='" . htmlspecialchars($row['adresse']) . "'>";
                echo "<input type='hidden' id='nom_de_chaine' name='nom_de_chaine' value='" . htmlspecialchars($row['nom_de_chaine']) . "'>";
                echo "<input type='hidden' id='numero_de_chambre' name='numero_de_chambre' value='" . htmlspecialchars($row['numero_de_chambre']) . "'>";
                echo "<input type='submit' value='view rooms'>";
                echo "</form>"; 
                echo "</td>";
            }

            echo "</table>'";
        }
        
    ?>


</body>
</html>