<?php
session_start();

if (isset($_POST['delete_product']) && isset($_POST['product_id'])) {
    $product_id_delete = $_POST['product_id'];

    if (isset($_SESSION['panier'][$product_id_delete])) {       
        unset($_SESSION['panier'][$product_id_delete]);
    }
    header("Location: index.php");
    exit;
}
if (isset($_POST['delete_cart']) && isset($_POST['product_cart_id'])) {
    $product_id_cart_delete = $_POST['product_cart_id'];

    if (isset($_SESSION['panier'][$product_id_cart_delete])) {       
        unset($_SESSION['panier'][$product_id_cart_delete]);
    }
    
    header("Location: panier.php");
    exit;
}


?>

<?php
session_start();

if (isset($_GET['action']) && isset($_GET['id'])) {
    $action = $_GET['action'];
    $product_id = $_GET['id'];

    if ($action === 'augmente') {
        // Augmenter la quantité du produit dans le panier
        $_SESSION["panier"][$product_id]++;
    } elseif ($action === 'diminue') {
        // Diminuer la quantité du produit dans le panier, en vérifiant que la quantité ne devient pas négative
        if ($_SESSION["panier"][$product_id] > 1) {
            $_SESSION["panier"][$product_id]--;
        }
    }

    // Rediriger vers la page du panier
    header("Location: panier.php");
    exit;
}
?>

