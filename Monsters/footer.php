<!-- <footer>
        <div class="souscrire">
        <h1>Souscrire à la newsletter</h1>
        <p>Recevoir les dernières news de Monster Energy dans ta boîte de réception</p>
        </div>
         <div class="input_newsletter">
            <div class="border">
            <input type="text"> <input type="submit">
            </div>
         </div>

         <div class="final">
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
    </footer> -->


    <!-- <section class="Produits">
        <h1>Nos produits</h1>
        <div class="list_produit contain_onglets">
            <div class="onglets " data-anim = "1">Tous les produits</div>
            <div class="onglets " data-anim = "2">Monster Energy</div>
            <div class="onglets " data-anim = "3">Monster Ultra</div>
            <div class="onglets " data-anim = "4">Monster Juice</div>
        </div>
    <div class="wrap_card contenu activecontenu" data-anim = "1" >
    <?php 
    foreach ($resultats as $unproduit): ?>

        <div class="card">
            <a href="produit_details.php?id=<?= $unproduit['id'] ?>">
                <img src="<?= $unproduit['img'] ?>" />
                <p><b><?= $unproduit['nom'] ?></b></p>
                <p><?= $unproduit['prix'] ?></p>
            </a>          
        </div>
    <?php endforeach ?>

    <div class="wrap_card contenu " data-anim = "2" >
   <h1>le deuxieme</h1>
    </div>

    <div class="wrap_card contenu " data-anim = "3" >
    <?php 
    foreach ($resultats as $unproduit): ?>

        <div class="card">
            <a href="produit_details.php?id=<?= $unproduit['id'] ?>">
                <img src="<?= $unproduit['img'] ?>" />
                <p><b><?= $unproduit['nom'] ?></b></p>
                <p><?= $unproduit['prix'] ?></p>
            </a>          
        </div>
    <?php endforeach ?>
    </div>
    <div class="wrap_card contenu " data-anim = "4" >
    <?php 
    foreach ($resultats as $unproduit): ?>

        <div class="card">
            <a href="produit_details.php?id=<?= $unproduit['id'] ?>">
                <img src="<?= $unproduit['img'] ?>" />
                <p><b><?= $unproduit['nom'] ?></b></p>
                <p><?= $unproduit['prix'] ?></p>
            </a>          
        </div>
    <?php endforeach ?>
    </div>

    </div>
    </div>
    </section> -->


    <section class="Produits">
        <h1>Nos produits</h1>
        <div class="list_produit contain_onglets">
            <div class="onglets " data-target="all" >Tous les produits</div>
            <div class="onglets " data-target="energy" >Monster Energy</div>
            <div class="onglets " data-target="ultra" >Monster Ultra</div>
            <div class="onglets " data-target="juice" >Monster Juice</div>
        </div>
    <div class="wrap_card contenu activecontenu" data-target="all"  >
    <?php 
    foreach ($resultats as $unproduit): ?>

        <div class="card">
            <a href="produit_details.php?id=<?= $unproduit['id'] ?>">
                <img src="<?= $unproduit['img'] ?>" />
                <p><b><?= $unproduit['nom'] ?></b></p>
                <p><?= $unproduit['prix'] ?></p>
            </a>          
        </div>
    <?php endforeach ?>
    </div>
    <div class="wrap_card contenu " data-target="energy" >
    <?php 
    foreach ($EnergyResult as $unEnergy): ?>

        <div class="card">
            <a href="produit_details.php?id=<?= $unEnergy['id'] ?>">
                <img src="<?= $unEnergy['img'] ?>" />
                <p><b><?= $unEnergy['nom'] ?></b></p>
                <p><?= $unEnergy['prix'] ?></p>
            </a>          
        </div>
    <?php endforeach ?>
    </div>

    <div class="wrap_card contenu " data-target="ultra" >
    <?php 
    foreach ($UltraResult as $unUltra): ?>

        <div class="card">
            <a href="produit_details.php?id=<?= $unUltra['id'] ?>">
                <img src="<?= $unUltra['img'] ?>" />
                <p><b><?= $unUltra['nom'] ?></b></p>
                <p><?= $unUltra['prix'] ?></p>
            </a>          
        </div>
    <?php endforeach ?>
    </div>
    <div class="wrap_card contenu " data-target="juice" >
    <?php 
    foreach ($JuiceResult as $unJuice): ?>

        <div class="card">
            <a href="produit_details.php?id=<?= $unJuice['id'] ?>">
                <img src="<?= $unJuice['img'] ?>" />
                <p><b><?= $unJuice['nom'] ?></b></p>
                <p><?= $unJuice['prix'] ?></p>
            </a>          
        </div>
    <?php endforeach ?>
    </div>

    
    </div>
    </section>




    <!-- change button  -->
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


