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
                <a type="button" class="btn btn-dark" href="cadastro.php">Adicionar</a>
            </div>
        </div>
        <table class="table table-striped table-dark margin-nav">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Matrícula</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Email</th>
                    <th scope="col">Edit</th>

                </tr>
            </thead>
            <tbody>
                <?php
                $count = 1;
                foreach ($collectors as $collector) {
                    ?>
                    <tr>
                        <th scope="row"><?= $count++ ?></th>
                        <td><?= $collector[0] ?></td>
                        <td><?= $collector[1] ?></td>
                        <td><?= $collector[4] ?></td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a type="button" href="delete.php?collector=<?= $collector[0]?>"  class="btn btn-danger">Excluir</a>
                                <a type="button" href="edit.php?collector=<?= $collector[0]?>" class="btn btn-warning">Editar</a>
                            </div>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>

    <?= setJavaScripts() ?>
</body>