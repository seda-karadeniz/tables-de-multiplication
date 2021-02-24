<?php
require 'validation.php';

define('SITE_TITLE', 'Les tables de multiplication');

if (isset($_GET['nbvalues'], $_GET['nbtables'])) {
    $data = validated();
    $old = $_GET;
}

?>

<!-- Début du template d’affichage -->

<!DOCTYPE html>
<html lang="fr-be">
<head>
    <meta charset="utf-8">
    <title><?= SITE_TITLE ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
</head>
<body>
<main class="container">
    <h1 class="mt-2">Les tables de multiplication</h1>
    <section>
        <h2>Indiquez quelles tables vous souhaitez</h2>
        <form action="index.php" method="get">
            <div class="mt-3 form-group<?= isset($data['errors']['tables']) ? ' has-error' : '' ?>">
                <label class="control-label" for="nbtables">Nombre de tables : </label>
                <input class="form-control" id="nbtables" type="text" name="nbtables" autofocus
                       value="<?= $old['nbtables'] ?? 2 ?>">
                <?php if (isset($data['errors']['tables'])): ?>
                    <span class="help-block"><?= $data['errors']['tables'] ?></span>
                <?php endif ?>
            </div>
            <div class="mt-3 form-group<?= isset($data['errors']['values']) ? ' has-error' : '' ?>">
                <label class="control-label" for="nbvalues">Nombre de valeurs : </label>
                <input class="form-control" id="nbvalues" type="text" name="nbvalues"
                       value="<?= $old['nbvalues'] ?? 2 ?>">
                <?php if (isset($data['errors']['values'])): ?>
                    <span class="help-block"><?= $data['errors']['values'] ?></span>
                <?php endif ?>
            </div>
            <button class="mt-4 btn btn-primary" type="submit">Afficher les tables</button>
        </form>
    </section>

    <?php if (isset($data['nbtables'])): ?>
        <section class="mt-5">
            <h2>Voici vos tables</h2>
            <table class="table table-striped table-bordered">
                <caption>Les <?= $data['nbvalues'] ?> premières valeurs des <?= $data['nbtables'] ?> premières tables
                </caption>
                <tr>
                    <th class="vide">&nbsp;</th>
                    <?php for ($cell = 1;
                               $cell <= $data['nbtables'];
                               $cell++): ?>
                        <th scope="col"><?= $cell ?></th>
                    <?php endfor ?>
                </tr>
                <?php for ($row = 1;
                           $row <= $data['nbvalues'];
                           $row++): ?>
                    <tr>
                        <th scope="row"><?= $row ?></th>
                        <?php for ($cell = 1;
                                   $cell <= $data['nbtables'];
                                   $cell++): ?>
                            <td><?= $row ?> * <?= $cell ?> = <?= $row * $cell ?></td>
                        <?php endfor ?>
                    </tr>
                <?php endfor ?>
            </table>
        </section>
    <?php endif ?>
</main>
</body>
</html>