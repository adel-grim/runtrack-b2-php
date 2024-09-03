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

// Fonction pour récupérer un étudiant par email
function find_one_student($conn, $email) {
    $sql = "SELECT * FROM student WHERE email = :email";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->execute();
    
    // Retourner les résultats sous forme de tableau associatif
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// Vérifier si un email a été fourni via le formulaire
$student = null;
if (isset($_GET['input-email-student'])) {
    $email = $_GET['input-email-student'];
    $student = find_one_student($conn, $email);
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recherche d'un étudiant</title>
</head>
<body>
    <h1>Recherche d'un étudiant</h1>

    <!-- Formulaire pour rechercher un étudiant par email -->
    <form method="get" action="index.php">
        <label for="email">Email de l'étudiant :</label>
        <input type="text" name="input-email-student" id="email" required>
        <button type="submit">Rechercher</button>
    </form>

    <!-- Affichage des informations de l'étudiant s'il est trouvé -->
    <?php if ($student): ?>
        <h2>Informations de l'étudiant :</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Grade ID</th>
                <th>Email</th>
                <th>Nom Complet</th>
                <th>Date de Naissance</th>
                <th>Genre</th>
            </tr>
            <tr>
                <td><?php echo htmlspecialchars($student['id']); ?></td>
                <td><?php echo htmlspecialchars($student['grade_id']); ?></td>
                <td><?php echo htmlspecialchars($student['email']); ?></td>
                <td><?php echo htmlspecialchars($student['fullname']); ?></td>
                <td><?php echo htmlspecialchars($student['birthdate']); ?></td>
                <td><?php echo htmlspecialchars($student['gender']); ?></td>
            </tr>
        </table>
    <?php elseif (isset($email)): ?>
        <p>Aucun étudiant trouvé avec cet email.</p>
    <?php endif; ?>
</body>
</html>
