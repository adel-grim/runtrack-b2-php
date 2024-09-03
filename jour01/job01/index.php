<?php
function my_str_search(string $haystack, string $needle) {
    // Vérifier que le premier paramètre est une seule lettre
    if (strlen($haystack) !== 1) {
        return 0;
    }

    // Compter les occurrences de la lettre 
    $count = 0;
    for ($i = 0; $i < strlen($needle); $i++) {
        if ($needle[$i] === $haystack) {
            $count++;
        }
    }

    return $count;
}

// Exemple d'utilisation
$haystack = 'a';
$needle = 'LaPlateforme';
echo "Le nombre d'occurrences de la lettre '$haystack' dans la chaîne '$needle' est : " . my_str_search($haystack, $needle);
?>
