<?php
// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "lp_official";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8mb4", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    die();
}

// Fonction pour récupérer tous les étudiants
function find_all_students($conn) {
    $sql = "SELECT * FROM student";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    
    // Retourner les résultats sous forme de tableau associatif
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Récupération des étudiants
$students = find_all_students($conn);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des étudiants</title>
</head>
<body>
    <h1>Liste des étudiants</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Grade ID</th>
            <th>Email</th>
            <th>Nom Complet</th>
            <th>Date de Naissance</th>
            <th>Genre</th>
        </tr>
        <?php foreach ($students as $student): ?>
            <tr>
                <td><?php echo htmlspecialchars($student['id']); ?></td>
                <td><?php echo htmlspecialchars($student['grade_id']); ?></td>
                <td><?php echo htmlspecialchars($student['email']); ?></td>
                <td><?php echo htmlspecialchars($student['fullname']); ?></td>
                <td><?php echo htmlspecialchars($student['birthdate']); ?></td>
                <td><?php echo htmlspecialchars($student['gender']); ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
