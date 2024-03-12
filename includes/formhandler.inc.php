<?php

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $nom_de_chaine = $_POST["nom_de_chaine"];
    $adresse_bureaux = $_POST["adresse_bureaux"];
    $nombre_hotel = $_POST["nombre_hotel"];
    $emails = $_POST["emails"];
    $numeros_de_telephone = $_POST["numeros_de_telephone"];

    try{
        require_once "dbh.include.php";
        $query = "INSERT INTO chaine_hotel (nom_de_chaine, 
        adresse_bureaux, nombre_hotel, emails, numeros_de_telephone)  
        VALUES (?, ?, ?, ?, ?)";

        $stmt = $pdo->prepare($query);

        $stmt->execute([$nom_de_chaine, $adresse_bureaux, $nombre_hotel, $emails, $numeros_de_telephone]);
    
        $pdo = null;
        $stmt = null;

        header("Location: ../index.php");

        die();

    } catch (PDOException $e){
        die("Query failed: " . $e->getMessage());
    }
} 
