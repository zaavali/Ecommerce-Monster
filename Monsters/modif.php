<?php
session_start();

class Modification {
    public function modif() { 
        $dsn = "mysql:dbname=monster;host=localhost";
        $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC);
        $db = new PDO($dsn, "root", "", $options);

        // Vérifier si un nouveau mot de passe est fourni
        if (!empty($_POST['new_password'])) {
            $new_password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);
        } else {
            // Si le champ du nouveau mot de passe est vide, conservez le mot de passe actuel
            $new_password = $_SESSION['username']['mdp'];
        }

        $sql = "UPDATE utilisateurs SET nom = :nom, prenom = :prenom, mdp = :mdp, mail = :mail WHERE id = :id";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':nom', $_POST['nom']);        
        $stmt->bindParam(':prenom', $_POST['prenom']);
        $stmt->bindParam(':mdp', $new_password);
        $stmt->bindParam(':mail', $_POST['mail']);
        $stmt->bindParam(':id', $_SESSION['id']);

        if ($stmt->execute()) {
            // Mise à jour réussie, redirigez l'utilisateur vers la page de profil
            $_SESSION['username']['nom'] = $_POST['nom'];
            $_SESSION['username']['prenom'] = $_POST['prenom'];
            $_SESSION['username']['mail'] = $_POST['mail'];

            header('Location: profil.php');
            exit();
        } else {
            echo "Échec de la mise à jour des informations de profil.";
        }
    }
}

// Créez une instance de la classe et appelez la méthode modif()
$modification = new Modification();
$modification->modif();
?>
