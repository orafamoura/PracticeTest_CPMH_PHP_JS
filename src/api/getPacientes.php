<?php
// Caminho para incluir os arquivos necessários
require_once(__DIR__ . '/../config/DatabaseConnection.php');
require_once(__DIR__ . '/../repositories/PacienteRepository.php');

use src\repositories\PacienteRepository;

// Instanciando uma conexão com o banco de dados
$databaseConnection = new DatabaseConnection();
$connection = $databaseConnection->getConnection();

// Instanciando o repositório de pacientes
$pacienteRepository = new PacienteRepository($connection);

// Verificar se há uma busca por nome
if (isset($_GET['name']) && !empty($_GET['name'])) {
    $name = $_GET['name'];

    try {
        $paginaAtual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
        $itensPorPagina = 10; // Definir o número de itens por página
        // Busca pacientes pelo nome usando o PacienteRepository
        $pacientes = $pacienteRepository->findByName($name, $paginaAtual, $itensPorPagina);

        // Retornar os pacientes encontrados como JSON
        header('Content-Type: application/json');
        echo json_encode($pacientes);
    } catch (Exception $e) {
        // Tratar exceções
        header('Content-Type: application/json', true, 500);
        echo json_encode(['error' => $e->getMessage()]);
    }
} else {
    // Definir valores padrão para paginação
    $paginaAtual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
    $itensPorPagina = 10; // Definir o número de itens por página

    try {
        // Busca todos os pacientes usando o PacienteRepository com paginação
        $resultadoPaginado = $pacienteRepository->findAll($paginaAtual, $itensPorPagina);

        // Retornar os pacientes encontrados como JSON
        header('Content-Type: application/json');
        echo json_encode($resultadoPaginado);
    } catch (Exception $e) {
        // Tratar exceções
        header('Content-Type: application/json', true, 500);
        echo json_encode(['error' => $e->getMessage()]);
    }
}
?>
