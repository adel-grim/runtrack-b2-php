<?php
function my_is_multiple($number, $multiple) {
    // Vérifier si le multiple est différent de zéro pour éviter une division par zéro
    if ($multiple == 0) {
        return false;
    }

    // Vérifier si le nombre est un multiple de l'autre nombre
    return $number % $multiple == 0;
}

// exemple
$number = 7;
$multiple = 4;

if (my_is_multiple($number, $multiple)) {
    echo "$number est un multiple de $multiple.";
} else {
    echo "$number n'est pas un multiple de $multiple.";
}
?>
