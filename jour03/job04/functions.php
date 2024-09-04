<?php

require_once 'class/Student.php';
require_once 'class/Grade.php';
require_once 'class/Room.php';
require_once 'class/Floor.php';

// Connexion à la base de données (vous pouvez ajuster les paramètres de connexion ici)
function getDbConnection(): PDO {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "lp_official";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8mb4", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
        die();
    }
}

// Fonction pour trouver un étudiant par son ID
function findOneStudent(int $id): ?Student {
    $conn = getDbConnection();
    $stmt = $conn->prepare("SELECT * FROM student WHERE id = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($result) {
        return new Student(
            $result['id'],
            $result['grade_id'],
            $result['email'],
            $result['fullname'],
            new DateTime($result['birthdate']),
            $result['gender']
        );
    }
    return null; // Retourne null si l'étudiant n'existe pas
}

// Fonction pour trouver une promotion (grade) par son ID
function findOneGrade(int $id): ?Grade {
    $conn = getDbConnection();
    $stmt = $conn->prepare("SELECT * FROM grade WHERE id = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($result) {
        return new Grade(
            $result['id'],
            $result['name']
        );
    }
    return null; // Retourne null si la promotion n'existe pas
}

// Fonction pour trouver une salle (room) par son ID
function findOneRoom(int $id): ?Room {
    $conn = getDbConnection();
    $stmt = $conn->prepare("SELECT * FROM room WHERE id = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($result) {
        return new Room(
            $result['id'],
            $result['floor_id'],
            $result['name'],
            $result['capacity']
        );
    }
    return null; // Retourne null si la salle n'existe pas
}

// Fonction pour trouver un étage (floor) par son ID
function findOneFloor(int $id): ?Floor {
    $conn = getDbConnection();
    $stmt = $conn->prepare("SELECT * FROM floor WHERE id = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($result) {
        return new Floor(
            $result['id'],
            $result['name']
        );
    }
    return null; // Retourne null si l'étage n'existe pas
}

