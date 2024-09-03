<?php
function my_array_sort($array, $order) {
    // Vérifier le type de tri demandé
    if ($order === "ASC") {
        //  croissant
        sort($array);
    } elseif ($order === "DESC") {
        // décroissant
        rsort($array);
    } else {
        // si pas  valide retourne le tableau non trié
        return $array;
    }

    return $array;
}

$array = [2, 24, 12, 7, 34];
$order = "DESC"; 

$sorted_array = my_array_sort($array, $order);
print_r($sorted_array);
?>
