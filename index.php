<?php
// Pega as funções do projeto
require_once("functions/core.php");

setHeader("Todos os Colecionadores")
?>
<body>
    <?php setNavBar() ?>
    <?php showAlerts() ?>

    <div class="container">
        <pre><?php var_dump(getAllCollectors())?></pre>
        <a href="delete.php?collector=<?=getAllCollectors()['registration']?>">Delete</a>
    </div>

    <?=setJavaScripts()?>
</body>
