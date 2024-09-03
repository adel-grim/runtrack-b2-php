<?php
function my_is_prime(int $number) {
    // Vérifier si le nombre est inférieur à 2, car 0 et 1 ne sont pas des nombres premiers
    if ($number < 2) {
        return false;
    }

    // Vérifier les divisions jusqu'à la racine carrée du nombre
    for ($i = 2; $i <= sqrt($number); $i++) {
        // Si le nombre est divisible par $i, ce n'est pas un nombre premier
        if ($number % $i == 0) {
            return false;
        }
    }

    // Si aucune division n'est possible, le nombre est premier
    return true;
}

// Exemple d'utilisation
$number = 4;

if (my_is_prime($number)) {
    echo "$number est un nombre premier.";
} else {
    echo "$number n'est pas un nombre premier.";
}
?>
