<?php
function motDePasse($longueur) {
    $Chaine = "abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ!+()*-/";
    $Chaine = str_shuffle($Chaine);
    $Chaine = substr($Chaine, 0, $longueur);
    return $Chaine;
}

include "_conf.php";

if (isset($_POST['email'])) {
    $lemail = $_POST['email'];
    echo "Form submitted with email: $lemail";

    if ($connexion = mysqli_connect($serveurBDD, $userBDD, $mdpBDD, $nomBDD)) {
        $stmt = $connexion->prepare("SELECT login, motdepasse FROM utilisateur WHERE email = ?");
        $stmt->bind_param("s", $lemail);
        $stmt->execute();
        $resultat = $stmt->get_result();
        
        if ($donnees = $resultat->fetch_assoc()) {
            $login = $donnees['login'];
            $newmdp = motDePasse(12);
            $mdphache = password_hash($newmdp, PASSWORD_BCRYPT);
            
            $updateStmt = $connexion->prepare("UPDATE utilisateur SET motdepasse = ? WHERE email = ?");
            $updateStmt->bind_param("ss", $mdphache, $lemail);
            $updateStmt->execute();
            
            $message = "Your new password is: '$newmdp' - Your login: '$login'";
            mail($lemail, 'Your login/password on the website', $message);
            
            echo "Email trouver nouveau mdp envoyer.";
        } else {
            echo "Email non trouver.";
        }
    } else {
        echo "Error connecting to the database.";
    }
} else {
?>
    <form method="POST">
        <input type="email" name="email" required>
        <input type="submit" value="OK" name="envoi">
    </form>
<?php
}
?>
