<?php
$servername = "localhost";
$username = "root";
$password = "";

try {
  $conn = new PDO("mysql:host=$servername;dbname=monster", $username, $password);
  // Définir le mode d'erreur PDO sur "exception"
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  echo "Connected successfully";
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}

if (!empty($_GET['action'])) {
  $function = $_GET['action'];
  switch ($function) {
    case 'inscription':
      // Code d'inscription
      if ($_POST['password'] == $_POST['password-chk']) {
        $userPrenom = htmlspecialchars($_POST['prenom']);
        $userNom = htmlspecialchars($_POST['nom']);
        $userMail = htmlspecialchars($_POST['mail']);
        $userMDP = htmlspecialchars($_POST['password']);
        $userMDP = password_hash($userMDP, PASSWORD_DEFAULT);

        // Vérification du mail
        $sth_compare = $conn->prepare("SELECT COUNT(*) FROM utilisateurs WHERE mail = :mail");
        $sth_compare->bindParam(':mail', $userMail);
        $sth_compare->execute();
        $compare = $sth_compare->fetch(PDO::FETCH_COLUMN);

        if ($compare == 0) {
          $sth_register = $conn->prepare("INSERT INTO utilisateurs(nom, prenom, mdp, mail) VALUES(:nom, :prenom, :mdp, :mail)");
          $sth_register->bindParam(':nom', $userNom);
          $sth_register->bindParam(':prenom', $userPrenom);
          $sth_register->bindParam(':mdp',  $userMDP);
          $sth_register->bindParam(':mail', $userMail);

          if ($sth_register->execute()) {
            // Stocker le message de félicitations dans une session
            session_start();
            $_SESSION['message'] = 'Félicitations ' . $userPrenom . '! Inscription réussie. Vous pouvez maintenant vous connecter.';
            header('location: ./connexion.php'); // Rediriger vers la page de connexion
            exit(); // Arrêter l'exécution du script
        } else {
            echo "Inscription échouée";
        }
        
        } else {
          echo "L'inscription a échoué car cet e-mail est déjà utilisé.";
        }
      } else {
        echo "Les mots de passe ne correspondent pas.";
      }
      break;

    case 'connexion':
      // Code de connexion
      // Récupération de la saisie du formulaire de connexion
      $userMail = htmlspecialchars($_POST['mail']);
      $userMDP = htmlspecialchars($_POST['password']);

      // Préparation d'une requête de recherche d'identifiants
      $sth_compare = $conn->prepare("SELECT * FROM utilisateurs WHERE mail = :mail");
      $sth_compare->bindParam(':mail', $userMail);
      $sth_compare->execute();
      $userLogin = $sth_compare->fetch(PDO::FETCH_ASSOC);

      // Si la requête renvoie un résultat... et que le mot de passe correspond, redirigez l'utilisateur
      if ((!empty($userLogin)) && (password_verify($userMDP, $userLogin['mdp']))) {
        session_start();
        $_SESSION['id'] = $userLogin['id'];
        $_SESSION['username'] = array(
          'prenom' => $userLogin['prenom'],
          'nom' => $userLogin['nom'],
          'mail' => $userLogin['mail']
        );

        // Redirigez l'utilisateur vers la page d'accueil ou une autre page si nécessaire
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
      break;
      case 'modif':
        // Code de modification des informations de profil
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Récupérer les données du formulaire
            $nom = htmlspecialchars($_POST['nom']);
            $prenom = htmlspecialchars($_POST['prenom']);
            $mail = htmlspecialchars($_POST['mail']);
    
            // Mettre à jour les informations de profil dans la base de données
            $stmt = $conn->prepare("UPDATE utilisateurs SET nom = :nom, prenom = :prenom, mail = :mail WHERE id = :id");
            $stmt->bindParam(':nom', $nom);
            $stmt->bindParam(':prenom', $prenom);
            $stmt->bindParam(':mail', $mail);
            $stmt->bindParam(':id', $_SESSION['id']);
    
            if ($stmt->execute()) {
                // Mise à jour réussie, redirigez l'utilisateur vers la page de profil
                $_SESSION['username']['nom'] = $nom;
                $_SESSION['username']['prenom'] = $prenom;
                $_SESSION['username']['mail'] = $mail;
    
                header('Location: profil.php');
                exit();
            } else {
                echo "Échec de la mise à jour des informations de profil.";
            }
        }
        break;
    

  }
}
?>


