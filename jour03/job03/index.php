<?php

require_once 'class/Student.php';
require_once 'class/Grade.php';
require_once 'class/Room.php';
require_once 'class/Floor.php';

// Test pour Student
$student = new Student();
$student->setFullname('John Doe');
$student->setEmail('john.doe@example.com');
echo "Student Name: " . $student->getFullname() . "\n";
echo "Student Email: " . $student->getEmail() . "\n";

// Test pour Grade
$grade = new Grade();
$grade->setName('Computer Science');
echo "Grade Name: " . $grade->getName() . "\n";

// Test pour Room
$room = new Room();
$room->setName('Room 101');
$room->setCapacity(30);
echo "Room Name: " . $room->getName() . "\n";
echo "Room Capacity: " . $room->getCapacity() . "\n";

// Test pour Floor
$floor = new Floor();
$floor->setName('First Floor');
echo "Floor Name: " . $floor->getName() . "\n";

