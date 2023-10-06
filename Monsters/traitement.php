<?php
// Connexion à la base de données
$mysqli = new mysqli("localhost", "root", "", "monsters");

// Vérification de la connexion
if ($mysqli->connect_error) {
    die("Échec de la connexion à la base de données : " . $mysqli->connect_error);
}

// Récupération des données du formulaire
$nom = $_POST['nom'];
$prix = $_POST['prix'];
$description = $_POST['description'];
$categorie = $_POST['categorie'];
$img = $_POST['img'];
// Requête SQL pour ajouter les données à la base de données
$sql = "INSERT INTO produits (nom, prix, description, categorie, img) VALUES ('$nom', '$prix','$description','$categorie','./produit_img/$img')";

if ($mysqli->query($sql) === TRUE) {
    header('location: ./page_admin.php');
} else {
    echo "Erreur lors de l'ajout de l'enregistrement : " . $mysqli->error;
}

// Fermer la connexion à la base de données
$mysqli->close();
?>
