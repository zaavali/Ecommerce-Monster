<?php
// Assurez-vous que l'ID du produit est présent dans la requête GET
if (isset($_GET['id'])) {
    // Récupérez l'ID du produit depuis la requête GET
    $productId = $_GET['id'];

    // Connexion à la base de données
    $conn = new mysqli("localhost", "root", "", "monster");

    if ($conn->connect_error) {
        die("Erreur de connexion à la base de données: " . $conn->connect_error);
    }

    // Préparez une requête SQL pour obtenir les informations du produit
    $req = "SELECT * FROM produits WHERE id = $productId";

    $result = $conn->query($req);

    // Vérifiez si la requête a réussi
    if ($result) {
        // Récupérez les informations du produit
        $product = $result->fetch_assoc();

        // Affichez l'image et le prix du produit
        echo '<img src="' . $product['img'] . '" alt="' . $product['nom'] . '" />';
        echo '<p>Prix : ' . $product['prix'] . ' €</p>';

        // Commencez ou restaurez la session
        session_start();

        // Ajoutez le produit au panier
        $id = $product['id'];
        if (isset($_SESSION['panier'][$id])) {
            $_SESSION['panier'][$id]++;
        
        } else {
            $_SESSION['panier'][$id] = 1;
            
        }

        header("location:index.php");
        // Fermez la connexion à la base de données
        $conn->close();
    } else {
        echo "Erreur lors de la récupération des informations du produit.";
    }
} else {
    // Gérer le cas où l'ID du produit n'est pas défini dans la requête GET
    echo "L'ID du produit n'est pas défini.";
}
?>
