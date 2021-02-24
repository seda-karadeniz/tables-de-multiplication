<?php
function validated(): array
{
    $errors = [];

    if (!ctype_digit($_GET['nbvalues'])) {
        $errors['values'] = 'Le nombre de valeurs doit être un nombre entier.';
    } else if ((int)$_GET['nbvalues'] <= 1) {
        $errors['values'] = 'Le nombre de valeur doit être supérieur à 1.';
    }
    if (!ctype_digit($_GET['nbtables'])) {
        $errors['tables'] = 'Le nombre de tables doit être un nombre entier.';
    } else if ((int)$_GET['nbtables'] <= 1) {
        $errors['tables'] = 'Le nombre de valeur doit être supérieur à 1.';
    }

    if (count($errors)) return compact('errors');

    $nbtables = (int)$_GET['nbtables'];
    $nbvalues = (int)$_GET['nbvalues'];

    return compact('nbtables', 'nbvalues');
}
