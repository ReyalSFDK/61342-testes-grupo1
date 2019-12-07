<?php
// Pega as funções do projeto
require_once("functions/core.php");

setHeader("Todos os Colecionadores");

$collectors = selectAllCollectors();
?>
<body>
    <?php setNavBar() ?>
    <?php showAlerts() ?>

    <div class="container margin-nav center">
        <div class="row center">
            <div class="col">
                <h4 class="card-title">Trato Feito</h4>
            </div>
            <div class="col">
                <button type="button" class="btn btn-dark">Adicionar</button>
            </div>
        </div>
        <table class="table table-striped table-dark margin-nav">
            <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Matrícula</th>
                <th scope="col">Nome</th>
                <th scope="col">Email</th>
            </tr>
            </thead>
            <tbody>
            <?php
                $count = 1;
                foreach ($collectors as $collector) {
                ?>
                    <tr>
                        <th scope="row"><?=$count++?></th>
                        <td><?=$collector[0]?></td>
                        <td><?=$collector[1]?></td>
                        <td><?=$collector[4]?></td>
                    </tr>
                <?php
                    }
            ?>
            </tbody>
        </table>
        <a href="delete.php?collector=<?=selectAllCollectors()[0][0]?>">Delete</a>
    </div>

    <?=setJavaScripts()?>
</body>
