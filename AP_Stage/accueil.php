<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page d'Accueil</title>
    <style>
        /* Styles généraux */
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #4facfe, #00f2fe); /* Dégradé dynamique */
            color: #fff;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
        }

        h1 {
            margin-top: 20px;
            font-size: 2.5rem;
            color: #fff;
        }

        .button-container {
            margin-top: 20px;
            display: flex;
            justify-content: center;
            gap: 15px;
        }

        /* Style des boutons */
        .button {
            display: inline-block;
            padding: 15px 30px;
            font-size: 1.1rem;
            text-decoration: none;
            color: #fff;
            background-color: #007bff;
            border: none;
            border-radius: 8px;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .button:hover {
            background-color: #0056b3;
            transform: translateY(-5px);
            box-shadow: 0px 10px 15px rgba(0, 0, 0, 0.2);
        }

        .button.logout {
            background-color: #dc3545;
        }

        .button.logout:hover {
            background-color: #a71d2a;
        }

        /* Section des comptes rendus */
        .compte-rendu-list {
            margin-top: 30px;
            background-color: #fff;
            color: #333;
            width: 90%;
            max-width: 800px;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.2);
        }

        .compte-rendu-list ul {
            list-style-type: none;
            padding: 0;
        }

        .compte-rendu-list li {
            padding: 10px;
            margin-bottom: 10px;
            background: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .compte-rendu-list li strong {
            display: block;
            color: #333;
        }

        .compte-rendu-list button {
            margin-top: 10px;
            padding: 8px 15px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .compte-rendu-list button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h1>Bienvenue dans votre espace</h1>
    <div class="button-container">
        <a href="creer_comptes_rendus.php" class="button">Créer Compte Rendu</a>
        <a href="infoperso.php" class="button">Informations Personnelles</a> <!-- Onglet ajouté -->
        <a href="deconnexion.php" class="button logout">Déconnexion</a>
    </div>

    <div class="compte-rendu-list">
        <h2>Liste des Comptes Rendus</h2>
        <ul>
            <?php
            try {
                // Connexion à la base de données
                $pdo = new PDO("mysql:host=localhost;dbname=apstage", "root", "root");
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                // Récupérer les comptes rendus
                $stmt = $pdo->query("SELECT num, date, description FROM cr ORDER BY date DESC");

                // Afficher les comptes rendus avec un bouton Modifier
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<li>";
                    echo "<strong>Date :</strong> " . htmlspecialchars($row['date']) . "<br>";
                    echo "<strong>Description :</strong> " . htmlspecialchars($row['description']) . "<br>";
                    echo "<form method='POST' action='creer_comptes_rendus.php' style='margin-top: 10px;'>";
                    echo "<input type='hidden' name='num' value='" . $row['num'] . "'>";
                    echo "<button type='submit'>Modifier</button>";
                    echo "</form>";
                    echo "</li>";
                }
            } catch (PDOException $e) {
                echo "Erreur : " . $e->getMessage();
            }
            ?>
        </ul>
    </div>
</body>
</html>
