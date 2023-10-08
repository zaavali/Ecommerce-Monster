
<?php
session_start();

$dsn= "mysql:dbname=monsters;host=localhost";
$options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC);
$db = new PDO($dsn,"root","",$options);
$sql = "SELECT * FROM  utilisateurs";
$stmt = $db->query($sql);
$data = $stmt->fetchAll();


?>
<?php
if (!isset($_SESSION['panier'])) {
    $_SESSION['panier'] = array();
}




if (isset($_SESSION['panier'])) {
    $ids = array_keys($_SESSION['panier']);
    
    if (!empty($ids)) {
        $conn = new mysqli("localhost", "root", "", "monsters");

        if ($conn->connect_error) {
            die("Erreur de connexion à la base de données: " . $conn->connect_error);
        }

        $req = "SELECT * FROM produits WHERE id IN (" . implode(',', $ids) . ")";
        $resultats = $conn->query($req);
        
        $produits = array();

        if ($resultats) {
            while ($produit = $resultats->fetch_assoc()) {
                $produits[] = $produit;
            }
        }

        
    }
} else {
    echo '<img src="./img/empty.jpg" alt="Panier vide">';
}
?>
<?php
$conn = new mysqli("localhost", "root", "", "monsters");

if ($conn->connect_error) {
    die("Erreur de connexion à la base de données: " . $conn->connect_error);
}
$req = "SELECT * FROM produits";
$resultats = $conn->query($req);


$reqEnergy = "SELECT * FROM produits WHERE categorie = 'energy'  " ;
$reqUltra = "SELECT * FROM produits WHERE categorie = 'ultra' ";
$reqJuice = "SELECT * FROM produits WHERE categorie = 'juice' ";

$EnergyResult = $conn->query($reqEnergy);
$UltraResult = $conn->query($reqUltra);
$JuiceResult = $conn->query($reqJuice);

if ($resultats === false) {
    die("Erreur lors de l'exécution de la requête SQL: " . $conn->error);
}

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script src="./main.js" defer></script>
    <title>Document</title>
</head>
<body>
<div class="navbar">
            <div class="logo">
                <a href="./index.php"><img src="./Assets/monser_logo.png" alt=""> </a>

            </div>
           
            <div class="link" >
                <div>
                <ul>
                    <li>Accueil</li>
                    <li>Produit</li>
                    <li>Contact</li>
                </ul>
                </div>
            </div>
            <div class="btns_nav">
            <?php if (isset($_SESSION['username']) && is_array($_SESSION['username'])) : ?>
            <?php $prenom = $_SESSION['username']['prenom']; ?>
            <button id="logins" class="logins"><a > <img src="./Assets/utilisateur.png" alt=""> <?= $prenom ?></a></button>
            <div class="profil-container">
            <ul>
           <li><img src="./Assets/utilisateur.png" alt=""> <a href="./profil.php">Mes coordonnées</a></li>
          <hr>
          <li><img src="./Assets/lock.png" alt=""> <a href="">Changer de mot de passe</a></li>
           <hr>
           <li><img src="./Assets/logout.png" alt=""><a href="./deconnexion.php">Deconnexion</a></li>
           </ul>
         </div>

            <?php else : ?>
            <button class="login"><a href="./connexion.php"><img src="./Assets/utilisateur.png" alt=""> Se connecter</a></button>
            
            <?php endif; ?>
                <button class="like"><a href=""><img src="./Assets/like.png" alt=""></a></button>
                <button id="panier_button" class="panier">
                    <img src="./Assets/panier.png" alt="">
                    <b color="red"> <?= is_array($_SESSION['panier']) ? array_sum($_SESSION['panier']) : 0 ?></b>               
               </button>    
            </div>
            <div id="panier_content" style="display:none;"  class="show_panier">
        <div class="wrap_show_panier">
        <?php
        $totalPrix = 0; 
        if (!empty($produits)):
            foreach ($produits as $produit):
                $quantite = $_SESSION["panier"][$produit['id']];
                $prixProduit = $produit['prix'] * $quantite;
                $totalPrix += $prixProduit; 
        ?>
            <div class="wrap_sp_imgtl"> 
                <div> 
                    <img class="panier_img" src="<?= $produit['img'] ?>" />       
                </div>
                <div>
                    <p class="panier_nom_sp"><b><?= $produit['nom'] ?></b></p>
                    <p class=""><b><?= $produit['prix'] ?>.00€ </b></p>
                    <p class="quantité_sp">Quantité : <?=$_SESSION["panier"][$produit['id']] ?></p>
                </div>
                <div class="delete_sp">
                <form action="rule.php" method="post">
                <input type="hidden" name="product_id" value="<?= $produit['id'] ?>">
                <button type="submit" name="delete_product"><img src="./Assets/delete.png" alt=""></button>
                </form>

                    
                </div>
            </div>
        <?php
            endforeach;
        else: ?>
            <div  class="wrap_empty_cart_sp">
                <div class="empty_cart_sp">
                <div>
                <img src="./img/empty cart.png" alt="" >
                </div>
                <div>
                <h2>Ooups ! Le panier est vide</h2>
                <p>Remplissez-moi s'il vous plaît, comme une Monster qui remplit votre énergie !</p>
                </div>
                </div>
            </div>
        <?php
        endif;
        ?>
    </div>
    <?php if (!empty($produits)): ?>
    <div class="voir_panier">
        <div>
            <h1>Total du prix : <?= $totalPrix ?>.00€</h1>
        </div>  
        <div class="btn_voir_panier">
           <button> <a href="./panier.php"> Voir le panier </a></button>
        </div>
    </div>
<?php endif; ?>
</div>
</div> 
    <div class="profil_containers"> 
    <div class="grid_profil">
    <div class="grid">
        <div class="right">
            <h1>Mes coordonnées</h1>
            <div class="wrapthem">
            <form action="modif.php" method="POST">
    <div class="formleft">
        <div class="elem">
            <label for="nom">Nom</label>
            <input type="text" name="nom" value="<?= $_SESSION['username']['nom']; ?>">
        </div>
        <div class="elem">
            <label for="prenom">Prénom</label>
            <input type="text" name="prenom" value="<?= $_SESSION['username']['prenom']; ?>">
        </div>
    </div>
    <div class="formright">
        <div class="elem">
            <label for="new_password">Nouveau mot de passe</label>
            <input type="password" name="new_password" id="new_password">
        </div>
        <div class="elem">
            <label for="mail">Email</label>
            <input type="text" name="mail" value="<?= $_SESSION['username']['mail'] ?>">
        </div>
        <div class="modif">
            <input type="submit" value="Enregistrer">
        </div>
    </div>
</form>
            </div>
        </div>
    </div>
</div>

    </div>
</body>
</html>




<!-- ... Autre contenu HTML ... -->

<!-- ... Autre contenu HTML ... -->
