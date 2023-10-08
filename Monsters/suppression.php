<?php
// Connexion à la base de données
$mysqli = new mysqli("localhost", "root", "", "monster");

// Vérification de la connexion
if ($mysqli->connect_error) {
    die("Échec de la connexion à la base de données : " . $mysqli->connect_error);
}

// Vérifiez si l'ID du produit a été passé dans la requête GET
if (isset($_GET['id'])) {
    // Récupérez l'ID du produit depuis la requête GET
    $productId = $_GET['id'];

    // Requête SQL pour supprimer le produit en fonction de l'ID
    $sql = "DELETE FROM produits WHERE id = $productId";

    if ($mysqli->query($sql) === TRUE) {
        // Redirigez l'utilisateur vers une autre page après la suppression réussie
        header('Location: page_admin.php'); // Redirigez vers la page d'administration ou toute autre page appropriée
        exit;
    } else {
        echo "Erreur lors de la suppression de l'enregistrement : " . $mysqli->error;
    }
} else {
    // Si l'ID du produit n'a pas été spécifié dans la requête GET, renvoyez un code d'erreur ou un message d'erreur approprié
    http_response_code(400); // Code d'erreur "Bad Request"
    echo "ID du produit non spécifié.";
}

// Fermer la connexion à la base de données
$mysqli->close();
?>
