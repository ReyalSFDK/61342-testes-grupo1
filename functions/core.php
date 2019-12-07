<?php
session_start();

// Get Database
require_once("database.php");

// Constants
const SESSION_ALERT = 'SESSION_ALERT';
const ALERT_ERROR = 'danger';
const ALERT_SUCCESS = 'success';

/**
 * Adiciona um alert na sessão
 *
 * @param string $alertType
 * @param string $alertText
 */
function setAlert(string $alertType, string $alertText) {
    $alert = [$alertType, $alertText];

    $_SESSION[SESSION_ALERT][] = $alert;
}

/**
 * Mostra o alerta na tela
 */
function showAlerts() {
    if (isset($_SESSION[SESSION_ALERT])) {
        foreach ($_SESSION[SESSION_ALERT] as $alert) {
            echo '
            <div class="alert alert-'.$alert[0].'">
                '.$alert[1].'
            </div>
        ';
        }

        $_SESSION[SESSION_ALERT] = [];
    }
}

/**
 * Exibe um cabeçalho HTML
 *
 * @param string $title
 */
function setHeader(string $title) {
    echo '
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <!-- Required meta tags -->
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        
            <!-- Bootstrap CSS -->
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
            <link rel="stylesheet" href="styles/custom.css">

            <title>'. $title.'</title>
        </head>';
}

/**
 * Mostra a navbar
 *
 * @return string
 */
function setNavBar() {
    echo '
        <nav class="navbar navbar-dark bg-dark nav center color">
            <img class="img" src="https://upload.wikimedia.org/wikipedia/commons/d/d9/Pawn_Stars_logo-large.png" alt="Logo Colecionadores">
        </nav>
    ';
}

function setJavaScripts() {
    return '
         <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
            crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
            integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
            crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
            integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
            crossorigin="anonymous"></script>
    ';
}

/**
 * Pega o conteudo da pagina de lista
 *
 * @return array|bool|mysqli_result
 */
function selectAllCollectors() {
    global $conn;

    $sql = "SELECT * FROM collectors";
    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

    $collectors = mysqli_fetch_all($result);

    if ($collectors) {
        return $collectors;
    } else {
        return [];
    }
}

/**
 * @param string $registration
 *
 * @return object |null
 */
function selectCollector(string $registration) {
    global $conn;

    $sql = "SELECT * FROM collectors WHERE registration = $registration";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        return mysqli_fetch_object($result);
    } else {
        setAlert(ALERT_ERROR, "Colecionador não encontrado.");
        header('Location: index.php');
    }

}

/**
 * Deleta um colecionador do banco
 *
 * @param string $collectorRegistration
 */
function deleteCollector(string $collectorRegistration) {
    global $conn;

    $sql = "DELETE FROM collectors WHERE registration=$collectorRegistration";
    $result = mysqli_query($conn, $sql);;

    if ($result) {
        setAlert(
            ALERT_SUCCESS,
            'O colecionador foi deletado com sucesso'
        );
    } else {
        setAlert(
            ALERT_ERROR,
            'Houve um erro ao apagar o colecionador'
        );
    }

    header('Location: index.php');
}

/**
 * Adiciona um colecionador
 *
 * @throws Exception
 */
