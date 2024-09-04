<?php

require_once 'functions.php';

// Test pour findOneStudent
$student = findOneStudent(1);
if ($student) {
    echo "Student Found: " . $student->getFullname() . " (" . $student->getEmail() . ")\n";
} else {
    echo "Student not found.\n";
}

// Test pour findOneGrade
$grade = findOneGrade(1);
if ($grade) {
    echo "Grade Found: " . $grade->getName() . "\n";
} else {
    echo "Grade not found.\n";
}

// Test pour findOneRoom
$room = findOneRoom(1);
if ($room) {
    echo "Room Found: " . $room->getName() . " (Capacity: " . $room->getCapacity() . ")\n";
} else {
    echo "Room not found.\n";
}

// Test pour findOneFloor
$floor = findOneFloor(1);
if ($floor) {
    echo "Floor Found: " . $floor->getName() . "\n";
} else {
    echo "Floor not found.\n";
}

