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

// Fonction pour insérer un nouvel étudiant dans la base de données
function insert_student($conn, $email, $fullname, $gender, $birthdate, $grade_id) {
    $sql = "INSERT INTO student (email, fullname, gender, birthdate, grade_id) VALUES (:email, :fullname, :gender, :birthdate, :grade_id)";
    $stmt = $conn->prepare($sql);
    
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':fullname', $fullname);
    $stmt->bindParam(':gender', $gender);
    $stmt->bindParam(':birthdate', $birthdate);
    $stmt->bindParam(':grade_id', $grade_id);
    
    $stmt->execute();
}

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['input-email'];
    $fullname = $_POST['input-fullname'];
    $gender = $_POST['input-gender'];
    $birthdate = $_POST['input-birthdate'];
    $grade_id = $_POST['input-grade_id'];
    
    insert_student($conn, $email, $fullname, $gender, $birthdate, $grade_id);

    echo "Étudiant ajouté avec succès !";
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajout d'un étudiant</title>
</head>
<body>
    <h1>Ajouter un nouvel étudiant</h1>

    <!-- Formulaire pour ajouter un nouvel étudiant -->
    <form method="post" action="index.php">
        <label for="email">Email :</label>
        <input type="email" name="input-email" id="email" required><br>

        <label for="fullname">Nom Complet :</label>
        <input type="text" name="input-fullname" id="fullname" required><br>

        <label for="gender">Genre :</label>
        <select name="input-gender" id="gender" required>
            <option value="male">Male</option>
            <option value="female">Female</option>
        </select><br>

        <label for="birthdate">Date de Naissance :</label>
        <input type="date" name="input-birthdate" id="birthdate" required><br>

        <label for="grade_id">Grade ID :</label>
        <input type="number" name="input-grade_id" id="grade_id" required><br>

        <button type="submit">Ajouter l'étudiant</button>
    </form>
</body>
</html>
