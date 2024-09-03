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

// Fonction pour récupérer les promotions triées par taille et les étudiants associés
function find_ordered_students($conn) {
    $sql = "
        SELECT g.name AS grade_name, 
               s.id, s.fullname, s.email, s.birthdate, s.gender,
               COUNT(s.id) OVER (PARTITION BY g.id) AS student_count
        FROM grade g
        LEFT JOIN student s ON g.id = s.grade_id
        ORDER BY student_count DESC, g.name
    ";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Récupération des promotions et des étudiants associés
$students_by_grade = find_ordered_students($conn);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des promotions et étudiants associés</title>
</head>
<body>
    <h1>Liste des promotions et étudiants associés</h1>
    <?php
    $current_grade = null;
    foreach ($students_by_grade as $row):
        // Affichage de la promotion seulement si elle change
        if ($row['grade_name'] !== $current_grade):
            if ($current_grade !== null): ?>
                </table>
            <?php endif; ?>
            <h2><?php echo htmlspecialchars($row['grade_name']); ?> (<?php echo htmlspecialchars($row['student_count']); ?> étudiants)</h2>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Date de naissance</th>
                    <th>Genre</th>
                </tr>
            <?php
            $current_grade = $row['grade_name'];
        endif;
        ?>
        <tr>
            <td><?php echo htmlspecialchars($row['id']); ?></td>
            <td><?php echo htmlspecialchars($row['fullname']); ?></td>
            <td><?php echo htmlspecialchars($row['email']); ?></td>
            <td><?php echo htmlspecialchars($row['birthdate']); ?></td>
            <td><?php echo htmlspecialchars($row['gender']); ?></td>
        </tr>
    <?php endforeach; ?>
    </table>
</body>
</html>
