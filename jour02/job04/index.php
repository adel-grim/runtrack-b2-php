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

// Fonction pour récupérer les emails, noms complets et noms de promotions des étudiants
function find_all_students_grades($conn) {
    $sql = "
        SELECT student.email, student.fullname, grade.name AS grade_name
        FROM student
        JOIN grade ON student.grade_id = grade.id
    ";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    // Retourner les résultats sous forme de tableau associatif
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Récupération des étudiants avec leurs promotions
$students = find_all_students_grades($conn);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des étudiants et leurs promotions</title>
</head>
<body>
    <h1>Liste des étudiants et leurs promotions</h1>
    <table>
        <tr>
            <th>Email</th>
            <th>Nom Complet</th>
            <th>Nom de Promotion</th>
        </tr>
        <?php foreach ($students as $student): ?>
            <tr>
                <td><?php echo htmlspecialchars($student['email']); ?></td>
                <td><?php echo htmlspecialchars($student['fullname']); ?></td>
                <td><?php echo htmlspecialchars($student['grade_name']); ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
