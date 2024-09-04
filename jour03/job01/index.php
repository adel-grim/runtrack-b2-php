<?php

// Inclusion de la classe Student
require_once 'Student.php';

// Test 1
$student1 = new Student(1, 101, 'adel@esisi.com', 'Adel Grim', new DateTime('2000-01-15'), 'Male');
echo "Student 1: " . $student1->getFullname() . " (" . $student1->getEmail() . ")\n";

// Test 2 
$student2 = new Student();
$student2->setFullname('Lala Nono');
$student2->setEmail('lala@nono.fr');
echo "Student 2: " . $student2->getFullname() . " (" . $student2->getEmail() . ")\n";

// Affichage des dates de naissance
echo "Date de naissance de " . $student1->getFullname() . ": " . $student1->getBirthdate()->format('Y-m-d') . "\n";
echo "Date de naissance de " . $student2->getFullname() . ": " . $student2->getBirthdate()->format('Y-m-d') . "\n";