function createCollector() {
    global $conn;

    if (!empty($_POST['token'])) {
        $fullName = $_POST['fullName'] ?? '';
        $birthDay = $_POST['birthDay'] ?? '';
        $phone = $_POST['phone'] ?? '';
        $email = $_POST['email'] ?? '';
        $cpf = $_POST['cpf'] ?? '';

        $birthDate = DateTime::createFromFormat('Y-m-d', $birthDay);
        if ($birthDate && validateCollector(
            $fullName,
            $birthDate,
            $phone,
            $email,
            $cpf
        )) {
            $formattedBirthDate = $birthDate->format('Y-m-d');
            $sql = "INSERT INTO 
                collectors
                    (fullName, birthDay, phone, email, cpf)
                VALUES
                    ('$fullName', '$formattedBirthDate', '$phone', '$email', '$cpf')";

            $query = mysqli_query($conn, $sql);
            if ($query) {
                setAlert(ALERT_SUCCESS, "O Colecionador foi adicionado com sucesso.");
                header('Location: index.php');
            } else {
                if (strpos(mysqli_error($conn), 'email') ) {
                    setAlert(ALERT_ERROR, 'Este email já esta em uso');
                }

                if (strpos(mysqli_error($conn), 'cpf') ) {
                    setAlert(ALERT_ERROR, 'Este cpf já esta em uso');
                }
            }
        }
    }
}
/**
 * Adiciona um colecionador
 *
 * @throws Exception
 */
function editCollector(string $registration) {
    global $conn;

    if (!empty($_POST['token'])) {
        $fullName = $_POST['fullName'] ?? '';
        $birthDay = $_POST['birthDay'] ?? '';
        $phone = $_POST['phone'] ?? '';
        $email = $_POST['email'] ?? '';
        $cpf = $_POST['cpf'] ?? '';

        $birthDate = DateTime::createFromFormat('Y-m-d', $birthDay);
        if ($birthDate && validateCollector(
            $fullName,
            $birthDate,
            $phone,
            $email,
            $cpf
        )) {
            $formattedBirthDate = $birthDate->format('Y-m-d');
            $sql = "UPDATE
                collectors
                    SET
                    fullName = '$fullName',
                    birthDay = '$formattedBirthDate',
                    phone = '$phone',
                    email = '$email',
                    cpf = '$cpf'
                WHERE
                   registration = $registration";

            $query = mysqli_query($conn, $sql);
            if ($query) {
                setAlert(ALERT_SUCCESS, "O Colecionador foi editado com sucesso.");
                header('Location: index.php');
            } else {
                if (strpos(mysqli_error($conn), 'email') ) {
                    setAlert(ALERT_ERROR, 'Este email já esta em uso');
                }

                if (strpos(mysqli_error($conn), 'cpf') ) {
                    setAlert(ALERT_ERROR, 'Este cpf já esta em uso');
                }
            }
        }
    }
}

/**
 * Valida os dados de um Colecionador
 *
 * @param string $fullName
 * @param DateTime $birthDay
 * @param string $phone
 * @param string $email
 * @param string $cpf
 *
 * @return bool
 *
 * @throws Exception
 */
function validateCollector(string $fullName, DateTime $birthDay, string $phone, string $email, string $cpf) {
    return
        validateLength($fullName, "Nome Completo", 9, 40) &&
        validateLength($phone, "Telefone", 9, 12) &&
        validateLength($email, "Email", 8, 30) &&
        validateLength($cpf, "CPF", 10, 12) &&
        validateBirthDay($birthDay);
}

/**
 * Valida o tamanho de uma string
 *
 * @param string $variable
 * @param string $label
 * @param int $min
 * @param int $max
 *
 * @return bool
 */
function validateLength(string $variable, string $label, int $min, int $max): bool {
    if (empty($variable)) {
        setAlert(ALERT_ERROR, "O campo $label não ser vazio.");
        return false;
    }
    if (strlen($variable) <= $min) {
        setAlert(ALERT_ERROR, "O campo $label não pode ter menos que $min caracteres.");
        return false;
    }

    if (strlen($variable) >= $max) {
        setAlert(ALERT_ERROR, "O campo $label não pode ter mais que $max caracteres.");
        return false;
    }
    return true;
}

/**
 * Valida a data de nascimento
 *
 * @param DateTime $birthDay
 * @return bool
 * @throws Exception
 */
function validateBirthDay(DateTime $birthDay): bool {
    $now = new DateTime();
    if ($now <= $birthDay) {
        setAlert(ALERT_ERROR, "A data de nascimento não pode ser maior que a de hoje.");
        return false;
    }

    return true;
}
