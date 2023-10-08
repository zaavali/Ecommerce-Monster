<?php
session_start(); // Toujours commencer la session

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="connexion.css">
	<script src="./script.js" defer></script>
	<title>Document</title>
  
</head>
<body>
  <div class="notification hidden ">
  <?php
if (isset($_SESSION['message'])) {
    echo '<div class="englobe_valide" color: white;>';
    echo '<div class="valid">';
    echo '<p> <img src="./Assets/thumbs_up_sign.gif" alt="" width="50px" height="50px">  ' . $_SESSION['message'] . '</p>';
    echo '</div>';
    echo '</div>';
    unset($_SESSION['message']); 
}
?>
</div>
<div class=" wrap_connexion">
<div class="container" id="container">
  <div class="form-container sign-up-container">
    <form action="test.php?action=inscription" method="POST">
      <h1>Creer un compte</h1>
      <span>Tous les champs sont obligatoire</span>  
      <input type="text" name="prenom" id="prenom" placeholder="prenom" required />
      <input type="text" name="nom" id="name" placeholder="nom" required />
      <input type="text" name="mail" id="mail" placeholder="Email" required />
      <input type="password" name="password" id="password" placeholder="Password" required />
      <input type="password" name="password-chk" id="password-chk" placeholder="Confirm Password" required />
      <input type="submit" value="Envoyer">
    </form>
  </div>
  <div class="form-container sign-in-container">
    <form action="test.php?action=connexion" method="POST">
      <h1>Se connecter</h1>

      <input type="text" name="mail" id="mail" placeholder="Email" required />
      <input type="password" name="password" id="password" placeholder="Password" required />
      <a href="#">Mot de passe oublié </a>
      <input type="submit" value="Envoyer">
    </form>
  </div>
  
  <div class="overlay-container">
    <div class="overlay">
      <div class="overlay-panel overlay-left">
      <h1>Re-bienvenue !</h1>
      <p>Pour rester connecté avec nous, veuillez vous connecter avec vos informations personnelles.</p>
        <button class="ghost" id="signIn">Se connecter</button>
      </div>
      <div class="overlay-panel overlay-right">
        <h1>Bonjour</h1>
        <p>Entrez vos coordonnées personnelles et commencez votre voyage avec nous.</p>
        <button class="ghost" id="signUp">S'inscrire</button>
      </div>
    </div>
  </div>
</div>
</div>


</body>
</html>