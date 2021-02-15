<?php
$nombreValeur = 0;
$nombreTable = 0;
/*mettre les valeurs a 0 au depart puis verifier quel est l'entré de lutilisateur et si lentré et un entier positif alors.. */

$errors= []; /*tableau vide au depart dans le quel on ajoute des valeurs*/
/*test verifier si table errors existe ou pas et si oui bootstrap affiche en rouge*/
/* apostrophe typographique alt+0146 */

/* _get données que nous trouverons dans lurl*/
if (isset($_GET['nbvaleurs']) && isset($_GET['nbtables'])){
   if (ctype_digit($_GET['nbvaleurs'])) {
        $nombreValeur = (int) $_GET['nbvaleurs'];
        if ($nombreValeur <1 ){
            $errors['valeurErrors'] = 'je ne peux calculer les tables que s’il y a plus d’une valeur dans la table';
        }
    } /*test si entier positif grace a ctype digit*/
    else{
        $errors['valeurErrors'] = 'vous n’avez pas entré un entier ou un nombre positif pour déterminer le nombre de valeurs a calculer';
    }
    if (ctype_digit($_GET['nbtables'])) {
        $nombreTable = (int) $_GET['nbtables'];
        if ($nombreTable < 1 ){
            $errors['tableErrors'] = 'je ne peux calculer les tables plus petite que 1';
        }

    }
    else{
        $errors['tableErrors'] = 'vous n’avez pas entré un entier ou un nombre positif pour déterminer le nombre de tables a calculer';
    }
}



?>

<!-- Début du template d’affichage -->

<!DOCTYPE html>
<html lang="fr-be">
<head>
    <meta charset="utf-8">
    <title>Les tables de multiplication</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body>
<main class="container">
    <h1>Les tables de multiplication</h1>

    <section>
        <h2>Indiquez quelles tables vous souhaitez</h2>
        <form action="<?= $_SERVER['PHP_SELF'] ;?>" method="get">
            <div class="form-group<?= isset($errors['tableErrors'])?' has-error': '' ?>"> <!--sil ya une erreur met lerreur sinon chaine de caractere-->
                <label class="control-label" for="nbtables">Nombre de tables : </label>
                <input class="form-control" id="nbtables" type="text" name="nbtables"
                       value="<?= $nombreTable ;?>">
                <?php if (isset($errors['tableErrors'])): ?>
                <span class="help-block"><?= $errors['tableErrors'] ;?></span>
                <?php endif;?>
            </div>
            <div class="form-group<?= isset($errors['valeurErrors'])?' has-error': '' ?>">
                <label class="control-label" for="nbvaleurs">Nombre de valeurs : </label>
                <input class="form-control" id="nbvaleurs" type="text" name="nbvaleurs"
                       value="<?= $nombreValeur ;?>">
                <?php if (isset($errors['valeurErrors'])): ?>
                    <span class="help-block"><?= $errors['valeurErrors'] ;?></span>
                <?php endif;?>
            </div>
            <input type="submit">
        </form>
    <?php if ($nombreTable > 0 && $nombreValeur > 0):?>
    </section>
    <section>
        <h2>Voici vos tables</h2>
        <table class="table table-striped table-bordered">
            <caption>Les <?= $nombreValeur ;?> premières valeurs des <?= $nombreTable ;?> premières tables</caption>
            <tr>
                <th class="vide">&nbsp;</th>
                <?php for ($cell = 1 ; $cell<=$nombreTable; $cell++): ?>
                    <th scope="col"><?= $cell;?></th>
                <?php endfor ;?>
            </tr>
            <?php for($row = 1;$row<=$nombreValeur; $row++): ?>
            <tr>
                <th scope="row"><?= $row ;?></th>
                <?php for ($cell = 1 ; $cell<=$nombreTable; $cell++): ?>
                 <td><?= $row;?> * <?= $cell;?> = <?= $row * $cell ;?></td>
                <?php endfor ;?>
            </tr>
            <?php endfor; ?>
        </table>
    </section>
    <?php endif;?>
</main>
</body>
</html>

