<?php
session_start();

$produits = [];

if (isset($_SESSION['panier'])) {
    $ids = array_keys($_SESSION['panier']);

    if (!empty($ids)) {
        $conn = new mysqli("localhost", "root", "", "monsters");

        if ($conn->connect_error) {
            die("Erreur de connexion à la base de données: " . $conn->connect_error);
        }

        $req = "SELECT * FROM produits WHERE id IN (" . implode(',', $ids) . ")";
        $resultats = $conn->query($req);

        if ($resultats) {
            while ($produit = $resultats->fetch_assoc()) {
                $produits[] = $produit;
            }
        }

        $conn->close();
    }
}

$totalPrix = 0;
if (!empty($produits)) :
    foreach ($produits as $produit) :
        $quantite = $_SESSION["panier"][$produit['id']];
        $prixProduit = $produit['prix'] * $quantite;
        $totalPrix += $prixProduit;
    endforeach;
endif;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Croissant+One&family=Poppins:ital,wght@1,500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="panier.css">
    <script src="./main.js" defer></script>
    <title>Document</title>
</head>

<body>
    <div class="navbar">
        <div class="logo">
           <a href="./index.php"> <img src="./Assets/monser_logo.png" alt=""></a>
        </div>

        <div class="link">
            <ul>
                <li>Accueil</li>
                <li>Produit</li>
                <li>Contact</li>
            </ul>
        </div>
        <div class="btns_nav">
            <?php if (isset($_SESSION['username']) && is_array($_SESSION['username'])) : ?>
            <?php $prenom = $_SESSION['username']['prenom']; ?>
            <button id="logins" class="logins"><a > <img src="./Assets/utilisateur.png" alt=""> <?= $prenom ?></a></button>
            
            <?php else : ?>

            <button class="login"><a href="./connexion.php"><img src="./Assets/utilisateur.png" alt=""> Se connecter</a></button>
            
            <?php endif; ?>
                    
            </div>
         </div>

        


    <?php if (empty($produits)) : ?>
        <div class="wrap_allcart_empty">
            <div class="allcart_empty">
                <div>
                <img src="./img/empty cart.png" alt="">
                <h1>Ooups ! votre panier est vide</h1>
                <a href="./index.php"> <button> Découvrez nos produits maintenant</button></a>
                </div>
            </div>
        </div>
    <?php else : ?>
        <div class="wrap_allcart">
            <div class="left_cart">
                <?php foreach ($produits as $produit) : ?>
                    <div class="product">
                        <div class="wrap_img_cart">
                            <img src="<?= $produit['img'] ?>" alt="<?= $produit['nom'] ?>" />
                        </div>
                        <div class="product_info">
                           <p><b><?= $produit['nom'] ?></b></p>
                           <div class="Quantité_panier">
                           <a href="rule.php?action=diminue&id=<?= $produit['id'] ?>">-</a>
                           <p class="numb"> <?= $_SESSION["panier"][$produit['id']] ?></p>
                           <a href="rule.php?action=augmente&id=<?= $produit['id'] ?>">+</a>
                           </div>
                        </div>

                        <div class="wrap_prix_cart">
                            <div class="icons_cart">
                                <form action="rule.php" method="post">
                                    <input type="hidden" name="product_cart_id" value="<?= $produit['id'] ?>">
                                    <button class="del_panier" type="submit" name="delete_cart"><img src="./Assets/delete.png" alt=""></button>
                                </form>
                                <img src="./Assets/like.png" alt="">
                            </div>
                            <h1 class="prix_cart"><b><?= $produit['prix'] ?>.00€</b></h1>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="right_cart">
                <div class="code_promo">
                    <p>Entrez un code promo</p>
                    <div>
                        <input type="text">
                        <input type="submit" value="Activer">
                    </div>
                </div>
                <?php if (!empty($produits)) : ?>
                    <div class="totalité">
                        <h1>Total du prix : <?= $totalPrix ?>.00€ </h1>
                    </div>
                <?php endif; ?>
                <button class="keep_going">Continuer</button>
                <div class="moyen_paiement">
                    <img src="./img/Visa_logo.png" alt="">
                    <img src="./img/CB.jpg" alt="">
                    <img src="./img/master card.jpeg" alt="">
                    <img src="./img/paypal.jpeg" alt="">
                    <img src="./img/american express.jpeg" alt="">
                </div>
            </div>
        </div>
    <?php endif; ?>
</body>

</html>
