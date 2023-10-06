<?php 


$servername = "localhost";
$username = "root";
$password = "";

try {
  $conn = new PDO("mysql:host=$servername;dbname=monsters", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  echo "Connected successfully";
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}

if (!empty($_GET['action'])) {

    $function = $_GET['action'];
    switch ($function) {
      case 'inscription':  
        // code inscription
        if ($_POST['password'] == $_POST['password-chk']) {
            $userPrenom = htmlspecialchars($_POST['prenom']);
            $userNom = htmlspecialchars($_POST['nom']);
            $userMail = htmlspecialchars($_POST['mail']);
            $userMDP = htmlspecialchars($_POST['password']);
            $userMDP = password_hash($userMDP, PASSWORD_DEFAULT);
        
            // Vérification du mail
            $sth_compare = $conn->prepare("SELECT COUNT(*) FROM utilisateurs WHERE mail = '$userMail'");
            $sth_compare->execute();
            $compare = $sth_compare->fetch(PDO::FETCH_ASSOC);
            var_dump($compare);
            if ($compare["COUNT(*)"] == 0) {
              
              $sth_register = $conn->prepare("INSERT INTO utilisateurs(nom, prenom, mdp, mail) VALUES(:nom, :prenom, :mdp, :mail)");
              var_dump($sth_register);
              $sth_register->bindParam(':nom', $userNom);
              $sth_register->bindParam(':prenom', $userPrenom);
              $sth_register->bindParam(':mdp',  $userMDP);
              $sth_register->bindParam(':mail', $userMail);
              
              $sth_register->execute();
               header('location: ../index.php');
            var_dump($_POST['prenom'], $_POST['nom'], $_POST['mail'], $_POST['password']);
            }
        }
      case 'connexion' :
        // code connexion
        // ? Récupération de la saisie login form
        $userMail = htmlspecialchars($_POST['mail']);
        $userMDP = htmlspecialchars($_POST['password']);
       

        // ? Préparation d'une requête de recherche d'identifiants
        $sth_compare = $conn->prepare("SELECT * FROM utilisateurs WHERE mail = '$userMail'");
        $sth_compare->execute();
        $userLogin = $sth_compare->fetch(PDO::FETCH_ASSOC);

        // ? Si la requête renvoie un resultat... et que le mot de passe correspond, on redirige l'utilisateur vers la page d'accueil
        
        if ((!empty($userLogin)) && (password_verify($userMDP, $userLogin['mdp']))) {
          session_start();
      
          $_SESSION['id'] = $userLogin['id'];
          $_SESSION['username'] = array(
              'prenom' => $userLogin['prenom'],
              'nom' => $userLogin['nom'],
              'mail' => $userLogin['mail'] 
          );
      
          // Redirigez l'utilisateur vers la page d'accueil ou une autre page si nécessaire
          header('location: ./index.php');
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
      }
          

    } 


      ?>