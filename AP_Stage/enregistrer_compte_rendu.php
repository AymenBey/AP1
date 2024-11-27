<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $num = $_POST['num'] ?? null;
    $date = $_POST['date'] ?? null;
    $description = $_POST['description'] ?? null;

    if ($date && $description) {
        try {
            // Connexion à la base de données
            $pdo = new PDO("mysql:host=localhost;dbname=apstage", "root", "root");
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            if ($num) {
                // Modifier un compte rendu existant
                $stmt = $pdo->prepare("UPDATE cr SET date = :date, description = :description, datemodif = NOW() WHERE num = :num");
                $stmt->execute([
                    'num' => $num,
                    'date' => $date,
                    'description' => $description
                ]);
            } else {
                // Créer un nouveau compte rendu
                $stmt = $pdo->prepare("INSERT INTO cr (date, description) VALUES (:date, :description)");
                $stmt->execute([
                    'date' => $date,
                    'description' => $description
                ]);
            }

            // Redirection après succès
            header('Location: liste_compte_rendu.php');
            exit(); // S'assurer que le script s'arrête après la redirection
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
        }
    } else {
        echo "Tous les champs sont obligatoires.";
    }
}
