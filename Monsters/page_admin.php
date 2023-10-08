<?php
session_start();

?>

<?php
$conn = new mysqli("localhost", "root", "", "monsters");

if ($conn->connect_error) {
    die("Erreur de connexion à la base de données: " . $conn->connect_error);
}

$req = "SELECT * FROM produits";
$resultats = $conn->query($req);





if ($resultats === false) {
    die("Erreur lors de l'exécution de la requête SQL: " . $conn->error);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <script src="./script.js" defer></script>
</head>
<body>
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
            <div class="btns_nav">
            <?php if (isset($_SESSION['username']) && is_array($_SESSION['username'])) : ?>
            <?php $prenom = $_SESSION['username']['prenom']; ?>
            <button id="logins" class="logins"><a > <img src="./Assets/utilisateur.png" alt=""> <?= $prenom ?></a></button>
            <button><a href="./deconnexion.php">Deconnexion</a></button>
            <?php else : ?>
            <button class="login"><a href="./connexion.php"><img src="./Assets/utilisateur.png" alt=""> Se connecter</a></button>
            
            <?php endif; ?>
                
                    
            </div>
         
</div> 

<div class="add_admin">
    <button class="add_admin_produit">
        <img src="./Assets/add.png" alt="">
    </button>
</div>

<div class="overlay">
<h1>Ajouter un élément à la base de données</h1>
    <form action="traitement.php" method="POST">
        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" required><br><br>

        <label for="prix">Prix :</label>
        <input type="prix" id="prix" name="prix" required><br><br>

        <label for="description">Description :</label>
        <input type="description" id="description" name="description" required><br><br>

        <label for="categorie">Catégorie :</label>
       <input type="categorie" id="categorie" name="categorie" required><br><br>--

       
       <label for="file">Choisir une image :</label>
        <input type="file" name="img" required>
        <input type="submit" value="Ajouter">
    </form>
       <h1>Supprimer un élément de la base de données</h1>
    <form action="suppression.php" method="POST">
        <label for="id">ID de l'élément à supprimer :</label>
        <input type="text" id="id" name="id" required><br><br>

        <input type="submit" value="Supprimer">
    </form>
    </div>
    <div id="tab1Content" class="tabContent activecontent  ">  
    <div class="tabcontainer">
    <?php 
    foreach ($resultats as $unproduit): ?>
        <div class="card">
            <div>
            <a class="link_wrap" href="produit_details.php?id=<?= $unproduit['id'] ?>">      
                <img class="bd_img" src="<?= $unproduit['img'] ?>" />
                <p class="nom_prod"><b><?= $unproduit['nom'] ?></b></p>
               
            </a>
            <a href="suppression.php?id=<?= $unproduit['id'] ?>"><img src="./Assets/delete.png" alt="" width="20" height="20px"></a>
            </div>        
        </div>
    <?php endforeach ?>
    </div>
    </div>
    
</body>
</html>


    