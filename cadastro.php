<?php
// Pega as funções do projeto
require_once("functions/core.php");

setHeader("Novo Colecionador");
createCollector();

$_SESSION['token'] = time();
$fullName = $_POST['fullName'] ?? '';
$birthDay = $_POST['birthDay'] ?? '';
$phone = $_POST['phone'] ?? '';
$email = $_POST['email'] ?? '';
$cpf = $_POST['cpf'] ?? '';
?>

<body>
    <?php setNavBar() ?>

    <div class="container margin-nav">

        <?php showAlerts() ?>

        <form method="POST">
            <div class="form-group">
                <label>Nome Completo</label>
                <input type="text" name="fullName" class="form-control" placeholder="Mestre da Pisadinha" value="<?=$fullName?>">
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control" placeholder="ra@ra.voip" value="<?=$email?>">
            </div>
            <div class="form-group">
                <label>Data de Nascimentol</label>
                <input type="date" name="birthDay" class="form-control" value="<?=$birthDay?>">
            </div>
            <div class="form-group">
                <label>Celular</label>
                <input type="tel" name="phone" class="form-control" placeholder="71982509571" value="<?=$phone?>">
            </div>
            <div class="form-group">
                <label>CPF</label>
                <input type="tel" name="cpf" class="form-control" placeholder="0925852595" value="<?=$cpf?>">
            </div>
            <input type="hidden" name="token" value="<?php echo $_SESSION['token']?>">
            <button type="submit" class=" btn btn-dark">Entrar</button>
        </form>
    </div>

    <?= setJavaScripts() ?>
</body>