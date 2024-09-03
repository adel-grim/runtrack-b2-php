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

function find_full_rooms($conn) {
    $sql = "
        SELECT room.name AS room_name, room.capacity, 
               COUNT(student.id) AS student_count,
               CASE 
                   WHEN COUNT(student.id) >= room.capacity THEN 'Oui'
                   ELSE 'Non'
               END AS is_full
        FROM room
        LEFT JOIN room_student ON room.id = room_student.room_id
        LEFT JOIN student ON room_student.student_id = student.id
        GROUP BY room.name, room.capacity
    ";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


// Récupération des salles avec leur statut de remplissage
$rooms = find_full_rooms($conn);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des salles et leur statut de remplissage</title>
</head>
<body>
    <h1>Liste des salles et leur statut de remplissage</h1>
    <table>
        <tr>
            <th>Nom de la Salle</th>
            <th>Capacité</th>
            <th>Nombre d'étudiants</th>
            <th>Est pleine?</th>
        </tr>
        <?php foreach ($rooms as $room): ?>
            <tr>
                <td><?php echo htmlspecialchars($room['room_name']); ?></td>
                <td><?php echo htmlspecialchars($room['capacity']); ?></td>
                <td><?php echo htmlspecialchars($room['student_count']); ?></td>
                <td><?php echo htmlspecialchars($room['is_full']); ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
