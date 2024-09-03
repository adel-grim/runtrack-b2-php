<?php
function my_str_reverse(string $string) {
    // Initialisation d'une variable pour stocker la chaîne inversée
    $reversed_string = '';

    // Parcours de la chaîne de caractères à l'envers
    for ($i = strlen($string) - 1; $i >= 0; $i--) {
        $reversed_string .= $string[$i];
    }

    // Retourne la chaîne inversée
    return $reversed_string;
}

// Exemple d'utilisation
$string = "Hello";
echo "La chaîne '$string' inversée : " . my_str_reverse($string);
?>
