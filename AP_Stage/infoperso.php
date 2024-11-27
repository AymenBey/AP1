<?php
// Démarrage de la session
session_start();

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Stocker les données du formulaire dans la session
    $_SESSION['nom'] = $_POST['nom'];
    $_SESSION['prenom'] = $_POST['prenom'];
    $_SESSION['email'] = $_POST['email'];
    $_SESSION['adresse_postale'] = $_POST['adresse_postale'];
    $_SESSION['telephone'] = $_POST['telephone'];
    $_SESSION['lieu_stage'] = $_POST['lieu_stage'];
    $_SESSION['nom_tuteur'] = $_POST['nom_tuteur'];
    $_SESSION['numero_entreprise'] = $_POST['numero_entreprise'];
    $_SESSION['adresse_entreprise'] = $_POST['adresse_entreprise'];

    // Rediriger vers la page d'accueil après avoir enregistré les données
    header('Location: accueil.php');
    exit();  // Ne pas oublier d'appeler exit() après la redirection pour arrêter l'exécution du script
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Info Perso</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 0;
            background-color: #f4f4f9;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        form {
            max-width: 600px;
            margin: auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        label {
            display: block;
            margin: 15px 0 5px;
            font-weight: bold;
        }
        input, textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h1>Formulaire de Stage</h1>
    <form method="POST">
        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" value="<?php echo isset($_SESSION['nom']) ? $_SESSION['nom'] : ''; ?>" placeholder="Votre nom">

        <label for="prenom">Prénom :</label>
        <input type="text" id="prenom" name="prenom" value="<?php echo isset($_SESSION['prenom']) ? $_SESSION['prenom'] : ''; ?>" placeholder="Votre prénom">

        <label for="email">Adresse e-mail :</label>
        <input type="email" id="email" name="email" value="<?php echo isset($_SESSION['email']) ? $_SESSION['email'] : ''; ?>" placeholder="Votre e-mail">

        <label for="adresse_postale">Adresse postale :</label>
        <input type="text" id="adresse_postale" name="adresse_postale" value="<?php echo isset($_SESSION['adresse_postale']) ? $_SESSION['adresse_postale'] : ''; ?>" placeholder="Votre adresse postale">

        <label for="telephone">Numéro de téléphone :</label>
        <input type="tel" id="telephone" name="telephone" value="<?php echo isset($_SESSION['telephone']) ? $_SESSION['telephone'] : ''; ?>" placeholder="Votre numéro de téléphone">

        <label for="lieu_stage">Lieu de stage :</label>
        <input type="text" id="lieu_stage" name="lieu_stage" value="<?php echo isset($_SESSION['lieu_stage']) ? $_SESSION['lieu_stage'] : ''; ?>" placeholder="Lieu du stage">

        <label for="nom_tuteur">Nom du tuteur :</label>
        <input type="text" id="nom_tuteur" name="nom_tuteur" value="<?php echo isset($_SESSION['nom_tuteur']) ? $_SESSION['nom_tuteur'] : ''; ?>" placeholder="Nom du tuteur">

        <label for="numero_entreprise">Numéro de l'entreprise :</label>
        <input type="text" id="numero_entreprise" name="numero_entreprise" value="<?php echo isset($_SESSION['numero_entreprise']) ? $_SESSION['numero_entreprise'] : ''; ?>" placeholder="Numéro de l'entreprise">

        <label for="adresse_entreprise">Adresse postale de l'entreprise :</label>
        <textarea id="adresse_entreprise" name="adresse_entreprise" placeholder="Adresse postale de l'entreprise"><?php echo isset($_SESSION['adresse_entreprise']) ? $_SESSION['adresse_entreprise'] : ''; ?></textarea>

        <button type="submit">Enregistrer</button>
    </form>
</body>
</html>
