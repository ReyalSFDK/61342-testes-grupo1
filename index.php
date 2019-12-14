<?php
// Pega as funções do projeto
require_once("functions/core.php");

setHeader("Todos os Colecionadores");

$collectors = selectAllCollectors();
?>

<body>
    <?php setNavBar() ?>

    <div class="container margin-nav center">
        <?php showAlerts() ?>

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
                    <th scope="col">Idade</th>
                    <th scope="col">Email</th>
                    <th scope="col">Ações</th>

                </tr>
            </thead>
            <tbody>
                <?php
                $count = 1;
                foreach ($collectors as $collector) {
                    $now = new DateTime("now");
                    $birthDate = new DateTime($collector[2]);
                    $years = $birthDate->diff($now);
                    ?>
                    <tr>
                        <th scope="row"><?= $count++ ?></th>
                        <td><?= $collector[0] ?></td>
                        <td><?= $collector[1] ?></td>
                        <td><?= $years->format("%y anos") ?></td>
                        <td><?= $collector[4] ?></td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a type="button" href="edicao.php?collector=<?= $collector[0] ?>" class="btn btn-warning">Editar</a>
                                <a type="button" href="delete.php?collector=<?= $collector[0] ?>" class="btn btn-danger">Excluir</a>
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