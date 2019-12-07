<?php
// Pega as funções do projeto
require_once("functions/core.php");

setHeader("Novo Colecionador");

$registration = $_GET['collector'] ?? '0';
$collector = selectCollector($registration);

if (!$collector) {
    setAlert(ALERT_ERROR, 'O Colecionador não foi encontrado.');
    header('Location: index.php');
}

editCollector($registration);

$_SESSION['token'] = time();
$fullName = $_POST['fullName'] ?? $collector->fullName;
$birthDay = $_POST['birthDay'] ?? $collector->birthDay;
$phone = $_POST['phone'] ?? $collector->phone;
$email = $_POST['email'] ?? $collector->email;
$cpf = $_POST['cpf'] ?? $collector->cpf;
?>

<body>
    <?php setNavBar() ?>

    <div class="container margin-nav">

        <?php showAlerts() ?>

        <form method="POST">
            <div class="form-group">
                <label>Nome Completo</label>
                <input type="text" name="fullName" class="form-control" placeholder="Mestre da Pisadinha" value="<?= $fullName ?>">
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control" placeholder="ra@ra.voip" value="<?= $email ?>">
            </div>
            <div class="form-group">
                <label>Data de Nascimentol</label>
                <input type="date" name="birthDay" class="form-control" value="<?= $birthDay ?>">
            </div>
            <div class="form-group">
                <label>Celular</label>
                <input type="tel" name="phone" class="form-control" placeholder="71982509571" value="<?= $phone ?>">
            </div>
            <div class="form-group">
                <label>CPF</label>
                <input type="tel" name="cpf" class="form-control" placeholder="0925852595" value="<?= $cpf ?>">
            </div>
            <input type="hidden" name="token" value="<?php echo $_SESSION['token'] ?>">
            <div class="row-8 d-flex justify-content-between">
                <a href="index.php" type="submit" class="btn btn-light">Voltar</a>
                <button type="submit" class=" btn btn-dark">Editar</button>
            </div>
        </form>
    </div>

    <?= setJavaScripts() ?>
</body>