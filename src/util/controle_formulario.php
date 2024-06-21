<?php
require_once(__DIR__ . "/../config/DatabaseConnection.php");
require_once(__DIR__ . "/../repositories/PacienteRepository.php");
require_once(__DIR__ . "/../repositories/PacienteRepositoryInterface.php");

use src\repositories\PacienteRepository;
use src\entities\Paciente;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $birthdateString = $_POST["birthdate"];
    $gender = $_POST["gender"];
    $telephone = $_POST["telephone"];
    $address = $_POST["address"];

    //instanciando banco de dados
    $databaseConnection = new DatabaseConnection();
    $connection = $databaseConnection->getConnection();

    $birthdate = DateTime::createFromFormat('Y-m-d', $birthdateString);
    if (!$birthdate) {
        throw new Exception('Data de nascimento inválida');
    }
    $telephoneNumber = intval(preg_replace('/[^0-9]/', '', $telephone));
    $pacienteRepository = new PacienteRepository($connection);
    try {

        //criando um novo paciente usando a entidade
        $paciente = new Paciente(null, $name, $birthdate, $gender, $telephoneNumber, $address);

        //salvando o paciente no banco de dados
        if ($pacienteRepository->save($paciente)) {
            $_SESSION['mensagemSucessoLayer'] = 'Paciente cadastrado com sucesso';
            header("Location: ../../index.html");
        }

    } catch (PDOException $e) {
        $_SESSION['error_message'] = 'Erro ao processar o registro: ' . $e->getMessage();
        echo ("caiu aqui processar") . $e->getMessage();
        exit();
    }
} else {
    $_SESSION['error_message'] = 'Erro: Os dados não foram enviados por POST.';
    echo ("caiu aqui nao foi enviado");
    exit();
}
?>