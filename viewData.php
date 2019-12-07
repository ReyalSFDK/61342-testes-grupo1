<?php
// Pega as funções do projeto
require_once("functions/core.php");

setHeader("Todos os Colecionadores")
?>

<body>
    <?php setNavBar() ?>
    <?php showAlerts() ?>

    <div class="container margin-nav center">

        <div class="card">
            <div class="card-body">
                This is some text within a card body.
            </div>
        </div>

    </div>

    <?= setJavaScripts() ?>
</body>