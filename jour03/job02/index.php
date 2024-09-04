<?php

// Inclusion des classes
require_once 'class/Student.php';
require_once 'class/Grade.php';
require_once 'class/Room.php';
require_once 'class/Floor.php';

// Test 1 
$student = new Student(1, 101, 'adel@grim.com', 'Adel Grim', new DateTime('2000-01-15'), 'Male');
echo "Student: " . $student->getFullname() . " (" . $student->getEmail() . ")\n";

// Test 2 
$grade = new Grade(101, 'Science');
echo "Grade: " . $grade->getName() . "\n";

// Test 3 
$room = new Room(201, 1, 'Salle 101', 30);
echo "Room: " . $room->getName() . " (Capacity: " . $room->getCapacity() . ")\n";

// Test 4 
$floor = new Floor(1, '1er étage');
echo "Floor: " . $floor->getName() . "\n";

