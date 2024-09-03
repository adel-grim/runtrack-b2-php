<?php
function my_fizz_buzz(int $length) : array {
    // Initialisation du tableau vide
    $result = [];

    // Boucle de 1 jusqu'à la longueur spécifiée
    for ($i = 1; $i <= $length; $i++) {
        // Vérification des multiples de 3 et 5
        if ($i % 3 == 0 && $i % 5 == 0) {
            $result[] = "FizzBuzz";
        } elseif ($i % 3 == 0) {
            $result[] = "Fizz";
        } elseif ($i % 5 == 0) {
            $result[] = "Buzz";
        } else {
            $result[] = $i;
        }
    }

    // Retourne le tableau
    return $result;
}

// Exemple d'utilisation
$length = 15;
$fizz_buzz_array = my_fizz_buzz($length);
print_r($fizz_buzz_array);
?>