<div class="btns_nav">
                <button><a href="./inscription.php">Inscription</a></button>
                <button><a href="./connexion.php">Connexion</a></button>
                <button class="like"><a href=""><img src="./Assets/like.png" alt=""></a></button>
                <button class="panier"><a href=""><img src="./Assets/panier.png" alt=""></a></button>
            </div>










            <div class="margin_me">
        <div>
            <h1>Mon panier</h1>
        </div>

        <div class="left_cart">
        <div class="wrap_cart">
        
    <?php foreach ($produits as $produit): ?>

        <div class="img_cart">
        <div class="wrap_img_cart">    
        <img class="" src="<?= $produit['img'] ?>" />
        </div>
        <div>
        <p class=""><b><?= $produit['nom'] ?></b></p>
        <p><span> Quantité : </span> <?= $_SESSION["panier"][$produit['id']] ?></p>
        </div>
        </div>

        <div class="wrap_prix_cart">
        <h1 class="prix_cart"><b><?= $produit['prix'] ?>.00€ </b></h1>
        </div>
        <div>
        resume 
        </div>
        </div>
    <?php endforeach; ?>
    
    </div>
    
    </div>







    <!-- connexion -->
    <div class="testbox">
			<h1>Connexion</h1>

			<form action="test.php?action=connexion" method="POST">
				<hr />
				<hr />
				<label id="icon" for="name"><i class="icon-envelope"></i></label>
				<input type="text" name="mail" id="mail" placeholder="Email" required />
				<label id="icon" for="name"><i class="icon-shield"></i></label>
				<input type="password" name="password" id="password" placeholder="Password" required />
				<input type="submit" value="Envoyer">
			</form>

           


		</div>
        









        <div class="container" id="container">
  <div class="form-container sign-up-container">
    <form action="#">
      <h1>Create Account</h1>
      <div class="social-container">
        <a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
        <a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
        <a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
      </div>
      <span>or use your email for registration</span>
      <input type="text" placeholder="Name" />
      <input type="email" placeholder="Email" />
      <input type="password" placeholder="Password" />
      <button>Sign Up</button>
    </form>
  </div>
  <div class="form-container sign-in-container">
    <form action="#">
      <h1>Sign in</h1>
      <div class="social-container">
        <a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
        <a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
        <a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
      </div>
      <span>or use your account</span>
      <input type="email" placeholder="Email" />
      <input type="password" placeholder="Password" />
      <a href="#">Forgot your password?</a>
      <button class="signIn">Sign In</button>
    </form>
  </div>
  <div class="overlay-container">
    <div class="overlay">
      <div class="overlay-panel overlay-left">
        <h1>Welcome Back!</h1>
        <p>To keep connected with us please login with your personal info</p>
        <button class="ghost" id="signIn">Sign In</button>
      </div>
      <div class="overlay-panel overlay-right">
        <h1>Hello, Friend!</h1>
        <p>Enter your personal details and start journey with us</p>
        <button class="ghost signUp" >Sign Up</button>
      </div>
    </div>
  </div>
</div>






if ($userLogin['admin'] == 1) {
                  // Si l'utilisateur est un administrateur, redirigez-le vers la page d'administration
                  header('location: ./page_admin.php');
              } else {
                  // Sinon, redirigez-le vers la page d'accueil
                  header('location: ./index.php');
              }
          } else {
              // Gestion des erreurs de connexion
              echo "Erreur de connexion. Veuillez vérifier vos informations.";
          }



























          <?php
// Vérifier si l'utilisateur est connecté
session_start();
if (!isset($_SESSION['id'])) {
    // Rediriger l'utilisateur vers la page de connexion s'il n'est pas connecté
    header('Location: connexion.php');
    exit();
}

// Inclure votre fichier de configuration de la base de données
include('config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    // Récupérer les nouvelles valeurs des champs
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $mdp = $_POST['mdp'];
    $mail = $_POST['mail'];

    // Évitez les failles de sécurité en utilisant des requêtes préparées
    $stmt = $conn->prepare("UPDATE utilisateurs SET nom=?, prenom=?, mdp=?, mail=? WHERE id=?");
    $stmt->execute([$nom, $prenom, $mdp, $mail, $_SESSION['id']]);

    // Mettre à jour les informations de session si nécessaire
    $_SESSION['username']['nom'] = $nom;
    $_SESSION['username']['prenom'] = $prenom;
    $_SESSION['username']['mail'] = $mail;

    // Rediriger l'utilisateur vers la page de profil ou une autre page appropriée après la mise à jour
    header('Location: profil.php');
    exit();
}

// Récupérer les informations de l'utilisateur depuis la base de données
$stmt = $conn->prepare("SELECT * FROM utilisateurs WHERE id = ?");
$stmt->execute([$_SESSION['id']]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// Afficher le formulaire de mise à jour avec les informations actuelles de l'utilisateur
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier le profil</title>
</head>
<body>
    <h1>Modifier le profil</h1>
    <form action="modifier.php" method="post">
        <div>
            <label for="nom">Nom :</label>
            <input type="text" id="nom" name="nom" value="<?= $user['nom'] ?>" required>
        </div>
        <div>
            <label for="prenom">Prénom :</label>
            <input type="text" id="prenom" name="prenom" value="<?= $user['prenom'] ?>" required>
        </div>
        <div>
            <label for="mdp">Mot de passe :</label>
            <input type="password" id="mdp" name="mdp" value="<?= $user['mdp'] ?>" required>
        </div>
        <div>
            <label for="mail">Email :</label>
            <input type="email" id="mail" name="mail" value="<?= $user['mail'] ?>" required>
        </div>
        <button type="submit" name="update">Enregistrer les modifications</button>
    </form>
</body>
</html>
