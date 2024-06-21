<?php

namespace src\repositories;

require_once(__DIR__ . '/../entities/Paciente.php');
require_once(__DIR__ . '/../repositories/PacienteRepositoryInterface.php');

use PDO;
use src\entities\Paciente;
use src\repositories\PacienteRepositoryInterface;

class PacienteRepository implements PacienteRepositoryInterface
{
    private PDO $connection;
    //conexao com o banco
    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }
    //metodo para buscar todos os pacientes
    public function findAll(int $paginaAtual = 1, int $itensPorPagina = 10): array
    {
        $offset = ($paginaAtual - 1) * $itensPorPagina;
        $stmt = $this->connection->prepare("SELECT * FROM pacientes LIMIT :offset, :itensPorPagina");
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->bindParam(':itensPorPagina', $itensPorPagina, PDO::PARAM_INT);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC); 
        
        $totalPacientes = $this->connection->query("SELECT COUNT(*) FROM pacientes")->fetchColumn();
        $totalPaginas = ceil($totalPacientes / $itensPorPagina);

        return ['data' => $result, 'totalPaginas' => $totalPaginas];
    }
    //metodo para encontrar o paciente pelo nome
    public function findByName(string $name, int $paginaAtual = 1, int $itensPorPagina = 10): ?array
    {
        $offset = ($paginaAtual - 1) * $itensPorPagina;
    
        // Preparar a consulta SQL com LIKE para buscar nomes que comecem com a parte pesquisada
        $sql = "SELECT * FROM pacientes WHERE name LIKE :name LIMIT :offset, :itensPorPagina";
        $stmt = $this->connection->prepare($sql);
    
        // Adicionar o caractere '%' ao termo de busca para indicar correspondência no início
        $searchTerm = $name . '%';
    
        // Executar a consulta com os parâmetros
        $stmt->bindParam(':name', $searchTerm, PDO::PARAM_STR);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->bindParam(':itensPorPagina', $itensPorPagina, PDO::PARAM_INT);
        $stmt->execute();
    
        // Obter os resultados
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        // Calcular o total de pacientes para a paginação
        $countStmt = $this->connection->prepare("SELECT COUNT(*) FROM pacientes WHERE name LIKE :name");
        $countStmt->bindParam(':name', $searchTerm, PDO::PARAM_STR);
        $countStmt->execute();
        $totalPacientes = $countStmt->fetchColumn();
        $totalPaginas = ceil($totalPacientes / $itensPorPagina);
    
        // Retornar os resultados como um array associativo
        return ['data' => $result, 'totalPaginas' => $totalPaginas];
    }
    



    
    //metodo para salvar o paciente no banco de dados
    public function save(Paciente $paciente): bool
    {
        $stmt = $this->connection->prepare("INSERT INTO pacientes (name, birthdate, gender, telephone, address) VALUES (:name, :birthdate, :gender, :telephone, :address)");
        
        return $stmt->execute([
            'name' => $paciente->getName(),
            'birthdate' => $paciente->getBirthDate()->format('Y-m-d'),
            'gender' => $paciente->getGender(),
            'telephone' => $paciente->getTelephone(),
            'address' => $paciente->getAddress()
        ]);
    }
    //metodo que cria o objeto Paciente
    private function createUserFromData(array $userData): Paciente
    {
        return new Paciente(
            $userData['id'],
            $userData['name'],
            new \DateTimeImmutable($userData['birthdate']),
            $userData['gender'],
            $userData['telephone'],
            $userData['address']
        );
    }
}
?> 