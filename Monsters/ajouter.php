<?php
session_start();

if (isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];

    // Vérifiez si le panier existe dans la session, sinon créez-le
    if (!isset($_SESSION['panier'])) {
        $_SESSION['panier'] = array();
    }

    // Ajoutez le produit au panier en utilisant l'ID comme clé et 1 comme valeur (quantité)
    if (isset($_SESSION['panier'][$product_id])) {
        $_SESSION['panier'][$product_id] += 1; // Augmentez la quantité si le produit est déjà dans le panier
    } else {
        $_SESSION['panier'][$product_id] = 1; // Ajoutez le produit au panier avec une quantité de 1
    }
}

// Redirigez l'utilisateur vers la page précédente ou une autre page après avoir ajouté le produit au panier
header("Location: ".$_SERVER['HTTP_REFERER']);
?>
