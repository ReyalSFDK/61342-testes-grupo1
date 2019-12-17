<?php
// Pega as funções do projeto
require_once("functions/core.php");

setHeader("Todos os Colecionadores");

// Verifica se foi buscado algo
$search = $_GET["search"] ?? "";

if (strlen($search) > 0) {
    $collectors = searchCollectors($search);
} else {
    $collectors = selectAllCollectors();
}

?>

<body>
    <?php setNavBar() ?>

    <div class="container margin-nav center">
        <?php showAlerts() ?>

        <div class="row justify-content-center">
            <form method="GET" class="col-8">
                <div class="input-group mb-4">
                    <input type="search" name="search" value="<?=$search?>" class="form-control" placeholder="Pesquise por nome, N. Registro, Email, Telefone ou CPF" aria-label="Example text with button addon" aria-describedby="button-addon1">
                    <div class="input-group-prepend">
                        <button class="btn btn-dark" type="submit" id="button-addon1">Pesquisar</button>
                    </div>
                </div>
            </form>
        </div>

        <?php
            if (strlen($search) > 0) {
                ?>
                <div class="row justify-content-center">
                    <div class="alert alert-light col-8" role="alert">
                        Exibindo os resuldados de pesquisa para  <strong><?=$search?></strong> - <a href="index.php" class="alert-link">Cancelar</a>
                    </div>
                </div>
                <?php
            }
        ?>

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


                if (count($collectors) > 0) {
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
                } else {
                    ?>
                    <tr>
                        <th colspan="6">
                            Não foram encontrados colecionadores no nosso sistema.

                        </th>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
    </div>

    <?= setJavaScripts() ?>
</body>