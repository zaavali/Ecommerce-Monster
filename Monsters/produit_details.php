<?php
session_start();

$conn = new mysqli("localhost", "root", "", "monsters");

if ($conn->connect_error) {
    die("Erreur de connexion : " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $product_id = $_GET['id'];
    $req = "SELECT * FROM produits WHERE id = $product_id";
    $result = $conn->query($req);

    
    if ($row = $result->fetch_assoc()) {
        $nom = $row['nom'];
        $prix = $row['prix'];
        $img = $row['img'];
        $description = $row['description'] ;
    } 
} 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
<section>
        <div class="navbar">
            <div class="logo">
                <img src="./Assets/monser_logo.png" alt="">

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
            <div class="btns">
    <?php
    if (!isset($_SESSION['username'])) {
        ?>
        <button><a href="./inscription.php">Inscription</a></button>
        <button><a href="./connexion.php">Connexion</a></button>
        <?php
    } else {
        ?>

        <a href="./deconnexion.php"><button>Déconnexion</button></a>
        <?php
    }
    ?>
    </div>
    </div>
     </section>

     <section class="Affichage">
        <div class ="left_product">
              <div>
            <h1><?= $nom ; ?></h1> 
            <h3><?= $prix ; ?>.00 €</h3>
            <div class="description">
                <p><?= $description ; ?></p>
            </div>
            <div class="btns_achat">
            <div><button class="moins">-</button><input type="number" name="" id=""><button class="plus">+</button>
            </div><button class="add"> Ajouter dans le panier </button>
            </div>
            </div>
        
        </div>
        <div class ="right_product">
        <img src='<?php echo $img; ?>' alt="">
        </div>
    
    </section>

</body>
</html>
