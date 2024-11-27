<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer ou Modifier un Compte Rendu</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            max-width: 600px;
            background: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #333;
        }
        form {
            margin-top: 20px;
        }
        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }
        input[type="date"], textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
            border: 1px solid #ddd;
        }
        input[type="submit"] {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php
        $isEdit = false;
        $num = null;
        $date = "";
        $description = "";

        // Connexion à la base de données
        $pdo = new PDO("mysql:host=localhost;dbname=apstage", "root", "root");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Si un numéro est passé, récupérer les détails pour préremplir le formulaire
        if (!empty($_POST['num'])) {
            $num = $_POST['num'];
            $stmt = $pdo->prepare("SELECT * FROM cr WHERE num = :num");
            $stmt->execute(['num' => $num]);
            $compteRendu = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($compteRendu) {
                $isEdit = true;
                $date = $compteRendu['date'];
                $description = $compteRendu['description'];
            }
        }

        // Afficher un titre différent selon le contexte
        echo $isEdit ? "<h1>Modifier le Compte Rendu</h1>" : "<h1>Créer un Compte Rendu</h1>";
        ?>

        <!-- Formulaire -->
       
            <?php if ($isEdit): ?>
                <input type="hidden" name="num" value="<?= htmlspecialchars($num) ?>">
            <?php endif; ?>
            <label for="date">Date :</label>
            <input type="date" id="date" name="date" value="<?= htmlspecialchars($date) ?>" required>
            <label for="description">Description :</label>
            <textarea id="description" name="description" required><?= htmlspecialchars($description) ?></textarea>
            <input type="submit" value="<?= $isEdit ? 'Modifier' : 'Créer' ?>">
    
        </form>
    </div>
</body>
</html>
