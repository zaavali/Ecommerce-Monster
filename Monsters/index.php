<?php
session_start();
if (!isset($_SESSION['panier'])) {
    $_SESSION['panier'] = array();
}




if (isset($_SESSION['panier'])) {
    $ids = array_keys($_SESSION['panier']);
    
    if (!empty($ids)) {
        $conn = new mysqli("localhost", "root", "", "monster");

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
$conn = new mysqli("localhost", "root", "", "monster");

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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
     <link href="https://fonts.googleapis.com/css2?family=Croissant+One&
     family=Poppins:ital,wght@1,500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <script src="./main.js" defer></script>
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
                    
                    <li><a href="./index.php">Accueil</a> </li>
                    <li > <a href="#produit">Produit</a></li>
                    <li ><a href="#contact">Contact</a></li>
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
         
           <li><img src="./Assets/logout.png" alt=""><a href="./deconnexion.php">Deconnexion</a></li>
           </ul>
         </div>

            <?php else : ?>
            <button class="login"><a href="./connexion.php"><img src="./Assets/utilisateur.png" alt=""> Se connecter</a></button>
            
            <?php endif; ?>
                <button id="panier_button" class="panier">
                    <img src="./Assets/panier.png" alt="">
                    <b color="red"> <?= is_array($_SESSION['panier']) ? array_sum($_SESSION['panier']) : 0 ?></b>               
               </button>    
            </div>
            <div id="panier_content" style="display: none;"  class="show_panier">
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
        <div class="grid_them">
        <div class="carrous_me">
        <div class="left">
            <div>
            <h1>Boostez votre énergie avec Monster Energy.</h1>
            <div class="btn_shop1">
                <button><a href="#produit">Découvrir</a> </button>
            </div>
            </div>
        </div>
        <div class="right">
            <div>
                <img src="./img/energy monster.png" alt="">
            </div>
        </div>
        </div>
    </div>
    <div class="grid_them">
        <div class="carrous_me">
        <div class="left">
            <div>
            <h1>Vivez l'expérience Monster Ultra : zéro calories, 100% saveur.</h1>
            <div class="btn_shop2">
                <button><a href="#produit">Découvrir</a></button>
            </div>
            </div>
        </div>
        <div class="right">
            <div>
                <img src="./img/monstra ultra.png" alt="">
            </div>
        </div>
    </div>
    </div>
    <div class="grid_them">
        <div class="carrous_me">
        <div class="left">
            <div>
                <h1>Un goût fruité pour dynamiser votre journée.</h1>
                <div class="btn_shop3">
                    <button><a href="#produit">Découvrir</a></button>
                </div>
            </div>
        </div>
        <div class="right">
            <div>
                <img src="./img/juice monster.png" alt="">
            </div>
        </div>
        </div>
    </div>
    <div class="dots">
        <div class="dot active_dot"></div>
        <div class="dot"></div>
        <div class="dot"></div>
    </div>
    <div class="btns_rl">
    <div class="btn_left"><img src="./img/left_fleche.png" alt=""></div>
    <div class="btn_right"><img src="./img/rightf-droite.png" alt=""></div>
   </div>
    </section>

    <section class="produits" id="produit">
    <div class="tabs">
    <div id="tab1" onClick="selectTab(1);" class="active">Tous les produits</div>
    <div id="tab2" onClick="selectTab(2);">Monster Energy</div>
    <div id="tab3" onClick="selectTab(3);">Monster Ultra</div>
    <div id="tab4" onClick="selectTab(4);">Monster Juice</div>
    </div>
    <div id="tab1Content" class="tabContent activecontent  ">
    <div class="tabcontainer">
    <?php 
    foreach ($resultats as $unproduit): ?>
        <div class="card">
            <div>
            <a href="produit_details.php?id=<?= $unproduit['id'] ?>">
                <img class="bd_img" src="<?= $unproduit['img'] ?>" />
                <p class="nom_prod"><b><?= $unproduit['nom'] ?></b></p>
            </a>
                <p class="prix"> <span> <?= $unproduit['prix'] ?>.00 € </span>
                <span class="add-button"><a href="getproduct.php?id=<?= $unproduit['id'] ?>"> <img src="./Assets/panier.png" alt=""></a></span>
                </p>   
            </div>   
        </div>
    <?php endforeach ?>
    </div>
    </div>

    <div id="tab2Content" class="tabContent ">
    <div class="tabcontainer">
    <?php 
    foreach ($EnergyResult as $unEnergy): ?>
        <div class="card">
            <div>
            <a href="produit_details.php?id=<?= $unEnergy['id'] ?>">
                <img class="bd_img" src="<?= $unEnergy['img'] ?>" />
                <p class="nom_prod"><b><?= $unEnergy['nom'] ?></b></p>              
            </a> 
            <p class="prix"> <span> <?= $unEnergy['prix'] ?>.00 €</span>
            <span class="add-button" ><a href=""><img src="./Assets/panier.png" alt=""></a></span>
            </p>
            </div>   
        </div>
    <?php endforeach ?>
    </div>
        
    </div>
    <div id="tab3Content" class="tabContent ">
    <div class="tabcontainer">
    <?php 
    foreach ($UltraResult as $unUltra): ?>

        <div class="card">
            <div>
            <a href="produit_details.php?id=<?= $unUltra['id'] ?>">
                <img class="bd_img" src="<?= $unUltra['img'] ?>" />
                <p class="nom_prod"><b><?= $unUltra['nom'] ?></b></p>
            </a> 
            <p class="prix"><span> <?= $unUltra['prix'] ?>.00 € </span>
            <span><img src="./Assets/panier.png" alt=""></span>
            </p>
            </div>         
        </div>
    <?php endforeach ?>
    </div>
    </div>

    <div id="tab4Content" class="tabContent">
    <div class="tabcontainer">
    <?php 
    foreach ($JuiceResult as $unJuice): ?>

        <div class="card">
            <div>
            <a href="produit_details.php?id=<?= $unJuice['id'] ?>">
                <img class="bd_img" src="<?= $unJuice['img'] ?>" />
                <p class="nom_prod"><b><?= $unJuice['nom'] ?></b></p>
            </a>
            <p class="prix"><span> <?= $unJuice['prix'] ?>.00 €</span><span><img src="./Assets/panier.png" alt=""></span></p>
            </div>          
        </div>
    <?php endforeach ?>
    </div>
    </div>
    </section>
    <footer>
        <div class="souscrire">
        <h1>Souscrire à la newsletter</h1>
        <p>Recevoir les dernières news de Monster Energy dans ta boîte de réception</p>
        </div>
         <div class="input_newsletter">
            <div class="border">
            <input type="text"> <input type="submit">
            </div>
         </div>

         <div class="final" id="contact">
            <div>
                <img src="./Assets/monser_logo.png" alt="">
            </div>
            <div>
                <h1>Société</h1>
                <ul>
                    <li>Conditions d'utilisation</li>
                    <li>Politique de confidentialité</li>
                    <li>Politique des cookies</li>
                    <li>Politique des bons de réduction</li>
                    <li>Durabilité</li>
                 </ul>
            </div>
            <div>
                <h1>Aide</h1>
                <ul>

                    <li>FAQs</li>
                    <li>Nous contacter</li>
                </ul>
            </div>
            <div>
                 <h1>Suis nous</h1>
                 <ul>
                    <li>logo face</li>
                    <li>logo insta</li>
                    <li>logo x</li>
                    <li>logo youtu</li>
                 </ul>
            </div>
         </div>
    </footer>
</body>
</html>